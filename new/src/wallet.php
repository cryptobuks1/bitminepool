<!DOCTYPE html>
<html lang="en">
    <?php
    include('includes/header.php');

    if (isset($_SESSION['Username'])) {
        $_SESSION['error'] = 0;
        $walletData = [];
        $userName = $_SESSION['Username'];
        $response = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                'user_name' => $_SESSION['Username'],
                'platform' => '3',
                ], 'getAllWalletDetailByUserName');

        $response = json_decode($response);
        $redirect = 'login';
        if ($response->statusCode == 100) {
            $walletData = $response->response->wallet_data;
            $_SESSION['message'] = $response->response->statusDescription;
        }
    } else {
        $_SESSION['error'] = 1;
        $_SESSION['message'] = 'Please login to proceed further.';
        unset($_POST);
        unset($_SESSION);
        // header("Location:login");
        $redirect = 'login';
        echo "<script>location='" . BASE_URL . $redirect . "'</script>";
        exit;
    }
    ?>
    <?php include('includes/message.php'); ?>
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
                                <h2><?php echo ' ' . strlen($userName) > 15 ? substr($userName,0,15)."..." : $userName; ?></h2>
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
                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12">

                                <div class="x_content">

                                    <section class="content invoice">
                                        <?php
                                        if (empty($walletData)) {
                                            ?>
                                            <div class="x_content">
                                                <p>By verifying your account you can now be able to see wallet & purchase various products that are available at Bit Mine Pool</p>
                                                <a href="<?php echo BASE_URL . 'verifyemail' ?>"><button type="button" class="btn btn-success btn-lg">Verify Now</button></a>
                                            </div>    
                                            <?php
                                        } else {
                                            ?>
                                            <!-- title row -->
                                            <div class="row">
                                                <div class="col-xs-12 invoice-header">
                                                    <h1>
                                                        <i class="fa fa-globe"></i> <span class="style7">Wallet.</span>
                                                        <small class="pull-right"><span class="style6"><?php echo date("l jS \of F Y h:i:s A") . "<br>"; ?></span></small>                                      </h1>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- info row -->
                                            <div class="row invoice-info">
                                                <div class="col-sm-4 invoice-col">

                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-4 invoice-col">

                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-4 invoice-col">
                                                    <br>
                                                    <b>Balance(IN USD):</b> <?php echo $walletData->balance_usd; ?>
                                                    <br>
                                                   <!-- <b>Invoice Expires in:</b> <b><span id="countdown-1">600 seconds</span></b> -->
                                                    <br>

                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->

                                            <!-- Table row -->
                                            <div class="row">
                                                <div class="col-xs-12 table">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Serial #</th>
                                                                <th style="width: 25%">Label</th>
                                                                <th style="width: 25%">Address</th>
                                                                <th>Balance(BTC)</th>
                                                                <th>Subtotal Received(BTC)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            foreach ($walletData->addresses as $key => $address) {
                                                                echo '<tr>';
                                                                echo '<td>' . ($key + 1) . '</td>';
                                                                echo '<td>' . $address->label . '</td>';
                                                                echo '<td>' . $address->address . '</td>';
                                                                echo '<td>' . $address->balance . '</td>';
                                                                echo '<td>' . $address->total_received . '</td>';
                                                                echo '</tr>';
                                                            }
                                                            ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                            <?php
                                        }
                                        ?>
                                    </section>
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

    <?php
    include('includes/footer.php');
    ?>

</body>
</html>
