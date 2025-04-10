<div class="row justify-content-center">
    <div class="col">
        <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label ">Name</label>
                <input type="text" class="form-control" id="name" name="name" value={{$user->name ?? $user->name}} required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label ">Email</label>
                <input type="email" class="form-control" id="email" name="email" value={{$user->email ?? $user->email}} required>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label ">Phone Number</label>
                <input type="text" class="form-control" id="contact" name="contact" value={{$user->contact ?? $user->contact}} required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="" disabled {{ !isset($user) ? 'selected' : '' }}>Select Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role['id'] }}"
                            {{ isset($user) && $user->roles->first()?->name == $role['name'] ? 'selected' : '' }}>
                            {{ ucfirst($role['name']) }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <div class="form-check form-switch">
                    <label class="form-check-label " for="flexSwitchCheckDefault">Status</label>
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="status" {{$user->status == 1 ? "checked" : ""}}>
                </div>
            </div>
            @if ($user->profile)
                <div class="mb-3" id="oldImageWrapper">
                    <div class="position-relative d-inline-block mb-3" style="width: 100px; height: 100px;">
                        <img src="{{ asset('storage/' . $user->profile) }}" alt="Profile" class="img-thumbnail w-100 h-100" id="previewImage" style="object-fit: cover;">
                        <button type="button"
                            class="btn btn-sm btn-danger rounded-circle position-absolute top-0 start-100 translate-middle"
                            aria-label="Remove"
                            onclick="removeImagePreview(event)"
                            style="z-index: 10; padding: 2px 6px;">
                            &times;
                        </button>
                        <!-- Hidden input to signal image removal -->
                        <input type="hidden" name="remove_image" id="removeImageInput" value="0">
                    </div>
                </div>
            @endif
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
            
            
            <button type="submit" class="btn btn-outline-secondary">Update</button>
            <button type="button" class="btn btn-secondary"  data-bs-dismiss="offcanvas"
            aria-label="Close">Cancel</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function removeImagePreview(event) {
        const $previewImage = $('#previewImage');
        const $newPreviewImage = $('#newPreview');
        const $removeInput = $('#removeImageInput');
        if ($previewImage.length) {
            $previewImage.remove();
            $('#oldImageWrapper').remove();
        }

        if ($newPreviewImage.length) {
            $newPreviewImage.addClass('d-none').attr('src', '#');
        }

        if ($removeInput.length) {
            $removeInput.val(1);
        }

        $(event.target).closest('button').remove();
    }

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
</script>
