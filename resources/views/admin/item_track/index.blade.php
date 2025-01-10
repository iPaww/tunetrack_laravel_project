<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Heading -->
        <h2 class="text-center mb-0"><b>Manage Orders</b></h2>

        <!-- Filter Dropdown (Align Right) -->
        <form action="{{ route('itemTrack.index') }}" method="GET" class="mb-0">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="1" {{ request()->status == '1' ? 'selected' : '' }}>Pending</option>
                <option value="2" {{ request()->status == '2' ? 'selected' : '' }}>Processing</option>
                <option value="3" {{ request()->status == '3' ? 'selected' : '' }}>Ready to Pickup</option>
            </select>
        </form>
    </div>

    <!-- Display Orders Table -->
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
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user ? $order->user->fullname : 'N/A' }}</td>
                    <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        <!-- Display Order Items -->
                        @if($order->orderItems)
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
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
</div>

@if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

<script>
    const toggleSidebar = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    toggleSidebar.addEventListener('click', () => {
        sidebar.classList.toggle('visible');
        content.classList.toggle('expanded');
    });
</script>
