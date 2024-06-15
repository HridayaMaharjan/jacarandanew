<?php
session_start();
include('../admin/config/dbcon.php');

if(isset($_SESSION['auth']))
{
    if(isset($_POST['scope']))
    {
    $scope = $_POST['scope'];
    switch($scope)
    {
        case "add";
        $item_id = $_POST['item_id'];
        $item_qty = $_POST['item_qty'];

        $user_id = $_SESSION['auth_user']['user_id'];

        $chk_existing_cart = "SELECT * FROM carts WHERE item_id = '$item_id' AND user_id = '$user_id'";
        $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

        if(mysqli_num_rows($chk_existing_cart_run) > 0)
        {
            echo "existing";
        }
        else
        {
     
        $insert_query = "INSERT INTO carts (user_id, item_id, item_qty) VALUES ('$user_id', '$item_id', '$item_qty')";
        $insert_query_run = mysqli_query($con, $insert_query);

        if($insert_query_run)
        {
            echo 201;
        }
        else
        {
            echo 500;
        }               
    }

        break;
        case "update";
        $item_id = $_POST['item_id'];
        $item_qty = $_POST['item_qty'];

        $user_id = $_SESSION['auth_user']['user_id'];
        
        $chk_existing_cart = "SELECT * FROM carts WHERE item_id = '$item_id' AND user_id = '$user_id'";
        $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

        if(mysqli_num_rows($chk_existing_cart_run) > 0)
        {
            $update_query = "UPDATE carts SET item_qty='$item_qty' WHERE item_id='$item_id' AND user_id='$user_id' ";
            $update_query_run = mysqli_query($con, $update_query);

            if($update_query_run){
                echo 200;
            }else{
                echo 500;
            }
        }
        else
        {
            echo "something went wrong";
        }
        break;

        case "delete";
        $cart_id = $_POST['cart_id'];
        $user_id = $_SESSION['auth_user']['user_id'];
        
        $chk_existing_cart = "SELECT * FROM carts WHERE id = '$cart_id' AND user_id = '$user_id'";
        $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

        if(mysqli_num_rows($chk_existing_cart_run) > 0)
        {
            $delete_query = "DELETE FROM carts WHERE id='$cart_id' ";
            $delete_query_run = mysqli_query($con, $delete_query);

            if($delete_query_run){
                echo 200;
            }else{
                echo "something went wrong";
            }
        }
        else
        {
            echo "something went wrong";
        }
        break;

        default:
        echo 500;
    }
    }
}
else{
    echo 401;
}

?>