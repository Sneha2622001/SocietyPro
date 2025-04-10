<x-app-layout>
    <div class="container-fluid mt-5 px-3">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Page Header -->
                <div class="d-flex justify-content-end align-items-center mb-4">
                    <button class="btn addRoleBtn" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#roleFormContent" id="loadroleForm">
                        Add Role
                    </button>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="roleFormContent"
                        aria-labelledby="roleFormContentLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="roleFormContentLabel">Add Role</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body roleForm"></div>
                    </div>
                </div>


                <!-- Roles Table -->
                <h2 class="mb-3 roleMangement">Roles Management</h2>
                <table class="table table-light table-striped table-hover table-bordered text-center align-middle">
                    <thead>
                        <tr class="table-secondary">
                            <th>SL No.</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $index => $role)
                            <tr class="hover-effect">
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $role->name }}</td>
                                <td>
                                    <a href="{{ route('role.edit', $role->id) }}" class="btn btn-edit" type="button" data-bs-toggle="offcanvas"
                                        data-bs-target="#roleEditFormContent" aria-controls="roleEditFormContent" id="loadEditRole">Edit
                                        </a>

                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="roleEditFormContent"
                                        aria-labelledby="roleEditFormContentLabel">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title" id="roleEditFormContentLabel">Edit Role</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body roleEditForm">
                                            
                                        </div>
                                    </div>

                                    <form action="{{ route('role.destroy', $role->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this role?');">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#loadroleForm').on('click', function() {
        $.get("{{ route('role.add') }}", function(data) {
            $('.roleForm').html(data);
        });
    });
    $(document).on('click', '#loadEditRole', function(e) {
          e.preventDefault();
          let url = $(this).attr('href');
          const url_array = url.split('/');
          const roleId = url_array[4];
          const editUrl = "{{ route('role.edit', ':id') }}".replace(':id', roleId);
          $.ajax({
              url: editUrl,
              type: 'GET',
              success: function(data) {
                  $('.roleEditForm').html(data);
              },
              error: function(xhr) {
                  console.error('Error:', xhr.responseText);
              }
          });
      });
</script>


<style>
  .btn-edit {
    border: 2px solid  rgb(235, 206, 15); 
    color: black
  }

    .btn-edit:hover {
        background-color: rgb(235, 206, 15) !important; 
        color: white !important; 
        border: 2px solid  rgb(235, 206, 15); 
    }
    .btn-delete {
        border: 2px solid rgb(169, 5, 5); 
        color: black; 
    }
    .btn-delete:hover {
        background-color: rgb(169, 5, 5) !important; 
        color: white !important; 
        border: 2px solid rgb(169, 5, 5); 
    }

    h2.roleMangement {
        font-size: 22px;
        font-weight: bold;
        color: #343a40;
        text-transform: uppercase;
        border-bottom: 3px solid #ffc107;
        padding-bottom: 5px;
        margin-bottom: 20px;
        display: inline-block;
    }

    .addRoleBtn {
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