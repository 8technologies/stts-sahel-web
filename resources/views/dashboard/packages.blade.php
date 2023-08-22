<style>
    .preordercrop-dropdown {
        margin-top: 10px;
    }
    .card {
        border: 1px solid green;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        padding: 20px;
    }
</style>

<div class="card">
    <div>
        <div class="card-header">
            <h3 class="card-title">Seed Packages</h3>
            <p>Compare Crop Quantities by Package</p>
        </div>
    </div>
    <div>
     
        <select id="crop-select" class="preordercrop-dropdown">
            <option value="all">Show All Crops</option>
        </select>
      
        <select id="year-select" class="year-dropdown">
            <!-- Year options will be generated dynamically -->
        </select>
    </div>
    <div style="width: 100%; margin: auto;">
        <canvas id="lineChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const data4 = <?php echo json_encode($crops_data); ?>;

        const cropNames = Array.from(new Set(data4.map(item => item.crop_name)));
        const packageYears = Array.from(new Set(data4.map(item => new Date(item.created_at).getFullYear())));

        const cropSelect8 = document.getElementById('crop-select');
        const yearSelect = document.getElementById('year-select');

        cropNames.forEach(cropName => {
            const cropOption = document.createElement('option');
            cropOption.value = cropName;
            cropOption.textContent = cropName;
            cropSelect8.appendChild(cropOption);
        });

        packageYears.forEach(year => {
            const yearOption = document.createElement('option');
            yearOption.value = year;
            yearOption.textContent = year;
            yearSelect.appendChild(yearOption);
        });

        let lineChart;

        function updateChart(selectedCrop, selectedYear) {
            const filteredData = data4.filter(item =>
                (selectedCrop === 'all' || item.crop_name === selectedCrop) &&
                new Date(item.created_at).getFullYear() === parseInt(selectedYear)
            );

            const packageNames = Array.from(new Set(filteredData.map(item => item.label_quantity))).sort();
            

            const datasets = cropNames.map(cropName => {
                const counts = packageNames.map(packageName => {
                    const item = filteredData.find(item => item.label_quantity === packageName && item.crop_name === cropName);
                    return item ? item.quantity : 0;
                });

                return {
                    label: cropName,
                    data: counts,
                    fill: false,
                    borderColor: getRandomColor(),
                };
            });

            if (lineChart) {
                lineChart.data.labels = packageNames;
                lineChart.data.datasets = datasets;
                lineChart.update();
            } else {
                lineChart = new Chart('lineChart', {
                    type: 'line',
                    data: {
                        labels: packageNames,
                        datasets: datasets,
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                               
                                title: {
                                    display: true,
                                    text: 'Package Size(kg)',
                                    font: {
                                        weight: 'bold',
                                        size: 16,
                                    },
                                },
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Quantity',
                                    font: {
                                        weight: 'bold',
                                        size: 16,
                                    },
                                },
                            },
                        },
                    },
                });
            }
        }

        function getRandomColor() {
            return '#' + Math.floor(Math.random() * 16777215).toString(16);
        }

        // Add event listeners to your filter elements
        cropSelect8.addEventListener('change', function () {
            const selectedCrop = cropSelect8.value;
            const selectedYear = yearSelect.value;
            updateChart(selectedCrop, selectedYear);
        });

        yearSelect.addEventListener('change', function () {
            const selectedCrop = cropSelect8.value;
            const selectedYear = yearSelect.value;
            updateChart(selectedCrop, selectedYear);
        });

        // Call your initial chart update here
        updateChart('all', packageYears[0]);
    </script>
</div>
