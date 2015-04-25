<!DOCTYPE html>
<html>
<head>
    <title>John Gaughan Ministries</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bxslider/jquery.bxslider.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="bxslider/jquery.bxslider.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script>
		$(document).ready(function(){
			var slider = $('.bxslider').bxSlider({
			   pager: false,
			   controls: false,
			   auto: true,
			   speed: 2000,
			   onSliderLoad: function () {
				    $('.bxslider>li').eq(1).addClass('active')
					},
			   onSlideBefore:function($slideElement, oldIndex, newIndex){
				   	jQuery(".bxslider li").removeClass("active");
				   	$slideElement.addClass("active");
			   }
			});
		});
	</script>
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
	<section class="slider">
		<div class="jsSlider">
			<ul class="bxslider">
				<li>
					<!-- <img src="images/slider1.jpg" alt="John Gaughan"/> -->
					<div class="in-slider left">
						<h1>John Gaughan</h1>
						<h2>Ministries</h2>
						<span>Welcome to John Gaughan Ministries! Thanks for joining us.</span>
					</div> 
				</li>
				<li>
					<!-- <img src="images/slider1.jpg" alt="John Gaughan"/> -->
					<div class="in-slider left">
						<h1><a href="music.php">Music</a></h1>
						<h2><a href="music.php">Download our latest albums from our store.</a></h2>
						<span>Welcome to John Gaughan Ministries Thanks for joining us.</span>
					</div> 
				</li>									
			</ul>
			<div class="slider-video right">
				<iframe width="530" height="350" src="https://www.youtube.com/embed/r9DASHK_Bxk" allowfullscreen></iframe>
			</div>
		</div>
		<div class="slider-bottom">
			<p>Welcome to the official website of John Gaughan Ministries, preaching the Gospel of Jesus Christ and teaching His church</p>
		</div>
	</section>
	<section class="content">
		<div class="music-bar">
			<h1>Download our latest Music albums from store</h1><a class="button1" href="music.php">Go to Store</a>
		</div>
		<div class="main-content no-height">
			<div class="container">
				<p>
					<strong>John Gaughan Pastor/Evangelist</strong> based in the market town of Driffield in the heart of East Yorkshire. Back in the year 2012 John took on the role of pastor at Driffield Congregational Church in partnership with his evangelistic ministry. Johns unique method of combining his story and Gospel Music has resulted in many lives being changed and coming to salvation. He continues to travel the UK and abroad spreading his extraordinary story of how fame and fortune coupled with addiction brought him to Christ and freedom through the love and power of Jesus Christ.
				</p>
			</div>
			<span class="underline"></span>
		</div>
		<div class="three-blocks">
			<div class="container">
				<div class="block">
					<p>If you would like John to minister in your church
You can reach us on the contact page</p>
				</div>
				<div class="block home-image">
					<h2>Linda &amp; John</h2>
					<p><img src="images/lindaandjohn.jpg" alt="Linda &amp; John"></p>
				</div>
				<div class="block">
					<p>If you would like to partner with John Gaughan Ministries Know your support is greatly appreciated. Please contact us. Let’s reach the world for Jesus !</p>
				</div>
			</div>
		</div>
		<div class="main-content no-height">
			<div class="container">
				<h2><strong>Mission</strong> Statement</h2>
				<p>
					The Mission of John Gaughan Ministries is to reach the unsaved with the Gospel through anointed preaching, evangelism and Gospel music inspired by the Holy Spirit
				</p>
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