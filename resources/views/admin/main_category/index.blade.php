<div class="container mt-5">
    <h1>Main Categories</h1>
    <button class="btn btn-primary"><a href="/admin/main-category/add"style="text-decoration: none; color: white;">Add</a></button>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($MainCategory as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td><img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" width="100"></td>
                    <td>
                        <a href="/admin/main-category/edit/{{ $category->id }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="/admin/main-category/{{ $category->id }}" method="POST"
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
