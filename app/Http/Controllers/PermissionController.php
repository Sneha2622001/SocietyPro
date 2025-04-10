<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function managePermissions()
    {
        $roles = Role::whereIn('name', ['Authenticated', 'Admin', 'Resident', 'Security', 'Staff'])->get();
        $permissions = Permission::all();

        $groupedPermissions = $permissions->groupBy(function ($permission) {
            return explode(' ', $permission->name)[1] ?? 'other';
        });

        return view('permissions.manage', compact('roles', 'permissions', 'groupedPermissions'));
    }

    public function savePermissions(Request $request)
    {
        $roles = Role::whereIn('name', ['Authenticated', 'Admin', 'Resident', 'Security', 'Staff'])->get();

        foreach ($roles as $role) {
            $selectedPermissions = $request->input("permissions.{$role->id}", []);
            
            // Convert permission IDs to names
            $permissionNames = Permission::whereIn('id', $selectedPermissions)->pluck('name')->toArray();
            
            $role->syncPermissions($permissionNames);
        }
        

        return redirect()->route('permissions.manage')->with('success', 'Permissions updated successfully.');
    }
}
