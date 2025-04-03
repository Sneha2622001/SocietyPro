<x-app-layout>
    <div class="container-fluid mt-5 px-3">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-black">Units List</h2>
                    <button class="btn btnAddUnit" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#unitFormContent" id="loadUnitForm">
                        Add Unit
                    </button>
                    <!-- Offcanvas Modal for Add Unit Form -->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="unitFormContent"
                        aria-labelledby="unitFormContentLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="unitFormContentLabel">Add Unit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body unitForm"></div>
                    </div>
                </div>

                <!-- Units Table -->
                <table class="table table-light table-striped table-hover table-bordered text-center align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>ID</th>
                            <th>Floor</th>
                            <th>Unit Number</th>
                            <th>Type</th>
                            <th>Size (sqft)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($units as $unit)
                            <tr>
                                <td>{{ $unit->id }}</td>
                                <td>{{ $unit->floor->floor_number }}</td>
                                <td class="fw-bold">{{ $unit->unit_number }}</td>
                                <td>{{ $unit->unit_type }}</td>
                                <td>{{ $unit->size ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-edit btn-sm"
                                        type="button" data-bs-toggle="offcanvas" data-bs-target="#unitEditFormContent"
                                        aria-controls="unitEditFormContent" id="loadEditUnit">Edit</a>

                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="unitEditFormContent"
                                        aria-labelledby="unitEditFormContentLabel">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title" id="unitEditFormContentLabel">Edit Unit</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body unitEditForm"></div>
                                    </div>

                                    <form action="{{ route('units.destroy', $unit->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this unit?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#loadUnitForm').on('click', function() {
        $.get("{{ route('units.create') }}", function(data) {
            $('.unitForm').html(data);
        });
    });

    $(document).on('click', '#loadEditUnit', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        $.get(url, function(data) {
            $('.unitEditForm').html(data);
        });
    });
</script>

<style>
    h2 {
        font-size: 22px;
        font-weight: bold;
        text-transform: uppercase;
        color: black;
        border-bottom: 3px solid #007bff;
        padding-bottom: 5px;
        display: inline-block;
    }

    .btn-edit {
        border: 2px solid rgb(235, 206, 15);
        color: black;
    }

    .btn-edit:hover {
        background-color: rgb(235, 206, 15) !important;
        color: white !important;
        border: 2px solid rgb(235, 206, 15);
    }

    .btn-delete {
        border: 2px solid rgb(169, 5, 5);
        color: black;
    }

    .btn-delete:hover {
        background-color: rgb(169, 5, 5) !important;
        color: white !important;
        border: 2px solid rgb(169, 5, 5);
    }

    .btnAddUnit {
        font-size: 17px;
        font-weight: bold;
        color: #343a40;
        text-transform: capitalize;
        border-left: 4px solid #a9a8a7c0;
        padding-left: 10px;
        margin-bottom: 15px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
    }
</style>
