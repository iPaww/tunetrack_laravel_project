<div class="container">
    <div class="row align-items-center mb-3">
        <!-- Product Type Title -->
        <div class="col-12 col-md-6">
            <h2><b>PRODUCT TYPE</b></h2>
        </div>

        <!-- Buttons Section (Align to the Right) -->
        <div class="col-12 col-md-6 text-md-end">
            <a href="{{ route('product_type.create') }}" class="btn btn-primary mb-2" id="addNewProductTypeBtn">Add New
                Product Type</a>
            <a href="/admin/products" class="btn btn-secondary mb-2">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
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
            @foreach ($productTypes as $productType)
                <tr>
                    <td>{{ $productType->name }}</td>
                    <td>
                        <a href="{{ route('product_type.edit', $productType->id) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('product_type.destroy', $productType->id) }}" method="POST"
                            style="display:inline;" onsubmit="showModal('Product Type Deleted Successfully')">
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

<!-- Modal Notice -->
<div class="modal fade" id="noticeModal" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="noticeModalLabel">Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="noticeModalBody">
                <!-- The success message will be dynamically added here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = "{{ session('success') }}"; // Get the session success message

        if (successMessage) {
            const noticeModalBody = document.getElementById('noticeModalBody');
            const noticeModal = new bootstrap.Modal(document.getElementById('noticeModal'));

            // Set the success message in the modal body
            noticeModalBody.textContent = successMessage;

            // Show the modal
            noticeModal.show();
        }
    });
</script>
