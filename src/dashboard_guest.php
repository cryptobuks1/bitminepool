<?php
    include('includes/header.php');
    // print_r($_SESSION);
    $balance = 0;
    $wallet_guid = '';
    if (isset($_SESSION['activation']) && ($_SESSION['activation'] == 1)) {
        if (isset($_SESSION['wallet_guid']) && !empty($_SESSION['wallet_guid'])) {
            $response = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                        'wallet_guid' => $_SESSION['wallet_guid'],
                        'wallet_password' => $_SESSION['wallet_password'],
                        'platform' => '3',
                        'transaction_type' => '206'
                            ], 'getWalletBalance');

            $response = json_decode($response);
            if ($response->statusCode == 100) {
                $balance = $response->response->balance_usd;
                $wallet_guid = $_SESSION['wallet_guid'];
                //$_SESSION['message'] = $response->statusDescription;
            } else {
                $_SESSION['error'] = 1;
                $_SESSION['message'] = $response->statusDescription;
            }
        } else {
            $_SESSION['error'] = 1;
            $_SESSION['message'] = 'Unable to fetch the wallet data , please contact support@bitminepool.com';
        }
    } else {
        $_SESSION['error'] = 1;
        $_SESSION['message'] = 'Please verify your account to proceed.';
        $redirect = 'login';
        //unset($_POST);
        //header("location:dashboard");
        echo "<script>location='" . BASE_URL . $redirect . "'</script>";
        exit();
    }
    ?>

    <body class="nav-md ">
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
                                <a href="<?php echo BASE_URL; ?>"><img src="../images/img.jpg" alt="..." class="img-circle profile_img"></a>
                            </div>
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2><?php
                                    if (isset($_SESSION['Username'])) {
                                        echo ' ' . strlen($_SESSION['Username']) > 15 ? ucfirst(substr($_SESSION['Username'],0,15))."..." : ucfirst($_SESSION['Username']);
                                    } else {
                                       // header("location:login");
                                        $redirect = 'login';
                                        echo "<script>location='" . BASE_URL . $redirect . "'</script>";
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
                    <?php include('includes/message.php'); ?>  
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3 class="style3">Welcome to Bitmine Pool</h3>
                            </div>


                        </div>

                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel wallet-dashboard">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="span4 mq-box">
                                                <!-- plan 1 wrap -->
                                                <div class="price-plan plan-regular text-center text-light text-shadow-dark">
                                                    <!-- regular plan -->
                                                    <div>
                                                        <h4 class="plan-title text-light"></h4>
                                                    </div>
                                                    <div class="price">
                                                        <div class="amount-container">
                                                            <span class="currency">$</span>
                                                            <span class="amount"><?php echo $balance; ?></span>
                                                        </div>
                                                    </div>
                                                    <ul class="plan-features list-style-none">
                                                        <li><strong>Your wallet UID<strong></li>
                                                                    <li><strong><?php echo $wallet_guid; ?><strong></li>
                                                                                </ul>
                                                                                <a href="wallet" class="btn btn-large btn-inverse">Overview</a>
                                                                                </div>
                                                                                <!-- regular plan end -->
                                                                                </div>
                                                                                </div>
                                                                                <!--col ends-->
                                                                                <div class="col-md-4">
                                                                                    <div class="span4 mq-box">
                                                                                        <!-- plan 2 wrap -->
                                                                                        <div class="price-plan plan-gold text-center text-light text-shadow-dark">
                                                                                            <!-- gold plan -->
                                                                                            <h4 class="plan-title text-light"></h4>
                                                                                            <div class="price">
                                                                                                <div class="amount-container">
                                                                                                    <span class="currency">$</span>
                                                                                                    <span class="amount">100</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <ul class="plan-features list-style-none">
                                                                                                <li><strong>Become a</strong></li>
                                                                                                <li><strong>member</strong></li>
                                                                                            </ul>
                                                                                            <a href="create_member" class="btn btn-large btn-inverse">Generate Invoice</a>
                                                                                        </div>
                                                                                        <!-- gold plan end -->
                                                                                    </div>
                                                                                </div>
                                                                                <!--col ends-->
                                                                                <div class="col-md-4">
                                                                                    <div class="span4 mq-box">
                                                                                        <!-- plan 3 wrap -->
                                                                                        <div class="price-plan plan-advanced text-center text-light text-shadow-dark">
                                                                                            <!-- advanced plan -->
                                                                                            <h4 class="plan-title text-light"></h4>
                                                                                            <div class="price">
                                                                                                <div class="amount-container">
                                                                                                    <span class="amount1">INVEST</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <ul class="plan-features list-style-none">
                                                                                                <li><strong>Invest in</strong></li>
                                                                                                <li><strong>bitminepool</strong></li>
                                                                                            </ul>
                                                                                            <a href="create_member" class="btn btn-large btn-inverse">Upgrade</a>
                                                                                        </div>
                                                                                        <!-- advanced plan end -->
                                                                                    </div>
                                                                                </div>
                                                                                <!--col ends-->
                                                                                </div>
                                                                                <!-- row ends -->

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

                                                                                <?php
                                                                                include('includes/footer.php');
                                                                                ?>
                                                                                </body>
                                                                                </html>
