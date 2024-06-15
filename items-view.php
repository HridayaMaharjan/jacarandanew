<?php
include('functions/userfunctions.php');
include('includes/header.php');
include ('message.php');

if(isset($_GET['items']))
{
    $items_slug = $_GET['items'];
    $items_data = getSlugActive("posts", $items_slug);
    $items = mysqli_fetch_array($items_data);

    if($items)
    {
        ?>

<div class="heading">
    <h3>food items</h3>
    <p><a href="index.php">home</a><span> / <a href="menu.php">categories</a> / <?= $items['name']; ?></span></p>
</div>
         <div class="bg-light py-4">
         <div class="container item_data">
            <div class="row">
                <div class="col-md-4">
                <img src="uploads/posts/<?= $items['image']; ?>" alt="Items Image" class="w-100">
                </div>
                <div class="col-md-8">
                    <h3 class="fw-bold"><?= $items['name']; ?>
                      <span class="float-end text-danger"><?php if($items['special']){ echo "Special"; } ?></span>
                    </h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5><span> Rs.</span> <?= $items['price']; ?> </h5>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3" style="width:130px">
                              <button class="input-group-text decrement-btn">-</button>
                             <input type="text" class="form-control text-center input-qty bg-white" value="1" disabled>
                             <button class="input-group-text increment-btn">+</button>
                            </div>
                        </div>
                    </div>
                    
                    <p><?= $items['description']; ?></p>
                    <div class="row-mt-3">
    <div class="col-md-6">
        <button class="btn px-4 addToCartBtn" value="<?= $items['id']; ?>"><i class="fa fa-shopping-cart me-2"></i>Add to Cart</button>
    </div>
</div>
                   
                </div>

            </div>
        </div>
         </div>
        
        <?php
    }
    else{
        echo "Items Not Found";
    }
}
else
  {
      echo "Something went wrong.";
  }


include('includes/footer.php');
?>
