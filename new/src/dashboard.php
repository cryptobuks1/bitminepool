<?php
if (!isset($_SESSION)) session_start();
include('includes/constant.php');
if (isset($_SESSION['is_prime_user'])) {
    if ($_SESSION['is_prime_user'] == 1) {
        include('dashboard_main.php');
    } else {
        include('dashboard_guest.php');
    }
} else {
    unset($_POST);
    unset($_SESSION);
    header("Location:login");
    //$redirect = 'login';
    //echo "<script>location='".BASE_URL.$redirect."'</script>";
    exit;
}
?>
