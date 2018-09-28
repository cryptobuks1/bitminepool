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

    $responseSupportTicket = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
            'user_name' => $_SESSION['Username'],
            'platform' => '3',
            ], 'getAllSupportTicketByUserName');

    $responseSupportTicket = json_decode($responseSupportTicket);
    if ($responseSupportTicket->statusCode == 100) {
        $supportTicketDBData = $responseSupportTicket->response->support_data;
    }

    if (!empty($_POST)) {
        $responseSupportRequest = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                'user_name' => $_SESSION['Username'],
                'ticket_id' => $_POST['ticket_id'],
                'issue' => $_POST['issue'],
                'category' => $_POST['category'],
                'platform' => '3',
                'transaction_type' => '501',
                ], 'addSupportRequest');
        $responseSupportRequest = json_decode($responseSupportRequest);
        $redirect = '';

        if ($responseSupportRequest->statusCode == 100) {
            // $walletData = $response->response->wallet_data;
            $_SESSION['error'] = 0;
            $_SESSION['message'] = $responseSupportRequest->statusDescription;
        } else {
            $_SESSION['error'] = 1;
            $_SESSION['message'] = $responseSupportRequest->statusDescription;
        }
        unset($_POST);
        $redirect = 'support';
        echo "<script>location='" . BASE_URL . $redirect . "'</script>";
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
                    // if (!(empty($walletWithdrawlTransactionDBData))) {
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="clearfix"></div>
                            <div id="response"></div>
                            <div class="x_content">
                                <!-- <div id="accordion_transaction"> -->
                                <h3>View all Tickets</h3>
                                <div>
                                    <p>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                                            <div class="x_panel">

                                                <div class="x_content table">
                                                    <table id="support-ticket-grid"  cellpadding="0" cellspacing="0" border="0" class="display table" width="100%">

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
                                    <h3>Add Support Ticket</h3>
                                    <div>
                                        <p>
                                        <form id="add_support_ticket" class="form-horizontal form-label-left" method="post" action="">

                                            <div id="receive_form_block">
                                                <div class="form-group">
                                                    <label for="category">Category:</label>
                                                    <select  class="form-control" name="category" id="category" data-msg-required="Please select address." required="required"  onchange="">

                                                        <option value="1">Registration</option>
                                                        <option value="2">Account Activation</option>
                                                        <option value="3">Payment</option>
                                                        <option value="4">Others</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="reason">Description:</label>
                                                    <textarea class="resizable_textarea form-control" name = "issue" id="issue" data-msg-required="Please enter the description." required="required" ></textarea>
                                                </div>
                                                <input type="hidden" name="ticket_id" value="<?php echo mt_rand(0, 1000000); ?>">
                                                <button type="submit" id ="add_support_ticket_submit" class="btn btn-default">Submit</button>
                                                <button type="reset" id ="reset_add_support_ticket" class="btn btn-default">Cancel</button>
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
        var supportTicketDBData = <?php echo json_encode($supportTicketDBData); ?>;
        var is_admin_user = <?php echo $_SESSION['is_admin_user']; ?>;
        var columns = [

            {"title": "ID", "data": "id"},
            {"title": "Ticket ID", "data": "ticket_id"},
            {"title": "User Name", "data": "user_name"},

            {"title": "Issue", "data": "issue"},
            {"title": "Category", "data": "category_view"},
            {"title": "Status", "data": "status_view"},
            {"title": "Date", "data": "created_at"},
            {"title": "Action", "data": "", "defaultContent": "<i>N/A</i>"},
        ];
        /* if (is_admin_user == 1) {
         columns.push({"title": "Date", "data": "null", ""});
         }*/
        $('#support-ticket-grid').DataTable({
            data: supportTicketDBData,
            "columns": columns,
            "drawCallback": function (settings) {
                var api = this.api();
                var rows = api.rows({page: 'current'}).nodes();
                var last = null;
                var page = api.page();
                var recNum = null;
                var displayLength = settings._iDisplayLength;
                api.column(7, {page: 'current'}).data().each(function (group, i) {
                    if (is_admin_user == 1) {
                        var id = $(rows).eq(i).children('td:nth-child(1)').html();
                        var status = $(rows).eq(i).children('td:nth-child(6)').html();
                        console.log(id, status);
                        var statusBtn = '';
                        if (status == 'Pending') {
                            statusBtn += '<button type="button" data-action="process" title="Approve" class="btn btn-xs default margin-bottom-5 yellow-gold f-color-green process-tickets" data-change-status="2" data-id="' + id + '" ><i class="fa fa-thumbs-up"></i> Process</button><br>';
                            statusBtn += '<button type="button" data-action="reject" title="Reject" class="btn btn-xs default margin-bottom-5 yellow-gold f-color-red process-tickets" style="padding-right: 22px;" data-change-status="3" data-id="' + id + '"> <i class="fa fa-thumbs-down"></i> Remove</button>';
                        } else if (status == 'Processed') {
                            statusBtn += '<button type="button" data-action="pending" title="Pending" class="btn btn-xs default margin-bottom-5 yellow-gold f-color-gold process-tickets" style="padding-right: 22px;" data-change-status="1" data-id="' + id + '"> <i class="fa fa-pencil"></i> Pending</button>';
                            statusBtn += '<button type="button" data-action="reject" title="Reject" class="btn btn-xs default margin-bottom-5 yellow-gold f-color-red process-tickets" style="padding-right: 22px;" data-change-status="3" data-id="' + id + '"> <i class="fa fa-thumbs-down"></i> Remove</button>';
                        } else {
                                                        statusBtn += '<button type="button" data-action="pending" title="Pending" class="btn btn-xs default margin-bottom-5 yellow-gold f-color-gold process-tickets" style="padding-right: 22px;" data-change-status="1" data-id="' + id + '"> <i class="fa fa-pencil"></i> Pending</button>';
                            statusBtn += '<button type="button" data-action="process" title="Approve" class="btn btn-xs default margin-bottom-5 yellow-gold f-color-green process-tickets" data-change-status="2" data-id="' + id + '" ><i class="fa fa-thumbs-up"></i> Process</button><br>';
                        }

                        $(rows).eq(i).children('td:nth-child(8)').html(statusBtn);
                    }
                });

            },

        });
    });
