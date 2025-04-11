<x-app-layout>
    <div class="container-fluid mt-5 px-3">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h2 class="mb-3 fw-bolder fs-1">Manage Role Permissions</h2>
    
        <form method="POST" action="{{ route('permissions.save') }}">
            @csrf
    
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Permission</th>
                        @foreach($roles as $role)
                            <th class="text-capitalize">{{ $role->name }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($groupedPermissions as $group => $permissions)
                        <tr>
                            <td colspan="{{ count($roles) + 1 }}" class="bg-light fw-bold text-uppercase">
                                {{ ucfirst($group) }} Permissions
                            </td>
                        </tr>

                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                @foreach($roles as $key => $role)
                                    <td class="text-center">
                                        <input type="checkbox" name="permissions[{{ $role->id }}][]" value="{{ $permission->id }}"
                                            {{ $role->hasPermissionTo($permission) ? 'checked' : '' }}>   
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
    
            <button type="submit" class="btn btn-primary mt-3 mb-2">Save Permissions</button>
        </form>
    </div>
</x-app-layout>
