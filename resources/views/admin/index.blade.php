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

    <!-- Sales Bar Graph and Charts Row -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card shadow-lg border-light rounded-3">
                <div class="card-body">
                    <h5 class="card-title text-center text-primary">Daily Sales Overview</h5>
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg border-light rounded-3">
                <div class="card-body">
                    <h5 class="card-title text-center text-primary">Top 10 Sales</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Product</th>
                                    <th class="text-end">Units</th>
                                    <th class="text-end">Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($top_selling_items as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            {{ Str::limit($item->product_name, 20) }}
                                            @if(strlen($item->product_name) > 20)
                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" title="{{ $item->product_name }}">
                                                    <i class="fas fa-info-circle text-info"></i>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <span class="badge bg-primary">
                                                {{ number_format($item->total_quantity) }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <span class="@if($item->total_sales > 10000) text-success @endif">
                                                ₱{{ number_format($item->total_sales, 2) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">
                                            <i class="fas fa-box-open me-2"></i>No sales data available
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if($top_selling_items->isNotEmpty())
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="2" class="text-end fw-bold">Total:</td>
                                        <td class="text-end fw-bold">
                                            {{ number_format($top_selling_items->sum('total_quantity')) }}
                                        </td>
                                        <td class="text-end fw-bold">
                                            ₱{{ number_format($top_selling_items->sum('total_sales'), 2) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
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
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const salesData = @json($sales_data);//week
        const salesDataMonth = @json($sales_data);//month
        const salesDataYear = @json($sales_data);//year

        const dates = salesData.map(item => item.order_date);
        const sales = salesData.map(item => item.total_sales);

        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Daily Sales (PHP)',
                    data: sales,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 2,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₱' + value.toLocaleString();
                            }
                        },
                        min: 0,
                        suggestedMax: Math.max(...sales) * 1.1,
                        grace: '5%'
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '₱' + context.raw.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>