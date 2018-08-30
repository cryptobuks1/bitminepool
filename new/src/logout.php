<?php
session_start();
session_destroy();
//header("location:login");
$redirect = 'login';
echo "<script>location='".BASE_URL.$redirect."'</script>";
?>