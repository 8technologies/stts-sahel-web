

<div class="card">
    <div >
    <div class="d-flex justify-content-between ">
        <div class="card-header4">
            <h3 class="card-title">Orders</h3>
        </div>
    </div>
    </div>
    <div style="width: 100%; margin: auto;">
        <canvas id="orderChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


   <script>
        const data = <?php echo json_encode($order_data); ?>;

        const sortedData = data.slice().sort((a, b) => new Date(a.order_date) - new Date(b.order_date));

        const allCrops = Array.from(new Set(data.map(item => item.crop_name)));
        const initialCropsToShow = allCrops.slice(0, 5);

        function filterDataForCrops(crops, selectedYear) {
            return sortedData.filter(item => crops.includes(item.crop_name) && new Date(item.order_date).getFullYear() === selectedYear);
        }

        const currentDate = new Date();
        const currentYear = currentDate.getFullYear();
        const currentMonth = currentDate.getMonth() + 1;
        const years = [];
        for (let year = currentYear; year >= 2010; year--) {
            years.push(year);
        }

        let orderChart;
        let allMonths = [];



        function initializeDatasets(crops) {
            return crops.map(crop => {
                const counts = allMonths.map(date => {
                    const matchingItem = sortedData.find(item => item.crop_name === crop && new Intl.DateTimeFormat('en', { year: 'numeric', month: 'long' }).format(new Date(item.order_date)) === date);
                    return matchingItem ? matchingItem.total_quantity : 0;
                });

                return {
                    label: crop,
                    data: counts,
                    fill: false,
                    borderColor: getRandomColor(),
                };
            });
        }

        function getRandomColor() {
            return '#' + Math.floor(Math.random() * 16777215).toString(16);
        }
        function updateChart(cropsToShow, selectedYear) {
            // Get all unique months for the selected year
            const currentYearIndex = years.indexOf(currentYear);
            const selectedYearIndex = years.indexOf(parseInt(selectedYear));

            allMonths.length = 0;

            for (let month = 1; month <= 12; month++) {
                if (selectedYearIndex === currentYearIndex && month > currentMonth) {
                    break;
                }
                const date = new Date(selectedYear, month - 1, 1);
                allMonths.push(new Intl.DateTimeFormat('en', { year: 'numeric', month: 'long' }).format(date));
            }

            const filteredData = filterDataForCrops(cropsToShow, selectedYear);
            const datasets = initializeDatasets(cropsToShow);

            if (orderChart) {
                orderChart.data.labels = allMonths;
                orderChart.data.datasets = datasets;
                orderChart.update();
            } else {
                orderChart = new Chart('orderChart', {
                    type: 'line',
                    data: {
                        labels: allMonths,
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

        updateChart(initialCropsToShow, currentYear);

        const cropSelect = document.createElement('select');
        cropSelect.classList.add('crop-dropdown');
        cropSelect.addEventListener('change', function () {
            const selectedCrop = cropSelect.value;
            const selectedYear = yearSelect1.value;
            if (selectedCrop === 'all') {
                updateChart(allCrops, selectedYear);
            } else {
                updateChart([selectedCrop], selectedYear);
            }
        });

        const yearSelect1 = document.createElement('select');
        yearSelect1.classList.add('year-dropdown');
        yearSelect1.addEventListener('change', function () {
            const selectedYear = yearSelect1.value;
            const selectedCrop = cropSelect.value;
            if (selectedCrop === 'all') {
                updateChart(allCrops, selectedYear);
            } else {
                updateChart([selectedCrop], selectedYear);
            }
        });

        const showAllOption = document.createElement('option');
        showAllOption.value = 'all';
        showAllOption.textContent = 'Show All Crops';
        cropSelect.appendChild(showAllOption);

        allCrops.forEach(cropName => {
            const cropOption = document.createElement('option');
            cropOption.value = cropName;
            cropOption.textContent = cropName;
            cropSelect.appendChild(cropOption);
        });

        years.forEach(year => {
            const yearOption = document.createElement('option');
            yearOption.value = year;
            yearOption.textContent = year;
            yearSelect1.appendChild(yearOption);
        });

        const cardHeader = document.querySelector('.card-header4');
        cardHeader.appendChild(cropSelect);
        cardHeader.appendChild(yearSelect1);
    </script>
</div>