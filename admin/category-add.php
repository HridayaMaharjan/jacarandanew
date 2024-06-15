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
         <h4>Add Category
          <a href="category-view.php" class="btn btn-danger float-end">Back</a>
         </h4>
        </div>
    <div class="card-body">

      <form action="code.php" method="POST" enctype="multipart/form-data">
    
      <div class="row">

      <div class="col-md-6 mb-3">
        <label>Name: </label>
        <input type="text" name="name" required class="form-control">
      </div>

      <div class="col-md-6 mb-3">
        <label>Slug: </label>
        <input type="text" name="slug" required class="form-control">
      </div>

      <div class="col-md-12 mb-3">
        <label>Description: </label>
        <textarea name="description" class="form-control" rows="4"></textarea>
      </div>

      <div class="col-md-6 mb-3">
        <label>Image: </label>
        <input type="file" accept="image/png, image/jpeg, image/jpg" name="image" class="form-control">
       </div>
    
      <div class="col-md-6 mb-3">
        <label for="">Status: </label>
        <input type="checkbox" name="status" width="70px" height="70px">
      </div>
      
      <div class="row">
      <div class="col-md-6 mb-3">
        <button type="submit" class="btn btn-primary" name="category_add" >Save Item</button>
      </div>
      </div>

      </div>
    
      </form>
                
    </div>
    

    </div>
  </div>
 </div>
</div>

    
<?php
include('includes/footer.php');
include('includes/scripts.php');
?>