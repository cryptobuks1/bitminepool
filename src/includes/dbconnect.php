<?php
include('constant.php');
///////////////////////////////////////////Connection to Database///////////////////////////////////////////////////////////
									$servername = DB_SERVER_NAME;
									//$username = "edwindb";
									$username = DB_USER_NAME;
									//$password = "0720226275";
									$password = DB_PASSWORD;
									$database = DB_NAME;
									// Create connection
									$conn = mysqli_connect($servername, $username, $password, $database);
									// Check connection
									if (!$conn) {
    								die("Connection failed: " . mysqli_connect_error());
									}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
