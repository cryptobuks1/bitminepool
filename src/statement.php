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
                {"title": "Action", "data": null, 'defaultContent': ''},
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

        var filterStr = '<td></td><td></td><td></td><td></td>';
        filterStr += '<td><select class="filter-select"  id="reason"><option value="">Select</option><option value="1">Direct Commission</option><option value="2">Indirect Commission</option><option value="3">Matching Bonus</option><option value="4">Residual Bonus</option><option value="5">Mining Earning</option></select></td>';

        filterStr += '<td><select class="filter-select" id="withdrawal"><option value="">Select</option><option value="1">Yes</option><option value="0">No</option></select></td>';
        filterStr += '<td><select class="filter-select" id="deposit"><option value="">Select</option><option value="1">Yes</option><option value="0">No</option></select></td>';
        filterStr += '<td> <button class="btn btn-sm yellow filter-submit margin-bottom-5" title="Search"><i class="fa fa-search"></i></button><button class="btn btn-sm red filter-cancel margin-bottom-5" title="Reset"><i class="fa fa-times"></i></button></td>';

        $('#statement-grid thead tr').clone(true).appendTo('#statement-grid thead').addClass('filter').html('').html(filterStr);



        $('.filter-submit').click(function () {
            console.log('I am inside filter submit ');
            var reasonVal = $('#reason').val();
            if (reasonVal) {
                console.log('I am inside reasonVal ', reasonVal);
                var filteredData = oTable
                        .column(4)
                        .data()
                        .filter(function (value, index) {
                            console.log(value,index);
                            return value = reasonVal ? true : false;
                        });
            }
            var withdrawalVal = $('#withdrawal').val();
            if (withdrawalVal) {
                console.log('I am inside withdrawalVal ', withdrawalVal);
                var filteredData2 = oTable
                        .column(5)
                        .data()
                        .filter(function (value, index) {
                            console.log(value,index);
                            return value > 0 ? true : false;
                        });
            }
            var depositVal = $('#deposit').val();
            if (depositVal) {
                console.log('I am inside depositVal ', depositVal);
                var filteredData3 = oTable
                        .column(6)
                        .data()
                        .filter(function (value, index) {
                            console.log(value,index);
                            return value > 0 ? true : false;
                        });
            }
        });

        $('.filter-cancel').click(function () {
            $('.filter-select').val('');
        });
    });






    processDateFilter(3);




</script>
</body>
</html>
