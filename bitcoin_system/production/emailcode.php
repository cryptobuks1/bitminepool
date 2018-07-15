<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Email Verification</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico" type="image/ico" sizes="32x32">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <style type="text/css">
<!--
.style1 {
	color: #009900;
	font-weight: bold;
	font-size: 16px;
}
-->
    </style>
</head>

  <body class="nav-md">
   
        <!-- top navigation -->
       

              

             

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <img src="images/logo.png" alt="Bitc-Mine-Pool" style="width: 95px;">
              </div>

              <div class="title_right">
                
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" novalidate action="searchcode" method="post">

                      
                     
                      <span class="section">Member Registration: Step 3</span>
                      <h3>Email Verification</h3>
<p>After registration, you need to verify your email before completing the registration process. Please click below to request your verification code. In case you are unable to verify your email, please contact support@bitcoinminehub.com in order to get help</p>
<p>Note: The email may take upto 1 hour and also check the SPAM folder before contacting support.</p>
                     
                    
                      <div class="item form-group">
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                         <p><h5 class="style1">The Verification code has been sent to your email</h5>
                         </p>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Enter Verification Code: <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                          <input id="Token" type="text" name="Token" data-validate-length-range="5,20"  class="optional form-control col-md-7 col-xs-12">
                        </div>
                        <button id="send" type="submit" class="btn btn-success">Verify Email</button>
                      </div>           
                      <div class="ln_solid"></div>
                      <input type="hidden" id="ChangeToken" name="ChangeToken" value="<?php echo mt_rand(0, 1000000); ?>">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

       
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
    <!-- validator -->
    <script src="../vendors/validator/validator.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
  </body>
</html>