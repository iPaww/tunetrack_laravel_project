<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><b>User List</b></h2>
    <a href="/admin/users/add" class="btn btn-primary">Add Users</a>
</div>

<div class="table-responsive">
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
</div>

<!-- Modal -->
<div class="modal fade" id="noticeModal" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noticeModalLabel">Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="noticeModalBody">
                <!-- Success or error message will be injected here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{ $users->links() }}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = "{{ session('success') }}";
        const errorMessage = "{{ session('error') }}";
        const noticeModalBody = document.getElementById('noticeModalBody');
        const noticeModal = new bootstrap.Modal(document.getElementById('noticeModal'));

        // Display success or error message in the modal
        if (successMessage) {
            noticeModalBody.textContent = successMessage.replace(/</g, "&lt;").replace(/>/g, "&gt;");
            noticeModal.show();
        } else if (errorMessage) {
            noticeModalBody.textContent = errorMessage.replace(/</g, "&lt;").replace(/>/g, "&gt;");
            noticeModal.show();
        }

        // Sidebar toggle logic
        const toggleSidebar = document.getElementById('toggle-sidebar');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        if (toggleSidebar) {
            toggleSidebar.addEventListener('click', () => {
                sidebar.classList.toggle('visible');
                content.classList.toggle('expanded');
            });
        }
    });
</script>
