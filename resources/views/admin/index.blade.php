<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mt-4">
    <!-- Dashboard Overview Cards - First Row -->
    <div class="row mb-4">
        <!-- Total Admin -->
        <div class="col-md-3">
            <div class="card shadow-lg border-light rounded-3 h-100">
                <div class="card-body">
                    <h5 class="card-title text-center text-primary">Total Admin</h5>
                    <p class="display-6 text-center text-muted mb-0">{{ $admin_data ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Total Instruments -->
        <div class="col-md-3">
            <div class="card shadow-lg border-light rounded-3 h-100">
                <div class="card-body">
                    <h5 class="card-title text-center text-success">Total Instruments</h5>
                    <p class="display-6 text-center text-muted mb-0">{{ $inventory_data['total_instruments'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Total Cart Items -->
        <div class="col-md-3">
            <div class="card shadow-lg border-light rounded-3 h-100">
                <div class="card-body">
                    <h5 class="card-title text-center text-warning">Total Cart Items</h5>
                    <p class="display-6 text-center text-muted mb-0">{{ $cart_data['total_cart_items'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Total Sales Today -->
        <div class="col-md-3">
            <div class="card shadow-lg border-light rounded-3 h-100">
                <div class="card-body">
                    <h5 class="card-title text-center text-info">Today's Sales</h5>
                    <p class="display-6 text-center text-muted mb-0">
                        ₱{{ number_format($sales_data->first()->total_sales ?? 0, 2) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Top Sales - Second Row -->
    <div class="row">
        <!-- Sales Charts -->
        <div class="col-md-8 mb-4">
            <div class="card shadow-lg border-light rounded-3">
                <div class="card-body">
                    <h5 class="card-title text-center text-primary mb-4">Sales Overview</h5>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                                Weekly
                            </button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                                Monthly
                            </button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
                                Yearly
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content mt-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                            <canvas id="salesChartWeek"></canvas>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                            <canvas id="salesChartMonth"></canvas>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                            <canvas id="salesChartYear"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top 10 Sales -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-light rounded-3 h-100">
                <div class="card-body">
                    <h5 class="card-title text-center text-primary mb-4">Top 10 Sales</h5>
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

    <!-- Sales Report Cards - Third Row -->
    <div class="row">
        <div class="col-12">
            <h5 class="text-primary mb-3">Daily Sales Report</h5>
        </div>
        @forelse($sales_data as $data)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-light rounded-3">
                    <div class="card-body">
                        <h6 class="card-title text-center text-info">{{ \Carbon\Carbon::parse($data->order_date)->format('M d, Y') }}</h6>
                        <div class="d-flex justify-content-between mt-3">
                            <span>Orders:</span>
                            <strong class="text-dark">{{ $data->total_orders }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span>Sales:</span>
                            <strong class="text-success">₱{{ number_format($data->total_sales, 2) }}</strong>
                        </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const salesDataWeek = @json($sales_data); //week
        const salesDataMonth = @json($previous_weeks_sales); //month
        const salesDataYear = @json($previous_years_sales); //year

        for ( const [TimeType, salesData] of [['Week', salesDataWeek], ['Month', salesDataMonth], ['Year', salesDataYear]] ) {
            const dates = salesData.map(item => item.order_date);
            const sales = salesData.map(item => item.total_sales);
            console.log(TimeType, salesData)
            const ctx = document.getElementById('salesChart' + TimeType).getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dates,
                    datasets: [{
                        label: TimeType + ' Sales (PHP)',
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
        }

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>