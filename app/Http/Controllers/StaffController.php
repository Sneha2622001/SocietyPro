<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\User;

class StaffController extends Controller
{
    // View All Staff (Admin/Manager access assumed)
    public function index()
    {
        $staff = Staff::with('user')->latest()->get();
        return view('staff.index', compact('staff'));
    }

    // Show Create Form (Admin only)
    public function create()
    {
        // get users with role staff 
        $users = User::whereHas('roles', function($query) {
            $query->where('name', 'Staff');
        })->get();
        return view('staff.create', compact('users'));
    }

    // Store New Staff
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'nullable|in:Security,Maintenance',
            'shift' => 'nullable|string|max:255',
        ]);

        Staff::create([
            'user_id' => $request->user_id,
            'type' => $request->type,
            'shift' => $request->shift,
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff member added successfully.');
    }

    // Show Single Staff Detail
    public function show($id)
    {
        $staff = Staff::with('user')->get()->find($id);
        if (!$staff) {
            return redirect()->route('staff.index')->with('error', 'Staff member not found.');
        }
        return view('staff.show', compact('staff'));
    }

    public function edit($id)
    {
        $users = User::all();
        $staff = Staff::findOrFail($id);
        return view('staff.edit', compact('staff', 'users'));
    }
    
    // Update Staff Record
    public function update(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'nullable|in:Security,Maintenance',
            'shift' => 'nullable|string|max:255',
        ]);

        // dd($request->all());
        $staff = Staff::findOrFail($request->id);
        if (!$staff) {
            return redirect()->route('staff.index')->with('error', 'Staff member not found.');
        }
        // Check if the user_id is already assigned to another staff member
        $existingStaff = Staff::where('user_id', $request->user_id)
            ->where('id', '!=', $staff->id)
            ->first();
        if ($existingStaff) {
            return redirect()->route('staff.index')->with('error', 'This user is already assigned to another staff member.');
        }
        // Update the staff member
        $staff->user_id = $request->user_id;
        $staff->type = $request->type;
        $staff->shift = $request->shift;
        $staff->save();

        return redirect()->route('staff.index')->with('success', 'Staff member updated successfully.');
    }

    // Delete Staff
    public function destroy($id)
    {
        Staff::destroy($id);
        return redirect()->route('staff.index')->with('success', 'Staff deleted successfully.');
    }
        
}
