<?php
session_start();
include ('includes/header.php');
include ('includes/navbar.php');

?>

<div class="row">
    <?php include ('message.php'); ?>

    <div id="webpage">
        <div id="webpage_content">
            <h1>JACARANDA TREE GARDEN RESTAURANT</h1>
            <h2>BRINGING CLASS TO CUISINE</h2>

        </div>
    </div>

</div>

<?php include ('includes/index_menu.php'); ?>
<?php include ('includes/index_special.php'); ?>
<?php include ('includes/review.php'); ?>


<section id="contact" class="contact">
    <h1 class="title">Contact Us</h1>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.1510459400515!2d85.31674699999998!3d27.681726099999988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1972274f1de5%3A0x4c111f6909984aea!2sJacaranda%20Tree%20Garden!5e0!3m2!1sen!2snp!4v1715184030763!5m2!1sen!2snp"
        width="100%" height="300" frameborder="0" style="border:0; outline:none;" allowfullscreen="" aria-hidden="false"
        tabindex="0"></iframe>

    <div class="box-container">

        <div class="box">
            <h4>quick links</h4>
            <a href="#webpage"><i class="fas fa-angle-right"></i>home</a>
            <a href="#menu"><i class="fas fa-angle-right"></i>menu</a>
            <a href="#special"><i class="fas fa-angle-right"></i>special dishes</a>
            <a href="#contact"><i class="fas fa-angle-right"></i>contact</a>
        </div>

        <div class="box">
            <h4>follow us</h4>
            <a href="https://www.facebook.com/jacarandatreegarden"><i class="fab fa-facebook-f"></i>facebook</a>
            <a href="https://www.instagram.com/jacaranda.tree.garden/"><i class="fab fa-instagram"></i>instagram</a>
        </div>
    </div>
</section>


<?php
include ('includes/footer.php');
?>