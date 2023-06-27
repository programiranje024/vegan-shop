<?php
// require all libs
require_once('../lib/lib.php');
// include header
include_once('../views/header.php');

if (Request::hasAllKeys($_GET, ['id'])) {
  $id = $_GET['id'];
  $list = ShoppingList::getById($id);

  if (Request::isSubmitted()) {
    if (Request::hasAllKeys($_POST, ['name'])) {
      $name = $_POST['name'];

      ShoppingList::update($id, $name);
      Response::showSuccess('List updated successfully');

      $list = ShoppingList::getById($id);
    }
    else {
      Response::showError('Missing required parameters');
    }
  }
}
else {
  die(Response::showError('Missing required parameters'));
}
?>
<div class="container">
  <h1>List: <?php echo $list['name']; ?></h1>
  <a href="/user/delete-list.php?id=<?php echo $list['id']; ?>">Delete</a>
  
  <ul>
    <?php foreach (ShoppingList::getItems($list['id']) as $item) { 
      $product = Product::findById($item['product_id']);
      ?>
      <li>
        <a href="/product.php?id=<?php echo $product['id']; ?>">
          <?php echo $product['name']; ?>
        </a> - 
        <a href="/user/remove-from-list.php?id=<?php echo $list['id']; ?>&product_id=<?php echo $product['id']; ?>">
          Remove
        </a>
      </li>
    <?php } ?>
  </ul>

  <form action="/user/list.php?id=<?php echo $list['id']; ?>" method="POST">
    <input type="text" name="name" value="" placeholder="New list name" required>
    <input type="submit" name="submit" value="Rename">
  </form>  
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
