<?php
include('includes/header.php');

if (isset($_SESSION['Username']) && $_SESSION['is_prime_user'] == 1) {

    $_SESSION['error'] = 0;
    $walletData = [];
    $userName = $_SESSION['Username'];
    $search_id = '';

    function tree_data($userid) {
        $searchUserTreeData = [];
        $responseSearchUser = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                'user_name' => $userid,
                'platform' => '3',
                'transaction_type' => '301'
                ], 'getAllUserDataByUserName');

        $responseSearchUser = json_decode($responseSearchUser);

        if ($responseSearchUser->statusCode == 100) {
            $searchUserTreeData = $responseSearchUser->response;
        }
        return $searchUserTreeData;
    }

    if (isset($_GET['search-id']) && !empty($_GET['search-id'])) {

        $search_id = $_GET['search-id'];
        $searchUserData = [];
        $responseSearchUser = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                'user_name' => $search_id,
                'platform' => '3',
                'transaction_type' => '301'
                ], 'getAllUserDataByUserName');

        $responseSearchUser = json_decode($responseSearchUser);

        if ($responseSearchUser->statusCode == 100) {
            $searchUserData = $responseSearchUser->response->user_data;
        }
    }

    if (!empty($_POST)) {

        $response = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                'parent_user' => $_POST['parent_user'],
                'side' => $_POST['side'],
                'user_name' => $_POST['user_name'],
                'platform' => '3',
                'transaction_type' => '601'
                //'grant_type' => 'client_credentials'
                ], 'joinTree');

        $response = json_decode($response);
        $redirect = 'tree_api?search-id='.$_POST['parent_user'];
        if ($response->statusCode == 100) {
            $_SESSION['error'] = 0;
            $_SESSION['message'] = $response->statusDescription;
            // $redirect = 'logout';
            $_SESSION['Username'] = $_POST['Username'];
        } else {
            $_SESSION['error'] = 1;
            $_SESSION['message'] = $response->statusDescription;
        }
        unset($_POST);
        //header("Location:" . $redirect);
        echo "<script>location='" . BASE_URL . $redirect . "'</script>";
        exit;
    }
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
$userid = $_SESSION['Username'];
$search = (!empty($search_id)) ? $search_id : $userid;

function getTreeDataFromReg($setid) {
    global $conn;
    $tempArr = [];
    if (!empty($setid)) {
        //for ($in = 0; $in < 7; $in++) {
        if ($setid != '') {
            $query = mysqli_query($conn, "select * from tree where userid='$setid'");
            $result = mysqli_fetch_array($query);

            $leftid = $result['left'];
            $rightid = $result['right'];
        } else {
            $leftid = '';
            $rightid = '';
        }
        //$tempArr[$setid] = array('left'=>getTreeDataFromReg($leftid),'right'=>getTreeDataFromReg($rightid));
        $tempArr[$setid] = array('left' => getTreeDataFromReg($leftid), 'right' => getTreeDataFromReg($rightid));
    }
    return $tempArr;
}

function createTreeDataFromReg($setid) {

    $data = tree_data($setid);
    //echo ''.$setid;
    $str = '';
    $str .= "<ul>
            <li>
            <a href = 'tree_api.php?search-id=" . $setid . "'><img class = 'img-rounded' id = 'avatar' src = " . (($data->user_data->Gender == 1) ? '../images/useravatar.png' : '../images/useravatarf.png') . "></a><br>
    <span>" . $setid . "</span><br>
    <span>Rank: " . $data->rank_data->Rank . "</span>";
    $str .= "<ul>
                <li>";

    if (empty($data->tree_data->left)) {
        $str .= "
            <form action='' method='POST' >
            <img class='img-rounded' id='avatar' src='../images/useravatarn.png'>
            <br><br>
            <span> 
                <select name='user_name' style='padding-bottom: 5px;'>
                    <option>Choose a member</option>";
        foreach ($data->child_node_data as $row1) {
            $str .= "<option value='" . $row1->Username . "'>" . $row1->Username . "</option>";
        }
        $str .= "</select>&nbsp;&nbsp;
                <input type='hidden' name='under_user' id='under_user' value='" . $setid . "'>
                <input type='hidden' name='side' id='side' value='left'>
                <button type='submit' id='button[]' class='btn btn-sm btn-outline-danger'>Add Member</button>
            </form>
            </span>";
    } else {
        $str .= createTreeDataFromReg($data->tree_data->left);
    }

    $str .= "</li>
                <li>";
    if (empty($data->tree_data->right)) {
        $str .= "
            <form action='' method='POST' >
            <img class='img-rounded' id='avatar' src='../images/useravatarn.png'>
            <br><br>
            <span> 
                <select name='user_name' style='padding-bottom: 5px;'>
                    <option>Choose a member</option>";
        foreach ($data->child_node_data as $row1) {
            $str .= "<option value='" . $row1->Username . "'>" . $row1->Username . "</option>";
        }
        $str .= "</select>&nbsp;&nbsp;
                <input type='hidden' name='under_user' id='under_user' value='" . $setid . "'>
                <input type='hidden' name='side' id='side' value='right'>
                <button type='submit' id='button[]' class='btn btn-sm btn-outline-danger'>Add Member</button>
            </form>
            </span>";
    } else {
        $str .= createTreeDataFromReg($data->tree_data->right);
    }
    $str .= "</li> 
            </ul>

    </li>
    </ul>";
    return $str;
}

