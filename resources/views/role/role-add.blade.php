<div class="mt-3">

        <form action="{{ route('role.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf

        <div class="mb-3">
            <label for="role_name" class="form-label fw-bold">Role Name</label>
            <input type="text" class="form-control @error('role_name') is-invalid @enderror" 
                id="role_name" name="role_name" placeholder="Enter role name" required>
            @error('role_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-save px-4 fw-bold">
                <i class="fas fa-save me-1"></i> Save
            </button>
            <button type="button" class="btn btn-cancel px-4 fw-bold" data-bs-dismiss="offcanvas">
                <i class="fas fa-times me-1"></i> Cancel
            </button>
        </div>
    </form>
</div>


<style>
    .btn-save {
    border: 2px solid rgb(1, 101, 1); 
    color: black
    }

    .btn-save:hover {
        background-color: rgb(1, 101, 1) !important; 
        color: white !important; 
        border: 2px solid  rgb(1, 101, 1); 
    }
    .btn-cancel {
        margin-left: 10px;
        border: 2px solid rgb(169, 5, 5); 
        color: black; 
    }
    .btn-cancel:hover {
        background-color: rgb(169, 5, 5) !important; 
        color: white !important; 
        border: 2px solid rgb(169, 5, 5); 
    }
</style>

