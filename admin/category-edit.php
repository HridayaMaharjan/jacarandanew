<?php

include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    
<div class="row mt-4">

<div class="col-md-12">

<?php include('message.php'); ?>

    <div class="card">
      <div class="card-header">
       <h4>Edit Category
        <a href="category-view.php" class="btn btn-danger float-end">Back</a>
       </h4>
      </div>
    <div class="card-body">

    <?php
    if(isset($_GET['id']))
    {
    $category_id = $_GET['id'];
    $category_edit = "SELECT * FROM menu WHERE id='$category_id' LIMIT 1";
    $category_run = mysqli_query($con, $category_edit);

    if(mysqli_num_rows($category_run) > 0)
    {
        $row = mysqli_fetch_array($category_run);
        ?>


<form action="code.php" method="POST" enctype="multipart/form-data">
   <input type="hidden" name="category_id" value="<?= $row['id'] ?>">
    <div class="row">
     <div class="col-md-6 mb-3">
        <label>Name: </label>
        <input type="text" name="name" value="<?= $row['name'] ?>" required class="form-control">
     </div>

     <div class="col-md-6 mb-3">
        <label>Slug: </label>
        <input type="text" name="slug" value="<?= $row['slug'] ?>" required class="form-control">
     </div>
     
     <div class="col-md-12 mb-3">
        <label>Description: </label>
        <textarea name="description" class="form-control" rows="4"><?= $row['description'] ?></textarea>
     </div>

     <div class="col-md-6 mb-3">
      <label>Image:</label>
      <input type="hidden" name="old_image" value="<?= $row['image'] ?>" >
      <input type="file" accept="image/png, image/jpeg, image.jpg" name="image" class="form-control">
     </div>
     
     <div class="col-md-6 mb-3">
        <label for="">Status: </label>
        <input type="checkbox" name="status" <?= $row['status'] == '1'? 'checked':'' ?> width="70px" height="70px">
     </div>
     <div class="col-md-6 mb-3">
        <button type="submit" class="btn btn-primary" name="category_update" >Update Item</button>
     </div>
    </div>
</form>

    <?php
    }
    else
    {
        ?>
        <h4>No record found</h4>
        <?php
    }
    }

    ?>
                
            
        

        </div>
    </div>
</div>
</div>
</div>
    
<?php
include('includes/footer.php');
include('includes/scripts.php');
?>