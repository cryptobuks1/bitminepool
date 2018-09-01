<?php
include('includes/constant.php');

///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
include('includes/dbconnect.php');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$url = "https://blockchain.info/stats?format=json";
$stats = json_decode(file_get_contents($url), true);
$btcValue = $stats['market_price_usd'];

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
$getfive = "SELECT total_bal FROM binaryincome WHERE userid = '" . $_SESSION['Username'] . "'";
$queryfive = mysqli_query($conn, $getfive);
$balancefive = mysqli_fetch_array($queryfive);
$showfive = $balancefive['total_bal'];
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////Get the Account Rank///////////////////////////////////////////////////////////////		
$getrank = "SELECT Rank FROM rank WHERE Username = '" . $_SESSION['Username'] . "'";
$queryrank = mysqli_query($conn, $getrank);
$sharerank = mysqli_fetch_array($queryrank);
$showrank = $sharerank['Rank'];
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////Get Withdrawal Balance for Pool 1/////////////////////////////////////////////////////////////
$getwstarter = "SELECT Withdrawal FROM starterpack WHERE Username = '" . $_SESSION['Username'] . "'";
$querywstarter = mysqli_query($conn, $getwstarter);
$balancewstarter = mysqli_fetch_array($querywstarter);
$wstarter = $balancewstarter['Withdrawal'];
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////Get Withdrawal Balance for Minipack//////////////////////////////////////////////////////////////////
$getwmini = "SELECT Withdrawal FROM minipack WHERE Username = '" . $_SESSION['Username'] . "'";
$querywmini = mysqli_query($conn, $getwmini);
$balancewmini = mysqli_fetch_array($querywmini);
$wmini = $balancewmini['Withdrawal'];
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////Get Withdrawal Balance for Mediumpack//////////////////////////////////////////////////////////////////
$getwmedium = "SELECT Withdrawal FROM mediumpack WHERE Username = '" . $_SESSION['Username'] . "'";
$querywmedium = mysqli_query($conn, $getwmedium);
$balancewmedium = mysqli_fetch_array($querywmedium);
$wmedium = $balancewmedium['Withdrawal'];
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////Get Withdrawal Balance for Grandpack//////////////////////////////////////////////////////////////////
$getwgrand = "SELECT Withdrawal FROM grandpack WHERE Username = '" . $_SESSION['Username'] . "'";
$querywgrand = mysqli_query($conn, $getwgrand);
$balancewgrand = mysqli_fetch_array($querywgrand);
$wgrand = $balancewgrand['Withdrawal'];
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////Get Withdrawal Balance for ultimatepack//////////////////////////////////////////////////////////////////
$getwultimate = "SELECT Withdrawal FROM ultimatepack WHERE Username = '" . $_SESSION['Username'] . "'";
$querywultimate = mysqli_query($conn, $getwultimate);
$balancewultimate = mysqli_fetch_array($querywultimate);
$wultimate = $balancewultimate['Withdrawal'];
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////Pool 1 Mining/////////////////////////////////////////////////////////////////////
$Starterdate1 = "SELECT MiningDate FROM starterpack WHERE Username='" . $_SESSION['Username'] . "'";
$querystarter1 = mysqli_query($conn, $Starterdate1);
$viewstarter1 = mysqli_fetch_array($querystarter1);
$showstarterdate1 = $viewstarter1['MiningDate'];
$Currentmining1 = date('Y-m-d', strtotime('-1 days'));
if ($showstarterdate1 == "0") {
    $priceone = $showstarterdate1 / $btcValue;
} else {
    $querysum = "select sum(Usd)as total from dailymine where Pack='Starter' and Date Between '$showstarterdate1' AND '$Currentmining1'";
    $querytotal = mysqli_query($conn, $querysum);
    $viewtotal = mysqli_fetch_array($querytotal);
    $totalmine = $viewtotal['total'];
    $newone = ($totalmine - $wstarter);
    $priceone = $newone / $btcValue;
}
///////////////////////////////////////////////Pool 2 Mining///////////////////////////////////////////////////////////////
$minidate1 = "SELECT MiningDate FROM minipack WHERE Username='" . $_SESSION['Username'] . "'";
$querymini1 = mysqli_query($conn, $minidate1);
$viewmini1 = mysqli_fetch_array($querymini1);
$showminidate1 = $viewmini1['MiningDate'];
if ($showminidate1 == "0") {
    $pricetwo = $showminidate1 / $btcValue;
} else {
    $querysum2 = "select sum(Usd)as total from dailymine where Pack='Mini' and Date Between '$showminidate1' AND '$Currentmining1'";
    $querytotal2 = mysqli_query($conn, $querysum2);
    $viewtotal2 = mysqli_fetch_array($querytotal2);
    $totalMini = $viewtotal2['total'];
    $newtwo = ($totalMini - $wmini);
    $pricetwo = $newtwo / $btcValue;
}
////////////////////////////////////////////////Pool 3 Mining///////////////////////////////////////////////////////////////
$mediumdate1 = "SELECT MiningDate FROM mediumpack WHERE Username='" . $_SESSION['Username'] . "'";
$querymedium1 = mysqli_query($conn, $mediumdate1);
$viewmedium1 = mysqli_fetch_array($querymedium1);
$showmediumdate1 = $viewmedium1['MiningDate'];
if ($showmediumdate1 == "0") {
    $pricethree = $showmediumdate1 / $btcValue;
} else {
    $querysum3 = "select sum(Usd)as total from dailymine where Pack='Medium' and Date Between '$showmediumdate1' AND '$Currentmining1'";
    $querytotal3 = mysqli_query($conn, $querysum3);
    $viewtotal3 = mysqli_fetch_array($querytotal3);
    $totalmedium = $viewtotal3['total'];
    $newthree = ($totalmedium - $wmedium);
    $pricethree = $newthree / $btcValue;
}
////////////////////////////////////////////////Pool 4 Mining///////////////////////////////////////////////////////////////
$granddate1 = "SELECT MiningDate FROM grandpack WHERE Username='" . $_SESSION['Username'] . "'";
$querygrand1 = mysqli_query($conn, $granddate1);
$viewgrand1 = mysqli_fetch_array($querygrand1);
$showgranddate1 = $viewgrand1['MiningDate'];
if ($showgranddate1 == "0") {
    $pricefour = $showgranddate1 / $btcValue;
} else {
    $querysum4 = "select sum(Usd)as total from dailymine where Pack='Grand' and Date Between '$showgranddate1' AND '$Currentmining1'";
    $querytotal4 = mysqli_query($conn, $querysum4);
    $viewtotal4 = mysqli_fetch_array($querytotal4);
    $totalgrand = $viewtotal4['total'];
    $newfour = ($totalgrand - $wgrand);
    $pricefour = $newfour / $btcValue;
}
////////////////////////////////////////////////Pool 5/////////////////////////////////////////////////////////////
$ultimatedate1 = "SELECT MiningDate FROM ultimatepack WHERE Username='" . $_SESSION['Username'] . "'";
$queryultimate1 = mysqli_query($conn, $ultimatedate1);
$viewultimate1 = mysqli_fetch_array($queryultimate1);
$showultimatedate1 = $viewultimate1['MiningDate'];
if ($showultimatedate1 == "0") {
    $pricefive = $showultimatedate1 / $btcValue;
} else {
    $querysum5 = "select sum(Usd)as total from dailymine where Pack='Ultimate' and Date Between '$showultimatedate1' AND '$Currentmining1'";
    $querytotal5 = mysqli_query($conn, $querysum5);
    $viewtotal5 = mysqli_fetch_array($querytotal5);
    $totalultimate = $viewtotal5['total'];
    $newfive = ($totalultimate - $wultimate);
    $pricefive = $newfive / $btcValue;
}

