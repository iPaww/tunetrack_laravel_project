<div class="container">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h2 class="title"><b>Products</b></h2>
        <div class="d-flex flex-wrap gap-2">
            <a class="btn btn-outline-dark" href="/admin/colors">Colors</a>
            <a class="btn btn-outline-dark" href="/admin/brands">Brands</a>
            <a class="btn btn-outline-dark" href="/admin/product_type">Product Type</a>
            <a class="btn btn-success" href="/admin/products/create">Create Product</a>
        </div>
    </div>

    <table class="table table-bordered table-striped table-hover text-center align-middle">
        <thead class="table-light">
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Description</th>
                {{-- <th>Category</th> --}}
                {{-- <th>Subcategory</th> --}}
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
                    {{-- <td>
                        @foreach ($categories as $category)
                            @if ($category->id == $product->category_id)
                                {{ $category->name }}
                            @endif
                        @endforeach
                    </td> --}}
                    {{-- <td>
                        @foreach ($subCategories as $subCategory)
                            @if ($subCategory->id == $product->sub_category_id)
                                {{ $subCategory->name }}
                            @endif
                        @endforeach
                    </td> --}}
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
                            <img src="{{ asset($product->image) }}" alt="Product Image" class="img-fluid"
                                style="max-width: 100px;">
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
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

<!-- Modal Notice -->
<div class="modal fade" id="noticeModal" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" id="noticeModalLabel">Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="noticeModalBody">
                <!-- The success message will be dynamically added here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = "{{ session('success') }}"; // Get the session success message

        if (successMessage) {
            const noticeModalBody = document.getElementById('noticeModalBody');
            const noticeModal = new bootstrap.Modal(document.getElementById('noticeModal'));

            // Set the success message in the modal body
            noticeModalBody.textContent = successMessage;

            // Show the modal
            noticeModal.show();
        }
    });
</script>
<script>
    const toggleSidebar = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    if (toggleSidebar) {
        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('visible');
            content.classList.toggle('expanded');
        });
    }
</script>
