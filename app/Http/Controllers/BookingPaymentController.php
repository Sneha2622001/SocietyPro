<?php

namespace App\Http\Controllers;

use Razorpay\Api\Api;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingPaymentController extends Controller
{
    public function initiatePayment(Booking $booking)
    {
        $razorpay = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $order = $razorpay->order->create([
            'receipt' => 'booking_' . $booking->id,
            'amount' => $booking->amount * 100,
            'currency' => 'INR',
        ]);

        session()->put('razorpay_booking_id', $booking->id);

        return view('payment.booking-payment', [
            'order' => $order,
            'booking' => $booking,
            'key' => config('services.razorpay.key'),
        ]);
    }

    public function handleCallback(Request $request)
    {
        $bookingId = session()->pull('razorpay_booking_id');
        $booking = Booking::findOrFail($bookingId);

        // Optional: verify Razorpay signature here

        $booking->update(['payment_status' => 'paid']);

        return redirect()->route('bookings.bookings')->with('success', 'Payment successful!');
    }
}
