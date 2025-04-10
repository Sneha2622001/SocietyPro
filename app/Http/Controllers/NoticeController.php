<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NoticeController extends Controller
{
    // View All Notices - Everyone can access
    public function index()
    {
        $notices = Notice::latest()->get();
        return view('notices.index', compact('notices'));
    }

    // Show Create Form (Admins only)
    public function create()
    {

        return view('notices.create');
    }

    // Store Notice and Send Email to All Residents
    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $notice = Notice::create([
            'title' => $request->title,
            'content' => $request->content,
            'created_by' => Auth::id(),
        ]);

        // Email Notification to All Residents
        $user = new User;
        $residents = $user->getRoleNames();
        // Assuming you have a role named 'resident'
        // You can fetch all residents like this:

        $residents =  User::all()->filter(function ($user) {
            return $user->hasRole('Resident');
        });


        foreach ($residents as $resident) {
            Mail::raw("New Notice: {$notice->title}\n\n{$notice->content}", function ($message) use ($resident) {
                $message->to($resident->email)
                    ->subject('New Community Notice');
            });
        }

        return redirect()->route('notices.index')->with('success', 'Notice posted and residents notified!');
    }

    // Show Single Notice
    public function show(Notice $notice)
    {
        return view('notices.show', compact('notice'));
    }

    // Edit Form (Admin only)
    public function edit(Notice $notice)
    {

        return view('notices.edit', compact('notice'));
    }

    // Update Notice (Admins only)
    public function update(Request $request, Notice $notice)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $notice->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('notices.index')->with('success', 'Notice updated successfully.');
    }

    // Delete Notice (Admins only)
    public function destroy(Notice $notice)
    {
        $notice->delete();
        return redirect()->route('notices.index')->with('success', 'Notice deleted successfully.');
    }
}
