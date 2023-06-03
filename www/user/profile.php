<?php
// require all libs
require_once('../lib/lib.php');

$user = get_session_user();

// include header
include_once('../views/header.php');

if (is_submitted()) {
  if (has_all_keys($_POST, ['password', 'old_password'])) {
    $info = get_from_post(['password', 'old_password']);

    $password = $info['password'];
    $old_password = $info['old_password'];

    if (change_password($user['id'], $password, $old_password)) {
      show_success('Password changed');
    } else {
      show_error('Old password is incorrect');
    }
  } 
  else {
    show_error('Please fill in all fields');
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
