<!DOCTYPE html>
<html lang="en">
    <?php
    include('includes/header.php');
    if (!empty($_POST)) {
        //echo '<pre>'; print_r($_POST); exit;
        $_SESSION['error'] = '';
        try {
            $response = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                        'user_name' => $_POST['Username'],
                        'password' => $_POST['Password'],
                        'platform' => '3',
                        'transaction_type' => '201',
                        'grant_type' => 'client_credentials'
                            ], 'loginCustomer');

            $response = json_decode($response);
            $redirect = 'login';
            if ($response->statusCode == 100) {
                switch ($response->response->Status) {
                    case 'Close':
                        $_SESSION['is_prime_user'] = 1;
                        $_SESSION['Username'] = $_POST['Username'];
                        $redirect = 'dashboard';
                        break;
                    case 'Open':
                        $_SESSION['is_prime_user'] = 0;
                        $_SESSION['Username'] = $_POST['Username'];

                        $redirect = 'dashboard';
                        break;
                    case 'default':
                        $redirect = 'login';
                        break;
                }
                $_SESSION['wallet_guid'] = $response->response->guid;
                $_SESSION['wallet_password'] = $response->response->password;
                $_SESSION['activation'] = $response->response->Activation;
                $_SESSION['message'] = $response->statusDescription;
            } else {
                $_SESSION['activation'] = 0;
                $_SESSION['error'] = 1;
                $_SESSION['message'] = $response->statusDescription;
            }

            unset($_POST);
            // header("location:dashboard");
            echo "<script>location='" . BASE_URL . $redirect . "'</script>";
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = true;
            $_SESSION['message'] = $e->getMessage();
        }
    }
    ?>
    <?php include('includes/message.php'); ?>
    <body class="login">

        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <a href="<?php echo BASE_URL; ?>"><img src="../images/logo.png" alt="Bit-Mine-Pool"></a>
                        <form id="login-member" class="form-horizontal form-label-left" method="post" novalidate action="">
                            <h1>User Login</h1>
                            <div>
                                <input type="text" data-msg-required="Please enter the user name." class="form-control" name="Username" placeholder="Username" required="required" />
                            </div>
                            <div>
                                <input type="password" data-msg-required="Please enter the password." class="form-control" name="Password" placeholder="Password" required="required" />
                            </div>
                            <div>
                                <div class="g-recaptcha" data-sitekey="6LcUQGgUAAAAAKVAFKNs11MwhobMHZCC3NfuFfmC"></div>
                            </div>

                            <label for="g-recaptcha"  id="capcha_error" ></label>
                            <div class="separator"></div>
                            <div></div>
                            <div>
                                <input type="submit" id= "login-member-submit" value="Login">
                                <input type="reset"  id= "login-member-reset" value="Reset">
                                <a class="reset_pass" href="<?php echo BASE_URL; ?>lostpassword">Forgot password?</a>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">New to site?
                                    <a href="<?php echo BASE_URL; ?>register?account=24rgxpwex1b4ko88owko" class="to_register"> Create Account </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><i class="fa fa-bitcoin"></i> Bit Mine Pool</h1>
                                    <p>©<?php echo date("Y"); ?> All Rights Reserved. <a href="<?php echo BASE_URL; ?>">Bit Mine Pool</a></p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>

            </div>
        </div>
    </body>
    <?php
    include('includes/footer.php');
    ?>
    <script>

        $(document).ready(function () {
            var validator = $("#login-member").validate();
            //validator.form();
        });
        $("#login-member").submit(function () {
            var googleResponse = jQuery('#g-recaptcha-response').val();
            if (!googleResponse) {
                $("#capcha_error").html('<p style="color:red !important" class=error">Please fill up the captcha.</p>');
                return false;
            } else {
                $("#capcha_error").html('');
                return true;
            }
        });

        $('#login-member-reset').click(function () {
            grecaptcha.reset();
            $('#login-member')[0].reset();
            var validator = $("#login-member").validate();
            validator.resetForm();

        });

    </script>
</html>
