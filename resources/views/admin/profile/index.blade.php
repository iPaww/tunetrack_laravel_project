<!-- Admin Profile Section -->
<div class="card mb-4 shadow-lg border-0 rounded-3">
    <div class="card-header bg-primary text-white">
        <h4>Profile Details</h4>
    </div>
    <div class="card-body d-flex">
        <!-- Left: Profile Picture -->
        <div class="me-4">
            <img src="{{ !empty($user['profile_picture']) &&
            file_exists(public_path('assets/images/users/' . $user['id'] . '/' . $user['profile_picture']))
                ? asset('assets/images/users/' . $user['id'] . '/' . $user['profile_picture'])
                : asset('assets/images/default/admindp.jpg') }}"
                alt="Profile Picture" class="rounded-circle mb-3" style="width: 300px; height: 300px;">
        </div>
        <!-- Right: Information -->
        <div class="flex-grow-1 ms-5">
            <p><strong>Full Name:</strong>{{ htmlspecialchars($user['fullname']) }}</p>
            <p><strong>Email:</strong>{{ htmlspecialchars($user['email']) }}</p>
            <p><strong>Phone Number:</strong>{{ htmlspecialchars($user['phone_number']) }}</p>
            <p><strong>Address:</strong>{{ htmlspecialchars($user['address']) }}</p>
            <p><strong>Role:</strong>{{ ucfirst(htmlspecialchars($user['role'])) }}</p>
            <p><strong>Created At:</strong>{{ htmlspecialchars($user['created_at']) }}</p>
        </div>
    </div>
</div>

<!-- Update Admin Details Form -->
<div class="card shadow-lg border-0 rounded-3">
    <div class="card-header bg-info text-white">
        <h5>Update Profile</h5>
    </div>
    <div class="card-body">
        <!-- Update Profile Form -->
        <form method="POST" enctype="multipart/form-data" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT') <!-- This line is required to simulate PUT request -->

            <div class="mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname"
                    value="{{ htmlspecialchars($user['fullname']) }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ htmlspecialchars($user['email']) }}" required>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number"
                    value="{{ htmlspecialchars($user['phone_number']) }}" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" required>{{ htmlspecialchars($user['address']) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password (leave blank to keep current)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Update Profile</button>
            </div>
        </form>
    </div>
</div>
