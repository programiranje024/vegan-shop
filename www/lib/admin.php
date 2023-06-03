<?php
// require all libs
require_once('db.php');

class Admin {
  static function makeAdmin($id) {
    $db = Db::get();
    $stmt = $db->prepare('UPDATE users SET admin = 1 WHERE id = ?');
    $stmt->execute([$id]);
  }

  static function banUser($id) {
    $db = Db::get();
    $stmt = $db->prepare('UPDATE users SET verified = 0 WHERE id = ?');
    $stmt->execute([$id]);
  }
}
