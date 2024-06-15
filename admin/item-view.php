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
<h4>View Items
    <a href="item-add.php" class="btn btn-primary float-end">Add Item</a>
</h4>
        </div>
    <div class="card-body">

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Special</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // $items = "SELECT * FROM posts WHERE status!='2' ";
                $items = "SELECT p.*, m.name AS mname FROM posts p, menu m WHERE m.id = p.category_id ";

                $items_run = mysqli_query($con, $items);

                if(mysqli_num_rows($items_run) > 0)
                {
                    foreach($items_run as $item)
                    {
                        ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['mname'] ?></td>
                            <td><?= $item['price'] ?></td>
                            <td><img src="../uploads/posts/<?= $item['image'] ?>" width="60px" height="60px"></td>
                            
                            <td><?= $item['special'] == '1' ? 'Special':'Regular' ?></td>
                            <td><?= $item['status'] == '1' ? 'Hidden':'Visible' ?></td>
                            <td>
                                <a href="item-edit.php?id=<?= $item['id'] ?>" class="btn btn-success">Edit</a>
                            </td>
                            <td>
                                <form action="code.php" method="POST">
                                  <button type="submit" name="item_delete_btn" value="<?= $item['id'] ?>" class="btn btn-danger">Delete</button>
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
                    <td colspan="8">No Record Found</td>
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