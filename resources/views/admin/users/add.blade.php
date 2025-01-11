<div class="container py-5">
    <h1 class="mb-4">Add User</h1>

    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data"
        class="shadow p-4 rounded-lg bg-light">
        @csrf

        <!-- Full Name -->
        <div class="mb-3">
            <label for="fullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter full name"
                required>
        </div>

        <!-- Phone Number -->
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number"
                placeholder="Enter phone number" required>
        </div>

        <!-- Address -->
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" placeholder="Enter address" rows="3" required></textarea>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address"
                required>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password"
                required>
        </div>

        <!-- Role -->
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select id="role" name="role" class="form-select" required>
                <option value="1">Admin</option>
                <option value="2">Employee</option>
            </select>
        </div>

        <!-- Profile Picture -->
        <div class="mb-3">
            <label for="profile_picture" class="form-label">Profile Picture</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-end align-items-center mt-4">
            <a href="{{ route('users.index') }}" class="btn btn-secondary px-3 d-inline-flex align-items-center me-2">
                <i class="fas fa-times me-2"></i> Close
            </a>
            <button type="submit" name="add_user" class="btn btn-primary px-3 d-inline-flex align-items-center">
                <i class="fas fa-plus me-2"></i> Add User
            </button>
        </div>
    </form>
</div>
