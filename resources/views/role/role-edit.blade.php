<div class="mt-3">

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Role Edit Form -->
    <form action="{{ route('role.update', $role->id) }}" method="POST" class="needs-validation p-3" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="role_name" class="form-label fw-bold">Role Name</label>
            <input type="text" class="form-control @error('role_name') is-invalid @enderror" 
                id="role_name" name="role_name" value="{{ $role->name }}" required>
            @error('role_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-update px-4 fw-bold">
                <i class="fas fa-save me-1"></i> Update
            </button>
            <button type="button" class="btn btn-secondary"  data-bs-dismiss="offcanvas"
            aria-label="Close">Cancel</button>
        </div>
    </form>
</div>

<style>
   
    .btn-update {
    border: 2px solid rgb(1, 101, 1); 
    color: black
    }

    .btn-update:hover {
        background-color: rgb(1, 101, 1) !important; 
        color: white !important; 
        border: 2px solid  rgb(1, 101, 1); 
    }
    .btn-delete {
        margin-left: 10px;
        border: 2px solid rgb(169, 5, 5); 
        color: black; 
    }
    .btn-delete:hover {
        background-color: rgb(169, 5, 5) !important; 
        color: white !important; 
        border: 2px solid rgb(169, 5, 5); 
    }
</style>
