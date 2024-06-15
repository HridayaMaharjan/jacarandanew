

<?php
include('functions/userfunctions.php');
include('includes/header.php');

if(isset($_GET['category']))
{

$category_slug = $_GET['category'];
$category_data = getSlugActive("menu", $category_slug);
$category = mysqli_fetch_array($category_data);

if($category)
{

$cid = $category['id'];
?>

<div class="heading">
    <h3>food items</h3>
    <p><a href="index.php">home</a><span> / <a href="menu.php">categories</a> / <?= $category['name']; ?></span></p>
</div>


<div id="menu">
<div class="py-4">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
                <h1 class="text-center"><?= $category['name']; ?></h1>
                <hr>
                <div class="row justify-content-between">

                <?php
                $items = getProdByCategory("$cid");
                
                if(mysqli_num_rows($items) > 0)
                {
                    foreach($items as $item)
                    {
                        ?>
                        <div class="col-md-3 mb-4">
                        <a href="items-view.php?items=<?= $item['slug']; ?>">
                        <div class="card shadow h-100">
                                <div class="card-body">
                                <img src="uploads/posts/<?= $item['image']; ?>" alt="Item Image" width="100" height="180" class="w-100 card-img">
                                <h4 class="name text-center"><?= $item['name']; ?></h4>
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


<?php
  }
  else
    {
        echo "Something went wrong.";
    }
  }
  else
    {
        echo "Something went wrong.";
    }

?>


