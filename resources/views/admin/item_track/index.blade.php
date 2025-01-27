<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Heading -->
        <h2 class="text-center mb-0"><b>Manage Orders</b></h2>

        <!-- Search and Filter Form -->
        <form action="{{ route('itemTrack.index') }}" method="GET" class="d-flex align-items-center gap-2">
            <input
                type="text"
                name="order_id"
                class="form-control"
                placeholder="Search by Order ID"
                value="{{ request()->order_id }}"
                style="max-width: 200px;"
            >
            <select
                name="status"
                class="form-select"
                onchange="this.form.submit()"
                style="max-width: 150px;"
            >
                <option value="">All Status</option>
                <option value="1" {{ request()->status == '1' ? 'selected' : '' }}>Pending</option>
                <option value="2" {{ request()->status == '2' ? 'selected' : '' }}>Processing</option>
                <option value="3" {{ request()->status == '3' ? 'selected' : '' }}>Ready to Pickup</option>
                <option value="4" {{ request()->status == '4' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Order Date</th>
                    <th>Products</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($orders->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center text-danger fw-bold">No Order ID Found</td>
                    </tr>
                @else
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user ? $order->user->fullname : 'N/A' }}</td>
                            <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                            <td>
                                @if ($order->orderItems)
                                    <ul>
                                        @foreach ($order->orderItems as $item)
                                            <li>
                                                {{ $item->product->name ?? 'No Name' }} - Quantity: {{ $item->quantity }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ $statusMap[$order->status] ?? 'Unknown' }}</td>
                            <td>{{ $order->total }}</td>
                            <td>
                                <form action="{{ route('itemTrack.updateStatus') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <select name="status" class="form-select" required>
                                        <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Pending</option>
                                        <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Processing</option>
                                        <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Ready to Pickup</option>
                                        <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Cancel</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    {{ $orders->links() }}
</div>

<!-- Success Notice Modal -->
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

@if (session('success'))
    <script>
        window.onload = function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        }
    </script>
@endif

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const toggleSidebar = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    toggleSidebar.addEventListener('click', () => {
        sidebar.classList.toggle('visible');
        content.classList.toggle('expanded');
    });
</script>
