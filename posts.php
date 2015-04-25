<?php
include_once './classes/Dbfunction.php';
$dbfunc=new Dbfunction();
  $sql_default="SELECT * FROM `blog_info` ORDER BY id DESC";
  $rec_limit =10;
  $sql = "SELECT count(id) FROM `blog_info` ";
  $retval=$dbfunc->select_data($sql);
  $row = mysqli_fetch_array($retval );
	$rec_count = $row[0];
if( isset($_GET['page'] ) )
{
   $page = $_GET['page'] + 1;
   $offset = $rec_limit * $page ;
}
else
{
   $page = 0;
   $offset = 0;
}
$left_rec = $rec_count - ($page * $rec_limit);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog :: John Gaughan Ministries</title>
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
			<h1>Blog Posts</h1>
		</div>
	</section>
	<section class="content">
		<div class="main-content">
			<div class="container">
				<div class="one-blocks posts">

					<?php if($dbfunc->login_check()){ ?>
					<button class="button1" name="add_post" id="add_post">Add New Post</button>
					<a class="class1 button1" href="logout.php">LogOut</a>
					<?php }
					?>

					<div class="block">
					<?php 
					$sql = "SELECT * FROM `blog_info` ORDER BY `id` DESC LIMIT ".$offset.",".$rec_limit;
					$result = $dbfunc->select_data($sql);
					
					if (mysqli_num_rows($result) > 0) {
						$i=0;
   					while($row = mysqli_fetch_assoc($result)){
   												$i++;
					?>
						<div id="<?php echo "post".$i;?>">
							<h2><?php echo stripslashes($row['title']);?></h2>

							<p class="blog-details">posted on <?php echo $row['entered']; ?>, by <?php echo stripslashes($row['author']); ?></p>
							<a class="button1" href="<?php echo "blog.php?id=".$row['id']?>" target="_blank">View &raquo; </a>
							<?php if($dbfunc->login_check()){?>
							<a class="button1" id="edit" href="<?php echo $row['id']; ?>">Edit &raquo; </a><a class="button1" id="delete" href="<?php echo $row['id']; ?>">Delete &raquo; </a>
							<?php }?>
							<hr/>
						</div>
					<?php 
					} 
					}else{
						?>
					<div id="post" >
							<p> There are no posts to display </p>
						</div>	
					<?php }
					?>
						<!-- <div id="post2">
							<h2>This is<strong> second last blog title</strong></h2>
							<p class="blog-details">posted on 01/01/2015, by John Gaughan</p>
							<p>
								The mission of the John Gaughan Ministries is to reachthe unsaved with the Gospel and teach Chrstians who they are in Jesus Christ. Thereafter, to teach Christians how to live a victorious life in their covenant rights and previleges. The fulfillment of that mission takes place when those believers become rooted and grounded enough in God's Word to reach out and teach others these same principles.
							</p><br/>
							<a class="button1">Read more &raquo; </a>
							<hr/>
						</div>
						<div id="post3">
							<h2>This is<strong> third last</strong></h2>
							<p class="blog-details">posted on 01/01/2015, by John Gaughan</p>
							<p>
								The mission of the John Gaughan Ministries is to reachthe unsaved with the Gospel and teach Chrstians who they are in Jesus Christ. Thereafter, to teach Christians how to live a victorious life in their covenant rights and previleges. The fulfillment of that mission takes place when those believers become rooted and grounded enough in God's Word to reach out and teach others these same principles.
							</p><br/>
							<a class="button1">Read more &raquo; </a>
							<hr/>
						</div> --><?php if($rec_limit<$rec_count):?>
						<?php if( $left_rec < $rec_limit )
{
   $last = $page - 2;
   echo "<a class='button1' href='posts.php?page=".$last."'>Previous</a>";
}
else if( $page == 0 )
{
    echo "<a class='button1' href='posts.php?page=".$page."'>Next</a>";
}
else if( $page > 0 )
{
   $last = $page - 2;
   echo "<a class='button1' href='posts.php?page=".$last."'>Previous</a> |";
   echo "<a class='button1' href='posts.php?page=".$page."'>Next</a>";
} ?>
<?php endif;?>
					</div>
				</div>
			</div>
		</div>
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
		<?php if($dbfunc->login_check()): ?>
			<form enctype="multipart/form-data" action="#" method="post" id="hidden_form" class="pop-form">
				<div class="fields top"><label>Author:</label><input type="text" name="author" id="author"required='required'/></div>
				<div class="fields"><label>Title:</label><input type="text" name="title" id="title" required='required'/></div>
				<div class="fields"><label>Description:</label><br/><textarea name="desc" id="desc" required='required'></textarea></div>
				<div><input type="hidden" value="" id="form_id" name="id"></div>
				<div><input type="hidden" value="" id="form_val" name="form_val"></div>
				<div class="fields buttons"><button class="button1" type="button" id="hd_but">hidden</button><button class="button1" type="button" id="hd_cancel">Cancel</button></div>
			</form>
		<?php endif;?>
		<div class="copyright">
			<div class="container">
				John Gaughan Ministries &copy; 2013. All Rights Reserved. <a href="https://www.hullwebsites.com/" target="_blank">Web Design</a> By <a href="https://www.hullwebsites.com/" target="_blank">Hull Websites</a>
			</div>
		</div>
	</footer>
</body>
</html>