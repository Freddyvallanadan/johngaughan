<?php
if(isset($_GET["token"]) && isset($_GET["PayerID"])):
include_once './classes/Dbfunction.php';
include_once("config.php");
include_once("paypal.class.php");
$dbfunc=new Dbfunction();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Music Store :: John Gaughan Ministries</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script></head>
<body>
	<header>
		<div class="container">
			<div class="top-logo left">
				<a href="index.php">
					<img src="images/logo.png" alt="John Gaughan"/>
				</a>
			</div>
			<nav class="desktop">
				<ul class="top-menu right">
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About Us</a></li>
					<li><a href="music.php">Music</a></li>
					<li><a href="blog.php">Blog</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
			</nav>
			<div class="clearBoth"></div>
		</div>
	</header>
	<nav class="mobile" aria-haspopup="true">
		<div class="mobile-menu trigger"></div>
		<ul class="mobile-menu">
			<li><a href="index.php">Home</a></li>
			<li><a href="about.php">About Us</a></li>
			<li><a href="music.php">Music</a></li>
			<li><a href="blog.php">Blog</a></li>
			<li><a href="contact.php">Contact</a></li>
		</ul>
	</nav>
	<section class="title center">
		<div class="container">
			<h1>Music Store</h1>
		</div>
	</section>
	<section class="content">
		<div class="main-content">
			<div class="container">
			<?php
			//Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
