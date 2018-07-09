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

    <title>Support Team</title>

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
                <img src="images/logo.png" alt="Bitcoin-Mine-Hub" style="width: 95px;">
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
               
                    <form class="form-horizontal form-label-left" novalidate action="addticket" method="post">

                      
                     
                      <p><span class="section">Support Team: Ticket</span></p>
				
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Username <span class="required"></span>
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input id="Username" class="form-control col-md-7 col-xs-12" value="<?php echo $_SESSION['Username']; ?>" data-validate-length-range="6" data-validate-words="2" name="Username" id="Username" readonly="true" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Date <span class="required"></span>
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input id="Date" class="form-control col-md-7 col-xs-12" value="<?php echo date("d-m-Y");?>" data-validate-length-range="6" data-validate-words="2" name="Date" readonly="true" required="required" type="text">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ticket No. <span class="required"></span>
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <input id="Ticketid" class="form-control col-md-7 col-xs-12" value="<?php echo mt_rand(0, 1000000); ?> " data-validate-length-range="6" data-validate-words="2" name="Ticketid" readonly="true" required="required" type="text">
                        </div>
                      </div>
<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status <span class="required"></span>
                        </label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
        <input id="Status" class="form-control col-md-7 col-xs-12" value="Open" data-validate-length-range="6" data-validate-words="2" name="Status" readonly="true" required="required" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Choose Category</label>
                        <div class="col-md-3 col-sm-9 col-xs-12">
                          <select class="form-control" name="Category" id="Category">
                            <option>Registration</option>
                            <option>Account Activation</option>
                            <option>Payment</option>
                            <option>Others</option>
                          </select>
                        </div>
                      </div>
                  <div class="ln_solid"></div>

                 
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Help Issue</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea class="resizable_textarea form-control" placeholder="Type your issue here and click send..." name="Issue" id="Issue"></textarea>             
                </div>
              </div>
                     		 
                            
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Cancel</button>
                          <button id="send" type="submit" class="btn btn-success">Send</button>
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