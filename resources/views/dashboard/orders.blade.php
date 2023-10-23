

<div class="card">
    <div >
    <div class="d-flex justify-content-between ">
        <div class="card-header4">
            <h3 class="card-title">{{__('admin.form.Orders')}}</h3>
            <p>{{__('admin.form.A Summary of Orders over the months')}}</p>
        </div>
    </div>
    </div>
    <div style="width: 100%; margin: auto;">
        <canvas id="orderChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
    // Extract order data from PHP and parse it as JSON
    const data = <?php echo json_encode($order_data); ?>;

    // Sort the order data by order date
    const sortedData = data.slice().sort((a, b) => new Date(a.order_date) - new Date(b.order_date));

    // Extract all unique crop names
    const allCrops = Array.from(new Set(data.map(item => item.crop_name)));

    // Initial set of crops to display (the first 5 unique crops)
    const initialCropsToShow = allCrops.slice(0, 5);

    // Function to filter data based on selected crops and year
    function filterDataForCrops(crops, selectedYear) {
        console.log(selectedYear);
        return sortedData.filter(item => crops.includes(item.crop_name) && new Date(item.order_date).getFullYear() === selectedYear);
    }

    // Get the current date, year, and month
    const currentDate = new Date();
    const currentYear = currentDate.getFullYear();
    const currentMonth = currentDate.getMonth() + 1;

    // Generate an array of years from the current year back to 2010
    const years = [];
    for (let year = currentYear; year >= 2020; year--) {
        years.push(year);
    }

    // Initialize variables for the chart and month labels
    let orderChart;
    let allMonths = [];

    // Function to initialize chart datasets for the selected crops
    function initializeDatasets(crops) {
        return crops.map(crop => {
            const counts = allMonths.map(date => {
                const matchingItem = sortedData.find(item => item.crop_name === crop && new Intl.DateTimeFormat(currentLocale, { year: 'numeric', month: 'long' }).format(new Date(item.order_date)) === date);
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

    // Generate a random color code
    function getRandomColor() {
        return '#' + Math.floor(Math.random() * 16777215).toString(16);
    }

    // Function to update the chart based on selected crops and year
    function updateOrderChart(cropsToShow, selectedYear)
    {
        console.log("now the year is", selectedYear);
        // Get all unique months for the selected year
        const currentYearIndex = years.indexOf(currentYear);
        const selectedYearIndex = years.indexOf(parseInt(selectedYear));

        allMonths.length = 0;

        for (let month = 1; month <= 12; month++) {
            if (selectedYearIndex === currentYearIndex && month > currentMonth) {
                break;
            }
            const date = new Date(selectedYear, month - 1, 1);
            allMonths.push(new Intl.DateTimeFormat(currentLocale, { year: 'numeric', month: 'long' }).format(date));
        }

        // Filter data and initialize datasets
        const filteredData = filterDataForCrops(cropsToShow, selectedYear);
        const datasets = initializeDatasets(cropsToShow);

        if (orderChart) {
            // Update the existing chart
            orderChart.data.labels = allMonths;
            orderChart.data.datasets = datasets;
            orderChart.update();
        } else {
            // Create a new chart if it doesn't exist
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
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: translations[currentLocale].quantity, // Label for the y-axis
                                font: {
                                    weight: 'bold', // Make the label bold
                                    size: 16,       // Set the font size
                                },
                            }
                        }
                    }
                }
            });
        }
    }

    // Initial chart rendering with default crops and current year
    updateOrderChart(initialCropsToShow, currentYear);

    // Create a dropdown select element for crops
    const cropSelect = document.createElement('select');
    cropSelect.classList.add('crop-dropdown');
    cropSelect.addEventListener('change', function () {
        const selectedCrop = cropSelect.value;
        const selectedYear = yearSelect1.value;
        if (selectedCrop === 'all') {
            updateOrderChart(allCrops, selectedYear);
        } else {
            updateOrderChart([selectedCrop], selectedYear);
        }
    });

    // Create a dropdown select element for years
    const yearSelect1 = document.createElement('select');
    yearSelect1.classList.add('year-dropdown');
    yearSelect1.addEventListener('change', function () {
        const selectedYear = yearSelect1.value;
        const selectedCrop = cropSelect.value;
        if (selectedCrop === 'all') {
            updateOrderChart(allCrops, selectedYear);
            console.log("Update Chart - selectedCrop:", selectedYear);
        } else {
            console.log("Update Chart - selectedYear:", selectedYear);
            updateOrderChart([selectedCrop], selectedYear);
        }
    });

    // Create an option for showing all crops
    const showAllOption = document.createElement('option');
    showAllOption.value = 'all';
    showAllOption.textContent = translatedText; // This text should be defined elsewhere
    cropSelect.appendChild(showAllOption);

    // Populate crop options
    allCrops.forEach(cropName => {
        const cropOption = document.createElement('option');
        cropOption.value = cropName;
        cropOption.textContent = cropName;
        cropSelect.appendChild(cropOption);
    });

    // Populate year options
    years.forEach(year => {
        const yearOption = document.createElement('option');
        yearOption.value = year;
        yearOption.textContent = year;
        yearSelect1.appendChild(yearOption);
    });

    // Add dropdowns to the page
    const cardHeader = document.querySelector('.card-header4');
    cardHeader.appendChild(cropSelect);
    cardHeader.appendChild(yearSelect1);
</script>

</div>