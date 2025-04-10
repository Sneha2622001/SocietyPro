
<div class="row justify-content-center">
    <div class="col">
        <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data" id="userForm">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label ">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label ">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label ">Phone Number</label>
                <input type="text" class="form-control" id="contact" name="contact" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="" disabled selected>Select Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role['id'] }}"
                            {{ old('role') == $role['id'] ? 'selected' : '' }}>
                            {{ ucfirst($role['name']) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <div class="form-check form-switch">
                    <label class="form-check-label " for="flexSwitchCheckDefault">Status</label>
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="status">
                </div>
            </div>
            <div class="mb-3">
                <div class="d-flex align-items-center gap-3">
                    <!-- Styled Upload Button -->
                    <label class="btn btn-outline-primary mb-0">
                        <i class="bi bi-upload"></i> Choose Image
                        <input type="file" id="profile" name="profile" accept="image/*" class="d-none" onchange="previewFile(this);">
                    </label>
            
                    <!-- Preview Image Placeholder -->
                    <img id="newPreview" src="#" alt="Preview" class="img-thumbnail d-none" style="width: 100px; height: 100px;">
                </div>
            </div>
            <button type="submit" class="btn btn-outline-secondary">Submit</button>
            <button type="button" class="btn btn-secondary"  data-bs-dismiss="offcanvas"
            aria-label="Close">Cancel</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function previewFile(input) {
        const file = input.files[0];
        const $preview = $('#newPreview');

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const $oldPreview = $('#previewImage');
                if ($oldPreview.length) {
                    $oldPreview.remove();
                }

                $preview.attr('src', e.target.result).removeClass('d-none');
            };

            reader.readAsDataURL(file);
        }
    }

    $(document).on('submit', 'form#userForm', function(e) {
    e.preventDefault();

    let form = $(this);
    let formData = new FormData(this);

    $.ajax({
        url: form.attr('action'),
        method: form.attr('method'),
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            location.reload(); // or close modal and refresh table
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                form.find('.text-danger').remove(); // Clear old errors

                // Display new validation messages
                $.each(errors, function(key, messages) {
                    let field = form.find('[name="' + key + '"]');
                    field.after('<div class="text-danger">' + messages[0] + '</div>');
                });
            }
        }
    });
});

</script>