<?php session_start(); ?>
<?php

if (isset($_SESSION['Username'])) {
    
} else {
    header("location:Register");
}
?>
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
$Category = $_POST['Category'];
$Issue = $_POST['Issue'];
//Check if the Issue Text Area is empty
if (empty($Issue)) {
    echo "<script>window.location.href='supporterror'</script>";
} else {
    //Remove white spaces
    $Username = stripslashes($Username);
    $Date = stripslashes($Date);
    $Ticketid = stripslashes($Ticketid);
    $Status = stripslashes($Status);
    $Category = stripslashes($Category);
    $Issue = stripslashes($Issue);

    $email_from = isset($Username) ? $Username : 'support@bitminepool.com';
    // To protect MySQL injection (more detail about MySQL injection)
    $Username = mysqli_real_escape_string($conn, $_POST['Username']);
    $Date = mysqli_real_escape_string($conn, $_POST['Date']);
    $Ticketid = mysqli_real_escape_string($conn, $_POST['Ticketid']);
    $Status = mysqli_real_escape_string($conn, $_POST['Status']);
    $Category = mysqli_real_escape_string($conn, $_POST['Category']);
    $Issue = mysqli_real_escape_string($conn, $_POST['Issue']);

    // Inserting data into support table in the database
    $sql = "INSERT INTO support (Username, Date, Ticketid, Status, Category, Issue)VALUES('$Username','$Date','$Ticketid','$Status','$Category','$Issue')";
    mysqli_multi_query($conn, $sql);

    function clean_string($string) {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message = '
<html>
<head>
  <title>Bit Mine Pool Support ticket raised with id '.$Ticketid.' </title>
</head>
<body>
  <p>Here are the details of the ticket !</p>
  <table>
    <tr>
      <th>ID</th><th>Category</th><th>Username</th><th>Issue</th>
    </tr>
    <tr>
      <td>'.$Ticketid.'</td><td>'.$Category.'</td><td>'.$Username.'</td><td>'.$Issue.'</td>
    </tr>

  </table>
</body>
</html>
';

    $to = 'support@bitminepool.com';
    //$to = 'meettomangesh@gmail.com';
    $subject = "Bit Mine Pool Support Ticket - " . $Ticketid;
    //$message = $share['Token'];
// Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
    $headers .= "From: " . $email_from . " " . "\r\n" .
            "Reply-To: " . $email_from . " " . "\r\n" .
            "X-Mailer: PHP/" . phpversion();

// More headers
    $headers .= 'From: <' . $email_from . '>' . "\r\n";
//$headers .= 'Cc: mail.register@bitminepool.com' . "\r\n";

    $status = mail($to, $subject, $email_message, $headers);
//Success message
    header("location:supportreceived");

//Close connection

    mysqli_close($conn);
}
?>
