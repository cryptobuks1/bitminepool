<?php session_start();?>
<?php if (isset($_SESSION['Username'])) { 
 } else{ header("location:Register");}?>
<?php
///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
include('includes/dbconnect.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
// information sent from form 
///////////////////////////////////////////////Validate Form/////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 $Username = $_POST['Username'];
 $Date = $_POST['Date'];
 $Ticketid = $_POST['Ticketid'];
 $Status = $_POST['Status'];
 $Category= $_POST['Category'];
 $Issue= $_POST['Issue'];
 //Check if the Issue Text Area is empty
 if(empty($Issue)) {
    echo "<script>window.location.href='supporterror'</script>";
	}
 else {
 //Remove white spaces
 $Username= stripslashes($Username);
 $Date = stripslashes($Date);
 $Ticketid = stripslashes($Ticketid);
 $Status = stripslashes($Status);
 $Category = stripslashes($Category);
 $Issue = stripslashes($Issue);
 // To protect MySQL injection (more detail about MySQL injection)
 $Username = mysqli_real_escape_string($conn, $_POST['Username']);
 $Date = mysqli_real_escape_string($conn, $_POST['Date']);
 $Ticketid = mysqli_real_escape_string($conn, $_POST['Ticketid']);
 $Status = mysqli_real_escape_string($conn, $_POST['Status']);
 $Category = mysqli_real_escape_string($conn, $_POST['Category']);
 $Issue= mysqli_real_escape_string($conn, $_POST['Issue']);

 // Inserting data into support table in the database
		$sql="INSERT INTO support (Username, Date, Ticketid, Status, Category, Issue)							  																																																																								        VALUES('$Username','$Date','$Ticketid','$Status','$Category','$Issue')";		
 		mysqli_multi_query($conn, $sql);
//Success message
    	header("location:supportreceived");

//Close connection
  
mysqli_close($conn);
}
?>
