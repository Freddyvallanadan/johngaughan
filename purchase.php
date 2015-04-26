<?php  
if(isset($_GET['type'])):
	include_once './classes/Dbfunction.php';
	$dbfunc=new Dbfunction();
	$type=$_GET['type'];
	$album_id = $_GET['id'];
	$album_title="";
	$album_price="";
	if($type=='album'){
	foreach ($dbfunc->albums() as $album) {
		if($album["id"]==$album_id){
			$album_title=$album['album_title'];
			$album_price=$album['album_price'];
		}
	}
}
	else if($type=='track'){ 

	foreach ($dbfunc->albums() as $album) {
		if($album['childs'] != null):
		foreach ($album['childs'] as $key => $track) {
		if($track["id"]==$album_id){
			$album_title=$track['track_title'];
			$album_price=$track['track_price'];
		}
	}
	endif;
	}
	}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Purchase Album :: John Gaughan Ministries</title>
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
	<section class="title center">
		<div class="container">
			<h1>Music Store</h1>
		</div>
	</section>
	<section class="content">
		<div class="main-content no-height">
			<div class="container">
				<h2><?php 
						if($album_title != null) {
							echo "Buy <strong>\"".$album_title."\"</strong></h2>";
						}else {
							echo "Some error occured!";
							exit();
						}
					?>
				<p>
					Please provide your email in the textbox below. After payment, we will send a download link to your mailbox, which will be valid for 2 hours. If you couldn't download the album within this time, you will have to provide your email again here, and a new download link will be generated and sent. For the second time, payment won't be asked!
				</p>
			</div>
			<span class="underline"></span>
		</div>
		<div class="clearBoth"></div>
		<div class="purchase container">
		<form action="paypal_process" name="purchase_form" method="POST" id="purchase_form" >
			<input type="hidden" name="id" value="<?php echo $album_id; ?>" />
			<input type="email" required="required" name="email" id="email" placeholder="Enter your email ID" />
			<input type="submit" value="proceed" />
		</form>
		<form action="process.php" name="hidden_form" method="POST" id="hid_frm" style="display:none" >
			<input type="hidden" name="itemname" value="<?php echo $album_title;?>" /> 
			<input type="hidden" name="itemnumber" value="<?php echo $album_id;?>" />  
			<input type="hidden" name="itemprice" value="<?php echo $album_price;?>" />
			<input type="hidden" name="itemQty" value='1'/>
			<input type="hidden" name="email" id="hid_email" />
		</form>
		</div>
	</section>	
	<script type="text/javascript">
$(document).ready(function(){
$("#purchase_form").submit(function(e){
	$href="check_paid.php";
	$email=$("#email").val();
	$id=<?php echo $_GET['id'] ?>;
e.preventDefault();
$.post($href,{'email':$email,'id':$id},function(data){
	$obj=JSON.parse(data);
	if(!$obj.status){
$("#hid_email").val($email);
	$("#hid_frm").submit();
	}else{
		alert($obj.mess);
		setTimeout(function(){window.location.href="index.php"},100)
	}
});
});
});
	</script>	
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
<?php
else:
	header("location:index.php");
endif;
?>