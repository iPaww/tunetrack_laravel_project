<!-- resources/views/admin/brands/create.blade.php -->
<div class="container my-5">
    <h1>Create New Brand</h1>

    <!-- Back Button -->
    <a href="{{ route('brands.index') }}" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left-circle"></i> Back to Brands
    </a>

    <form action="{{ route('brands.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Brand Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Create Brand</button>
    </form>
</div>
