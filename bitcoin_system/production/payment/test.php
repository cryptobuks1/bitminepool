
<?php
									$servername = "localhost";
									$username = "edwindb";
									$password = "0720226275";
									$database = "minehub";
									// Create connection
									$conn = mysqli_connect($servername, $username, $password, $database);
									// Check connection
									if (!$conn) {
    								die("Connection failed: " . mysqli_connect_error());
									}
								


								$Starterdate1= "SELECT MiningDate FROM starterpack WHERE Username='Jamin'";
								$querystarter1 = mysqli_query($conn, $Starterdate1);
								$viewstarter1 = mysqli_fetch_array($querystarter1);
								$showstarterdate1 = $viewstarter1['MiningDate'];
								$Currentmining1 = date('Y-m-d', strtotime('-1 days'));
$querysum = "select sum(Usd)as total from dailymine where Pack='Starter' and Date Between '$showstarterdate1' AND '$Currentmining1'";
$querytotal = mysqli_query($conn, $querysum);
$viewtotal = mysqli_fetch_array($querytotal);
$totalmine = $viewtotal['total'];
			echo $totalmine;
			echo $showstarterdate1;

mysqli_close($conn);
?>