<form method="POST" action="{{ route('facilities.store') }}">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Facility Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description (optional)</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Hourly Rate</label>
        <input type="number" step="0.01" name="price" id="price" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Add Facility</button>
</form>

