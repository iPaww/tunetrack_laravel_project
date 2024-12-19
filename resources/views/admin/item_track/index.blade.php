<div class="container mt-5">
    <h2 class="text-center mb-4">Manage Orders</h2>

    <!-- Display Orders Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Order Date</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $orders as $row )
                <tr>
                    <td>{{ $row['id'] }}</td>
                    <td>{{ $row['fullname'] }}</td>
                    <td>{{ $row['order_date'] }}</td>
                    <td>{{ $row['payment_method'] }}</td>
                    <td>{{ ucfirst($row['status']) }}</td>
                    <td>{{ $row['total_price'] }}</td>
                    <td>
                        <!-- Update Status Form -->
                        <form action="update_order_status.php" method="POST">
                            <input type="hidden" name="order_id" value="{{ $row['id'] }}">
                            <select name="status" class="form-select" required>
                                <option value="pending" {{ ($row['status'] == 'pending') ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ ($row['status'] == 'processing') ? 'selected' : '' }}>Processing</option>
                                <option value="Ready to Pickup" {{ ($row['status'] == 'Ready to Pickup') ? 'selected' : '' }}>Ready to Pickup</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    const toggleSidebar = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    toggleSidebar.addEventListener('click', () => {
        sidebar.classList.toggle('visible');
        content.classList.toggle('expanded');
    });
</script>