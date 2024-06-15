<?php 
include('authentication.php');
include('includes/header.php');
include('includes/navbar.php');

$user_id = $_SESSION['auth_user']['user_id'];

$query = $con->prepare("SELECT * FROM `users` WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $phone = $_POST['phone'];
    $phone = filter_var($phone, FILTER_SANITIZE_STRING);

    if(!empty($name)){
        $name_parts = explode(' ', $name, 2);
        $fname = $name_parts[0];
        $lname = isset($name_parts[1]) ? $name_parts[1] : '';

        if(!empty($fname)){
            $update_name = $con->prepare("UPDATE `users` SET fname = ?, lname = ? WHERE id = ?");
            $update_name->bind_param("ssi", $fname, $lname, $user_id);
            if($update_name->execute()){
                $_SESSION['message'] = 'Name updated!';
            } else {
                $_SESSION['message'] = 'Error updating name!';
            }
        }
    }
    if(!empty($email)){
        $select_email = $con->prepare("SELECT * FROM `users` WHERE email = ?");
        $select_email->bind_param("s", $email);
        $select_email->execute();
        $select_email->store_result();
        if($select_email->num_rows > 0){
            $_SESSION['message'] = 'email already taken!';
        }else{
            $update_email = $con->prepare("UPDATE `users` SET email = ? WHERE id = ?");
            $update_email->bind_param("si", $email, $user_id);
            $update_email->execute();
            $_SESSION['message'] = 'email updated!';
        }
    }
    if(!empty($phone)){
        $select_phone = $con->prepare("SELECT * FROM `users` WHERE phone = ?");
        $select_phone->bind_param("s", $phone);
        $select_phone->execute();
        $select_phone->store_result();
        if($select_phone->num_rows > 0){
            $_SESSION['message'] = 'number already taken!';
        }else{
            $update_phone = $con->prepare("UPDATE `users` SET phone = ? WHERE id = ?");
            $update_phone->bind_param("si", $phone, $user_id);
            $update_phone->execute();
            $_SESSION['message'] = 'number updated!';
        }
    }
    if (!empty($_POST['old_pw']) && !empty($_POST['new_pw']) && !empty($_POST['confirm_pw'])) {
        $empty_pw = ''; // Correctly initializing the empty password
        $select_prev_pw = $con->prepare("SELECT password FROM `users` WHERE id = ?");
        $select_prev_pw->bind_param("i", $user_id);
        $select_prev_pw->execute();
        $select_prev_pw->store_result();
        $select_prev_pw->bind_result($prev_pw);
        $select_prev_pw->fetch();

        // Debugging: Check fetched previous password
        error_log("Fetched previous password: " . $prev_pw);

        $old_pw = $_POST['old_pw'];
        $old_pw = filter_var($old_pw, FILTER_SANITIZE_STRING);
        $new_pw = $_POST['new_pw'];
        $new_pw = filter_var($new_pw, FILTER_SANITIZE_STRING);
        $confirm_pw = $_POST['confirm_pw'];
        $confirm_pw = filter_var($confirm_pw, FILTER_SANITIZE_STRING);

        // Debugging: Check provided old password
        error_log("Provided old password: " . $old_pw);

        if ($old_pw != $empty_pw) {
            if ($old_pw != $prev_pw) {
                $_SESSION['message'] = 'Old password not matched!';
            } elseif ($new_pw != $confirm_pw) {
                $_SESSION['message'] = 'Passwords do not match!';
            } else {
                if ($new_pw != $empty_pw) {
                    $update_pw = $con->prepare("UPDATE `users` SET password = ? WHERE id = ?");
                    $update_pw->bind_param("si", $new_pw, $user_id);
                    if ($update_pw->execute()) {
                        $_SESSION['message'] = 'Password updated!';
                    } else {
                        $_SESSION['message'] = 'Error updating password!';
                        error_log("Error updating password: " . $update_pw->error);
                    }
                } else {
                    $_SESSION['message'] = 'Please enter new password!';
                }
            }
        }
    }
}

?>

<section class="form-container">
<?php include('message.php'); ?>
    <form action="" method="post">
    <a href="profile.php" class="btn bg-danger float-end">Back</a>
        <h3>update profile</h3>
        <input type="text" name="name" placeholder="<?php echo htmlspecialchars($user['fname'] . ' ' . $user['lname'], ENT_QUOTES); ?>" class="box" maxlength="100">  
        <input type="email" name="email" placeholder="<?php echo $_SESSION['auth_user']['user_email']; ?>" class="box" maxlength="50">
        <input type="number" name="phone" placeholder="<?php echo $user['phone']; ?>" class="box" max="9999999999" min="0" maxlength="10">
        <input type="password" name="old_pw" placeholder="enter your old password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="new_pw" placeholder="enter your new password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" name="confirm_pw" placeholder="confirm your new password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="update now" name="submit" class="btn">
    </form>
</section>

<?php
include('includes/footer.php');
?>