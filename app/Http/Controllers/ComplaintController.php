<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ComplaintStatusChanged;
use Illuminate\Support\Facades\Mail;

class ComplaintController extends Controller
{
    // Show all complaints for admin/staff
    public function index()
    {
        $complaints = Complaint::latest()->get();
        return view('admin.complaints.index', compact('complaints'));
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

    public function updateStatus(Request $request, Complaint $complaint)
    {
        $request->validate([
            'status' => 'required|in:Pending,In Progress,Resolved',
        ]);

        $oldStatus = $complaint->status;
        $complaint->update(['status' => $request->status]);

        if ($oldStatus !== $complaint->status && $complaint->user) {
            $complaint->user->notify(new ComplaintStatusChanged($complaint));
            Mail::raw("Your complaint (ID: {$complaint->id}) status has been updated to: {$complaint->status}", function ($message) use ($complaint) {
                $message->to($complaint->user->email)->subject('Complaint Status Updated');
            });
        }

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Status updated.']);
        }

        return back()->with('success', 'Complaint status updated successfully.');
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

        return redirect()->back()->with('success', 'Complaint updated successfully!');
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
