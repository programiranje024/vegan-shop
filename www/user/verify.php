<?php
// require all libs
require_once('../lib/lib.php');

Session::guestGuard();

// include header
include_once('../views/header.php');

// get the user id from the url
if (Request::hasAllKeys($_GET, ['token'])) {
  $info = Request::getFromGet(['token']);
  $token = $info['token'];

  // verify the user
  if (User::verifyUserWithToken($token)) {
    Response::showSuccess('User verified');
  } else {
    Response::showError('Invalid token');
  }
} else {
  Response::showError('Missing user id');
}

// include footer
include_once('../views/footer.php');
?>