$usdCost = $showone;
$usdCosttwo = $showtwo / $btcValue;
$usdCostthree = $showfour / $btcValue;
$usdCostfour = $showfive / $btcValue;
$convertedCost = $usdCost / $btcValue;
$totalone = round($convertedCost, 6);
$totaltwo = round($usdCosttwo, 6);
$totalthree = round($usdCostthree, 6);
$totalfour = round($usdCostfour, 6);
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
        <link rel="icon" href="../images/favicon.ico" type="image/ico" sizes="32x32">
        <!-- Custom Theme Style -->
        <link href="../vendor/build/css/custom.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../vendor/build/css/style.css">
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
                                        echo ' ' . strlen($_SESSION['Username']) > 15 ? substr($_SESSION['Username'],0,15)."..." : $_SESSION['Username'];
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
                            <span class="count_top"><i class="fa fa-bitcoin"></i> Account Balance (BTC)</span>
                            <div class="count"><a href="#"><?php echo $totalone; ?></a></div>
                            <span class="count_bottom"><i class="green">($<?php echo $showone; ?>) </i> Total Balance</span>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-clock-o"></i> Residual Income (BTC)</span>
                            <div class="count"><a href="#"><?php echo $totaltwo; ?></a></div>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>($<?php echo $showtwo; ?>) </i>Total Earnings</span>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-sitemap"></i> Total Mining Earnings (BTC)</span>
                            <div class="count"><a href="#"><?php echo $totaltwo; ?></a></div>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>($<?php echo $showtwo; ?>)</i> Mining Earnings</span>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-th"></i> Direct Commissions (BTC)</span>
                            <div class="count"><a href="#"><?php echo $totalthree; ?></a></div>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>($<?php echo $showfour; ?>) </i> Total Commission</span>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-users"></i> Binary Earnings (BTC)</span>
                            <div class="count"><a href=""><?php echo $totalfour; ?></a></div>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>($<?php echo $showfive; ?>)</i> Total team Volume</span>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Account Rank</span>
                            <div class="count"><a href="#"><?php echo $showrank; ?></a></div>
                            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>Currently </i>Account Rank</span>
                        </div>
                    </div>
                    <!-- /top tiles -->

                    <!-- mycode -->

                    <div class="row x_title" style="padding-top:20px;">

                        <div class="col-md-12">

                        </div>
                    </div>

                    <div id="generic_price_table" style="background:none;position:relative;"> 
           <!--<section>-->
                        <!--<div class="container">
                            <div class="row">
                                <div class="col-md-12">
                        <!--PRICE HEADING START-->
                        <!--<div class="price-heading clearfix">
                            <h1>Bootstrap Pricing Table</h1>
                        </div>
                        <!--//PRICE HEADING END-->
                        <!-- </div>
                     </div>
                 </div>-->
                        <!--<div class="container" style="background-color:white;">-->

                        <!--BLOCK ROW START-->
                        <br>
                        <div class="row" style="padding-bottom:30px;margin-top:-30px;">
                            <div class="col-md-2">

                                <!--PRICE CONTENT START-->
                                <div style="width:105%;height:100%;" class="generic_content clearfix">

                                    <!--HEAD PRICE DETAIL START-->
                                    <div class="generic_head_price clearfix">

                                        <!--HEAD CONTENT START-->
                                        <div class="generic_head_content clearfix">

                                            <!--HEAD START-->
                                            <div class="head_bg"></div>
                                            <div class="head">
                                                <span>POOL 1</span>
                                            </div>
                                            <!--//HEAD END-->

                                        </div>
                                        <!--//HEAD CONTENT END-->

                                        <!--PRICE START-->
                                        <div class="generic_price_tag clearfix">	
                                            <span class="price">
                                                <span class="sign" style="font-size:30px;color:#1abb9c;">$</span>
                                                <span class="currency" style="font-size:35px;font-weight:bold;color:#1abb9c;">300</span>
                                                <!--<span class="cent">.00</span>
                                                <span class="month">/YR</span>--> 
                                            </span>
                                        </div>
                                        <!--//PRICE END-->

                                    </div>                            
                                    <!--//HEAD PRICE DETAIL END-->

                                    <!--FEATURE LIST START-->
                                    <div class="generic_feature_list">
                                        <ul>
                                            <li><span>Current Investment Return(BTC):</span> <?php echo $packone; ?></li>
                                            <li><span>Approx.</span> $1.5/day</li>
                                            <li><span>365</span> Mining days</li>

                                            <?php
                                            $Starterdate = "SELECT * FROM starterpack WHERE Username='" . $_SESSION['Username'] . "'";
                                            $querystarter = mysqli_query($conn, $Starterdate);
                                            $viewstarter = mysqli_fetch_array($querystarter);
                                            $showstarterdate = $viewstarter['MiningDate'];
                                            $starterstatus = $viewstarter['Status'];
                                            if ($showstarterdate == "0") {
                                                $gapone = "0";
                                                ?>
                                                <li><span><?php echo $gapone; ?>/365</span>  Days Mined</li>
                                                <!--<h2 class="red"><?php echo $gapone; ?>/365 Days Mined</h2>-->
                                                <?php
                                            } else {
                                                $datetime1 = new DateTime();
                                                $datetime2 = new DateTime($showstarterdate);
                                                $interval = $datetime2->diff($datetime1);
                                                $gap = $interval->format('%R%a');
                                                ?>
                                                <li><span><?php echo $gap; ?>/365</span>  Days Mined</li>
                                                <!--<h2 class="blue"><?php echo $gap; ?>/365 Days Mined</h2> -->
                                                <?php
                                            }
                                            ?>


                                            <?php
                                            $sqll = "SELECT * FROM starterpack WHERE Username='" . $_SESSION['Username'] . "' AND Comment='Purchased'";
                                            $resultl = mysqli_query($conn, $sqll);
                                            if (mysqli_num_rows($resultl) == 1) {
                                                ?>
                                                <li><i class="fa fa-check text-success" class="green">Purchased</li></i>
                                                <?php
                                            } else {
                                                ?>

                                                <li><i class="fa fa-times text-danger" class="red">Not-Purchased</li></i>
                                                <?php
                                            }
                                            ?>

