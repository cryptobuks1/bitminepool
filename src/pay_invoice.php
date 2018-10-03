<?php
include('includes/header.php');
if (isset($_SESSION['Username'])) {
    $userName = $_SESSION['Username'];
    if (empty($_GET['purpose']) || empty($_GET['invoice_id'])) {
        $_SESSION['error'] = 1;
        $_SESSION['message'] = 'Please try after some time.';
        //unset($_POST);
        // unset($_SESSION);
        //header("Location:login");
        $redirect = 'dashboard';
        echo "<script>location='" . BASE_URL . $redirect . "'</script>";
        exit;
    } else {
        $invoiceData = [];
        $responseCheckInvoice = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                    'Username' => $_SESSION['Username'],
                    'Purpose' => $_GET['purpose'],
                    'platform' => '3'
                        ], 'checkForAvailableInvoiceToRecivePayment');

        $responseCheckInvoice = json_decode($responseCheckInvoice);
        if ($responseCheckInvoice->statusCode == 100) {
            $_SESSION['error'] = 0;
            $_SESSION['message'] = $responseCheckInvoice->statusDescription;
            $invoiceData = $responseCheckInvoice->response;
        } else {
            $_SESSION['error'] = 1;
            $_SESSION['message'] = 'Please try after some time.';
            //unset($_POST);
            // unset($_SESSION);
            //header("Location:login");
            $redirect = 'dashboard';
            echo "<script>location='" . BASE_URL . $redirect . "'</script>";
            exit;
        }
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

            <!-- top navigation -->
            <?php include('includes/guestheader.php'); ?>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">


                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title"><?php
                                    $Date = $invoiceData->Date;
                                    $Invoiceid = $invoiceData->Invoiceid;
                                    $Purpose = $invoiceData->Purpose;
                                    $Amount = $invoiceData->Amount;
                                    $Btcamount = $invoiceData->Btcamount;
                                    $Status = $invoiceData->Status;
                                    $Username = $invoiceData->Username;
                                    $payTo = $invoiceData->Btcaddress;
                                    ?>
                                    <h2>Invoice Payment<small>Please pay the invoice for <?php echo $Purpose; ?></small></h2>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <section class="content invoice">
                                        <!-- title row -->
                                        <div class="row">
                                            <div class="col-xs-12 invoice-header">
                                                <h1>
                                                    <i class="fa fa-globe"></i> <span class="style7">Invoice.</span>
                                                    <small class="pull-right"><span class="style6"><?php echo date("l jS \of F Y h:i:s A") . "<br>"; ?></span></small>                                      </h1>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- info row -->
                                        <div class="row invoice-info">
                                            <div class="col-sm-4 invoice-col">
                                                From
                                                <address>
                                                    <strong>Bitmine Pool.</strong>
                                                    <br>Email: billing@bitminepool.com
                                                    <br>Website: www.bitminepool.com
                                                </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                To
                                                <address>

                                                    <strong>
                                                        <?php
                                                        if (isset($_SESSION['Username'])) {
                                                            echo ' ' . $_SESSION['Username'];
                                                        } else {
                                                            header("location:" . BASE_URL . "bitcoin_system/production/login");
                                                        }
                                                        ?></strong>


                                                </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                <b>Invoice Type: INVREG001</b>
                                                <br>
                                                <br>
                                                <b>Order ID:</b> <?php echo $Invoiceid; ?>
                                                <br>
                                                <b>Invoice Expires in:</b> <b><span id="countdown-1">600 seconds</span></b>
                                                <br>

                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- Table row -->
                                        <div class="row">
                                            <div class="col-xs-12 table">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Qty</th>
                                                            <th>Product</th>
                                                            <th>Serial #</th>
                                                            <th style="width: 59%">Description</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td><?php echo $Purpose; ?></td>
                                                            <td><?php echo $Invoiceid; ?></td>
                                                            <td>Bitmine Pool <?php echo $Purpose; ?></td>
                                                            <td>$<?php echo $Amount; ?></td>
                                                        </tr>



                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <div class="row">
                                            <!-- accepted payments column -->
                                            <div class="col-xs-6">
                                                <p class="lead"><span class="style6">Payment Methods</span>: <span class="style5">Bitcoin</span></p>
                                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                                    <span class="style13">Send Bitcoin to this Address:</span> <br>
                                                    <b><span class="style12"><div id="qrcodeCanvas"></div><?php echo $payTo; ?></span></b> 

                                                </p>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-xs-6">

                                                <p class="lead"><span class="style11">Total Due</span><span class="style10">: <?php echo $Btcamount; ?> BTC= <em>$<?php echo $Amount; ?></em></span></p>
                                                <a href="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo "bitcoin:$payTo?amount=$Btcamount"; ?>"><button type="button" class="btn btn-primary">Scan QR Code</button></a>


                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width:50%">Subtotal:</th>
                                                                <td>$<?php echo $Amount; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th><span class="style7">BTC to USD (Rate: 10 min Ago)</span></th>
                                                                <td><span class="style6"><?php echo $btcValue; ?></span></td>
                                                            </tr>

                                                            <tr>
                                                                <th>Total:</th>
                                                                <td>$<?php echo $Amount; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- this row will not appear when printing -->
                                        <div class="row no-print">
                                            <div class="col-xs-12">
                                                <button class="btn btn-default" onClick="window.print();"><i class="fa fa-print"></i> Print</button>
                                            </div>
                                        </div>
                                    </section>
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
    <script type="text/javascript">
        // Initialize clock countdowns by using the total seconds in the elements tag
        secs = parseInt(document.getElementById('countdown-1').innerHTML, 10);
        setTimeout("countdown('countdown-1'," + secs + ")", 1000);


        /**
         * Countdown function
         * Clock count downs to 0:00 then hides the element holding the clock
         * @param id Element ID of clock placeholder
         * @param timer Total seconds to display clock
         */
        function countdown(id, timer) {
            timer--;
            minRemain = Math.floor(timer / 60);
            secsRemain = new String(timer - (minRemain * 60));
            // Pad the string with leading 0 if less than 2 chars long
            if (secsRemain.length < 2) {
                secsRemain = '0' + secsRemain;
            }

            // String format the remaining time
            clock = minRemain + ":" + secsRemain;
            document.getElementById(id).innerHTML = clock;
            if (timer > 0) {
                // Time still remains, call this function again in 1 sec
                setTimeout("countdown('" + id + "'," + timer + ")", 1000);
            } else {
                window.location = "<?php echo BASE_URL; ?>login";
            }
        }
    </script>
</body>
</html>
