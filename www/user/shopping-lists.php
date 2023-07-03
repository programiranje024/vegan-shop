<?php
// require all libs
require_once('../lib/lib.php');

$user = Session::getSessionUser();

// include header
include_once('../views/header.php');

if (Request::isSubmitted()) {
  if (Request::hasAllKeys($_POST, ['name'])) {
    $name = $_POST['name'];
    ShoppingList::create($name, $user['id']);
    Response::showSuccess('List created');
  }
  else {
    Response::showError('Invalid request');
  }
}

$shopping_lists = ShoppingList::getListsByUser($user['id']);
?>

<div class="container">
  <ul>
    <?php foreach ($shopping_lists as $list) { ?>
      <li>
        <a href="list.php?id=<?php echo $list['id']; ?>">
          <?php echo $list['name']; ?>
        </a>
      </li>
    <?php } ?>
  </ul>

  <hr />

  <form method="POST" action="/user/shopping-lists.php">
    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" type="text" name="name" placeholder="Name" required>
    </div>

    <input class="btn btn-primary mt-3" type="submit" name="submit" value="Add new list">
  </form>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
