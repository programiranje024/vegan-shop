<?php
// require all libs
require_once('../lib/lib.php');
// include header
include_once('../views/header.php');

Session::adminGuard();

if (Request::hasAllKeys($_GET, ['id'])) {
  $id = $_GET['id'];
  $product = Product::findById($id);
  if ($product) {
    Product::delete($id);
    Response::showSuccess('Product is now deleted');
  }
  else {
    Response::showError('Product not found');
  }
}
else {
  Response::showError('Missing required parameters');
}

// include footer
include_once('../views/footer.php');
?>
