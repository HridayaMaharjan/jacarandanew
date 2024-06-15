

<?php
include('functions/userfunctions.php');
?>

<style>
   #menu .card-body{
        height: 250px;
        width: 300px;
    }
    #menu .card-body img{
        height: 190px;
    }
    #menu h1{
        margin-top: 3rem;
        margin-bottom: 4rem;
    }
    
</style>

<div id="menu">
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title">menu categories</h1>
                <hr>
                <div class="row">

                <?php
                $categories = getAllActive("menu");

                $display_limit = 4;
                $counter = 0;
                
                if(mysqli_num_rows($categories) > 0)
                {
                    foreach($categories as $item)
                    {
                        if($counter < $display_limit){

                        ?>
                        <div class="col-md-3 mb-5">
                            <a href="items.php?category=<?= $item['slug']; ?>">
                            <div class="card shadow h-100">
                            
                                    <img src="uploads/posts/<?= $item['image']; ?>" alt="Category Image" class="w-100 card-img">
                                <h4 class="text-center"><?= $item['name']; ?></h4>

                                
                            </div>
                            </a>
                        </div>
                        
                        <?php
                        $counter++;
                }
                else
                {
                    break;
                }
            }
            if(mysqli_num_rows($categories) > $display_limit){
                ?>
                <div class="col-md-12 text-center">
                <a href="menu.php" class="btn btn-view-more">View More</a>
                </div>
                <?php
            }
        }else{
            echo "No data availabe";
        }
        ?>
                </div>
            </div>
            
        </div>
    </div>
</div>
</div>
