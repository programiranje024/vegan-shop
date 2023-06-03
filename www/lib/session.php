<?php

session_start();

class Session {

  static function userGuard() {
    if (!isset($_SESSION['user'])) {
      die("You are not logged in");
    }
  }

  static function adminGuard() {
    Session::userGuard();
    if (!$_SESSION['user']['admin']) {
      die("You are not an admin");
    }
  }

  static function guestGuard() {
    if (isset($_SESSION['user'])) {
      die("You are already logged in");
    }
  }

  static function setSessionUser($user) {
    $_SESSION['user'] = $user;
  }

  static function clearSessionUser() {
    unset($_SESSION['user']);
  }

  static function getSessionUser() {
    Session::userGuard();
    return $_SESSION['user'];
  }

  static function isLoggedIn() {
    return isset($_SESSION['user']);
  }

}
