<?php
session_start();
include('admin/config/dbcon.php');

if(isset($_POST['login_btn'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['pw']);

    $login_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
    $login_query_run = mysqli_query($con, $login_query);

    if(mysqli_num_rows($login_query_run) > 0)
    {
        foreach($login_query_run as $data){
            $user_id = $data['id'];
            $user_name = $data['fname'].' '.$data['lname'];
            $user_email = $data['email'];
            $role_as = $data['role_as'];
        }
        $_SESSION['auth'] = true;
        $_SESSION['auth_role'] = "$role_as"; 
        $_SESSION['auth_user'] = [
            'user_id' =>$user_id,
            'user_name' =>$user_name,
            'user_email' =>$user_email,
        ] ;

        if($_SESSION['auth_role'] == '1') //1=admin
        {
            $_SESSION['message'] = "Welcome";
            header("Location: admin/index.php");
            exit(0);  
        }
        elseif($_SESSION['auth_role'] == '0') //0=user
        {
            $_SESSION['message'] = "You are logged in";
            header("Location: index.php");
            exit(0); 
        }

    }
    else{
        $_SESSION['message'] = "Invalid Email or Password";
        header("Location: login.php");
        exit(0);
    }

}else{
    $_SESSION['message'] = "You are not allowed to access this file";
    header("Location: login.php");
    exit(0);
}


if(isset($_POST['update_user']))
{
    $user_id = $_POST['user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $query = "UPDATE users SET fname='$fname', lname='$lname', email='$email', phone='$phone', password='$password' WHERE id='$user_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Updated Successfully";
        header('Location: profile.php');
        exit(0);
    }
}

?>