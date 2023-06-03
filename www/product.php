<?php
// require all libs
require_once('lib/lib.php');
// include header
include_once('views/header.php');

if (has_all_keys($_GET, ['id'])) {
  $id = $_GET['id'];
  $product = find_product_by_id($id);

  if (is_submitted()) {
    $user = get_session_user();
    add_to_cart($id, $user['id']);

    show_success('Product added to cart');
  }
}
else {
  die(show_error('Missing required parameters'));
}
?>
<h1>Vegan Shop</h1>
<h2>Product: <?= $product['name']; ?></h2>
<p>Price: <?= $product['price']; ?></p>
<p>Description: <?= $product['description']; ?></p>
<img src="/uploads/<?= $product['image']; ?>" height="500" />
<?php
if (is_logged_in()) {
?>
<form action="/product.php?id=<?= $id ?>" method="post">
  <input type="submit" name="submit" value="Add to Cart" />
</form>
<?php
} else {
?>
<p>Please <a href="/login.php">login</a> to add to cart</p>
<?php
}
?>
