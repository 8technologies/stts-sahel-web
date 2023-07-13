<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>srtdash - SEO Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/dashboard/images/icon/favicon.ico')}}">
    <!-- <link rel="stylesheet" href="{{asset('assets/dashboard/css/bootstrap.min.css')}}"> -->
     <!-- Bootstrap 3.3.5 CSS -->
     <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/dashboard/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dashboard/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dashboard/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dashboard/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dashboard/css/slicknav.min.css')}}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dashboard/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dashboard/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dashboard/css/responsive.css')}}">
    <!-- modernizr css -->
    <script src="{{asset('assets/dashboard/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="container">
        
        <!-- main content area start -->
        <!-- <div class="main-content"> -->
           
      
            <!-- page title area end -->
            <div class="row">
                <!-- seo fact area start -->
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6 mt-5 mb-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="panel-title">Likes</div>
                                </div>
                                <div class="panel-body">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><i class="ti-thumb-up"></i> Likes</div>
                                        <h2>2,315</h2>
                                    </div>
                                    <canvas id="seolinechart1" height="50"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-md-5 mb-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="panel-title">Share</div>
                                </div>
                                <div class="panel-body">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><i class="ti-share"></i> Share</div>
                                        <h2>3,984</h2>
                                    </div>
                                    <canvas id="seolinechart2" height="50"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 mb-lg-0">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="panel-title">Impressions</div>
                                </div>
                                <div class="panel-body">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon">Impressions</div>
                                        <canvas id="seolinechart3" height="60"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="panel-title">New Users</div>
                                </div>
                                <div class="panel-body">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon">New Users</div>
                                        <canvas id="seolinechart4" height="60"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- seo fact area end -->
                <!-- Social Campaign area start -->
                <div class="col-lg-4 mt-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="panel-title">Social ads Campaign</div>
                        </div>
                        <div class="panel-body pb-0">
                            <div id="socialads" style="height: 245px;"></div>
                        </div>
                    </div>
                </div>
                <!-- Social Campaign area end -->
                <!-- Statistics area start -->
                <div class="col-lg-8 mt-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="panel-title">User Statistics</div>
                        </div>
                        <div class="panel-body">
                            <div id="user-statistics"></div>
                        </div>
                    </div>
                </div>
                <!-- Statistics area end -->
                <!-- Advertising area start -->
                <div class="col-lg-4 mt-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="panel-title">Advertising & Marketing</div>
                        </div>
                        <div class="panel-body">
                            <canvas id="seolinechart8" height="233"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Advertising area end -->
                <!-- sales area start -->
                <div class="col-xl-9 col-ml-8 col-lg-8 mt-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="panel-title">Sales</div>
                        </div>
                        <div class="panel-body">
                            <div id="salesanalytic"></div>
                        </div>
                    </div>
                </div>
                <!-- sales area end -->
            </div>
        </div>
        <!-- main content area end -->
       
    </div>
    <!-- page container area end -->
   
    <!-- jquery latest version -->
    <script src="{{asset('assets/dashboard/js/vendor/jquery-2.2.4.min.js')}}"></script>
    <!-- bootstrap 3.3.5 js -->
    <script src="{{asset('assets/dashboard/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/jquery.slicknav.min.js')}}"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <!-- start amcharts -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <!-- all line chart activation -->
    <script src="{{asset('assets/dashboard/js/line-chart.js')}}"></script>
    <!-- all pie chart -->
    <script src="{{asset('assets/dashboard/js/pie-chart.js')}}"></script>
    <!-- all bar chart -->
    <script src="{{asset('assets/dashboard/js/bar-chart.js')}}"></script>
    <!-- all map chart -->
    <script src="{{asset('assets/dashboard/js/maps.js')}}"></script>
    <!-- others plugins -->
    <script src="{{asset('assets/dashboard/js/plugins.js')}}"></script>
    <script src="{{asset('assets/dashboard/js/scripts.js')}}"></script>
</body>

</html>
