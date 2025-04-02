<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('File a New Complaint') }} --}}
            Create a new complaint
        </h2>
    </x-slot>

    <div class="container py-4">
        <form action="{{ route('complaints.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Complaint Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Complaint Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Submit Complaint</button>
        </form>
    </div>
</x-app-layout>
