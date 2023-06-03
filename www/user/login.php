<?php
// require all libs
require_once('../lib/lib.php');

Session::guestGuard();

// form handler
if (Request::isSubmitted()) {
  if (Request::hasAllKeys($_POST, ['email', 'password'])) {
    $info = Request::getFromPost(['email', 'password']);
    $user = User::login($info['email'], $info['password']);
    if ($user) {
      Session::setSessionUser($user);
      Response::showSuccess("User logged in");
    } else {
      Response::showError("Invalid email or password");
    }
  }
  else {
    Response::showError("Please fill in all fields");
  }
}

// include header
include_once('../views/header.php');
?>
<?php 
if (!Session::isLoggedIn()) {
?>
<div class="container">
  <form action="/user/login.php" method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" name="submit" value="Login">
  </form>
  <a href="/user/forgot-password.php">Forgot password?</a>
</div>
<?php
}
?>
<?php
// include footer
include_once('../views/footer.php');
?>
