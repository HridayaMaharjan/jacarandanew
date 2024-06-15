<?php 
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');

$user_id = $_SESSION['auth_user']['user_id'];
$query = "SELECT phone, address FROM users WHERE id='$user_id' LIMIT 1";
$query_run = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($query_run);
?>

<section class="user-details">
    <div class="user">
        <a href="index.php" class="btn bg-danger float-end">Back</a>
        <img src="includes/image/user-icon.png" alt="">
        <p><i class="fas fa-user"></i><span><?php echo $_SESSION['auth_user']['user_name']; ?></span></p>
        <p><i class="fas fa-phone"></i><span><?php echo $user['phone']; ?></span></p>
        <p><i class="fas fa-envelope"></i><span><?php echo $_SESSION['auth_user']['user_email']; ?></span></p>
        <a href="update_profile.php" class="btn">Update Info</a>
        
        <p class="address"><i class="fas fa-map-marker-alt"></i><span><?php echo $user['address']; ?></span></p>
        <a href="update_address.php" class="btn">Update Address</a>
    </div>
</section>

<?php
include('includes/footer.php');
?>
