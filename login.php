<?php 
include('includes/header.php');
session_start();

if(isset($_SESSION['auth']))
{
    if(!isset($_SESSION['message'])){
    $_SESSION['message'] = "You are already logged in";
    }
    header("Location: index.php");
    exit(0);
}

include('includes/navbar.php');

if(isset($_GET['message']) && $_GET['message'] == 'please_login_to_continue') {
    $_SESSION['message'] = "Please login to continue";
}
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

            <?php include('message.php'); ?>

                <div class="card">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">

                    <form action="logincode.php" method="post">
                        <div class="form-group mb-3">
                            <label>Email Id</label>
                            <input type="email" name="email" placeholder="Enter Email Address" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label>Password</label>
                            <input type="password" name="pw" placeholder="Enter Password" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" name="login_btn" class="btn">Login</button>
                        </div>
                        <p>don't have an account? <a href="register.php">register now</a></p>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>