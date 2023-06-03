<?php
// require all libs
require_once('../lib/lib.php');

admin_guard();

// include header
include_once('../views/header.php');

if (has_all_keys($_GET, ['id'])) {
  $id = $_GET['id'];
}
else {
  show_error('Missing required parameters');
}

$product = find_product_by_id($id);

// form handler
if (is_submitted()) {
  if (has_all_keys($_POST, ['name', 'price', 'description'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if (isset($_FILES['image'])) {
      $image = upload_image();
    }
    else {
      $image = $product['image'];
    }

    update_product($id, $name, $description, $price, $image);
    show_success('Product updated');

    $product = find_product_by_id($id);
  }
  else {
    show_error('Missing required parameters');
  }
}
?>

<h1>Edit Product</h1>
<form action="/admin/edit_product.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
  <input type="text" name="name" placeholder="Name" value="<?= $product['name'] ?>" />
  <input type="number" name="price" min="1" placeholder="Price" value="<?= $product['price'] ?>" />
  <textarea name="description" placeholder="Description"><?= $product['description'] ?></textarea>
  <input type="file" name="image" />
  <input type="submit" name="submit" value="Edit Product" />
</form>
