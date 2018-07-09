<?php session_start();?>
<?php
///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
include('includes/dbconnect.php');
////////////////////////////////////////////////////Information Sent From Form//////////////////////////////////////////////
 $name = $_POST['name'];
 $email = $_POST['email'];
 $Telephone = $_POST['Telephone'];
 $password= $_POST['password'];
 $Sponsor= $_POST['Sponsor'];
 $id = $_POST['id'];
 ////////////////////////////////////////////////////form validation//////////////////////////////////////////////////////////
  if(empty($name)) {
    echo "<script>window.location.href='errorprofile'</script>";
	}
 elseif(empty($email)) {
 	 echo "<script>window.location.href='errorprofile'</script>";
 	}
 elseif(empty($Telephone)) {
 	 echo "<script>window.location.href='errorprofile'</script>";
 	}
 elseif(empty($password)) {
 	 echo "<script>window.location.href='errorprofile'</script>";
 	}
 elseif(empty($Sponsor)) {
 	 echo "<script>window.location.href='errorprofile'</script>";
 	}
 else {
 //Remove white spaces
 $name= stripslashes($name);
 $email = stripslashes($email);
 $Telephone = stripslashes($Telephone);
 $password = stripslashes($password);
 $Sponsor = stripslashes($Sponsor);
 // To protect MySQL injection (more detail about MySQL injection)
 $name = mysqli_real_escape_string($conn, $_POST['name']);
 $email = mysqli_real_escape_string($conn, $_POST['email']);
 $Telephone = mysqli_real_escape_string($conn, $_POST['Telephone']);
 $password = mysqli_real_escape_string($conn, $_POST['password']);
 $Sponsor= mysqli_real_escape_string($conn, $_POST['Sponsor']);
 //Check wether the username Telephone Email or Idnumber exists before registering
 $query = "SELECT Username FROM users WHERE Username='$Username'";
 $result = mysqli_query($conn, $query);
 $querya = "SELECT Username FROM users WHERE email='$email'";
 $resulta = mysqli_query($conn, $querya);
 $queryb = "SELECT Username FROM users WHERE Telephone='$Telephone'";
 $resultb = mysqli_query($conn, $queryb);
 $queryd = "SELECT Username FROM users WHERE Username='$Sponsor'";
 $resultd = mysqli_query($conn, $queryd);
 //Check wether Username exists
 		if (mysqli_num_rows($result) > 0) 
			 {
    		 echo "<script>window.location.href='userexist.php'</script>";
 			 }
  //Check wether Email exists
		elseif(mysqli_num_rows($resulta) > 0) 
  			{
    		echo "<script>window.location.href='emailexist.php'</script>";
  			}
 //Check wether Telephone Number exists			
		elseif (mysqli_num_rows($resultb) > 0) 
			{
 			echo "<script>window.location.href='telexist.php'</script>";
 			}
 //Check wether Idnumber exists	
		elseif (mysqli_num_rows($resultd) > 0) 
		{
 // Inserting data into users table in the database
		$sqlv = "UPDATE users SET Fullname='$name', Email='$email', Telephone='$Telephone', Password='$password', Sponsor='$Sponsor' WHERE id ='".$id."'";
		mysqli_query($conn, $sqlv);			
//Start email Session
    header("location:profile");
	}
//if Sponsor does not exist
  else 
  	{
 	 echo "<script>window.location.href='invalidcode.php'</script>";
	}
mysqli_close($conn);
}
?>
