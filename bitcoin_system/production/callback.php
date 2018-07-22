<?php
        include('includes/constant.php');
	$secret=SECRET;
	if ($_GET['secret'] !=$secret){
	die('stop doing that');
	} else {
	//update database
	$fff = fopen("text.txt", "w");
	$value = $_GET['value']." - ";
	$fw = fwrite($fff, $value);
	$txhash = $_GET['transaction_hash']." - ";
	$fw = fwrite($fff,	$txhash);
	$invoice = $_GET['invoice'];
	$fw = fwrite($fff,	$invoice);
	fclose($fff);
	echo "*ok*";
	}
		
?>