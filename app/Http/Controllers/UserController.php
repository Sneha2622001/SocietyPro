<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;  
use App\Models\Role;

class UserController extends Controller
{
    public function index() {
            $users = User::with('role')->get();
            $roles = Role::all();
            
            // dd($roles); 
        
            return view('users.users', compact('users', 'roles'));
        }
        
    
    
    public function store(Request $request) {
        User::create($request->all());
        return redirect()->route('users.users')->with('success', 'User added successfully!');
    }
    
    public function edit(User $user) {
        return view('users.users', compact('user'));
    }
    
    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('users.users')->with('success', 'User deleted!');
    }
    
}
