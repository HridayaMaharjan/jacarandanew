<?php
session_start();

include('admin/config/dbcon.php');

if(isset($_POST['register_btn'])){

    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con,$_POST['lname']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $phone = mysqli_real_escape_string($con,$_POST['phone']);
    $password = mysqli_real_escape_string($con,$_POST['pw']);
    $confirm_password = mysqli_real_escape_string($con,$_POST['cpw']);

    if (!preg_match('/^9[0-9]{9}$/', $phone)) {
        $_SESSION['message'] = "Invalid phone number format (e.g., 98X-XXXXXXX)";
        header("Location: register.php");
        exit(0);
    }

    if($password == $confirm_password){
        $checkemail = "SELECT email FROM users WHERE email = '$email'";
        $checkemail_run = mysqli_query($con, $checkemail);

        if(mysqli_num_rows($checkemail_run)>0){
            $_SESSION['message'] = "Already exists email";
            header("Location:register.php");
            exit(0);
        }
        else{
            $user_query = "INSERT INTO users(fname,lname,email, address, phone, password) VALUES('$fname','$lname','$email', '$address', '$phone', '$password')";
            $user_query_run = mysqli_query($con, $user_query);

            if($user_query_run){
                $_SESSION['message'] = "Registered Successfully";
                header("Location:login.php");
                exit(0);
            }
            else{
                $_SESSION['message'] = "Something went wrong";
                header("Location:register.php");
                exit(0);
            }
        }

    }else{
        $_SESSION['message'] = "Password does not match";
        header("Location: register.php");
        exit(0);
    }
    
}
else{
    header("Location: register.php");
    exit(0);
}

?>