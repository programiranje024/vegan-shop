<?php
// require all libs
require_once('../lib/lib.php');

Session::guestGuard();

// form handler
if (Request::isSubmitted()) {
  if (Request::hasAllKeys($_POST, ['email'])) {
    $email = Request::getFromPost(['email'])['email'];
    if (User::requestPasswordChange($email)) {
      Response::showSuccess('Check your email for a link to reset your password');
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
  <form action="/user/forgot-password.php" method="post">
    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" type="email" name="email" placeholder="Email" required>
    </div>

    <input class="btn btn-primary mt-3" type="submit" name="submit" value="Reset Password">
  </form>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
