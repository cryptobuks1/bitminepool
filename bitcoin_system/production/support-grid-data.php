<?php session_start(); ?>
<?php
include('includes/constant.php');

$response['data'] = $temp= [];

// Create connection
$conn = new mysqli(DB_SERVER_NAME, DB_USER_NAME, DB_PASSWORD, DB_NAME);


$getSupportTicketsQuery = "SELECT * FROM support WHERE Username = '".$_SESSION['Username']."'";

$result = $conn->query($getSupportTicketsQuery);

if ($result->num_rows > 0) {
    // output data of each row
    $i = 0;
    while($row = $result->fetch_assoc()) {
        
        foreach ($row as $key=>$value){
            $temp[$i][] = $value;
            }
        $i++;
    }
    
}

$response = array('data'=>$temp);
$conn->close();
echo json_encode($response);
exit;
?>
