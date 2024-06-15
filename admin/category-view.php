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
          <h4>View Categories
            <a href="category-add.php" class="btn btn-primary float-end">Add Category</a>
          </h4>
        </div>
      <div class="card-body">

      <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>   
            </thead>
        <tbody>
            <?php
                $category = "SELECT * FROM menu WHERE status!='2' ";
                $category_run = mysqli_query($con, $category);

               if(mysqli_num_rows($category_run) > 0)
              {
              foreach($category_run as $items)
              {
            ?>
              <tr>
                <td><?= $items['id'] ?></td>
                <td><?= $items['name'] ?></td>  
                <td><img src="../uploads/posts/<?= $items['image'] ?>" width="60px" height="60px"></td>
                <td>
                    <?php 
                    if($items['status']=='1'){ echo 'Hidden';} else{ echo 'Visible';} 
                    ?>
                </td>
                <td>
                    <a href="category-edit.php?id=<?= $items['id'] ?>" class="btn btn-info">Edit</a>
                </td>
                <td>
                  <form action="code.php" method="POST">
                    <button type="submit" name="category_delete" value="<?= $items['id'] ?>" class="btn btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
          <?php
             }
             }
             else
             {
          ?>
          <tr>
            <td colspan="6">No record found</td>
          </tr>
         <?php
           }
         ?>
            

        </tbody>
        </table>
      </div>
      </div>

    </div>
  </div>
 </div>
</div>

    
<?php
include('includes/footer.php');
include('includes/scripts.php');
?>