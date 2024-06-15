<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Key Activities</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                           
                            <a class="nav-link" href="view-register.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Registered Users
                            </a>
                            <div class="sb-sidenav-menu-heading">Navigation</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Categories
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="category-add.php">Add Category</a>
                                    <a class="nav-link" href="category-view.php">View Category</a>
                                </nav> 
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePosts" aria-expanded="false" aria-controls="collapsePosts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Items
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePosts" aria-labelledby="Posts" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="item-add.php">Add Item</a>
                                    <a class="nav-link" href="item-view.php">View Items</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="orders.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Orders
                            </a>
                           
                           
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php if(isset($_SESSION['auth_user'])) : ?>
                        <?= $_SESSION['auth_user']['user_name']; ?>
                        <?php endif; ?>
                    </div>
                </nav>
</div>