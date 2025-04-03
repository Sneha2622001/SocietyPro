
<form action="{{ route('building.update', $building->id) }}" method="POST">

    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Building Name</label>
        <input type="text" class="form-control" id="name" name="name"
            value="{{ $building->name }}" required>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address" name="address"
            rows="3">{{ $building->address }}</textarea>
    </div>

    <button type="submit" class="btn btnUpdate">Update</button>
    <a href="/building" class="btn btnBack">Back</a>
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
