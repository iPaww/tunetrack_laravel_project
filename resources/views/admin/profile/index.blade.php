<!-- Success or Error Alert -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Admin Profile Section -->
<div class="card mb-4 shadow-lg border-0 rounded-3">
    <div class="card-header bg-primary text-white">
        <h4>Profile Details</h4>
    </div>
    <div class="card-body d-flex">
        <!-- Left: Profile Picture -->
        <div class="me-4">
            <img src="{{ $user['image'] && file_exists(public_path($user['image']))
                ? asset($user['image'])
                : asset('assets/images/default/admindp.jpg') }}"
                alt="Profile Picture" class="rounded-circle mb-3" style="width: 300px; height: 300px;">
        </div>
        <!-- Right: Information -->
        <div class="flex-grow-1 ms-5">
            <p><strong>Full Name:</strong> {{ $user['fullname'] }}</p>
            <p><strong>Email:</strong> {{ $user['email'] }}</p>
            <p><strong>Phone Number:</strong> {{ $user['phone_number'] }}</p>
            <p><strong>Address:</strong> {{ $user['address'] }}</p>
            <p><strong>Role:</strong>
                @if ($user['role'] == 1)
                    Admin
                @elseif ($user['role'] == 2)
                    Employee
                @elseif ($user['role'] == 3)
                    User
                @else
                    Unknown
                @endif
            </p>
            <p><strong>Created At:</strong> {{ $user['created_at'] }}</p>
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
        <form method="POST" enctype="multipart/form-data" action="/admin/profile/update">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname"
                    value="{{ $user['fullname'] }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user['email'] }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number"
                    value="{{ $user['phone_number'] }}" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" required>{{ $user['address'] }}</textarea>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password (leave blank to keep current)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Update Profile</button>
            </div>
        </form>
    </div>
</div>

<script>
    const toggleSidebar = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    if (toggleSidebar) {
        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('visible');
            content.classList.toggle('expanded');
        });
    }
</script>
