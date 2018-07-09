<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php
include('../includes/constant.php');
$Invoiceid ='Jamin';
?>
</head>
                            <?php
							$api_key = API_KEY;
							$xpub = XPUB;
							$secret = SECRET;
							$rootURL = QR_BASE_URL."bitcoin_system/production/payment";
							$orderID = $Invoiceid;
							$callback_url=$rootURL."/callback.php?invoice=".$orderID."&secret=".$secret;
							$receive_url="https://api.blockchain.info/v2/receive?key=".$api_key."&xpub=".$xpub."&callback=".urlencode($callback_url);
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							curl_setopt($ch, CURLOPT_URL, $receive_url);
							$ccc = curl_exec($ch);
							$json = json_decode($ccc, true);
							$payTo = $json['address'];
							?>

    <form action='maker.php'>
        Enter some text: <input type=text name='someText' value="<?php echo $payTo; ?>"><br>
        <input type=submit>
    </form>
<body>
</body>
</html>
