<?php

$localhost = "localhost";
$username = "root";
$password = "";
$database = "admin";

$con = mysqli_connect("$localhost","$username","$password","$database");

if(!$con){
    header("Location: ../errors/dberror.php");
    die();
}

?>