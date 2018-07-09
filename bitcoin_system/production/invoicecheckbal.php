<?php session_start();?>
<?php
///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
include('includes/dbconnect.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

////////////////////////////////////Get Balance////////////////////////////////////////////////////////
						$getone = "SELECT Balance FROM accountbalance WHERE Username = '".$_SESSION['Username']."'";
						$queryone = mysqli_query($conn, $getone);
						$balanceone = mysqli_fetch_array($queryone);
						$showone = $balanceone['Balance'];
///////////////////////////////////////////////////////////////////////////////////////////////////////////
						$getstatus = "SELECT Status FROM users WHERE Username = '".$_SESSION['Username']."'";
						$querystatus = mysqli_query($conn, $getstatus);
						$currentstatus = mysqli_fetch_array($querystatus);
						$showstatus = $currentstatus['Balance'];
// username and password sent from form 
$Username=$_SESSION['Username']; 
//Validate Login Details///////////////////////////////////////////
			if($showone>0&&$showone<100){
				header("location:genbal");
			}
			else {
				session_start();
				$_SESSION["invoice"]= "payer";
    			header("location:genregister");
				 }
mysqli_close($conn);
?>
