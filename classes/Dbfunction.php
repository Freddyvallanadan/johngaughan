<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once './classes/Dbconnection.php';
class Dbfunction{
    public function select_data($sql) {
          $db = new Dbconnection();
          $result = mysqli_query($db->getConn(), $sql);
          return $result;
    }
   public function delete_data($id) {
          $db = new Dbconnection();
          $sql="SELECT `image` FROM `blog_info` WHERE `id` =".$id;
          $result=$this->select_data($sql);
          $row = mysqli_fetch_array($result);
          if($row[0]!=""){
          if (file_exists("upload_images/".$row[0])) {
    unlink("upload_images/".$row[0]);
  }
}
          $sql="DELETE FROM `blog_info` WHERE `id` =".$id;
          $result = mysqli_query($db->getConn(), $sql);
          return $result;
    }
    public function edit_data($sql) {
          $db = new Dbconnection();
          $result = mysqli_query($db->getConn(), $sql);
          return $result;
    }
    public function login_check(){
        if(!isset($_SESSION['username']))
        {
          return false;
        }
        return true;
    }
     public function insert_data($sql) {
          $db = new Dbconnection();
          $result = mysqli_query($db->getConn(), $sql)or die(mysqli_error($db->getConn()));
          return $result;
    }
    public function albums(){
      return array(
                array(
                  "id"=>1001,
                  "album_title"=>"ThankYou Very Much",
                  "album_price"=>6.50,
                  "link"=>"http://www.johngaughanministries.com/downloads/ThankYou_Very_Much.zip"
                  ),
                 array(
                  "id"=>1002,
                  "album_title"=>"Love is the Key",
                  "album_price"=>6.50,
                  "link"=>"http://www.johngaughanministries.com/downloads/Love_is_the_Key.zip"
                  ),
                  array(
                  "id"=>1003,
                  "album_title"=>"Lord Jesus, You are so Beautiful",
                  "album_price"=>6.50,
                  "link"=>"http://www.johngaughanministries.com/downloads/Lord_Jesus_You_are_so_Beautiful.zip"
                  )
        );
    }
    
}
