<?php
include('includes/header.php');
if (isset($_SESSION['Username'])) {
    $userData = [];
    $userName = $_SESSION['Username'];
    $responseUser = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
            'user_name' => $userName,
            'login_user_name' => $_SESSION['Username'],
            'platform' => '3',
            'transaction_type' => '301'
            ], 'getAllUserDataByUserName');

    $responseUser = json_decode($responseUser);
    
    $selectedAccountBalance = $selectedMiningBalance = $selectedTeamBalance = $selectedCommissionBalance=$selectedBinaryIncomeBalance=$selectedTeamVolumeBalance=$selectedRankId = 0;
    $starterDailyMine = $miniDailyMine = $mediumDailyMine = $grandDailyMine = $ultimateDailyMine = 0;
    $selectedRank= '';
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
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $url = "https://blockchain.info/stats?format=json";
    $stats = json_decode(file_get_contents($url), true);
    $btcValue = $stats['market_price_usd'];

    $usdCost = $selectedAccountBalance;
    $usdCosttwo = $selectedMiningBalance / $btcValue;
    $usdCostthree = $selectedTeamBalance / $btcValue;
    $usdCostfour = $selectedCommissionBalance / $btcValue;
    $usdCostfive = $selectedBinaryIncomeBalance / $btcValue;
    $convertedCost = $usdCost / $btcValue;
    $totalone = sprintf('%0.8f', $convertedCost);
    $totaltwo = sprintf('%0.8f', $usdCosttwo);
    $totalthree = sprintf('%0.8f', $usdCostthree);
    $totalfour = sprintf('%0.8f', $usdCostfour);
    $totalfive = sprintf('%0.8f', $usdCostfive);

    $packone = sprintf('%0.4f', $starterDailyMine);
    $packtwo = sprintf('%0.4f', $miniDailyMine);
    $packthree = sprintf('%0.4f', $mediumDailyMine);
    $packfour = sprintf('%0.4f', $grandDailyMine);
    $packfive = sprintf('%0.4f', $ultimateDailyMine);
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
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <a href="<?php echo BASE_URL; ?>"><img src="../images/img.jpg" alt="..." class="img-circle profile_img"></a>              </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php
                            if (isset($_SESSION['Username'])) {
                                echo ' ' . strlen($_SESSION['Username']) > 15 ? ucfirst(substr($_SESSION['Username'], 0, 15)) . "..." : ucfirst($_SESSION['Username']);
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
                        <div class="count"><a href="statement?type=1&reason=0"><?php echo $selectedAccountBalance; ?></a></div>
                        <!-- <span class="count_bottom"><i class="green">($<?php echo $selectedAccountBalance; ?>) </i> Total Balance</span> -->
                        <span class="count_bottom"><i class="green"></i> Total Balance</span>
                    </div>

                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-sitemap"></i> Total Mining Earnings (USD)</span>
                        <!-- <div class="count"><a href="#"><?php echo $totaltwo; ?></a></div> -->
                         <div class="count"><a href="statement?type=1&reason=5"><?php echo $selectedMiningBalance; ?></a></div>
                        <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>($<?php echo $selectedMiningBalance; ?>)</i> Mining Earnings</span> -->
                        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> Mining Earnings</span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-clock-o"></i> Residual Income (USD)</span>
                        <!-- <div class="count"><a href="#"><?php echo $totalthree; ?></a></div> -->
                        <div class="count"><a href="statement?type=1&reason=4"><?php echo $selectedTeamBalance; ?></a></div>
                       <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>($<?php echo $selectedTeamBalance; ?>) </i>Total Residual </span> -->
                        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> </i>Total Residual </span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-th"></i> Direct Commissions (USD)</span>
                       <!-- <div class="count"><a href="#"><?php echo $totalfour; ?></a></div> -->
                        <div class="count"><a href="statement?type=1&reason=1"><?php echo $selectedCommissionBalance; ?></a></div>
                       <!--  <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>($<?php echo $selectedCommissionBalance; ?>) </i> Total Commission</span> -->
                        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> </i> Total Commission</span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-users"></i> Binary Earnings (USD)</span>
                        <!-- <div class="count"><a href=""><?php echo $totalfive; ?></a></div> -->
                        <div class="count"><a href="statement?type=1&reason=2"><?php echo $selectedBinaryIncomeBalance; ?></a></div>
                       <!--  <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>($<?php echo $selectedBinaryIncomeBalance; ?>)</i> Total team Volume</span> -->
                        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> Total team Volume</span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i> Account Rank</span>
                        <div class="count"><a href="#"><?php echo $selectedRank; ?></a></div>
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
                                        <li><span>Current Investment Return(USD):</span> <?php echo floatVal($packone); ?></li>
                                        <li><span>Approx.</span> $1.5/day</li>
                                        <li><span>365</span> Mining days</li>

                                        <?php
                                        $Starterdate = "SELECT * FROM starterpack WHERE Username='" . $_SESSION['Username'] . "' order by id desc limit 1";
                                        $querystarter = mysqli_query($conn, $Starterdate);
                                        $viewstarter = mysqli_fetch_array($querystarter);
                                        $showstarterdate = $viewstarter['MiningDate'];
                                        //$showstarterdate = $viewstarter['PurchaseDate'];
                                        $starterstatus = $viewstarter['Status'];
                                        if ($showstarterdate == "0") {
                                            $gapone = "0";
                                            ?>
                                            <li><span><?php echo $gapone; ?>/365</span>  Days Mined</li>
                                            <li><span><?php echo $gapone; ?>/30</span>  Waiting Period</li>
                                            
                                            <!--<h2 class="red"><?php echo $gapone; ?>/365 Days Mined</h2>-->
                                            <?php
                                        } else {
                                            $datetime1 = new DateTime();
                                            $datetime2 = new DateTime($showstarterdate);
                                            $interval = $datetime2->diff($datetime1);
                                            $gap = $interval->format('%a');
                                            
                                            ?>
                                            <li><span><?php echo $gap; ?>/365</span>  Days Mined</li>
                                            <?php
                                                if($gap > 30){
                                                    echo '<li>No Waiting Period.</li>';
                                                } else {
                                                   echo '<li><span>'. $gap.'/30</span>  Waiting Period.</li>'; 
                                                }
                                            ?>
                                            <!--<h2 class="blue"><?php echo $gap; ?>/365 Days Mined</h2> -->
                                            <?php
                                        }
                                        ?>


                                        <?php
                                        $sqll = "SELECT * FROM starterpack WHERE Username='" . $_SESSION['Username'] . "' AND Comment='Purchased' order by id desc limit 1";
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
                                    </ul>
                                </div>
                                <!--//FEATURE LIST END-->

                                <!--BUTTON START-->
                                <div class="generic_price_btn clearfix">
                                    <?php
                                    if (mysqli_num_rows($resultl) == 1) {
                                        ?>
                                        <a class="" href="">Purchased</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a class="" href="purchase_pool?Purpose=Starter">Buy Pack</a>
                                        <?php
                                    }
                                    ?>
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
                                        <li><span>Current Investment Return(USD):</span> <?php echo floatVal($packtwo); ?></li>
                                        <li><span>Approx.</span> $3/day</li>
                                        <li><span>365</span> Mining days</li>

                                        <?php
                                        $minidate = "SELECT * FROM minipack WHERE Username='" . $_SESSION['Username'] . "' order by id desc limit 1";
                                        $querymini = mysqli_query($conn, $minidate);
                                        $viewmini = mysqli_fetch_array($querymini);
                                        $showminidate = $viewmini['MiningDate'];
                                        //$showminidate = $viewmini['PurchaseDate'];
                                        $ministatus = $viewmini['Status'];
                                        if ($showminidate == "0") {
                                            $gap1 = "0";
                                            ?>

                                            <li><span><?php echo $gap1; ?>/365</span>  Days Mined</li>
                                            <li><span><?php echo $gap1; ?>/30</span>  Waiting Period</li>
                                            <!--<h2 class="red"><?php echo $gap1; ?>/365 Days Mined</h2>-->
                                            <?php
                                        } else {
                                            $datetime3 = new DateTime();
                                            $datetime4 = new DateTime($showminidate);
                                            $interval1 = $datetime4->diff($datetime3);
                                            $gap2 = $interval1->format('%a');
                                            ?>

                                            <li><span><?php echo $gap2; ?>/365</span>  Days Mined</li>
                                            <?php
                                                if($gap2 > 30){
                                                    echo '<li>No Waiting Period.</li>';
                                                } else {
                                                   echo '<li><span>'. $gap2.'/30</span>  Waiting Period.</li>'; 
                                                }
                                            ?>
                                            <!--<h2 class="blue"><?php echo $gap2; ?>/365 Days Mined</h2> -->
                                            <?php
                                        }
                                        ?>


                                        <?php
                                        $sqlm = "SELECT * FROM minipack WHERE Username='" . $_SESSION['Username'] . "' AND Comment='Purchased' order by id desc limit 1";
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
                                    <?php
                                    if (mysqli_num_rows($resultm) == 1) {
                                        ?>
                                        <a class="" href="">Purchased</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a class="" href="purchase_pool?Purpose=Mini">Buy Pack</a>
                                        <?php
                                    }
                                    ?>

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
                                        <li><span>Current Investment Return(USD):</span> <?php echo floatVal($packthree); ?></li>
                                        <li><span>Approx.</span> $6/day</li>
                                        <li><span>365</span> Mining days</li>

                                        <?php
                                        $mediumdate = "SELECT * FROM mediumpack WHERE Username='" . $_SESSION['Username'] . "' order by id desc limit 1";
                                        $querymedium = mysqli_query($conn, $mediumdate);
                                        $viewmedium = mysqli_fetch_array($querymedium);
                                        $showmediumdate = $viewmedium['MiningDate'];
                                       // $showmediumdate = $viewmedium['PurchaseDate'];
                                        $mediumstatus = $viewmedium['Status'];
                                        if ($showmediumdate == "0") {
                                            $mediumgap = "0";
                                            ?>

                                            <li><span><?php echo $mediumgap; ?>/365</span>  Days Mined</li>
                                            <li><span><?php echo $mediumgap; ?>/30</span>  Waiting Period</li>
                                            <!--<h2 class="red"><?php echo $mediumgap; ?>/365 Days Mined</h2>-->
                                            <?php
                                        } else {
                                            $datetime5 = new DateTime();
                                            $datetime6 = new DateTime($showmediumdate);
                                            $interval2 = $datetime6->diff($datetime5);
                                            $gap3 = $interval2->format('%a');
                                            ?>

                                            <li><span><?php echo $gap3; ?>/365</span>  Days Mined</li>
                                            <?php
                                                if($gap3 > 30){
                                                    echo '<li>No Waiting Period.</li>';
                                                } else {
                                                   echo '<li><span>'. $gap3.'/30</span>  Waiting Period.</li>'; 
                                                }
                                            ?>
                                            <!--<h2 class="blue"><?php echo $gap3; ?>/365 Days Mined</h2> -->
                                            <?php
                                        }
                                        ?>


                                        <?php
                                        $sqln = "SELECT * FROM mediumpack WHERE Username='" . $_SESSION['Username'] . "' AND Comment='Purchased' order by id desc limit 1";
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
                                    <?php
                                    if (mysqli_num_rows($resultn) == 1) {
                                        ?>
                                        <a class="" href="">Purchased</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a class="" href="purchase_pool?Purpose=Medium">Buy Pack</a>
                                        <?php
                                    }
                                    ?>

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
                                        <li><span>Current Investment Return(USD):</span> <?php echo floatVal($packfour); ?></li>
                                        <li><span>Approx.</span> $12/day</li>
                                        <li><span>365</span> Mining days</li>

                                        <?php
                                        $granddate = "SELECT * FROM grandpack WHERE Username='" . $_SESSION['Username'] . "' order by id desc limit 1";
                                        $querygrand = mysqli_query($conn, $granddate);
                                        $viewgrand = mysqli_fetch_array($querygrand);
                                        $showgranddate = $viewgrand['MiningDate'];
                                        //$showgranddate = $viewgrand['PurchaseDate'];
                                        $grandstatus = $viewgrand['Status'];
                                        if ($showgranddate == "0") {
                                            $grandgap = "0";
                                            ?>

                                            <li><span><?php echo $grandgap; ?>/365</span>  Days Mined</li>
                                            <li><span><?php echo $grandgap; ?>/30</span>  Waiting Period</li>
                                            <!--<h2 class="red"><?php echo $grandgap; ?>/365 Days Mined</h2>-->
                                            <?php
                                        } else {
                                            $datetime9 = new DateTime();
                                            $datetime10 = new DateTime($showgranddate);
                                            $intervalgrand = $datetime10->diff($datetime9);
                                            $gapgrand = $intervalgrand->format('%a');
                                            ?>

                                            <li><span><?php echo $gapgrand; ?>/365</span>  Days Mined</li>
                                            <?php
                                                if($gapgrand > 30){
                                                    echo '<li>No Waiting Period.</li>';
                                                } else {
                                                   echo '<li><span>'. $gapgrand.'/30</span>  Waiting Period.</li>'; 
                                                }
                                            ?>
                                            <!--<h2 class="blue"><?php echo $gapgrand; ?>/365 Days Mined</h2> -->
                                            <?php
                                        }
                                        ?>


                                        <?php
                                        $sqlp = "SELECT * FROM grandpack WHERE Username='" . $_SESSION['Username'] . "' AND Comment='Purchased' order by id desc limit 1";
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
                                    <?php
                                    if (mysqli_num_rows($resultp) == 1) {
                                        ?>
                                        <a class="" href="">Purchased</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a class="" href="purchase_pool?Purpose=Grand">Buy Pack</a>
                                        <?php
                                    }
                                    ?>

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
                                        <li><span>Current Investment Return(USD):</span> <?php echo floatVal($packfive); ?></li>
                                        <li><span>Approx.</span> $24/day</li>
                                        <li><span>365</span> Mining days</li>

                                        <?php
                                        $ultimatedate = "SELECT * FROM ultimatepack WHERE Username='" . $_SESSION['Username'] . "' order by id desc limit 1";
                                        $queryultimate = mysqli_query($conn, $ultimatedate);
                                        $viewultimate = mysqli_fetch_array($queryultimate);
                                        $showultimatedate = $viewultimate['MiningDate'];
                                       // $showultimatedate = $viewultimate['PurchaseDate'];
                                        $ultimatestatus = $viewultimate['Status'];
                                        if ($showultimatedate == "0") {
                                            $ultimategap = "0";
                                            ?>

                                            <li><span><?php echo $ultimategap; ?>/365</span>  Days Mined</li>
                                            <li><span><?php echo $ultimategap; ?>/30</span>  Waiting Period</li>
                                            <!--<h2 class="red"><?php echo $ultimategap; ?>/365 Days Mined</h2>-->
                                            <?php
                                        } else {
                                            $datetime7 = new DateTime();
                                            $datetime8 = new DateTime($showultimatedate);
                                            $intervalultimate = $datetime8->diff($datetime7);
                                            $gapultimate = $intervalultimate->format('%a');
                                            ?>

                                            <li><span><?php echo $gapultimate; ?>/365</span>  Days Mined</li>
                                            <?php
                                                if($gapultimate > 30){
                                                    echo '<li>No Waiting Period.</li>';
                                                } else {
                                                   echo '<li><span>'. $gapultimate.'/30</span>  Waiting Period.</li>'; 
                                                }
                                            ?>
                                            <!--<h2 class="blue"><?php echo $gapultimate; ?>/365 Days Mined</h2>--> 
                                            <?php
                                        }
                                        ?>


                                        <?php
                                        $sqlw = "SELECT * FROM ultimatepack WHERE Username='" . $_SESSION['Username'] . "' AND Comment='Purchased' order by id desc limit 1";
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
                                    <?php
                                    if (mysqli_num_rows($resultw) == 1) {
                                        ?>
                                        <a class="" href="">Purchased</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a class="" href="purchase_pool?Purpose=Ultimate">Buy Pack</a>
                                        <?php
                                    }
                                    ?>

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
