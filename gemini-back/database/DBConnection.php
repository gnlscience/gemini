<?php
require_once(__DIR__.'/../config.php');

class DBConnection{
    function getConnection(){

        $conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

        if($conn->connect_error){
            die("Connection Faild: ". $conn->connect_error);
        }
        return $conn;
    }
}
