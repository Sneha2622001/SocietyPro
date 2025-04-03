<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
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
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email',
        //     'contact' => 'string|max:15',
        //     'role' => 'required|exists:roles,id', // Ensure role exists
        // ]);
        $file_path = null; // Default value if no file is uploaded
        if ($request->hasFile('profile')) {
            $file_path = $request->file('profile')->store('public/profiles'); // Store file
            $file_path = str_replace('public/', '', $file_path); // Store relative path
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->name),
            'contact' => $request->contact,
            'role_id' => $request->role,
            'profile' => $file_path,
            'status' => $request->has('status') ? 1 : 0,
        ]); 

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
        // Logic to update user
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email,' . $id,
        //     'contact' => 'string|max:15',
        //     'role' => 'required|exists:roles,id', // Ensure role exists
        // ]);
        $roles = Role::all(); // Fetch all roles
        $roles= $roles->toArray(); // Convert roles to array for debugging
        $user = User::findOrFail($id);  
        if ($request->hasFile('profile')) {
            $file_path = $request->file('profile')->store('public');
            $file_path = str_replace('public/', '', $file_path); // Store relative path
            $user->profile = $file_path;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->role_id = $request->role;
        $user->status = $request->has('status') ? 1 : 0;;
        $user->save();
        return redirect()->route('users');
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
