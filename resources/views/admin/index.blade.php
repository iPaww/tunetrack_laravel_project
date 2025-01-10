<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    <style>

    /* General card styling */
    .card {
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    /* Header styling */
    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #333333;
    }

    .display-6 {
        font-size: 2rem;
        font-weight: 700;
        color: #555555;
    }

    /* Button styles for interactivity */
    .btn-card {
        font-size: 0.9rem;
        font-weight: 600;
        color: #ffffff;
        background-color: #0069d9;
        border: none;
        border-radius: 20px;
        transition: background-color 0.3s ease;
    }

    .btn-card:hover {
        background-color: #004a99;
    }

    /* Responsive row spacing */
    .row>.col-md-3 {
        margin-bottom: 1.5rem;
    }

    /* Sales report card styling */
    .sales-report-card {
        background: linear-gradient(to bottom right, #f4f7fa, #e8ebf0);
        border: 1px solid #d1d9e0;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .sales-report-card:hover {
        transform: translateY(-5px);
        background: #e2e7ed;
    }

    .sales-report-card .card-title {
        font-size: 1rem;
        font-weight: bold;
        color: #0056b3;
    }

    .sales-report-card .d-flex span {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .sales-report-card .d-flex strong {
        font-size: 1rem;
        font-weight: 700;
        color: #333333;
    }

    /* Typography */
    h5.text-primary,
    h6.text-info {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 600;
    }

    /* Subtle color accents */
    .text-primary {
        color: #1d3557 !important;
    }

    .text-success {
        color: #2a9d8f !important;
    }

    .text-warning {
        color: #e76f51 !important;
    }

    .text-info {
        color: #457b9d !important;
    }

    /* Table improvements */
    .table {
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .table thead th {
        background-color: #f1f5fb;
        border-bottom: 2px solid #dee2e6;
        color: #495057;
    }

    .table tbody tr td {
        vertical-align: middle;
        color: #6c757d;
    }

    .badge {
        font-size: 0.85rem;
        font-weight: 600;
    }
</style>
<div class="container mt-4">
    <!-- Dashboard Overview Cards - First Row -->
    <div class="row mb-4">
        <!-- Total Admin -->
        <div class="col-md-3">
            <div class="card shadow-lg border-light rounded-3 h-100">
                <div class="card-body">
                    <h5 class="card-title text-center text-primary"><b>Total Admin</b></h5>
                    <p class="display-6 text-center text-muted mb-0">{{ $admin_data ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Total Instruments -->
        <div class="col-md-3">
            <div class="card shadow-lg border-light rounded-3 h-100">
                <div class="card-body">
                    <h5 class="card-title text-center text-success"><b>Total Instruments</b></h5>
                    <p class="display-6 text-center text-muted mb-0">{{ $inventory_data['total_instruments'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Total Cart Items -->
        <div class="col-md-3">
            <div class="card shadow-lg border-light rounded-3 h-100">
                <div class="card-body">
                    <h5 class="card-title text-center text-warning"><b>Total Cart Items</b></h5>
                    <p class="display-6 text-center text-muted mb-0">{{ $cart_data['total_cart_items'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Total Sales Today -->
        <div class="col-md-3">
            <div class="card shadow-lg border-light rounded-3 h-100">
                <div class="card-body">
                    <h5 class="card-title text-center text-info"><b>Today's Sales</b></h5>
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
                    <h5 class="card-title text-center text-primary mb-4"><b>Sales Overview</b></h5>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true">
                                Weekly
                            </button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                aria-selected="false">
                                Monthly
                            </button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                                aria-selected="false">
                                Yearly
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content mt-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab" tabindex="0">
                            <canvas id="salesChartWeek"></canvas>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                            tabindex="0">
                            <canvas id="salesChartMonth"></canvas>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"
                            tabindex="0">
                            <canvas id="salesChartYear"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top 10 Sales -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-light rounded-3">
                <div class="card-body">
                    <h5 class="card-title text-center text-primary mb-4"><b>Top 10 Sales</b></h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Product</th>
                                    <th class="text-end">Units</th>
                                    <th class="text-end">Sales</th>
                                </tr>
                            </thead>
                            <tbody style="overflow-y: auto;">
                                @forelse($top_selling_items as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            {{ Str::limit($item->product_name, 20) }}
                                            @if (strlen($item->product_name) > 20)
                                                <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip"
                                                    title="{{ $item->product_name }}">
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
                                            <span class="@if ($item->total_sales > 10000) text-success @endif">
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
                            @if ($top_selling_items->isNotEmpty())
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
    {{-- <div class="row">
        <div class="col-12">
            <h5 class="text-primary mb-3"><b> Sales Report</b></h5>
        </div>
        @forelse($sales_data as $data)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-light rounded-3">
                    <div class="card-body">
                        <h6 class="card-title text-center text-info">
                            {{ \Carbon\Carbon::parse($data->order_date)->format('M d, Y') }}</h6>
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
    </div> --}}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const salesDataWeek = @json($sales_data); //week
        const salesDataMonth = @json($previous_weeks_sales); //month
        const salesDataYear = @json($previous_years_sales); //year

        for (const [TimeType, salesData] of [
                ['Week', salesDataWeek],
                ['Month', salesDataMonth],
                ['Year', salesDataYear]
            ]) {
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
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
