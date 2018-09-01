<?php
    include('includes/header.php');
    if (isset($_SESSION['Username'])) {
        
        if (!empty($_POST)) {

            $response = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                        'user_name' => $_SESSION['Username'],
                        'token' => $_POST['Token'],
                        'platform' => '3',
                        'transaction_type' => '204'
                            //'grant_type' => 'client_credentials'
                            ], 'verifyEmail');
            $response = json_decode($response);
            
            $redirect = 'login';
          
            if ($response->statusCode == 100) {
                $userData = $response->response;
                
                $responseWallet = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                            'user_name' =>$userData->Username,
                            'password' => $userData->Password,
                            'email_address' => $userData->Email,
                            'platform' => '3',
                            'transaction_type' => '205'
                                //'grant_type' => 'client_credentials'
                                ], 'createWallet');
            }
            $responseWallet = json_decode($responseWallet);

            //header("Location:" . $redirect);
            echo "<script>location='" . BASE_URL . $redirect . "'</script>";
            exit;
        }
    } else {
        unset($_POST);
        unset($_SESSION);
        //header("Location:login");
        $redirect = 'login';
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
                        <img src="../images/logo.png" alt="Bit-Mine-Pool" style="width: 95px;">
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

                                <form class="form-horizontal form-label-left" novalidate action="" method="post">



                                    <span class="section">Member Registration: Step 2</span>
                                    <h3>Email Verification</h3>
                                    <p>After registration, you need to verify your email before completing the registration process. Please click below to request your verification code. In case you are unable to verify your email, please contact support@bitminepool.com in order to get help</p>
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
                                    <!--<input type="hidden" id="ChangeToken" name="ChangeToken" value="<?php //echo mt_rand(0, 1000000);  ?>">-->
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