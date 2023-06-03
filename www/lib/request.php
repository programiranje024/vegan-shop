<?php

class Request {
  static function getFromGet($keys) {
    $result = [];
    foreach ($keys as $key) {
      if (isset($_GET[$key])) {
        $result[$key] = $_GET[$key];
      }
    }
    return $result;
  }

  static function getFromPost($keys) {
    $result = [];
    foreach ($keys as $key) {
      if (isset($_POST[$key])) {
        $result[$key] = $_POST[$key];
      }
    }
    return $result;
  }

  static function hasAllKeys($array, $keys) {
    foreach ($keys as $key) {
      if (!isset($array[$key])) {
        return false;
      }
    }
    return true;
  }

  static function isSubmitted() {
    return isset($_POST['submit']);
  }

  static function uploadImage() {
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if(!$check) {
      return false;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      return false;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
      return false;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
      return false;
    }

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      // return the filename but without the path
      return basename($_FILES["image"]["name"]);
    } else {
      return false;
    }
  }
}
