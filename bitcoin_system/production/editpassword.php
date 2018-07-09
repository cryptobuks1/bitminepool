<?php session_start();?>
<?php if (isset($_SESSION['Token'])) { 
 } else{ header("location:login");}?>
<?php
///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
include('includes/dbconnect.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////									
// information sent from form 
 	$password = $_POST['password'];
	$repeatpass= $_POST['repeatpass'];
	$ChangeToken = $_POST['ChangeToken'];
	$Token=$_SESSION['Token'];
 //Check if the two passwords match
 if($password != $repeatpass)
    {
   echo "<script>window.location.href='nomatch.php'</script>";
    }
 else {	
 //Remove white spaces
 	$password= stripslashes($password);
// To protect MySQL injection (more detail about MySQL injection)
 $password = mysqli_real_escape_string($conn, $_POST['password']);
 //The Select Code
	$sql = "SELECT * FROM users WHERE Token='$Token'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
    // Edit Activation
    		$sql = "UPDATE users SET password='$password', Token='$ChangeToken' WHERE Token='$Token'";
						if (mysqli_query($conn, $sql)) {
						session_start();
						session_destroy();
  						 header("location:successpass");
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
}
?>