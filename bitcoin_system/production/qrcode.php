<?php
// include QR_BarCode class 
include "QR_BarCode.php"; 

// QR_BarCode object 
$qr = new QR_BarCode(); 

// create text QR code 
$qr->text('bitcoin:1K8pou7NUsCyNpUVi1jN2xHXcFwumqhxWD?amount=0.02307552'); 

// display QR code image
$qr->qrCode();
?>