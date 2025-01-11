<div class="container">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><b>Main Category</b></h2>
        <a href="/admin/main-category/add" class="btn btn-primary">Add</a>
    </div>

    <!-- Main Category Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($MainCategory as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <img src="{{ $category->image && file_exists(storage_path('app/public/' . $category->image)) ? asset('storage/' . $category->image) : asset('storage/main_category_images/default.png') }}"
                            class="img-fluid border rounded" style="max-width: 100px" alt="{{ $category->name }}" />
                    </td>
                    <td>
                        <a href="/admin/main-category/edit/{{ $category->id }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="/admin/main-category/{{ $category->id }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    {{ $MainCategory->links() }}
</div>

<!-- Success Message Modal -->
<div class="modal fade" id="noticeModal" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noticeModalLabel">Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="noticeModalBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = "{{ session('success') }}";

        if (successMessage) {
            const noticeModalBody = document.getElementById('noticeModalBody');
            const noticeModal = new bootstrap.Modal(document.getElementById('noticeModal'));

            // Display success message in modal
            noticeModalBody.textContent = successMessage.replace(/</g, "&lt;").replace(/>/g, "&gt;");

            // Show modal
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
