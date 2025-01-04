<h1>Edit here</h1>
<button class="btn btn-secondary mb-3"><a href="/admin/main-category"style="text-decoration:none; color:white;">Back</a></button>
<form action="/admin/main-category/edit/{{$id}}" method="POST">
    @csrf <!-- {{ csrf_field() }} -->
    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}" required>
    </div>
    <div class="form-group">
        <label for="image">Category Image</label>
        <input type="file" class="form-control" name="image" id="image">
        <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" width="100">
    </div>
    <button class="btn btn-primary" type="submit"> Add</button>
</form>