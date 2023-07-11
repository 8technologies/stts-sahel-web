<!doctype html>
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

    <!-- ApexCharts JS -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.1"></script>

    <!-- Custom chart script -->
    <script>
        $(function() {
            var options = {
                chart: {
                    type: 'area',
                    height: 350,
                    zoom: {
                        enabled: false
                    },
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800,
                        animateGradually: {
                            enabled: true,
                            delay: 150
                        },
                        dynamicAnimation: {
                            enabled: true,
                            speed: 350
                        }
                    }
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: 'Emails Sent',
                    data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
                }],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
                },
                tooltip: {
                    theme: 'dark',
                    x: {
                        format: 'MMM'
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#area_chart"), options);
            chart.render();
        });
    </script>
</head>

<body>
    <div class="row">
        <div class="col-xl-6">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                
                    <h4 class="panel-title">Revenue</h4>
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
                                <p class="text-muted text-truncate mb-0">Marketplace</p>
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
                    <div id="area_chart" class="apex-charts" dir="ltr"></div>
                </div>
            </div><!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-muted" data-toggle="dropdown" href="#" aria-expanded="true">
                                This Years <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="#">Today</a></li>
                                <li><a href="#">Last Week</a></li>
                                <li><a href="#">Last Month</a></li>
                                <li><a href="#">This Year</a></li>
                            </ul>
                        </div>
                    </div>
                    <h4 class="panel-title">Revenue</h4>
                </div>
                <div class="panel-body">
                    <div class="text-center">
                        <div class="row">
                            <div class="col-sm-4">
                                <h5>17,493</h5>
                                <p class="text-muted">Marketplace</p>
                            </div>
                            <div class="col-sm-4">
                                <h5>$44,960</h5>
                                <p class="text-muted">Last Week</p>
                            </div>
                            <div class="col-sm-4">
                                <h5>$29,142</h5>
                                <p class="text-muted">Last Month</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end panel -->
        </div><!-- end col -->
    </div><!-- end row -->

    </div>
</body>

</html>
