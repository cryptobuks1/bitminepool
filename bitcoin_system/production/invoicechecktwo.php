<?php session_start();?>
<?php
///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
include('includes/dbconnect.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

// username and password sent from form 
$Username=$_SESSION['Username']; 
$sqll = "SELECT * FROM minipack WHERE Username='".$_SESSION['Username']."' AND Comment='Purchased'";
$resultl = mysqli_query($conn, $sqll);
if (mysqli_num_rows($resultl) == 1) {
	echo '<script>alert("Mini Pack Already Purchased");window.location.assign("index");</script>';
}

else {
//Validate Login Details///////////////////////////////////////////
			$sql = "SELECT * FROM invoice WHERE Username='".$_SESSION['Username']."' AND Status='Unpaid'";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) == 1) {
  					 header("location:unpaid");    		
					} 
			else {
				$invoice= 'invoice';
				session_start();
				$_SESSION['invoice']= $invoice;
    			header("location:gentwo");
				 }
}
mysqli_close($conn);
?>
