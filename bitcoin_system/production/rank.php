<?php session_start(); ?>
<?php
include('includes/constant.php');
$register = 'register';
session_start();
$_SESSION['register'] = $register;
?>
<?php
///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
include('includes/dbconnect.php');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////Get the Bitcoin Wallet balance///////////////////////////////////////////////////////		
$getone = "SELECT Balance FROM accountbalance WHERE Username = '" . $_SESSION['Username'] . "'";
$queryone = mysqli_query($conn, $getone);
$balanceone = mysqli_fetch_array($queryone);
$showone = $balanceone['Balance'];
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////Get the Mining balance///////////////////////////////////////////////////////		
$gettwo = "SELECT Balance FROM mining WHERE Username = '" . $_SESSION['Username'] . "'";
$querytwo = mysqli_query($conn, $gettwo);
$balancetwo = mysqli_fetch_array($querytwo);
$showtwo = $balancetwo['Balance'];
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////Get the Team balance///////////////////////////////////////////////////////		
$getthree = "SELECT Balance FROM team WHERE Username = '" . $_SESSION['Username'] . "'";
$querythree = mysqli_query($conn, $getthree);
$balancethree = mysqli_fetch_array($querythree);
$showthree = $balancethree['Balance'];
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////Get the Commission balance///////////////////////////////////////////////////////		
$getfour = "SELECT Balance FROM commission WHERE Username = '" . $_SESSION['Username'] . "'";
$queryfour = mysqli_query($conn, $getfour);
$balancefour = mysqli_fetch_array($queryfour);
$showfour = $balancefour['Balance'];
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////Get the Team Volume balance///////////////////////////////////////////////////////		
$getfive = "SELECT Balance FROM teamvolume WHERE Username = '" . $_SESSION['Username'] . "'";
$queryfive = mysqli_query($conn, $getfive);
$balancefive = mysqli_fetch_array($queryfive);
$showfive = $balancefive['Balance'];
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////Get the Account Rank///////////////////////////////////////////////////////////////		
$getrank = "SELECT Rank FROM rank WHERE Username = '" . $_SESSION['Username'] . "'";
$queryrank = mysqli_query($conn, $getrank);
$sharerank = mysqli_fetch_array($queryrank);
$showrank = $sharerank['Rank'];
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
mysqli_close($conn);
?>
<?php
$url = "https://blockchain.info/stats?format=json";
$stats = json_decode(file_get_contents($url), true);
$btcValue = $stats['market_price_usd'];
$usdCost = $showone;
$usdCosttwo = $showtwo / $btcValue;
$usdCostthree = $showfour / $btcValue;
$usdCostfour = $showfive / $btcValue;
$convertedCost = $usdCost / $btcValue;
$totalone = round($convertedCost, 6);
$totaltwo = round($usdCosttwo, 6);
$totalthree = round($usdCostthree, 6);
$totalfour = round($usdCostfour, 6);
$priceone = 1.5 / $btcValue;
$pricetwo = 3 / $btcValue;
$pricethree = 6 / $btcValue;
$pricefour = 12 / $btcValue;
$pricefive = 24 / $btcValue;
$packone = round($priceone, 6);
$packtwo = round($pricetwo, 6);
$packthree = round($pricethree, 6);
$packfour = round($pricefour, 6);
$packfive = round($pricefive, 6);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bit Mine Pool </title>

        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

        <!-- bootstrap-progressbar -->
        <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <link rel="icon" href="images/favicon.ico" type="image/ico" sizes="32x32">
        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
        <style type="text/css">
            <!--
            .style1 {color: #FFFFFF}
            .style2 {color: #FF0000}
            -->
        </style>
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?php echo BASE_URL; ?>" class="site_title"> <span><img src="images/logo.png" alt="Bitc-Mine-Pool" style="width: 95px;"></span></a>
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <a href="<?php echo BASE_URL; ?>"><img src="images/img.jpg" alt="..." class="img-circle profile_img"></a>              </div>
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2><?php
                                    if (isset($_SESSION['Username'])) {
                                        echo ' ' . $_SESSION['Username'];
                                    } else {
                                        header("location:login");
                                    }
                                    ?></h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <?php include('includes/menu.php'); ?>

                        <!-- /menu footer buttons -->
                        <div class="sidebar-footer hidden-small">
                            <a data-toggle="tooltip" data-placement="top" title="Settings">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Lock">
                                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.php">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>
                        </div>
                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <?php include('includes/header.php'); ?>

                <!-- page content -->
                <div class="right_col" role="main">
                    <!-- top tiles -->
                    <div class="row tile_count">
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Account Rank</span>
                            <div class="count">Miner</a></div>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>Currently </i>Account Rank</span>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Account Rank</span>
                            <div class="count">Dealer</a></div>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>Currently </i>Account Rank</span>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Account Rank</span>
                            <div class="count">Super Dealer</a></div>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>Currently </i>Account Rank</span>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Account Rank</span>
                            <div class="count">Master Dealer</a></div>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>Currently </i>Account Rank</span>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Account Rank</span>
                            <div class="count">Crown Dealer</a></div>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>Currently </i>Account Rank</span>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Account Rank</span>
                            <div class="count">Global Dealer</a></div>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>Currently </i>Account Rank</span>
                        </div>


                    </div>
                    <!-- /top tiles -->

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_content">

                                <div class="row x_title">

                                    <div class="col-md-6">

                                    </div>
                                </div>

                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="pricing ui-ribbon-container">
                                            <div class="ui-ribbon-wrapper">

                                            </div>
                                            <div class="title">
                                                <h2>Miner</h2>
                                                <h2>Volume: 300</h2>
                                                <h2>300/300</h2>
                                                <h2>Miners 0/1</h2>
                                            </div>
                                            <div class="x_content">
                                                <div class="">
                                                    <div class="pricing_features">
                                                        <ul class="list-unstyled text-left">

                                                            <h2>Number of Miners</h2>
                                                            <h1><b><i class="fa fa-user"></i> Mnrs: 1</h1></b>
                                                            <h2><b><i class="green">300 Volumes</i></h2></b>
                                                            <h2><b>4 Cycles Per Day</h2></b>
                                                            <h2 class="blue">Mining Team Bonus</h2>

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="pricing_footer">
                                                    <a href="table" class="btn btn-success btn-block" role="button">Rank<span> Attained</span></a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="pricing ui-ribbon-container">
                                            <div class="ui-ribbon-wrapper">

                                            </div>
                                            <div class="title">
                                                <h2>Dealer</h2>
                                                <h2>Volume: 300</h2>
                                                <h2>300/300</h2>
                                                <h2>Miners 0/1</h2>
                                            </div>
                                            <div class="x_content">
                                                <div class="">
                                                    <div class="pricing_features">
                                                        <ul class="list-unstyled text-left">

                                                            <h2>Number of Miners</h2>
                                                            <h1><b><i class="fa fa-user"></i> Mnrs: 1</h1></b>
                                                            <h2><b><i class="green">300 Volumes</i></h2></b>
                                                            <h2><b>4 Cycles Per Day</h2></b>
                                                            <h2 class="blue">Mining Team Bonus</h2>

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="pricing_footer">
                                                    <a href="table" class="btn btn-success btn-block" role="button">Rank<span> Attained</span></a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="pricing ui-ribbon-container">
                                            <div class="ui-ribbon-wrapper">

                                            </div>
                                            <div class="title">
                                                <h2>Super Dealer</h2>
                                                <h2>Volume: 300</h2>
                                                <h2>300/300</h2>
                                                <h2>Miners 0/1</h2>
                                            </div>
                                            <div class="x_content">
                                                <div class="">
                                                    <div class="pricing_features">
                                                        <ul class="list-unstyled text-left">

                                                            <h2>Number of Miners</h2>
                                                            <h1><b><i class="fa fa-user"></i> Mnrs: 1</h1></b>
                                                            <h2><b><i class="green">300 Volumes</i></h2></b>
                                                            <h2><b>4 Cycles Per Day</h2></b>
                                                            <h2 class="blue">Mining Team Bonus</h2>

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="pricing_footer">
                                                    <a href="table" class="btn btn-success btn-block" role="button">Rank<span> Attained</span></a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="pricing">
                                            <div class="title">
                                                <h2>Master Dealer</h2>
                                                <h2>Volumes: 10,000</h2>
                                                <h2>0/10,000</h2>
                                                <h2>Miners 0/6</h2>
                                            </div>
                                            <div class="x_content">
                                                <div class="">
                                                    <div class="pricing_features">
                                                        <ul class="list-unstyled text-left">
                                                            <h2>Number of Miners</h2>
                                                            <h1><b><i class="fa fa-users"></i> Drts. 6</h1></b>
                                                            <h2><b><i class="green">10,000 Volumes</i></h2></b>
                                                            <h2><b>5 Cycles Per Day</h2></b>
                                                            <h2 class="blue">Mining Team Bonus</h2>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="pricing_footer">
                                                    <a href="tabletwo" class="btn btn-danger btn-block" role="button">Rank <span> Not Attained</span></a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- price element -->
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="pricing ui-ribbon-container">
                                            <div class="title">
                                                <h2>Crown Dealer</h2>
                                                <h2>Volumes: 40,000</h2>
                                                <h2>0/40,000</h2>
                                                <h2>Dealers 0/3</h2>
                                            </div>
                                            <div class="x_content">
                                                <div class="">
                                                    <div class="pricing_features">
                                                        <ul class="list-unstyled text-left">
                                                            <h2>Number of Dealers</h2>
                                                            <h1><b><i class="fa fa-users"></i> Dlrs. 3</h1></b>
                                                            <h2><b><i class="green">40,000 Volumes</i></h2></b>
                                                            <h2><b>7 Cycles Per Day</h2></b>
                                                            <h2 class="blue">Mining Team Bonus</h2>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="pricing_footer">
                                                    <a href="tablethree" class="btn btn-danger btn-block" role="button">Rank<span> Not Attained</span></a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- price element -->
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="pricing">
                                            <div class="title">
                                                <h2>Global Dealer</h2>
                                                <h2>Volume: 120,000</h2>
                                                <h2>0/120,000</h2>
                                                <h2>Franchise 0/2</h2>
                                            </div>
                                            <div class="x_content">
                                                <div class="">
                                                    <div class="pricing_features">
                                                        <ul class="list-unstyled text-left">
                                                            <h2>Number of Franchise</h2>
                                                            <h1><b><i class="fa fa-users"></i> Frnc. 2</h1></b>
                                                            <h2><b><i class="green">120,000 Volumes</i></h2></b>
                                                            <h2><b>8 Cycles Per Day</h2></b>
                                                            <h2 class="blue">Mining Team Bonus</h2>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="pricing_footer">
                                                    <a href="tablefour" class="btn btn-danger btn-block" role="button">Rank <span>Not Attained</span></a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- price element -->

                                </div>

                                <!-- price element -->


                                <div class="clearfix"></div>
                            </div>
                        </div>

                    </div>
                    <br />

                    <div class="row">

                        <!-- /page content -->

                        <!-- footer content -->

                        <!-- /footer content -->
                    </div>
                </div>

                <!-- jQuery -->
                <script src="../vendors/jquery/dist/jquery.min.js"></script>
                <!-- Bootstrap -->
                <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
                <!-- FastClick -->
                <script src="../vendors/fastclick/lib/fastclick.js"></script>
                <!-- NProgress -->
                <script src="../vendors/nprogress/nprogress.js"></script>
                <!-- Chart.js -->
                <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
                <!-- gauge.js -->
                <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
                <!-- bootstrap-progressbar -->
                <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
                <!-- iCheck -->
                <script src="../vendors/iCheck/icheck.min.js"></script>
                <!-- Skycons -->
                <script src="../vendors/skycons/skycons.js"></script>
                <!-- Flot -->
                <script src="../vendors/Flot/jquery.flot.js"></script>
                <script src="../vendors/Flot/jquery.flot.pie.js"></script>
                <script src="../vendors/Flot/jquery.flot.time.js"></script>
                <script src="../vendors/Flot/jquery.flot.stack.js"></script>
                <script src="../vendors/Flot/jquery.flot.resize.js"></script>
                <!-- Flot plugins -->
                <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
                <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
                <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
                <!-- DateJS -->
                <script src="../vendors/DateJS/build/date.js"></script>
                <!-- JQVMap -->
                <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
                <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
                <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
                <!-- bootstrap-daterangepicker -->
                <script src="../vendors/moment/min/moment.min.js"></script>
                <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

                <!-- Custom Theme Scripts -->
                <script src="../build/js/custom.min.js"></script>

                </body>
                </html>
