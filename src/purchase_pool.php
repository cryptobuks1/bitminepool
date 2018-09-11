<?php
include('includes/header.php');
if (isset($_SESSION['Username'])) {
    if (empty($_REQUEST['Purpose'])) {
        $_SESSION['error'] = 1;
        $_SESSION['message'] = 'Please try after some time.';
        //header("Location:login");
        $redirect = 'dashboard';
        echo "<script>location='" . BASE_URL . $redirect . "'</script>";
        exit;
    }
    $purpose = $_REQUEST['Purpose'];
    $userName = $_SESSION['Username'];
    $responseCheckInvoice = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                'Username' => $_SESSION['Username'],
                'Purpose' => $_REQUEST['Purpose'],
                'platform' => '3'
                    ], 'checkForAvailableInvoiceToRecivePayment');

    $responseCheckInvoice = json_decode($responseCheckInvoice);
    if ($responseCheckInvoice->statusCode == 100) {
        $_SESSION['error'] = 0;
        $_SESSION['message'] = $responseCheckInvoice->statusDescription;
        $redirect = 'pay_invoice?purpose=' . $responseCheckInvoice->response->Purpose . '&invoice_id=' . $responseCheckInvoice->response->Invoiceid;
        echo "<script>location='" . BASE_URL . $redirect . "'</script>";
        exit;
    } else {
        $responseGetPoolData = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                    'Purpose' => $_REQUEST['Purpose'],
                    'platform' => '3'
                        ], 'getPoolDataToRecivePayment');
        $responseGetPoolData = json_decode($responseGetPoolData);

        if ($responseGetPoolData->statusCode == 100) {
            $_SESSION['error'] = 0;
            $poolPrice = $responseGetPoolData->response->price;
        } else {
            $_SESSION['error'] = 1;
            $_SESSION['message'] = $responseCheckInvoice->statusDescription;
            $poolPrice = 0;
            $redirect = 'dashboard';
            echo "<script>location='" . BASE_URL . $redirect . "'</script>";
            exit;
        }
    }

    if (!empty($_POST)) {

        $response = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                    'Username' => $_POST['Username'],
                    'Purpose' => $_POST['Purpose'],
                    'Invoiceid' => $_POST['Invoiceid'],
                    'Paydate' => $_POST['Paydate'],
                    'Amount' => $_POST['Amount'],
                    'Btcamount' => $_POST['Btcamount'],
                    'Status' => $_POST['Status'],
                    'platform' => '3',
                    'transaction_type' => '301'
                        //'grant_type' => 'client_credentials'
                        ], 'generateAddressToRecivePayment');

        $response = json_decode($response);
        $redirect = 'purchase_pool?Purpose=' . $_POST['Purpose'];
        if ($response->statusCode == 100) {
            $_SESSION['error'] = 0;
            $_SESSION['message'] = $response->statusDescription;
            // $redirect = 'verifyemail';
            $_SESSION['Username'] = $_POST['Username'];
        } else {
            $_SESSION['error'] = 1;
            $_SESSION['message'] = $response->statusDescription;
        }
        unset($_POST);
        //header("Location:" . $redirect);
        echo "<script>location='" . BASE_URL . $redirect . "'</script>";
        exit;
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
<?php include('includes/message.php'); ?>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"> <span><img src="../images/logo.png" alt="Bitc-Mine-Pool" style="width: 95px;"></span></a>
                    </div>

                    <div class="clearfix"></div>

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
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3 class="style3">Welcome to Bitmine Pool</h3>
                        </div>


                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Generate Pool Invoice</h2>
                                    <?php
                                    $url = "https://blockchain.info/stats?format=json";
                                    $stats = json_decode(file_get_contents($url), true);
                                    $btcValue = $stats['market_price_usd'];
                                    $usdCost = $poolPrice;
                                    $packcost = $poolPrice;
                                    $convertedCost = $usdCost / $btcValue;
                                    $totalamount = round($convertedCost, 8);
                                    ?>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <h3>Invoice Details</h3>
                                    <h4><strong>Instructions</strong></h4>
                                    <p class="style4">1. Please confirm the details of the invoice before generating an invoice. </p>
                                    <p class="style7"><span class="style6">2. You cannot generate an Unpaid invoice more than</span> <span class="style5">Once</span> <span class="style6">so please generate the invoice only when you are ready to pay.</span></p>
                                    <form class="form-horizontal form-label-left input_mask" action="" method="Post">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date:</label>
                                            <div class="col-md-3 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" name="Paydate" id="Date" readonly="readonly" value="<?php echo date("d-m-Y"); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Invoice Number:</label>
                                            <div class="col-md-3 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" name="Invoiceid" id="Invoiceid" readonly="readonly" value="<?php echo mt_rand(0, 10000000); ?> ">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Invoice Purpose</label>
                                            <div class="col-md-3 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" name="Purpose" id="Purpose" readonly="readonly" value="<?php echo $purpose ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount in USD</label>
                                            <div class="col-md-3 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" name="Amount" id="Amount" readonly="readonly" value="<?php echo $packcost; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount in BTC</label>
                                            <div class="col-md-3 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" name="Btcamount" id="Btcamount" readonly="readonly" value="<?php echo $totalamount; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Invoice Status</label>
                                            <div class="col-md-3 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" name="Status" id="Status" readonly="readonly" value="Unpaid">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Username</label>
                                            <div class="col-md-3 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" name="Username" id="Username"	readonly="readonly" value="<?php echo $_SESSION['Username']; ?>">
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                            <a href="dashboard"><button type="button" class="btn btn-primary">Cancel invoice</button></a>
                                            <button type="submit" name="submitbutton" class="btn btn-success">Generate Invoice</button>

                                        </div>
                                    </form>
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
