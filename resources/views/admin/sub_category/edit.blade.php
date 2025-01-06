<h1 class="mb-4">Edit Sub Category (Instruments)</h1>

<!-- Back Button -->
<a href="/admin/sub-category" class="btn btn-secondary mb-4">
    <i class="fas fa-arrow-left"></i> Back
</a>

<form action="/admin/sub-category/edit/{{ $sub_category->id }}" method="POST" class="shadow p-4 rounded-lg bg-light">
    @csrf <!-- CSRF Token -->

    <!-- Sub-Category Name Input -->
    <div class="mb-3">
        <label for="name" class="form-label">Sub-Category Name</label>
        <input type="text" name="name" id="name" class="form-control" 
               value="{{ old('name', $sub_category->name) }}" 
               placeholder="Enter sub-category name" required>
    </div>

    <!-- Main Category Dropdown -->
    <div class="mb-3">
        <label for="category_id" class="form-label">Main Category</label>
        <select name="category_id" id="category_id" class="form-select" required>
            <option value="">Select Main Category</option>
            @foreach ($MainCategory as $category)
                <option value="{{ $category->id }}" 
                        @selected($category->id == $sub_category->category_id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary w-100 py-2">Update Sub-Category</button>
</form>
