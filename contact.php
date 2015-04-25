<?php
if($_POST["mail"]!="") { 
	$name = $_POST["name"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$message = $_POST["message"];
	$check = 0;
	$name = preg_replace("/[^a-zA-Z\s]/", "", $name);
	if (empty($name)) {
		$msg= "<span style=color:red>Please enter your name.</span>";
		$check = 1;
	}else{	
		if (empty($email)) {
			$msg= "<span style=color:red>Please enter your email.</span>";
			$check = 2;
		}else{
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$msg= "<span style=color:red>Please enter a valid email address.</span>";
				$check = 3;
			}else{
				if (empty($message)) {
					$msg= "<span style=color:red>Please enter your message to us.</span>";
					$check = 4;
				}else{
					$to = filter_var("injustin@live.in", FILTER_SANITIZE_EMAIL);
					$subjects = "New Message - $name Contact $phone";
					$msgs = "$message";
					$from = "$email";
					$headers = "From:" . $from;
					mail($to,$subjects,$msgs,$headers);
					session_unset();
					session_destroy();
					$msg= "<span style=color:green>Thank you for contacting us, we will get back to you shortly.</span>";
					$check = 5;
				}
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Me - John Gaughan Ministries</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</head>
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
	<section class="title">
		<div class="container">
			<h1>Contact Us</h1>
		</div>
	</section>
	<section class="content">
		<div class="main-content contact">
			<div class="container">
				<?php if($check != 0 && $_POST["mail"]!= "") { 
						echo $msg;
				} ?>
				<?php if($check < 5 ) { ?> 
				<div class="form-container left">
					<h2>Contact Form</h2>
					<form action="contact.php" method="post" name="contact-form">
							<label>Full Name </label>: <input name="name" type="text" required/><br/>
							<label>Email </label>: <input name="email" type="email" required/><br/>
							<label>Phone </label>: <input name="phone" type="tel" /><br/><br/>
							<label>Message </label>: <textarea name="message" required></textarea><br/>
							<label>&nbsp;</label> &nbsp;<input name="mail" class="submit-button " type="submit" value="Send Message"/>
					</form>
				</div>
				<?php } ?>
				<div class="contact-details-container right">
					<h3>Address</h3>
				 	<address> 
				 		<div><span>Phone:</span>01377 256774</div> 
				 		<div><span>Email:</span>info@johngaughanministries.com</div> 
				 	</address> 
				</div>
				<div class="clearBoth"></div>
			</div>
			<span class="underline"></span>
		</div>
		<blockquote class="verse">
			"John 8:36New King James Version (NKJV)<br/>36 Therefore if the Son makes you free, you shall be free indeed."
		</blockquote>
	</section>		
	<footer>
		<div class="footer-content">
			<div class="container">
				<div class="contact-footer left">
					<h3>Contact Us</h3>
				 	<address> 
				 		<div><span>Phone:</span>01234 56789</div> 
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