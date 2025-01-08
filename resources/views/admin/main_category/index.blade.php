<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><b>Main Category</b></h2>
        <button class="btn btn-primary">
            <a href="/admin/main-category/add" style="text-decoration: none; color: white;">Add</a>
        </button>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($MainCategory as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        @if ($category->image && file_exists(storage_path('app/public/' . $category->image)))
                            <img src="{{ asset('storage/' . $category->image) }}" class="img-fluid border rounded"
                                style="max-width: 100px" alt="{{ $category->name }}" />
                        @else
                            <img src="{{ asset('storage/main_category_images/default.png') }}"
                                class="img-fluid border rounded" style="max-width: 100px" alt="Default Image" />
                        @endif
                    </td>
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
    {{ $MainCategory->links() }}
</div>
