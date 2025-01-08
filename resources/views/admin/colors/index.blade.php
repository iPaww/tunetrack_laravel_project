<!-- resources/views/admin/colors/index.blade.php -->

<div class="container">
    <div class="row align-items-center mb-3">
        <div class="col-12 col-md-6">
            <h2><b>COLORS</b></h2>
        </div>
        <div class="col-12 col-md-6 text-md-end">
            <a href="{{ route('colors.create') }}" class="btn btn-primary mb-3">Add New Color</a>
            <!-- Back Button -->
            <a href="/admin/products" class="btn btn-secondary mb-3">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="notificationMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($colors as $color)
                <tr>
                    <td>{{ $color->name }}</td>
                    <td>
                        <a href="{{ route('colors.edit', $color->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('colors.destroy', $color->id) }}" method="POST" style="display:inline;">
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Check if there's a notification message from the session
        @if (session('success'))
            showModalNotification("{{ session('success') }}");
        @endif
    });

    function showModalNotification(message) {
        // Set the message in the modal
        const messageElement = document.getElementById('notificationMessage');
        messageElement.textContent = message;

        // Show the modal
        const notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
        notificationModal.show();
    }
</script>
