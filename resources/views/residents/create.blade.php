<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add New Resident
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('residents.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="unit_id" class="form-label">Select Unit</label>
                        <select class="form-control" id="unit_id" name="unit_id" required>
                            <option value="" disabled selected>Select the Unit</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->unit_number }}</option>
                            @endforeach
                        </select>
                        @error('unit_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Resident Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact" required>
                        @error('contact')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{ route('residents.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
