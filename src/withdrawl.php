<?php
include('includes/header.php');

if (isset($_SESSION['Username'])) {

    $_SESSION['error'] = 0;
    $receiveAmountBtc = $sentAmountBtc = 0;
    $receiveAmountAddress = $walletErrorMessage = '';
    $url = "https://blockchain.info/stats?format=json";
    $stats = json_decode(file_get_contents($url), true);
    $btcValue = $stats['market_price_usd'];
    $walletData = $userData = $walletWithdrawlTransactionDBData = [];
    $userName = $_SESSION['Username'];

    $responseWithdrawlTransaction = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                'user_name' => $_SESSION['Username'],
                'platform' => '3',
                    ], 'getAllWithdrawlDBTransactionByUserName');

    $responseWithdrawlTransaction = json_decode($responseWithdrawlTransaction);

    if ($responseWithdrawlTransaction->statusCode == 100) {
        $walletWithdrawlTransactionDBData = $responseWithdrawlTransaction->response->withdrawl_data;
    }
    if (!empty($_POST)) {
        $transaction_type = '';
        $transaction_type = $_POST['transaction_type'];
        switch ($transaction_type) {
            case 'receive':
                //$receiveAmountBtc = $_POST['receive_amount'];
                /* $receiveAmountAddress = $_POST['receive_address'];
                  $url = "https://blockchain.info/stats?format=json";
                  $stats = json_decode(file_get_contents($url), true);
                  $btcValue = $stats['market_price_usd'];
                  $usdCost = $_POST['receive_amount'];
                  $convertedCost = $usdCost / $btcValue;
                  $receiveAmountBtc = round($convertedCost, 8); */
                break;
            case 'sent':
                $url = "https://blockchain.info/stats?format=json";
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
                break;
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
        // $redirect = 'wallet';
        //  echo "<script>location='" . BASE_URL . $redirect . "'</script>";
        //  exit;
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
                        <a href="<?php echo BASE_URL; ?>" class="site_title"> <span><img src="../images/logo.png" alt="BitMine Pool" style="width: 95px;"></span></a>
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
                    <div class="clearfix"></div>

                    
                    <?php
                    if (!(empty($walletWithdrawlTransactionDBData))) {
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="clearfix"></div>
                                <div class="x_content">
                                    <div id="accordion_transaction">
                                        <h3>View all transactions</h3>
                                        <div>
                                            <p>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                    <div class="x_panel">

                                                        <div class="x_content table">
                                                            <table id="wallet-withdrawl-transactions-grid"  cellpadding="0" cellspacing="0" border="0" class="display table" width="100%">

                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="clearfix"></div>
                                <div class="x_content">

                                    <div id="accordion">
                                        <h3>Withdrawl BTC</h3>
                                        <div>
                                            <p>
                                            <form id="send-payment" class="form-horizontal form-label-left" method="post" action="">
                                                <div class="form-group">
                                                    <label for="sent_address">To address:</label>
                                                    <input type="text" name="sent_address" class="form-control" id="sent_address" data-msg-required="Please enter receivers address." required="required">
                                                </div>
                                                <div class="form-group">
                                                    <label for="sent_amount">Amount(In USD):</label>
                                                    <input type="text" class="form-control" name="sent_amount" id="sent_amount" data-msg-required="Please enter amount to be sent." required="required" number="true" data-msg-required="Please enter valid amount to be sent." >
                                                </div>
                                                <input type="hidden" name="transaction_type" value="sent">

                                                <button type="submit" id="send_payment_submit" class="btn btn-default">Pay</button>
                                                <button type="reset" id ="reset_send_payment" class="btn btn-default">Cancel</button>
                                            </form>
                                            </p>
                                        </div>
                                        <h3>Receive BTC</h3>
                                        <div>
                                            <p>
                                            <form id="receive-payment" class="form-horizontal form-label-left" method="post" action="">
                                                <?php //if (!empty($receiveAmountAddress) && $receiveAmountBtc != 0) {    ?>
                                                <div id='receive_qr_block'>
                                                    <div class="form-group">
                                                        <a id="qr_anchor" href=""><button type="button" class="btn btn-primary">Scan QR Code</button></a>
                                                        <button type="reset" id ="reset_receive_payment_qr" class="btn btn-default">Cancel</button>
                                                    </div>

                                                </div>
                                                <?php // } else {    ?>
                                                <div id="receive_form_block">
                                                    <div class="form-group">
                                                        <label for="receive_address">To address:</label>
                                                        <select  class="form-control" name="receive_address" id="receive_address" data-msg-required="Please select address."  onchange="">
                                                            <?php foreach ($walletData->addresses as $key => $address) { ?>
                                                                <option value="<?php echo $address->address; ?>"><?php echo $address->address; ?></option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount">Amount(In USD):</label>
                                                        <input type="text" class="form-control" name = "receive_amount" id="receive_amount" data-msg-required="Please enter amount to be received." required="required" number="true" data-msg-required="Please enter valid amount to be received." >
                                                    </div>

                                                    <input type="hidden" name="transaction_type" value="receive">
                                                    <button type="submit" id ="receive_payment_submit" class="btn btn-default">Submit</button>
                                                    <button type="reset" id ="reset_receive_payment" class="btn btn-default">Cancel</button>
                                                </div>
                                                <?php //}    ?>

                                            </form>
                                            </p>
                                        </div>


                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> 

<script>
    $(function () {
        $("#accordion").accordion();
        $("#accordion_transaction").accordion();
        $('#receive_qr_block').hide();
        // console.log('I am inside ready');
        //handleTable();
        var walletTransactionDBData = <?php echo json_encode($walletWithdrawlTransactionDBData); ?>;
        console.log(walletTransactionDBData);
        $('#wallet-withdrawl-transactions-grid').DataTable({
            data: walletTransactionDBData,
            "columns": [

                {"title": "ID", "data": "id"},
                //{"title": "invoice_id", "data": "invoice_id"},
                {"title": "User Name", "data": "user_name"},
                {"title": "Amount", "data": "amount"},
                {"title": "To address", "data": "to_address"},
                {"title": "Status", "data": "status_view"},
                {"title": "Date", "data": "created_at"}
            ]

        });
    });
</script>
<script>
    /*  $("#phone").intlTelInput({
     utilsScript: "../vendor/build/js/utilsTellInput.js"
     });*/
    //$("#phone").intlTelInput();
    $(document).ready(function () {
        var validatorReceivePayment = $("#receive-payment").validate();
        var validatorSentPayment = $("#send-payment").validate();
        //validator.form();
    });

    $('#reset_receive_payment').click(function () {
        $('#receive-payment')[0].reset();
        var validatorReceivePayment = $("#receive-payment").validate();
        validatorReceivePayment.resetForm();
    });
    $('#reset_send_payment').click(function () {
        $('#send-payment')[0].reset();
        var validatorSentPayment = $("#send-payment").validate();
        validatorSentPayment.resetForm();
    });
    $('#reset_receive_payment_qr').click(function () {
        $('#send-payment')[0].reset();
        var validatorSentPayment = $("#send-payment").validate();
        validatorSentPayment.resetForm();
        $("#qr_anchor").attr("href", "");
        $('#receive_qr_block').hide();
        $('#receive_form_block').show();
    });

    $("#receive-payment").submit(function (e) {
        console.log('I am  on line 394');
        var validatorReceivePayment = $("#receive-payment").validate();
        console.log(validatorReceivePayment);
        if (!$("#receive-payment").valid()) {
            return false;
        }
        var btcValue = <?php echo $btcValue; ?>;

        var address = $('#receive-payment #receive_address').val();
        var usdAmount = $('#receive-payment #receive_amount').val();
        var convertedCost = usdAmount / btcValue;
        var reciveAmountBtc = parseFloat(convertedCost).toFixed(8);
        console.log(reciveAmountBtc);
        var qrPath = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=bitcoin:" + address + "?amount=" + reciveAmountBtc;
        $("#qr_anchor").attr("href", qrPath);
        $('#receive_qr_block').show();
        $('#receive_form_block').hide();

        e.preventDefault();
    });

</script>
</body>
</html>
