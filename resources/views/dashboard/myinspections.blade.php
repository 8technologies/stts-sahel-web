<style>
  
    .crop-dropdown {
        margin-top: 10px;
    }
</style>

<div class="card">
    <div >
        <div class="card-header">
            <h3 class="card-title">My Inspections</h3>
        </div>
    </div>
   <div>
    <canvas id="barGraph"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
         // Data from PHP function
         var inspectionData = <?php echo json_encode($inspections); ?>;

        // Create an array to hold labels and counts for the bar graph
        var labels = Object.keys(inspectionData);
        var counts = Object.values(inspectionData);

        // Create the bar graph
        var ctx = document.getElementById('barGraph').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Inspections',
                    data: counts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)', // Pending
                        'rgba(54, 162, 235, 0.6)', // Accepted
                        'rgba(75, 192, 192, 0.6)', // Rejected
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
