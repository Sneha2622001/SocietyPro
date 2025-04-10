<x-app-layout>
    <div class="container-fluid mt-5 px-3">
        <h2 class="mb-3 fw-bolder fs-1">All Bookings</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Facility</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Payment Status</th>
                        <th>Status</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->facility->name }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                        <td>{{ $booking->payment_status == "paid" ? "Paid" : "Pending" }}</td>
                        <td class="status-text-{{ $booking->id }}">
                            @if ($booking->status === 'pending')
                                Pending
                            @elseif ($booking->status === 'approved')
                                Approved
                            @elseif ($booking->status === 'cancelled')
                                Cancelled
                            @else
                                Unknown
                            @endif
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.bookings.updateStatus', $booking->id) }}" class="update-status-form" data-id="{{$booking->id}}">
                                @csrf
                                <select name="status" class="form-select">
                                    <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $booking->status === 'approved' ? 'selected' : '' }}>Approve</option>
                                    <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancel</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.update-status-form select[name="status"]').on('change', function () {
            let $form = $(this).closest('form');
            let bookingId = $form.data('id');
            let url = $form.attr('action');
            let status = $(this).val();
            let token = $form.find('input[name="_token"]').val();
            // Perform AJAX request to update the booking status
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: token,
                    status: status
                },
                success: function (response) {
                    alert(response.message);
                    let newStatus = status.charAt(0).toUpperCase() + status.slice(1);
                    $('.status-text-' + bookingId).text(newStatus);
                },
                error: function () {
                    alert('Failed to update status');
                }
            });
        });
    });
</script>
