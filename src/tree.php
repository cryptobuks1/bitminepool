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
        $redirect = 'tree?search-id=' . $_POST['parent_user'];
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
            <a href = 'tree.php?search-id=" . $setid . "'><img class = 'img-rounded' id = 'avatar' src = " . (($data->user_data->Gender == 1) ? '../images/useravatar.png' : '../images/useravatarf.png') . "></a><br>
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
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-6">
                                        <form class="form-inline" >

                                            <div class="form-group">

                                                <input type="text" name="search-id" class="form-control" required>
                                            </div>

                                            <input type="submit" name="search" class="btn btn-primary" value="Search">
                                            <a href="tree" class="btn btn-primary" role="button">Go to<span> Top</span></a>

                                        </form>
                                    </div> 
                                    <div class="col-md-2">
                                    </div>
                                </div> 
                                <!--<div class="row">
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
                                </div> -->
                                <!-- /Search -->
                                <div class="row">
                                    <div class="col-lg-12 tree">
                                        <?php
                                        echo createTreeDataFromReg($search);
                                        ?>
                                    </div>
                                </div>
                                <!-- Binary Tree -->

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
