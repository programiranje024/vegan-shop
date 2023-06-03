<?php
// require all libs
require_once('lib/lib.php');
// include header
include_once('views/header.php');

if (has_all_keys($_GET, ['id'])) {
  $id = $_GET['id'];
  $product = find_product_by_id($id);
}
else {
  die(show_error('Missing required parameters'));
}
?>
<h1>Vegan Shop</h1>
<h2>Product: <?= $product['name']; ?></h2>
<p>Price: <?= $product['price']; ?></p>
<p>Description: <?= $product['description']; ?></p>
<img src="/uploads/<?= $product['image']; ?>" height="500" />
<?php
if (is_logged_in()) {
?>
<script>
  const product = {
    id: <?= $product['id']; ?>,
    name: '<?= $product['name']; ?>',
    price: <?= $product['price']; ?>,
    description: '<?= $product['description']; ?>',
    image: '<?= $product['image']; ?>'
  };
</script>
<script src="/js/store.js"></script>
<?php
}
?>
