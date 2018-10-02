<?php
include('includes/header.php');
if (isset($_SESSION['Username'])) {
    $Username = $_SESSION['Username'];
    $searchaccount = mysqli_query($conn, "select Account from users where Username='$Username'");
    $myaccount = mysqli_fetch_array($searchaccount);
    $Account = $myaccount['Account'];
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
include('includes/message.php');
?>
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
                            <h2><?php echo ' ' . strlen($_SESSION['Username']) > 15 ? ucfirst(substr($_SESSION['Username'], 0, 15)) . "..." : ucfirst($_SESSION['Username']); ?></h2>
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



                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">

                                <div class="x_content">

                                    <form class="form-horizontal form-label-left" novalidate action="reflink" method="post">



                                        <span class="section">My Referral Link</span>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Referral Link: 
                                            </label>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <input id="myInput" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" value="<?php echo BASE_URL; ?>register?account=<?php echo $Account; ?>" name="name" readonly="" required="required" type="text">
                                            </div>
                                            <script>
                                                function myFunction() {
                                                    var copyText = document.getElementById("myInput");
                                                    copyText.select();
                                                    document.execCommand("copy");
                                                    alert("Referral Link Copied to Clipboard");
                                                }
                                            </script>	

                                            <button onclick="myFunction()" class="btn btn-success">Copy</button>
                                        </div>
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

<?php
include('includes/footer.php');
?>
</body>
</html>
