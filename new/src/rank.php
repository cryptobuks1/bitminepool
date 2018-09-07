<?php
include('includes/header.php');
if (isset($_SESSION['Username'])) {
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
} else {
    $_SESSION['error'] = 1;
    $_SESSION['message'] = 'Please login to proceed further.';
    unset($_POST);
    unset($_SESSION);
    //header("Location:login");
    $redirect = 'login';
    echo "<script>location='" . BASE_URL . $redirect . "'</script>";
    exit;
}
include('includes/message.php');
?>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo BASE_URL; ?>" class="site_title"> <span><img src="../images/logo.png" alt="Bit-Mine-Pool" style="width: 95px;"></span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <a href="<?php echo BASE_URL; ?>"><img src="../images/img.jpg" alt="..." class="img-circle profile_img"></a>              </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo ' ' . strlen($_SESSION['Username']) > 15 ? substr($_SESSION['Username'], 0, 15) . "..." : $_SESSION['Username']; ?></h2>
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

            <?php include('includes/guestheader.php'); ?>

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

            <?php
            include('includes/footer.php');
            ?>

            </body>
            </html>
