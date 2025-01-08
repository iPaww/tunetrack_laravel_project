<div class="container mt-4">
    <!-- Dashboard Overview -->
    <div class="dashboard-overview">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total Orders</h5>
                        <p class="lead text-center">{{ $orders_data['total_orders'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total Sales</h5>
                        <p class="lead text-center">${{ number_format($orders_data['total_sales'], 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total Admin</h5>
                        <p class="lead text-center">{{ $admin_data['total_admin'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inventory Overview -->
    <div class="inventory-overview">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total Instruments</h5>
                        <p class="lead text-center">{{ $inventory_data['total_instruments'] }}</p>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total Supplies</h5>
                        <p class="lead text-center">{{ $supply_data['total_supplies'] }}</p>
                    </div>
                </div>
            </div> --}}
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center">Total Cart Items</h5>
                        <p class="lead text-center">{{ $cart_data['total_cart_items'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
