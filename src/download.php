<?php
include('includes/header.php');

if (isset($_SESSION['Username'])) {
    
    $_SESSION['error'] = 0;
    $receiveAmountBtc = $sentAmountBtc = 0;
    $receiveAmountAddress = $walletErrorMessage = '';
    $btcValue = $stats['market_price_usd'];
    $walletData = $userData = $walletWithdrawalTransactionDBData = [];
    $userName = $_SESSION['Username'];

    $responseSupportTicket = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
            'user_name' => $_SESSION['Username'],
            'platform' => '3',
            ], 'getAllSupportTicketByUserName');

    $responseSupportTicket = json_decode($responseSupportTicket);
    if ($responseSupportTicket->statusCode == 100) {
        $supportTicketDBData = $responseSupportTicket->response->support_data;
    }

    header('Content-Description: File Transfer');
    header('Content-Type: application/csv');
    header("Content-Disposition: attachment; filename=page-data-export.csv");
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    $handle = fopen('php://output', 'w');
    ob_clean(); // clean slate
      // [given some database query object $result]...
        $arr[] = ['Header1','Header2'];
        $arr[] = ['Header1','Header2'];
        $arr[] = ['Header1','Header2'];
        foreach($arr as $ar){
            fputcsv($handle, $ar); 
            }
      
    ob_flush(); // dump buffer
    fclose($handle);
    die();
    
    /*if (!empty($_POST)) {
        $responseSupportRequest = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                'user_name' => $_SESSION['Username'],
                'ticket_id' => $_POST['ticket_id'],
                'issue' => $_POST['issue'],
                'category' => $_POST['category'],
                'platform' => '3',
                'transaction_type' => '501',
                ], 'addSupportRequest');
        $responseSupportRequest = json_decode($responseSupportRequest);
        $redirect = '';

        if ($responseSupportRequest->statusCode == 100) {
            // $walletData = $response->response->wallet_data;
            $_SESSION['error'] = 0;
            $_SESSION['message'] = $responseSupportRequest->statusDescription;
        } else {
            $_SESSION['error'] = 1;
            $_SESSION['message'] = $responseSupportRequest->statusDescription;
        }
        unset($_POST);
        $redirect = 'support';
        echo "<script>location='" . BASE_URL . $redirect . "'</script>";
    }*/
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
?>
