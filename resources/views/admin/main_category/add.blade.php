<form action="/admin/main-category/add" method="POST">
    @csrf <!-- {{ csrf_field() }} -->
    <label for="">Name</label>
    <input type="text" name="name" id="">
    <button type="submit"> Add</button>
</form>