</script>
<script>
    /*  $("#phone").intlTelInput({
     utilsScript: "../vendor/build/js/utilsTellInput.js"
     });*/
    //$("#phone").intlTelInput();
    $(document).ready(function () {
        var validatorAddSupportTicket = $("#add_support_ticket").validate();
        //validator.form();

    });

    $('body').on("click", ".process-tickets", function () {
        var id = $(this).attr('data-id');
        var change_status = $(this).attr('data-change-status');

        var processTickets = 'processAjax';
        var formDataProcessTicket = {

            'user_name': "<?php echo $_SESSION['Username']; ?>",
            'ticket_id': id,
            'status': change_status,
            'platform': '3',
            'transaction_type': '502',
            'url': 'processTicket',
            'action': 'POST'
        };

        $.ajax({
            url: processTickets,
            cache: false,
            type: 'POST',
            data: formDataProcessTicket,
            success: function (data)
            {
                data = JSON.parse(data);
                console.log(data);
                if (data.statusCode == '100') {
                    //$('#receive-payment').submit();
                     setTimeout(function(){ location.reload(); }, 3000);
                     showAlertMessage("#response", data.statusDescription, 1);
                    
                } else {
                    showAlertMessage("#response", data.statusDescription, 0);
                }

            }
        });
        console.log(id, change_status);
    });


    $('#reset_add_support_ticket').click(function () {
        $('#add_support_ticket')[0].reset();
        var validatorReceivePayment = $("#add_support_ticket").validate();
        validatorReceivePayment.resetForm();
    });

</script>
</body>
</html>
