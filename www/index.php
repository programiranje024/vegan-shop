<?php
// require all libs
require_once('lib/lib.php');
// include header
include_once('views/header.php');

$products = Product::getAll();
?>
<div class="container">
  <h1>Vegan Shop</h1>
  <div class="products">
    <?php
    foreach ($products as $product) {
?>
      <div class="card" style="width: 300px">
        <img class="card-img-top" src="/uploads/<?= $product['image']; ?>" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title"><?= $product['name']; ?></h5>
          <p class="card-text"><?= $product['description']; ?></p>
          <p class="card-text">Price: <?= $product['price']; ?></p>
          <a href="/product.php?id=<?= $product['id'] ?>" class="btn btn-primary">View</a>
        </div>
      </div>
    <?php
      }
  ?>
  </div>
</div>

<?php
// include footer
include_once('views/footer.php');
?>
