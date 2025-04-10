<x-app-layout>
    <div class="container py-4">
        <h2 class="mb-4">Post a New Notice</h2>

        <form action="{{ route('notices.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Notice Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Notice Content</label>
                <textarea name="content" rows="5" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Publish</button>
            <a href="{{ route('notices.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-app-layout>
