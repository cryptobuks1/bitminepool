<?php
    include('includes/header.php');
	if (isset($_SESSION['Username'])) {
        $_SESSION['error'] = '';
        $response = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                    'user_name' => $_SESSION['Username'],
                    'platform' => '3',
                        //'grant_type' => 'client_credentials'
                        ], 'sendEmailVerificationCode');

        $response = json_decode($response);
        if ($response->statusCode == 100) {
            $_SESSION['error'] = 0;
            $_SESSION['message'] = $response->statusDescription;
            $_SESSION['Username'] = $_SESSION['Username'];
            $redirect = 'verifyemail';
        } else {
            $_SESSION['error'] = 1;
            $_SESSION['message'] = $response->statusDescription;
            $redirect = 'verifyemail';
        }
        
        //header("Location:" . $redirect);
        echo "<script>location='" . BASE_URL . $redirect . "'</script>";
        exit;

	} else {
    unset($_POST);
    unset($_SESSION);
    //header("Location:login");
    $redirect = 'login';
    echo "<script>location='" . BASE_URL . $redirect . "'</script>";
    exit;
}
    ?>

    