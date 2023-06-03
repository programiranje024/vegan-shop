<?php
// require all libs
require_once('../lib/lib.php');
// include header
include_once('../views/header.php');

admin_guard();

if (has_all_keys($_GET, ['id'])) {
  $id = $_GET['id'];
  $product = find_product_by_id($id);
  if ($product) {
    delete_product($id);
    show_success('Product is now deleted');
  }
  else {
    show_error('Product not found');
  }
}
else {
  show_error('Missing required parameters');
}

// include footer
include_once('../views/footer.php');
?>
