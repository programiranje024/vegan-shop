<?php
// require all libs
require_once('../lib/lib.php');

guest_guard();

// include header
include_once('../views/header.php');

// form handler
if (is_submitted()) {
  if (has_all_keys($_POST, ['email', 'password', 'confirm_password'])) {
    $info = get_from_post(['email', 'password', 'confirm_password']);
    if (passwords_match($info['password'], $info['confirm_password'])) {
      $user = create_user($info['email'], $info['password']);
      if ($user) {
        show_success("User created. Check your email to activate your account.");
      } else {
        show_error("Email already taken");
      }
    } else {
      show_error("Passwords don't match");
    }
  }
  else {
    show_error("Please fill in all fields");
  }
}
?>

<div class="container">
  <form action="/user/register.php" method="post">
    <input type="emal" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    <input type="submit" name="submit" value="Register">
  </form>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
