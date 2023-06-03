<?php
// require all libs
require_once('../lib/lib.php');

Session::guestGuard();

// form handler
if (Request::isSubmitted()) {
  if (Request::hasAllKeys($_POST, ['email'])) {
    $email = Request::getFromPost(['email'])['email'];
    $user = User::findUserByEmail($email);

    $generated_password = User::generatePassword();

    if ($user) {
      User::updatePassword($user['id'], $generated_password);
      Mailer::sendMail($email, 'Reset Password', 'Your password is: ' . $generated_password . '. Please login and change it');

      Response::showSuccess('Password reset successfully');
    }
    else {
      Response::showError('User not found');
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
    <input type="email" name="email" placeholder="Email" required>
    <input type="submit" name="submit" value="Reset Password">
  </form>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
