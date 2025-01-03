<h1>Edit Sub Category (Instruments)</h1>
<button class="btn btn-secondary mb-3">
    <a href="/admin/main-category" style="text-decoration:none; color:white;">Back</a>
</button>

<form action="/admin/sub-category/add" method="POST">
    @csrf <!-- {{ csrf_field() }} -->
    
    <!-- Sub-Category Name Input -->
    <label for="name">Sub-Category Name</label>
    <input type="text" name="name" id="name" required>

    <!-- Main Category Dropdown (Foreign Key) -->
    <label for="category_id">Main Category</label>
    <select name="category_id" id="category_id" required>
        <option value="">Select Main Category</option>
        @foreach ($MainCategory as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary mt-3">Add</button>
</form>
