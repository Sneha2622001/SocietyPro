<x-app-layout>
    <div class="container py-4">
        <h2 class="mb-4">Edit Notice</h2>

        <form action="{{ route('notices.update', $notice) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Notice Title</label>
                <input type="text" name="title" class="form-control" value="{{ $notice->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Notice Content</label>
                <textarea name="content" class="form-control" rows="5" required>{{ $notice->content }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('notices.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</x-app-layout>
