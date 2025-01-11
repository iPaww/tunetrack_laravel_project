<h2 class="mb-4"><b>Edit Main Category</b></h2>

<form action="/admin/main-category/edit/{{ $category->id }}" method="POST" enctype="multipart/form-data"
    class="shadow p-4 rounded-lg bg-light">
    @csrf

    <!-- Category Name Input -->
    <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" class="form-control" name="name" id="name"
            value="{{ old('name', $category->name) }}" placeholder="Enter category name" required>
    </div>

    <!-- Category Image Input -->
    <div class="mb-3">
        <label for="image" class="form-label">Category Image</label>
        <input type="file" class="form-control" name="image" id="image">
        @if ($category->image)
            <div class="mt-3">
                <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" class="img-thumbnail"
                    width="100">
            </div>
        @endif
    </div>

    <!-- Buttons -->
    <div class="d-flex justify-content-end align-items-center mt-4">
        <!-- Update Button -->
        <button class="btn btn-primary px-3 d-inline-flex align-items-center me-2" type="submit">
            <i class="fas fa-save me-2"></i> Update
        </button>
        <!-- Back Button -->
        <a href="/admin/main-category" class="btn btn-secondary px-3 d-inline-flex align-items-center">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a>
    </div>
</form>
