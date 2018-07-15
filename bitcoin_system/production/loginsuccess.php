<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bit Mine-Pool | Success</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">
	 <link rel="icon" href="images/favicon.ico" type="image/ico" sizes="32x32">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <style type="text/css">
<!--
.style2 {
	color: #009900;
	font-weight: bold;
}
.style3 {
	color: #006600;
	font-weight: bold;
}
-->
    </style>
</head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
          <img src="images/logo.png" alt="Bitc-Mine-Pool">
            <form action="logincheck" method="post">
              <h1 class="style2">Login Successful!</h1>
              <i class="fa fa-check text-success"></i>
              <h5 class="style3">Welcome: <?php if (isset($_SESSION['Username'])) { echo ' '.$_SESSION['Username']; } else{ header("location:login");}?> to Bit Mine Pool</h5>

              <div class="clearfix"></div>

              <div class="separator">
                

                <div class="clearfix"></div>
                <br />

                <div>
                  <button type="submit" class="btn btn-primary">Access My Account</button>
                </div>
              </div>
            </form>
          </section>
        </div>

       
      </div>
    </div>
  </body>
</html>