<!--     <li><span>24/7</span> Support</li>-->
                                        </ul>
                                    </div>
                                    <!--//FEATURE LIST END-->

                                    <!--BUTTON START-->
                                    <div class="generic_price_btn clearfix">
                                        <a class="" href="">Buy Pack</a>
                                    </div>
                                    <!--//BUTTON END-->

                                </div>
                                <!--//PRICE CONTENT END-->

                            </div>

                            <div class="col-md-2 col-half-offset">

                                <!--PRICE CONTENT START-->
                                <div style="width:105%;height:100%;" class="generic_content clearfix">

                                    <!--HEAD PRICE DETAIL START-->
                                    <div class="generic_head_price clearfix">

                                        <!--HEAD CONTENT START-->
                                        <div class="generic_head_content clearfix">

                                            <!--HEAD START-->
                                            <div class="head_bg"></div>
                                            <div class="head">
                                                <span>POOL 2</span>
                                            </div>
                                            <!--//HEAD END-->

                                        </div>
                                        <!--//HEAD CONTENT END-->

                                        <!--PRICE START-->
                                        <div class="generic_price_tag clearfix">	
                                            <span class="price">
                                                <span class="sign" style="font-size:30px;color:#1abb9c;">$</span>
                                                <span class="currency" style="font-size:35px;font-weight:bold;color:#1abb9c;">600</span>
                                                <!--<span class="cent">.00</span>
                                                <span class="month">/YR</span>--> 
                                            </span>
                                        </div>
                                        <!--//PRICE END-->

                                    </div>                            
                                    <!--//HEAD PRICE DETAIL END-->

                                    <!--FEATURE LIST START-->
                                    <div class="generic_feature_list">
                                        <ul>
                                            <li><span>Current Investment Return(BTC):</span> <?php echo $packtwo; ?></li>
                                            <li><span>Approx.</span> $3/day</li>
                                            <li><span>365</span> Mining days</li>

                                            <?php
                                            $minidate = "SELECT * FROM minipack WHERE Username='" . $_SESSION['Username'] . "'";
                                            $querymini = mysqli_query($conn, $minidate);
                                            $viewmini = mysqli_fetch_array($querymini);
                                            $showminidate = $viewmini['MiningDate'];
                                            $ministatus = $viewmini['Status'];
                                            if ($showminidate == "0") {
                                                $gap1 = "0";
                                                ?>

                                                <li><span><?php echo $gap1; ?>/365</span>  Days Mined</li>
                                                <!--<h2 class="red"><?php echo $gap1; ?>/365 Days Mined</h2>-->
                                                <?php
                                            } else {
                                                $datetime3 = new DateTime();
                                                $datetime4 = new DateTime($showminidate);
                                                $interval1 = $datetime4->diff($datetime3);
                                                $gap2 = $interval1->format('%R%a');
                                                ?>

                                                <li><span><?php echo $gap2; ?>/365</span>  Days Mined</li>
                                                <!--<h2 class="blue"><?php echo $gap2; ?>/365 Days Mined</h2> -->
                                                <?php
                                            }
                                            ?>


                                            <?php
                                            $sqlm = "SELECT * FROM minipack WHERE Username='" . $_SESSION['Username'] . "' AND Comment='Purchased'";
                                            $resultm = mysqli_query($conn, $sqlm);
                                            if (mysqli_num_rows($resultm) == 1) {
                                                ?>
                                                <li><i class="fa fa-check text-success" class="green">Purchased</li></i>
                                                <?php
                                            } else {
                                                ?>

                                                <li><i class="fa fa-times text-danger" class="red">Not-Purchased</li></i>
                                                <?php
                                            }
                                            ?>

