<!DOCTYPE html>
<html lang="en">
    <?php
    include('includes/header.php');
    ?>

    <body class="nav-md">

        <!-- top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <a href="<?php echo BASE_URL; ?>">
                            <img src="../images/logo.png" alt="Bitc-Mine-Pool" style="width: 95px;">
                        </a>
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

                                <form class="form-horizontal form-label-left" novalidate action="searchmail" method="post">



                                    <span class="section">Password Recovery</span>
                                    <h3>Step 1 Email Verification</h3>
                                    <p>In case you have lost your password or forgotten it please enter the E-mail Address you used in the registration process and follow the recovery process.</p>


                                    <div class="item form-group">
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>

                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Enter E-mail Address: <span class="required">*</span>
                                        </label>
                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                            <input id="email" type="email" name="email" data-validate-length-range="5,20"  class="optional form-control col-md-7 col-xs-12">
                                        </div>
                                        <button id="send" type="submit" class="btn btn-success">Verify Email</button>
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
<?php
include('includes/footer.php');
?>
</body>
</html>