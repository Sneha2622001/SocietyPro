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
                <label for="role" class="form-label ">Role</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="" disabled>Select Role</option>
                    @foreach ($roles as $key=>$role)
                        <option value="{{ $role['id'] }}" {{ isset($user) && $user->role_id == $role['id'] ? 'selected' : '' }}>
                            {{ $role['name'] }}
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
            {{-- <div class="mb-3">
                <label for="profile" class="form-label ">Current Profile</label>
                <img src="{{ asset('storage/' . $user->profile) }}" alt="Profile Image" class="img-thumbnail" style="width: 100px; height: 100px;">
            </div> --}}
            <div class="mb-3">
                <label for="profile" class="form-label ">Profile</label>
                <input type="file" id="profile" class="form-control" value="Upload Profile Image" name="profile" accept="image/*">
            </div>
            
            <button type="submit" class="btn btn-outline-secondary">Submit</button>
        </form>
    </div>
</div>