<!--     <li><span>24/7</span> Support</li>-->
                                        </ul>
                                    </div>
                                    <!--//FEATURE LIST END-->

                                    <!--BUTTON START-->
                                    <div class="generic_price_btn clearfix">
                                        <a class="" href="">Buy Pack</a>
                                    </div>
                                    <!--//BUTTON END-->

                                </div>
                                <!--//PRICE CONTENT END-->

                            </div>

                            <div class="col-md-2 col-half-offset">

                                <!--PRICE CONTENT START-->
                                <div style="width:105%;height:100%;" class="generic_content clearfix">

                                    <!--HEAD PRICE DETAIL START-->
                                    <div class="generic_head_price clearfix">

                                        <!--HEAD CONTENT START-->
                                        <div class="generic_head_content clearfix">

                                            <!--HEAD START-->
                                            <div class="head_bg"></div>
                                            <div class="head">
                                                <span>POOL 3</span>
                                            </div>
                                            <!--//HEAD END-->

                                        </div>
                                        <!--//HEAD CONTENT END-->

                                        <!--PRICE START-->
                                        <div class="generic_price_tag clearfix">	
                                            <span class="price">
                                                <span class="sign" style="font-size:30px;color:#1abb9c;">$</span>
                                                <span class="currency" style="font-size:35px;font-weight:bold;color:#1abb9c;">1,200</span>
                                                <!--<span class="cent">.00</span>
                                                <span class="month">/YR</span>--> 
                                            </span>
                                        </div>
                                        <!--//PRICE END-->

                                    </div>                            
                                    <!--//HEAD PRICE DETAIL END-->

                                    <!--FEATURE LIST START-->
                                    <div class="generic_feature_list">
                                        <ul>
                                            <li><span>Current Investment Return(BTC):</span> <?php echo $packthree; ?></li>
                                            <li><span>Approx.</span> $6/day</li>
                                            <li><span>365</span> Mining days</li>

                                            <?php
                                            $mediumdate = "SELECT * FROM mediumpack WHERE Username='" . $_SESSION['Username'] . "'";
                                            $querymedium = mysqli_query($conn, $mediumdate);
                                            $viewmedium = mysqli_fetch_array($querymedium);
                                            $showmediumdate = $viewmedium['MiningDate'];
                                            $mediumstatus = $viewmedium['Status'];
                                            if ($showmediumdate == "0") {
                                                $mediumgap = "0";
                                                ?>

                                                <li><span><?php echo $mediumgap; ?>/365</span>  Days Mined</li>
                                                <!--<h2 class="red"><?php echo $mediumgap; ?>/365 Days Mined</h2>-->
                                                <?php
                                            } else {
                                                $datetime5 = new DateTime();
                                                $datetime6 = new DateTime($showmediumdate);
                                                $interval2 = $datetime6->diff($datetime5);
                                                $gap3 = $interval2->format('%R%a');
                                                ?>

                                                <li><span><?php echo $gap3; ?>/365</span>  Days Mined</li>
                                                <!--<h2 class="blue"><?php echo $gap3; ?>/365 Days Mined</h2> -->
                                                <?php
                                            }
                                            ?>


                                            <?php
                                            $sqln = "SELECT * FROM mediumpack WHERE Username='" . $_SESSION['Username'] . "' AND Comment='Purchased'";
                                            $resultn = mysqli_query($conn, $sqln);
                                            if (mysqli_num_rows($resultn) == 1) {
                                                ?>
                                                <li><i class="fa fa-check text-success" class="green">Purchased</li></i>
                                                <?php
                                            } else {
                                                ?>

                                                <li><i class="fa fa-times text-danger" class="red">Not-Purchased</li></i>
                                                <?php
                                            }
                                            ?>

