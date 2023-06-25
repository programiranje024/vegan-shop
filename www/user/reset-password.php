<?php
// require all libs
require_once('../lib/lib.php');

Session::guestGuard();
$handled = false;

// form handler
if (Request::isSubmitted()) {
  if (Request::hasAllKeys($_POST, ['password', 'token'])) {
    $password = $_POST['password'];
    $token = $_POST['token'];
    if (User::resetPassword($password, $token)) {
      Response::showSuccess('Password reset successfully');
      $handled = true;
    }
    else {
      Response::showError('Something went wrong');
    }
  }
  else {
    Response::showError('Please fill all fields');
  }
}

// include header
include_once('../views/header.php');
?>
<div class="container">
  <form action="/user/reset-password.php" method="post">
    <input type="password" name="password" placeholder="Password" required>
    <?php
    if (isset($_GET['token'])) {
    ?>
    <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
    <?php
    }
    ?>
    <input type="submit" name="submit" value="Reset Password"
    <?php
    if (!isset($_GET['token'])) {
      echo 'disabled';
    }
    ?>>
  </form>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
