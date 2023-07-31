
<div class="card mb-4 mb-md-5 border-0">
    <!--begin::Header-->
    <div >
        <div class="card-header">
            <h3 class="card-title">Quality Declared Seed</h3>
            <div>
                <a href="{{ admin_url('/seed-lab-tests') }}" class="btn-view-all">View</a>
            </div>
        </div>
    </div>
    <div class="card-body py-2 py-md-3">
        <canvas id="mixed-chart" style="width: 100%;"></canvas>
    </div>
</div>

<script>
    $(function() {
        var ctx = document.getElementById('mixed-chart').getContext('2d');

        // Dummy data
        var months = JSON.parse('<?php echo json_encode($labels); ?>');
        var seedProductionData = <?php echo json_encode($seeds); ?>;
        var marketable = <?php echo json_encode($is_seed_marketable); ?>;
        var unmarketable = <?php echo json_encode($is_seed_unmarketable); ?>;


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
            label: 'Marketable Seeds',
            data: marketable,
            borderColor: 'rgb(255, 99, 132)',
            backgroundColor: 'transparent',
            type: 'line',
            yAxisID: 'growth-axis'
        });

        mixedChart.data.datasets.push({
            label: 'Unmarketable Seeds',
            data: unmarketable,
            borderColor: 'rgb(153, 102, 255)',
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