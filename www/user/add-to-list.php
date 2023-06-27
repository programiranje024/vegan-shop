<?php
// require all libs
require_once('../lib/lib.php');
// include header
include_once('../views/header.php');

if (Request::hasAllKeys($_GET, ['id', 'product_id'])) {
  $id = $_GET['id'];
  $product_id = $_GET['product_id'];

  ShoppingList::addItemToList($id, $product_id);

  Response::showSuccess('Item added to list successfully');
}
else {
  die(Response::showError('Missing required parameters'));
}
?>
<div class="container">
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
