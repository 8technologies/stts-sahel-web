

<div class="card">
    <!--begin::Header-->
    <div >
        <div class="card-header">
            <h3 class="card-title">Seed Packages</h3>
            <div>
                <select id="time">
                    <option value="">This month</option>
                    <option value="time">yesterday</option>
                   
                </select>
            </div>
        </div>
    </div>
    <div style="width: 100%; margin: auto;">
        <canvas id="lineChart"></canvas>
    </div>

    <script>
        const data4 = <?php echo json_encode($crops_data); ?>;

        const packageNames = Array.from(new Set(data4.map(item => item.label_quantity)));
        const cropNames = Array.from(new Set(data4.map(item => item.crop_name)));
        const quantities = Array.from(new Set(data4.map(item => item.quantity)));

        const datasets = cropNames.map(cropName => {
            const counts = packageNames.map(packageName => {
                const item = data4.find(item => item.label_quantity === packageName && item.crop_name === cropName);
                return item ? item.quantity : 0;
            });

            return {
                label: cropName,
                data: counts,
                fill: false,
                borderColor: getRandomColor(),
            };
        });

        function getRandomColor() {
            return '#' + Math.floor(Math.random() * 16777215).toString(16);
        }

        const formattedpackageNames = packageNames.map(packageName => {
            return packageName + 'kg';
        })

        new Chart('lineChart', {
            type: 'line',
            data: {
                labels: formattedpackageNames,
                datasets: datasets,
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
