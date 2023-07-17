<!DOCTYPE html>
<html>
<head>
    <title>Seed Production Growth</title>
    <style>
        .card {
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="card mb-4 mb-md-5 border-0">
        <!--begin::Header-->
        <div class="d-flex justify-content-between px-3 px-md-4">
        <div class="card-header">
            <h3 class="card-title">Recent Crop Declarations</h3>
            <div>
                <a href="{{ admin_url('/crop-declarations') }}" class="btn-view-all">Action</a>
            </div>
        </div>
     </div>
        <div class="card-body py-2 py-md-3">
            <canvas id="mixed-chart" style="width: 100%;"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx = document.getElementById('mixed-chart').getContext('2d');

            // Dummy data
            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
            var seedProductionData = [200, 350, 400, 450, 380, 500];
            var seedAGrowthData = [50, 60, 70, 80, 75, 90];
            var seedBGrowthData = [40, 55, 45, 70, 65, 80];
            var seedCGrowthData = [30, 45, 35, 50, 55, 60];

            var mixedChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Seed Production',
                        data: seedProductionData,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Months'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Seed Production'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });

            mixedChart.data.datasets.push({
                label: 'Seed A Growth',
                data: seedAGrowthData,
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'transparent',
                type: 'line',
                yAxisID: 'growth-axis'
            });

            mixedChart.data.datasets.push({
                label: 'Seed B Growth',
                data: seedBGrowthData,
                borderColor: 'rgb(153, 102, 255)',
                backgroundColor: 'transparent',
                type: 'line',
                yAxisID: 'growth-axis'
            });

            mixedChart.data.datasets.push({
                label: 'Seed C Growth',
                data: seedCGrowthData,
                borderColor: 'rgb(255, 205, 86)',
                backgroundColor: 'transparent',
                type: 'line',
                yAxisID: 'growth-axis'
            });

            mixedChart.options.scales.y.growthAxis = {
                id: 'growth-axis',
                type: 'linear',
                position: 'right',
                display: true,
                title: {
                    display: true,
                    text: 'Seed Growth'
                },
                beginAtZero: true
            };

            mixedChart.update();
        });
    </script>
</body>
</html>
