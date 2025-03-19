@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h3 class="fw-bold text-primary">User Management</h3>
        <button class="btn btn-success px-4 text-white" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="fas fa-user-plus"></i> Add User
        </button>
    </div>

    <!-- Search & Filter Row -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" id="searchUser" class="form-control" placeholder="Search by name or email" onkeyup="filterUsers()">
        </div>
        <div class="col-md-3">
            <select id="roleFilter" class="form-select" onchange="filterUsers()">
                <option value="">All Roles</option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- User Table -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>Phone Number</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ route('users.show', $user->id) }}" class="text-primary fw-bold">
                                        {{ e($user->name) }}
                                    </a>
                                </td>
                                <td>{{ e($user->email) }}</td>
                                <td>{{ e($user->phone) }}</td>
                                <td>{{ optional($user->role)->name ?? 'No Role Assigned' }}</td>
                                <td>
                                    <span class="badge bg-{{ $user->status == 'Active' ? 'success' : 'danger' }}">
                                        {{ e($user->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm text-white">
                                        <i class="fas fa-edit"></i> Update
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm text-white" onclick="return confirm('Are you sure?');">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($users->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center text-muted">No users found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" id="name" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" id="phone" class="form-control" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select id="role" class="form-select" name="role_id" required>
                            <option value="" disabled selected>Select Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" class="form-select" name="status" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success px-4">Save</button>
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles for z-index Issues -->
<style>
    .modal {
        z-index: 1050 !important;
    }

    .modal-backdrop {
        z-index: 1040 !important;
    }

    .dropdown-menu, .form-select {
        z-index: 1051 !important;
    }

    .table-responsive {
        overflow: visible !important;
        position: relative;
        z-index: 1;
    }
</style>

<!-- JavaScript for Filtering Users -->
<script>
    function filterUsers() {
        let search = document.getElementById('searchUser').value.toLowerCase().trim();
        let roleFilter = document.getElementById('roleFilter').value.toLowerCase().trim();
        let rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            let name = row.cells[1].textContent.toLowerCase().trim();
            let email = row.cells[2].textContent.toLowerCase().trim();
            let role = row.cells[4].textContent.toLowerCase().trim();

            let matchesSearch = name.includes(search) || email.includes(search);
            let matchesRole = roleFilter === "" || role.includes(roleFilter);

            row.style.display = matchesSearch && matchesRole ? '' : 'none';
        });
    }
</script>

@endsection
