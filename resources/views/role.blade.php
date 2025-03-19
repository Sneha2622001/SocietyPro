@extends('layouts.app')

@section('content')
<div class="container-fluid mt-5 px-3">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-primary">Existing Roles</h3>
                <a href="{{ route('role.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus"></i> Add Role
                </a>
            </div>

            <!-- Roles Table -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center fw-bold">
                    <h4>Role Management</h4>
                </div>
                <div class="card-body p-4">
                    <table class="table table-hover table-bordered text-center align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Role Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $index => $role)
                                <tr class="hover-effect">
                                    <td>{{ $index + 1 }}</td>
                                    <td class="fw-bold">{{ $role->name }}</td>
                                    <td>
                                        <a href="{{ route('role.edit', $role->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('role.destroy', $role->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this role?');">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    .hover-effect:hover {
        background-color: rgba(0, 123, 255, 0.1);
        transition: 0.3s ease-in-out;
    }
</style>

@endsection
