<?php
$logged_in = Session::isLoggedIn();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Vegan Shop</title>
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://bootswatch.com/5/superhero/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/main.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="/index.php">Home</a>
          </li>
          <?php if ($logged_in) { ?>
            <li class="nav-item">
              <a class="nav-link" href="/user/profile.php">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id='cart-link' href="/user/cart.php">Cart</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/user/shopping-lists.php">Shopping Lists</a>
            </li>
          <?php if (Session::getSessionUser()['admin']) { ?>
            <li class="nav-item">
              <a class="nav-link" href="/admin/index.php">Admin</a>
            </li>
          <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="/user/logout.php">Logout</a>
            </li>
          <?php } else { ?>
            <li class="nav-item">
              <a class="nav-link" href="/user/login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/user/register.php">Register</a>
            </li>
          <?php } ?>
        </ul>
    </div>
  </nav>
