<!-- Ensure Bootstrap JS is included -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-center mb-0"><b>Manage Orders</b></h2>

        <form action="{{ route('itemTrack.index') }}" method="GET" class="d-flex align-items-center gap-2">
            <input type="text" name="order_id" class="form-control" placeholder="Search by Order ID"
                value="{{ request()->order_id }}" style="max-width: 200px;">
            <select name="status" class="form-select" onchange="this.form.submit()" style="max-width: 150px;">
                <option value="">All Status</option>
                <option value="1" {{ request()->status == '1' ? 'selected' : '' }}>Pending</option>
                <option value="2" {{ request()->status == '2' ? 'selected' : '' }}>Processing</option>
                <option value="3" {{ request()->status == '3' ? 'selected' : '' }}>Ready to Pickup</option>
                <option value="4" {{ request()->status == '4' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Order Date</th>
                    <th>Products</th>
                    <th>Payment Method</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($orders->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center text-danger fw-bold">No Order ID Found</td>
                    </tr>
                @else
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user ? $order->user->fullname : 'N/A' }}</td>
                            <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                            <td>
                                @if ($order->orderItems->isNotEmpty())
                                    <button type="button" class="btn btn-sm text-white view-order-details" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#productDetailsModal"
                                        data-products="{{ json_encode($order->orderItems->map(function($item) {
                                            return [
                                                'product_name' => $item->product->name ?? 'No Name',
                                                'quantity' => $item->quantity ?? '???',
                                                'color' => $item->InventoryProduct && $item->InventoryProduct->color ? $item->InventoryProduct->color->name : 'No Color',

                                                'serials' => $item->inventoryProducts->pluck('serial_number')->implode(', '), // Fix here
                                            ];
                                        })) }}"
                                        style="background-color: #D84315;"> 
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                @endif
                            </td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ $order->total }}</td>
                            <td>
                                <form action="{{ route('itemTrack.updateStatus') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <select name="status" class="form-select" required>
                                        <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Pending</option>
                                        <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Processing</option>
                                        <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Ready to Pickup</option>
                                        <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                                    <button type="button" class="btn btn-primary mt-2 apply-pwd-discount" data-order-id="{{ $order->id }}">
                                        Apply PWD Discount
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    {{ $orders->appends(request()->except('page'))->links() }}
    {{-- {{ $orders->links() }} --}}
</div>

<!-- Order Details Modal -->
<div class="modal fade" id="productDetailsModal" tabindex="-1" aria-labelledby="productDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productDetailsModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="modal-product-list"></ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Success Notice Modal -->
@if (session('success'))
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ session('success') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        }
    </script>
@endif

<!-- JavaScript for Viewing Order Details -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".view-order-details").forEach(button => {
        button.addEventListener("click", function () {
            let productsJson = this.getAttribute("data-products");

            try {
                let products = JSON.parse(productsJson);
                let modalList = document.getElementById("modal-product-list");
                modalList.innerHTML = "";

                if (!Array.isArray(products) || products.length === 0) {
                    modalList.innerHTML = "<li>No products found</li>";
                } else {
                    products.forEach(item => {
                        let listItem = document.createElement("li");
                        let serialNumbers = item.serials ? item.serials : "No Serial Number"; 
                        listItem.innerHTML = `<strong>${item.product_name}</strong> - Quantity: ${item.quantity} - Color: ${item.color}`;
                        modalList.appendChild(listItem);
                    });
                }
            } catch (error) {
                console.error("Error parsing JSON:", error);
                document.getElementById("modal-product-list").innerHTML = "<li>Error loading products</li>";
            }
        });
    });
});
document.addEventListener("DOMContentLoaded", function () {
    // Ensure modals close properly and remove backdrop
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
        button.addEventListener("click", function () {
            let modal = document.getElementById("productDetailsModal");
            let backdrop = document.querySelector(".modal-backdrop");

            if (modal) {
                let bootstrapModal = bootstrap.Modal.getInstance(modal);
                if (bootstrapModal) {
                    bootstrapModal.hide();
                }
            }

            // Remove any lingering backdrop
            if (backdrop) {
                backdrop.remove();
                document.body.classList.remove("modal-open"); // Remove body class
            }
        });
    });

    // Handle escape key press to remove backdrop
    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            let backdrop = document.querySelector(".modal-backdrop");
            if (backdrop) {
                backdrop.remove();
                document.body.classList.remove("modal-open");
            }
        }
    });
});

</script>



<!-- JavaScript for Applying PWD Discount -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".apply-pwd-discount").forEach(button => {
            button.addEventListener("click", function () {
                let orderId = this.getAttribute("data-order-id");

                fetch("{{ route('itemTrack.applyPwdDiscount') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: JSON.stringify({ order_id: orderId }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("PWD Discount Applied Successfully!");
                        location.reload();
                    } else {
                        alert("Failed to apply discount: " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                });
            });
        });
    });
</script>
