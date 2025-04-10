<x-app-layout>
    <div class="container-fluid mt-5 px-3">
        <h2 class="mb-3 fw-bolder fs-1">My Bookings</h2>
        @if ($bookings->isEmpty())
            <p>You have no bookings yet.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Facility</th>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->facility->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                                <td>{{ $booking->start_time }}</td>
                                <td>{{ $booking->end_time }}</td>
                                <td>
                                    <span class="badge bg-{{ $booking->status === 'approved' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>                                
                                <td class="justify-content-center">     
                                    Rs {{ $booking->amount }}                                    
                                </td>        
                                <td>
                                    @if ($booking->payment_status === 'due')
                                        <a href="{{ route('bookings.pay', $booking->id) }}" class="btn btn-sm btn-primary">Pay Now</a>
                                    @else
                                        <span class="badge bg-success">Paid</span>
                                    @endif
                                </td>  
                                <td>
                                    <a href="{{ route('bookings.edit', $booking) }}"
                                        class="btn btn-sm btn-warning loadEditBookingForm"
                                        data-id="{{ $booking }}"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#bookingEditFormContent"
                                        aria-controls="bookingEditFormContent">
                                            Edit
                                        </a>
                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="bookingEditFormContent"
                                        aria-labelledby="bookingEditFormContentLabel">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title" id="bookingEditFormContentLabel">Edit Booking</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body bookingEditForm"></div>
                                    </div>

                                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                    </form>
                                </td>                 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('click', '.loadEditBookingForm', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');

        $.ajax({
            url: url,
            method: 'GET',
            beforeSend: function () {
                $('.bookingEditForm').html('<div class="text-center">Loading...</div>');
            },
            success: function (response) {
                $('.bookingEditForm').html(response);
            },
            error: function () {
                $('.bookingEditForm').html('<div class="text-danger">Failed to load form.</div>');
            }
        });
    });
</script>
