<?php

session_start();

$PayPalMode 			= 'sandbox'; // sandbox or live
$PayPalApiUsername 		= 'freddyvallanadan-facilitator_api1.gmail.com'; //PayPal API Username
$PayPalApiPassword 		= 'QYUE4R8UXVEEXVAL'; //Paypal API password
$PayPalApiSignature 	= 'AFcWxV21C7fd0v3bYYYRCpSSRl31AvTr0.QeTjW5mUZbQmrSDXvGloLc'; //Paypal API Signature
$PayPalCurrencyCode 	= 'GBP'; //Paypal Currency Code
$PayPalReturnURL 		= 'http://'.$_SERVER['SERVER_NAME'].'/success.php'; //Point to process.php page
$PayPalCancelURL 		= 'http://'.$_SERVER['SERVER_NAME'].'/cancel_url.php'; //Cancel URL if user clicks cancel
?>