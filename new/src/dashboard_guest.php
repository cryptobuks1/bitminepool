<!DOCTYPE html>
<html lang="en">
    <?php 
    include('includes/header.php');
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
                                <h2><?php
                                    if (isset($_SESSION['Username'])) {
                                        echo ' ' . $_SESSION['Username'];
                                    } else {
                                        //header("location:login");
                                        $redirect = 'login';
                                        echo "<script>location='".BASE_URL.$redirect."'</script>";
                                    }
                                    ?></h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <?php include('includes/guestmenu.php'); ?>

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
                        <div class="page-title">
                            <div class="title_left">
                                <h3 class="style3">Welcome to Bit Mine Pool</h3>
                            </div>


                        </div>

                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>About Bitcoin Mining</h2>

                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <p>By upgrading your account you can now be able to purchase various products that are available at Bit Mine Pool</p>
                                        <?php
                                        include('includes/dbconnect.php');
                                        $getone = "SELECT Balance FROM accountbalance WHERE Username = '" . $_SESSION['Username'] . "'";
                                        $queryone = mysqli_query($conn, $getone);
                                        $balanceone = mysqli_fetch_array($queryone);
                                        $showone = $balanceone['Balance'];
                                        ?>
                                        <!--<a href="invoicecheckbal"><button type="button" class="btn btn-primary btn-lg">Account Balance:USD <?php //echo $showone; ?></button></a>
                                        <a href="invoicecheckreg"><button type="button" class="btn btn-success btn-lg">Upgrade Account Now</button></a> -->
                                        <a href="upgrade"><button type="button" class="btn btn-primary btn-lg">Account Balance:USD <?php echo $showone; ?></button></a>
                                        <a href="invoicecheckreg"><button type="button" class="btn btn-success btn-lg">Upgrade Account Now</button></a>
                                        <a href="wallet"><button type="button" class="btn btn-success btn-lg">Wallet</button></a>

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
