<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Unit
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('units.update', $unit->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="floor_id" class="form-label">Select Floor</label>
                        <select class="form-control" id="floor_id" name="floor_id" required>
                            @foreach ($floors as $floor)
                                <option value="{{ $floor->id }}" {{ $unit->floor_id == $floor->id ? 'selected' : '' }}>
                                    {{ $floor->floor_number }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="unit_number" class="form-label">Unit Number</label>
                        <input type="text" class="form-control" id="unit_number" name="unit_number" value="{{ $unit->unit_number }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="unit_type" class="form-label">Unit Type</label>
                        <input type="text" class="form-control" id="unit_type" name="unit_type" value="{{ $unit->unit_type }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="size" class="form-label">Size (sqft)</label>
                        <input type="number" class="form-control" id="size" name="size" value="{{ $unit->size }}">
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('units.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
