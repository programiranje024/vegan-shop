<?php
$logged_in = is_logged_in();
?>
<nav>
  <ul>
    <li><a href="/index.php">Home</a></li>
    <?php if ($logged_in) { ?>
      <li><a href="/user/profile.php">Profile</a></li>
      <li><a href="/user/cart.php">Cart</a></li>
    <?php if (get_session_user()['admin']) { ?>
      <li><a href="/admin/index.php">Admin</a></li>
    <?php } ?>
      <li><a href="/user/logout.php">Logout</a></li>
    <?php } else { ?>
      <li><a href="/user/login.php">Login</a></li>
      <li><a href="/user/register.php">Register</a></li>
    <?php } ?>
  </ul>
</nav>

