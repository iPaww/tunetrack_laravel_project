<form action="/admin/main-category/add" method="POST" class="shadow p-4 rounded-lg bg-light">
    @csrf <!-- {{ csrf_field() }} -->

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter category name" required>
    </div>

    <div class="form-group mb-3">
        <label for="image" class="form-label">Category Image</label>
        <input type="file" class="form-control" name="image" id="image">
    </div>

    <div class="d-flex justify-content-end align-items-center mt-4">
        <!-- Add Category Button -->
        <button type="submit" class="btn btn-primary px-3 d-inline-flex align-items-center me-2">
            <i class="fas fa-plus me-2"></i> Add Category
        </button>
        <!-- Back Button -->
        <a href="/admin/main-category" class="btn btn-secondary px-3 d-inline-flex align-items-center">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a>
    </div>
</form>
