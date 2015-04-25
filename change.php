<?php
include_once './classes/Dbfunction.php';
	$dbfunc=new Dbfunction();
	$pass=md5($_POST['password']);
	$sql="UPDATE `user` SET `password`='".$pass."', `expire`= 0 WHERE email='".$_POST['email']."'";
	$res=$dbfunc->edit_data($sql);
	if($res){
		?>
		<script type="text/javascript">window.location.href="admin.php";</script>
		<?php
	}else{
		?>
		<script type="text/javascript">alert("Some error occured.Please try again");window.location.href="admin.php";</script>
		<?php
	}

?>