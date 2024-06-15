<?php

session_start();
include('../admin/config/dbcon.php');

if(isset($_SESSION['auth']))
{

    if(isset($_POST['placeOrderBtn']))
    {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $pincode = mysqli_real_escape_string($con, $_POST['pincode']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $payment_mode = mysqli_real_escape_string($con, $_POST['payment_mode']);
        $payment_id = mysqli_real_escape_string($con, $_POST['payment_id']);

        if($name == "" || $email == "" || $phone == "" || $pincode == "" || $address == "")
        {
            $_SESSION['message'] = "All fields are mandatory";
            header('Location: ../checkout.php');
            exit(0);
        }

            $userId =  $_SESSION['auth_user']['user_id'];
            $query = "SELECT c.id as cid, c.item_id, c.item_qty, p.id as pid, p.name, p.image, p.price 
                  FROM carts c, posts p WHERE c.item_id = p.id AND c.user_id = '$userId' ORDER BY c.id DESC";
            $query_run = mysqli_query($con, $query);
            
        $totalPrice = 0;
            foreach ($query_run as $citem) 
            {           
                $totalPrice += $citem['price'] * $citem['item_qty'];
            }
        
        $tracking_no = "mhrz".rand(1111,9999).substr($phone,2);
        $insert_query = "INSERT INTO orders (tracking_no, user_id, name, email, phone,address, pincode, total_price, payment_mode, payment_id) VALUES ('$tracking_no', '$userId', '$name', '$email', '$phone', '$address', '$pincode', '$totalPrice', '$payment_mode', '$payment_id')";

        $insert_query_run = mysqli_query($con, $insert_query);

        if($insert_query_run)
        {
            $order_id = mysqli_insert_id($con);
                foreach ($query_run as $citem) 
                {
                    $item_id = $citem['item_id'];
                    $item_qty = $citem['item_qty'];
                    $price = $citem['price'];

            $insert_items_query = "INSERT INTO order_items (order_id, item_id, qty, price) VALUES ('$order_id', '$item_id', '$item_qty', '$price')";
            $insert_items_query_run = mysqli_query($con, $insert_items_query);

                }
            

            $deleteCartQuery = "DELETE FROM carts WHERE user_id='$userId'";
            $deleteCartQuery_run = mysqli_query($con, $deleteCartQuery);

            $_SESSION['message'] = "Order placed successfully";
            header('Location: ../my-orders.php');
            die();
        }
        
    }
}
else{
    header('Location: ../index.php');
}

?>