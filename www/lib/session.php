<?php

session_start();

function user_guard() {
  if (!isset($_SESSION['user'])) {
    die("You are not logged in");
  }
}

function admin_guard() {
  user_guard();
  if (!$_SESSION['user']['admin']) {
    die("You are not an admin");
  }
}

function guest_guard() {
  if (isset($_SESSION['user'])) {
    die("You are already logged in");
  }
}

function set_session_user($user) {
  $_SESSION['user'] = $user;
}

function clear_session_user() {
  unset($_SESSION['user']);
}

function get_session_user() {
  user_guard();
  return $_SESSION['user'];
}

function is_logged_in() {
  return isset($_SESSION['user']);
}
