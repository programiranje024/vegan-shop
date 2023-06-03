<?php
// require all libs
require_once('db.php');

function make_admin($id) {
  $db = get_db();
  $stmt = $db->prepare('UPDATE users SET admin = 1 WHERE id = ?');
  $stmt->execute([$id]);
}
