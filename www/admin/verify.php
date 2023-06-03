<?php
// require all libs
require_once('../lib/lib.php');
// include header
include_once('../views/header.php');

Session::adminGuard();
$user = Session::getSessionUser();

if (Request::hasAllKeys($_GET, ['id'])) {
  $id = $_GET['id'];
  $user = User::findById($id);
  if ($user) {
    if ($user['id'] === Session::getSessionUser()['id']) {
      Response::showError('Cannot verify yourself');
    }
    else if ($user['verified']) {
      Response::showError('User is already verified');
    }
    else {
      User::verifyUser($id);
      Response::showSuccess('User is now verified');
    }
  }
  else {
    Response::showError('User not found');
  }
}
else {
  Response::showError('Missing required parameters');
}

// include footer
include_once('../views/footer.php');
?>
