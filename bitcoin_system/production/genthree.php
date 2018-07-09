<?php session_start();
include('includes/constant.php');
$_SESSION['checkinvoice']="invoicestatus";
if (isset($_SESSION['invoice']))
 { echo ' '; } 
 else{ header("location:".BASE_URL."bitcoin_system/production/index");}?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bit Mine Pool </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico" type="image/ico" sizes="32x32">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <style type="text/css">
<!--
.style3 {color: #006600}
.style4 {color: #CC3300}
.style5 {color: #006600; font-weight: bold; }
.style6 {
	color: #FF0000;
	font-size: 18px;
}
.style7 {font-weight: bold}
-->
    </style>
</head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo BASE_URL;?>" class="site_title"> <span><img src="images/logo.png" alt="Bitcoin-Mine-Hub" style="width: 95px;"></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <a href="<?php echo BASE_URL;?>"><img src="images/img.jpg" alt="..." class="img-circle profile_img"></a>              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php if (isset($_SESSION['Username'])) { echo ' '.$_SESSION['Username']; } else{ header("location:login");}?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <?php include('includes/menu.php');?>

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
		<?php include('includes/header.php');?>
        
	 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3 class="style4">Welcome to Bit Mine Pool</h3>
              </div>

             
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 class="style3">Generate Medium Pack Invoice</h2>
                    					<?php
										$url = "https://blockchain.info/stats?format=json";
										$stats = json_decode(file_get_contents($url), true);
										$btcValue = $stats['market_price_usd'];
										$usdCost = 1225;
										$packcost = 1200;
										$convertedCost = $usdCost / $btcValue;
										$totalamount = round($convertedCost,8);
										?>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <h3 class="style3">Invoice Details</h3>
                      <h4 class="style4"><strong>Instructions</strong></h4>
                      <p class="style5">1. Please confirm the details of the invoice before generating an invoice. </p>
                      <p class="style7"><span class="style3">2. You cannot generate an Unpaid invoice more than </span><span class="style6">Once</span> <span class="style3">so please generate the invoice only when you are ready to pay.</span></p>
                    <form class="form-horizontal form-label-left input_mask" action="payment/invoice.php" method="Post">
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Date:</label>
                       <div class="col-md-3 col-sm-9 col-xs-12">
                         <input type="text" class="form-control" name="Date" id="Date" readonly="readonly" value="<?php echo date("d-m-Y");?>">
                        </div>
                      </div>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Invoice Number:</label>
                  	   <div class="col-md-3 col-sm-9 col-xs-12">
                         <input type="text" class="form-control" name="Invoiceid" id="Invoiceid" readonly="readonly" value="<?php echo mt_rand(0, 10000000); ?> ">
                       </div>
                     </div>
                     <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Invoice Purpose</label>
                       <div class="col-md-3 col-sm-9 col-xs-12">
                         <input type="text" class="form-control" name="Purpose" id="Purpose" readonly="readonly" value="Medium">
                       </div>
                      </div>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount in USD</label>
                  	   <div class="col-md-3 col-sm-9 col-xs-12">
                         <input type="text" class="form-control" name="Amount" id="Amount" readonly="readonly" value="<?php echo $packcost;?>">
                       </div>
                     </div>
                     <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount in BTC</label>
                       <div class="col-md-3 col-sm-9 col-xs-12">
                         <input type="text" class="form-control" name="Btcamount" id="Btcamount" readonly="readonly" value="<?php echo $totalamount;?>">
                       </div>
                      </div>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Invoice Status</label>
                  	   <div class="col-md-3 col-sm-9 col-xs-12">
                         <input type="text" class="form-control" name="Status" id="Status" readonly="readonly" value="Unpaid">
                       </div>
                     </div>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Username</label>
                  	   <div class="col-md-3 col-sm-9 col-xs-12">
                         <input type="text" class="form-control" name="Username" id="Username"	readonly="readonly" value="<?php echo $_SESSION['Username']; ?>">
                       </div>
                     </div>
                     <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" name="submitbutton"><i class="fa fa-share-square-o"></i> Generate Invoice</button>
                          <a href="#"><button type="button" class="btn btn-success"><i class="fa fa-credit-card"></i> Pay From Wallet</button></a>
                          <a href="index"><button type="button" class="btn btn-primary"><i class="fa fa-close"></i> Cancel invoice</button></a>
                        </div>
                      </div>
                    </form>
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

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
  </body>
</html>
