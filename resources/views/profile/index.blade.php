<div class="container mt-4">
        <!-- User Profile Header -->
        <div class="card shadow-lg border-0 rounded-3 p-4 d-flex flex-row align-items-center" style="background-color: #FC6A03; color: white;">
            <div class="position-relative me-4" style="width: 150px; height: 150px;">
                <img id="profileImage" src="{{ $profile->image ? asset('storage/' . $profile->image) : asset('assets/images/default/admindp.jpg') }}"
                    alt="Profile Picture" class="rounded-circle border shadow-lg"
                    style="border: 4px solid white; width: 100%; height: 100%; object-fit: cover;">

                <input type="file" id="profilePictureInput" name="image" accept="image/*" style="display: none;" onchange="uploadProfilePicture(event)">

                <div class="position-absolute bottom-0 end-0 bg-dark text-white p-2 rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 40px; height: 40px; cursor: pointer;"
                    onclick="document.getElementById('profilePictureInput').click();">
                    <i class="fas fa-camera"></i>
                </div>
            </div>
            <div>
                <h3 class="mb-1 fw-bold fs-2">{{ $profile->fullname }}</h3>
                <p class="mb-0">{{ $profile->email }}</p>
            </div>
            <button class="btn btn-light ms-auto" onclick="openEditModal()">Edit Profile</button>
        </div>
    <!-- Basic Info Section -->
    <div class="card shadow-lg border-0 rounded-3 mt-3 p-4" style="background: #fff6f2;">
        <div class="card-header bg-transparent border-0 pb-0">
            <h5 class="fw-bold text-center" style="color: #FC6A03;">Basic Information</h5>
        </div>
            <div class="d-flex align-items-center mb-3 p-2 border rounded">
                <i class="fas fa-envelope me-3 text-success"></i>
                <p class="mb-0"><strong>Email:</strong> <span>{{ $profile->email }}</span></p>
            </div>
            <div class="d-flex align-items-center mb-3 p-2 border rounded">
                <i class="fas fa-phone-alt me-3 text-primary"></i>
                <p class="mb-0"><strong>Phone:</strong> <span>{{ $profile->phone_number }}</span></p>
            </div>
            <div class="d-flex align-items-center p-2 border rounded">
                <i class="fas fa-map-marker-alt me-3 text-danger"></i>
                <p class="mb-0"><strong>Address:</strong> <span>{{ $profile->address }}</span></p>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateProfileForm" action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="formFullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="formFullName" name="fullname" value="{{ $profile->fullname }}">
                        </div>
                        <div class="mb-3">
                            <label for="formPhoneNumber" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="formPhoneNumber" name="phone_number" value="{{ $profile->phone_number }}">
                        </div>
                        <div class="mb-3">
                            <label for="formAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="formAddress" name="address" value="{{ $profile->address }}">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openEditModal() {
        new bootstrap.Modal(document.getElementById('editProfileModal')).show();
    }

    function updateProfilePicture(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImage').src = e.target.result;
                document.querySelector('.navbar-brand img').src = e.target.result; // Update header image
            }
            reader.readAsDataURL(file);
        }
    }
</script>

<!-- AJAX Script for Auto-Save Profile Picture -->
<script>
    function uploadProfilePicture(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImage').src = e.target.result; // Show preview
                document.querySelector('.navbar-brand img').src = e.target.result; // Update header image
            };
            reader.readAsDataURL(file);

            // Upload the image via AJAX
            let formData = new FormData();
            formData.append('image', file);
            formData.append('_token', '{{ csrf_token() }}'); // CSRF token for security

            fetch('{{ route("profile.update.picture") }}', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Profile picture updated successfully!");
                } else {
                    alert("Error updating profile picture!");
                }
            })
            .catch(error => console.error("Upload failed:", error));
        }
    }
</script>
