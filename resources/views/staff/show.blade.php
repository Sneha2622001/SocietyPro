<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">Staff Details</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded">
        <a href="{{ route('staff.index') }}" class="text-blue-500 mb-4 inline-block">← Back to Staff List</a>
        @if ($staff)
            <div class="mb-4">
                <p><strong>Name:</strong> {{ $staff->user->name }}</p>
                <p><strong>Email:</strong> {{ $staff->user->email }}</p>
                <p><strong>Contact:</strong> {{ $staff->user->contact ?? 'N/A' }}</p>
            </div>
        @else
            <div class="mb-4 text-red-500">
                User information not found for this staff member.
            </div>
        @endif

        <div class="mb-4">
            <p><strong>Type:</strong> {{ $staff->type ?? 'N/A' }}</p>
            <p><strong>Shift:</strong> {{ $staff->shift ?? 'N/A' }}</p>
        </div>
    </div>
</x-app-layout>
