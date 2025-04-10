<x-app-layout>
    <div class="container-fluid mt-5 px-3">
        <h2 class="mb-3 fw-bolder fs-1">My Maintenance Bills</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bills as $bill)
                    <tr>
                        <td>{{ $bill->month }}</td>
                        <td>₹{{ $bill->amount }}</td>
                        <td>{{ ucfirst($bill->status) }}</td>
                        <td>{{ $bill->due_date->format('d M Y') }}</td>
                        <td>
                            @if ($bill->status === 'due')
                                <a href="{{ route('bills.pay', $bill->id) }}" class="btn btn-sm btn-primary">Pay Now</a>
                            @else
                                <span class="text-success">Paid</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
