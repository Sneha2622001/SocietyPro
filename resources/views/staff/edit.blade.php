<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Edit Staff Member</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded max-w-2xl mx-auto">
        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            {{-- {{ dd($staff) }} --}}
        <form action="{{ route('staff.update', $staff->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="user_id" class="block font-medium text-sm text-gray-700">User</label>
                <select name="user_id" id="user_id" class="w-full border rounded px-3 py-2 mt-1" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $staff->user_id ? 'selected' : '' }}>
                            {{ $user->name }} 
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="type" class="block font-medium text-sm text-gray-700">Type</label>
                <select name="type" id="type" class="w-full border rounded px-3 py-2 mt-1">
                    <option value="">-- Select Type --</option>
                    <option value="Security" {{ $staff->type === 'Security' ? 'selected' : '' }}>Security</option>
                    <option value="Maintenance" {{ $staff->type === 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="shift" class="block font-medium text-sm text-gray-700">Shift</label>
                <input type="text" name="shift" id="shift" value="{{ old('shift', $staff->shift) }}"
                       class="w-full border rounded px-3 py-2 mt-1" placeholder="e.g. Morning, Night, etc.">
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('staff.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
