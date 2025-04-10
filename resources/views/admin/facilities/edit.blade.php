<form method="POST" action="{{ route('facilities.update' , $facility->id)}}" >
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Facility Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $facility->name}}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description (optional)</label>
        <textarea name="description" id="description" class="form-control">{{ $facility->description }}</textarea>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Hourly Rate</label>
        <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ $facility->price }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Facility</button>
    <button type="button" class="btn btn-secondary"  data-bs-dismiss="offcanvas"
    aria-label="Close">Cancel</button>
</form>
