<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/apihelper.php');


$user_name = (isset($_GET['user_name']) && !empty($_GET['user_name'])) ? $_GET['user_name'] : '';

$responseAddBonus = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
            'user_name' => $user_name,
            'platform' => '3'
                ], 'checkAndProcessExpiredInvoice');

$responseAddBonus = json_decode($responseAddBonus);
echo 'Cron started <br>';
if ($responseAddBonus->statusCode == 100) {
    echo "Expiry processed for ".count($responseAddBonus->response) ." invoices.<br>";
} else {
    echo "Expiry processed for ".count($responseAddBonus->response) ." invoices.<br>";
} 
echo 'Cron finished. <br>';
exit;
?>
