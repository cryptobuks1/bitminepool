<?php
///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
include('includes/dbconnect.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////									
// information sent from form 
 	$email= $_POST['email'];
//Form Validation
 if(empty($email)) {
    echo "<script>window.location.href='invalidemail'</script>";
	}
 else{
 //Remove white spaces
 	$email= stripslashes($email);
// To protect MySQL injection (more detail about MySQL injection)
 $email = mysqli_real_escape_string($conn, $_POST['email']);
 //The Select Code
	$sql = "SELECT Email FROM users WHERE Email='$email'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
    // The Email is registered
		session_start();
		$_SESSION['email']= $email;
  		header("location:verifyemail");
			} 
	else {
    		echo "<script>window.location.href='invaliemail'</script>";
		}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
mysqli_close($conn);
}
?>