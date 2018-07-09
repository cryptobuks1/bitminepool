<?php
///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
include('includes/dbconnect.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////									
// information sent from form 
 	$Token = $_POST['Token'];
	$ChangeToken = $_POST['ChangeToken'];
 //Remove white spaces
 	$Token= stripslashes($Token);
// To protect MySQL injection (more detail about MySQL injection)
 $Token = mysqli_real_escape_string($conn, $_POST['Token']);
 //The Select Code
	$sql = "SELECT Token FROM users WHERE Token='$Token'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
    // Edit Activation
    		$sql = "UPDATE users SET Activation='1', Token='$ChangeToken' WHERE Token='$Token'";
						if (mysqli_query($conn, $sql)) {
  						 header("location:successreg");
						} 
						else {
    					echo "Error updating record: " . mysqli_error($conn);
						}
    		
			} 
	else {
    		echo "<script>window.location.href='invalidtoken.php'</script>";
		}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
mysqli_close($conn);
?>