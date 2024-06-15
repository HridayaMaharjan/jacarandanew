<style>
    h5 {
        text-transform: capitalize;
    }
    
    .col-md-2{
        margin-left: 1rem;
    }

    .custom-container {
        padding: 10px; /* Adjust padding to control height */
        margin-bottom: 1rem; /* Adjust bottom margin */
        background-color: #f8f9fa; /* Optional: Add background color */
        border: 1px solid #dee2e6; /* Optional: Add border */
        border-radius: 5px; /* Optional: Add border radius */
        max-width: 1000px; /* Set maximum width */
        margin: 0 auto; /* Center the container */
        
    }

    .custom-body {
        padding: 10px; /* Adjust padding to control height */
        min-height: 400px; /* Set minimum height */
    }

    .item_data {
        padding: 5px; /* Reduce padding inside item_data */
        margin-bottom: 5px; /* Reduce bottom margin of item_data */
    }

    .item_data .row {
        margin: 0; /* Remove margin from rows */
        padding: 5px 0; /* Add padding to rows for spacing */
    }

    .item_data img {
        height: auto; /* Adjust as needed */
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
    <h3>checkout</h3>
    <p><a href="index.php">home</a><span> / checkout</span></p>
</div>
<?php include('message.php'); ?>

<div class="py-5">
    <div class="container">
        <div class="custom-container">
          <div class="custom-body shadow py-5">
            <form action="functions/placeorder.php" method="post">
               <div class="row">
               <div class="col-md-7">
                        <h5>Basic Details</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Name</label>
                                <input type="text" name="name" placeholder="Enter your full name" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">E-mail</label>
                                <input type="email" name="email" placeholder="Enter your email" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Phone</label>
                                <input type="text" name="phone" placeholder="Enter your phone number" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Pin Code</label>
                                <input type="text" name="pincode" required placeholder="Enter your pin code" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Address</label>
                                <textarea name="address" required class="form-control" row="5"></textarea>
                            </div>
                        </div>
                </div>
                <div class="col-md-5">
                    <h5>Order Details</h5>
                    <hr>
        
            <?php 
            $items = getCartItems();
            $totalPrice = 0;

            if (!empty($items)) {
                foreach ($items as $citem) 
                {
                    ?>
                     <div class="mb-1 border">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <img src="uploads/posts/<?= $citem['image']; ?>" alt="Image" class="w-100">
                            </div>
                            <div class="col-md-4">
                                <label><?= $citem['name']; ?></label>
                            </div>
                            <div class="col-md-3">
                                <label><?= $citem['price']; ?></label>
                            </div>
                            <div class="col-md-2">
                                <label>x <?= $citem['item_qty']; ?></label>
                            </div>   
                        </div>
                        </div>
                    <?php
                    $totalPrice += $citem['price'] * $citem['item_qty'];
                }
            }
           ?>
           <hr>
      <h5>Total Price : <span class="float-end"><?= $totalPrice ?></span></h5>
      <div class="">
        <input type="hidden" name="payment_mode" value="COD">
        <button type="submit" name="placeOrderBtn" class="btn w-100" style="color:white; background-color:green; padding:2px 3px">place order</button>
      </div>
      
                </div>
               </div>
            </form>
          </div>
        </div>
    </div>
</div>

    <?php
    include('includes/footer.php');
    ?>
