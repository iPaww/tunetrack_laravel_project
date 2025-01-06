<div class="container mt-5">
    <!-- Title and Back Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Product Type</h1>
        <!-- Back Button -->
        <a href="{{ route('product_type.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Back to Product Types
        </a>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Product Type Edit Form -->
    <form action="{{ route('admin.product_type.update', $productType->id) }}" method="POST"
        class="p-4 border rounded-3 shadow-sm bg-light">
        @csrf
        @method('PUT')

        <!-- Product Type Name Input -->
        <div class="form-group mb-3">
            <label for="name" class="form-label">Product Type Name</label>
            <input type="text" id="name" name="name" class="form-control"
                value="{{ old('name', $productType->name) }}" required>
        </div>

        <!-- Update Button -->
        <button type="submit" class="btn btn-success w-100">Update Product Type</button>
    </form>
</div>
