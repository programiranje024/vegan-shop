<?php
// require all libs
require_once('../lib/lib.php');
// include header
include_once('../views/header.php');

if (Request::hasAllKeys($_GET, ['id'])) {
  $id = $_GET['id'];
  $list = ShoppingList::getById($id);

  if (Request::isSubmitted()) {
    Response::showSuccess('Product added to cart');
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
    <?php foreach (ShoppingList::getItems($list['id']) as $item) { ?>
      <li>
        <span>
          <?php echo $item['name']; ?>
        </span>
      </li>
    <?php } ?>
  </ul>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
