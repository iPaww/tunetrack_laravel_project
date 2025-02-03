<div class="container">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h2 class="title"><b>Products</b></h2>
        <div class="d-flex flex-wrap gap-2">
            <form action="{{ route('admin.products.index') }}" method="GET" class="d-flex gap-2 align-items-center">
                <div class="input-group shadow-sm">
                    <input
                        type="text"
                        name="query"
                        class="form-control border-secondary rounded-start"
                        placeholder="Search products..."
                        value="{{ request('query') }}"
                        aria-label="Search products"
                        style="border-color: #6c757d;"
                    >
                    <button
                        type="submit"
                        class="btn btn-primary d-flex align-items-center"
                        style="background: linear-gradient(90deg, #6c757d, #495057); border: none;"
                    >
                        <i class="fas fa-search me-1"></i> Search
                    </button>
                </div>
            </form>
            <a class="btn btn-outline-dark shadow-sm" href="/admin/colors">
                <i class="fas fa-palette me-1"></i> Colors
            </a>
            <a class="btn btn-outline-dark shadow-sm" href="/admin/brands">
                <i class="fas fa-tags me-1"></i> Brands
            </a>
            <a class="btn btn-outline-dark shadow-sm" href="/admin/product_type">
                <i class="fas fa-cubes me-1"></i> Product Type
            </a>
            <a
                class="btn btn-success shadow-sm d-flex align-items-center"
                href="/admin/products/create"
                style="background: linear-gradient(90deg, #007bff, #0056b3); border: none;"
            >
                <i class="fas fa-plus me-1"></i> Create Product
            </a>
        </div>
    </div>

    <!-- Make the table responsive -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Discount (%)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>₱{{ number_format($product->price, 2) }}</td>
                        <td>{{ number_format($product->discount, 2) }}%</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info btn-sm me-2 rounded" data-bs-toggle="modal" data-bs-target="#viewProductModal" 
                                    data-name="{{ $product->name }}" 
                                    data-price="{{ number_format($product->price, 2) }}"
                                    data-discount="{{ number_format($product->discount, 2) }}"
                                    data-description="{{ $product->description }}"
                                    data-finalprice="₱{{ number_format($product->price - ($product->price * ($product->discount / 100)), 2) }}"
                                    data-type="{{ optional($product->productType)->name }}"
                                    data-brand="{{ optional($product->brand)->name }}"
                                    data-image="{{ asset('storage/'.$product->image) }}">
                                    View
                                </button>

                        
                                <a class="btn btn-warning btn-sm me-2 rounded" href="{{ route('admin.products.edit', $product->id) }}">Edit</a>
                                
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No product found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

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

<!-- View Product Modal -->
<div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewProductModalLabel">Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Product Image -->
                <div class="text-center mb-3">
                    <img id="modalProductImage" src="" alt="Product Image" class="img-fluid rounded" style="max-width: 300px; max-height: 300px;">
                </div>

                <!-- Product Details Table -->
                <table class="table table-bordered">
                    <tr>
                        <th>Product Name</th>
                        <td id="modalProductName"></td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td id="modalProductPrice"></td>
                    </tr>
                    <tr>
                        <th>Discount</th>
                        <td id="modalProductDiscount"></td>
                    </tr>
                    <tr>
                        <th>Final Price</th>
                        <td id="modalProductFinalPrice"></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td id="modalProductDescription"></td>
                    </tr>
                    <tr>
                        <th>Product Type</th>
                        <td id="modalProductType"></td>
                    </tr>
                    <tr>
                        <th>Brand</th>
                        <td id="modalProductBrand"></td>
                    </tr>
                </table>
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var viewProductModal = document.getElementById("viewProductModal");

        viewProductModal.addEventListener("show.bs.modal", function (event) {
            var button = event.relatedTarget;

            // Retrieve product details from button attributes
            var productName = button.getAttribute("data-name");
            var productPrice = button.getAttribute("data-price");
            var productDiscount = button.getAttribute("data-discount");
            var productFinalPrice = button.getAttribute("data-finalprice");
            var productDescription = button.getAttribute("data-description");
            var productType = button.getAttribute("data-type");
            var productBrand = button.getAttribute("data-brand");
            var productImage = button.getAttribute("data-image");

            // Insert data into modal fields
            document.getElementById("modalProductName").textContent = productName;
            document.getElementById("modalProductPrice").textContent = "₱" + productPrice;
            document.getElementById("modalProductDiscount").textContent = productDiscount + "%";
            document.getElementById("modalProductFinalPrice").textContent = productFinalPrice;
            document.getElementById("modalProductDescription").textContent = productDescription;
            document.getElementById("modalProductType").textContent = productType ? productType : "N/A";
            document.getElementById("modalProductBrand").textContent = productBrand ? productBrand : "N/A";

            // Set image source
            var imageElement = document.getElementById("modalProductImage");
            if (productImage) {
                imageElement.src = productImage;
                imageElement.style.display = "block";
            } else {
                imageElement.style.display = "none";
            }
        });
    });
</script>
