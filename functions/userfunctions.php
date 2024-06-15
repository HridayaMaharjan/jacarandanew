<?php

include('admin/config/dbcon.php');

function getAllActive($table)
{
    global $con;
    $query = "SELECT * FROM $table WHERE status='0' ";
    return $query_run = mysqli_query($con, $query);
}

function getSlugActive($table, $slug)
{
    global $con;
    $query = "SELECT * FROM $table WHERE slug='$slug' AND status='0' LIMIT 1";
    return $query_run = mysqli_query($con, $query);
}

function getProdByCategory($category_id)
{
    global $con;
    $query = "SELECT * FROM posts WHERE category_id=$category_id AND status='0' ";
    return $query_run = mysqli_query($con, $query);
}

function getIDActive($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id=$id AND status='0' ";
    return $query_run = mysqli_query($con, $query);
}

function getCartItems()
{
    global $con;
    if(isset($_SESSION['auth_user'])){
    $userId =  $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.item_id, c.item_qty, p.id as pid, p.name, p.image, p.price FROM carts c, posts p WHERE c.item_id = p.id AND c.user_id = '$userId' ORDER BY c.id DESC";
    return $query_run = mysqli_query($con, $query);
    }else{
        return[]; 
    }
}


function getOrders()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM orders WHERE user_id='$userId' ORDER BY id DESC";
    return $query_run = mysqli_query($con, $query);
}

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit(0);
}

function checkTrackingNoValid($trackingNo)
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE tracking_no='$trackingNo' AND user_id='$userId'";
    return mysqli_query($con, $query);
}

?>