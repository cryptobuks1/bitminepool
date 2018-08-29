<!DOCTYPE html>
<html lang="en">
    <?php
    include('includes/header.php');
    if (!empty($_POST)) {
        $response = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                    'user_name' => $_POST['Username'],
                    'password' => $_POST['Password'],
                    'platform' => '3',
                    'transaction_type' => '201',
                    'grant_type' => 'client_credentials'
                        ], 'loginCustomer');

        $response = json_decode($response);

        $redirect = 'login';
        if($response->statusCode == 100){
            switch($response->response->Status){
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
        }

        unset($_POST);
        header("location: ".$redirect);
        exit();
    }
    ?>

    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <a href="<?php echo BASE_URL; ?>"><img src="../images/logo.png" alt="Bit-Mine-Pool"></a>
                        <form action="" method="post">
                            <h1>User Login</h1>
                            <div>
                                <input type="text" class="form-control" name="Username" placeholder="Username" required="" />
                            </div>
                            <div>
                                <input type="password" class="form-control" name="Password" placeholder="Password" required="" />
                            </div>
                            <div>
                                <input type="submit"  value="Login">
                                <a class="reset_pass" href="<?php echo BASE_URL; ?>lostpassword">Forgot password?</a>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">New to site?
                                    <a href="<?php echo BASE_URL; ?>register?Account=24rgxpwex1b4ko88owko" class="to_register"> Create Account </a>
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
</html>
