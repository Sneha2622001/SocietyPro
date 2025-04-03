<form action="{{ route('residents.update', $resident->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="unit_id" class="form-label">Select Unit</label>
        <select class="form-control" id="unit_id" name="unit_id" required>
            <option value="" disabled>Select the Unit</option>
            @foreach ($units as $unit)
                <option value="{{ $unit->id }}" {{ $resident->unit_id == $unit->id ? 'selected' : '' }}>
                    {{ $unit->unit_number }}
                </option>
            @endforeach
        </select>
        @error('unit_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Resident Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $resident->name }}" required>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="contact" class="form-label">Contact</label>
        <input type="text" class="form-control" id="contact" name="contact" value="{{ $resident->contact }}" required>
        @error('contact')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btnUpdate">Update</button>
    <a href="{{ route('residents.index') }}" class="btn btnBack">Back</a>
</form>

<style>
    .btnUpdate {
        border: 2px solid rgb(1, 101, 1);
        color: black
    }

    .btnUpdate:hover {
        background-color: rgb(1, 101, 1) !important;
        color: white !important;
        border: 2px solid rgb(1, 101, 1);
    }

    .btnBack {
        margin-left: 10px;
        border: 2px solid rgb(91, 90, 90);
        color: black;
    }

    .btnBack:hover {
        background-color:rgb(130, 129, 129); !important;
        color: white !important;
        border: 2px solid  rgb(91, 90, 90)
    }
</style>