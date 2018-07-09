<?php session_start();?>
<?php 
$register= 'register';
session_start();
$_SESSION['register']= $register;
?>
<?php

///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
include('includes/dbconnect.php');
/////////////////////////////Get Withdrawal Balance for Starter Pack/////////////////////////////////////////////////////////////
		$getwstarter = "SELECT Withdrawal FROM starterpack WHERE Username = '".$_SESSION['Username']."'";
		$querywstarter = mysqli_query($conn, $getwstarter);
		$balancewstarter = mysqli_fetch_array($querywstarter);
		$wstarter = $balancewstarter['Withdrawal'];
///////////////////////////Get Mining Balance//////////////////////////////////////////////////////////////////////
		$getmbalance = "SELECT Balance FROM mining WHERE Username = '".$_SESSION['Username']."'";
		$querymbalance  = mysqli_query($conn, $getmbalance);
		$balancembalance = mysqli_fetch_array($querymbalance);
		$miningbalance = $balancembalance['Balance'];
/////////////////////////////Get Withdrawal Balance for Starter Pack/////////////////////////////////////////////////////////////
$Starterdate1= "SELECT MiningDate FROM starterpack WHERE Username='".$_SESSION['Username']."'";
								$querystarter1 = mysqli_query($conn, $Starterdate1);
								$viewstarter1 = mysqli_fetch_array($querystarter1);
								$showstarterdate1 = $viewstarter1['MiningDate'];
								$Currentmining1 = date('Y-m-d', strtotime('-1 days'));
								if ($showstarterdate1=="0"){
									$priceone = $showstarterdate1/ $btcValue;
								}else{
$querysum = "select sum(Usd)as total from dailymine where Pack='Starter' and Date Between '$showstarterdate1' AND '$Currentmining1'";
$querytotal = mysqli_query($conn, $querysum);
$viewtotal = mysqli_fetch_array($querytotal);
$totalmine = $viewtotal['total'];
$newone = ($totalmine-$wstarter);
								}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($newone==0){
	header("location:nomining");
}else{
$newbalance=($newone+$wstarter);
$newmining=($miningbalance+$newbalance);
$sqlv = "UPDATE starterpack SET Withdrawal='$newbalance' WHERE Username='".$_SESSION['Username']."'";
		mysqli_query($conn, $sqlv);	
$sqlx = "UPDATE mining SET Balance='$newmining' WHERE Username='".$_SESSION['Username']."'";
		mysqli_query($conn, $sqlx);
header("location:index");
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////		
?>