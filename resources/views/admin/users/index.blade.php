<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><b>User List</b></h2>
    <a href="/admin/users/add" class="btn btn-primary">Add Users</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Role</th>
            <th>Phone Number</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user['id'] }}</td>
                <td>{{ $user['fullname'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['address'] }}</td>
                <td>
                    @if ($user['role'] == 1)
                        Admin
                    @elseif ($user['role'] == 2)
                        Employee
                    @elseif ($user['role'] == 3)
                        User
                    @else
                        Unknown
                    @endif
                </td>
                <td>{{ $user['phone_number'] }}</td>
                <td>
                    <!-- Delete Form -->
                    <form action="{{ route('users.delete', $user['id']) }}" method="POST" style="display:inline;"
                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
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
