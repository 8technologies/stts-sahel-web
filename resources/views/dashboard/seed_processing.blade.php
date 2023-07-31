

<div class="card">
    <!--begin::Header-->
    <div class="d-flex justify-content-between ">
        <div class="card-header">
            <h3 class="card-title">Marketable vs Raw Seed</h3>
            <div>
                <select id="cropSelect" onchange="updateChart()">
                    <option value="">Select Crop</option>
                    <option value="Show All">Show All</option>
                    <?php foreach ($crop_names as $crop_name) : ?>
                        <option value="<?php echo $crop_name; ?>"><?php echo $crop_name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <div style="width: 80%; margin: auto;">
        <canvas id="cropChart" width="400" height="200"></canvas>
    </div>

    <script>
        // Retrieve the data passed from the Laravel controller
        var cropData = <?php echo json_encode($data); ?>;
        var crop_names = <?php echo json_encode($crop_names); ?>;

        // Extract the labels (crop names) and datasets (processed and unprocessed counts) from the data
        var labels = Object.values(crop_names);
        var processedData = Object.values(cropData).map(data => data.marketable_seeds);
        var unprocessedData = Object.values(cropData).map(data => data.load_stocks);

        var ctx = document.getElementById('cropChart').getContext('2d');
        var cropChart;

        function updateChart() {
            var selectedCrop = document.getElementById('cropSelect').value;

            if (selectedCrop === "Show All") {
                // Show all crops
                cropChart.data.labels = labels;
                cropChart.data.datasets[0].data = processedData;
                cropChart.data.datasets[1].data = unprocessedData;
            } else {
                // Show only the selected crop
                var selectedIndex = labels.indexOf(selectedCrop);
                cropChart.data.labels = [selectedCrop];
                cropChart.data.datasets[0].data = [processedData[selectedIndex]];
                cropChart.data.datasets[1].data = [unprocessedData[selectedIndex]];
            }

            cropChart.update();
        }

        cropChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels.slice(0, 5), // Show only the first five crops initially
                datasets: [{
                        label: 'Processed Seeds',
                        data: processedData.slice(0, 5), // Show only the first five crops initially
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderWidth: 1
                    },
                    {
                        label: 'Unprocessed Seeds',
                        data: unprocessedData.slice(0, 5), // Show only the first five crops initially
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true
                    }
                }
            }
        });
    </script>
</div>