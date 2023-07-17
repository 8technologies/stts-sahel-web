<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Upcube - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap 3.3.5 CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- App CSS -->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Bootstrap 3.3.5 JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- Custom chart script -->
    <script>
        $(function() {
            var ctx = document.getElementById("coin_sales4").getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'bar',
                // The data for our dataset
                data: {
                    labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10"],
                    datasets: [{
                        label: "Sales",
                        data: [250, 320, 380, 330, 420, 250, 180, 250, 100, 300],
                        backgroundColor: [
                            '#8416fe',
                            '#3a3afb',
                            '#8416fe',
                            '#3a3afb',
                            '#8416fe',
                            '#3a3afb',
                            '#8416fe',
                            '#3a3afb',
                            '#3a3afb',
                            '#8416fe'
                        ]
                    }]
                },
                // Configuration options go here
                options: {
                    legend: {
                        display: false
                    },
                    animation: {
                        easing: "easeInOutBack"
                    },
                    scales: {
                        yAxes: [{
                            display: false,
                            ticks: {
                                fontColor: "#cccccc",
                                beginAtZero: true,
                                padding: 0
                            },
                            gridLines: {
                                zeroLineColor: "transparent"
                            }
                        }],
                        xAxes: [{
                            display: false,
                            gridLines: {
                                zeroLineColor: "transparent",
                                display: false
                            },
                            ticks: {
                                beginAtZero: true,
                                padding: 0,
                                fontColor: "#cccccc"
                            }
                        }]
                    }
                }
            });
        });
    </script>
</head>

<body>
    <div class="row">
        <div class="col-xl-6">
            <div class="col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4 class="panel-title">Users</h4>
                    </div>
                    <div class="panel-body">
                        <div class="text-center pt-3">
                            <div class="row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div class="d-inline-flex">
                                        <h5 class="me-2">25,117</h5>
                                        <div class="text-success font-size-12">
                                            <i class="mdi mdi-menu-up font-size-14"> </i>2.2%
                                        </div>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Agro Dealers</p>
                                </div><!-- end col -->
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div class="d-inline-flex">
                                        <h5 class="me-2">$34,856</h5>
                                        <div class="text-success font-size-12">
                                            <i class="mdi mdi-menu-up font-size-14"> </i>1.2%
                                        </div>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Last Week</p>
                                </div><!-- end col -->
                                <div class="col-sm-4">
                                    <div class="d-inline-flex">
                                        <h5 class="me-2">$18,225</h5>
                                        <div class="text-success font-size-12">
                                            <i class="mdi mdi-menu-up font-size-14"> </i>1.7%
                                        </div>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Last Month</p>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div>
                    </div>
                    <div class="card-body py-0 px-2">
                        <canvas id="coin_sales4" class="apex-charts" dir="ltr"></canvas>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div><!-- end row -->
    </div>
</body>

</html>
