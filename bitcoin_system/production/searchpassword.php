<?php
///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
include('includes/dbconnect.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////									
// information sent from form 
 	$Token = $_POST['Token'];
 //Remove white spaces
 	$Token= stripslashes($Token);
// To protect MySQL injection (more detail about MySQL injection)
 $Token = mysqli_real_escape_string($conn, $_POST['Token']);
 //The Select Code
	$sql = "SELECT Token FROM users WHERE Token='$Token'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
    // Start Token session
						 session_start();
						 $_SESSION['Token']= $Token;
  						 header("location:changepassword");
						
			} 
	else {
    		echo "<script>window.location.href='wrongtoken.php'</script>";
		}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
mysqli_close($conn);
?>