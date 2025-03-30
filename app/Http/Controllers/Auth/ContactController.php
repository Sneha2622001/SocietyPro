<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Update the user's Contact.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'phone' => 'required|string|max:15',
        ]);
        $request->user()->update([
            'contact' => $request->phone,
        ]);
        return back()->with('status', 'contact-updated');
    }
}
