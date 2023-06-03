<?php

function get_from_get($keys) {
    $result = [];
    foreach ($keys as $key) {
        if (isset($_GET[$key])) {
            $result[$key] = $_GET[$key];
        }
    }
    return $result;
}

function get_from_post($keys) {
    $result = [];
    foreach ($keys as $key) {
        if (isset($_POST[$key])) {
            $result[$key] = $_POST[$key];
        }
    }
    return $result;
}

function has_all_keys($array, $keys) {
    foreach ($keys as $key) {
        if (!isset($array[$key])) {
            return false;
        }
    }
    return true;
}

function is_submitted() {
  return isset($_POST['submit']);
}

function upload_image() {
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
    return basename($target_file);
  } else {
    return false;
  }
}
