<?php
if(isset($_POST['email'])){
include_once './classes/Dbfunction.php';
	$dbfunc=new Dbfunction();
	$email = $_POST['email']; 
	$sql="select * from user where email='".$email."'";
	$result=$dbfunc->select_data($sql);
	$num=mysqli_num_rows($result);
	
	if($num>0){
		$rand=rand(1,9);
		$sql="UPDATE `user` SET `expire`=".$rand." WHERE email='".$email."'";
		$res=$dbfunc->edit_data($sql);
		if($res){
		$arr=array(
			"email"=>$email,
			"timestamp"=>time(),
			"flag"=>$rand
			);
		
		$enc=base64_encode(base64_encode(json_encode($arr)));
		$link=$link="http://" . $_SERVER['SERVER_NAME']."/fp.php?enc=".$enc;
		$mess="Please click on the link below to reset your password!</br></br> ".$link;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: <info@johngaughanministries.com>' . "\r\n";
		$mail_status=mail($email, 'Reset link!', $mess,$headers);
						if($mail_status){
							echo json_encode(array('status' =>1,'mess'=>'A password reset link is sent to your mail'));
							return;
						}else{
							echo json_encode(array('status' =>1,'mess'=>'Some error occured, please try again later!'));
						return;
						}
					}else{
						echo json_encode(array('status' =>0,'mess'=>'Some error occured'));
	return;
					}
	}else{
	echo json_encode(array('status' =>0,'mess'=>'Invalid email'));
	return;
}
}


?>