<?php

	$value =1356391 ;
	$invoice = 3457536;
///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
									$servername = "localhost";
									$username = "edwindb";
									$password = "0720226275";
									$database = "minehub";
									// Create connection
									$conn = mysqli_connect($servername, $username, $password, $database);
									// Check connection
									if (!$conn) {
    								die("Connection failed: " . mysqli_connect_error());
									}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//Get payment Status
		$getstatus= "SELECT Status FROM invoice WHERE Invoiceid = '".$invoice."' AND Status = 'Unpaid'";
		$querystatus = mysqli_query($conn, $getstatus);
	//Check if status is unpaid
		if (mysqli_num_rows($querystatus) == 1) {
	//Convert Satoshis into dollars
		$newbitcoin=$value*0.00000001;
		$url = "https://blockchain.info/stats?format=json";
		$stats = json_decode(file_get_contents($url), true);
		$btcValue = $stats['market_price_usd'];
		$newbitvalue = $newbitcoin*$btcValue; 
		$bitbalance = round($newbitvalue,8);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	//Get Username From Invoice 
		$getusername= "SELECT * FROM invoice WHERE Invoiceid = '".$invoice."' AND Status = 'Unpaid'";
		$queryusername = mysqli_query($conn, $getusername);
		$currentuser = mysqli_fetch_array($queryusername);
		$showusername = $currentuser['Username'];
		$showbtc = $currentuser['Btcamount'];
		$invoicepurpose = $currentuser['Purpose'];
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		//////////////////////////////////Get Sponsor/////////////////////////////////////////////////////////////////
		$getsponsor= "SELECT Sponsor FROM users WHERE Username = '".$showusername."'";
		$querysponsor = mysqli_query($conn, $getsponsor);
		$currentsponsor = mysqli_fetch_array($querysponsor);
		$showsponsor = $currentsponsor['Sponsor'];
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		/////////////////////////////////Get Sponsor Account Balance//////////////////////////////////////////////////
		$getsponsorbalance= "SELECT Balance FROM commission WHERE Username = '".$showsponsor."'";
		$querysponsorbalance = mysqli_query($conn, $getsponsorbalance);
		$currentsponsorbalance = mysqli_fetch_array($querysponsorbalance);
		$showsponsorbalance = $currentsponsorbalance['Balance'];
		//////////////////////////////////Get Sponsor Rank///////////////////////////////////////////////////////////
		$getsponsorrank= "SELECT * FROM rank WHERE Username = '".$showsponsor."'";
		$querysponsorrank = mysqli_query($conn, $getsponsorrank);
		$currentsponsorrank = mysqli_fetch_array($querysponsorrank);
		$showsponsorrank = $currentsponsorrank['Rankid'];
		/////////////////////////////////////////////////////////////////////////////////////////////////////////
		if ($showsponsorrank==4){
			$comm=0.08;
		}elseif($showsponsorrank==3){
			$comm=0.07;
		}elseif($showsponsorrank==2){
			$comm=0.06;
		}elseif($showsponsorrank==1){
			$comm=0.06;
		}else{
			$comm=0;
		}
		//////////////////////////////////////Get Commissions////////////////////////////////////////////////////
		$Startercomm=(300*$comm);
		$minicomm=(600*$comm);
		$mediumcomm=(1200*$comm);
		$grandcomm=(2400*$comm);
		$ultimatecomm=(4800*$comm);
		/////////////////////////////////////////////////////////////////////////////////////////////////////////
		
	/////////////////////////Update Registration or Packs//////////////////////////////////////////////////////////////////////
			$Date = date("Y-m-d");
			$PurchaseDate = date("Y-m-d");
			$MiningDate = date('Y-m-d', strtotime('+30 days'));
			$CompletionDate = date('Y-m-d', strtotime('+365 days'));
			
			if($newbitcoin==$showbtc) {
				if ($invoicepurpose=='Registration'){
					$sqllz = "UPDATE users SET Status='Close' WHERE Username ='".$showusername."'";
					mysqli_query($conn, $sqllz);
					$sqlz = "UPDATE register SET EntryDate='".$Date."', Amount='100' WHERE Username ='".$showusername."'";
					mysqli_query($conn, $sqlz);	
				}
				elseif($invoicepurpose=='Starter'){
					$sqlone = "UPDATE starterpack SET Comment='Purchased', Status='Active', PurchaseDate='$PurchaseDate', MiningDate='$MiningDate', CompletionDate='$CompletionDate' WHERE Username ='".$showusername."'";
					mysqli_query($conn, $sqlone);
					$sponsornewbalone=($showsponsorbalance+$Startercomm);
					$sponsorone = "UPDATE commission SET Balance='$sponsornewbalone' WHERE Username ='".$showsponsor."'";
					mysqli_query($conn, $sponsorone);
					//////////////////////////////////Get Volumes from database///////////////////////////////////////////////////
					$getvolumes= "SELECT Balance FROM teamvolume WHERE Username = '".$showusername."'";
					$queryvolumes = mysqli_query($conn, $getvolumes);
					$currentvolumes = mysqli_fetch_array($queryvolumes);
					$showvolumes = $currentvolumes['Balance'];
					$newvolumebalance=($showvolumes+300);
					/////////////////////////////////Update Volumes///////////////////////////////////////////////////////////////
					$query = mysqli_query($conn,"update teamvolume set Balance='$newvolumebalance' where Username = '".$showusername."'");
					/////////////////////////////////////////////////////////////////////////////////////////////////////////////
					/////////////////////////////Check whether user is on tree//////////////////////////////////////////////////
					
					
				}
				elseif($invoicepurpose=='Mini'){
					$sqltwo = "UPDATE minipack SET Comment='Purchased', Status='Active', PurchaseDate='$PurchaseDate', MiningDate='$MiningDate', CompletionDate='$CompletionDate' WHERE Username ='".$showusername."'";
					mysqli_query($conn, $sqltwo);
					$sponsornewbaltwo=($showsponsorbalance+$minicomm);
					$sponsortwo = "UPDATE commission SET Balance='$sponsornewbaltwo' WHERE Username ='".$showsponsor."'";
					mysqli_query($conn, $sponsortwo);
					//////////////////////////////////Get Volumes from database///////////////////////////////////////////////////
					$getvolumes= "SELECT Balance FROM teamvolume WHERE Username = '".$showusername."'";
					$queryvolumes = mysqli_query($conn, $getvolumes);
					$currentvolumes = mysqli_fetch_array($queryvolumes);
					$showvolumes = $currentvolumes['Balance'];
					$newvolumebalance=($showvolumes+600);
					/////////////////////////////////Update Volumes///////////////////////////////////////////////////////////////
					$query = mysqli_query($conn,"update teamvolume set Balance='$newvolumebalance' where Username = '".$showusername."'");
					/////////////////////////////////////////////////////////////////////////////////////////////////////////////
					
				}
				elseif($invoicepurpose=='Medium'){
					$sqlthree = "UPDATE mediumpack SET Comment='Purchased', Status='Active', PurchaseDate='$PurchaseDate', MiningDate='$MiningDate', CompletionDate='$CompletionDate' WHERE Username ='".$showusername."'";
					mysqli_query($conn, $sqlthree);
					$sponsornewbalthree=($showsponsorbalance+$mediumcomm);
					$sponsorthree = "UPDATE commission SET Balance='$sponsornewbalthree' WHERE Username ='".$showsponsor."'";
					mysqli_query($conn, $sponsorthree);
					//////////////////////////////////Get Volumes from database///////////////////////////////////////////////////
					$getvolumes= "SELECT Balance FROM teamvolume WHERE Username = '".$showusername."'";
					$queryvolumes = mysqli_query($conn, $getvolumes);
					$currentvolumes = mysqli_fetch_array($queryvolumes);
					$showvolumes = $currentvolumes['Balance'];
					$newvolumebalance=($showvolumes+1200);
					/////////////////////////////////Update Volumes///////////////////////////////////////////////////////////////
					$query = mysqli_query($conn,"update teamvolume set Balance='$newvolumebalance' where Username = '".$showusername."'");
					/////////////////////////////////////////////////////////////////////////////////////////////////////////////
					
				}
				elseif($invoicepurpose=='Grand'){
					$sqlfour = "UPDATE grandpack SET Comment='Purchased', Status='Active', PurchaseDate='$PurchaseDate', MiningDate='$MiningDate', CompletionDate='$CompletionDate' WHERE Username ='".$showusername."'";
					mysqli_query($conn, $sqlfour);
					$sponsornewbalfour=($showsponsorbalance+$grandcomm);
					$sponsorfour = "UPDATE commission SET Balance='$sponsornewbalfour' WHERE Username ='".$showsponsor."'";
					mysqli_query($conn, $sponsorfour);
					//////////////////////////////////Get Volumes from database///////////////////////////////////////////////////
					$getvolumes= "SELECT Balance FROM teamvolume WHERE Username = '".$showusername."'";
					$queryvolumes = mysqli_query($conn, $getvolumes);
					$currentvolumes = mysqli_fetch_array($queryvolumes);
					$showvolumes = $currentvolumes['Balance'];
					$newvolumebalance=($showvolumes+2400);
					/////////////////////////////////Update Volumes///////////////////////////////////////////////////////////////
					$query = mysqli_query($conn,"update teamvolume set Balance='$newvolumebalance' where Username = '".$showusername."'");
					/////////////////////////////////////////////////////////////////////////////////////////////////////////////
					
				}
				elseif($invoicepurpose=='Ultimate'){
					$sqlfive = "UPDATE ultimatepack SET Comment='Purchased', Status='Active', PurchaseDate='$PurchaseDate', MiningDate='$MiningDate', CompletionDate='$CompletionDate' WHERE Username ='".$showusername."'";
					mysqli_query($conn, $sqlfive);
					$sponsornewbalfive=($showsponsorbalance+$ultimatecomm);
					$sponsorfive = "UPDATE commission SET Balance='$sponsornewbalfive' WHERE Username ='".$showsponsor."'";
					mysqli_query($conn, $sponsorfive);
					//////////////////////////////////Get Volumes from database///////////////////////////////////////////////////
					$getvolumes= "SELECT Balance FROM teamvolume WHERE Username = '".$showusername."'";
					$queryvolumes = mysqli_query($conn, $getvolumes);
					$currentvolumes = mysqli_fetch_array($queryvolumes);
					$showvolumes = $currentvolumes['Balance'];
					$newvolumebalance=($showvolumes+4800);
					/////////////////////////////////Update Volumes///////////////////////////////////////////////////////////////
					$query = mysqli_query($conn,"update teamvolume set Balance='$newvolumebalance' where Username = '".$showusername."'");
					/////////////////////////////////////////////////////////////////////////////////////////////////////////////
					
				}
				else{
					
				}
				}
	//Update Invoice Table
		$sqlv = "UPDATE invoice SET Status='Paid' WHERE Invoiceid ='".$invoice."'";
		mysqli_query($conn, $sqlv);	
	//Insert new payment record
		$date=date("Y-m-d");
		$sql="INSERT INTO payments (Paydate, Payuser, Amountbtc, Amountusd)VALUES('$date', '$showusername', '$newbitcoin', '$bitbalance')";		
		mysqli_query($conn, $sql);							  																																																																								        	
		
		} else {
			echo "Wrong Operation";
		}
		mysqli_close($conn);
		echo "*ok*";
	
		
?>