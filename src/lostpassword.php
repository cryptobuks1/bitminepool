<?php
    include('includes/header.php');
    if (!empty($_POST)) {
        $_SESSION['error'] = '';
        $response = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                    'user_name' => $_POST['user_name'],
                    'platform' => '3',
                        //'grant_type' => 'client_credentials'
                        ], 'sendForgetPassword');

        $response = json_decode($response);
        if ($response->statusCode == 100) {
            $_SESSION['error'] = 0;
            $_SESSION['message'] = $response->statusDescription;
            $_SESSION['Username'] = $_POST['Username'];
            $redirect = 'login';
        } else {
            $_SESSION['error'] = 1;
            $_SESSION['message'] = $response->statusDescription;
            $redirect = 'lostpassword';
        }
        unset($_POST);
        //header("Location:" . $redirect);
        echo "<script>location='" . BASE_URL . $redirect . "'</script>";
        exit;
    }
    ?>

    <body class="nav-md">

        <!-- top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <a href="<?php echo BASE_URL; ?>">
                            <img src="../images/logo_transparent_small.png" alt="Bitc-Mine-Pool" >
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
                                <?php include('includes/message.php'); ?>
                                <form id="reset-password" class="form-horizontal form-label-left" method="post" novalidate action="">



                                    <span class="section">Password Recovery</span>
                                    <h3>Step 1 Email Verification</h3>
                                    <p>In case you have lost your password or forgotten it please enter the User name you used in the registration process and follow the recovery process.</p>


                                    <div class="item form-group">
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                </p>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>

                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Enter User Name: <span class="required">*</span>
                                        </label>
                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                            <input id="user_name" data-msg-required="Please enter the user name." required="required" type="text" name="user_name" data-validate-length-range="5,20"  class="optional form-control col-md-7 col-xs-12">
                                        </div>
                                        <button id="send" type="submit" class="btn btn-success">Verify</button><button id="reset-password-reset" type="reset" class="btn btn-success">Cancel</button>
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
    <script>

        $(document).ready(function () {
            var validator = $("#reset-password").validate();
            //validator.form();
        });
        $('#reset-password-reset').click(function () {
            $('#reset-password')[0].reset();
            var validator = $("#reset-password").validate();
            validator.resetForm();
        });

    </script>
</body>
</html>