<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dbconnection{
    private $conn;
    

    function __construct() {
            
        $servername = "localhost";
        $username = "snake_john";
        $name = "snake_john";
        $password = "=4.;~aI$4fZ1";

        // Create connection
        $this->setConn(mysqli_connect($servername, $username, $password, $name));

        // Check connection
        if (!$this->getConn()) {
            die("Connection failed: " . mysqli_connect_error());
        }

    }

    public function getConn() {
        return $this->conn;
    }

    public function setConn($conn) {
        $this->conn = $conn;
    }

}