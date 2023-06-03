<?php
// require all libs
require_once('../lib/lib.php');

guest_guard();

// form handler
if (is_submitted()) {
  if (has_all_keys($_POST, ['email'])) {
    $email = get_from_post(['email'])['email'];
    $user = find_user_by_email($email);

    $generated_password = generate_password();

    if ($user) {
      update_password($user['id'], $generated_password);
      send_mail($email, 'Reset Password', 'Your password is: ' . $generated_password . '. Please login and change it');

      show_success('Password reset successfully');
    }
    else {
      show_error('User not found');
    }
  }
  else {
    show_error('Please fill all fields');
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
