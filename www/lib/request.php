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
