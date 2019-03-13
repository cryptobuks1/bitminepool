<?php
include('includes/header.php');

if (isset($_SESSION['Username'])) {

    $_SESSION['error'] = 0;
    $receiveAmountBtc = $sentAmountBtc = 0;
    $receiveAmountAddress = $walletErrorMessage = '';
    $url = "https://blockchain.info/stats?format=json";
    $stats = json_decode(file_get_contents($url), true);
    $btcValue = $stats['market_price_usd'];
    $walletData = $userData = $walletWithdrawalTransactionDBData = [];
    $userName = $_SESSION['Username'];

    $responseGetSiteOption = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                'user_name' => $_SESSION['Username'],
                'option_name' => 'transaction_percentage',
                'platform' => '3',
                    ], 'getSiteOption');

    $transactionPercentage = 0;
    $transactionPercentageDesc = '';
    $responseGetSiteOption = json_decode($responseGetSiteOption);
    if ($responseGetSiteOption->statusCode == 100) {
        $getSiteOption = $responseGetSiteOption->response->site_option;
        $transactionPercentage = $getSiteOption->option_value;
        $transactionPercentageDesc = $getSiteOption->option_description;
    }

    if (!empty($_POST)) {
        $responseWithdrawalRequest = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                    'option_name' => $_POST['option_name'],
                    'option_value' => $_POST['option_value'],
                    'option_description' => $_POST['option_description'],
                    'platform' => '3',
					'user_name' => $_SESSION['Username'],
                        ], 'updateSiteOption');
        $responseWithdrawalRequest = json_decode($responseWithdrawalRequest);
        $redirect = '';

        if ($responseWithdrawalRequest->statusCode == 100) {
            // $walletData = $response->response->wallet_data;
            $_SESSION['error'] = 0;
            $_SESSION['message'] = $responseWithdrawalRequest->statusDescription;
        } else {
            $_SESSION['error'] = 1;
            $_SESSION['message'] = $responseWithdrawalRequest->statusDescription;
        }
        unset($_POST);

        //$_POST = [];
        $redirect = 'manage_options';
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
<link rel="stylesheet" href="../vendor/build/css/jquery.dataTables.min.css">
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
                <div class="">
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="clearfix"></div>

                            <div class="x_content">

                                <div id="accordion">
                                    <h3>Manage Options</h3>
                                    <div>
                                        <p>
                                        <div id="response"></div>
                                        <form id="manage_options" class="form-horizontal form-label-left" method="post" action="">

                                            <div id="receive_form_block">

                                                <div class="form-group">
                                                    <label for="option_value">Transaction Percentage(In %):</label>
                                                   <!-- <input type="text" class="form-control" name = "receive_amount" id="receive_amount" data-msg-required="Please enter amount to be withdrawl." required="required" number="true" data-msg-required="Please enter valid amount to be withdrawl." > -->
                                                    <input type="number" class="form-control" value="<?php echo $transactionPercentage; ?>" name = "option_value" id="option_value" data-msg-required="Please enter the value for this option." required="required" number="true" data-msg-required="Please enter valid value for this option." >
                                                </div>
                                                <input type="hidden" name="option_name" id="option_name" value="transaction_percentage">
                                                <input type="hidden" name="option_description" id="option_description" value="<?php echo $transactionPercentageDesc;?>">
                                                <button type="submit" id ="manage_options_submit" class="btn btn-default">Submit</button>
                                                <button type="reset" id ="reset_manage_options" class="btn btn-default">Cancel</button>
                                            </div>

                                        </form>
                                        </p>
                                    </div>


                                </div>
                                <div class="clearfix"></div>
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
<link rel="stylesheet" href="../vendor/build/css/jquery-ui.css">
<script src="../vendor/build/js/jquery-ui.js"></script>
<!--<script src="../vendor/build/js/jquery.dataTables.min.js"></script> -->
<script>
    $(function () {
    var is_admin_user = <?php echo $_SESSION['is_admin_user']; ?>;


    });
    processDateFilter(5);

    $(document).ready(function () {
        var validatorReceivePayment = $("#manage_options").validate();
    });


    $('#reset_manage_options').click(function () {
        $('#manage_options')[0].reset();
        var validatorReceivePayment = $("#manage_options").validate();
        validatorReceivePayment.resetForm();
    });

</script>
</body>
</html>
