<?php
// require all libs
require_once('../lib/lib.php');

$user = Session::getSessionUser();

// include header
include_once('../views/header.php');

if (Request::isSubmitted()) {
  if (Request::hasAllKeys($_POST, ['password', 'old_password'])) {
    $info = Request::getFromPost(['password', 'old_password']);

    $password = $info['password'];
    $old_password = $info['old_password'];

    if (User::changePassword($user['id'], $password, $old_password)) {
      Response::showSuccess('Password changed');
    } else {
      Response::showError('Old password is incorrect');
    }
  } 
  else {
    Response::showError('Please fill in all fields');
  }
}

$recently_ordered_products = Product::getRecentlyOrderedProducts($user['id']);
?>

<div class="container">
  <p>Logged in as: 
    <span class="font-weight-bold">
      <?= $user['email'] ?>
    </span>
  </p>
  <form action="/user/profile.php" method="post">
    <div class="form-group">
      <label for="password">Password</label>
      <input class="form-control" type="password" name="password" placeholder="Password" required>
    </div>

    <div class="form-group">
      <label for="old_password">Old password</label>
      <input class="form-control" type="password" name="old_password" placeholder="Old password" required>
    </div>

    <input class="btn btn-primary mt-3" type="submit" name="submit" value="Change password">
  </form>
  <?php if (!empty($recently_ordered_products)) { ?>
  <hr />
  <p>Recently ordered products:</p>
  <ul>
  <?php foreach($recently_ordered_products as $product) { ?>
    <li>
      <a href="/product.php?id=<?= $product['id'] ?>">
        <?= $product['name'] ?>
      </a>
    </li>
  <?php } ?>
  </ul>
  <?php } ?>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
