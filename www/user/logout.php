<?php
// require all libs
require_once('../lib/lib.php');

// include header
include_once('../views/header.php');

user_guard();
clear_session_user();

show_success("User logged out");
?>
