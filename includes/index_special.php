

<?php
include_once('functions/userfunctions.php');
?>

<style>
    #special .container {
    background-color: #cbcbcb;
}
    #special .py-5 {
    background-color: #e9e9e9;
}
    #special .card-img {
        height: 280px;
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
        padding-bottom: 5rem;

    }
</style>


<div id="special">
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title">culinary highlight</h1>
                <hr>
                <div class="row">

                <?php
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
                ?>

                <div class="col-md-12 text-center">
                <a href="special.php" class="btn btn-view-more">View More</a>
                </div>
        
                <?php
            } else {
                    echo "<p class='text-center'>No special items found.</p>";
                }
                ?>


                </div>
            </div>
            
        </div>
    </div>
</div>
</div>
