<?php
// require all libs
require_once('../lib/lib.php');

// include header
include_once('../views/header.php');

Session::userGuard();

$user = Session::getSessionUser();
$items = Product::getCartItems($user['id']);

if (Request::isSubmitted()) {
  if (Request::hasAllKeys($_POST, ['id'])) {
    $id = $_POST['id'];
    $product = Product::findById($id);
    if ($product) {
      Product::removeFromCart($id, $user['id']);
      Response::showSuccess('Product removed from cart');
      $items = Product::getCartItems($user['id']);
    }
    else {
      Response::showError('Product not found');
    }
  }
  else {
    Product::finishOrder($user['id']);
    Response::showSuccess('Order placed');
    $items = [];
  }
}
?>

<div class="container">
  <h1>Cart</h1>
  <?php if(empty($items)) { ?>
  <p>Your cart is empty</p>
  <?php } else { ?>
  <table class="table">
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
        $product = Product::findById($item['id']);
        $subtotal = $product['price'] * $item['quantity'];
        $total += $subtotal;
      ?>
        <tr>
          <td>
            <a href="/product.php?id=<?= $product['id'] ?>">
              <img src="/uploads/<?= $product['image'] ?>" width="50" />
              <?= $product['name'] ?>
            </a>
          </td>
          <td><?= $product['price'] ?></td>
          <td><?= $item['quantity'] ?></td>
          <td><?= $subtotal ?></td>
          <td>
            <form action="/user/cart.php" method="post">
              <input type="hidden" name="id" value="<?= $item['id'] ?>" />
              <input type="submit" name="submit" value="Remove" class="btn btn-danger" />
            </form>
          </td>
        </tr>
      <?php
      }
      ?>
  </table>
  <p>Total: <?= $total ?></p>
  <form action="/user/cart.php" method="post">
    <input type="submit" name="submit" value="Checkout" class="btn btn-primary" />
    <input type="submit" onclick="clearCart()" value="Clear cart" class="btn btn-danger" />
  </form>
  <?php } ?>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
