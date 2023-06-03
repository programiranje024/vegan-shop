<?php
// require all libs
require_once('../lib/lib.php');

guest_guard();

// include header
include_once('../views/header.php');

// get the user id from the url
if (has_all_keys($_GET, ['id'])) {
  $info = get_from_get(['id']);
  $user_id = $info['id'];

  // verify the user
  show_success('User verified');
} else {
  show_error('Missing user id');
}

// include footer
include_once('../views/footer.php');
?>

