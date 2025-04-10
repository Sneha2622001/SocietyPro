<x-app-layout>
    <div class="container py-4">
        <h2 class="mb-4">📢 Notice Board</h2>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Post New Notice Button --}}
        <a href="{{ route('notices.create') }}" class="btn btn-primary mb-4">+ Post New Notice</a>

        {{-- Notice List --}}
        @forelse ($notices as $notice)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-1">{{ $notice->title }}</h5>
                        <small class="text-muted">Posted on {{ $notice->created_at->format('d M Y') }}</small>
                    </div>

                    <p class="card-text mt-2">{{ $notice->content }}</p>

                    <div class="d-flex gap-2 mt-2">
                        {{-- Edit Link --}}
                        <a href="{{ route('notices.edit', $notice) }}" class="btn btn-sm btn-warning">
                            ✏️ Edit
                        </a>

                        {{-- Delete Link --}}
                        <a href="#" class="btn btn-sm btn-danger"
                           onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this notice?')) {
                               document.getElementById('delete-form-{{ $notice->id }}').submit();
                           }">
                            🗑️ Delete
                        </a>

                        {{-- Hidden Delete Form --}}
                        <form id="delete-form-{{ $notice->id }}" action="{{ route('notices.destroy', $notice) }}"
                              method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">
                No notices available.
            </div>
        @endforelse
    </div>
</x-app-layout>
