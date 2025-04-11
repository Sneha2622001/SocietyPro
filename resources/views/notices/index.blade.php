<x-app-layout>
    <div class="container-fluid mt-5 px-3">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex justify-content-end align-items-center mb-4">
                    @role('Admin')
                    {{-- Post New Notice Button --}}
                    <a href="{{ route('notices.create') }}" class="btn btn-primary mb-4">Post New Notice</a>
                    @endrole

                </div>
                <h2 class="mb-3 fw-bolder fs-1">📢 Notice Board</h2>

       
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
                                @role('Admin')
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
                                @endrole
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
        </div>
    </div>
</x-app-layout>
