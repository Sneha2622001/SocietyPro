<x-app-layout>
    <div class="container mt-4">
        <h2>Complaint Details</h2>

        <div class="card">
            <div class="card-header">
                <h4>{{ $complaint->title }}</h4>
                <span class="badge bg-{{ $complaint->status == 'Resolved' ? 'success' : ($complaint->status == 'In Progress' ? 'warning' : 'danger') }}">
                    {{ $complaint->status }}
                </span>
            </div>
            <div class="card-body">
                <p><strong>Description:</strong> {{ $complaint->description }}</p>
                <p><strong>Filed By:</strong> {{ $complaint->user->name }}</p>
                <p><strong>Created At:</strong> {{ $complaint->created_at->format('Y-m-d H:i:s') }}</p>
                <p><strong>Updated At:</strong> {{ $complaint->updated_at->format('Y-m-d H:i:s') }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('complaints.edit', $complaint->id) }}" class="btn btn-primary">Edit Complaint</a>

                <form action="{{ route('complaints.destroy', $complaint->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this complaint?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Complaint</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
