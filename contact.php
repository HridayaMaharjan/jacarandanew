<?php

include('includes/header.php');


if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $msg = $_POST['message'];
    $msg = filter_var($msg, FILTER_SANITIZE_STRING);

    $user_id = isset($_SESSION['auth_user']['user_id']) ? $_SESSION['auth_user']['user_id'] : 1;

    // Prepare and execute the select query
    $select_message = $con->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
    $select_message->bind_param("ssss", $name, $email, $number, $msg);
    $select_message->execute();
    $select_message->store_result();

    if($select_message->num_rows > 0){
        $_SESSION['message'] = 'Message sent already!';
    } else {
        // Prepare and execute the insert query
        $insert_message = $con->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
        $insert_message->bind_param("issss", $user_id, $name, $email, $number, $msg);
        if ($insert_message->execute()) {
            $_SESSION['message'] = 'Message sent successfully!';
        } else {
            $_SESSION['message'] = 'Error sending message!';
        }
    }

    $select_message->close();
    $insert_message->close();
}

?>

<div class="heading">
    <h3>contact us</h3>
    <p><a href="index.php">home</a><span> / contact</span></p>
</div>

<section class="contact">
<?php include('message.php'); ?>

   <div class="row">

   <div class="image">
    <img src="includes/image/contact.jpg" alt="">
   </div>

   
        <form action="" method="post">
            <h3>get in touch</h3>
                <input type="text" required placeholder="enter your name" maxlength="50" name="name" class="box">
                <input type="email" required placeholder="enter your email" maxlength="50" name="email" class="box">
                <input type="number" required placeholder="enter your number" maxlength="10" min="0" max="9999999999" name="number" class="box">       
            <textarea name="message" class="box" required maxlength="500" cols="30" rows="10" placeholder="message"></textarea>
            <input type="submit" value="send message" name="submit" class="btn">
        </form>
    </div>
 

<div class="box-container">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.1510459400515!2d85.31674699999998!3d27.681726099999988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1972274f1de5%3A0x4c111f6909984aea!2sJacaranda%20Tree%20Garden!5e0!3m2!1sen!2snp!4v1715184030763!5m2!1sen!2snp" width="100%" height="500" frameborder="0" style="border:0; outline:none;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

  

    <div class="box">
        <h4>follow us</h4>
        <a href="https://www.facebook.com/jacarandatreegarden"><i class="fab fa-facebook-f"></i>facebook</a>
        <a href="https://www.instagram.com/jacaranda.tree.garden/"><i class="fab fa-instagram"></i>instagram</a>
    </div>

    </div> 
</section>

<?php
include('includes/footer.php');
?>




        