<!--     <li><span>24/7</span> Support</li>-->
                                        </ul>
                                    </div>
                                    <!--//FEATURE LIST END-->

                                    <!--BUTTON START-->
                                    <div class="generic_price_btn clearfix">
                                        <a class="" href="">Buy Pack</a>
                                    </div>
                                    <!--//BUTTON END-->

                                </div>
                                <!--//PRICE CONTENT END-->

                            </div>

                            <div class="col-md-2 col-half-offset">

                                <!--PRICE CONTENT START-->
                                <div style="width:105%;height:100%;" class="generic_content clearfix">

                                    <!--HEAD PRICE DETAIL START-->
                                    <div class="generic_head_price clearfix">

                                        <!--HEAD CONTENT START-->
                                        <div class="generic_head_content clearfix">

                                            <!--HEAD START-->
                                            <div class="head_bg"></div>
                                            <div class="head">
                                                <span>POOL 4</span>
                                            </div>
                                            <!--//HEAD END-->

                                        </div>
                                        <!--//HEAD CONTENT END-->

                                        <!--PRICE START-->
                                        <div class="generic_price_tag clearfix">	
                                            <span class="price">
                                                <span class="sign" style="font-size:30px;color:#1abb9c;">$</span>
                                                <span class="currency" style="font-size:35px;font-weight:bold;color:#1abb9c;">2,400</span>
                                                <!--<span class="cent">.00</span>
                                                <span class="month">/YR</span>--> 
                                            </span>
                                        </div>
                                        <!--//PRICE END-->

                                    </div>                            
                                    <!--//HEAD PRICE DETAIL END-->

                                    <!--FEATURE LIST START-->
                                    <div class="generic_feature_list">
                                        <ul>
                                            <li><span>Current Investment Return(BTC):</span> <?php echo $packone; ?></li>
                                            <li><span>Approx.</span> $12/day</li>
                                            <li><span>365</span> Mining days</li>

                                            <?php
                                            $granddate = "SELECT * FROM grandpack WHERE Username='" . $_SESSION['Username'] . "'";
                                            $querygrand = mysqli_query($conn, $granddate);
                                            $viewgrand = mysqli_fetch_array($querygrand);
                                            $showgranddate = $viewgrand['MiningDate'];
                                            $grandstatus = $viewgrand['Status'];
                                            if ($showgranddate == "0") {
                                                $grandgap = "0";
                                                ?>

                                                <li><span><?php echo $grandgap; ?>/365</span>  Days Mined</li>
                                                <!--<h2 class="red"><?php echo $grandgap; ?>/365 Days Mined</h2>-->
                                                <?php
                                            } else {
                                                $datetime9 = new DateTime();
                                                $datetime10 = new DateTime($showgranddate);
                                                $intervalgrand = $datetime10->diff($datetime9);
                                                $gapgrand = $intervalgrand->format('%R%a');
                                                ?>

                                                <li><span><?php echo $gapgrand; ?>/365</span>  Days Mined</li>
                                                <!--<h2 class="blue"><?php echo $gapgrand; ?>/365 Days Mined</h2> -->
                                                <?php
                                            }
                                            ?>


                                            <?php
                                            $sqlp = "SELECT * FROM grandpack WHERE Username='" . $_SESSION['Username'] . "' AND Comment='Purchased'";
                                            $resultp = mysqli_query($conn, $sqlp);
                                            if (mysqli_num_rows($resultp) == 1) {
                                                ?>
                                                <li><i class="fa fa-check text-success" class="green">Purchased</li></i>
                                                <?php
                                            } else {
                                                ?>

                                                <li><i class="fa fa-times text-danger" class="red">Not-Purchased</li></i>
                                                <?php
                                            }
                                            ?>

