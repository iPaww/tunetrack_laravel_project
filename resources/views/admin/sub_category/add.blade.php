<h2 class="mb-4"><b>Create Sub-Category</b></h2>

<form action="/admin/sub-category/add" method="POST" class="shadow p-4 rounded-lg bg-light">
    @csrf <!-- {{ csrf_field() }} -->

    <!-- Sub-Category Name Input -->
    <div class="mb-3">
        <label for="name" class="form-label">Subcategory Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter subcategory name"
            required>
    </div>

    <!-- Main Category Dropdown (Foreign Key) -->
    <div class="mb-3">
        <label for="category_id" class="form-label">Main Category</label>
        <select name="category_id" id="category_id" class="form-control" required>
            <option value="">Select Main Category</option>
            @foreach ($MainCategory as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Buttons -->
    <div class="d-flex justify-content-end align-items-center mt-4">
        <!-- Add Subcategory Button -->
        <button type="submit" class="btn btn-primary px-3 d-inline-flex align-items-center me-2">
            <i class="fas fa-plus me-2"></i> Add Subcategory
        </button>
        <!-- Back Button -->
        <a href="/admin/sub-category" class="btn btn-secondary px-3 d-inline-flex align-items-center">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a>
    </div>
</form>
