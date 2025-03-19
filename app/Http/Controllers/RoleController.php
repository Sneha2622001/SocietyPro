<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all(); // Fetch all roles
        return view('role', compact('roles'));
    }


    public function create()
    {
        return view('role_create'); // Open the add role form
    }


    
    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|unique:roles,name|max:255'
        ]);

        Role::create(['name' => $request->role_name]);

        return redirect()->route('role')->with('success', 'Role added successfully!');
    }

    
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('role_edit', compact('role')); // Create 'role_edit.blade.php'
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->role_name;
        $role->save();

        return redirect()->route('role')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->route('role')->with('success', 'Role deleted successfully.');
    }

}
