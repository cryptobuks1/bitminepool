<?php session_start();?>
<?php if (isset($_SESSION['Username'])) { 
 } else{ header("location:Register");}?>
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

                    <form class="form-horizontal form-label-left" novalidate action="sendemail" method="post">

                      
                     
                      <span class="section">Member Registration: Step 3</span>
                      <h3>Email Verification</h3><h4>(<?php echo $_SESSION['email'];?>)</h4>
<p>After registration, you need to verify your email before completing the registration process. Please click below to request your verification code. In case you are unable to verify your email, please click the support link below to contact the support team <a href="support"><em><strong><br><h5>Click here to contact support Team</h5></strong></em></a> </p>
<p>Note: The email may take upto 1 hour and also check the SPAM folder before contacting support.</p>
                     
                    
                      <div class="item form-group">
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <p><button type="submit" class="btn btn-info btn-lg">Send Verification Code</button></p>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                         
                      </div>           
                      <div class="ln_solid"></div>
                      
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