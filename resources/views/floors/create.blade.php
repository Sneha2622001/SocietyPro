<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add New Floor
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('floor.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="building_id" class="form-label">Select Building</label>
                        <select class="form-control" id="building_id" name="building_id" required>
                            <option value="">Choose Building</option>
                            @foreach ($buildings as $building)
                                <option value="{{ $building->id }}">{{ $building->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="floor_number" class="form-label">Floor Number</label>
                        <input type="number" class="form-control" id="floor_number" name="floor_number" required min="1">
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{ route('floor.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