if(isset($_GET["token"]) && isset($_GET["PayerID"]))
{
	//we will be using these two variables to execute the "DoExpressCheckoutPayment"
	//Note: we haven't received any payment yet.
	
	$token = $_GET["token"];
	$payer_id = $_GET["PayerID"];
	
	//get session variables
	$ItemName 			= $_SESSION['ItemName']; //Item Name
	$ItemPrice 			= $_SESSION['ItemPrice'] ; //Item Price
	$ItemNumber 		= $_SESSION['ItemNumber']; //Item Number
	$ItemQty 			= $_SESSION['ItemQty']; // Item Quantity
	$GrandTotal 		= $_SESSION['GrandTotal'];
	$email_sent 		= $_SESSION['email_sent'];

	$padata = 	'&TOKEN='.urlencode($token).
				'&PAYERID='.urlencode($payer_id).
				'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
				
				//set item info here, otherwise we won't see product details later	
				'&L_PAYMENTREQUEST_0_NAME0='.urlencode($ItemName).
				'&L_PAYMENTREQUEST_0_NUMBER0='.urlencode($ItemNumber).
				'&L_PAYMENTREQUEST_0_AMT0='.urlencode($ItemPrice).
				'&L_PAYMENTREQUEST_0_QTY0='. urlencode($ItemQty).

				/* 
				//Additional products (L_PAYMENTREQUEST_0_NAME0 becomes L_PAYMENTREQUEST_0_NAME1 and so on)
				'&L_PAYMENTREQUEST_0_NAME1='.urlencode($ItemName2).
				'&L_PAYMENTREQUEST_0_NUMBER1='.urlencode($ItemNumber2).
				'&L_PAYMENTREQUEST_0_DESC1=Description text'.
				'&L_PAYMENTREQUEST_0_AMT1='.urlencode($ItemPrice2).
				'&L_PAYMENTREQUEST_0_QTY1='. urlencode($ItemQty2).
				*/
				'&PAYMENTREQUEST_0_AMT='.urlencode($GrandTotal).
				'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($PayPalCurrencyCode);
	
	//We need to execute the "DoExpressCheckoutPayment" at this point to Receive payment from user.
	$paypal= new MyPayPal();
	$httpParsedResponseAr = $paypal->PPHttpPost('DoExpressCheckoutPayment', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);
	
	//Check if everything went ok..
	if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) 
	{

			echo '<h2>Payment Succesfull!</h2>';
			echo 'Your Transaction ID : '.urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]);
			
				/*
				//Sometimes Payment are kept pending even when transaction is complete. 
				//hence we need to notify user about it and ask him manually approve the transiction
				*/
				
				if('Completed' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"])
				{
					echo '<div style="color:green">Please click on the download link in your mailbox!</div>';
				}
				elseif('Pending' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"])
				{
					echo '<div style="color:red">Transaction Complete, but payment is still pending! '.
					'You need to manually authorize this payment in your <a target="_new" href="http://www.paypal.com">Paypal Account</a></div>';
				}

				// we can retrive transection details using either GetTransactionDetails or GetExpressCheckoutDetails
				// GetTransactionDetails requires a Transaction ID, and GetExpressCheckoutDetails requires Token returned by SetExpressCheckOut
				$padata = 	'&TOKEN='.urlencode($token);
				$paypal= new MyPayPal();
				$httpParsedResponseAr = $paypal->PPHttpPost('GetExpressCheckoutDetails', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

				if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) 
				{
					
					//echo '<br /><b>Stuff to store in database :</b><br /><pre>';
					$sql="SELECT * FROM `buyer` WHERE `email_id`='".$email_sent."'";
					$result=$dbfunc->select_data($sql);
				$num_rows = mysqli_num_rows($result);
				$a=array(
							"email"=>$email_sent,
							"id"=>$ItemNumber,
							"timestamp"=>time()
							);
						$enc=base64_encode(base64_encode(json_encode($a)));
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From: <info@johngaughanministries.com>' . "\r\n";
						$link="http://" . $_SERVER['SERVER_NAME']."/download.php?enc=".$enc;
				if($num_rows>0){
					$row=mysqli_fetch_array($result);
					$albums=$row['albums'];
					$album=explode(',',$albums);
					$flag=0;
					foreach ($album as $key => $value) {
						if($value==$ItemNumber){
							$flag=1;
						}
					}
					if($flag==0){
					$albums.=",".$ItemNumber;
					$up="UPDATE `buyer` SET `albums`='".$albums."' WHERE `email_id`='".$email_sent."'";
					$result=$dbfunc->insert_data($up);
					if($result){
							echo "Payement Succesfull!";
							$message="Please click on the new link below to download the album you purchased! </br> </br> <a href='".$link."'>Download Link</a></br> </br> Note: This link will be automatically disabled in 1 hour! If this link goes invalid, providing your email ID again in the site will get you an updated download link!";
							mail($email_sent, 'John Gaughan :: Please find your new download link!', $message,$headers);
						}
						else{
							echo "Some error occured! Please try again later...";
						}
					}else{
						
						echo "You have already purchased";
						$message="Please click on the new link below to download the album you purchased! </br> </br> <a href='".$link."'>Download Link</a></br> </br> Note: This link will be automatically disabled in 1 hour! If this link goes invalid, providing your email ID again in the site will get you an updated download link!";
						mail($email_sent, 'John Gaughan :: Please find your new download link!', $message,$headers);
					}
				}else{
					$ins="INSERT INTO `buyer`(`email_id`, `albums`) VALUES ('".$email_sent."','".$ItemNumber."')";
						$result=$dbfunc->insert_data($ins);

						if($result){
							$message="Please click on the new link below to download the album you purchased! </br> </br> <a href='".$link."'>Download Link</a></br> </br> Note: This link will be automatically disabled in 1 hour! If this link goes invalid, providing your email ID again in the site will get you an updated download link!";
							mail($email_sent, 'John Gaughan :: Please find your new download link!', $message,$headers);
						}
						else{
							echo "Some error occured! Please try again later...";
						}
				}
					
					//echo '<pre>';
					//print_r($httpParsedResponseAr);
					//echo '</pre>';
				} else  {
					echo '<div style="color:red"><b>GetTransactionDetails failed:</b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
					echo '<pre>';
					print_r($httpParsedResponseAr);
					echo '</pre>';

				}
	
	}else{
			echo '<div style="color:red"><b>Error : </b>'.urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]).'</div>';
			echo '<pre>';
			print_r($httpParsedResponseAr);
			echo '</pre>';
	}
}?>
			<!--<?php if($_GET["encoded"]): 


				$assign=base64_decode(base64_decode($_GET['encoded']));
				$assign_array=json_decode($assign);
				$sql="SELECT * FROM `buyer` WHERE `email_id`='".$assign_array->email."'";
				$result=$dbfunc->select_data($sql);
				$num_rows = mysqli_num_rows($result);
				$a=array(
							"email"=>$assign_array->email,
							"id"=>$assign_array->album_id,
							"timestamp"=>time()
							);
						$enc=base64_encode(base64_encode(json_encode($a)));
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From: <info@johngaughanministries.com>' . "\r\n";
						$link="http://" . $_SERVER['SERVER_NAME']."/download.php?enc=".$enc;
				if($num_rows>0){
					$row=mysqli_fetch_array($result);
					$albums=$row['albums'];
					$album=explode(',',$albums);
					$flag=0;
					foreach ($album as $key => $value) {
						if($value==$assign_array->album_id){
							$flag=1;
						}
					}
					if($flag==0){
					$albums.=",".$assign_array->album_id;
					$up="UPDATE `buyer` SET `albums`='".$albums."' WHERE `email_id`='".$assign_array->email."'";
					$result=$dbfunc->insert_data($up);
					if($result){
							echo "Payment Successfull";
							$message="Please click on the new link below to download the album you purchased! </br> </br> <a href='".$link."'>Download Link</a></br> </br> Note: This link will be automatically disabled in 1 hour! If this link goes invalid, providing your email ID again in the site will get you an updated download link!";
							mail($assign_array->email, 'John Gaughan :: Please find your download link!', $message,$headers);
						}
						else{
							echo "Some error occured! Please try again later...";
						}
					}else{
						
						echo "You have already purchased";
						$message="Please click on the new link below to download the album you purchased! </br> </br> <a href='".$link."'>Download Link</a></br> </br> Note: This link will be automatically disabled in 1 hour! If this link goes invalid, providing your email ID again in the site will get you an updated download link!";
						mail($assign_array->email, 'John Gaughan :: Please find your new download link!', $message,$headers);
					}
				}else{
					$ins="INSERT INTO `buyer`(`email_id`, `albums`) VALUES ('".$assign_array->email."','".$assign_array->album_id."')";
						//echo $ins;
						$result=$dbfunc->insert_data($ins);

						if($result){
							$message="Please click on the new link below to download the album you purchased! </br> </br> <a href='".$link."'>Download Link</a></br> </br> Note: This link will be automatically disabled in 1 hour! If this link goes invalid, providing your email ID again in the site will get you an updated download link!";
							mail($assign_array->email, 'John Gaughan :: Please find your new download link!', $message,$headers);
						}
						else{
							echo "Some error occured! Please try again later...";
						}
				}

			?>

				<h2><strong>Your order has been placed!</strong> We will contact you soon</h2>
			<?php endif; ?>-->
			</div>
			<span class="underline"></span>
		</div>
		<div class="clearBoth"></div>
	</section>		
	<footer>
		<div class="footer-content">
			<div class="container">
				<div class="contact-footer left">
					<h3>Contact Us</h3>
				 	<address> 
				 		<div><span>Phone:</span>01377 256774</div> 
				 		<div><span>Email:</span>info@johngaughanministries.com</div> 
				 	</address> 
				</div>
				<div class="social-footer right">
					<h3>Connect Us</h3>
					<div class="social-icons">
						<a href="#"><span class="f-icon"></span></a>
						<a href="#"><span class="g-icon"></span></a>
						<a href="#"><span class="t-icon"></span></a>
					</div>
				</div>
				<div class="clearBoth"></div>
			</div>
		</div>
		<div class="copyright">
			<div class="container">
				John Gaughan Ministries &copy; 2013. All Rights Reserved. <a href="https://www.hullwebsites.com/" target="_blank">Web Design</a> By <a href="https://www.hullwebsites.com/" target="_blank">Hull Websites</a>
			</div>
		</div>
	</footer>
</body>
</html>
<?php else: 
echo "Some error occured! Please try again later...";
exit();
endif;
?>