<!--     <li><span>24/7</span> Support</li>-->
                                        </ul>
                                    </div>
                                    <!--//FEATURE LIST END-->

                                    <!--BUTTON START-->
                                    <div class="generic_price_btn clearfix">
                                        <a class="" href="">Buy Pack</a>
                                    </div>
                                    <!--//BUTTON END-->

                                </div>
                                <!--//PRICE CONTENT END-->

                            </div>

                            <div class="col-md-2 col-half-offset">

                                <!--PRICE CONTENT START-->
                                <div style="width:105%;height:100%;" class="generic_content clearfix">

                                    <!--HEAD PRICE DETAIL START-->
                                    <div class="generic_head_price clearfix">

                                        <!--HEAD CONTENT START-->
                                        <div class="generic_head_content clearfix">

                                            <!--HEAD START-->
                                            <div class="head_bg"></div>
                                            <div class="head">
                                                <span>POOL 5</span>
                                            </div>
                                            <!--//HEAD END-->

                                        </div>
                                        <!--//HEAD CONTENT END-->

                                        <!--PRICE START-->
                                        <div class="generic_price_tag clearfix">	
                                            <span class="price">
                                                <span class="sign" style="font-size:30px;color:#1abb9c;">$</span>
                                                <span class="currency" style="font-size:35px;font-weight:bold;color:#1abb9c;">4,800</span>
                                                <!--<span class="cent">.00</span>
                                                <span class="month">/YR</span>--> 
                                            </span>
                                        </div>
                                        <!--//PRICE END-->

                                    </div>                            
                                    <!--//HEAD PRICE DETAIL END-->

                                    <!--FEATURE LIST START-->
                                    <div class="generic_feature_list">
                                        <ul>
                                            <li><span>Current Investment Return(BTC):</span> <?php echo $packone; ?></li>
                                            <li><span>Approx.</span> $24/day</li>
                                            <li><span>365</span> Mining days</li>

                                            <?php
                                            $ultimatedate = "SELECT * FROM ultimatepack WHERE Username='" . $_SESSION['Username'] . "'";
                                            $queryultimate = mysqli_query($conn, $ultimatedate);
                                            $viewultimate = mysqli_fetch_array($queryultimate);
                                            $showultimatedate = $viewultimate['MiningDate'];
                                            $ultimatestatus = $viewultimate['Status'];
                                            if ($showultimatedate == "0") {
                                                $ultimategap = "0";
                                                ?>

                                                <li><span><?php echo $ultimategap; ?>/365</span>  Days Mined</li>
                                                <!--<h2 class="red"><?php echo $ultimategap; ?>/365 Days Mined</h2>-->
                                                <?php
                                            } else {
                                                $datetime7 = new DateTime();
                                                $datetime8 = new DateTime($showultimatedate);
                                                $intervalultimate = $datetime8->diff($datetime7);
                                                $gapultimate = $intervalultimate->format('%R%a');
                                                ?>

                                                <li><span><?php echo $gapultimate; ?>/365</span>  Days Mined</li>
                                                <!--<h2 class="blue"><?php echo $gapultimate; ?>/365 Days Mined</h2>--> 
                                                <?php
                                            }
                                            ?>


                                            <?php
                                            $sqlw = "SELECT * FROM ultimatepack WHERE Username='" . $_SESSION['Username'] . "' AND Comment='Purchased'";
                                            $resultw = mysqli_query($conn, $sqlw);
                                            if (mysqli_num_rows($resultw) == 1) {
                                                ?>
                                                <li><i class="fa fa-check text-success" class="green">Purchased</li></i>
                                                <?php
                                            } else {
                                                ?>

                                                <li><i class="fa fa-times text-danger" class="red">Not-Purchased</li></i>
                                                <?php
                                            }
                                            ?>

<!--     <li><span>24/7</span> Support</li>-->
                                        </ul>
                                    </div>
                                    <!--//FEATURE LIST END-->

                                    <!--BUTTON START-->
                                    <div class="generic_price_btn clearfix">
                                        <a class="" href="">Buy Pack</a>
                                    </div>
                                    <!--//BUTTON END-->

                                </div>
                                <!--//PRICE CONTENT END-->

                            </div>

                        </div>	
                        <!--//BLOCK ROW END-->

                        <!--</div>-->
                        <!-- </section>             -->
                        <!--<footer>
                            <a class="bottom_btn" href="#">&copy; MrSahar</a>
                        </footer>-->
                    </div>



                    <!-- /mycode -->


                    <!-- /page content -->

                    <!-- footer content -->

                    <!-- /footer content -->
                </div>
            </div>
            <?php
            mysqli_close($conn);
            ?>
            <?php
            include('includes/footer.php');
            ?>
    </body>
</html>
