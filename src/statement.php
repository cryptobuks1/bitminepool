<?php
include('includes/header.php');

if (isset($_SESSION['Username'])) {

    $_SESSION['error'] = 0;

    $walletData = $userData = $accountTransactionDBData = [];
    $userName = $_SESSION['Username'];

    $responseAccountTransaction = ApiHelper::getApiResponse('POST', [
                'access_token' => ACCESS_TOKEN,
                'user_name' => $_SESSION['Username'],
                'platform' => '3',
                    ], 'getAllAccountDBTransactionDetails');

    $responseAccountTransaction = json_decode($responseAccountTransaction);

    if ($responseAccountTransaction->statusCode == 100) {
        $accountTransactionDBData = $responseAccountTransaction->response->data;
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
                                <!--<h4><strong>Instructions</strong></h4>
                                <p class="style7"><span class="style6">Minimum Withdrawal amount from Bitmine pool is </span> <span class="style5">30 USD </span> <span class="style6">and above.</span></p>
                                -->
                                <!-- <div id="accordion_transaction"> -->
                                <h3>View statement</h3>
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
                                                    <table id="statement-grid"  cellpadding="0" cellspacing="0" border="0" class="display table" width="100%">
                                                       
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

<script>
    $(function () {
        $("#accordion").accordion();
        $("#accordion_transaction").accordion();


        var accountTransactionDBData = <?php echo json_encode($accountTransactionDBData); ?>;
        var is_admin_user = <?php echo $_SESSION['is_admin_user']; ?>;

        oTable = $('#statement-grid').DataTable({
            data: accountTransactionDBData,
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf'
            ],

            "columns": [

                {"title": "ID", "data": "temp_id"},
                {"title": "User Name", "data": "user_name"},
                {"title": "Narration", "data": "transaction_narration"},
                {"title": "Value Date", "data": "transaction_date"},
                {"title": "Ref No.", "data": "transaction_ref_no"},
                {"title": "Withdrawal", "data": "withdrawal"},
                {"title": "Deposit", "data": "deposit"},
                {"title": "Action", "data": null,'defaultContent':''},
            ],
            "drawCallback": function (settings) {
                var api = this.api();
                var rows = api.rows({page: 'current'}).nodes();
                var last = null;
                var page = api.page();
                var recNum = null;
                var displayLength = settings._iDisplayLength;
                api.column(6, {page: 'current'}).data().each(function (group, i) {
                    /* if (is_admin_user == 1) {
                     
                     }*/
                });

            },

        });

    });

    processDateFilter(3);




</script>
</body>
</html>
