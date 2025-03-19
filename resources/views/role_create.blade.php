@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <!-- Header with consistent theme -->
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="fw-bold">Add New Role</h3>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4">
                    <form action="{{ route('role.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-4">
                            <label for="role_name" class="form-label fw-bold">Role Name</label>
                            <input type="text" class="form-control @error('role_name') is-invalid @enderror" 
                                   id="role_name" name="role_name" placeholder="Enter role name" required>
                            @error('role_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-save"></i> Save Role
                            </button>
                            <a href="{{ route('role') }}" class="btn btn-secondary px-4">
                                <i class="fas fa-times"></i> Cancel
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
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
    }
</style>

@endsection
