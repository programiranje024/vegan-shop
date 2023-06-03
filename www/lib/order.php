<?php

function add_to_cart($product_id, $user_id) {
  $db = get_db();
  $stmt = $db->prepare('INSERT INTO cart (product_id, user_id) VALUES (?, ?)');
  $stmt->execute([$product_id, $user_id]);
}

function remove_from_cart($product_id, $user_id) {
  $db = get_db();
  $stmt = $db->prepare('DELETE FROM cart WHERE product_id = ? AND user_id = ?');
  $stmt->execute([$product_id, $user_id]);
}

function get_cart_items($user_id) {
  $db = get_db();
  $stmt = $db->prepare('SELECT product_id AS id, name, description, price, COUNT(*) AS quantity FROM cart JOIN products ON products.id = cart.product_id WHERE user_id = ? GROUP BY id');
  $stmt->execute([$user_id]);
  // filter out all where ID is null
  return array_filter($stmt->fetchAll(), function($item) {
    return $item['id'] !== null;
  });
}

function make_order($user_id) {
  $items = get_cart_items($user_id);
  $user = find_user_by_id($user_id);
  $db = get_db();
  $stmt = $db->prepare('INSERT INTO orders (user_id) VALUES (?)');
  $stmt->execute([$user_id]);
  $order_id = $db->lastInsertId();

  foreach ($items as $item) {
    $stmt = $db->prepare('INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)');
    $stmt->execute([$order_id, $item['id'], $item['quantity']]);
  }

  $stmt = $db->prepare('DELETE FROM cart WHERE user_id = ?');
  $stmt->execute([$user_id]);

  $item_names = array_map(function($item) {
    return $item['name'];
  }, $items);

  send_mail($user['email'], 'Order confirmation', 'Your order has been placed. Your order no. is ' . $order_id . '. Your items are: ' . implode(', ', $item_names) . '. Thank you for shopping with us!');

}
