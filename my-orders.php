<style>
    h5 {
        text-transform: capitalize;
    }
    
    .col-md-2{
        margin-left: 1rem;
    }
   
</style>

<?php
session_start();
include('functions/userfunctions.php');
include('includes/header.php');

if (!isset($_SESSION['auth_user'])) {
    $_SESSION['message'] = "Log in to view your cart.";
    header("Location: login.php");
    exit(0);
}
?>

<div class="heading">
    <h3>my orders</h3>
    <p><a href="index.php">home</a><span> / orders</span></p>
</div>

<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tracking No</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orders = getOrders();

                            if(mysqli_num_rows($orders) > 0)
                            {
                                foreach ($orders as $item) {
                                ?>
                                <tr>
                                  <td><?= $item['id']; ?></td>
                                  <td><?= $item['tracking_no']; ?></td>
                                  <td><?= $item['total_price']; ?></td>
                                  <td><?= $item['created_at']; ?></td>
                                  <td>
                                    <a href="view-order.php?t=<?= $item['tracking_no']; ?>" class="btn">view details</a>
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
