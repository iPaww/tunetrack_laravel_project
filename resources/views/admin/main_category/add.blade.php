<!-- Back Button -->
<a href="/admin/main-category" class="btn btn-secondary mb-4">
    <i class="fas fa-arrow-left"></i> Back
</a>

<form action="/admin/main-category/add" method="POST" class="shadow p-4 rounded-lg bg-light">
    @csrf <!-- {{ csrf_field() }} -->

    <!-- Name Input -->
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter category name" required>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary w-100 py-2">Add Category</button>
</form>
