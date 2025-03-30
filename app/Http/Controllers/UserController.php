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
        return view('user.users', compact('users'));
    }

    public function create()
    {
        $roles = Role::all(); // Fetch all roles
        $roles= $roles->toArray(); // Convert roles to array for debugging
        return view('user.user-add', compact('roles')); // Pass roles to the view
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->name),
            'contact' => $request->contact,
            'role' => $request->role,
        ]); 

        return redirect()->route('users')->with('success', 'User added successfully!');
    }

    public function edit($id)
    {
        return view('user.user-edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update user
        return redirect()->route('users');
    }

    public function destroy($id)
    {
        // Logic to delete user
        return redirect()->route('users');
    }
    public function show($id)
    {
        return view('user.user-show', compact('id'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        // Logic to search users
        return view('user.users', compact('query'));
    }
    public function filter(Request $request)
    {
        $filter = $request->input('filter');
        // Logic to filter users
        return view('user.users', compact('filter'));
    }
    public function sort(Request $request)
    {
        $sort = $request->input('sort');
        // Logic to sort users
        return view('user.users', compact('sort'));
    }
    public function paginate(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        // Logic to paginate users
        return view('user.users', compact('perPage'));
    }
    public function export(Request $request)
    {
        $format = $request->input('format');
        // Logic to export users
        return response()->download(storage_path("exports/users.$format"));
    }
    public function import(Request $request)
    {
        $file = $request->file('file');
        // Logic to import users
        return redirect()->route('users');
    }
    public function activate($id)
    {
        // Logic to activate user
        return redirect()->route('users');
    }
    public function deactivate($id)
    {
        // Logic to deactivate user
        return redirect()->route('users');
    }
    public function resetPassword($id)
    {
        // Logic to reset user password
        return redirect()->route('users');
    }
    public function sendNotification($id)
    {
        // Logic to send notification to user
        return redirect()->route('users');
    }
    public function viewProfile($id)
    {
        return view('user.user-profile', compact('id'));
    }
    public function changeRole(Request $request, $id)
    {
        $role = $request->input('role');
        // Logic to change user role
        return redirect()->route('users');
    }
    public function viewActivity($id)
    {
        return view('user.user-activity', compact('id'));
    }
    public function viewSettings($id)
    {
        return view('user.user-settings', compact('id'));
    }
    public function viewPermissions($id)
    {
        return view('user.user-permissions', compact('id'));
    }
    public function viewLogs($id)
    {
        return view('user.user-logs', compact('id'));
    }
    public function viewSessions($id)
    {
        return view('user.user-sessions', compact('id'));
    }
    public function viewDevices($id)
    {
        return view('user.user-devices', compact('id'));
    }
    public function viewNotifications($id)
    {
        return view('user.user-notifications', compact('id'));
    }

}
