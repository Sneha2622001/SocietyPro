<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Your Complaints
        </h2>
    </x-slot>

    <div class="container py-4">
        <!-- Add Complaint Button -->
        <a href="{{ route('complaints.create') }}" class="btn btn-success mb-3">Add New Complaint</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($complaints as $complaint)
                <tr>
                    <td>{{ $complaint->title }}</td>
                    <td>{{ $complaint->description }}</td>
                    <td>{{ $complaint->status }}</td>
                    <td>
                        <a href="{{ route('complaints.show', $complaint->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('complaints.edit', $complaint->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('complaints.destroy', $complaint->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this complaint?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
