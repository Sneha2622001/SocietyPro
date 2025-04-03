<form action="{{ route('floor.update', $floor->id) }}" method="POST">
    @csrf
    @method('PUT') 

    <div class="mb-3">
        <label for="building_id" class="form-label">Select Building</label>
        <select class="form-control" id="building_id" name="building_id" required>
            @foreach ($buildings as $building)
                <option value="{{ $building->id }}" {{ $building->id == $floor->building_id ? 'selected' : '' }}>
                    {{ $building->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="floor_number" class="form-label">Floor Number</label>
        <input type="number" class="form-control" id="floor_number" name="floor_number" required min="1" value="{{ $floor->floor_number }}">
    </div>

    <button type="submit" class="btn btnUpdate">Update</button>
    <a href="{{ route('floor.index') }}" class="btn btnBack">Back</a>
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