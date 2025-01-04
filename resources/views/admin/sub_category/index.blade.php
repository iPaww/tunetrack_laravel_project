<div class="container mt-5">
    <h1>Sub Categories</h1>
    
    <button class="btn btn-primary">
        <a href="/admin/sub-category/add" style="text-decoration: none; color: white;">Add</a>
    </button>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cat_id</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sub_category as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->category_id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="/admin/sub-category/edit/{{ $category->id }}" class="btn btn-primary btn-sm">Edit</a>
                        <!-- Ensure the delete form is pointing to /admin/sub-category/{id} -->
                        <form action="/admin/sub-category/{{ $category->id }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
