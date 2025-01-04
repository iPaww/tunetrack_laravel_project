<h1 class="mb-4">Edit Sub Category (Instruments)</h1>

<!-- Back Button -->
<a href="/admin/sub-category" class="btn btn-secondary mb-4">
    <i class="fas fa-arrow-left"></i> Back
</a>

<form action="/admin/sub-category/add" method="POST" class="shadow p-4 rounded-lg bg-light">
    @csrf <!-- {{ csrf_field() }} -->
    
    <!-- Sub-Category Name Input -->
    <div class="mb-3">
        <label for="name" class="form-label">Sub-Category Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $sub_category->name }}" placeholder="Enter sub-category name" required>
    </div>

    <!-- Main Category Dropdown (Foreign Key) -->
    <div class="mb-3">
        <label for="category_id" class="form-label">Main Category</label>
        <select name="category_id" id="category_id" class="form-select"  required>
            <option value="">Select Main Category</option>
            @foreach ($MainCategory as $category)
                <option @selected($category->id == $sub_category->category_id) value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary w-100 py-2">Add Sub-Category</button>
</form>
