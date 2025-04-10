<x-app-layout>
    <div class="container-fluid mt-5 px-3">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-black">Residents List</h2>
                    <button class="btn btnAddResident" type="button" data-bs-toggle="offcanvas" data-bs-target="#residentFormContent" id="loadResidentForm">
                        Add Resident
                    </button>
                </div>
                
                <!-- Residents Table -->
                <table class="table table-light table-striped table-hover table-bordered text-center align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>ID</th>
                            <th>Resident Name</th>
                            <th>Contact</th>
                            <th>Unit</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($residents as $resident)
                            <tr>
                                <td>{{ $resident->id }}</td>
                                <td class="fw-bold">{{ $resident->name }}</td>
                                <td>{{ $resident->contact }}</td>
                                <td>{{ isset($resident->unit->unit_number) ? $resident->unit->unit_number : "" }}</td>
                                <td>
                                    <a href="{{ route('residents.edit', $resident->id) }}" 
                                        class="btn btn-edit btn-sm loadEditResident" 
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#residentEditFormContent" 
                                        aria-controls="residentEditFormContent">Edit</a>
                                     
                                    
                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="residentEditFormContent"
                                        aria-labelledby="residentEditFormContentLabel">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title" id="residentEditFormContentLabel">Edit Resident</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body residentEditForm"></div>
                                    </div>
                                    
                                    <form action="{{ route('residents.destroy', $resident->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this resident?');">
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

    <!-- Offcanvas Modal for Add Resident Form -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="residentFormContent" aria-labelledby="residentFormContentLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="residentFormContentLabel">Add Resident</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body residentForm"></div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#loadResidentForm').on('click', function() {
        $.get("{{ route('residents.create') }}", function(data) {
            $('.residentForm').html(data);
        });
    });
    
    $(document).on('click', '.loadEditResident', function(e) {
    e.preventDefault();
    let url = $(this).attr('href');

    $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
            $('.residentEditForm').html(data);
            $('#residentEditFormContent').offcanvas('show');
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
    .btnAddResident {
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
