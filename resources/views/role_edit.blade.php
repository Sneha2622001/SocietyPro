@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <!-- Header with a refined color scheme -->
                <div class="card-header bg-warning text-white text-center">
                    <h3 class="fw-bold">Edit Role</h3>
                </div>

                <div class="card-body p-4">
                    <!-- Success message -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Role Edit Form -->
                    <form action="{{ route('role.update', $role->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="role_name" class="form-label fw-bold">Role Name</label>
                            <input type="text" class="form-control @error('role_name') is-invalid @enderror" 
                                   id="role_name" name="role_name" value="{{ $role->name }}" required>
                            @error('role_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save"></i> Update Role
                            </button>
                            <a href="{{ route('role') }}" class="btn btn-secondary px-4">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .form-control:focus {
        border-color: #ffcc00;
        box-shadow: 0 0 8px rgba(255, 204, 0, 0.5);
    }
</style>

@endsection
