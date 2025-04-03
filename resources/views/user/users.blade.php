<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
              <div class="d-flex justify-content-end align-items-center mb-4">
                <button class="btn bg-body-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#userFormContent" id="loadUserForm" aria-controls="offcanvasRight">Add User</button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="userFormContent" aria-labelledby="userFormContentLabel">
                  <div class="offcanvas-header">
                    <h5 class="offcanvas-title " id="userFormContentLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body userFormContentLabel bg-light"></div>
                </div>
              </div>
                <h2 class="fw-bold  mb-3">User Management</h2>
                 <!-- Search Form -->
                 <form action="{{ route('user.search') }}" method="GET" class="d-flex mb-4 gap-3 align-items-center">
                    <!-- Search Input -->
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search users..." value="{{ request('search') }}">
                    </div>
                    
                    <!-- Search Button -->
                    <button type="submit" class="btn btn-outline-secondary">
                        <i class="bi bi-search"></i> Search
                    </button>
                
                    <!-- Reset Button -->
                    <a href="{{ route('users') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i> Reset
                    </a>
                </form>
                

                <!-- Filters -->
                <div class="d-flex justify-content-between mb-4">
                    <form action="{{ route('user.search') }}" method="GET" id="combinedFilterForm" class="d-flex align-items-center gap-3">
                        
                        <!-- Role Filter -->
                        <div class="input-group">
                            <select name="role" class="form-select" onchange="document.getElementById('combinedFilterForm').submit();">
                                <option value="">All Roles</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role['id'] }}" {{ request('role') == $role['id'] ? 'selected' : '' }}>
                                        {{ $role['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                
                        <!-- Status Filter -->
                        <div class="input-group">
                            <select name="status" class="form-select" onchange="document.getElementById('combinedFilterForm').submit();">
                                <option value="">All Status</option>
                                <option value="1" {{ request('status') == "1" ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') == "0" ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                
                        <!-- Clear Button -->
                        <a href="{{ route('users') }}" class="btn btn-outline-secondary ms-2">Clear</a>
                    </form>
                </div>
                
                
                <table class="table table-light table-striped table-hover table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Profile</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->profile }}</td>
                                <td class="text-nowrap">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->contact }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td>{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>
                                <td class="d-flex gap-2">
                                    <!-- Action Buttons -->
                                    <a href={{route('user.edit', $user->id)}} class="btn btn-outline-warning btn-sm" data-bs-toggle="offcanvas" data-bs-target="#editUserFormContent" id="loadEditUserForm" aria-controls="offcanvasRight">
                                        Edit
                                    </a>
                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="editUserFormContent" aria-labelledby="editUserFormContentLabel">
                                        <div class="offcanvas-header">
                                          <h5 class="offcanvas-title" id="editUserFormContentLabel">Edit User</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body bg-light modaleditUserForm"></div>
                                    </div>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                {{-- {{ $users->links() }} --}}

            </div> 
        </div> 
    </div> 
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $('#loadUserForm').on('click', function() {
      $.get("{{ route('user.add') }}", function(data) {
          $('.userFormContentLabel').html(data);
      });
  });
  $(document).on('click', '#loadEditUserForm', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        const url_array = url.split('/');
        const userId = url_array[4];
        const editUrl = "{{ route('user.edit', ':id') }}".replace(':id', userId);
        $.ajax({
            url: editUrl,
            type: 'GET',
            success: function(data) {
                $('.modaleditUserForm').html(data);
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
            }
        });
    });
</script>

<style>
        h2 {
        font-size: 22px;
        font-weight: bold;
        text-transform: uppercase;
        color: black;
        border-bottom: 3px solid #ae1302;
        padding-bottom: 5px;
        display: inline-block;
    }
    .btnAddUser{
    font-size: 17px;
        font-weight: bold;
        color: #343a40;
        text-transform: capitalize;
        border-left: 4px solid #a9a8a7c0;
        padding-left: 10px;
        margin-bottom: 15px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
    }
</style>