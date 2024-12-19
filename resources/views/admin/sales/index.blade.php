<!-- Chart Section -->
<div class="chart-container">
    <canvas id="myChart"></canvas>
</div>

<!-- Add Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart.js Script -->
<script>
    // PHP dynamic data for the chart
    var chartLabels = <?= json_encode($order_dates) ?>; // Days of the week
    var chartData = <?= json_encode($order_counts) ?>; // Number of orders for each day

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line', // Line chart
        data: {
            labels: chartLabels, // Use dynamic labels (days of the week)
            datasets: [{
                label: 'Total Orders', // Label for the dataset
                data: chartData, // Use dynamic data (order counts)
                borderColor: 'rgba(75, 192, 192, 1)', // Line color
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Fill color
                tension: 0.1, // Smooth curve for the line
                fill: true // Fill the area under the line
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Orders in the Last 7 Days' // Title of the graph
                }
            },
            scales: {
                y: {
                    beginAtZero: true // Ensure the Y-axis starts at 0
                }
            }
        }
    });
</script>