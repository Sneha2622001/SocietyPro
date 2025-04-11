<x-app-layout>
    <div class="container-fluid mt-5 px-3">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-10">
              <div class="d-flex justify-content-end align-items-center mb-4">
                    <button class="btn bg-body-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#complainFormContent" id="complainForm" aria-controls="offcanvasRight">Add User</button>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="complainFormContent" aria-labelledby="complainFormContentLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title " id="complainFormContentLabel">Add Complaint</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body complainFormContent"></div>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-3">All Complaints</h2>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Resident</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($complaints as $complaint)
                                <tr>
                                    <td>{{ $complaint->user->name }}</td>
                                    <td>{{ $complaint->title }}</td>
                                    <td>{{ $complaint->description }}</td>
                                    <td>
                                        <form action="{{ route('complaints.updateStatus', $complaint->id) }}" method="POST">
                                            @csrf
                                            <select name="status"
                                                class="form-select update-status"
                                                data-id="{{ $complaint->id }}">
                                                <option value="Pending" {{ $complaint->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="In Progress" {{ $complaint->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="Resolved" {{ $complaint->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('complaints.show', $complaint->id) }}" class="btn bg-body-secondary" type="button" data-bs-toggle="offcanvas" 
                                            data-bs-target="#complaintviewFormContent" id="complaintviewForm" aria-controls="offcanvasRight">View</a>
                                        <div class="offcanvas offcanvas-end" tabindex="-1" id="complaintviewFormContent" aria-labelledby="complaintviewFormContentLabel">
                                            <div class="offcanvas-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            <div class="offcanvas-body complaintviewFormContent"></div>
                                            </div>
                                        </div>
                                        <a href="{{ route('complaints.edit', $complaint->id) }}" class="btn btn-warning" type="button" data-bs-toggle="offcanvas"
                                            data-bs-target="#complaintEditFormContent" aria-controls="complaintEditFormContent" id="loadEditComplaint">Edit</a>
    
                                        <div class="offcanvas offcanvas-end" tabindex="-1" id="complaintEditFormContent"
                                            aria-labelledby="complaintEditFormContentLabel">
                                            <div class="offcanvas-header">
                                                <h5 class="offcanvas-title" id="complaintEditFormContentLabel">Edit complaint</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="offcanvas-body complaintEditForm">
                                                
                                            </div>
                                        </div>
                                        <form action="{{ route('complaints.destroy', $complaint->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this role?');">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#complainForm').on('click', function() {
        $.get("{{ route('complaints.create') }}", function(data) {
            $('.complainFormContent').html(data);
        });
    });

    $(document).on('click', '#complaintviewForm', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        const url_array = url.split('/');
        const compalintId = url_array[4];
        const viewUrl = "{{ route('complaints.show', ':id') }}".replace(':id', compalintId);
        $.ajax({
            url: viewUrl,
            type: 'GET',
            success: function(data) {
                $('.complaintviewFormContent').html(data);
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
            }
        });
    });

    $(document).on('click', '#loadEditComplaint', function(e) {
          e.preventDefault();
          let url = $(this).attr('href');
          const url_array = url.split('/');
          const compalintId = url_array[4];
          const editUrl = "{{ route('complaints.edit', ':id') }}".replace(':id', compalintId);
          $.ajax({
              url: editUrl,
              type: 'GET',
              success: function(data) {
                  $('.complaintEditForm').html(data);
              },
              error: function(xhr) {
                  console.error('Error:', xhr.responseText);
              }
          });
      });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('change', '.update-status', function () {
        const complaintId = $(this).data('id');
        const newStatus = $(this).val();

        $.ajax({
            url: `/complaints/${complaintId}/status`,
            type: 'POST',
            data: {
                status: newStatus
            },
            success: function (response) {
                if (response.success) {
                    alert('Status updated successfully.');
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Failed to update status.');
            }
        });
    });
</script>