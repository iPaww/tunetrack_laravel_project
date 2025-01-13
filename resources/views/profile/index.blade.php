<div class="container">
    <!-- User Profile Section -->
    <div class="card mb-4 shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white text-center">
            <h4>User Profile</h4>
        </div>
        <div class="card-body row align-items-center">
            <!-- Left: Profile Picture -->
            <div class="col-lg-4 text-center mb-3 mb-lg-0">
                <img id="profileImage"
                    src="{{ $profile['image'] && file_exists(public_path($profile['image']))
                        ? asset($profile['image'])
                        : asset('assets/images/default/admindp.jpg') }}"
                    alt="Profile Picture" class="rounded-circle img-fluid" style="max-width: 300px; max-height: 300px;">
            </div>
            <!-- Right: User Information -->
            <div class="col-lg-8">
                <p><strong>Full Name:</strong> <span class="profile-fullname">{{ $profile->fullname }}</span></p>
                <p><strong>Email:</strong> <span class="profile-email">{{ $profile->email }}</span></p>
                <p><strong>Phone Number:</strong> <span class="profile-phone_number">{{ $profile->phone_number }}</span>
                </p>
                <p><strong>Address:</strong> <span class="profile-address">{{ $profile->address }}</span></p>
            </div>
        </div>
    </div>

    <!-- Update User Profile Form -->
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-info text-white text-center">
            <h5>Update Profile</h5>
        </div>
        <div class="card-body">
            <form id="userForm" enctype="multipart/form-data" action="{{ route('update') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fullname" class="form-label fw-bold">Full Name</label>
                        <input class="form-control" id="fullname" type="text" name="fullname"
                            placeholder="Full Name" value="{{ $profile->fullname }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone_number" class="form-label fw-bold">Phone Number</label>
                        <input class="form-control" id="phone_number" type="text" name="phone_number"
                            placeholder="Phone Number" value="{{ $profile->phone_number }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label fw-bold">Address</label>
                    <input class="form-control" id="address" type="text" name="address" placeholder="Address"
                        value="{{ $profile->address }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input class="form-control" type="email" name="email" placeholder="Email"
                        value="{{ $profile->email }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="profile_picture" class="form-label fw-bold">Profile Picture</label>
                    <input id="profile_picture" class="form-control" type="file" name="image" accept="image/*">
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Notice -->
<div class="modal fade" id="noticeModal" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noticeModalLabel">Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="noticeModalBody">
                <!-- Success message dynamically added here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = "{{ session('success') }}";

        if (successMessage) {
            const noticeModalBody = document.getElementById('noticeModalBody');
            const noticeModal = new bootstrap.Modal(document.getElementById('noticeModal'));

            noticeModalBody.textContent = successMessage;
            noticeModal.show();
        }
    });
</script>
