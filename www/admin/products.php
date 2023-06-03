<?php
// require all libs
require_once('../lib/lib.php');
// include header
include_once('../views/header.php');

admin_guard();
$products = get_all_products();
?>

<div class="container">
  <h1>Product Admin</h1>
  <table>
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
            <a href="/admin/edit_product.php?id=<?= $product['id'] ?>">Edit</a>
            <a href="/admin/delete_product.php?id=<?= $product['id'] ?>">Delete</a>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
  <a href="/admin/add_product.php">Add Product</a>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
