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
         <h4>Edit Item
            <a href="item-view.php" class="btn btn-danger float-end">Back</a>
         </h4>
        </div>
    <div class="card-body">

        <?php
          if(isset($_GET['id']))
          {
            $item_id = $_GET['id'];
            $item_query = "SELECT * FROM posts WHERE id='$item_id' LIMIT 1";
            $item_query_res = mysqli_query($con, $item_query);

          if(mysqli_num_rows($item_query_res) > 0)
          {
            $item_row = mysqli_fetch_array($item_query_res);
        ?>

  <form action="code.php" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="item_id" value="<?= $item_row['id'] ?>">
    <div class="row">
      <div class="col-md-12 mb-3">
        <label for="">Category List</label>
         <?php
          $category = "SELECT * FROM menu WHERE status='0' ";
          $category_run = mysqli_query($con, $category);

          if(mysqli_num_rows($category_run) > 0)
          {
         ?>
            <select name="category_id" required class="form-control">
                <option value="">--Select Category--</option>
         <?php
               foreach($category_run as $categoryitem)
               {
         ?>
            <option value="<?= $categoryitem['id'] ?>" <?= $categoryitem['id'] == $item_row['category_id'] ? 'selected':'' ?> >
                 <?= $categoryitem['name'] ?>
            </option>
         <?php
            }    
         ?> 
            </select>
         <?php
         }
         else
         {
         ?>
            <h5>No Category Available</h5>
         <?php
         }
         ?>

      </div>
     <div class="col-md-6 mb-3">
        <label>Name: </label>
        <input type="text" name="name" value="<?= $item_row['name'] ?>" required class="form-control">
     </div>
     <div class="col-md-6 mb-3">
        <label>Slug: </label>
        <input type="text" name="slug" value="<?= $item_row['slug'] ?>" required class="form-control">
     </div>
     <div class="col-md-6 mb-3">
        <label>Price: </label>
        <input type="number" name="price" value="<?= $item_row['price'] ?>" required class="form-control">
     </div>
     <div class="col-md-12 mb-3">
        <label>Description: </label>
        <textarea name="description" class="form-control" rows="4"><?= $item_row['description'] ?></textarea>
     </div>
   
     <div class="col-md-6 mb-3">
        <label>Image: </label>
        <input type="hidden" name="old_image" value="<?= $item_row['image'] ?>" >
        <input type="file" accept="image/png, image/jpeg, image/jpg" name="image" class="form-control">
     </div>
     <div class="col-md-6 mb-3">
        <label for="">Special: </label>
        <input type="checkbox" name="special" <?= $item_row['special'] == '1' ? 'checked':'' ?> width="70px" height="70px">
     </div>
     <div class="col-md-6 mb-3">
        <label for="">Status: </label>
        <input type="checkbox" name="status" <?= $item_row['status'] == '1' ? 'checked':'' ?> width="70px" height="70px">
     </div>
     <div class="col-md-6 mb-3">
        <button type="submit" class="btn btn-primary" name="item_update" >Update Item</button>
     </div>
    </div>
    
  </form>

    <?php
        }
        else
        {
    ?>
        <h4>No Record Found</h4>
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