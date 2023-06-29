<?php
// require all libs
require_once('db.php');

class Product {
  static function getAll() {
    $db = Db::get();
    $stmt = $db->prepare('SELECT * FROM products');
    $stmt->execute();
    return $stmt->fetchAll();
  }

  static function create($name, $description, $price, $image) {
    $db = Db::get();
    $stmt = $db->prepare('INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)');
    $stmt->execute([$name, $description, $price, $image]);
  }

  static function delete($id) {
    $db = Db::get();
    $stmt = $db->prepare('DELETE FROM products WHERE id = ?');
    $stmt->execute([$id]);
  }

  static function update($id, $name, $description, $price, $image) {
    $db = Db::get();
    $stmt = $db->prepare('UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?');
    $stmt->execute([$name, $description, $price, $image, $id]);
  }

  static function findById($id) {
    $db = Db::get();
    $stmt = $db->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch();
  }

  static function addToCart($product_id, $user_id) {
    $db = Db::get();
    $stmt = $db->prepare('INSERT INTO cart (product_id, user_id) VALUES (?, ?)');
    $stmt->execute([$product_id, $user_id]);
  }

  static function removeFromCart($product_id, $user_id) {
    $db = Db::get();
    $stmt = $db->prepare('DELETE FROM cart WHERE product_id = ? AND user_id = ?');
    $stmt->execute([$product_id, $user_id]);
  }

  static function getCartItems($user_id) {
    $db = Db::get();
    $stmt = $db->prepare('SELECT product_id AS id, name, description, price, COUNT(*) AS quantity FROM cart JOIN products ON products.id = cart.product_id WHERE user_id = ? GROUP BY id');
    $stmt->execute([$user_id]);
    // filter out all where ID is null
    return array_filter($stmt->fetchAll(), function($item) {
      return $item['id'] !== null;
    });
  }

  static function getCartItemCount($user_id) {
    $db = Db::get();
    $stmt = $db->prepare('SELECT COUNT(*) AS count FROM cart WHERE user_id = ?');
    $stmt->execute([$user_id]);
    return $stmt->fetch()['count'];
  }

  static function clearCart($user_id) {
    $db = Db::get();
    $stmt = $db->prepare('DELETE FROM cart WHERE user_id = ?');
    $stmt->execute([$user_id]);
  }

  static function finishOrder($user_id) {
    $items = self::getCartItems($user_id);
    $user = User::findById($user_id);

    $db = Db::get();
    $stmt = $db->prepare('INSERT INTO orders (user_id) VALUES (?)');
    $stmt->execute([$user_id]);
    $order_id = $db->lastInsertId();
    foreach ($items as $item) {
      $stmt = $db->prepare('INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)');
      $stmt->execute([$order_id, $item['id'], $item['quantity']]);
    }
    $stmt = $db->prepare('DELETE FROM cart WHERE user_id = ?');

    $item_names = array_map(function($item) {
      return $item['name'];
    }, $items);

    Mailer::sendMail($user['email'], 'Order placed', 'Your order has been placed. Your items: ' . implode(', ', $item_names) . '. Your order ID is: ' . $order_id);
    $stmt->execute([$user_id]);
  }

  static function getRecentlyOrderedProducts($user_id) {
    $db = Db::get();
    $stmt = $db->prepare('SELECT products.id, products.name, products.description, products.price, COUNT(*) AS quantity FROM order_items JOIN products ON products.id = order_items.product_id JOIN orders ON orders.id = order_items.order_id WHERE orders.user_id = ? GROUP BY products.id ORDER BY orders.id DESC LIMIT 5');
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
  }
}
