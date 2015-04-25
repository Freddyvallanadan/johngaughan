<?php
include_once './classes/Dbfunction.php';
$dbfunc=new Dbfunction();
$dbfunc->login_check();
if(isset($_POST["edit"])){
    $key=$_POST['id'];
    $sql="SELECT * FROM `blog_info` WHERE `id`=".$key;
    $dir="upload_images";
  // $sql = "select * from blog_info where title='".$key."%' OR desc='".$key."%'";
if (!file_exists($dir) && !is_dir($dir)) {
    mkdir($dir);         
}
$result = $dbfunc->select_data($sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
   $msg_array=array();
   while($row = mysqli_fetch_assoc($result)){
       $da=$row['entered'];
       $id=$row['id'];
       $msg_array['author']=$row['author'];
$msg_array['title']=$row['title'];
 $msg_array['desc'] =$row['desc']; 
 $msg_array['image'] =$row['image']; 
}
echo json_encode($msg_array);
}
}
if(isset($_POST["form_val"])){
  $file_upload="true";
  if($_POST["form_val"]=="update"){
    if (is_uploaded_file($_FILES["image_file"]['tmp_name'])) {
      if(isset($_POST['old_image'])){
      if (file_exists($_POST['old_image'])) {
    unlink($_POST['old_image']);
  }
}
  

if (!($_FILES["image_file"]["type"] =="image/jpeg" OR $_FILES["image_file"]["type"] =="image/gif"OR $_FILES["image_file"]["type"] =="image/png"))
{$file_upload="false";}

$file_name=time().$_FILES["image_file"]["name"];
$add="upload_images/".$file_name;

 // the path with the file name where the file will be stored
if($file_upload=="true"){
if(move_uploaded_file ($_FILES["image_file"]["tmp_name"], $add)){
  
}else{$file_upload="false";}
}
    }else{
      $file_upload="false";
    }
    if ($file_upload=="true") {
     $sql="UPDATE `blog_info` SET `title`='".addslashes($_POST["title"])."',`desc`='".addslashes($_POST["desc"])."',`author`='".addslashes($_POST["author"])."',`image`='".$file_name."' WHERE `id` =".$_POST["id"];
    
    }else{
      if($_FILES["image_file"]["tmp_name"]!="")
	$sql="UPDATE `blog_info` SET `title`='".addslashes($_POST["title"])."',`desc`='".addslashes($_POST["desc"])."',`author`='".addslashes($_POST["author"])."' WHERE `id` =".$_POST["id"];
else
 $sql="UPDATE `blog_info` SET `title`='".addslashes($_POST["title"])."',`desc`='".addslashes($_POST["desc"])."',`author`='".addslashes($_POST["author"])."',`image`='' WHERE `id` =".$_POST["id"]; 
}
$result = $dbfunc->edit_data($sql);
if($result){
  $result=array('result' => "updated Successfully");
}else{
  $result==array('result' => "Not updated");
}
echo json_encode($result);
}
else  if($_POST["form_val"]=="add"){
    $title=$_POST["title"];
    $desc=$_POST["desc"];
    $author=$_POST["author"];
    $file_upload="true";
    if (is_uploaded_file($_FILES["image_file"]['tmp_name'])) {
       

if (!($_FILES["image_file"]["type"] =="image/jpeg" OR $_FILES["image_file"]["type"] =="image/gif"OR $_FILES["image_file"]["type"] =="image/png"))
{$file_upload="false";}
$file_name=time().$_FILES["image_file"]["name"];
$add="upload_images/".$file_name;
 // the path with the file name where the file will be stored
if($file_upload=="true"){
if(move_uploaded_file ($_FILES["image_file"]["tmp_name"], $add)){
}else{$file_upload="false";}
}
}else{
  $file_upload="false";
}

$author = addslashes($author);
$title = addslashes($title);
$desc = addslashes($desc);
if($file_upload=="true"){
    $sql="INSERT INTO `blog_info`(`title`, `desc`,`author`,`image`) VALUES ('".$title."','".$desc."','".$author."','".$file_name."')";
    
  }else{
       $sql="INSERT INTO `blog_info`(`title`, `desc`,`author`) VALUES ('".$title."','".$desc."','".$author."')";
    }
    if(!$dbfunc->insert_data($sql)){
       $msg=array("status"=>false);
       echo json_encode($msg);
    }
    else{
        $msg=array("status"=>true);
       echo json_encode($msg);
    }
}
}


?>