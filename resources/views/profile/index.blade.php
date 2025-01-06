<div class="container">
    <!-- User Profile Section -->
    <div class="card mb-4 shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white">
            <h4>User Profile</h4>
        </div>
        <div class="card-body d-flex">
            <!-- Left: Profile Picture -->
            <div class="me-4">
                <!-- Updated image tag with id 'profileImage' -->
                <img id="profileImage" src="{{ asset('storage/user/' . session('id') . '/' . $profile->image) }}"
                    alt="Profile Picture" class="rounded-circle mb-3" style="width: 300px; height: 300px;">
            </div>
            <!-- Right: User Information -->
            <div class="flex-grow-1 ms-5">
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
        <div class="card-header bg-info text-white">
            <h5>Update Profile</h5>
        </div>
        <div class="card-body">
            <form id="userForm" class="mx-y" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="fullname" class="form-label fw-bold">Full Name</label>
                    <input class="form-control" id="fullname" type="text" name="fullname" placeholder="Full Name"
                        value="{{ $profile->fullname }}" required>
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label fw-bold">Phone Number</label>
                    <input class="form-control" id="phone_number" type="text" name="phone_number"
                        placeholder="Phone Number" value="{{ $profile->phone_number }}" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label fw-bold">Address</label>
                    <input class="form-control" id="address" type="text" name="address" placeholder="Address"
                        value="{{ $profile->address }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input class="form-control" type="email" placeholder="Email" value="{{ $profile->email }}"
                        disabled>
                </div>
                <div class="mb-3">
                    <label for="profile_picture" class="form-label fw-bold">Profile Picture</label>
                    <input id="profile_picture" type="file" name="profile_picture" accept="image/*">
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-success" onclick="saveUser()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function saveUser() {
        const formData = new FormData(document.getElementById('userForm'));
        const profilePicture = document.getElementById('profile_picture').files[0];
        if (profilePicture) {
            formData.append('profile_picture', profilePicture);
        }

        fetch('{{ url('profile/update') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);

                // Update the profile picture dynamically
                if (data.profile.image) {
                    document.getElementById('profileImage').src =
                        '{{ asset('storage/user/' . session('id')) }}' + '/' + data.profile.image;
                }

                // Dynamically update user profile details
                document.querySelector('.profile-fullname').textContent = data.profile.fullname;
                document.querySelector('.profile-phone_number').textContent = data.profile.phone_number;
                document.querySelector('.profile-address').textContent = data.profile.address;

                // Optionally, refresh email and other details if needed
                document.querySelector('.profile-email').textContent = data.profile.email;
                document.querySelector('.profile-role').textContent = data.profile.role.charAt(0).toUpperCase() +
                    data.profile.role.slice(1);
            })
            .catch(error => console.error('Error:', error));
    }
</script>
