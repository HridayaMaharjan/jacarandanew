<?php
session_start();
include('admin/config/dbcon.php');

if(!isset($_SESSION['auth']))
{
    $_SESSION['message'] = "Login to access";
    header("Location: login.php");
    exit(0);
}else
{
    if($_SESSION['auth_role'] != "0" && $_SESSION['auth_role'] != "1")
    {
        $_SESSION['message'] = "You do not have permission to access this page";
    header("Location: login.php");
    exit(0);

    }
}


?>