<?php 
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');

if(isset($_POST['submit'])){
    $address = $_POST['street'].', '.$_POST['ward'].', '.$_POST['city'].', '.$_POST['district'].', -'.$_POST['pin_code'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);

    $update_address = $con->prepare("UPDATE `users` SET address = ? WHERE id = ?");
    $update_address->bind_param("si", $address, $user_id);
    if ($update_address->execute()) {
        if ($update_address->affected_rows > 0) {
            $_SESSION['message'] = 'Address updated!';
            // Debugging: Check if update query executed successfully
            error_log("Address updated successfully!");
        } else {
            $_SESSION['message'] = 'Address not updated!';
            // Debugging: Check if update query executed but didn't affect any rows
            error_log("Address not updated!");
        }
    } else {
        $_SESSION['message'] = 'Error updating address!';
        // Debugging: Check for any errors in the update query
        error_log("Error updating address: " . $update_address->error);
    }
    $update_address->close();
}
?>

<section class="form-container">
<?php include('message.php'); ?>
    <form action="" method="post">
    <a href="profile.php" class="btn bg-danger float-end">Back</a>
        <h3>your address</h3>
        <input type="text" class="box" placeholder="street name" maxlength="50"  name="street">
        <input type="text" class="box" placeholder="ward no." maxlength="50"  name="ward">
        <input type="text" class="box" placeholder="city name" maxlength="50"  name="city">
        <input type="text" class="box" placeholder="district name" maxlength="50"  name="district">
        <input type="number" required class="box" placeholder="pin code" maxlength="6" max="999999" min="0" name="pin_code">

        <input type="submit" value="save address" name="submit" class="btn">
    </form>
</section>

<?php
include('includes/footer.php');
?>
