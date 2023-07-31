

<div class="card">
    <!--begin::Header-->
    <div >
        <div class="card-header">
            <h3 class="card-title">Inspections</h3>
            <div>
                <a href="{{ admin_url('/field-inspections') }}" class="btn-view-all">View</a>
            </div>
        </div>
    </div>
    <div style="width: 100%; margin: 0 auto;">
        <canvas id="inspectionsChart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Retrieve the chart data passed from the controller
        var chartData = <?php echo json_encode($chartData); ?>;

        // Create the stacked bar chart
        var ctx = document.getElementById('inspectionsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [
                    // Accepted and Rejected stacked together
                    {
                        label: chartData.datasets[0].label,
                        data: chartData.datasets[0].data,
                        backgroundColor: chartData.datasets[0].backgroundColor,
                    },
                    // Accepted and Rejected stacked together
                    {
                        label: chartData.datasets[1].label,
                        data: chartData.datasets[1].data,
                        backgroundColor: chartData.datasets[1].backgroundColor,
                    },
                    // Pending and Processed stacked together
                    {
                        label: chartData.datasets[2].label,
                        data: chartData.datasets[2].data,
                        backgroundColor: chartData.datasets[2].backgroundColor,
                    },
                    // Pending and Processed stacked together
                    {
                        label: chartData.datasets[3].label,
                        data: chartData.datasets[3].data,
                        backgroundColor: chartData.datasets[3].backgroundColor,
                    },
                ],
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                    },
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y;
                                }
                                return label;
                            },
                        },
                    },
                },
            },
        });
    </script>