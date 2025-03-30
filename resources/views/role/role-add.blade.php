<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <!-- Header with consistent theme -->
                    <div class="card-header bg-dark text-light text-center">
                        <h3 class="fw-bold">Add New Role</h3>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body bg-dark p-4">
                        <form action="{{ route('role.add') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="mb-4">
                                <label for="role_name" class="form-label fw-bold text-light">Role Name</label>
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
                                <a href="{{ route('roles') }}" class="btn btn-secondary px-4">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>