<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow rounded-4">
                    <div class="card-body text-center p-4">
                        <h3 class="card-title mb-4 fw-bold">Pay for Booking</h3>

                        <p class="fs-5">
                            <strong>Amount:</strong>
                            <span class="text-success">₹{{ $booking->amount }}</span>
                        </p>

                        <form action="{{ route('bookings.payment.callback') }}" method="POST">
                            @csrf
                            <script
                                src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="{{ $key }}"
                                data-amount="{{ $booking->amount * 100 }}"
                                data-currency="INR"
                                data-order_id="{{ $order->id }}"
                                data-buttontext="Pay Now"
                                data-name="SocietyPro"
                                data-description="Facility Booking Payment"
                                data-prefill.name="{{ auth()->user()->name }}"
                                data-prefill.email="{{ auth()->user()->email }}"
                                data-theme.color="#0d6efd">
                            </script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
