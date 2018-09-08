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
                            <h2><?php echo ' ' . strlen($userName) > 15 ? substr($userName, 0, 15) . "..." : $userName; ?></h2>
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

                                                    <div class="x_content ">

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

        // console.log('I am inside ready');
        //handleTable();
        var type = '<?php echo $type; ?>';
        if (type == 'wallet') {
            var walletTransactionDBData = <?php echo json_encode($walletTransactionDBData); ?>;
            $('#wallet-transactions-grid').DataTable({
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
        } else if (type == 'invoice') {
            var invoiceTransactionDBData = <?php echo json_encode($invoiceTransactionDBData); ?>;
            $('#invoice-transactions-grid').DataTable({
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
                    {"title": "Username", "data": "Username"}
                ]

            });
        }
    });
    $(function () {
        $("#accordion_transaction").accordion({
           // collapsible: false,
          //  active: 'none',
            autoHeight: false,
          //  navigation: true
        });
    });

</script>
</body>
</html>
