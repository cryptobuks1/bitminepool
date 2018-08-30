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
        <link href="../vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendor/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="../vendor/iCheck/skins/flat/green.css" rel="stylesheet">

        <!-- bootstrap-progressbar -->
        <link href="../vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="../vendor/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="../vendor/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <link rel="icon" href="images/favicon.ico" type="image/ico" sizes="32x32">
        <!-- Custom Theme Style -->
        <link href="../vendor/build/css/custom.min.css" rel="stylesheet">
        <style type="text/css">
            <!--
            .style3 {color: #CC3300}
            -->
        </style>
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?php echo BASE_URL; ?>" class="site_title"> <span><img src="../images/logo.png" alt="Bitc-Mine-Pool" style="width: 95px;"></span></a>
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <a href="<?php echo BASE_URL; ?>"><img src="../images/img.jpg" alt="..." class="img-circle profile_img"></a>              </div>
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2><?php
                                    if (isset($_SESSION['Username'])) {
                                        echo ' ' . $_SESSION['Username'];
                                    } else {
                                        //header("location:login");
                                        $redirect = 'login';
                                        echo "<script>location='".BASE_URL.$redirect."'</script>";
                                    }
                                    ?></h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <?php include('includes/guestmenu.php'); ?>

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

                <?php include('includes/guestheader.php'); ?>


                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3 class="style3">Welcome to Bit Mine Pool</h3>
                            </div>


                        </div>

                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>About Bitcoin Mining</h2>

                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <p>By upgrading your account you can now be able to purchase various products that are available at Bit Mine Pool</p>
                                        <?php
                                        include('includes/dbconnect.php');
                                        $getone = "SELECT Balance FROM accountbalance WHERE Username = '" . $_SESSION['Username'] . "'";
                                        $queryone = mysqli_query($conn, $getone);
                                        $balanceone = mysqli_fetch_array($queryone);
                                        $showone = $balanceone['Balance'];
                                        ?>
                                        <!--<a href="invoicecheckbal"><button type="button" class="btn btn-primary btn-lg">Account Balance:USD <?php echo $showone; ?></button></a>
                                        <a href="invoicecheckreg"><button type="button" class="btn btn-success btn-lg">Upgrade Account Now</button></a> -->
                                        <a href="upgrade"><button type="button" class="btn btn-primary btn-lg">Account Balance:USD <?php echo $showone; ?></button></a>
                                        <a href="invoicecheckreg"><button type="button" class="btn btn-success btn-lg">Upgrade Account Now</button></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content -->

                <!-- footer content -->

                <!-- /footer content -->
            </div>
        </div>

        <!-- jQuery -->
        <script src="../vendor/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../vendor/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="../vendor/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="../vendor/nprogress/nprogress.js"></script>
        <!-- Chart.js -->
        <script src="../vendor/Chart.js/dist/Chart.min.js"></script>
        <!-- gauge.js -->
        <script src="../vendor/gauge.js/dist/gauge.min.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="../vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="../vendor/iCheck/icheck.min.js"></script>
        <!-- Skycons -->
        <script src="../vendor/skycons/skycons.js"></script>
        <!-- Flot -->
        <script src="../vendor/Flot/jquery.flot.js"></script>
        <script src="../vendor/Flot/jquery.flot.pie.js"></script>
        <script src="../vendor/Flot/jquery.flot.time.js"></script>
        <script src="../vendor/Flot/jquery.flot.stack.js"></script>
        <script src="../vendor/Flot/jquery.flot.resize.js"></script>
        <!-- Flot plugins -->
        <script src="../vendor/flot.orderbars/js/jquery.flot.orderBars.js"></script>
        <script src="../vendor/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script src="../vendor/flot.curvedlines/curvedLines.js"></script>
        <!-- DateJS -->
        <script src="../vendor/DateJS/build/date.js"></script>
        <!-- JQVMap -->
        <script src="../vendor/jqvmap/dist/jquery.vmap.js"></script>
        <script src="../vendor/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="../vendor/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="../vendor/moment/min/moment.min.js"></script>
        <script src="../vendor/bootstrap-daterangepicker/daterangepicker.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="../vendor/build/js/custom.min.js"></script>

    </body>
</html>
