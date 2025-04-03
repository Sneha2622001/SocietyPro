
<form action="{{ route('floor.store') }}" method="POST">
@csrf
<div class="mb-3">
    <label for="building_id" class="form-label">Select Building</label>
    <select class="form-control" id="building_id" name="building_id" required>
        <option value="">Choose Building</option>
        @foreach ($buildings as $building)
            <option value="{{ $building->id }}">{{ $building->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="floor_number" class="form-label">Floor Number</label>
    <input type="number" class="form-control" id="floor_number" name="floor_number" required min="1">
</div>

<button type="submit" class="btn btnsave">Save</button>
<a href="{{ route('floor.index') }}" class="btn btnBack">Back</a>
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