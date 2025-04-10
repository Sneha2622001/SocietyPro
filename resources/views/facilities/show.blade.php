<form method="POST" action="{{ route('bookings.store') }}">
    @csrf
    <input type="hidden" name="facility_id" value="{{ $facility->id }}">
    <div class="mb-3">
        <label>Date</label>
        <input type="date" name="booking_date" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Start Time</label>
        <input type="time" name="start_time" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>End Time</label>
        <input type="time" name="end_time" class="form-control" required>
    </div>
    <input type="hidden" id="hourly_rate" value="{{ $facility->price }}">

    <div class="mb-3">
        <label for="price" class="form-label">Booking Price</label>
        <input type="number" step="0.01" name="price" id="price" class="form-control" readonly>
    </div>

    <button class="btn btn-primary">Book</button>
    <button type="button" class="btn btn-secondary"  data-bs-dismiss="offcanvas"
    aria-label="Close">Cancel</button>
</form>

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
                const start = new Date(`1970-01-01T${startTime}:00`);
                const end = new Date(`1970-01-01T${endTime}:00`);
                const diffInHours = (end - start) / (1000 * 60 * 60);

                if (diffInHours > 0) {
                    $priceInput.val((diffInHours * hourlyRate).toFixed(2));
                } else {
                    $priceInput.val('');
                }
            }
        }

        $startTimeInput.on('input', calculatePrice);
        $endTimeInput.on('input', calculatePrice);
    });

</script>

