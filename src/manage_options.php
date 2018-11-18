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
    $response = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                'user_name' => $_SESSION['Username'],
                'platform' => '3',
                    ], 'getAllWalletDetailByUserName');

    $response = json_decode($response);

    $redirect = 'login';
    if ($response->statusCode == 100) {
        $walletData = $response->response->wallet_data;
        $userData = $response->response->user_data;
    } else {
        $_SESSION['error'] = 1;
        $_SESSION['message'] = $response->statusDescription;
        $walletErrorMessage = $response->statusDescription;
    }
    $responseWithdrawalTransaction = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                'user_name' => $_SESSION['Username'],
                'platform' => '3',
                    ], 'getAllWithdrawalDBTransactionByUserName');

    $responseWithdrawalTransaction = json_decode($responseWithdrawalTransaction);
    if ($responseWithdrawalTransaction->statusCode == 100) {
        $walletWithdrawalTransactionDBData = $responseWithdrawalTransaction->response->withdrawl_data;
    }
    $getone = "SELECT Balance FROM accountbalance WHERE Username = '" . $_SESSION['Username'] . "'";
    $queryone = mysqli_query($conn, $getone);
    $balanceone = mysqli_fetch_array($queryone);
    $availableBalance = $balanceone['Balance'];
    
    $responseGetSiteOption = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
    'user_name' => $_SESSION['Username'],
    'option_name' => 'transaction_percentage',
    'platform' => '3',
        ], 'getSiteOption');
    
    $transactionPercentage = 0;        
    $responseGetSiteOption = json_decode($responseGetSiteOption);
    if ($responseGetSiteOption->statusCode == 100) {
    $getSiteOption = $responseGetSiteOption->response->site_option;
    $transactionPercentage =  $getSiteOption->option_value;
    }    

    if (!empty($_POST)) {

        $transaction_type = '';
        $transaction_type = $_POST['transaction_type'];
        switch ($transaction_type) {
            case 'receive':

                $responseWithdrawalRequest = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                            'user_name' => $_SESSION['Username'],
                            'to_address' => $_POST['to_address'],
                            'amount' => $_POST['receive_amount'],
                            'platform' => '3',
                            'transaction_type' => '401',
                                ], 'withdrawalPayment');
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
                break;
            case 'sent':
            /*  $url = "https://blockchain.info/stats?format=json";
              $stats = json_decode(file_get_contents($url), true);
              $btcValue = $stats['market_price_usd'];
              $usdCost = $_POST['sent_amount'];
              $convertedCost = $usdCost / $btcValue;
              $sentAmountBtc = round($convertedCost, 8);
              $responseSentPayment = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
              'user_name' => $_SESSION['Username'],
              'wallet_guid' => $userData->guid,
              'wallet_pass' => $userData->password,
              'from_address' => $userData->address,
              'to_address' => $_POST['sent_address'],
              'amount' => $sentAmountBtc,
              'platform' => '3',
              ], 'sendPayment');

              $responseSentPayment = json_decode($responseSentPayment);
              $redirect = '';

              if ($responseSentPayment->statusCode == 100) {
              // $walletData = $response->response->wallet_data;
              $_SESSION['error'] = 0;
              $_SESSION['message'] = $responseSentPayment->statusDescription;
              } else {
              $_SESSION['error'] = 1;
              $_SESSION['message'] = $responseSentPayment->statusDescription;
              }
              unset($_POST);
              break; */
            default:
                $_SESSION['error'] = 1;
                $_SESSION['message'] = 'Please try after some time.';
                unset($_POST);
                //header("Location:login");
                $redirect = 'wallet';
                echo "<script>location='" . BASE_URL . $redirect . "'</script>";
                exit;
                break;
        }

        unset($_POST);
        //$_POST = [];
        $redirect = 'withdrawal';
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
                                        <form id="receive-payment" class="form-horizontal form-label-left" method="post" action="">

                                            <div id="receive_form_block">

                                                <div class="form-group">
                                                    <label for="amount">Transaction Percentage(In %):</label>
                                                   <!-- <input type="text" class="form-control" name = "receive_amount" id="receive_amount" data-msg-required="Please enter amount to be withdrawl." required="required" number="true" data-msg-required="Please enter valid amount to be withdrawl." > -->
                                                    <input type="number" class="form-control" min="0" max="100" value="<?php echo $transactionPercentage; ?>" name = "receive_amount_main" id="receive_amount_main" data-msg-required="Please enter amount to be withdrawl." required="required" number="true" data-msg-required="Please enter valid amount to be withdrawl." >
                                                </div>

                                                <button type="button" id ="manage_options_submit" class="btn btn-default">Submit</button>
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


       //$("#accordion").accordion();
        $("#accordion_transaction").accordion();
        $('#receive_qr_block').hide();

        var walletTransactionDBData = <?php echo json_encode($walletWithdrawalTransactionDBData); ?>;
        var is_admin_user = <?php echo $_SESSION['is_admin_user']; ?>;


    });
    processDateFilter(5);

    $(document).ready(function () {
        var validatorReceivePayment = $("#receive-payment").validate();
    });


    $('#reset_receive_payment').click(function () {
        $('#receive-payment')[0].reset();
        var validatorReceivePayment = $("#receive-payment").validate();
        validatorReceivePayment.resetForm();
    });

    $('#reset_receive_payment').click(function () {
        $('#receive-payment')[0].reset();
        var validatorReceivePayment = $("#receive-payment").validate();
        validatorReceivePayment.resetForm();
    });

    $('#receive_payment_submit').click(function (e) {
        if ($('#receive-payment').valid()) {
            var sendVerificationEmail = 'processAjax';
            var formDataSendVerifyEmail = {
                'user_name': "<?php echo $_SESSION['Username']; ?>",
                'platform': '3',
                'url': 'sendEmailVerificationCode',
                'action': 'POST'
            };
            $.ajax({
                url: sendVerificationEmail,
                cache: false,
                type: 'POST',
                data: formDataSendVerifyEmail,
                success: function (data)
                {
                    data = JSON.parse(data);
                    if (data.statusCode == '100') {
                        bootbox.prompt({
                            size: "small",
                            title: "Enter the verification code!",
                            inputType: 'text',
                            callback: function (result) {
                                if (result != null) {

                                    var verifyEmailUrl = 'processAjax';
                                    var formDataVerifyEmail = {

                                        'user_name': "<?php echo $_SESSION['Username']; ?>",
                                        'token': result,
                                        'platform': '3',
                                        'transaction_type': '204',
                                        'url': 'verifyEmail',
                                        'action': 'POST'
                                    };

                                    $.ajax({
                                        url: verifyEmailUrl,
                                        cache: false,
                                        type: 'POST',
                                        data: formDataVerifyEmail,
                                        success: function (data)
                                        {
                                            data = JSON.parse(data);
                                            if (data.statusCode == '100') {
                                                $('#receive-payment').submit();
                                            } else {
                                                showAlertMessage("#response", data.statusDescription, 0);
                                            }
                                        }
                                    });
                                }
                            }
                        });
                    } else {
                        showAlertMessage("#response", data.statusDescription, 0);
                    }


                }
            });

            e.preventDefault();
        }
    });


</script>
</body>
</html>
