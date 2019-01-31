<?php

include('includes/constant.php');

include('includes/apihelper.php');
include('includes/dbconnect.php');
$secret = SECRET;
if ($_GET['secret'] != $secret) {
    die('stop doing that');
} else {
    //update database
    $value = $_GET['value'] . " - ";
    $txhash = $_GET['transaction_hash'] . " - ";
    $invoice = $_GET['invoice'];
    $passedValue = $_GET['value'];
///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
    $servername = DB_SERVER_NAME;
    $username = DB_USER_NAME;
    $password = DB_PASSWORD;
    $database = DB_NAME;
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Get payment Status
    $getstatus = "SELECT Status FROM invoice WHERE Invoiceid = '" . $invoice . "' AND Status = 'Unpaid' order by id desc limit 1";
    $querystatus = mysqli_query($conn, $getstatus);

    //Check if status is unpaid
    if (mysqli_num_rows($querystatus) == 1) {
        //Convert Satoshis into dollars
        $newbitcoin = $passedValue * 0.00000001;
        $url = "https://blockchain.info/stats?format=json";
        $stats = json_decode(file_get_contents($url), true);
        $btcValue = $stats['market_price_usd'];
        $newbitvalue = $newbitcoin * $btcValue;
        $bitbalance = round($newbitvalue, 8);

        $newbitcoin = $passedValue / $btcValue;
        $newbitcoin = round($newbitcoin, 8);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
        //Get Username From Invoice 
        $getusername = "SELECT * FROM invoice WHERE Invoiceid = '" . $invoice . "' AND Status = 'Unpaid' order by id desc limit 1";
        $queryusername = mysqli_query($conn, $getusername);
        $currentuser = mysqli_fetch_array($queryusername);
        $showusername = $currentuser['Username'];
        $showbtc = $currentuser['Btcamount'];
        $invoicepurpose = $currentuser['Purpose'];
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////Get Sponsor/////////////////////////////////////////////////////////////////
        $getsponsor = "SELECT Sponsor FROM users WHERE Username = '" . $showusername . "'";
        $querysponsor = mysqli_query($conn, $getsponsor);
        $currentsponsor = mysqli_fetch_array($querysponsor);
        $showsponsor = $currentsponsor['Sponsor'];
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////Get Sponsor Account Balance//////////////////////////////////////////////////
        $getsponsorbalance = "SELECT Balance FROM commission WHERE Username = '" . $showsponsor . "'";
        $querysponsorbalance = mysqli_query($conn, $getsponsorbalance);
        $currentsponsorbalance = mysqli_fetch_array($querysponsorbalance);
        $showsponsorbalance = $currentsponsorbalance['Balance'];
        //////////////////////////////////Get Sponsor Rank///////////////////////////////////////////////////////////
        $getsponsorrank = "SELECT Rankid FROM rank WHERE Username = '" . $showsponsor . "'";
        $querysponsorrank = mysqli_query($conn, $getsponsorrank);
        $currentsponsorrank = mysqli_fetch_array($querysponsorrank);
        $showsponsorrank = $currentsponsorrank['Rankid'];
        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        if ($showsponsorrank == 6) {
            $comm = 0.08;
        } elseif ($showsponsorrank == 5) {
            $comm = 0.08;
        } elseif ($showsponsorrank == 4) {
            $comm = 0.08;
        } elseif ($showsponsorrank == 3) {
            $comm = 0.07;
        } elseif ($showsponsorrank == 2) {
            $comm = 0.06;
        } elseif ($showsponsorrank == 1) {
            $comm = 0.05;
        } else {
            $comm = 0;
        }
        //////////////////////////////////////Get Commissions////////////////////////////////////////////////////
        $Startercomm = (300 * $comm);
        $minicomm = (600 * $comm);
        $mediumcomm = (1200 * $comm);
        $grandcomm = (2400 * $comm);
        $ultimatecomm = (4800 * $comm);
        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////Update Registration or Packs//////////////////////////////////////////////////////////////////////
        $Date = date("Y-m-d");
        $PurchaseDate = date("Y-m-d");
        $MiningDate = date('Y-m-d', strtotime('+31 days'));
        $CompletionDate = date('Y-m-d', strtotime('+365 days'));

        //if ($newbitcoin == $showbtc) {
        if ($invoicepurpose == 'Registration') {
            $sqllz = "UPDATE users SET Status='Close' WHERE Username ='" . $showusername . "'";
            mysqli_query($conn, $sqllz);
            $sqlz = "UPDATE register SET EntryDate='" . $Date . "', Amount='100' WHERE Username ='" . $showusername . "'";
            mysqli_query($conn, $sqlz);
        } elseif ($invoicepurpose == 'Starter') {
            $sqlone = "UPDATE starterpack SET Comment='Purchased', Status='Active', PurchaseDate='$PurchaseDate', MiningDate='$MiningDate', CompletionDate='$CompletionDate' WHERE Username ='" . $showusername . "'";
            mysqli_query($conn, $sqlone);
            $sponsornewbalone = ($showsponsorbalance + $Startercomm);
            $sponsorone = "UPDATE commission SET Balance='$sponsornewbalone' WHERE Username ='" . $showsponsor . "'";
            mysqli_query($conn, $sponsorone);
            $query = mysqli_query($conn, "update accountbalance set Balance=(Balance+$Startercomm) where Username = '" . $showsponsor . "'");

            $insertLogQuery = mysqli_query($conn, "INSERT INTO bmp_bonus_commission_earn_log (user_name, reason_id, reason_description, is_added_by_cron, amount, added_in) 
                                                          VALUES ('" . $showsponsor . "', '1', CONCAT('Direct commision for Pool1 of user ','" . $showusername . "'), '0'," . $Startercomm . ", 'commission')
                        ");

            //////////////////////////////////Get Volumes from database///////////////////////////////////////////////////
            $getvolumes = "SELECT Balance FROM teamvolume WHERE Username = '" . $showusername . "'";
            $queryvolumes = mysqli_query($conn, $getvolumes);
            $currentvolumes = mysqli_fetch_array($queryvolumes);
            $showvolumes = $currentvolumes['Balance'];
            $newvolumebalance = ($showvolumes + 300);
            /////////////////////////////////Update Volumes///////////////////////////////////////////////////////////////
            $query = mysqli_query($conn, "update teamvolume set Balance='$newvolumebalance' where Username = '" . $showusername . "'");
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        } elseif ($invoicepurpose == 'Mini') {
            $sqltwo = "UPDATE minipack SET Comment='Purchased', Status='Active', PurchaseDate='$PurchaseDate', MiningDate='$MiningDate', CompletionDate='$CompletionDate' WHERE Username ='" . $showusername . "'";
            mysqli_query($conn, $sqltwo);
            $sponsornewbaltwo = ($showsponsorbalance + $minicomm);
            $sponsortwo = "UPDATE commission SET Balance='$sponsornewbaltwo' WHERE Username ='" . $showsponsor . "'";
            mysqli_query($conn, $sponsortwo);
            $query = mysqli_query($conn, "update accountbalance set Balance=(Balance+$minicomm) where Username = '" . $showsponsor . "'");

            $insertLogQuery = mysqli_query($conn, "INSERT INTO bmp_bonus_commission_earn_log (user_name, reason_id, reason_description, is_added_by_cron, amount, added_in) 
                                                          VALUES ('" . $showsponsor . "', '1', CONCAT('Direct commision for Pool2 of user ','" . $showusername . "'), '0'," . $minicomm . ", 'commission')
                        ");

            //////////////////////////////////Get Volumes from database///////////////////////////////////////////////////
            $getvolumes = "SELECT Balance FROM teamvolume WHERE Username = '" . $showusername . "'";
            $queryvolumes = mysqli_query($conn, $getvolumes);
            $currentvolumes = mysqli_fetch_array($queryvolumes);
            $showvolumes = $currentvolumes['Balance'];
            $newvolumebalance = ($showvolumes + 600);
            /////////////////////////////////Update Volumes///////////////////////////////////////////////////////////////
            $query = mysqli_query($conn, "update teamvolume set Balance='$newvolumebalance' where Username = '" . $showusername . "'");
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        } elseif ($invoicepurpose == 'Medium') {
            $sqlthree = "UPDATE mediumpack SET Comment='Purchased', Status='Active', PurchaseDate='$PurchaseDate', MiningDate='$MiningDate', CompletionDate='$CompletionDate' WHERE Username ='" . $showusername . "'";
            mysqli_query($conn, $sqlthree);
            $sponsornewbalthree = ($showsponsorbalance + $mediumcomm);
            $sponsorthree = "UPDATE commission SET Balance='$sponsornewbalthree' WHERE Username ='" . $showsponsor . "'";
            mysqli_query($conn, $sponsorthree);
            $query = mysqli_query($conn, "update accountbalance set Balance=(Balance+$mediumcomm) where Username = '" . $showsponsor . "'");

            $insertLogQuery = mysqli_query($conn, "INSERT INTO bmp_bonus_commission_earn_log (user_name, reason_id, reason_description, is_added_by_cron, amount, added_in) 
                                                          VALUES ('" . $showsponsor . "', '1', CONCAT('Direct commision for Pool3 of user ','" . $showusername . "'), '0'," . $mediumcomm . ", 'commission')
                        ");

            //////////////////////////////////Get Volumes from database///////////////////////////////////////////////////
            $getvolumes = "SELECT Balance FROM teamvolume WHERE Username = '" . $showusername . "'";
            $queryvolumes = mysqli_query($conn, $getvolumes);
            $currentvolumes = mysqli_fetch_array($queryvolumes);
            $showvolumes = $currentvolumes['Balance'];
            $newvolumebalance = ($showvolumes + 1200);
            /////////////////////////////////Update Volumes///////////////////////////////////////////////////////////////
            $query = mysqli_query($conn, "update teamvolume set Balance='$newvolumebalance' where Username = '" . $showusername . "'");
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        } elseif ($invoicepurpose == 'Grand') {
            $sqlfour = "UPDATE grandpack SET Comment='Purchased', Status='Active', PurchaseDate='$PurchaseDate', MiningDate='$MiningDate', CompletionDate='$CompletionDate' WHERE Username ='" . $showusername . "'";
            mysqli_query($conn, $sqlfour);
            $sponsornewbalfour = ($showsponsorbalance + $grandcomm);
            $sponsorfour = "UPDATE commission SET Balance='$sponsornewbalfour' WHERE Username ='" . $showsponsor . "'";
            mysqli_query($conn, $sponsorfour);
            $query = mysqli_query($conn, "update accountbalance set Balance=(Balance+$grandcomm) where Username = '" . $showsponsor . "'");

            $insertLogQuery = mysqli_query($conn, "INSERT INTO bmp_bonus_commission_earn_log (user_name, reason_id, reason_description, is_added_by_cron, amount, added_in) 
                                                          VALUES ('" . $showsponsor . "', '1', CONCAT('Direct commision for Pool4 of user ','" . $showusername . "'), '0'," . $grandcomm . ", 'commission')
                        ");

            //////////////////////////////////Get Volumes from database///////////////////////////////////////////////////
            $getvolumes = "SELECT Balance FROM teamvolume WHERE Username = '" . $showusername . "'";
            $queryvolumes = mysqli_query($conn, $getvolumes);
            $currentvolumes = mysqli_fetch_array($queryvolumes);
            $showvolumes = $currentvolumes['Balance'];
            $newvolumebalance = ($showvolumes + 2400);
            /////////////////////////////////Update Volumes///////////////////////////////////////////////////////////////
            $query = mysqli_query($conn, "update teamvolume set Balance='$newvolumebalance' where Username = '" . $showusername . "'");
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        } elseif ($invoicepurpose == 'Ultimate') {
            $sqlfive = "UPDATE ultimatepack SET Comment='Purchased', Status='Active', PurchaseDate='$PurchaseDate', MiningDate='$MiningDate', CompletionDate='$CompletionDate' WHERE Username ='" . $showusername . "'";
            mysqli_query($conn, $sqlfive);
            $sponsornewbalfive = ($showsponsorbalance + $ultimatecomm);
            $sponsorfive = "UPDATE commission SET Balance='$sponsornewbalfive' WHERE Username ='" . $showsponsor . "'";
            mysqli_query($conn, $sponsorfive);
            $query = mysqli_query($conn, "update accountbalance set Balance=(Balance+$ultimatecomm) where Username = '" . $showsponsor . "'");

            $insertLogQuery = mysqli_query($conn, "INSERT INTO bmp_bonus_commission_earn_log (user_name, reason_id, reason_description, is_added_by_cron, amount, added_in) 
                                                          VALUES ('" . $showsponsor . "', '1', CONCAT('Direct commision for Pool5 of user ','" . $showusername . "'), '0'," . $ultimatecomm . ", 'commission')
                        ");

            //////////////////////////////////Get Volumes from database///////////////////////////////////////////////////
            $getvolumes = "SELECT Balance FROM teamvolume WHERE Username = '" . $showusername . "'";
            $queryvolumes = mysqli_query($conn, $getvolumes);
            $currentvolumes = mysqli_fetch_array($queryvolumes);
            $showvolumes = $currentvolumes['Balance'];
            $newvolumebalance = ($showvolumes + 4800);
            /////////////////////////////////Update Volumes///////////////////////////////////////////////////////////////
            $query = mysqli_query($conn, "update teamvolume set Balance='$newvolumebalance' where Username = '" . $showusername . "'");
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        } else {
            
        }
        $responseInvoiceNotification = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                    'userName' => $showusername,
                    'platform' => '3',
                    'invoiceId' => $invoice,                    
                        ], 'sendInvoiceNotificationByID');

        $responseInvoiceNotification = json_decode($responseInvoiceNotification);
        
        
        // To update the rank
        $response = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                'user_name' => $showusername,
                'platform' => '3'
                ], 'getAllRankData');

        $response = json_decode($response);
        
        // }
        //Update Invoice Table
        $sqlv = "UPDATE invoice SET Status='Paid' WHERE Invoiceid ='" . $invoice . "'";
        mysqli_query($conn, $sqlv);
        //Insert new payment record
        $date = date("Y-m-d");
        $sql = "INSERT INTO payments (Paydate, Payuser, Amountbtc, Amountusd)VALUES('$date', '$showusername', '$newbitcoin', '$bitbalance')";
        mysqli_query($conn, $sql);
        $response = json_encode($_GET);
        if ($_GET['confirmations'] >= 4) {
            $sqlPaymentCallBack = "INSERT INTO `payment_callback_log` (`id`, `username`, `invoice_id`, `amount_btc`, `current_amount_btc`, `amount_usd`, `response`,`status`) VALUES (NULL, '$showusername', '$invoice', '$showbtc', '$newbitcoin', '$passedValue', '$response',2);";
        } else {
            $sqlPaymentCallBack = "INSERT INTO `payment_callback_log` (`id`, `username`, `invoice_id`, `amount_btc`, `current_amount_btc`, `amount_usd`, `response`,`status`) VALUES (NULL, '$showusername', '$invoice', '$showbtc', '$newbitcoin', '$passedValue', '$response',1);";
        }
        mysqli_query($conn, $sqlPaymentCallBack);
    } else {
        echo "Wrong Operation";
    }
    mysqli_close($conn);
    echo "*ok*";
}
?>