<?php
///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
include('includes/dbconnect.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

// username and password sent from form 
$Username=$_POST['Username']; 
$Password=$_POST['Password']; 

//Remove white spaces//////////////////////////////////////////////
$Username = stripslashes($Username);
$Password = stripslashes($Password);

// To protect MySQL injection (more detail about MySQL injection)
$Username = mysqli_real_escape_string($conn, $_POST['Username']);
$Password = mysqli_real_escape_string($conn, $_POST['Password']);
//Validate Login Details///////////////////////////////////////////
			$sql = "SELECT * FROM users WHERE Username='$Username' AND Password='$Password'";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) == 1) {
					session_start();
					$_SESSION['Username']= $Username;
  					 header("location:loginsuccess");    		
					} 
			else {
    		echo "<script>window.location.href='logerror'</script>";
				 }
mysqli_close($conn);
?>
