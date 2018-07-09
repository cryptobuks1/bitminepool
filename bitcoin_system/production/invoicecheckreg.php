<?php session_start();?>
<?php
///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
include('includes/dbconnect.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

// username and password sent from form 
$Username=$_SESSION['Username']; 
//Validate Login Details///////////////////////////////////////////
			$sql = "SELECT * FROM invoice WHERE Username='".$_SESSION['Username']."' AND Status='Unpaid'";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) == 1) {
  					 header("location:unpaid");    		
					} 
			else {
				session_start();
				$_SESSION["invoice"]= "payer";
    			header("location:genregister");
				 }
mysqli_close($conn);
?>
