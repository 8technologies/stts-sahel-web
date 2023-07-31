<style>
        .card {
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    /* border color */
        border: 1px solid #007bff;
        margin-bottom: 30px;
        /* padding around */
        padding: 20px;
    } 
    .crop-dropdown {
        margin-top: 10px;
    }
</style>

<div class="card">
    <div class="d-flex justify-content-between px-3 px-md-4">
        <div class="card-header">
            <h3 class="card-title">My Stock</h3>
        </div>
    </div>
   <div>
    <canvas id="myStockChart"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Get the PHP data passed to the view
        var stockCount = <?php echo json_encode($stock_count); ?>;
        var seedLabsCount = <?php echo json_encode($seed_labs_count); ?>;
        var seedLabelsCount = <?php echo json_encode($seed_labels_count); ?>;
        
        var labels = ['Stock Count', 'Seed Labs Count', 'Seed Labels Count'];

        // Create the bar graph
        var ctx = document.getElementById('myStockChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Stock stats',
                    data: [stockCount, seedLabsCount, seedLabelsCount],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>
