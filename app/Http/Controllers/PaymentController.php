<?php

namespace App\Http\Controllers;

use Razorpay\Api\Api;
use Illuminate\Support\Str;
use App\Models\MaintenanceBill;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay(MaintenanceBill $bill)
    {
        if ($bill->status === 'paid') {
            return redirect()->route('bills.index')->with('info', 'Bill already paid.');
        }
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $order = $api->order->create([
            'receipt' => Str::random(20),
            'amount' => $bill->amount * 100, // in paise
            'currency' => 'INR',
        ]);

        return view('payment.pay', [
            'bill' => $bill,
            'order' => $order,
            'key' => config('services.razorpay.key'),
        ]);
    }

    public function callback(Request $request)
    {
        $bill = MaintenanceBill::find($request->bill_id);
        if (!$bill) {
            return redirect()->route('bills.index')->with('error', 'Bill not found.');
        }

        // Verify signature (simplified version)
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // Mark as paid
            $bill->update([
                'status' => 'paid',
                'paid_at' => now(),
                'payment_method' => 'razorpay',
                'receipt_number' => 'RZP-' . strtoupper(Str::random(8)),
            ]);

            return redirect()->route('bills.index')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return redirect()->route('bills.index')->with('error', 'Payment verification failed.');
        }
    }
}

