<style>
    h5 {
        text-transform: capitalize;
    }
    
    .col-md-2{
        margin-left: 1rem;
    }
   
</style>

<?php
session_start();
include('functions/userfunctions.php');
include('includes/header.php');

if (!isset($_SESSION['auth_user'])) {
    $_SESSION['message'] = "Log in to view your cart.";
    header("Location: login.php");
    exit(0);
}
?>

<div class="heading">
    <h3>my cart</h3>
    <p><a href="index.php">home</a><span> / cart</span></p>
</div>

<div class="py-5">
    <div class="container">
        <div id="mycart">
    <?php 
            $items = getCartItems();

            if(mysqli_num_rows($items) > 0){
        ?>
      <div id="">
            <?php
            if (!empty($items)) {
                foreach ($items as $citem) {
                    ?>
                     <div class="container item_data">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <img src="uploads/posts/<?= $citem['image']; ?>" alt="Image" width="150px" height="100px">
                            </div>
                            <div class="col-md-3">
                                <h5><?= $citem['name']; ?></h5>
                            </div>
                            <div class="col-md-2">
                                <h5>Rs. <?= $citem['price']; ?></h5>
                            </div>
                            <div class="col-md-2">
                                <input type="hidden" class="itemId" value="<?= $citem['item_id']; ?>">
                                <div class="input-group mb-2" style="width:120px">
                                    <button class="input-group-text decrement-btn updateQty">-</button>
                                    <input type="text" class="form-control text-center input-qty bg-white" value="<?= $citem['item_qty']; ?>" disabled>
                                    <button class="input-group-text increment-btn updateQty">+</button>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn deleteItem" value="<?= $citem['cid']; ?>" style="color:white; background-color:red; padding:2px 3px"><i class="fas fa-trash me-2"></i>remove</button>
                            </div>
                        </div>
                        </div>
                    
                    <?php
                }
            } else {
                echo "<p>No items in the cart</p>";
            }
        
            ?>
      </div>
      <div class="float-end">
        <a href="checkout.php" class="btn" style="color:white; background-color:green; padding:2px 3px">proceed to checkout</a>
      </div>
      <?php
            }else{
                ?>
                <div class="custom-container text-center">
                    <h4 class="py-3">Your cart is empty</h4>
                </div>
                <?php
            }
      ?>
      </div>
    </div>
</div>

    <?php
    include('includes/footer.php');
    ?>
