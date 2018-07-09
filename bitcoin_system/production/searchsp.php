<?php
///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
include('includes/dbconnect.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////									
// information sent from form 
 	$Sponsorname = $_POST['Sponsorname'];
 //Remove white spaces
 	$Sponsorname= stripslashes($Sponsorname);
 //The Select Code
	$sql = "SELECT Username FROM users WHERE Username='$Sponsorname'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
    // Start Session
    		session_start();
			$_SESSION['Sponsorname']= $Sponsorname;
    		header("location:Register");
			} 
	else {
    		echo "<script>window.location.href='invalidcode.php'</script>";
		}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
mysqli_close($conn);
?>