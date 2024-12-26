<h1>Edit here</h1>

<form action="/admin/main-category/edit/{{$id}}" method="POST">
    @csrf <!-- {{ csrf_field() }} -->
    <label for="">Name</label>
    <input type="text" name="name_txt" id="">
    <button type="submit"> Add</button>
</form>