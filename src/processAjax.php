<?php

include('includes/constant.php');
include('includes/apihelper.php');
include('includes/dbconnect.php');

if (!empty($_REQUEST) && !empty($_REQUEST['action']) && !empty($_REQUEST['url'])) {
    $_REQUEST['access_token'] = ACCESS_TOKEN;
    $response = ApiHelper::getApiResponse($_REQUEST['action'], $_REQUEST, $_REQUEST['url']);
    echo $response;
} else {
    echo  json_encode(["status" => "Failure",
    "statusCode"=> 102,
    "response"=> '',
    "statusDescription"=> "Please add missing action,url parameters."]);
}
exit;
?>