<x-app-layout>
<div class="container-fluid mt-5 px-3">
    <h2 class="mb-3 fw-bolder fs-1">Financial Report - {{ ucfirst($type) }}</h2>

    <form method="GET" class="mb-4">
        <select name="type" onchange="this.form.submit()" class="form-select w-auto d-inline">
            <option value="monthly" {{ $type === 'monthly' ? 'selected' : '' }}>Monthly</option>
            <option value="quarterly" {{ $type === 'quarterly' ? 'selected' : '' }}>Quarterly</option>
            <option value="yearly" {{ $type === 'yearly' ? 'selected' : '' }}>Yearly</option>
        </select>
    </form>

    <div class="card shadow p-3">
        <canvas id="incomeChart" style="height: 400px;"></canvas>
    </div>
</div>

</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('incomeChart').getContext('2d');

    const data = {
        labels: {!! json_encode(array_keys($maintenanceIncome->toArray())) !!},
        datasets: [
            {
                label: 'Maintenance Income',
                data: {!! json_encode(array_values($maintenanceIncome->toArray())) !!},
                borderColor: 'blue',
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                tension: 0.4,
                fill: true,
            },
            {
                label: 'Facility Booking Income',
                data: {!! json_encode(array_values($bookingIncome->toArray())) !!},
                borderColor: 'green',
                backgroundColor: 'rgba(40, 167, 69, 0.2)',
                tension: 0.4,
                fill: true,
            }
        ]

    };

    new Chart(ctx, {
        type: 'line',
        data: data,
    });
</script>

