<?php
// require all libs
require_once('lib/lib.php');
// include header
include_once('views/header.php');

$products = get_all_products();
?>
<h1>Vegan Shop</h1>
<ul>
  <?php
  foreach ($products as $product) {
  ?>
    <li>
      <a href="/product.php?id=<?= $product['id'] ?>">
        <img width="300" height="300" src="/uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" />
      </a>
    </li>
  <?php
  }
  ?>
</ul>
