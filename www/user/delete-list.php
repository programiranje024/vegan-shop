<?php
// require all libs
require_once('../lib/lib.php');
// include header
include_once('../views/header.php');

if (Request::hasAllKeys($_GET, ['id'])) {
  $id = $_GET['id'];

  ShoppingList::delete($id);
  Response::showSuccess('List deleted successfully');
}
else {
  die(Response::showError('Missing required parameters'));
}
?>
<div class="container">
  <a href="/user/shopping-lists.php" class="btn btn-primary">Back</a>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
