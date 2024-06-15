
<style>
  .navbar {
    padding: 0 3rem; /* Adjust as necessary */
  }
  .navbar-brand {
    margin-right: 2rem; /* Space between logo and nav items */
  }
  .navbar-nav.mx-auto {
    margin-left: 0;
    margin-right: 0;
  }
  .navbar-nav.user-items {
    margin-left: 1rem; /* Space between nav items and user items */
  }
  .navbar-nav > li > a {
    padding: 0.5rem 1rem; /* Adjust padding inside nav links */
  }
  .navbar-nav .nav-item .nav-link .cart-icon {
    display: inline-flex;
    align-items: center;
  }
  .navbar-nav .nav-item .nav-link .cart-icon span {
    margin-left: 0.5rem; /* Adjust space between icon and span */
  }
  
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">

    <a class="navbar-brand" href="#"><img src="assets/images/main-logo.jpeg" class="img-fluid" alt="Jacaranda"></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#menu">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="contact.php">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#special">Special Offers</a>
        </li>
        </ul>
        <ul class="navbar-nav">
        
        <li class="nav-item">
        <a class="nav-link active" href="cart.php">
            <div class="cart-icon">
              <i class="fas fa-shopping-cart"></i><span></span>
            </div>
          </a>
        </li>
        
        <?php if (isset($_SESSION['auth_user'])): ?>
          <!-- Only show dropdown if user is logged in -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <?= $_SESSION['auth_user']['user_name']; ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="profile.php">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="allcode.php" method="post">
                  <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
                </form>
              </li>
            </ul>
          </li>
        <?php endif; ?>
      </ul>
    </div>

  </div>
</nav>
