<?php
include('includes/header.php');

if (isset($_SESSION['Username']) && $_SESSION['is_prime_user'] == 1) {
////////////////////////////////////Get Data from Form////////////////////
$under_userid = $_POST['under_useridfive'];
$side = $_POST['sidefive'];
$Username = $_POST['Usernamefive'];
$userid = $_SESSION['Username'];

//////////////////////////////////////////////////////////////////////////
//
//////////////////////////Get User volume/////////////////////////////////
$volumes = mysqli_query($conn, "select Balance from teamvolume where Username='$Username'");
$myvolumes = mysqli_fetch_array($volumes);
$totalvolume = $myvolumes['Balance'];
$totalcredits = ($totalvolume / 300);

$referralCountQuery = mysqli_query($conn, "SELECT count(*) as referralCount FROM `users` where Sponsor='$userid' AND Status='Close'");
$referralCountArray = mysqli_fetch_array($referralCountQuery);
$referralCount = $referralCountArray['referralCount'];
} else {
    $_SESSION['error'] = 1;
    $_SESSION['message'] = 'Please login to proceed further.';
    unset($_POST);
    unset($_SESSION);
    //header("Location:login");
    $redirect = 'login';
    echo "<script>location='" . BASE_URL . $redirect . "'</script>";
    exit;
}
?>
    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <img src="images/logo.png" alt="Bitc-Mine-Pool">
                        <form action="tree.php?search-id=<?php echo $under_userid ?>" method="post">
                            <h1 class="style2">Member Status</h1>
                            <?php
                            //////////////////////////////Check if user has been selected/////////////
                            if ($Username == 'Choose Member') {
                                ?> 
                                <i class="fa fa-times text-danger"></i>
                                <h1 class="style1">Choose User</h1>


                                <?php
                            }
                            //////////////////////////////////////////////////////////////////////////
                            //////////////////////Update Tree/////////////////////////////////////////
                            else {
                                $query = mysqli_query($conn, "insert into user(`Username`,`under_userid`,`side`) values('$Username','$under_userid','$side')");
                                $query = mysqli_query($conn, "insert into tree(`userid`) values('$Username')");
                                $query = mysqli_query($conn, "update tree set `$side`='$Username' where userid='$under_userid'");
                                $query = mysqli_query($conn, "update users set treestatus='tree' where Username='$Username'");
                                //////////////////////////Update Count///////////////////////////////////////////
                                $temp_under_userid = $under_userid;
                                $temp_side_count = $side . 'count'; //leftcount or rightcount
                                $temp_side_credits = $side . 'credits'; //leftcredits or rightcredits
                                if ($referralCount == 6) {
                                    $query = mysqli_query($conn, "Update `rank` SET Rank='Dealer', Rankid='2' where Username='$userid' AND Rankid='1'");
                                }
                                $temp_side = $side;
                                $total_count = 1;
                                $i = 1;
                                while ($total_count > 0) {
                                    $i;
                                    $q = mysqli_query($conn, "select * from tree where userid='$temp_under_userid'");
                                    $r = mysqli_fetch_array($q);
                                     //$current_temp_side_count = $r[$temp_side_count] + $totalvolume;
                                    $current_temp_side_count = $r[$temp_side_count] + 1;
                                    $current_temp_side_credits = $r[$temp_side_credits] + $totalcredits;
                                    $temp_under_userid;
                                    $temp_side_count;
                                    $temp_side_credits;
                                    //get payment capping per user
                                    $getrankone = "SELECT * FROM rank WHERE Username = '$temp_under_userid'";
                                    $queryrankone = mysqli_query($conn, $getrankone);
                                    $rankone = mysqli_fetch_array($queryrankone);
                                    $myrankid = $rankone['Rankid'];
                                    if ($myrankid == 1) {
                                        $capping = 800;
                                    } elseif ($myrankid == 2) {
                                        $capping = 1000;
                                    } elseif ($myrankid == 3) {
                                        $capping = 1200;
                                    } elseif ($myrankid == 4) {
                                        $capping = 1400;
                                    } elseif ($myrankid == 5) {
                                        $capping = 1600;
                                    } elseif ($myrankid == 6) {
                                        $capping = 2000;
                                    } else {
                                        $capping = 2000;
                                    }
                                    //Get volumes/////////////////////////////////
                                    $uservolumes = mysqli_query($conn, "select Balance from teamvolume where Username='$temp_under_userid'");
                                    $myuservolumes = mysqli_fetch_array($uservolumes);
                                    $totaluservolume = $myuservolumes['Balance'];
                                    $newuservolumes = ($totaluservolume + $totalvolume);
                                    //update tree
                                    mysqli_query($conn, "update tree set `$temp_side_count`=$current_temp_side_count where userid='$temp_under_userid'");
                                    mysqli_query($conn, "update tree set `$temp_side_credits`=$current_temp_side_credits where userid='$temp_under_userid'");
                                    mysqli_query($conn, "update teamvolume set Balance ='$newuservolumes' where Username='$temp_under_userid'");
                                    if ($temp_under_userid != "") {
                                        $income_data = income($temp_under_userid);
                                        //check capping
                                        //$income_data['day_bal'];
                                        if ($income_data['day_bal'] < $capping) {
                                            $tree_data = tree($temp_under_userid);

                                            //check leftplusright
                                            //$tree_data['leftcount'];
                                            //$tree_data['rightcount'];
                                            //$leftplusright;

                                            $temp_left_count = $tree_data['leftcredits'];
                                            $temp_right_count = $tree_data['rightcredits'];
                                            //Both left and right side should at least 1 credit
                                            if ($temp_left_count > 0 && $temp_right_count > 0) {
                                                if ($temp_side == 'left') {
                                                    $temp_left_count;
                                                    $temp_right_count;
                                                    if ($temp_left_count <= $temp_right_count) {
                                                        $creditamountleft = ($temp_left_count * 10);
                                                        $binaryamount = ($creditamountleft * 2);
                                                        $newrightcredits = ($temp_right_count - $temp_left_count);
                                                        $newleftcredits = 0;
                                                        $new_day_bal = $income_data['day_bal'] + $binaryamount;
                                                        $new_current_bal = $income_data['current_bal'] + $binaryamount;
                                                        $new_total_bal = $income_data['total_bal'] + $binaryamount;
                                                        mysqli_query($conn, "update tree set leftcredits='$newleftcredits' where userid='$temp_under_userid'");
                                                        mysqli_query($conn, "update tree set rightcredits='$newrightcredits' where userid='$temp_under_userid'");
                                                        //update income
                                                        mysqli_query($conn, "update binaryincome set day_bal='$new_day_bal', current_bal='$new_current_bal', total_bal='$new_total_bal' where userid='$temp_under_userid' limit 1");
                                                    }
                                                } else {
                                                    if ($temp_right_count <= $temp_left_count) {
                                                        $creditamountright = ($temp_right_count * 10);
                                                        $binaryamount = ($creditamountright * 2);
                                                        $newleftcredits = ($temp_left_count - $temp_right_count);
                                                        $newrightcredits = 0;
                                                        $new_day_bal = $income_data['day_bal'] + $binaryamount;
                                                        $new_current_bal = $income_data['current_bal'] + $binaryamount;
                                                        $new_total_bal = $income_data['total_bal'] + $binaryamount;
                                                        mysqli_query($conn, "update tree set rightcredits='$newrightcredits' where userid='$temp_under_userid'");
                                                        mysqli_query($conn, "update tree set leftcredits='$newleftcredits' where userid='$temp_under_userid'");
                                                        $temp_under_userid;
                                                        //update income
                                                        if (mysqli_query($conn, "update binaryincome set day_bal='$new_day_bal', current_bal='$new_current_bal', total_bal='$new_total_bal' where userid='$temp_under_userid'")) {
                                                            
                                                        }
                                                    }
                                                }
                                            }//Both left and right side should at least 1 user
                                        }
                                        //change under_userid
                                        $next_under_userid = getUnderId($temp_under_userid);
                                        $temp_side = getUnderIdPlace($temp_under_userid);
                                        $temp_side_count = $temp_side . 'count';
                                        $temp_side_credits = $temp_side . 'credits';
                                        $temp_under_userid = $next_under_userid;

                                        $i++;
                                    }
                                    if ($temp_under_userid == "") {
                                        $total_count = 0;
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
                            function getUnderId($userid) {
                                global $conn;
                                $query = mysqli_query($conn, "select * from user where Username='$userid'");
                                $result = mysqli_fetch_array($query);
                                return $result['under_userid'];
                            }

                            //////////////////////////////////////
                            function getUnderIdPlace($userid) {
                                global $conn;
                                $query = mysqli_query($conn, "select * from user where Username='$userid'");
                                $result = mysqli_fetch_array($query);
                                return $result['side'];
                            }

                            //////////////////////////////////////////
                            function income($userid) {
                                global $conn;
                                $data = array();
                                $query = mysqli_query($conn, "select * from binaryincome where userid='$userid'");
                                $result = mysqli_fetch_array($query);
                                $data['day_bal'] = $result['day_bal'];
                                $data['current_bal'] = $result['current_bal'];
                                $data['total_bal'] = $result['total_bal'];
                                return $data;
                            }

                            function tree($userid) {
                                global $conn;
                                $data = array();
                                $query = mysqli_query($conn, "select * from tree where userid='$userid'");
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
