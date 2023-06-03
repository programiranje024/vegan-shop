<?php

class Response {

  static function showError($message) {
    echo "<div class='alert alert-danger' role='alert'>$message</div>";
  }

  static function showSuccess($message) {
    echo "<div class='alert alert-success' role='alert'>$message</div>";
  }

}
