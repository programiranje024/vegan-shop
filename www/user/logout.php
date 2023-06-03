<?php
// require all libs
require_once('../lib/lib.php');

Session::userGuard();
Session::clearSessionUser();

Response::showSuccess("User logged out");

// include header
include_once('../views/header.php');
// include footer
include_once('../views/footer.php');
?>
