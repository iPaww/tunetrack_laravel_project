<div class="container">
    <h1><b>PRODUCT TYPE</b></h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('product_type.create') }}" class="btn btn-primary mb-3">Add New Product Type</a>
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
            @foreach ($productTypes as $productType)
                <tr>
                    <td>{{ $productType->name }}</td>
                    <td>
                        <a href="{{ route('product_type.edit', $productType->id) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('product_type.destroy', $productType->id) }}" method="POST"
                            style="display:inline;">
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
