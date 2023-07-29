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

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Marketable Seed Stock</h3>
    </div>

    <div class="card-body">
        <canvas id="pie-chart"></canvas>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Function to generate a random color
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    $(function() {
        var ctx = document.getElementById('pie-chart').getContext('2d');

        // Dummy data
        var seedProductionData = <?php echo json_encode($counts); ?>;
        var labels = <?php echo json_encode($names); ?>;

        // Generate an array of random colors based on the number of datasets
        var backgroundColors = [];
        for (let i = 0; i < seedProductionData.length; i++) {
            backgroundColors.push(getRandomColor());
        }

        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: seedProductionData,
                    backgroundColor: backgroundColors,
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