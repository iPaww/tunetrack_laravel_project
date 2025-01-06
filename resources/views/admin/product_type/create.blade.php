<div class="container mt-5">
    <!-- Title and Back Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Create New Product Type</h1>

    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Product Type Form -->
    <form action="{{ route('product_type.store') }}" method="POST" class="p-4 border rounded-3 shadow-sm bg-light">
        @csrf
        <div class="form-group mb-3">
            <label for="name" class="form-label">Product Type Name</label>
            <input type="text" id="name" name="name" class="form-control" required
                placeholder="Enter product type name">
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('product_type.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
            <button type="submit" class="btn btn-success">
                Create Product Type
            </button>
        </div>
    </form>
</div>
