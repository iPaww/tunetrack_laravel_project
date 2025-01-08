<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mt-4">
    <!-- Dashboard Overview -->
    <div class="dashboard-overview">
        <div class="row">
            <!-- Total Admin -->
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card shadow-lg border-light rounded-3">
                    <div class="card-body">
                        <h5 class="card-title text-center text-primary">Total Admin</h5>
                        <p class="lead text-center text-muted">{{ $admin_data ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Instruments -->
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card shadow-lg border-light rounded-3">
                    <div class="card-body">
                        <h5 class="card-title text-center text-success">Total Instruments</h5>
                        <p class="lead text-center text-muted">{{ $inventory_data['total_instruments'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Cart Items -->
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card shadow-lg border-light rounded-3">
                    <div class="card-body">
                        <h5 class="card-title text-center text-warning">Total Cart Items</h5>
                        <p class="lead text-center text-muted">{{ $cart_data['total_cart_items'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Report as Cards -->
    <div class="sales-report mt-4">
        <div class="row">
            @forelse($sales_data as $data)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card shadow-lg border-light rounded-3">
                        <div class="card-body">
                            <h5 class="card-title text-center text-info">Date: {{ $data->order_date }}</h5>
                            <p class="text-center">Total Orders: <strong class="text-dark">{{ $data->total_orders }}</strong></p>
                            <p class="text-center">Total Sales: <strong class="text-success">P{{ number_format($data->total_sales, 2) }}</strong></p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">No sales data available</div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Bar Graph for Sales -->
    <div class="bargraph mt-4">
        <div class="row">
            <div class="col-12">
                <canvas id="salesBarGraph" width="500" height="250"></canvas> <!-- Set specific width and height -->
            </div>
        </div>
    </div>

    <script>
        // Get data from the view
        const labels = @json($labels);
        const sales = @json($sales);

        // Create the bar graph using Chart.js
        const ctx = document.getElementById('salesBarGraph').getContext('2d');
        const salesBarGraph = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels, // X-axis labels (Today vs Previous)
                datasets: [{
                    label: 'Sales',
                    data: sales, // Y-axis data (Sales values)
                    backgroundColor: ['#4caf50', '#2196f3'], // Different colors for each bar
                    borderColor: ['#388e3c', '#1976d2'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true, // Maintain aspect ratio
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            beginAtZero: true,
                            stepSize: 100
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</div>
