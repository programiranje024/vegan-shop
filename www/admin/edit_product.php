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
    <input type="text" name="name" placeholder="Name" value="<?= $product['name'] ?>" />
    <input type="number" name="price" min="1" placeholder="Price" value="<?= $product['price'] ?>" />
    <textarea name="description" placeholder="Description"><?= $product['description'] ?></textarea>
    <input type="file" name="image" />
    <input type="submit" name="submit" value="Edit Product" />
  </form>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
