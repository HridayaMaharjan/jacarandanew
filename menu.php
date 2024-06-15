

<?php
include('functions/userfunctions.php');
include('includes/header.php');
?>

<div class="heading">
    <h3>menu categories</h3>
    <p><a href="index.php">home</a><span> / categories</span></p>
</div>

<div id="menu">
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <div class="row">

                <?php
                $categories = getAllActive("menu");
                
                if(mysqli_num_rows($categories) > 0)
                {
                    foreach($categories as $item)
                    {
                        ?>
                        <div class="col-md-3 mb-5">
                            <a href="items.php?category=<?= $item['slug']; ?>">
                            <div class="card shadow h-100">
                                <div class="card-body">
                                    <img src="uploads/posts/<?= $item['image']; ?>" alt="Category Image" class="w-100 card-img">
                                <h4 class="text-center"><?= $item['name']; ?></h4>

                                </div>
                            </div>
                            </a>
                        </div>
                        
                        <?php
                    }
                }
                else
                {
                    echo "No data available";
                }

                ?>
                </div>
            </div>
            
        </div>
    </div>
</div>
</div>
