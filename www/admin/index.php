<?php
// require all libs
require_once('../lib/lib.php');
// include header
include_once('../views/header.php');

Session::adminGuard();
$user = Session::getSessionUser();
?>

<div class="container">
  <h1>Admin</h1>
  <p>Welcome, <?= $user['email'] ?>!</p>
  <p><a href="/admin/users.php">Users</a></p>
  <p><a href="/admin/products.php">Products</a></p>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
