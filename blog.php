<?php
include_once './classes/Dbfunction.php';
$dbfunc=new Dbfunction();
  $sql_default="SELECT * FROM `blog_info` ORDER BY id DESC";
  $result=$dbfunc->select_data($sql_default);
  $count=mysqli_num_rows($result);
   if(isset($_GET['id'])){
   	 $sql="SELECT * FROM `blog_info` WHERE `id`=".$_GET['id'];
 
}else{
	$sql="SELECT * FROM `blog_info` ORDER BY id DESC LIMIT 1";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog - John Gaughan Ministries</title>
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
			<h1>Blog</h1>
		</div>
	</section>
	<section class="content">
		<div class="main-content">
			<div class="container">
				<div class="one-blocks">
					<div class="block">
					<?php 
					$result = $dbfunc->select_data($sql);
					$i=0;
					if (mysqli_num_rows($result) > 0) {
   					while($row = mysqli_fetch_assoc($result)){
   						$id=$row['id'];
					?>
						<h2><?php echo stripslashes($row['title']);?></h2>

							<p class="blog-details">posted on <?php echo $row['entered']; ?>, by <?php echo stripslashes($row['author']); ?></p>
							<?php if($row['image']){?>
								<div class="img-container"><img alt="" src="upload_images/<?php echo $row['image']; ?>"/></div>
							<?php } ?>
							
							<p>
							<?php echo nl2br(stripslashes($row['desc'])); ?>
							</p>
						
						<?php
					}
				
					?>
					</div>
				</div>
			</div>
			<span class="underline"></span>
		</div>
		<div class="blog-nav">
		<?php 
		$sql="SELECT `id` FROM `blog_info` WHERE id < ".$id." ORDER BY id desc LIMIT 1";
							$result = $dbfunc->select_data($sql);
					if (mysqli_num_rows($result) > 0): 
   					$row = mysqli_fetch_array($result)
   						?>
			<a class="button1" href="blog.php?id=<?php echo $row['id']?>"> &laquo; Previous Post </a> &nbsp;&nbsp;
		<?php endif; ?>
		<?php 
		$sql="SELECT `id` FROM `blog_info` WHERE id > ".$id." ORDER BY id LIMIT 1";
							$result = $dbfunc->select_data($sql);
					if (mysqli_num_rows($result) > 0): 
   					$row = mysqli_fetch_array($result)
   						?>
			<a class="button1" href="blog.php?id=<?php echo $row['id']?>"> Next Post &raquo; </a>
			<?php endif; ?><br/><br/><br/>
			<a href="posts.php" style="text-decoration:underline;"> View All Blog Posts </a>
		</div>
		<?php }else{
			?>
					<div id="post" >
							<p> There is no Post </p>
						</div>	
				<?php	}?>
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