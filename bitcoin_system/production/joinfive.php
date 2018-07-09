<?php session_start();
if (isset($_SESSION['mainuser'])){ echo ' '; } else{ header("location:login");}
?>
<?php
///////////////////////////////////Connect Database///////////////////////
include('includes/dbconnect.php');
//////////////////////////////////////////////////////////////////////////

//////////////////////////Get User volume/////////////////////////////////
$volumes = mysqli_query($conn,"select Balance from teamvolume where Username='$Username'");
$myvolumes = mysqli_fetch_array($volumes);
$totalvolume = $myvolumes['Balance'];
$totalcredits = ($totalvolume/300);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bitcoin Mine-Hub | Success</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">
	 <link rel="icon" href="images/favicon.ico" type="image/ico" sizes="32x32">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <style type="text/css">
<!--
.style2 {
	color: #009900;
	font-weight: bold;
}
.style3 {
	color: #006600;
	font-weight: bold;
}
-->
    </style>
</head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
          <img src="images/logo.png" alt="Bitcoin-Mine-Hub">
            <form action="tree.php?search-id=<?php echo $under_userid ?>" method="post">
              <h1 class="style2">Member Status</h1>
			  <?php
			  
			  //////////////////////////////Check if user has been selected/////////////
				if($Username=='Choose Member'){
					?> 
					<i class="fa fa-times text-danger"></i>
					<h1 class="style1">Choose User</h1>
					
					
					<?php
				}
				//////////////////////////////////////////////////////////////////////////

				//////////////////////Update Tree/////////////////////////////////////////
				
				else
				{
					$query = mysqli_query($conn,"insert into user(`Username`,`under_userid`,`side`) values('$Username','$under_userid','$side')");
					$query = mysqli_query($conn,"insert into tree(`userid`) values('$Username')");
					$query = mysqli_query($conn,"update tree set `$side`='$Username' where userid='$under_userid'");
					$query = mysqli_query($conn,"update users set treestatus='tree' where Username='$Username'");
				//////////////////////////Update Count///////////////////////////////////////////
				$temp_under_userid = $under_userid;
				$temp_side_count = $side.'count'; //leftcount or rightcount
				$temp_side_credits = $side.'credits'; //leftcredits or rightcredits
				
				$temp_side = $side;
				$total_count=1;
				$i=1;
				while($total_count>0){
					$i;
					$q = mysqli_query($conn,"select * from tree where userid='$temp_under_userid'");
					$r = mysqli_fetch_array($q);
					$current_temp_side_count = $r[$temp_side_count]+$totalvolume;
					$current_temp_side_credits = $r[$temp_side_credits]+$totalcredits;
					$temp_under_userid;
					$temp_side_count;
					$temp_side_credits;
					//get payment capping per user
					$getrankone= "SELECT * FROM rank WHERE Username = '$temp_under_userid'";
					$queryrankone = mysqli_query($conn, $getrankone);
					$rankone = mysqli_fetch_array($queryrankone);
					$myrankid=$rankone['Rankid'];
					if($myrankid==1){
						$capping=800;
					}elseif($myrankid==2){
						$capping=1000;
					}elseif($myrankid==3){
						$capping=1400;
					}else{
						$capping=1600;
					}
					//Get volumes/////////////////////////////////
					$uservolumes = mysqli_query($conn,"select Balance from teamvolume where Username='$temp_under_userid'");
					$myuservolumes = mysqli_fetch_array($uservolumes);
					$totaluservolume = $myuservolumes['Balance'];
					$newuservolumes= ($totaluservolume+$totalvolume);
					//update tree
					mysqli_query($conn,"update tree set `$temp_side_count`=$current_temp_side_count where userid='$temp_under_userid'");
					mysqli_query($conn,"update tree set `$temp_side_credits`=$current_temp_side_credits where userid='$temp_under_userid'");
					mysqli_query($conn,"update teamvolume set Balance ='$newuservolumes' where Username='$temp_under_userid'");
					if($temp_under_userid!=""){
						$income_data = income($temp_under_userid);
							//check capping
							//$income_data['day_bal'];
							if($income_data['day_bal']<$capping){
									$tree_data = tree($temp_under_userid);
									
									//check leftplusright
									//$tree_data['leftcount'];
									//$tree_data['rightcount'];
									//$leftplusright;
									
									$temp_left_count = $tree_data['leftcredits'];
									$temp_right_count = $tree_data['rightcredits'];
									//Both left and right side should at least 1 credit
									if($temp_left_count>0 && $temp_right_count>0){
										if($temp_side=='left'){
											$temp_left_count;
											$temp_right_count;
											if($temp_left_count<=$temp_right_count){
												$creditamountleft=($temp_left_count*10);
												$binaryamount=($creditamountleft*2);
												$newrightcredits=($temp_right_count-$temp_left_count);
												$newleftcredits=0;
												$new_day_bal = $income_data['day_bal']+$binaryamount;
												$new_current_bal = $income_data['current_bal']+$binaryamount;
												$new_total_bal = $income_data['total_bal']+$binaryamount;
												mysqli_query($conn,"update tree set leftcredits='$newleftcredits' where userid='$temp_under_userid'");
												mysqli_query($conn,"update tree set rightcredits='$newrightcredits' where userid='$temp_under_userid'");
												//update income
												mysqli_query($conn,"update binaryincome set day_bal='$new_day_bal', current_bal='$new_current_bal', total_bal='$new_total_bal' where userid='$temp_under_userid' limit 1");	
											
											}
										}
										else{
											if($temp_right_count<=$temp_left_count){
												$creditamountright=($temp_right_count*10);
												$binaryamount=($creditamountright*2);
												$newleftcredits=($temp_left_count-$temp_right_count);
												$newrightcredits=0;
												$new_day_bal = $income_data['day_bal']+$binaryamount;
												$new_current_bal = $income_data['current_bal']+$binaryamount;
												$new_total_bal = $income_data['total_bal']+$binaryamount;
												mysqli_query($conn,"update tree set rightcredits='$newrightcredits' where userid='$temp_under_userid'");
												mysqli_query($conn,"update tree set leftcredits='$newleftcredits' where userid='$temp_under_userid'");
												$temp_under_userid;
												//update income
												if(mysqli_query($conn,"update binaryincome set day_bal='$new_day_bal', current_bal='$new_current_bal', total_bal='$new_total_bal' where userid='$temp_under_userid'")){
													
												}
											}
										}
									}//Both left and right side should at least 1 user
									
								}
							//change under_userid
						$next_under_userid = getUnderId($temp_under_userid);
						$temp_side = getUnderIdPlace($temp_under_userid);
						$temp_side_count = $temp_side.'count';
						$temp_side_credits = $temp_side.'credits';
						$temp_under_userid = $next_under_userid;	
						
						$i++;
						}
					if($temp_under_userid==""){
					$total_count=0;
					}
				}
				
				/////////////////////////////////////////////////////////////////////////////////
					
					?>
					
					<i class="fa fa-check text-success"></i>
					<h5 class="style3">Success!</h5>
					
					<?php
				}
				?>
              <?php 
			  //////////Functions/////////////
			  function getUnderId($userid){
				global $conn;
				$query = mysqli_query($conn,"select * from user where Username='$userid'");
				$result = mysqli_fetch_array($query);
				return $result['under_userid'];
					}
			  //////////////////////////////////////
			 function getUnderIdPlace($userid){
				global $conn;
				$query = mysqli_query($conn,"select * from user where Username='$userid'");
				$result = mysqli_fetch_array($query);
				return $result['side'];
				}
			 //////////////////////////////////////////
			function income($userid){
				global $conn;
				$data = array();
				$query = mysqli_query($conn,"select * from binaryincome where userid='$userid'");
				$result = mysqli_fetch_array($query);
				$data['day_bal'] = $result['day_bal'];
				$data['current_bal'] = $result['current_bal'];
				$data['total_bal'] = $result['total_bal'];
				return $data;
				}
			function tree($userid){
				global $conn;
				$data = array();
				$query = mysqli_query($conn,"select * from tree where userid='$userid'");
				$result = mysqli_fetch_array($query);
				$data['left'] = $result['left'];
				$data['right'] = $result['right'];
				$data['leftcount'] = $result['leftcount'];
				$data['rightcount'] = $result['rightcount'];
				$data['leftcredits'] = $result['leftcredits'];
				$data['rightcredits'] = $result['rightcredits'];
				return $data;
				}
			  ?>

              <div class="clearfix"></div>

              <div class="separator">
                

                <div class="clearfix"></div>
                <br />

                <div>
                  <button type="submit" class="btn btn-primary">View Placement</button>
                </div>
              </div>
            </form>
          </section>
        </div>

       
      </div>
    </div>
  </body>
</html>
