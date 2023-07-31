<!-- Updated CSS Styles -->
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

<!-- Updated HTML Structure -->
<div class="card">
    <div class="d-flex justify-content-between px-3 px-md-4">
        <div class="card-header">
            <h3 class="card-title">Sales</h3>
        </div>
    </div>
    <div style="width: 100%; margin: auto;">
        <canvas id="salesChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Updated PHP Data
        const salesData = <?php echo json_encode($sales); ?>;
        const otherOrdersData = <?php echo json_encode($otherOrders); ?>;

        const sortedSalesData = salesData.slice().sort((a, b) => new Date(a.date) - new Date(b.date));
        const sortedOtherOrdersData = otherOrdersData.slice().sort((a, b) => new Date(a.date) - new Date(b.date));

        function filterDataForYear(data, year) {
            return data.filter(item => new Date(item.date).getFullYear() === year);
        }

        function updateChart(selectedYear) {
            const salesByYear = filterDataForYear(sortedSalesData, selectedYear);
            const otherOrdersByYear = filterDataForYear(sortedOtherOrdersData, selectedYear);

            // Create an array with all months of the selected year and initialize it with zeros
            const allMonths = [];
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear();
            const currentMonth = currentDate.getMonth() + 1;

            for (let month = 1; month <= 12; month++) {
                if (selectedYear === currentYear && month > currentMonth) {
                    break;
                }
                const date = new Date(selectedYear, month - 1, 1);
                allMonths.push(new Intl.DateTimeFormat('en', { year: 'numeric', month: 'long' }).format(date));
            }

            // Create arrays to store the counts for each month, initialized with zeros
            const monthlySalesCounts = Array.from({ length: 12 }, () => 0);
            const monthlyOtherOrdersCounts = Array.from({ length: 12 }, () => 0);

            // Update the corresponding elements of the monthly arrays with the actual counts
            salesByYear.forEach(item => {
                const month = new Date(item.date).getMonth();
                monthlySalesCounts[month] = item.count;
            });

            otherOrdersByYear.forEach(item => {
                const month = new Date(item.date).getMonth();
                monthlyOtherOrdersCounts[month] = item.count;
            });

            // Destroy the previous chart instance if it exists
            if (window.salesChartInstance) {
                window.salesChartInstance.destroy();
            }

            // Create the new chart instance and assign it to the salesChartInstance variable
            window.salesChartInstance = new Chart('salesChart', {
                type: 'line',
                data: {
                    labels: allMonths,
                    datasets: [
                        {
                            label: 'Sales',
                            data: monthlySalesCounts,
                            fill: false,
                            borderColor: getRandomColor(),
                        },
                        {
                            label: 'Orders',
                            data: monthlyOtherOrdersCounts,
                            fill: false,
                            borderColor: getRandomColor(),
                        },
                    ],
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        }

        const yearSelect = document.createElement('select');
        yearSelect.classList.add('year-dropdown');
        yearSelect.addEventListener('change', function () {
            const selectedYear = parseInt(yearSelect.value);
            updateChart(selectedYear);
        });

        // Populate the year options
        const allYears = Array.from(new Set(salesData.concat(otherOrdersData).map(item => new Date(item.date).getFullYear())));
        allYears.forEach(year => {
            const yearOption = document.createElement('option');
            yearOption.value = year;
            yearOption.textContent = year;
            yearSelect.appendChild(yearOption);
        });

        const cardHeader = document.querySelector('.card-header');
        cardHeader.appendChild(yearSelect);

        // Get the current date and year
        const currentDate = new Date();
        const currentYear = currentDate.getFullYear();
        const currentMonth = currentDate.getMonth() + 1;

        // Call updateChart function with currentYear
        updateChart(currentYear);

        function getRandomColor() {
            return '#' + Math.floor(Math.random() * 16777215).toString(16);
        }
    </script>
</div>
