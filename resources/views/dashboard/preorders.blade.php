<style>
   
    .preordercrop-dropdown {
        margin-top: 10px;
    }
</style>

<div class="card">
    <div class="d-flex justify-content-between px-3 px-md-4">
        <div class="card-header2">
            <h3 class="card-title">PreOrders</h3>
        </div>
    </div>
    <div style="width: 100%; margin: auto;">
        <canvas id="preorderChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const preorderData = <?php echo json_encode($pre_order_data); ?>;
        const preorderSortedData = preorderData.slice().sort((a, b) => new Date(a.order_date) - new Date(b.order_date));
        const preorderAllCrops = Array.from(new Set(preorderData.map(item => item.crop_name)));
        const preorderInitialCropsToShow = preorderAllCrops.slice(0, 5);

        function filterDataForCrops(crops, selectedYear) {
            return preorderSortedData.filter(item => crops.includes(item.crop_name) && new Date(item.order_date).getFullYear() === selectedYear);
        }

        const preorderCurrentDate = new Date();
        const preorderCurrentYear = preorderCurrentDate.getFullYear();
        const preorderCurrentMonth = preorderCurrentDate.getMonth() + 1;
        const preorderYears = [];
        for (let year = preorderCurrentYear; year >= 2010; year--) {
            preorderYears.push(year);
        }
        let preorderChart;
        let preorderAllMonths = [];

        // Function to initialize datasets for the chart
        function preorderInitializeDatasets(crops) {
            return crops.map(crop => {
                const counts = preorderAllMonths.map(date => {
                    const matchingItem = preorderSortedData.find(item => item.crop_name === crop && new Intl.DateTimeFormat('en', { year: 'numeric', month: 'long' }).format(new Date(item.order_date)) === date);
                    return matchingItem ? matchingItem.total_quantity : 0;
                });

                return {
                    label: crop,
                    data: counts,
                    fill: false,
                    borderColor: preorderGetRandomColor(),
                };
            });
        }

        // Function to get a random color for the chart datasets
        function preorderGetRandomColor() {
            return '#' + Math.floor(Math.random() * 16777215).toString(16);
        }

        // Function to update the chart with the selected crops and year
        function preorderUpdateChart(cropsToShow, selectedYear) {
            // Get all unique months for the selected year
            const preorderCurrentYearIndex = preorderYears.indexOf(preorderCurrentYear);
            const preorderSelectedYearIndex = preorderYears.indexOf(parseInt(selectedYear));

            preorderAllMonths.length = 0;

            for (let month = 1; month <= 12; month++) {
                if (preorderSelectedYearIndex === preorderCurrentYearIndex && month > preorderCurrentMonth) {
                    break;
                }
                const date = new Date(selectedYear, month - 1, 1);
                preorderAllMonths.push(new Intl.DateTimeFormat('en', { year: 'numeric', month: 'long' }).format(date));
            }

            const filteredData = filterDataForCrops(cropsToShow, selectedYear);
            const datasets = preorderInitializeDatasets(cropsToShow);

            if (preorderChart) {
                preorderChart.data.labels = preorderAllMonths;
                preorderChart.data.datasets = datasets;
                preorderChart.update();
            } else {
                preorderChart = new Chart('preorderChart', {
                    type: 'line',
                    data: {
                        labels: preorderAllMonths,
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
            }
        }

        preorderUpdateChart(preorderInitialCropsToShow, preorderCurrentYear);

        const preorderCropSelect = document.createElement('select');
        preorderCropSelect.classList.add('preordercrop-dropdown');
        preorderCropSelect.addEventListener('change', function () {
            const selectedCrop = preorderCropSelect.value;
            const selectedYear = preorderYearSelect.value;
            if (selectedCrop === 'all') {
                preorderUpdateChart(preorderAllCrops, selectedYear);
            } else {
                preorderUpdateChart([selectedCrop], selectedYear);
            }
        });

        const preorderYearSelect = document.createElement('select');
        preorderYearSelect.classList.add('year-dropdown');
        preorderYearSelect.addEventListener('change', function () {
            const selectedYear = preorderYearSelect.value;
            const selectedCrop = preorderCropSelect.value;
            if (selectedCrop === 'all') {
                preorderUpdateChart(preorderAllCrops, selectedYear);
            } else {
                preorderUpdateChart([selectedCrop], selectedYear);
            }
        });

        const preorderShowAllOption = document.createElement('option');
        preorderShowAllOption.value = 'all';
        preorderShowAllOption.textContent = 'Show All Crops';
        preorderCropSelect.appendChild(preorderShowAllOption);

        preorderAllCrops.forEach(cropName => {
            const cropOption = document.createElement('option');
            cropOption.value = cropName;
            cropOption.textContent = cropName;
            preorderCropSelect.appendChild(cropOption);
        });

        preorderYears.forEach(year => {
            const yearOption = document.createElement('option');
            yearOption.value = year;
            yearOption.textContent = year;
            preorderYearSelect.appendChild(yearOption);
        });

        const preorderCardHeader = document.querySelector('.card-header2');
        preorderCardHeader.appendChild(preorderCropSelect);
        preorderCardHeader.appendChild(preorderYearSelect);
    </script>
</div>
