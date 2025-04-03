
<div class="row justify-content-center">
    <div class="col">
        <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label ">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label ">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label ">Phone Number</label>
                <input type="text" class="form-control" id="contact" name="contact" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label ">Role</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="" disabled selected>Select Role</option>
                    @foreach ($roles as $key=>$role)
                        <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
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
              <label for="profile" class="form-label ">Profile</label>
              <input type="file" id="profile" class="form-control" value="Upload Profile Image" name="profile" accept="image/*">
            </div>
            <button type="submit" class="btn btn-outline-secondary">Submit</button>
        </form>
    </div>
</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            console.log(input.files[0]);
            // reader.readAsDataURL(input.files[0]); 
            console.log(reader);
        }
    }
    
    $(document).on("change", "#profile", function () {
        readURL(this);
    });
</script> --}}