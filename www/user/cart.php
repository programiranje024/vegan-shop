<?php
// require all libs
require_once('../lib/lib.php');

// include header
include_once('../views/header.php');

user_guard();

$user = get_session_user();
$items = get_cart_items($user['id']);

if (is_submitted()) {
  if (has_all_keys($_POST, ['id'])) {
    $id = $_POST['id'];
    $product = find_product_by_id($id);
    if ($product) {
      remove_from_cart($id, $user['id']);
      show_success('Product removed from cart');
      $items = get_cart_items($user['id']);
    }
    else {
      show_error('Product not found');
    }
  }
  else {
    make_order($user['id']);
    show_success('Order placed');
    $items = [];
  }
}
?>

<div class="container">
  <h1>Cart</h1>
  <?php if(empty($items)) { ?>
  <p>Your cart is empty</p>
  <?php } else { ?>
  <table>
    <thead>
      <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $total = 0;
      foreach ($items as $item) {
        $product = find_product_by_id($item['id']);
        $subtotal = $product['price'] * $item['quantity'];
        $total += $subtotal;
      ?>
        <tr>
          <td><?= $product['name'] ?></td>
          <td><?= $product['price'] ?></td>
          <td><?= $item['quantity'] ?></td>
          <td><?= $subtotal ?></td>
          <td>
            <form action="/user/cart.php" method="post">
              <input type="hidden" name="id" value="<?= $item['id'] ?>" />
              <input type="submit" name="submit" value="Remove" />
            </form>
          </td>
        </tr>
      <?php
      }
      ?>
  </table>
  <p>Total: <?= $total ?></p>
  <form action="/user/cart.php" method="post">
    <input type="submit" name="submit" value="Checkout" />
  </form>
  <?php } ?>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
