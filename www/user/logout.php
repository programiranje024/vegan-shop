<?php
// require all libs
require_once('../lib/lib.php');

user_guard();
clear_session_user();

show_success("User logged out");

// include header
include_once('../views/header.php');
?>
