<?php
include('includes/header.php');
if (isset($_SESSION['Username'])) {
////////////////////////////////////////Get the User Profile///////////////////////////////////////////////////////////////		
    $getdetails = "SELECT * FROM users WHERE Username = '" . $_SESSION['Username'] . "'";
    $querydetails = mysqli_query($conn, $getdetails);
    $sharedetails = mysqli_fetch_array($querydetails);
    $showname = $sharedetails['Fullname'];
    $showemail = $sharedetails['Email'];
    $showtelephone = $sharedetails['Telephone'];
    $showusername = $sharedetails['Username'];
    $showpassword = $sharedetails['Password'];
    $showsponsor = $sharedetails['Sponsor'];
    $gender = $sharedetails['Gender'];
    $showid = $sharedetails['id'];

    if (!empty($_POST)) {
        $response = ApiHelper::getApiResponse('POST', ['access_token' => ACCESS_TOKEN,
                'id' => $showid,
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'telephone' => $_POST['Telephone'],
                'gender' => $_POST['Gender'],
                'platform' => '3',
                'transaction_type' => '202'
                //'grant_type' => 'client_credentials'
                ], 'updateCustomer');

        $response = json_decode($response);
        $redirect = 'profile';
        if ($response->statusCode == 100) {
            $_SESSION['error'] = 0;
            $_SESSION['message'] = $response->statusDescription;
            $redirect = 'profile';
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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
include('includes/message.php');
?>        
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo BASE_URL; ?>" class="site_title"> <span><img src="images/logo.png" alt="Bit-Mine-Pool" style="width: 95px;"></span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <a href="<?php echo BASE_URL; ?>"><img src="../images/img.jpg" alt="..." class="img-circle profile_img"></a>              </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo ' ' . strlen($_SESSION['Username']) > 15 ? ucfirst(substr($_SESSION['Username'], 0, 15)) . "..." : ucfirst($_SESSION['Username']); ?></h2>
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



                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">

                                <div class="x_content">

                                    <form id="edit-member" class="form-horizontal form-label-left" novalidate action="" method="post">



                                        <span class="section">User Profile</span>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Full Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <input id="Fullname" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" value="<?php echo $showname; ?>" name="name" placeholder="both name(s) e.g Jon Doe"  data-msg-required="Please enter the name." required="required" type="text">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                                            </label>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <input type="email" id="email" name="email" readonly="true" required="required" value="<?php echo $showemail; ?>" data-msg-required="Please enter the email address."  class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>


                                        <!--<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Sponsor <span class="required">*</span>
                                            </label>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <input id="Sponsor" type="text" name="Sponsor" data-validate-length-range="5,20" value="<?php echo $showsponsor; ?>" readonly="true" value="<?php echo $_SESSION['Sponsorname']; ?>"class="optional form-control col-md-7 col-xs-12">
                                            </div>
                                        </div> -->

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Username <span class="required">*</span>
                                            </label>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <input id="Username" type="text" name="Username" readonly="true" data-validate-length-range="5,20" value="<?php echo $showusername; ?>" required="required" class="optional form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <!-- <div class="item form-group">
                                            <label for="password" class="control-label col-md-3">Password</label>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <input id="password" type="password" name="password" data-validate-length="6,8" value="<?php echo $showpassword; ?>" class="form-control col-md-7 col-xs-12" required="required">
                                            </div>
                                        </div> -->
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <select class="form-control" name="Gender">
                                                    <option <?php ($gender == 1) ? 'selected' : '' ?> value="1">Male</option>
                                                    <option <?php ($gender == 2) ? 'selected' : '' ?> value="2">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Telephone <span class="required">*</span>
                                            </label>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <input id="phone" type="tel" value="<?php echo $showtelephone; ?>" name="Telephone" data-msg-required="Please enter the phone number." class="form-control col-md-7 col-xs-12" required="required">

                                            </div>
                                        </div>
                                        <input type="hidden" value="<?php echo $showid; ?>" name="id">
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <button id= "edit-member-reset" type="reset" class="btn btn-primary">Cancel</button>
                                                <button id="send" type="submit" class="btn btn-success">Change</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->


            <div class="clearfix"></div>
        </div>
    </div>

</div>
<br />


</div>

<?php
include('includes/footer.php');
?>
<script>
    /*  $("#phone").intlTelInput({
     utilsScript: "../vendor/build/js/utilsTellInput.js"
     });*/
    //$("#phone").intlTelInput();
    $(document).ready(function () {
        var validator = $("#edit-member").validate();
        //validator.form();
    });

    $('#edit-member-reset').click(function () {
        $('#edit-member')[0].reset();
        var validator = $("#edit-member").validate();
        validator.resetForm();
    });

</script>
</body>
</html>
