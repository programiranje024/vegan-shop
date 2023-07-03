<?php
// require all libs
require_once('../lib/lib.php');

Session::userGuard();
Session::clearSessionUser();

// include header
include_once('../views/header.php');

Response::showSuccess("User logged out");

// include footer
include_once('../views/footer.php');
?>
