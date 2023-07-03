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
    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" type="text" name="name" placeholder="Name" required>
    </div>

    <div class="form-group">
      <label for="price">Price</label>
      <input class="form-control" type="number" name="price" min="1" placeholder="Price"  required>
    </div>

    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control" name="description" placeholder="Description" required></textarea>
    </div>

    <div class="form-group">
      <label for="image">Image</label>
      <input class="form-control" type="file" name="image" required>
    </div>

    <input class="btn btn-primary mt-3" type="submit" name="submit" value="Add Product">
  </form>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
