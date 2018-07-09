<?php session_start();
///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
include('includes/dbconnect.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

// username and password sent from form 
$Username=$_SESSION['Username']; 
//Validate Login Details///////////////////////////////////////////
			$sql = "SELECT * FROM users WHERE Username='".$_SESSION['Username']."' AND Status='Close'";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) == 1) {
					$mainuser='mainuser';
					session_start();
					$_SESSION['mainuser']= $mainuser;
  					 header("location:index");    		
					} 
			else {
				$guest= 'guest';
				session_start();
				$_SESSION['guest']= $guest;
    			header("location:guest");
				 }
mysqli_close($conn);
?>
