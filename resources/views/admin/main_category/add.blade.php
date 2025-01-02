<button class="btn btn-secondary mb-3"><a href="/admin/main-category"style="text-decoration:none; color:white;">Back</a></button>

<form action="/admin/main-category/add" method="POST">
    @csrf <!-- {{ csrf_field() }} -->
    <label for="">Name</label>
    <input type="text" name="name" id="">
    <button type="submit"> Add</button>
</form>