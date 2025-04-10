<x-app-layout>
    <div class="container-fluid mt-5 px-3">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Page Header -->
                <div class="d-flex justify-content-end align-items-center mb-4">
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#facilityFormContent" id="loadfacilityForm">
                        Add Facilty
                    </button>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="facilityFormContent"
                        aria-labelledby="facilityFormContentLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="facilityFormContentLabel">Add Facilty</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body facilityForm"></div>
                    </div>
                </div>
                <h2 class="mb-3 fw-bolder fs-1">Facilities</h2>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @elseif (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                <div class="row">
                    @foreach($facilities as $facility)
                    <div class="col-md-4">
                        <div class="card shadow p-3 mb-3">
                            <div class="card-body">
                                <h5 class="card-body m-2 fw-bolder">{{ $facility->name }}</h5>
                                <p class="card-body m-2">{{ $facility->description }}</p>
                                <p class="card-body m-2">Price: {{ $facility->price }} Rs per hour</p>
                                <a href="{{ route('facilities.show', $facility->id) }}" 
                                class="btn btn-primary addbookingFormBtn" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#bookingFormContent-{{ $facility->id }}">Book</a>
                                <div class="offcanvas offcanvas-end" tabindex="-1" id="bookingFormContent-{{ $facility->id }}"
                                    aria-labelledby="bookingFormContentLabel-{{ $facility->id }}">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="bookingFormContentLabel-{{ $facility->id }}">Book {{$facility->name}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body bookingForm">
                                    </div>
                                </div>
                                
                                {{-- @role('admin') --}}
                                <a href="{{ route('facilities.edit', $facility->id) }}"
                                        class="btn btn-warning loadEditfacilityForm"
                                        data-id="{{ $facility->id }}"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#facilityEditFormContent"
                                        aria-controls="facilityEditFormContent">
                                            Edit
                                </a>
                                <div class="offcanvas offcanvas-end" tabindex="-1" id="facilityEditFormContent"
                                    aria-labelledby="facilityEditFormContentLabel">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="facilityEditFormContentLabel">Edit Facility</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body facilityEditForm"></div>
                                </div>
                                <form action="{{ route('facilities.destroy', $facility) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Are you sure you want to delete this facility?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                {{-- @endrole --}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '.addbookingFormBtn' , function(e) {
        e.preventDefault();
        const $btn = $(this);
        const url = $btn.attr('href');
        const targetOffcanvas = $btn.data('bs-target'); 
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                $(`${targetOffcanvas} .bookingForm`).html(data);
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
            }
        });
    });

    $('#loadfacilityForm').on('click', function() {
        $.get("{{ route('facilities.create') }}", function(data) {
            $('.facilityForm').html(data);
        });
    });

    $(document).on('click', '.loadEditfacilityForm', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');

        $.ajax({
            url: url,
            method: 'GET',
            beforeSend: function () {
                $('.facilityEditForm').html('<div class="text-center">Loading...</div>');
            },
            success: function (response) {
                $('.facilityEditForm').html(response);
            },
            error: function () {
                $('.facilityEditForm').html('<div class="text-danger">Failed to load form.</div>');
            }
        });
    });
</script>
