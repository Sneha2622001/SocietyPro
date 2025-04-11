<div class="mt-3">
        <h2>Edit Complaint</h2>

        <form action="{{ route('complaints.update', $complaint->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Complaint Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $complaint->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Complaint Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $complaint->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Complaint</button>
            <button type="button" class="btn btn-secondary"  data-bs-dismiss="offcanvas"
            aria-label="Close">Cancel</button>
        </form>
</div>
