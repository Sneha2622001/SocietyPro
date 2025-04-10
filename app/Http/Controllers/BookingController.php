<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Facility;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // Check if slot already booked
        $exists = Booking::where('facility_id', $request->facility_id)
            ->where('booking_date', $request->booking_date)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })->exists();

        if ($exists) {
            return redirect()->route('facilities.index')->with('error', 'This slot is already booked.');
        }

        Booking::create([
            'user_id' => auth()->id(),
            'facility_id' => $request->facility_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'amount' => $request->price, // ← This will now work
        ]);

        return back()->with('success', 'Booking submitted for approval.');
    }

    public function adminIndex()
    {
        $bookings = Booking::with(['facility', 'user'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        // $request->validate([
        //     'status' => 'required|in:pending,approved,cancelled',
        // ]);

        $booking->status = $request->status;
        $booking->save();
    
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully.',
                'status' => ucfirst($booking->status),
            ]);
        }
    
        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    public function myBookings()
    {
        $bookings = Booking::with('facility')
            ->where('user_id', Auth::id())
            ->orderByDesc('booking_date')
            ->get();

        return view('bookings.bookings', compact('bookings'));
    }

    public function edit(Booking $booking)
    {
        // Ensure the user owns the booking
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $facilities = Facility::all();

        return view('bookings.edit', compact('booking', 'facilities'));
    }

    public function update(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'price' => 'required|numeric|min:0',
        ]);

        $booking = Booking::findOrFail($booking->id);
        // Check if slot already booked
        $exists = Booking::where('facility_id', $request->facility_id)
            ->where('booking_date', $request->booking_date)
            ->where('id', '!=', $booking->id) // Exclude the current booking
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })->exists();
        if ($exists) {
            return redirect()->route('facilities.index')->with('error', 'This slot is already booked.');
        }
        // Update the booking
        $booking->facility_id = $request->facility_id;
        $booking->booking_date = $request->booking_date;
        $booking->start_time = $request->start_time;
        $booking->end_time = $request->end_time;
        $booking->amount = $request->price;
        // Save the updated booking
        $booking->save();

        return redirect()->route('bookings.bookings')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->delete();

        return redirect()->route('bookings.bookings')->with('success', 'Booking cancelled successfully.');
    }

}
