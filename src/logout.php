<?php
session_start();
session_destroy();
include('includes/constant.php');
//header("location:login");
$redirect = 'login';
echo "<script>location='".BASE_URL.$redirect."'</script>";
?>