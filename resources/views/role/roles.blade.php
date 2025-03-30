<x-app-layout>
  <div class="container-fluid mt-5 px-3">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <!-- Page Header -->
        <div class="d-flex justify-content-end align-items-center mb-4">
          <a href="{{ route('role.add') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Role
          </a>
        </div>

        <!-- Roles Table -->
        <h2 class="text-white mb-3">Roles Management</h2>
        <table class="table table-dark table-hover table-bordered text-center align-middle">
          <thead class="table-dark">
            <tr>
              <th>SL No.</th>
              <th>Role</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($roles as $index => $role)
              <tr class="hover-effect">
                <td>{{ $index + 1 }}</td>
                <td class="fw-bold">{{ $role->name }}</td>
                <td>
                  <a href="{{ route('role.edit', $role->id) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="{{ route('role.destroy', $role->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
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