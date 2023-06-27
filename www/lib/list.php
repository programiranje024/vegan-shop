<?php
// require all libs
require_once('db.php');

class ShoppingList {
  static function getAllLists() {
    $db = Db::get();
    $stmt = $db->prepare('SELECT * FROM shopping_list');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  static function getById($id) {
    $db = Db::get();
    $stmt = $db->prepare('SELECT * FROM shopping_list WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  static function getListsByUser($user_id) {
    $db = Db::get();
    $stmt = $db->prepare('SELECT * FROM shopping_list WHERE user_id = :user_id');
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  static function create($name, $user_id) {
    $db = Db::get();
    $stmt = $db->prepare('INSERT INTO shopping_list (name, user_id) VALUES (:name, :user_id)');
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    return $db->lastInsertId();
  }

  static function delete($id) {
    $db = Db::get();
    $stmt = $db->prepare('DELETE FROM shopping_list WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
  }

  static function update($id, $name) {
    $db = Db::get();
    $stmt = $db->prepare('UPDATE shopping_list SET name = :name WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->execute();
  }

  static function getItems($list_id) {
    $db = Db::get();
    $stmt = $db->prepare('SELECT * FROM shopping_list_items WHERE shopping_list_id = :list_id');
    $stmt->bindParam(':list_id', $list_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  static function addItemToList($list_id, $product_id) {
    $db = Db::get();
    $stmt = $db->prepare('INSERT INTO shopping_list_items (shopping_list_id, product_id) VALUES (:list_id, :product_id)');
    $stmt->bindParam(':list_id', $list_id);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();
    return $db->lastInsertId();
  }

  static function removeItemFromList($list_id, $product_id) {
    $db = Db::get();
    $stmt = $db->prepare('DELETE FROM shopping_list_items WHERE shopping_list_id = :list_id AND product_id = :product_id');
    $stmt->bindParam(':list_id', $list_id);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();
  }
}

