<h1>Edit here</h1>
<button class="btn btn-secondary mb-3"><a href="/admin/main-category"style="text-decoration:none; color:white;">Back</a></button>
<form action="/admin/main-category/edit/{{$id}}" method="POST">
    @csrf <!-- {{ csrf_field() }} -->
    <label for="">Name</label>
    <input type="text" name="name" value="{{ old('name') }}" required>
    <button class="btn btn-primary" type="submit"> Add</button>
</form>