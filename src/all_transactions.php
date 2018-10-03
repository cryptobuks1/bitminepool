<?php
include('includes/header.php');

if (isset($_SESSION['Username']) && $_SESSION['is_admin_user'] == 1) {

    $_SESSION['error'] = 0;
    if (empty($_REQUEST['type'])) {
        $redirect = 'all_transactions?type=wallet';
        echo "<script>location='" . BASE_URL . $redirect . "'</script>";
        exit;
    }

    $type = $_REQUEST['type'];
    $tableId = "wallet-transactions-grid";
    switch ($type) {
        case 'wallet':
            $responseWalletTransaction = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                    'user_name' => $_SESSION['Username'],
                    'platform' => '3',
                    ], 'getAllWalletDBTransactionDetails');

            $responseWalletTransaction = json_decode($responseWalletTransaction);
            if ($responseWalletTransaction->statusCode == 100) {
                $walletTransactionDBData = $responseWalletTransaction->response->wallet_data;
                $tableId = "wallet-transactions-grid";
            }
            break;
        case 'invoice':
            $responseInvoiceTransaction = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                    'user_name' => $_SESSION['Username'],
                    'platform' => '3',
                    ], 'getAllInvoiceDBTransactionDetails');

            $responseInvoiceTransaction = json_decode($responseInvoiceTransaction);
            if ($responseInvoiceTransaction->statusCode == 100) {
                $invoiceTransactionDBData = $responseInvoiceTransaction->response->invoice_data;
                $tableId = "invoice-transactions-grid";
            }
            break;
        case 'benefits':
            $responseBenefitsTransaction = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                    'user_name' => $_SESSION['Username'],
                    'platform' => '3',
                    ], 'getAllCommissionBonusDBDetails');

            $responseBenefitsTransaction = json_decode($responseBenefitsTransaction);
            if ($responseBenefitsTransaction->statusCode == 100) {
                $benefitsTransactionDBData = $responseBenefitsTransaction->response->bonus_data;
                $tableId = "benefits-transactions-grid";
            }
            break;
        default:
            $redirect = 'all_transactions?type=wallet';
            echo "<script>location='" . BASE_URL . $redirect . "'</script>";
            exit;
            break;
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
<style>
    #accordion_transaction
    {
        width:100%;
        height:auto;

    }
</style>
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

                                <h3>View all transactions</h3>
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
                                                    <table id="<?php echo $tableId; ?>"  cellpadding="0" cellspacing="0" border="0" class="display table" width="100%">

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
<script src="../vendor/build/js/jquery.dataTables.min.js"></script>
<script>
    $(function () {
        $("#accordion").accordion();
        $("#accordion_transaction").accordion();
        $('#receive_qr_block').hide();
        // console.log('I am inside ready');
        //handleTable();
        var type = '<?php echo $type; ?>';
        if (type == 'wallet') {
            var walletTransactionDBData = <?php echo json_encode($walletTransactionDBData); ?>;
            oTable = $('#wallet-transactions-grid').DataTable({
                data: walletTransactionDBData,
                "columns": [

                    {"title": "ID", "data": "id"},
                    {"title": "invoice_id", "data": "invoice_id"},
                    {"title": "Type", "data": "sent_receive_flag"},
                    {"title": "Amount", "data": "amount"},
                    {"title": "From address", "data": "from_address"},
                    {"title": "To address", "data": "to_address"},
                    {"title": "Status", "data": "status"},
                    {"title": "Date", "data": "created_at"}
                ]

            });
            processDateFilter(7);
        } else if (type == 'invoice') {
            var invoiceTransactionDBData = <?php echo json_encode($invoiceTransactionDBData); ?>;
            oTable = $('#invoice-transactions-grid').DataTable({
                data: invoiceTransactionDBData,
                "columns": [

                    {"title": "ID", "data": "id"},
                    {"title": "Pay date", "data": "Paydate"},
                    {"title": "Invoive Id", "data": "Invoiceid"},
                    {"title": "Purpose", "data": "Purpose"},
                    {"title": "Address", "data": "Btcaddress"},
                    {"title": "Amount(In USD)", "data": "Amount"},
                    {"title": "Amount(In BTC)", "data": "Btcamount"},
                    {"title": "Status", "data": "Status"},
                    {"title": "Username", "data": "Username"},
                    {"title": "Date", "data": "created_at"}
                ]

            });
            processDateFilter(8);
        } else if (type == 'benefits') {
            var benefitsTransactionDBData = <?php echo json_encode($benefitsTransactionDBData); ?>;
            oTable = $('#benefits-transactions-grid').DataTable({
                data: benefitsTransactionDBData,
                "columns": [
                    {"title": "ID", "data": "id"},
                    {"title": "Username", "data": "user_name"},
                    {"title": "Amount(In USD)", "data": "amount"},
                    {"title": "Benefit Type", "data": "reason_id_view"},
                    {"title": "Description", "data": "reason_description"},
                    {"title": "Date", "data": "created_at"}
                ]

            });
            processDateFilter(5);
        }
    });
    /*$(function () {
        $("#accordion_transaction").accordion({
            // collapsible: false,
            //  active: 'none',
            autoHeight: false,
            //  navigation: true
        });
    });*/

</script>
</body>
</html>
