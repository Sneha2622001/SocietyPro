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
                        <a href="{{ route('staff.create') }}" class="btn btn-primary">Add Staff</a>
                    @endrole
                </div>
                <h2 class="mb-3 fw-bolder fs-1">Staff Management</h2>
               
                <table class="w-full table-auto border text-sm">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="border px-4 py-2">Name</th>
                            <th class="border px-4 py-2">Email</th>
                            <th class="border px-4 py-2">Role</th>
                            <th class="border px-4 py-2">Contact</th>
                            <th class="border px-4 py-2">Type</th>
                            <th class="border px-4 py-2">Shift</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($staff as $member)
                            <tr>
                                <td class="border px-4 py-2">{{ $member->user->name }}</td>
                                <td class="border px-4 py-2">{{ $member->user->email }}</td>
                                <td class="border px-4 py-2">
                                    {{ $member->user->getRoleNames()->join(', ') }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $member->user->contact ?? 'N/A' }}
                                </td>
                                <td class="border px-4 py-2">{{ $member->type }}</td>
                                <td class="border px-4 py-2">{{ $member->shift }}</td>
                                <td class="border px-4 py-2 space-x-2">
                                    <a href="{{ route('staff.show', $member->id) }}" class="text-blue-500">👁️ View</a>

                                    @role('Admin')
                                        <a href="{{ route('staff.edit', $member->id) }}" class="text-yellow-500">✏️ Edit</a>

                                        <a href="#" class="text-red-500"
                                        onclick="event.preventDefault(); if (confirm('Are you sure?')) {
                                            document.getElementById('delete-form-{{ $member->id }}').submit();
                                        }">🗑️ Delete</a>

                                        <form id="delete-form-{{ $member->id }}" action="{{ route('staff.destroy', $member->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endrole
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-gray-500 py-4">No staff members found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
