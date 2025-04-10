<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow rounded-4">
                    <div class="card-body text-center p-4">
                        <h3 class="card-title mb-4 fw-bold">Pay Maintenance Bill</h3>

                        <p class="fs-5">
                            <strong>Amount:</strong>
                            <span class="text-success">₹{{ $bill->amount }}</span>
                        </p>

                        <form action="{{ route('payment.callback') }}" method="POST">
                            @csrf
                            <script
                                src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="{{ $key }}"
                                data-amount="{{ $order->amount }}"
                                data-currency="INR"
                                data-order_id="{{ $order->id }}"
                                data-buttontext="Pay with Razorpay"
                                data-name="SocietyPro"
                                data-description="Maintenance Bill Payment"
                                data-image=""
                                data-prefill.name="{{ auth()->user()->name }}"
                                data-prefill.email="{{ auth()->user()->email }}"
                                data-theme.color="#528FF0">
                            </script>

                            <input type="hidden" name="bill_id" value="{{ $bill->id }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
