<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    // Show all complaints for admin/staff
    public function index()
    {
        $complaints = Complaint::latest()->get();
        return view('complaints.index', compact('complaints'));
    }

    // Show a resident's complaints
    public function userComplaints()
    {
        $complaints = Complaint::where('user_id', Auth::id())->latest()->get();
        return view('complaints.user_complaints', compact('complaints'));
    }

    // Show complaint creation form
    public function create()
    {
        return view('complaints.create');
    }

    // Store a new complaint
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Complaint::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'Pending',
        ]);

        return redirect()->route('complaints.user')->with('success', 'Complaint filed successfully!');
    }

    // Show complaint details
    public function show(Complaint $complaint)
    {
        return view('complaints.show', compact('complaint'));
    }

    // Update complaint status (Admin/Staff only)
    public function updateStatus(Request $request, Complaint $complaint)
    {
        $request->validate([
            'status' => 'required|in:Pending,In Progress,Resolved',
        ]);
    
        // Update the status of the complaint
        $complaint->status = $request->status;
        $complaint->save();
    
        // Flash success message
        return redirect()->route('complaints.index')->with('status', 'Complaint status successfully updated!');
    }
    

    // Show edit form
public function edit(Complaint $complaint)
{
    return view('complaints.edit', compact('complaint'));
}

// Update complaint details
public function update(Request $request, Complaint $complaint)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    $complaint->update([
        'title' => $request->title,
        'description' => $request->description,
    ]);

    return redirect()->route('complaints.index')->with('success', 'Complaint updated successfully!');
}

public function destroy(Complaint $complaint)
{
    if (Auth::id() !== $complaint->user_id) {
        return redirect()->route('complaints.user')->with('error', 'You are not authorized to delete this complaint.');
    }

    $complaint->delete();

    return redirect()->route('complaints.user')->with('success', 'Complaint deleted successfully!');
}


}
