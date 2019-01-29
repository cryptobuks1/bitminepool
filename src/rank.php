<?php
include('includes/header.php');
if (isset($_SESSION['Username'])) {
    $response = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                'user_name' => $_SESSION['Username'],
                'platform' => '3'
                    ], 'getAllRankData');

    $response = json_decode($response);

    if ($response->statusCode == 100) {
        $showone = $response->response->selectedAccountBalance;
        $showtwo = $response->response->selectedMiningBalance;
        $showthree = $response->response->selectedTeamBalance;
        $showfour = $response->response->selectedCommissionBalance;
        $showfive = $response->response->selectedTeamVolumeBalance;
        $showrank = $response->response->selectedRank;
        $showrankid = $response->response->selectedRankId;
        $purchasedRegistrationMembership = $response->response->purchasedRegistrationMembership;
        $purchasedAnyOfPool = $response->response->purchasedAnyOfPool;
        $dealerTotalEnrollment = $response->response->dealerTotalEnrollment;
        $dealerSixMinersEnrollment = $response->response->dealerSixMinersEnrollment;
        $dealerSixMinersWithTwoSubMinersEnrollment = $response->response->dealerSixMinersWithTwoSubMinersEnrollment;
        $superDealerTotalEnrollment = $response->response->superDealerTotalEnrollment;
        $superDealerThreeDealersEnrollment = $response->response->superDealerThreeDealersEnrollment;
        $executiveDealerTotalEnrollment = $response->response->executiveDealerTotalEnrollment;
        $executiveDealerTwoSuperDealersEnrollment = $response->response->executiveDealerTwoSuperDealersEnrollment;
        $crownDealerTotalEnrollment = $response->response->crownDealerTotalEnrollment;
        $crownDealerThreeExecutiveDealersEnrollment = $response->response->crownDealerThreeExecutiveDealersEnrollment;
        $globalCrownDealerTotalEnrollment = $response->response->globalCrownDealerTotalEnrollment;
        $globalCrownDealerThreeCrownDealersEnrollment = $response->response->globalCrownDealerThreeCrownDealersEnrollment;
    } else {
        $showone = $showtwo = $showthree = $showfour = $showfive = 0.00;
        $showrank = 'Miner';
        $showrankid = 1;
        $_SESSION['error'] = 1;
        $purchasedRegistrationMembership = $purchasedAnyOfPool = 0;
        $dealerTotalEnrollment = $dealerSixMinersEnrollment = $dealerSixMinersWithTwoSubMinersEnrollment = 0;
        $superDealerTotalEnrollment = $superDealerThreeDealersEnrollment = 0;
        $executiveDealerTotalEnrollment =$executiveDealerTwoSuperDealersEnrollment = 0;
        $crownDealerTotalEnrollment=$crownDealerThreeExecutiveDealersEnrollment = 0;
        $globalCrownDealerTotalEnrollment = $globalCrownDealerThreeCrownDealersEnrollment = 0;
        $_SESSION['message'] = $response->statusDescription;
    }


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
<style>

    .card {

        width: 100%;
        min-height: 100px;
        overflow: hidden;
        position:relative;
        background-color: white;
        border-radius: 4px;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    }

    .header, .center {
        text-align: center;
    }

    <!--#table_miner {
        margin-top: 45px;
    }-->

    td {
        font-size: 15.5px;
        font-weight: 500;


    }

    thead {
        font-size:17px;
        color: white;
        background-color: #1abb9c;
    }
    @media (min-width: 768px) {
        .tile_count .tile_stats_count .count {
            font-size: 22px
        }
    }
