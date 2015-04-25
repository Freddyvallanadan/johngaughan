<?php

session_start();

$PayPalMode 			= 'live'; // sandbox or live
$PayPalApiUsername 		= 'jgaughanie_api1.googlemail.com'; //PayPal API Username
$PayPalApiPassword 		= 'PSF3SBG9F9DRQE88'; //Paypal API password
$PayPalApiSignature 	= 'AbrISSuYnGax.w5jsFTLUV6Ot0euAfF9rf5ZRy1TkjqEJn8vQ0-tYsy7'; //Paypal API Signature
$PayPalCurrencyCode 	= 'GBP'; //Paypal Currency Code
$PayPalReturnURL 		= 'http://'.$_SERVER['SERVER_NAME'].'/success.php'; //Point to process.php page
$PayPalCancelURL 		= 'http://'.$_SERVER['SERVER_NAME'].'/cancel_url.php'; //Cancel URL if user clicks cancel
?>