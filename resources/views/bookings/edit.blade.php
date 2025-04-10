<form method="POST" action="{{ route('bookings.update', $booking) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="facility_id" class="form-label">Facility</label>
        <select name="facility_id" id="facility_id" class="form-select" required>
            @foreach ($facilities as $facility)
                <option value="{{ $facility->id }}" {{ $booking->facility_id == $facility->id ? 'selected' : '' }}>
                    {{ $facility->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="booking_date" class="form-label">Booking Date</label>
        <input type="date" name="booking_date" id="booking_date" class="form-control"
            value="{{ $booking->booking_date->format('Y-m-d') }}" required>
    </div>

    <div class="mb-3">
        <label for="start_time" class="form-label">Start Time</label>
        <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $booking->start_time }}" required>
    </div>

    <div class="mb-3">
        <label for="end_time" class="form-label">End Time</label>
        <input type="time" name="end_time" id="end_time" class="form-control" value="{{ $booking->end_time }}" required>
    </div>

    <input type="hidden" id="hourly_rate" value="{{ $booking->facility->price }}">
    <div class="mb-3">
        <label for="price" class="form-label">Booking Price</label>
        <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ $booking->amount }}" readonly>
    </div>

    <button type="submit" class="btn btn-primary">Update Booking</button>
    <button type="button" class="btn btn-secondary"  data-bs-dismiss="offcanvas"
    aria-label="Close">Cancel</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        const $startTimeInput = $('input[name="start_time"]');
        const $endTimeInput = $('input[name="end_time"]');
        const $priceInput = $('#price');
        const hourlyRate = parseFloat($('#hourly_rate').val());

        function calculatePrice() {
            const startTime = $startTimeInput.val();
            const endTime = $endTimeInput.val();

            if (startTime && endTime) {
                const [startHours, startMinutes] = startTime.split(':').map(Number);
                const [endHours, endMinutes] = endTime.split(':').map(Number);

                const startDate = new Date(1970, 0, 1, startHours, startMinutes);
                const endDate = new Date(1970, 0, 1, endHours, endMinutes);

                const diffInHours = (endDate - startDate) / (1000 * 60 * 60);

                if (diffInHours > 0) {
                    const totalPrice = (diffInHours * hourlyRate).toFixed(2);
                    $priceInput.val(totalPrice);
                } else {
                    // Reset price if time range is invalid
                    $priceInput.val('');
                }
            }
        }

        $startTimeInput.on('input', calculatePrice);
        $endTimeInput.on('input', calculatePrice);
    });
</script>
