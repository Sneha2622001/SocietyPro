<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Resident;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();  // Fetch all roles
        $roles = $roles->toArray(); // Convert roles to array for debugging
        return view('user.users', compact('users','roles'));
    }

    public function create()
    {
        $roles = Role::all(); // Fetch all roles
        $roles= $roles->toArray(); // Convert roles to array for debugging
        return view('user.user-add', compact('roles')); // Pass roles to the view
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'contact' => 'string|max:15|unique:users,contact',
            'role' => 'required|exists:roles,id',
        ]);
        
        if ($validator->fails()) {
            // If request is AJAX (modal form submission), return JSON errors
            if ($request->ajax()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }
    
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file_path = null; // Default value if no file is uploaded
        if ($request->hasFile('profile')) {
            $file_path = $request->file('profile')->store('profiles', 'public'); // Store file
        }


 
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->name); // Hash the password
        $user->contact = $request->contact;
        $user->profile = $file_path;
        $user->status = $request->has('status') ? 1 : 0;
        $user->save();

        // Assign role to the user
        $role = Role::find($request->role); // $request->role is the ID
        if (!$role) {
            return back()->with('error', 'Invalid role selected.');
        }
        $user->assignRole($role->name);
        if ($user->hasRole('Resident')) {
            $resident = new Resident;
            $resident->user_id = $user->id;
            $resident->name = $user->name;
            $resident->contact = $user->contact;
            $resident->save(); 
        }
        return redirect()->route('users')->with('success', 'User added successfully!');
    }

    public function edit($id)
    {
        $roles = Role::all();  // Fetch all roles
        $roles = $roles->toArray(); // Convert roles to array for debugging
        $user = User::findOrFail($id);
        return view('user.user-edit', compact('user', 'roles')); // Pass roles to the view
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->status = $request->has('status') ? 1 : 0;
        // Remove current image
        if ($request->has('remove_image') && $user->profile) {
            Storage::disk('public')->delete($user->profile);
            $user->profile = null;
        }

        // Upload new image
        if ($request->hasFile('profile')) {
            // Delete old image if exists
            if ($user->profile) {
                Storage::disk('public')->delete($user->profile);
            }

            $path = $request->file('profile')->store('profiles', 'public');
            $user->profile = $path;
        }
        $role = Role::find($request->role);
        if ($role) {
            $user->syncRoles([$role->name]);
        }
        $user->save();

        $user->assignRole($role->name);
        if ($user->hasRole('Resident')) {
            $resident = Resident::where('user_id', $user->id)->first();
            if (!$resident) {
                $resident = new Resident;
            } else {
                // Update existing resident
                $resident->name = $request->name;
                $resident->contact = $request->contact;
                $resident->save();
            }
            $resident->user_id = $user->id;
            $resident->name = $user->name;
            $resident->contact = $user->contact;
            $resident->save(); 
        }

        return redirect()->route('users')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        // Logic to delete user
        User::destroy($id);
        return redirect()->route('users')->with('success', 'User deleted successfully.');
    }

    public function show($id)
    {
        return view('user.user-show', compact('id'));
    }

    public function search(Request $request)
    {
        $roles = Role::all();  // Fetch all roles
        $roles = $roles->toArray(); // Convert roles to array for debugging
        $users = User::all();
        $query = User::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
                  ->orWhere('contact', 'like', "%{$request->search}%");
        }
        if ($request->filled('role')) {
            $query->where('role_id', $request->role);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $users = $query->orderBy('id', 'desc')->paginate(10);

        return view('user.users', compact('query','users','roles'));
    }

}
