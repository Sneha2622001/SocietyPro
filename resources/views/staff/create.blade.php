<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Add New Staff</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded">
        <form action="{{ route('staff.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="user_id" class="block">Select User</label>
                <select name="user_id" id="user_id" class="w-full border rounded px-3 py-2">
                    <option value="" disabled selected>Select Staff</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="type" class="block">Type</label>
                <select name="type" class="w-full border rounded px-3 py-2">
                    <option value="Security">Security</option>
                    <option value="Maintenance">Maintenance</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="shift" class="block">Shift</label>
                <input type="text" name="shift" class="w-full border rounded px-3 py-2" placeholder="Morning/Evening/Night">
            </div>

            <button type="submit" class="bg-green-500 btn btn-primary px-4 py-2 rounded">Add Staff</button>
        </form>
    </div>
</x-app-layout>
