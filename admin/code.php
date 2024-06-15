<?php

include('authentication.php');

if(isset($_POST['item_delete_btn']))
{
    $item_id = $_POST['item_delete_btn'];

    $check_img_query = "SELECT * FROM posts WHERE id='$item_id' LIMIT 1";
    $img_res = mysqli_query($con, $check_img_query);
    $res_data = mysqli_fetch_array($img_res);

    $image = $res_data['image'];
    
    $query = "DELETE FROM posts WHERE id='$item_id' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        if(file_exists('../uploads/posts/'.$image))
        {
         unlink("../uploads/posts/".$image);
        }
        
        $_SESSION['message'] = "Item deleted successfully";
        header('Location: item-view.php');
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something went wrong!!";
        header('Location: item-view.php');
        exit(0);
    }
}    


if(isset($_POST['item_update']))
{
    $item_id = $_POST['item_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $old_filename = $_POST['old_image'];
    $image = $_FILES['image']['name'];

    $update_filename = "";
    if($image != NULL)
    {
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_extension;
        $update_filename = $filename;
    }
    else
    {
        $update_filename = $old_filename;
    }

    $special = isset($_POST['special']) && $_POST['special'] == '1' ? '1' : '0';
    $status = isset($_POST['status']) && $_POST['status'] == '1' ? '1' : '0'; 


    $query = "UPDATE posts SET category_id='$category_id', name='$name', slug='$slug', price='$price', description='$description', image='$update_filename', special='$special', status='$status' WHERE id='$item_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        if($image != NULL){
            if(file_exists('../uploads/posts/'.$old_filename)){
                unlink("../uploads/posts/".$old_filename);

            }
            move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/posts/'.$update_filename);
        }
        
        $_SESSION['message'] = "Item updated successfully";
        header('Location: item-edit.php?id='.$item_id);
        exit(0);
    }else{
        $_SESSION['message'] = "Something went wrong!!";
        header('Location: item-edit.php?id='.$item_id);
        exit(0);
    }

}

if(isset($_POST['item_add']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_extension;

    $special = isset($_POST['special']) && $_POST['special'] == '1' ? '1' : '0';
    $status = isset($_POST['status']) && $_POST['status'] == '1' ? '1' : '0'; 


    $query = "INSERT INTO posts (category_id, name, slug, price, description, image, special, status) VALUES ('$category_id', '$name', '$slug', '$price', '$description', '$filename', '$special', '$status')";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/posts/'.$filename);
        $_SESSION['message'] = "Item created successfully";
        header('Location: item-add.php');
        exit(0);
    }else{
        $_SESSION['message'] = "Something went wrong!!";
        header('Location: item-add.php');
        exit(0);
    }

}

if(isset($_POST['category_delete']))
{
    $category_id = $_POST['category_delete'];

    // 2 = delete
    $query = "UPDATE menu SET status='2' WHERE id='$category_id' LIMIT 1";
    $query_run =mysqli_query($con, $query);

    if($query_run){
        $_SESSION['message'] = "Category deleted successfully";
        header('Location: category-view.php');
        exit(0);
    }else{
        $_SESSION['message'] = "Something went wrong!!";
        header('Location: category-view.php');
        exit(0);
    }

}

if(isset($_POST['category_update']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];

    $old_filename = $_POST['old_image'];
    $image = $_FILES['image']['name'];

    $update_filename = "";
    if($image != NULL)
    {
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_extension;
        $update_filename = $filename;
    }
    else
    {
        $update_filename = $old_filename;
    }

    $status = isset($_POST['status']) && $_POST['status'] == '1' ? '1' : '0'; 

    

    $query = "UPDATE menu SET name='$name', slug='$slug', description='$description', image='$update_filename', status='$status' WHERE id='$category_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        if($image != NULL){
            if(file_exists('../uploads/posts/'.$old_filename)){
                unlink("../uploads/posts/".$old_filename);

            }
            move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/posts/'.$update_filename);
        }
        $_SESSION['message'] = "Category updated successfully";
        header('Location: category-edit.php?id='.$category_id);
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Something went wrong!!";
        header('Location: category-edit.php?id='.$category_id);
        exit(0);
    }
    
}

if(isset($_POST['category_add']))
{
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_extension;

    $status = isset($_POST['status']) && $_POST['status'] == '1' ? '1' : '0'; 


    $query = "INSERT INTO menu (name, slug, description, image, status) VALUES ('$name', '$slug', '$description', '$filename', '$status')";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/posts/'.$filename);
        $_SESSION['message'] = "Category added successfully";
        header('Location: category-add.php');
        exit(0);
    }else{
        $_SESSION['message'] = "Something went wrong!!";
        header('Location: category-add.php');
        exit(0);
    }
}

if(isset($_POST['user_delete']))
{
    $user_id = $_POST['user_delete'];

    $query = "DELETE FROM users WHERE id='$user_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Deleted successfully";
        header('Location: view-register.php');
        exit(0);
    }
}

if(isset($_POST['add_user']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];
    $status = $_POST['status'] == true ? '1':'0';

    $query = "INSERT INTO users (fname, lname, email, address, phone, password, role_as, status) VALUES('$fname', '$lname', '$email', '$address', '$phone', '$password', '$role_as', '$status')";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        $_SESSION['message'] = "User added successfully";
        header('Location: view-register.php');
        exit(0);
    }else{
        $_SESSION['message'] = "Something went wrong!!";
        header('Location: view-register.php');
        exit(0);
    }
}


if(isset($_POST['update_user']))
{
    $user_id = $_POST['user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];
    $status = $_POST['status'] == true ? '1':'0';

    $query = "UPDATE users SET fname='$fname', lname='$lname', email='$email', address='$address', phone='$phone', password='$password', role_as='$role_as', status='$status' WHERE id='$user_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Updated Successfully";
        header('Location: view-register.php');
        exit(0);
    }
}

if(isset($_POST['update_order_btn']))
{
    $track_no = $_POST['tracking_no'];
    $order_status = $_POST['order_status'];

    $updateOrder_query = "UPDATE orders SET status='$order_status' WHERE tracking_no='$track_no' ";
    $updateOrder_query_run = mysqli_query($con, $updateOrder_query);

    $_SESSION['message'] = "Order status updated successfully";
        header('Location: view-order.php?id='.$track_no);
        exit(0);
}
?>