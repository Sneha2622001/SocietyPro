<x-app-layout>
    <div class="container-fluid mt-5 px-3">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-black">Floors List</h2>
                    <button class="btn btnAddFloor" type="button" data-bs-toggle="offcanvas" data-bs-target="#floorFormContent" id="loadFloorForm">
                        Add Floor
                    </button>
                </div>
                
                <!-- Floors Table -->
                <table class="table table-light table-striped table-hover table-bordered text-center align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>ID</th>
                            <th>Building</th>
                            <th>Floor Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($floors as $floor)
                            <tr>
                                <td>{{ $floor->id }}</td>
                                <td class="fw-bold">{{ $floor->building->name }}</td>
                                <td>{{ $floor->floor_number }}</td>
                                <td>
                                    <a href="{{ route('floor.edit', $floor->id) }}" class="btn btn-edit btn-sm" type="button" 
                                        data-id="{{ $floor->id }}" data-bs-toggle="offcanvas"
                                        data-bs-target="#floorEditFormContent" aria-controls="floorEditFormContent">
                                         Edit
                                     </a>
                                     
                                    
                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="floorEditFormContent"
                                        aria-labelledby="floorEditFormContentLabel">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title" id="floorEditFormContentLabel">Edit Floor</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body floorEditForm"></div>
                                    </div>
                                    
                                    <form action="{{ route('floor.destroy', $floor->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this floor?');">
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

    <!-- Offcanvas Modal for Add Floor Form -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="floorFormContent" aria-labelledby="floorFormContentLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="floorFormContentLabel">Add Floor</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body floorForm"></div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#loadFloorForm').on('click', function() {
        $.get("{{ route('floor.create') }}", function(data) {
            $('.floorForm').html(data);
        });
    });
    
    $(document).on('click', '.btn-edit', function(e) {
    e.preventDefault();
    
    let url = $(this).attr('href');  // Get the URL from the button
    let floorId = $(this).data('id'); // Use a data attribute instead of splitting the URL

    // Ensure floorId is correctly extracted
    if (!floorId) {
        console.error('Floor ID not found!');
        return;
    }

    const editUrl = "{{ route('floor.edit', ':id') }}".replace(':id', floorId);

    $.ajax({
        url: editUrl,
        type: 'GET',
        success: function(data) {
            $('.floorEditForm').html(data);
            $('#floorEditFormContent').offcanvas('show');  // Ensure the offcanvas opens
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
    .btnAddFloor {
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
