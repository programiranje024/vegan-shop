<?php

class Db {
  static function get() {
    $username = "vegan";
    $password = "vegan";
    $hostname = "mysql";
    $database = "vegan";

    //connection to the database
    $db = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

    // die if something goes wrong
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // show errors
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    // if we didn't connect, then die
    if (!$db) {
        die('Could not connect to the database');
    }

    return $db;
  }
}
