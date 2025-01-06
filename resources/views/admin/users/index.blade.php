<h2>User List</h2>
<a href="/admin/users/add"class="btn btn-primary">Add Users</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>address</th>
            <th>Role</th>
            <th>PhoneNumber</th>
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
            </tr>
        @endforeach
    </tbody>
</table>
