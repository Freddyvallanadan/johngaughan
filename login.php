<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once './classes/Dbfunction.php';
if(isset($_POST['username'])){
    $username=$_POST['username'];
    $password=md5($_POST['password']);
 
$dbfunc=new Dbfunction();
$sql = "select * from user where username='".$username."'";

$result = $dbfunc->select_data($sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        if($password==$row["password"]){
            $msg=array("status"=>true,"msg"=>"success");
            echo json_encode($msg);
            $_SESSION['username']=$username;
           
        }
        else{
             $msg=array("status"=>false,"msg"=>"password");
            echo json_encode($msg);
        }
    }
} else {
     $msg=array("status"=>false,"msg"=>"username");
            echo json_encode($msg);
}
}


