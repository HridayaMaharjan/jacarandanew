<?php

include('authentication.php');
include('includes/header.php');

?>

<div class="container-fluid px-4">
        <h1 class="mt-4">Menu</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body">Total Categories
                                        <?php
                                        $dash_category_query = "SELECT * from menu";
                                        $dash_category_query_run = mysqli_query($con, $dash_category_query);

                                        if($category_total = mysqli_num_rows($dash_category_query_run))
                                        {
                                            echo '<h4 class="mb-0">'.$category_total.'</h4>';
                                        }
                                        else
                                        {
                                            echo '<h4 class="mb-0">No Data</h4>';
                                        } 
                                        ?>
                                    
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body">Total Items
                                    <?php
                                        $dash_items_query = "SELECT * from posts";
                                        $dash_items_query_run = mysqli_query($con, $dash_items_query);

                                        if($items_total = mysqli_num_rows($dash_items_query_run))
                                        {
                                            echo '<h4 class="mb-0">'.$items_total.'</h4>';
                                        }
                                        else
                                        {
                                            echo '<h4 class="mb-0">No Data</h4>';
                                        } 
                                        ?>
                                    
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body">Total Users
                                    <?php
                                        $dash_users_query = "SELECT * from users";
                                        $dash_users_query_run = mysqli_query($con, $dash_users_query);

                                        if($users_total = mysqli_num_rows($dash_users_query_run))
                                        {
                                            echo '<h4 class="mb-0">'.$users_total.'</h4>';
                                        }
                                        else
                                        {
                                            echo '<h4 class="mb-0">No Data</h4>';
                                        } 
                                        ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    </div>
                                </div>
                            </div>
            </div>
</div>
    
<?php
include('includes/footer.php');
include('includes/scripts.php');
?>