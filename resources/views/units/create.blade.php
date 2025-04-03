<form action="{{ route('units.store') }}" method="POST">
    @csrf

    <!-- Floor Selection -->
    <div class="mb-3">
        <label for="floor_id" class="form-label">Select Floor</label>
        <select class="form-control" id="floor_id" name="floor_id" required>
            <option value="" disabled selected>Select the Floor</option>
            @foreach ($floors as $floor)
                <option value="{{ $floor->id }}">{{ $floor->floor_number }}</option>
            @endforeach
        </select>
        @error('floor_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Unit Number -->
    <div class="mb-3">
        <label for="unit_number" class="form-label">Unit Number</label>
        <input type="number" class="form-control" id="unit_number" name="unit_number" required>
        @error('unit_number')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Unit Type -->
    <div class="mb-3">
        <label for="unit_type" class="form-label">Unit Type</label>
        <input type="text" class="form-control" id="unit_type" name="unit_type" required>
        @error('unit_type')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Unit Size -->
    <div class="mb-3">
        <label for="size" class="form-label">Size (sqft)</label>
        <input type="number" class="form-control" id="size" name="size">
        @error('size')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Buttons -->
    <button type="submit" class="btn btnsave">Save</button>
    <a href="{{ route('units.index') }}" class="btn btnBack">Back</a>
</form>

<style>
    .btnsave {
        border: 2px solid rgb(1, 101, 1);
        color: black
    }

    .btnsave:hover {
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
        background-color: rgb(130, 129, 129);
        !important;
        color: white !important;
        border: 2px solid rgb(91, 90, 90)
    }
</style>
