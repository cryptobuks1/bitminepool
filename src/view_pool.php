<?php
include('includes/header.php');
if (isset($_SESSION['Username'])) {
    $userName = $_SESSION['Username'];
    if (empty($_GET['purpose'])) {
        $_SESSION['error'] = 1;
        $_SESSION['message'] = 'Please try after some time.';
        //unset($_POST);
        // unset($_SESSION);
        //header("Location:login");
        $redirect = 'dashboard';
        echo "<script>location='" . BASE_URL . $redirect . "'</script>";
        exit;
    } else {
        $purpose = $_GET['purpose'];
        $poolPrice = 0;
        $poolName = '';
        $dbTableName = '';
               $responseGetPoolData = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                    'Purpose' => $_GET['purpose'],
                    'platform' => '3'
                        ], 'getPoolDataToRecivePayment');
        $responseGetPoolData = json_decode($responseGetPoolData);

        if ($responseGetPoolData->statusCode == 100) {
            $_SESSION['error'] = 0;
            $poolPrice = $responseGetPoolData->response->price;
            $poolName = $responseGetPoolData->response->tittle;
            $dbTableName = $responseGetPoolData->response->dbtable;
        } else {
            $_SESSION['error'] = 1;
            $_SESSION['message'] = $responseCheckInvoice->statusDescription;
            $poolPrice = 0;
            $poolName = '';
            $dbTableName = '';
            $redirect = 'dashboard';
            echo "<script>location='" . BASE_URL . $redirect . "'</script>";
            exit;
        }
        
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

        $url = "https://blockchain.info/stats?format=json";
        $stats = json_decode(file_get_contents($url), true);
        $btcValue = $stats['market_price_usd'];
        $usdCost = $showone;
        $usdCosttwo = $showtwo / $btcValue;
        $usdCostthree = $showfour / $btcValue;
        $usdCostfour = $showfive / $btcValue;
        $convertedCost = $usdCost / $btcValue;
        $totalone = sprintf('%0.8f', $convertedCost);
        $totaltwo = sprintf('%0.8f', $usdCosttwo);
        $totalthree = sprintf('%0.8f', $usdCostthree);
        $totalfour = sprintf('%0.8f', $usdCostfour);
    }
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
                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <a href="<?php echo BASE_URL; ?>"><img src="../images/img.jpg" alt="..." class="img-circle profile_img"></a>              </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo ' ' . strlen($userName) > 15 ? ucfirst(substr($userName, 0, 15)) . "..." : ucfirst($userName); ?></h2>
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
                        <span class="count_top"><i class="fa fa-bitcoin"></i> Account Balance (BTC)</span>
                        <div class="count"><a href="#"><?php echo $totalone; ?></a></div>
                        <span class="count_bottom"><i class="green">($<?php echo $showone; ?>) </i> Total Balance</span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-clock-o"></i> Total Account Earnings (BTC)</span>
                        <div class="count"><a href="#"><?php echo $totaltwo; ?></a></div>
                        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>($<?php echo $showtwo; ?>) </i>Total Earnings</span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-sitemap"></i> Total Mining Earnings (BTC)</span>
                        <div class="count"><a href="#"><?php echo $totaltwo; ?></a></div>
                        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>($<?php echo $showtwo; ?>)</i> Mining Earnings</span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-th"></i> Commissions (BTC)</span>
                        <div class="count"><a href="#"><?php echo $totalthree; ?></a></div>
                        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>($<?php echo $showfour; ?>) </i> Total Commission</span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-users"></i> Team Volume (BTC)</span>
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

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_content">

                            <div class="row x_title">

                                <div class="col-md-6">

                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Daily Mining Earnings <small><?php echo $poolName;?></small></h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            </li>
                                            <li class="dropdown">

                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#">Settings 1</a>
                                                    </li>
                                                    <li><a href="#">Settings 2</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <p class="text-muted font-13 m-b-30">
                                            This are the Daily Earnings From <?php echo $poolName;?> Mining Contract.
                                        </p>
                                        <table id="datatable-fixed-header" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Date</th>
                                                    <th>Amount (BTC)</th>
                                                    <th>Amount (USD)</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $Starterdate = "SELECT MiningDate FROM ".$dbTableName." WHERE Username='" . $_SESSION['Username'] . "'";
                                                $querystarter = mysqli_query($conn, $Starterdate);
                                                $viewstarter = mysqli_fetch_array($querystarter);
                                                $showstarterdate = $viewstarter['MiningDate'];
                                                $Currentmining = date('Y-m-d', strtotime('-1 days'));
                                                if ($showstarterdate == "0") {
                                                    ?>
                                                    <tr>
                                                        <td colspan="5">Sorry you have no Mining Earnings.</td>
                                                    </tr>
                                                    <?php
                                                } else {
                                                    $i = 1;
                                                    $query = mysqli_query($conn, "select * from dailymine where Pack='$purpose' AND Username ='$userName' and Date Between '$showstarterdate' AND '$Currentmining'");
                                                    if (mysqli_num_rows($query) > 0) {
                                                        while ($row = mysqli_fetch_array($query)) {
                                                            $Date = $row['Date'];
                                                            $Btc = $row['Btc'];
                                                            $Usd = $row['Usd'];
                                                            $Status = $row['Status'];
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i ?></td>
                                                                <td><?php echo $Date ?></td>
                                                                <td><?php echo $Btc ?></td>
                                                                <td><?php echo $Usd ?></td>
                                                                <td><?php echo $Status ?></td>
                                                            </tr>
                                                            <?php
                                                            $i++;
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan="5">Sorry you have no Mining Earnings.</td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                mysqli_close($conn);
                                                ?>



                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- price element -->


                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
                <br />


            </div>

            </body>
            <?php
            include('includes/footer.php');
            ?>
            </html>
