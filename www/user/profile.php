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
?>

<div class="container">
  <p>Logged in as: <?= $user['email'] ?></p>
  <form action="/user/profile.php" method="post">
    <input type="password" name="password" placeholder="Password">
    <input type="password" name="old_password" placeholder="Old password">
    <input type="submit" name="submit" value="Change password">
  </form>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
