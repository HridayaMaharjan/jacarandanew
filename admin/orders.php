
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
                            <h4>Orders
                                <a href="order-history.php" class="btn btn-warning float-end">Order History</a>
                            </h4>
                        </div>
                <div class="card-body" id="">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Tracking No</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orders = getAllOrders();

                            if(mysqli_num_rows($orders) > 0)
                            {
                                foreach ($orders as $item) {
                                ?>
                                <tr>
                                  <td><?= $item['id']; ?></td>
                                  <td><?= $item['name']; ?></td>
                                  <td><?= $item['tracking_no']; ?></td>
                                  <td><?= $item['total_price']; ?></td>
                                  <td><?= $item['created_at']; ?></td>
                                  <td>
                                    <a href="view-order.php?t=<?= $item['tracking_no']; ?>" class="btn btn-danger">view details</a>
                                  </td>
                                </tr>
                                <?php
                                }
                            }else{
                                ?>
                                <tr>
                                  <td colspan="5">No orders yet</td>
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

    <?php
    include('includes/footer.php');
    ?>