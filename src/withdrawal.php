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


                    <?php
                    // if (!(empty($walletWithdrawlTransactionDBData))) {
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="clearfix"></div>
                            <div id="response"></div>
                            <div class="x_content">
                                <h4><strong>Instructions</strong></h4>
                                <p class="style7"><span class="style6">Minimum Withdrawal amount from Bitmine pool is </span> <span class="style5">30 USD </span> <span class="style6">and above.</span></p>

                                <!-- <div id="accordion_transaction"> -->
                                <h3>View all withdrawal transactions</h3>
                                <div>
                                    <p>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                                            <div class="x_panel">

                                                <div class="x_content table">
                                                    <div id="date_filter">
                                                        <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
                                                        <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="datepicker_to" />
                                                    </div>
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
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>   
                    <?php
                    //}
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="clearfix"></div>

                            <div class="x_content">

                                <div id="accordion">
                                    <h3>Withdrawl BTC</h3>
                                    <div>
                                        <p>
                                        <div id="response"></div>
                                        <form id="receive-payment" class="form-horizontal form-label-left" method="post" action="">

                                            <div id="receive_form_block">
                                                <div class="form-group">
                                                    <label for="to_address">To address:</label>
                                                    <select  class="form-control" name="to_address" required="required"  id="to_address" data-msg-required="Please select address."  onchange="">
                                                        <?php foreach ($walletData->addresses as $key => $address) { ?>
                                                            <option value="<?php echo $address->address; ?>"><?php echo $address->address; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="amount">Amount(In USD):</label>
                                                   <!-- <input type="text" class="form-control" name = "receive_amount" id="receive_amount" data-msg-required="Please enter amount to be withdrawl." required="required" number="true" data-msg-required="Please enter valid amount to be withdrawl." > -->
                                                    <input type="number" class="form-control" min="30" max="<?php echo $availableBalance; ?>" value="<?php echo $availableBalance; ?>" name = "receive_amount_main" id="receive_amount_main" data-msg-required="Please enter amount to be withdrawl." required="required" number="true" data-msg-required="Please enter valid amount to be withdrawl." >
                                                </div>
                                                <input type="hidden" name="hidden_transaction_percentage" id="hidden_transaction_percentage" value="<?php echo $transactionPercentage;?>">
                                                <input type="hidden" name="receive_amount" id="receive_amount" value="0">
                                                <div id="transaction_table"></div>
                                                <input type="hidden" name="transaction_type" value="receive">
                                                <button type="button" id ="receive_payment_submit" class="btn btn-default">Submit</button>
                                                <button type="reset" id ="reset_receive_payment" class="btn btn-default">Cancel</button>
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
        $("#receive_amount_main").on('click change', function (e) {
            if ($(this).val() == '') {
                $(this).val(0);
            }
            $('#transaction_table').html('');
            var btcValue = '<?php echo $btcValue; ?>';
            var transactionStr = '';
            var amountUsd = parseFloat($('#receive_amount_main').val());
            var amountBtc = parseFloat(amountUsd/btcValue);
            var processionFee = parseFloat($('#hidden_transaction_percentage').val());
            var processionFeeCalculated = parseFloat(amountUsd*(processionFee/100));
            
            var total = amountUsd + processionFeeCalculated;
            transactionStr += '<table style="width: 15%;" cellspacing="10" cellpadding="10">';
            transactionStr += '<tbody>';
            transactionStr += '<tr>';
            transactionStr += '<td>Amount (In USD)</td>';
            transactionStr += '<td>'+amountUsd+'</td>';
            transactionStr += '<td>Amount (In BTC)</td>';
            transactionStr += '<td>'+amountBtc+'</td>';
            transactionStr += '</tr>';
            transactionStr += '<tr>';
            transactionStr += '<td>+ Processing fee  (In USD)</td>';
            transactionStr += '<td>'+processionFeeCalculated+'</td>';
            transactionStr += '</tr>';
            transactionStr += '<tr>';
            transactionStr += '<td>Total</td>';
            transactionStr += '<td>'+total+'</td>';
            transactionStr += '</tr>';
            transactionStr += '</tbody>';
            transactionStr += '</table>';
            transactionStr += '<br>';
            
            $('#transaction_table').html(transactionStr);
            //calculateSum(e);
        });

        $("#accordion").accordion();
        $("#accordion_transaction").accordion();
        $('#receive_qr_block').hide();

        var walletTransactionDBData = <?php echo json_encode($walletWithdrawalTransactionDBData); ?>;
        var is_admin_user = <?php echo $_SESSION['is_admin_user']; ?>;

        oTable = $('#wallet-withdrawl-transactions-grid').DataTable({
            data: walletTransactionDBData,
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf'
            ],
            "columns": [

                {"title": "ID", "data": "id"},
                {"title": "User Name", "data": "user_name"},
                {"title": "Amount", "data": "amount"},
                {"title": "To address", "data": "to_address"},
                {"title": "Status", "data": "status_view"},
                {"title": "Date", "data": "created_at"},
                {"title": "Action", "data": "", "defaultContent": "<i>N/A</i>"},
            ],
            "drawCallback": function (settings) {
                var api = this.api();
                var rows = api.rows({page: 'current'}).nodes();
                var last = null;
                var page = api.page();
                var recNum = null;
                var displayLength = settings._iDisplayLength;
                api.column(6, {page: 'current'}).data().each(function (group, i) {
                    if (is_admin_user == 1) {
                        var id = $(rows).eq(i).children('td:nth-child(1)').html();
                        var status = $(rows).eq(i).children('td:nth-child(5)').html();
                        var statusBtn = '';
                        if (status == 'Pending') {
                            statusBtn += '<button type="button" data-action="process" title="Approve" class="btn btn-xs default margin-bottom-5 yellow-gold f-color-green process-withdrawal" data-change-status="2" data-id="' + id + '" ><i class="fa fa-thumbs-up"></i> Process</button><br>';
                            statusBtn += '<button type="button" data-action="reject" title="Reject" class="btn btn-xs default margin-bottom-5 yellow-gold f-color-red process-withdrawal" style="padding-right: 22px;" data-change-status="3" data-id="' + id + '"> <i class="fa fa-thumbs-down"></i> Reject</button>';
                        } else if (status == 'Processed') {
                            statusBtn += '<button type="button" data-action="reject" title="Reject" class="btn btn-xs default margin-bottom-5 yellow-gold f-color-gold" style="padding-right: 22px;" data-change-status="3" data-id="' + id + '"> <i class="fa fa-thumbs-up"></i> Processed</button>';
                        } else {
                            statusBtn += '<button type="button" data-action="reject" title="Reject" class="btn btn-xs default margin-bottom-5 yellow-gold f-color-gold" style="padding-right: 22px;" data-change-status="3" data-id="' + id + '"> <i class="fa fa-thumbs-down"></i> Rejected</button>';
                        }

                        $(rows).eq(i).children('td:nth-child(7)').html(statusBtn);
                    }
                });

            },

        });

    });
    processDateFilter(5);

    $(document).ready(function () {
        var validatorReceivePayment = $("#receive-payment").validate();
    });

    $('body').on("click", ".process-withdrawal", function () {
        var id = $(this).attr('data-id');
        var change_status = $(this).attr('data-change-status');

        var processWithdrawal = 'processAjax';
        var formDataProcessTicket = {

            'user_name': "<?php echo $_SESSION['Username']; ?>",
            'transaction_id': id,
            'status': change_status,
            'platform': '3',
            'transaction_type': '502',
            'url': 'processWithdrawal',
            'action': 'POST'
        };

        bootbox.confirm({
            size: "small",
            message: "Process this withdrawal request!",
            callback: function (result) {
                if (result) {
                    $.ajax({
                        url: processWithdrawal,
                        cache: false,
                        type: 'POST',
                        data: formDataProcessTicket,
                        success: function (data)
                        {
                            data = JSON.parse(data);
                            console.log(data);
                            if (data.statusCode == '100') {
                                //$('#receive-payment').submit();
                                setTimeout(function () {
                                    location.reload();
                                }, 3000);
                                showAlertMessage("#response", data.statusDescription, 1);

                            } else {
                                showAlertMessage("#response", data.statusDescription, 0);
                            }

                        }
                    });

                }
            }
        });

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