$mainTreedata = getTreeDataFromReg($search);
?>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo BASE_URL; ?>" class="site_title"> <span><img src="../images/logo.png" alt="Bit-Mine-Pool" style="width: 95px;"></span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <a href="<?php echo BASE_URL; ?>"><img src="../images/img.jpg" alt="..." class="img-circle profile_img"></a>              </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo ' ' . strlen($userName) > 15 ? substr($userName, 0, 15) . "..." : $userName; ?></h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

<?php include('includes/menu.php'); ?>

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.php">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>


<?php include('includes/guestheader.php'); ?>
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Binary Tree</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <!-- Search -->
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <form>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="search-id" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <input type="submit" name="search" class="btn btn-primary" value="Search">
                                                <a href="tree" class="btn btn-primary" role="button">Go to<span> Top</span></a>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="col-lg-2"></div>
                                </div>
                                <!-- /Search -->
                                <div class="row">
                                    <div class="col-lg-12 tree">
<?php
echo createTreeDataFromReg($search);
?>
                                    </div>
                                </div>
                                <!-- Binary Tree -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table" align="center" border="0" style="text-align:center">
                                                <tr height="150">
<?php
$data = tree_data($search);
?>
                                                    <td><b class="fa fa-database" style="color:#1430B1"> Left Volume: $<?php echo $data['leftcount'] ?></b><p><b class="fa fa-money" style="color:#1430B1"> Left Credits: <?php echo $data['leftcredits'] ?></p></b></td>
                                                    <td colspan="2">

                                                        <!-- change image according to gender -->
<?php
if ($data->user_data->Gender == 1) {
    ?><img src="../images/useravatar.png" alt=""><?php
                                                        } else {
                                                            ?>
                                                            <img src="../images/useravatarf.png" alt=""><?php
                                                        }
                                                        ?>
                                                        <!-- //change image according to gender -->

                                                        <p><?php echo $search; ?></p><p><i class="fa fa-graduation-cap" style="color:#361515"></i>Rank: 
                                                            <!-- Get Rank -->
<?php
$myrankone = $data->rank_data->Rank;
$myrankid = $data->rank_data->Rankid;
echo $myrankone;
?>
                                                            <!-- //Get Rank -->
                                                        </p></td>
                                                    <td><b class="fa fa-database" style="color:#1430B1"> Right Volume: $<?php echo $data['rightcount'] ?></b><p><b class="fa fa-money" style="color:#1430B1"> Rights Credits: <?php echo $data['rightcredits'] ?></p></b></td>
                                                </tr>
                                                <tr height="150">