</style>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

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
                            <h2><?php echo ' ' . strlen($_SESSION['Username']) > 15 ? ucfirst(substr($_SESSION['Username'], 0, 15)) . "..." : ucfirst($_SESSION['Username']); ?></h2>
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
                        <span class="count_top"><i class="fa fa-user"></i> Account Rank</span>
                        <div class="count"><?php echo $showrank; ?></a></div>
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

                            <div class="col-md-12 col-sm-12 col-xs-12" style="padding-left:20%;">
                                <div class="row">
                                    <div class="col-md-10 col-xs-10 col-sm-10">
                                        <div class="card">
                                            <div class="card-text">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="header" scope="col"><font size=4>MINER</font> Requirements</th>
                                                            <th class="header" scope="col"></th>
                                                            <th class="header" scope="col">Status</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td class="center">Purchase $100 Membership</td>
                                                            <td class="center"></td>
                                                            <td class="center"><i class="fas fa-check-circle fa-lg" style="<?php echo ($purchasedRegistrationMembership == 1 ) ? 'color:#1abb9c;margin-top: 5px;' : 'color:grey;margin-top: 5px;'; ?>" ></i></td>
                                                        </tr>

                                                        <tr>
                                                            <td class="center">Purchase at least 1 share of ANY pool</td>
                                                            <td class="center"></td>
                                                            <td class="center"><i class="fas fa-check-circle fa-lg" style="<?php echo ($purchasedAnyOfPool == 1 ) ? 'color:#1abb9c;margin-top: 5px;' : 'color:grey;margin-top: 5px;'; ?>" ></i></td>
                                                        </tr>
                                                    </tbody>

                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-10 col-xs-10 col-sm-10">
                                        <div class="card">
                                            <div class="card-text">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="header" scope="col"><font size=4>DEALER</font> Requirements</th>
                                                            <th class="header" scope="col"></th>
                                                            <th class="header" scope="col">Status</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td class="center">Achieve <strong>MINER</strong> status AND...</td>
                                                            <td class="center"></td>
                                                            <td class="center"><i class="fas fa-check-circle fa-lg" style="<?php echo ($showrankid >= 1 ) ? 'color:#1abb9c;margin-top: 5px;' : 'color:grey;margin-top: 5px;'; ?>" ></i></td>
                                                        </tr>

                                                        <tr>
                                                            <td class="center">$11,400 in total enrollment tree volume</td>
                                                            <td class="center"></td>
                                                            <td class="center"><i class="fas fa-check-circle fa-lg" style="<?php echo ($dealerTotalEnrollment == 1 ) ? 'color:#1abb9c;margin-top: 5px;' : 'color:grey;margin-top: 5px;'; ?>" ></i></td>
                                                        </tr>

                                                        <tr>
                                                            <td class="center">Sponsor 6 miners</td>
                                                            <td class="center"></td>
                                                            <td class="center"><i class="fas fa-check-circle fa-lg" style="<?php echo ($dealerSixMinersEnrollment == 1 ) ? 'color:#1abb9c;margin-top: 5px;' : 'color:grey;margin-top: 5px;'; ?>" ></i></td>
                                                        </tr>

                                                        <tr>
                                                            <td class="center">Get 6 <strong>MINERS</strong> that each have 2 Miners enrolled</td>
                                                            <td class="center"></td>
                                                            <td class="center"><i class="fas fa-check-circle fa-lg" style="<?php echo ($dealerSixMinersWithTwoSubMinersEnrollment == 1 ) ? 'color:#1abb9c;margin-top: 5px;' : 'color:grey;margin-top: 5px;'; ?>" ></i></td>
                                                        </tr>
                                                    </tbody>

                                                </table>					
                                            </div>

                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-10 col-xs-10 col-sm-10">
                                        <div class="card">
                                            <div class="card-text">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="header" scope="col"><font size=4>SUPER DEALER</font> Requirements</th>
                                                            <th class="header" scope="col"></th>
                                                            <th class="header" scope="col">Status</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td class="center">Achieve <strong>DEALER</strong> status AND...</td>
                                                            <td class="center"></td>
                                                            <td class="center"><i class="fas fa-check-circle fa-lg" style="<?php echo ($showrankid >= 2 ) ? 'color:#1abb9c;margin-top: 5px;' : 'color:grey;margin-top: 5px;'; ?>" ></i></td>
                                                        </tr>

                                                        <tr>
                                                            <td class="center">$50,000 in total enrollment tree volume</td>
                                                            <td class="center"></td>
                                                            <td class="center"><i class="fas fa-check-circle fa-lg" style="<?php echo ($superDealerTotalEnrollment == 1 ) ? 'color:#1abb9c;margin-top: 5px;' : 'color:grey;margin-top: 5px;'; ?>" ></i></td>
                                                        </tr>

                                                        <tr>
                                                            <td class="center">Get 3 <strong>DEALERS</strong> in 3 separate enrollment tree legs(not binary)</td>
                                                            <td class="center"></td>
                                                            <td class="center"><i class="fas fa-check-circle fa-lg" style="<?php echo ($superDealerThreeDealersEnrollment == 1 ) ? 'color:#1abb9c;margin-top: 5px;' : 'color:grey;margin-top: 5px;'; ?>" ></i></td>
                                                        </tr>
                                                    </tbody>

                                                </table>					
                                            </div>

                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-10 col-xs-10 col-sm-10">
                                        <div class="card">
                                            <div class="card-text">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="header" scope="col"><font size=4>EXECUTIVE DEALER</font> Requirements</th>
                                                            <th class="header" scope="col"></th>
                                                            <th class="header" scope="col">Status</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td class="center">Achieve <strong>SUPER DEALER</strong> status AND...</td>
                                                            <td class="center"></td>
                                                            <td class="center"><i class="fas fa-check-circle fa-lg" style="<?php echo ($showrankid >= 3 ) ? 'color:#1abb9c;margin-top: 5px;' : 'color:grey;margin-top: 5px;'; ?>" ></i></td>
                                                        </tr>

                                                        <tr>
                                                            <td class="center">$220,000 in total enrollment tree volume</td>
                                                            <td class="center"></td>
                                                            <td class="center"><i class="fas fa-check-circle fa-lg" style="<?php echo ($executiveDealerTotalEnrollment == 1 ) ? 'color:#1abb9c;margin-top: 5px;' : 'color:grey;margin-top: 5px;'; ?>" ></i></td>
                                                        </tr>

                                                        <tr>
                                                            <td class="center">Get 2 <strong>SUPER DEALERS</strong> in 2 separate enrollment tree legs(not binary)</td>
                                                            <td class="center"></td>
                                                            <td class="center"><i class="fas fa-check-circle fa-lg" style="<?php echo ($executiveDealerTwoSuperDealersEnrollment == 1 ) ? 'color:#1abb9c;margin-top: 5px;' : 'color:grey;margin-top: 5px;'; ?>" ></i></td>
                                                        </tr>
                                                    </tbody>

                                                </table>					
                                            </div>

                                        </div>
                                    </div>
                                </div><br>
                                <!-- price element -->
                                <div class="row">
                                    <div class="col-md-10 col-xs-10 col-sm-10">
                                        <div class="card">
                                            <div class="card-text">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="header" scope="col"><font size=4>CROWN DEALER</font> Requirements</th>
                                                            <th class="header" scope="col"></th>
                                                            <th class="header" scope="col">Status</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td class="center">Achieve <strong>EXECUTIVE DEALER</strong> status AND...</td>
                                                            <td class="center"></td>
                                                            <td class="center"><i class="fas fa-check-circle fa-lg" style="<?php echo ($showrankid >= 4 ) ? 'color:#1abb9c;margin-top: 5px;' : 'color:grey;margin-top: 5px;'; ?>" ></i></td>
                                                        </tr>

                                                        <tr>
                                                            <td class="center">$2,000,000 in total enrollment tree volume</td>
                                                            <td class="center"></td>
                                                            <td class="center"><i class="fas fa-check-circle fa-lg" style="<?php echo ($crownDealerTotalEnrollment == 1 ) ? 'color:#1abb9c;margin-top: 5px;' : 'color:grey;margin-top: 5px;'; ?>" ></i></td>
                                                        </tr>

                                                        <tr>
                                                            <td class="center">Get 3 <strong>EXECUTIVE DEALERS</strong> in 3 separate enrollment tree legs(not binary)</td>
                                                            <td class="center"></td>
                                                            <td class="center"><i class="fas fa-check-circle fa-lg" style="<?php echo ($crownDealerThreeExecutiveDealersEnrollment == 1 ) ? 'color:#1abb9c;margin-top: 5px;' : 'color:grey;margin-top: 5px;'; ?>" ></i></td>
                                                        </tr>
                                                    </tbody>

                                                </table>					
                                            </div>

                                        </div>
                                    </div>
                                </div><br>
                                <!-- price element -->
                                <div class="row">
                                    <div class="col-md-10 col-xs-10 col-sm-10">
                                        <div class="card">
                                            <div class="card-text">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="header" scope="col"><font size=4>GLOBAL CROWN DEALER</font> Requirements</th>
                                                            <th class="header" scope="col"></th>
                                                            <th class="header" scope="col">Status</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td class="center">Achieve <strong>CROWN DEALER</strong> status AND...</td>
                                                            <td class="center"></td>
                                                            <td class="center"><i class="fas fa-check-circle fa-lg" style="<?php echo ($showrankid >= 5 ) ? 'color:#1abb9c;margin-top: 5px;' : 'color:grey;margin-top: 5px;'; ?>" ></i></td>
                                                        </tr>

                                                        <tr>
                                                            <td class="center">$10,000,000 in total enrollment tree volume</td>
                                                            <td class="center"></td>
                                                            <td class="center"><i class="fas fa-check-circle fa-lg" style="<?php echo ($globalCrownDealerTotalEnrollment == 1 ) ? 'color:#1abb9c;margin-top: 5px;' : 'color:grey;margin-top: 5px;'; ?>" ></i></td>
                                                        </tr>

                                                        <tr>
                                                            <td class="center">Get 3 <strong>CROWN DEALERS</strong> in 3 separate enrollment tree legs(not binary)</td>
                                                            <td class="center"></td>
                                                            <td class="center"><i class="fas fa-check-circle fa-lg" style="<?php echo ($globalCrownDealerThreeCrownDealersEnrollment == 1 ) ? 'color:#1abb9c;margin-top: 5px;' : 'color:grey;margin-top: 5px;'; ?>" ></i></td>
                                                        </tr>
                                                    </tbody>

                                                </table>					
                                            </div>

                                        </div>
                                    </div>
                                </div><br>

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
