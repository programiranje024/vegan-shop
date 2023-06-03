<?php
// require all libs
require_once('db.php');

function get_all_products() {
  $db = get_db();
  $stmt = $db->prepare('SELECT * FROM products');
  $stmt->execute();
  return $stmt->fetchAll();
}

function create_product($name, $description, $price, $image) {
  $db = get_db();
  $stmt = $db->prepare('INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)');
  $stmt->execute([$name, $description, $price, $image]);
}

function delete_product($id) {
  $db = get_db();
  $stmt = $db->prepare('DELETE FROM products WHERE id = ?');
  $stmt->execute([$id]);
}

function update_product($id, $name, $description, $price, $image) {
  $db = get_db();
  $stmt = $db->prepare('UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?');
  $stmt->execute([$name, $description, $price, $image, $id]);
}

function find_product_by_id($id) {
  $db = get_db();
  $stmt = $db->prepare('SELECT * FROM products WHERE id = ?');
  $stmt->execute([$id]);
  return $stmt->fetch();
}
