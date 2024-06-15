

<?php
include('functions/userfunctions.php');
include('includes/header.php');

?>

<style>
    .card-img {
        height: 300px; /* Set the desired height for the images */
    }
    .price {
        position: relative;
    }

    .regular-price {
        text-decoration: line-through red;
        color: black;
    }

    .discounted-price {
        position: absolute;
        top: 100%;
        left: 0;
    color: green;
    font-weight: bold;

    }
</style>

<div class="heading">
    <h3>culinary highlight</h3>
    <p><a href="index.php">home</a><span> / special</span></p>
</div>

<div id="special">
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">

                <?php
// Fetch only special items
                  $special_items_query = "SELECT p.*, m.name AS mname FROM posts p, menu m WHERE m.id = p.category_id AND p.special = '1'";
                  $special_items_run = mysqli_query($con, $special_items_query);

                if(mysqli_num_rows($special_items_run) > 0) {
                 foreach($special_items_run as $special_item) {
                    $regular_price = $special_item['price']; // Regular price
                                $discount_percentage = $special_item['discount_percentage']; // Discount percentage

                                $discounted_price = $regular_price - ($regular_price * $discount_percentage / 100); // Calculate discounted price
                ?>
                  <div class="col-md-4 mb-5">
                   <a href="items.php?items=<?= $special_item['slug']; ?>">
                    <div class="card shadow h-100">
                     <div class="card-body">
                      <img src="uploads/posts/<?= $special_item['image']; ?>" alt="Category Image" class="w-100 card-img">
                        <h4 class="text-center"><?= $special_item['name']; ?></h4>
                        <h4 class="text-center price">
                                            <span class="regular-price">Rs.<?= $regular_price ?></span>
                                            <span class="discounted-price">Rs.<?= $discounted_price ?></span>
                                        </h4>
                     </div>
                    </div>
                   </a>
                  </div>
        
                <?php
    
                }
               } else {
                         echo "No special items found.";
                      }
                ?>


                </div>
            </div>
            
        </div>
    </div>
</div>
</div>