<?php
$first_left_user = $data->tree_data->left;
$first_right_user = $data->tree_data->right;
$data_left_credits = tree_data($first_left_user);
$first_left_credits = $data_left_credits->tree_data->leftcredits;
$first_right_credits = $data_left_credits->tree_data->rightcredits;
$data_right_credits = tree_data($first_right_user);
$first_leftuser_credits = $data_right_credits->tree_data->leftcredits;
$first_rightuser_credits = $data_right_credits->tree_data->rightcredits;
?>
                                                    <?php
                                                    if ($first_left_user != "") {
                                                        ?>
                                                        <td colspan="2"><a href="tree_api.php?search-id=<?php echo $first_left_user ?>">

                                                                <!-- change image according to gender -->
    <?php
    /* $getgendertwo = "SELECT Gender FROM users WHERE Username = '$first_left_user'";
      $querygendertwo = mysqli_query($conn, $getgendertwo);
      $gendertwo = mysqli_fetch_array($querygendertwo);
      $mygendertwo = $gendertwo['Gender']; */
    if ($data_left_credits->user_data->Gender == 1) {
        ?><img src="../images/useravatar.png" alt=""><?php
                                                                } else {
                                                                    ?>
                                                                    <img src="../images/useravatarf.png" alt=""><?php
                                                                }
                                                                ?>
                                                                <!-- //change image according to gender -->

                                                                </i><p><?php echo $first_left_user ?></p><p><i class="fa fa-graduation-cap" style="color:#361515"></i>Rank: 
                                                                    <!-- Get Rank -->
    <?php
    //$getranktwo = "SELECT * FROM rank WHERE Username = '$first_left_user'";
    //$queryranktwo = mysqli_query($conn, $getranktwo);
    //$ranktwo = mysqli_fetch_array($queryranktwo);
    $myranktwo = $data_left_credits->rank_data->Rank;
    $myrankidtwo = $data_left_credits->rank_data->Rankid;
    echo $myranktwo;
    ?>
                                                                    <!-- //Get Rank -->

                                                                </p><p><i class="fa fa-money" style="color:#361515"></i>  Left Credits: <?php echo $first_left_credits ?><p><i class="fa fa-money" style="color:#361515"></i> Right Credits: <?php echo $first_right_credits ?></p></p></a></td>
    <?php
} else {
    ?>
                                                        <td colspan="2"><img src="../images/useravatarn.png"><p><form action="join.php" method="post">
                                                        <?php
                                                        //$query1 = "SELECT * FROM users WHERE Sponsor = '" . $_SESSION['Username'] . "' AND Status='Close' AND treestatus='notree'";
                                                        //$result1 = mysqli_query($conn, $query1);
                                                        ?>
                                                                <select  name="Usernameone" id="Usernameone" onchange="">
                                                                    <option>Choose Member</option>
    <?php foreach ($data->child_node_data as $row1) { ?>
                                                                        <option value="<?php echo $row1->Username; ?>"><?php echo $row1->Username; ?></option>
                                                                    <?php } ?>

                                                                </select>
                                                                <input type="hidden" name="under_userid" id="under_userid" value="<?php echo $search; ?>">
                                                                <input type="hidden" name="side" id="side" value="left">
                                                                <button id="join_user" type="submit" class="btn btn-primary">Add Member</button> </form></p></td>
    <?php
}
?>
                                                    <?php
                                                    if ($first_right_user != "") {
                                                        ?>
                                                        <td colspan="2"><a href="tree_api.php?search-id=<?php echo $first_right_user ?>">

                                                                <!-- change image according to gender -->
    <?php
    // $getgenderthree = "SELECT Gender FROM users WHERE Username = '$first_right_user'";
    //$querygenderthree = mysqli_query($conn, $getgenderthree);
    //$genderthree = mysqli_fetch_array($querygenderthree);
    $mygenderthree = $data_right_credits->user_data->Gender;
    if ($mygenderthree == 1) {
        ?><img src="../images/useravatar.png" alt=""><?php
                                                                } else {
                                                                    ?>
                                                                    <img src="../images/useravatarf.png" alt=""><?php
                                                                }
                                                                ?>
                                                                <!-- //change image according to gender -->

                                                                </i><p><?php echo $first_right_user ?></p><p><i class="fa fa-graduation-cap" style="color:#361515"></i>Rank: 
                                                                    <!-- Get Rank -->
    <?php
    //$getrankthree = "SELECT * FROM rank WHERE Username = '$first_right_user '";
    //$queryrankthree = mysqli_query($conn, $getrankthree);
    //$rankthree = mysqli_fetch_array($queryrankthree);
    $myrankthree = $data_right_credits->rank_data->Rank;
    $myrankidthree = $data_right_credits->rank_data->Rankid;
    echo $myrankthree;
    ?>
                                                                    <!-- //Get Rank -->
                                                                </p><p><i class="fa fa-money" style="color:#361515"></i>  Left Credits: <?php echo $first_leftuser_credits ?><p><i class="fa fa-money" style="color:#361515"></i> Right Credits: <?php echo $first_rightuser_credits ?></p></p></a></td>
    <?php
} else {
    ?>
                                                        <td colspan="2"><img src="../images/useravatarn.png"><p><form action="jointwo.php" method="post"><?php
                                                        //  $query1 = "SELECT * FROM users WHERE Sponsor = '" . $_SESSION['Username'] . "' AND Status='Close' AND treestatus='notree'";
                                                        //      $result1 = mysqli_query($conn, $query1);
                                                        ?>
                                                                <select  name="Usernametwo" id="Usernametwo" onchange="">
                                                                    <option>Choose Member</option>
    <?php foreach ($data->child_node_data as $row1) { ?>
                                                                        <option value="<?php echo $row1->Username; ?>"><?php echo $row1->Username; ?></option>
                                                                    <?php } ?>

                                                                </select>
                                                                <input type="hidden" name="under_useridtwo" id="under_useridtwo" value="<?php echo $search; ?>">
                                                                <input type="hidden" name="sidetwo" id="sidetwo" value="right">
                                                                <button id="join_usertwo" type="submit" class="btn btn-primary">Add Member</button></form></p></td>
    <?php
}
?>
                                                </tr>
                                                <tr height="150">
