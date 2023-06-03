<?php
// require all libs
require_once('../lib/lib.php');

guest_guard();

// form handler
if (is_submitted()) {
  if (has_all_keys($_POST, ['email', 'password'])) {
    $info = get_from_post(['email', 'password']);
    $user = login($info['email'], $info['password']);
    if ($user) {
      set_session_user($user);
      show_success("User logged in");
    } else {
      show_error("Invalid email or password");
    }
  }
  else {
    show_error("Please fill in all fields");
  }
}

// include header
include_once('../views/header.php');
?>
<?php 
if (!is_logged_in()) {
?>
<form action="/user/login.php" method="post">
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Password" required>
  <input type="submit" name="submit" value="Login">
</form>
<a href="/user/forgot-password.php">Forgot password?</a>
<?php
}
?>
