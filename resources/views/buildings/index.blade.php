<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Buildings List
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="/building/add" class="btn btn-primary mb-3">Add Building</a>

                <table class="table table-bordered w-full">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buildings as $building)
                            <tr>
                                <td>{{ $building->id }}</td>
                                <td>{{ $building->name }}</td>
                                <td>{{ $building->address }}</td>
                                <td>
                                    <a href="{{ route('building.edit', $building->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('building.destroy', $building->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this building?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>                                    
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
