<!DOCTYPE html>
<html>
<head>
    <title>Admin :: John Gaughan Ministries</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<header>
		<div class="container">
			<div class="top-logo left">
				<a href="#">
					<img src="images/logo.png" alt="John Gaughan"/>
				</a>
			</div>
			<nav>
				<ul class="top-menu right">
					<li><a href="index.php" target="_blank">Home</a></li>
					<li><a href="about.php" target="_blank">About Us</a></li>
					<li><a href="music.php" target="_blank">Music</a></li>
					<li><a href="blog.php" target="_blank">Blog</a></li>
					<li><a href="contact.php" target="_blank">Contact</a></li>
				</ul>
			</nav>
			<div class="clearBoth"></div>
		</div>
	</header>
	<section class="title">
		<div class="container">
			<h1>Admin Login</h1>
		</div>
	</section>
	<section class="content">
		<div class="main-content contact">
			<div class="container">
			<div class="results"></div>
				<form action="" method="post" name="contact-form">
				<div class="form-container left">
					<h2>Admin Login</h2>
						<label>Username </label>: <input type="text" id="username"/><br/>
						<label>Password </label>: <input type="password" id="password"/><br/>
						<label>&nbsp;</label> &nbsp;<input class="submit-button right" type="submit" value="Login" id="login"/>
				</div>
				</form>
				<div class="contact-details-container right">
					<a href="#" id="fp_id"><h3 style="color:#6077AB;">Forgot Password</h3></a>
					<h3>For assistance, contact</h3>
				 	<address> 
				 		<div><span>Phone:</span>01482 426116</div> 
				 		<div><span>Email:</span>info@hullwebsites.com</div> 
				 	</address> 
				</div>
				<div class="clearBoth"></div>
			</div>
		</div>
	</section>	
	<div class="bg-img"> </div>
	<script type="text/javascript">
$(document).ready(function(){
$("#fp_id").click(function(e){
e.preventDefault();
$(".remess").html("");
$("#fp_cont").show();
$(".bg-img").show();
});
$("#fp_close").click(function(e){
e.preventDefault();
$("#fp_cont").hide();
$(".bg-img").hide();
});
$("#reset_form").submit(function(e){
e.preventDefault();
$.post("reset_link.php",{"email":$("#email").val()},function(data){
$obj=JSON.parse(data);
if($obj.status==1){
	$(".remess").html("<div>"+$obj.mess+"</div>");
	setTimeout(function(){$("#fp_cont").hide();
$(".bg-img").hide();},3000);
}else{
	$(".remess").html("<div>"+$obj.mess+"</div>");
}
});
});
});

	</script>	
	<style type="text/css">
.bg-img {
   background: none repeat scroll 0 0 rgba(255, 255, 255, 0.5);
    bottom: 0;
    height: 100%;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    width: 100%;
    display: none;
}
	</style>
		<div class="purchase container" id="fp_cont">
		<a href="#" id="fp_close" style="width:100%;text-align:right;display:block;"> x </a>
		<h2>Please provide your email ID</h2>
		<form action="#" name="resetLink" method="POST" id="reset_form" >
			<input type="email" required="required" name="email" id="email" placeholder="Enter admin email" />
			<input type="submit" value="Send" />
			<div class="remess"></div>
		</form>
		</div>
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