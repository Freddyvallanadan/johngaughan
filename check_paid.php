<?php
include_once './classes/Dbfunction.php';
	$dbfunc=new Dbfunction();
	$email = $_POST['email']; 
	$sql="select * from buyer where email_id='".$email."'";
	$result=$dbfunc->select_data($sql);
	$num=mysqli_num_rows($result);
	if($num>0){
	$row=mysqli_fetch_array($result);
	$album=explode(',',$row['albums']);
	
	// print_r($album);
	
	foreach ($album as  $value) {
		// echo $value;
		if($value==$_POST['id']){
			
			foreach ($dbfunc->albums() as $val) {
				if($val['id']==$value){
						$a=array(
							"email"=>$email,
							"id"=>$_POST['id'],
							"timestamp"=>time()
							);
						$enc=base64_encode(base64_encode(json_encode($a)));
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From: <info@johngaughanministries.com>' . "\r\n";
						$link="http://" . $_SERVER['SERVER_NAME']."/download.php?enc=".$enc;
						$message="Please click on the new link below to download the album you purchased! </br> </br> <a href='".$link."'>Download Link</a></br> </br> Note: This link will be automatically disabled in 1 hour! If this link goes invalid, providing your email ID again in the site will get you an updated download link!";
						$mail_status=mail($email, 'John Gaughan :: Please find your new download link!', $message,$headers);
						if($mail_status){
							echo json_encode(array('status' =>1,'mess'=>'You have already purchased this album! A new link is sent to your mail.'));
							return;
						}else{
							echo json_encode(array('status' =>1,'mess'=>'Some error occured, please try again later!'));
						return;
						}

				}
			}
		}
		
	}
	echo json_encode(array('status' =>0,'mess'=>''));
	return;
}else{
	echo json_encode(array('status' =>0,'mess'=>''));
	return;
}


?>