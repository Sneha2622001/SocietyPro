<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <!-- Header with consistent theme -->
                    <div class="card-header bg-dark text-light text-center">
                        <h3 class="fw-bold">User Management</h3>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body bg-dark p-4">
                        <table class="table table-bordered table-striped table-hover text-light">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->contact }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->status }}</td>
                                        <td>
                                            <!-- Action Buttons -->
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                                Edit
                                            </a>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        {{-- {{ $users->links() }} --}}

                        <!-- Add User Button -->
                        {{-- <div class="text-center mt-4">
                            <a href="{{ route('user.add') }}" class="btn btn-primary px-4">
                                Add User
                            </a>
                        </div> --}}

                    </div> <!-- End of Card Body -->
                </div> <!-- End of Card -->
            </div> <!-- End of Column -->
        </div> <!-- End of Row -->
    </div> <!-- End of Container -->
</x-app-layout>