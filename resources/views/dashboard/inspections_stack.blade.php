<style>
    .card {
        border-radius: 5px;
    }
</style>

<div class="card mb-4 mb-md-5 border-0">
    <!--begin::Header-->
    <div class="d-flex justify-content-between px-3 px-md-4">
        <div class="card-header">
            <h3 class="card-title">Inspections</h3>
            <div>
                <a href="{{ admin_url('/seed-lab-tests') }}" class="btn-view-all">View</a>
            </div>
        </div>
    </div>
    <div style="width: 80%; margin: 0 auto;">
        <canvas id="stackedBarChart"></canvas>
    </div>

    <script>
        // Dummy data for the stacked bar chart
        var chartData = {
            labels: ['January', 'February', 'March'],
            datasets: [{
                    label: 'Apples',
                    data: [30, 40, 25],
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                },
                {
                    label: 'Oranges',
                    data: [20, 10, 15],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                },
                {
                    label: 'Bananas',
                    data: [15, 20, 10],
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                },
            ],
        };

        // Create the stacked bar chart
        var ctx = document.getElementById('stackedBarChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true,
                    },
                },
            },
        });
    </script>