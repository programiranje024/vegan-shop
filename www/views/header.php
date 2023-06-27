<?php
$logged_in = Session::isLoggedIn();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Vegan Shop</title>
  <link rel="stylesheet" type="text/css" href="/css/main.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <nav>
    <ul>
      <li><a href="/index.php">Home</a></li>
      <?php if ($logged_in) { ?>
        <li><a href="/user/profile.php">Profile</a></li>
        <li><a href="/user/cart.php">Cart</a></li>
        <li><a href="/user/shopping-lists.php">Shopping Lists</a></li>
      <?php if (Session::getSessionUser()['admin']) { ?>
        <li><a href="/admin/index.php">Admin</a></li>
      <?php } ?>
        <li><a href="/user/logout.php">Logout</a></li>
      <?php } else { ?>
        <li><a href="/user/login.php">Login</a></li>
        <li><a href="/user/register.php">Register</a></li>
      <?php } ?>
    </ul>
  </nav>
