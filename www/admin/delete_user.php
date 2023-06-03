<?php
// require all libs
require_once('../lib/lib.php');
// include header
include_once('../views/header.php');

admin_guard();
$user = get_session_user();

if (has_all_keys($_GET, ['id'])) {
  $id = $_GET['id'];
  $user = find_user_by_id($id);
  if ($user) {
    if ($user['id'] === get_session_user()['id']) {
      show_error('Cannot delete yourself');
    }
    else {
      delete_user($id);
      show_success('User is now deleted');
    }
  }
  else {
    show_error('User not found');
  }
}
else {
  show_error('Missing required parameters');
}
