<!-- resources/views/admin/brands/index.blade.php -->
<div class="container">
    <h1><b>BRANDS</b></h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('brands.create') }}" class="btn btn-primary mb-3">Add New Brand</a>
    <!-- Back Button -->
    <a href="/admin/products" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left-circle"></i> Back
    </a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
                <tr>
                    <td>{{ $brand->name }}</td>
                    <td>
                        <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
