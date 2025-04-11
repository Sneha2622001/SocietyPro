<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h4 class="mb-0">👤 My Profile</h4>
                    </div>
                    <div class="card-body p-4">


                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Name:</strong><br>{{ $staff->user->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Role:</strong><br>{{ $staff->user->getRoleNames()->first() }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Contact:</strong><br>{{ $staff->user->contact }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Status:</strong><br>
                                    <span class="badge bg-{{ $staff->user->status ? 'success' : 'secondary' }}">
                                        {{ $staff->user->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Shift:</strong><br>{{ $staff->shift }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Type:</strong><br>{{ $staff->type }}</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
