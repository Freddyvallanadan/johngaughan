<?php
include_once './classes/Dbfunction.php';
$dbfunc=new Dbfunction();
$dbfunc->login_check();
$id=$_POST["id"];
$result = $dbfunc->delete_data($id);
if($result){
	$result=array('result' => "Deleted Successfully");
}else{
	$result==array('result' => "Not Deleted");
}
echo json_encode($result);