<!-- Your Laravel view file -->
<div>
    <label for="timePeriod">Select Time Period:</label>
    <select id="timePeriod">
        <option value="week">This Week</option>
        <option value="month">This Month</option>
        <option value="year">This Year</option>
    </select>
</div>
<canvas id="cropQuantityChart" width="800" height="400"></canvas>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/adapters/moment.min.js"></script>

<script>
    var ctx = document.getElementById('cropQuantityChart').getContext('2d');
    var chartData = @json($datasets);
    
    // Function to filter the data based on the selected time period
    function filterDataByTimePeriod(data, timePeriod) {
        var now = new Date();
        var filteredData = data.map(function (dataset) {
            var filteredValues = dataset.data.filter(function (entry) {
                var entryDate = new Date(entry.x);
                if (timePeriod === 'week') {
                    return entryDate >= new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
                } else if (timePeriod === 'month') {
                    return entryDate >= new Date(now.getTime() - 30 * 24 * 60 * 60 * 1000);
                } else if (timePeriod === 'year') {
                    return entryDate >= new Date(now.getTime() - 365 * 24 * 60 * 60 * 1000);
                }
            });
            return { ...dataset, data: filteredValues };
        });
        return filteredData;
    }
        // Define the momentAdapter variable
        const momentAdapter = Chart._adapters._date.adapters.moment;
    
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: chartData,
        },
        options: {
            scales: {
                x: {
                    type: 'time',
                    adapters: {
                        date: momentAdapter, // Use the Moment.js adapter for time scale
                    },
                    time: {
                        unit: 'day',
                    },
                },
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
    
    // Event listener to update the chart data when the dropdown selection changes
    document.getElementById('timePeriod').addEventListener('change', function () {
        var selectedTimePeriod = this.value;
        var filteredData = filterDataByTimePeriod(chartData, selectedTimePeriod);
        chart.data.datasets = filteredData;
        chart.update();
    });
</script>
