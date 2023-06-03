<?php
// require all libs
require_once('lib/lib.php');
// include header
include_once('views/header.php');

$products = get_all_products();
?>
<div class="container">
  <h1>Vegan Shop</h1>
  <div class="products">
    <?php
    foreach ($products as $product) {
    ?>
        <a href="/product.php?id=<?= $product['id'] ?>">
          <img width="300" height="300" src="/uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" />
          <p><?= $product['name'] ?></p>
        </a>
    <?php
      }
  ?>
  </div>
</div>

<?php
// include footer
include_once('views/footer.php');
?>
