<!DOCTYPE html>
<html>
<head>
    <title>Seed Stock</title>
    <style>
        .chart-container {
            position: relative;
            margin-top: 20px;
            width: 400px;
            height: 400px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .chart-legend {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        .legend-item span {
            margin-left: 5px;
        }
    </style>
</head>
<body>
<div class="card" >
    <div class="card-header">
        <h3 class="card-title">Seed Stock</h3>
    </div>

    <div class="card-body">
        <canvas id="pie-chart"></canvas>
    </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx = document.getElementById('pie-chart').getContext('2d');

            // Dummy data
            var seedProductionData = [400, 350, 250]; // Seed A, Seed B, Seed C

            var pieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Seed A', 'Seed B', 'Seed C'],
                    datasets: [{
                        data: seedProductionData,
                        backgroundColor: ['#4CAF50', '#FF4081', '#3F51B5'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>
</body>
</html>
