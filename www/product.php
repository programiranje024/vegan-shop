<?php
// require all libs
require_once('lib/lib.php');
// include header
include_once('views/header.php');

if (Request::hasAllKeys($_GET, ['id'])) {
  $id = $_GET['id'];
  $product = Product::findById($id);

  if (Request::isSubmitted()) {
    $user = Session::getSessionUser();
    Product::addToCart($id, $user['id']);

    Response::showSuccess('Product added to cart');
  }
}
else {
  die(Response::showError('Missing required parameters'));
}

?>
<div class="container">
  <h1>Vegan Shop</h1>
  <h2>Product: <?= $product['name']; ?></h2>
  <p>Price: <?= $product['price']; ?></p>
  <p>Description: <?= $product['description']; ?></p>
  <img src="/uploads/<?= $product['image']; ?>" height="500" />
  <?php
  if (Session::isLoggedIn()) {
    $lists = ShoppingList::getListsByUser(Session::getSessionUser()['id']);
  ?>
    <form action="/product.php?id=<?= $id ?>" method="post">
      <input type="submit" name="submit" value="Add to Cart" class="btn btn-primary mt-3" />
    </form>
    <?php if (!empty($lists)) { ?>
    <hr />
    <form action="/user/add-to-list.php" method="get">
      <input type="hidden" name="product_id" value="<?= $id ?>" />
      <div class="form-group">
        <label for="id">Name</label>
        <select name="id" class="form-control">
          <?php foreach ($lists as $list) { ?>
            <option value="<?= $list['id'] ?>"><?= $list['name'] ?></option>
          <?php } ?>
        </select>
      </div>
      <input type="submit" name="submit" value="Add to List" class="btn btn-primary mt-3" />
    </form>
    <?php } ?>
  <?php
    } else {
  ?>
    <p class="mt-3">Please <a href="/login.php">login</a> to add to cart</p>
  <?php
    }
  ?>
</div>

<?php
// include footer
include_once('views/footer.php');
?>
