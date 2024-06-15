<?php 
include('includes/header.php');

include('includes/navbar.php');
?>

<div class="py-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                
            <?php include('message.php'); ?>

                <div class="card">
                    <div class="card-header">
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">

                    <form action="registercode.php" method="post">
                    <div class="form-group mb-3">
                            <label>First Name</label>
                            <input required type="text" name="fname" placeholder="Enter First Name" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label>Last Name</label>
                            <input required type="text" name="lname" placeholder="Enter Last Name" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label>Email Id</label>
                            <input required type="email" name="email" placeholder="Enter Email ID" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label>Address</label>
                            <input required type="text" name="address" placeholder="Enter Address" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label>Phone No.</label>
                            <input type="tel" name="phone" pattern="9[0-9]{9}" placeholder="XX-XXXXXXXX" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label>Password</label>
                            <input required type="password" name="pw" placeholder="Enter Password" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label>Confirm Password</label>
                            <input required type="password" name="cpw" placeholder="Confirm Password" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <button required type="submit" name="register_btn" class="btn">Register</button>
                        </div>
                        <p>already have an account? <a href="login.php">login now</a></p>
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