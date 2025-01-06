<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title">PRODUCTS</h2>
        <div>
            <a class="btn btn-outline-dark m-1" href="/admin/colors">Colors</a>
            <a class="btn btn-outline-dark m-1" href="/admin/brands">Brands</a>
            <a class="btn btn-outline-dark m-1" href="/admin/product_type">Product Type</a>
            <a class="btn btn-success m-1" href="/admin/products/create">Create Product</a>
        </div>
    </div>

    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Product Type</th>
                <th>Brand</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                    <td>{{ Str::limit($product->description, 50) }}</td>
                    <td>
                        @foreach ($categories as $category)
                            @if ($category->id == $product->category_id)
                                {{ $category->name }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($subCategories as $subCategory)
                            @if ($subCategory->id == $product->sub_category_id)
                                {{ $subCategory->name }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($productTypes as $productType)
                            @if ($productType->id == $product->product_type_id)
                                {{ $productType->name }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($brands as $brand)
                            @if ($brand->id == $product->brand_id)
                                {{ $brand->name }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if ($product->image)
                            <div class="mt-2">
                                <img src="{{ asset($product->image) }}" alt="Product Image" width="100">
                            </div>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a class="btn btn-warning btn-sm"
                                href="{{ route('admin.products.edit', $product->id) }}">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
</div>

<!-- Custom Styling -->
<style>
    .table th,
    .table td {
        text-align: center;
        vertical-align: middle;
    }

    .table img {
        max-width: 100px;
        max-height: 100px;
        object-fit: cover;
    }

    .title {
        font-size: 2rem;
        font-weight: bold;
    }

    .btn-outline-dark,
    .btn-success {
        font-weight: bold;
    }

    .btn-outline-dark:hover {
        background-color: #007bff;
        color: white;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .thead-dark th {
        background-color: #343a40;
        color: white;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2;
    }

    .btn-group .btn {
        margin-right: 0.5rem;
    }
</style>
