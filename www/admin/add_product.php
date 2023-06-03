<?php
// require all libs
require_once('../lib/lib.php');

Session::adminGuard();

// include header
include_once('../views/header.php');

// form handler
if (Request::isSubmitted()) {
  if (Request::hasAllKeys($_POST, ['name', 'price', 'description'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = Request::uploadImage();

    if ($image) {
      Product::create($name, $description, $price, $image);
      Response::showSuccess('Product created');
    }
    else {
      Response::showError('Image upload failed');
    }
  }
  else {
    Response::showError('Missing required parameters');
  }
}
?>

<div class="container">
  <h1>Add Product</h1>
  <form action="/admin/add_product.php" method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Name" required />
    <input type="number" name="price" min="1" placeholder="Price"  required />
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="file" name="image" required />
    <input type="submit" name="submit" value="Add Product" />
  </form>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
