<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><b>Sub-Category</b></h2>
        <button class="btn btn-primary">
            <a href="/admin/sub-category/add" style="text-decoration: none; color: white;">Add</a>
        </button>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sub_category as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->MainCategory->name }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="/admin/sub-category/edit/{{ $category->id }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="/admin/sub-category/{{ $category->id }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $sub_category->links() }}
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
