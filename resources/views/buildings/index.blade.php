<x-app-layout>
    <div class="container-fluid mt-5 px-3">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-black">Buildings List</h2>
                    <button class="btn btnAddBuilding" type="button" data-bs-toggle="offcanvas" data-bs-target="#buildingFormContent" id="loadBuildingForm">
                        Add Building
                    </button>
                </div>
                
                <!-- Buildings Table -->
                <table class="table table-light table-striped table-hover table-bordered text-center align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buildings as $building)
                            <tr>
                                <td>{{ $building->id }}</td>
                                <td class="fw-bold">{{ $building->name }}</td>
                                <td>{{ $building->address }}</td>
                                <td>
                                    <a href="{{ route('building.edit', $building->id) }}" class="btn btn-edit btn-sm" type="button" data-bs-toggle="offcanvas"
                                        data-bs-target="#buildingEditFormContent" aria-controls="buildingEditFormContent" id="loadEditBuilding">Edit</a>
                                    
                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="buildingEditFormContent"
                                        aria-labelledby="buildingEditFormContentLabel">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title" id="buildingEditFormContentLabel">Edit Building</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body buildingEditForm"></div>
                                    </div>
                                    
                                    <form action="{{ route('building.destroy', $building->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this building?');">
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

    <!-- Offcanvas Modal for Add Building Form -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="buildingFormContent" aria-labelledby="buildingFormContentLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="buildingFormContentLabel">Add Building</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body buildingForm"></div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#loadBuildingForm').on('click', function() {
        $.get("{{ route('building.add') }}", function(data) {
            $('.buildingForm').html(data);
        });
    });
    
    $(document).on('click', '#loadEditBuilding', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        const url_array = url.split('/');
        const buildingId = url_array[4];
        const editUrl = "{{ route('building.edit', ':id') }}".replace(':id', buildingId);
        $.ajax({
            url: editUrl,
            type: 'GET',
            success: function(data) {
                $('.buildingEditForm').html(data);
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
            }
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
    .btnAddBuilding {
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
