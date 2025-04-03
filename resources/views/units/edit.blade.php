
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

    <button type="submit" class="btn btnUpdate">Update</button>
    <a href="{{ route('units.index') }}" class="btn btnBack">Back</a>
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
    