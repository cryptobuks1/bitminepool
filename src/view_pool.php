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
        $responseUser = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                    'user_name' => $userName,
                    'login_user_name' => $_SESSION['Username'],
                    'platform' => '3',
                    'transaction_type' => '301'
                        ], 'getAllUserDataByUserName');

        $responseUser = json_decode($responseUser);

        $selectedAccountBalance = $selectedMiningBalance = $selectedTeamBalance = $selectedCommissionBalance = $selectedBinaryIncomeBalance = $selectedTeamVolumeBalance = $selectedRankId = 0;
        $starterDailyMine = $miniDailyMine = $mediumDailyMine = $grandDailyMine = $ultimateDailyMine = 0;
        $selectedRank = '';

        if ($responseUser->statusCode == 100) {
            $userData = $responseUser->response->dashboard_data;
            $selectedAccountBalance = $userData->selectedAccountBalance;
            $selectedMiningBalance = $userData->selectedMiningBalance;
            $selectedTeamBalance = $userData->selectedTeamBalance;
            $selectedCommissionBalance = $userData->selectedCommissionBalance;
            $selectedBinaryIncomeBalance = $userData->selectedBinaryIncomeBalance;
            $selectedTeamVolumeBalance = $userData->selectedTeamVolumeBalance;
            $selectedRankId = $userData->selectedRankId;
            $starterDailyMine = $userData->starterDailyMine;
            $miniDailyMine = $userData->miniDailyMine;
            $mediumDailyMine = $userData->mediumDailyMine;
            $grandDailyMine = $userData->grandDailyMine;
            $ultimateDailyMine = $userData->ultimateDailyMine;
            $selectedRank = $userData->selectedRank;
        }
        $url = "https://blockchain.info/stats?format=json";
        $stats = json_decode(file_get_contents($url), true);
        $btcValue = $stats['market_price_usd'];

////////////////////////////////////////Get the Bitcoin Wallet balance///////////////////////////////////////////////////////		
        /*       $getone = "SELECT Balance FROM accountbalance WHERE Username = '" . $_SESSION['Username'] . "'";
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
         */
        $url = "https://blockchain.info/stats?format=json";
        $stats = json_decode(file_get_contents($url), true);
        $btcValue = $stats['market_price_usd'];
        $usdCost = $selectedAccountBalance;
        $tempTotalMining = 0;
        $usdCosttwo = $selectedMiningBalance / $btcValue;
        switch ($purpose) {
            case 'Starter':
                $tempTotalMining = $starterDailyMine;
                break;
            case 'Mini':
                $tempTotalMining = $miniDailyMine;
                break;
            case 'Medium':
                $tempTotalMining = $mediumDailyMine;
                break;
            case 'Grand':
                $tempTotalMining = $grandDailyMine;
                break;
            case 'Ultimate':
                $tempTotalMining = $ultimateDailyMine;
                break;
            default:
                $tempTotalMining = $selectedMiningBalance;
                break;
        }
        $tempTotalMiningBtc = $tempTotalMining / $btcValue;
        $usdCostthree = $selectedCommissionBalance / $btcValue;
        $usdCostfour = $selectedTeamVolumeBalance / $btcValue;
        $convertedCost = $usdCost / $btcValue;
        $totalone = sprintf('%0.8f', $convertedCost);
        $totaltwo = sprintf('%0.8f', $usdCosttwo);
        $totalthree = sprintf('%0.8f', $usdCostthree);
        $totalfour = sprintf('%0.8f', $usdCostfour);
        $tempTotalMiningBtc = sprintf('%0.8f', $tempTotalMiningBtc);
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
                        <a href="<?php echo BASE_URL; ?>" class="site_title"> <span><img src="../images/logo_transparent_small.png" alt="Bitc-Mine-Pool" ></span></a>
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

                    <!-- /menu footer buttons -->
                </div>
            </div>

            <?php include('includes/guestheader.php'); ?>

            <!-- page content -->
            <div class="right_col" role="main">
                <!-- top tiles -->
                <div class="row tile_count">
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-bitcoin"></i> Account Balance (USD)</span>
                       <!-- <div class="count"><a href="#"><?php echo $totalone; ?></a></div> -->
                        <div class="count"><a href="#"><?php echo floatVal($selectedAccountBalance); ?></a></div>
                        <!--<span class="count_bottom"><i class="green">($<?php echo $selectedAccountBalance; ?>) </i> Total Balance</span> -->
                        <span class="count_bottom"><i class="green"> </i> Total Balance</span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-clock-o"></i> Total Account Earnings (USD)</span>
                       <!-- <div class="count"><a href="#"><?php echo $totaltwo; ?></a></div> -->
                        <div class="count"><a href="#"><?php echo floatVal($selectedMiningBalance); ?></a></div>
                       <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>($<?php echo $selectedMiningBalance; ?>) </i>Total Earnings</span> -->
                        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> </i>Total Earnings</span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-sitemap"></i> Total Mining Earnings (USD)</span>
                        <!-- <div class="count"><a href="#"><?php echo $tempTotalMiningBtc; ?></a></div> -->
                        <div class="count"><a href="#"><?php echo floatVal($tempTotalMining); ?></a></div>
                       <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>($<?php echo $tempTotalMining; ?>)</i> Mining Earnings</span> -->
                        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> Mining Earnings</span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-th"></i> Commissions (USD)</span>
                        <!--<div class="count"><a href="#"><?php echo $totalthree; ?></a></div> -->
                        <div class="count"><a href="#"><?php echo floatVal($selectedCommissionBalance); ?></a></div>
                        <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>($<?php echo $selectedCommissionBalance; ?>) </i> Total Commission</span> -->
                        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> </i> Total Commission</span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-users"></i> Team Volume (USD)</span>
                       <!-- <div class="count"><a href=""><?php echo $totalfour; ?></a></div> -->
                        <div class="count"><a href=""><?php echo floatVal($selectedTeamVolumeBalance); ?></a></div>
                       <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>($<?php echo $selectedTeamVolumeBalance; ?>)</i> Total team Volume</span> -->
                        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> Total team Volume</span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i> Account Rank</span>
                        <div class="count"><a href="#"><?php echo $selectedRank; ?></a></div>
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
                                        <h2>Daily Mining Earnings <small><?php echo $poolName; ?></small></h2>
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
                                            This are the Daily Earnings From <?php echo $poolName; ?> Mining Contract.
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
                                                $Starterdate = "SELECT MiningDate FROM " . $dbTableName . " WHERE Username='" . $_SESSION['Username'] . "'";
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
                                                            //$Btc = $row['Btc'];
                                                            $Btc = sprintf('%0.8f', ($row['Usd'] / $btcValue));
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
