<?php
// require all libs
require_once('../lib/lib.php');
// include header
include_once('../views/header.php');

Session::adminGuard();
$products = Product::getAll();
?>

<div class="container">
  <h1>Product Admin</h1>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($products as $product) {
      ?>
        <tr>
          <td><?= $product['id'] ?></td>
          <td><?= $product['name'] ?></td>
          <td><?= $product['price'] ?></td>
          <td>
            <a href="/admin/edit_product.php?id=<?= $product['id'] ?>" class="btn btn-primary">Edit</a>
            <a href="/admin/delete_product.php?id=<?= $product['id'] ?>" class="btn btn-danger">Delete</a>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
  <a href="/admin/add_product.php" class="btn btn-primary">Add Product</a>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
