<?php
// require all libs
require_once('../lib/lib.php');

Session::adminGuard();

// include header
include_once('../views/header.php');

if (Request::hasAllKeys($_GET, ['id'])) {
  $id = $_GET['id'];
}
else {
  Response::showError('Missing required parameters');
}

$product = Product::findById($id);

// form handler
if (Request::isSubmitted()) {
  if (Request::hasAllKeys($_POST, ['name', 'price', 'description'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if (isset($_FILES['image'])) {
      $image = Request::uploadImage();
    }
    else {
      $image = $product['image'];
    }

    Product::update($id, $name, $description, $price, $image);
    Response::showSuccess('Product updated');

    $product = Product::findById($id);
  }
  else {
    Response::showError('Missing required parameters');
  }
}
?>

<div class="container">
  <h1>Edit Product</h1>
  <form action="/admin/edit_product.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" type="text" name="name" placeholder="Name" value="<?= $product['name'] ?>" required>
    </div>

    <div class="form-group">
      <label for="price">Price</label>
      <input class="form-control" type="number" name="price" min="1" placeholder="Price" value="<?= $product['price'] ?>" required>
    </div>

    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control" name="description" placeholder="Description" required><?= $product['description'] ?></textarea>
    </div>

    <div class="form-group">
      <label for="image">Image</label>
      <input class="form-control" type="file" name="image">
    </div>

    <input class="btn btn-primary mt-3" type="submit" name="submit" value="Edit Product">
  </form>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
