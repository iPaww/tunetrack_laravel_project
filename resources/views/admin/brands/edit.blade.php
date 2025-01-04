<!-- resources/views/admin/brands/edit.blade.php -->
<div class="container my-5">
    <h1>Edit Brand</h1>

    <form action="{{ route('brands.update', $brand->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Brand Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $brand->name) }}"
                required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update Brand</button>
    </form>
</div>
