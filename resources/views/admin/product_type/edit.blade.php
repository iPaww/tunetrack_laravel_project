<div class="container mt-5">
    <!-- Title and Back Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Product Type</h1>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Product Type Edit Form -->
    <form action="{{ route('product_type.update', $productType->id) }}" method="POST"
        class="p-4 border rounded-3 shadow-sm bg-light">
        @csrf
        @method('PUT')

        <!-- Product Type Name Input -->
        <div class="form-group mb-3">
            <label for="name" class="form-label">Product Type Name</label>
            <input type="text" id="name" name="name" class="form-control"
                value="{{ old('name', $productType->name) }}" required>
        </div>

        <!-- Buttons (side by side) -->
        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-success w-48">Update</button>
            <a href="{{ route('product_type.index') }}" class="btn btn-secondary w-48 text-center">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
        </div>
    </form>
</div>
