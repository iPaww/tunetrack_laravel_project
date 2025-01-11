<h2 class="mb-4"><b>Edit Sub-Category</b></h2>

<form action="/admin/sub-category/edit/{{ $sub_category->id }}" method="POST" class="shadow p-4 rounded-lg bg-light">
    @csrf <!-- CSRF Token -->

    <!-- Subcategory Name Input -->
    <div class="mb-3">
        <label for="name" class="form-label">Subcategory Name</label>
        <input type="text" name="name" id="name" class="form-control"
            value="{{ old('name', $sub_category->name) }}" placeholder="Enter subcategory name" required>
    </div>

    <!-- Main Category Dropdown -->
    <div class="mb-3">
        <label for="category_id" class="form-label">Main Category</label>
        <select name="category_id" id="category_id" class="form-control" required>
            <option value="">Select Main Category</option>
            @foreach ($MainCategory as $category)
                <option value="{{ $category->id }}" @selected($category->id == $sub_category->category_id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Buttons -->
    <div class="d-flex justify-content-end align-items-center mt-4">
        <!-- Update Button -->
        <button type="submit" class="btn btn-primary px-3 d-inline-flex align-items-center me-2">
            <i class="fas fa-save me-2"></i> Update Subcategory
        </button>
        <!-- Back Button -->
        <a href="/admin/sub-category" class="btn btn-secondary px-3 d-inline-flex align-items-center">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a>
    </div>
</form>
