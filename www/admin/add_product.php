<?php
// require all libs
require_once('../lib/lib.php');

admin_guard();

// include header
include_once('../views/header.php');

// form handler
if (is_submitted()) {
  if (has_all_keys($_POST, ['name', 'price', 'description'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = upload_image();

    if ($image) {
      create_product($name, $description, $price, $image);
      show_success('Product created');
    }
    else {
      show_error('Image upload failed');
    }
  }
  else {
    show_error('Missing required parameters');
  }
}
?>

<h1>Add Product</h1>
<form action="/admin/add_product.php" method="post" enctype="multipart/form-data">
  <input type="text" name="name" placeholder="Name" required />
  <input type="number" name="price" min="1" placeholder="Price"  required />
  <textarea name="description" placeholder="Description" required></textarea>
  <input type="file" name="image" required />
  <input type="submit" name="submit" value="Add Product" />
</form>