<?php
$data_first_left_user = tree_data($first_left_user);
$second_left_user = $data_first_left_user->tree_data->left;
$second_right_user = $data_first_left_user->tree_data->right;
$data_first_right_user = tree_data($first_right_user);
$third_left_user = $data_first_right_user->tree_data->left;
$thidr_right_user = $data_first_right_user->tree_data->right;

$data_first_left_credits = tree_data($second_left_user);
$user_first_left_credits = $data_first_left_credits->tree_data->leftcredits;
$user_first_right_credits = $data_first_left_credits->tree_data->rightcredits;

$data_first_right_credits = tree_data($second_right_user);
$usertwo_first_left_credits = $data_first_right_credits->tree_data->leftcredits;
$usertwo_first_right_credits = $data_first_right_credits->tree_data->rightcredits;

$thirdcredits = tree_data($third_left_user);
$userthree_first_left_credits = $thirdcredits->tree_data->leftcredits;
$userthree_first_right_credits = $thirdcredits->tree_data->rightcredits;

$fourthcredits = tree_data($thidr_right_user);
$userfour_first_left_credits = $fourthcredits->tree_data->leftcredits;
$userfour_first_right_credits = $fourthcredits->tree_data->rightcredits;
?>
                                                    <?php
                                                    if ($second_left_user != "") {
                                                        ?>
                                                        <td><a href="tree_api.php?search-id=<?php echo $second_left_user ?>">

                                                                <!-- change image according to gender -->
    <?php
    $getgenderfour = "SELECT Gender FROM users WHERE Username = '$second_left_user'";
    //$querygenderfour = mysqli_query($conn, $getgenderfour);
    //$genderfour = mysqli_fetch_array($querygenderfour);
    $mygenderfour = $data_first_left_credits->user_data->Gender;
    if ($mygenderfour == 1) {
        ?><img src="../images/useravatar.png" alt=""><?php
                                                                } else {
                                                                    ?>
                                                                    <img src="../images/useravatarf.png" alt=""><?php
                                                                }
                                                                ?>
                                                                <!-- //change image according to gender -->

                                                                <p><?php echo $second_left_user ?></p><p><i class="fa fa-graduation-cap" style="color:#361515"></i>Rank: 
                                                                    <!-- Get Rank -->
    <?php
    $getrankfour = "SELECT * FROM rank WHERE Username = '$second_left_user'";
    $queryrankfour = mysqli_query($conn, $getrankfour);
    $rankfour = mysqli_fetch_array($queryrankfour);
    $myrankfour = $rankfour['Rank'];
    $myrankidfour = $rankfour['Rankid'];
    echo $myrankfour;
    ?>
                                                                    <!-- //Get Rank -->

                                                                </p><p><i class="fa fa-money" style="color:#361515"></i>  Left Credits: <?php echo $user_first_left_credits ?> <p><i class="fa fa-money" style="color:#361515"></i> Right Credits: <?php echo $user_first_right_credits ?></p></a></td>
    <?php
} else {
    ?>
                                                        <td><img src="../images/useravatarn.png"><p><form action="jointhree.php" method="post"><?php
                                                        $query1 = "SELECT * FROM users WHERE Sponsor = '" . $_SESSION['Username'] . "' AND Status='Close' AND treestatus='notree'";
                                                        $result1 = mysqli_query($conn, $query1);
                                                        ?>
                                                                <select  name="Usernamethree" id="Usernamethree" onchange="">
                                                                    <option>Choose Member</option>
    <?php while ($row1 = mysqli_fetch_array($result1)):; ?>
                                                                        <option value="<?php echo $row1[6]; ?>"><?php echo $row1[6]; ?></option>
                                                                    <?php endwhile; ?>

                                                                </select>
                                                                <input type="hidden" name="under_useridthree" id="under_useridthree" value="<?php echo $first_left_user ?>">
                                                                <input type="hidden" name="sidethree" id="sidethree" value="left">
                                                                <button id="join_userthree" type="submit" class="btn btn-primary">Add Member</button></p></td></form>
    <?php
}
?>
                                                    <?php
                                                    if ($second_right_user != "") {
                                                        ?>
                                                        <td><a href="tree_api.php?search-id=<?php echo $second_right_user ?>">

                                                                <!-- change image according to gender -->
    <?php
    $getgenderfive = "SELECT Gender FROM users WHERE Username = '$second_right_user'";
    $querygenderfive = mysqli_query($conn, $getgenderfive);
    $genderfive = mysqli_fetch_array($querygenderfive);
    $mygenderfive = $genderfive['Gender'];
    if ($mygenderfive == 1) {
        ?><img src="../images/useravatar.png" alt=""><?php
                                                                } else {
                                                                    ?>
                                                                    <img src="../images/useravatarf.png" alt=""><?php
                                                                }
                                                                ?>
                                                                <!-- //change image according to gender -->

                                                                <p><?php echo $second_right_user ?></p><p><i class="fa fa-graduation-cap" style="color:#361515"></i>Rank: 
                                                                    <!-- Get Rank -->
    <?php
    $getrankfive = "SELECT * FROM rank WHERE Username = '$second_right_user'";
    $queryrankfive = mysqli_query($conn, $getrankfive);
    $rankfive = mysqli_fetch_array($queryrankfive);
    $myrankfive = $rankfive['Rank'];
    $myrankidfive = $rankfive['Rankid'];
    echo $myrankfive;
    ?>
                                                                    <!-- //Get Rank -->

                                                                </p><p><i class="fa fa-money" style="color:#361515"></i>  Left Credits: <?php echo $usertwo_first_left_credits ?><p><i class="fa fa-money" style="color:#361515"></i> Right Credits: <?php echo $usertwo_first_right_credits ?></p></p></a></td>
    <?php
} else {
    ?>
                                                        <td><img src="../images/useravatarn.png"><p><form action="joinfour.php" method="post"><?php
                                                        $query1 = "SELECT * FROM users WHERE Sponsor = '" . $_SESSION['Username'] . "' AND Status='Close' AND treestatus='notree'";
                                                        $result1 = mysqli_query($conn, $query1);
                                                        ?>
                                                                <select  name="Usernamefour" id="Usernamefour" onchange="">
                                                                    <option>Choose Member</option>
    <?php while ($row1 = mysqli_fetch_array($result1)):; ?>
                                                                        <option value="<?php echo $row1[6]; ?>"><?php echo $row1[6]; ?></option>
                                                                    <?php endwhile; ?>

                                                                </select> 
                                                                <input type="hidden" name="under_useridfour" id="under_useridfour" value="<?php echo $first_left_user ?>">
                                                                <input type="hidden" name="sidefour" id="sidefour" value="right">
                                                                <button id="join_userfour" type="submit" class="btn btn-primary">Add Member</button></p></td></form>
    <?php
}
?>
                                                    <?php
                                                    if ($third_left_user != "") {
                                                        ?>
                                                        <td><a href="tree_api.php?search-id=<?php echo $third_left_user ?>">

                                                                <!-- change image according to gender -->
    <?php
    $getgendersix = "SELECT Gender FROM users WHERE Username = '$third_left_user'";
    $querygendersix = mysqli_query($conn, $getgendersix);
    $gendersix = mysqli_fetch_array($querygendersix);
    $mygendersix = $gendersix['Gender'];
    if ($mygendersix == 1) {
        ?><img src="../images/useravatar.png" alt=""><?php
                                                                } else {
                                                                    ?>
                                                                    <img src="../images/useravatarf.png" alt=""><?php
                                                                }
                                                                ?>
                                                                <!-- //change image according to gender -->

                                                                <p><?php echo $third_left_user ?></p><p><i class="fa fa-graduation-cap" style="color:#361515"></i>Rank: 
                                                                    <!-- Get Rank -->
    <?php
    $getranksix = "SELECT * FROM rank WHERE Username = '$third_left_user'";
    $queryranksix = mysqli_query($conn, $getranksix);
    $ranksix = mysqli_fetch_array($queryranksix);
    $myranksix = $ranksix['Rank'];
    $myrankidsix = $ranksix['Rankid'];
    echo $myranksix;
    ?>
                                                                    <!-- //Get Rank -->
                                                                </p><p><i class="fa fa-money" style="color:#361515"></i>  Left Credits: <?php echo $userthree_first_left_credits ?><p><i class="fa fa-money" style="color:#361515"></i> Right Credits: <?php echo $userthree_first_right_credits ?></p></p></a></td>
    <?php
} else {
    ?>
                                                        <td><img src="../images/useravatarn.png">

                                                            <p><form action="joinfive.php" method="post"><?php
                                                    $query1 = "SELECT * FROM users WHERE Sponsor = '" . $_SESSION['Username'] . "' AND Status='Close' AND treestatus='notree'";
                                                    $result1 = mysqli_query($conn, $query1);
    ?>
                                                                <select  name="Usernamefive" id="Usernamefive" onchange="">
                                                                    <option>Choose Member</option>
    <?php while ($row1 = mysqli_fetch_array($result1)):; ?>
                                                                        <option value="<?php echo $row1[6]; ?>"><?php echo $row1[6]; ?></option>
                                                                    <?php endwhile; ?>

                                                                </select>
                                                                <input type="hidden" name="under_useridfive" id="under_useridfive" value="<?php echo $first_right_user ?>">
                                                                <input type="hidden" name="sidefive" id="sidefive" value="left">
                                                                <button id="join_userfive" type="submit" class="btn btn-primary">Add Member</button></p></td></form>
    <?php
}
?>
                                                    <?php
                                                    if ($thidr_right_user != "") {
                                                        ?>
                                                        <td><a href="tree_api.php?search-id=<?php echo $thidr_right_user ?>">

                                                                <!-- change image according to gender -->
    <?php
    $getgenderseven = "SELECT Gender FROM users WHERE Username = '$thidr_right_user'";
    $querygenderseven = mysqli_query($conn, $getgenderseven);
    $genderseven = mysqli_fetch_array($querygenderseven);
    $mygenderseven = $genderseven['Gender'];
    if ($mygenderseven == 1) {
        ?><img src="../images/useravatar.png" alt=""><?php
                                                                } else {
                                                                    ?>
                                                                    <img src="../images/useravatarf.png" alt=""><?php
                                                                }
                                                                ?>
                                                                <!-- //change image according to gender -->

                                                                <p><?php echo $thidr_right_user ?></p><p><i class="fa fa-graduation-cap" style="color:#361515"></i>Rank: 
                                                                    <!-- Get Rank -->
    <?php
    $getrankseven = "SELECT * FROM rank WHERE Username = '$thidr_right_user'";
    $queryrankseven = mysqli_query($conn, $getrankseven);
    $rankseven = mysqli_fetch_array($queryrankseven);
    $myrankseven = $rankseven['Rank'];
    $myrankidseven = $rankseven['Rankid'];
    echo $myrankseven;
    ?>
                                                                    <!-- //Get Rank -->

                                                                </p><p><i class="fa fa-money" style="color:#361515"></i>  Left Credits: <?php echo $userfour_first_left_credits ?><p><i class="fa fa-money" style="color:#361515"></i> Right Credits: <?php echo $userfour_first_right_credits ?></p></p></a></td>
    <?php
} else {
    ?>
                                                        <td><img src="../images/useravatarn.png"><p><form action="joinsix.php" method="post"><?php
                                                        $query1 = "SELECT * FROM users WHERE Sponsor = '" . $_SESSION['Username'] . "' AND Status='Close' AND treestatus='notree'";
                                                        $result1 = mysqli_query($conn, $query1);
                                                        ?>
                                                                <select  name="Usernamesix" id="Usernamesix" onchange="">
                                                                    <option>Choose Member</option>
    <?php while ($row1 = mysqli_fetch_array($result1)):; ?>
                                                                        <option value="<?php echo $row1[6]; ?>"><?php echo $row1[6]; ?></option>
                                                                    <?php endwhile; ?>

                                                                </select> 
                                                                <input type="hidden" name="under_useridsix" id="under_useridsix" value="<?php echo $first_right_user ?>">
                                                                <input type="hidden" name="sidesix" id="sidesix" value="right">
                                                                <button id="join_usersix" type="submit" class="btn btn-primary">Add Member</button></p></i></td></form>
    <?php
}
?>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Binary Tree -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->

            <!-- footer content -->

            <!-- /footer content -->
        </div>
    </div>

<?php
include('includes/footer.php');
?>

</body>
</html>
