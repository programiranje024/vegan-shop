<?php
// require all libs
require_once('../lib/lib.php');
// include header
include_once('../views/header.php');

Session::adminGuard();
$users = User::getAllUsers();
// filter out the current user
$users = array_filter($users, function($user) {
  return $user['id'] !== Session::getSessionUser()['id'];
});
?>

<div class="container">
  <h1>User Admin</h1>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Admin</th>
        <th>Verified</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach ($users as $user) {
          ?>
          <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['admin'] ? 'Yes' : 'No' ?></td>
            <td><?= $user['verified'] ? 'Yes' : 'No' ?></td>
            <td>
              <a href="/admin/make_admin.php?id=<?= $user['id'] ?>" class="btn btn-secondary">Make Admin</a>
              <a href="/admin/verify.php?id=<?= $user['id'] ?>" class="btn btn-primary">Verify</a>
              <a href="/admin/ban.php?id=<?= $user['id'] ?>" class="btn btn-danger">Ban</a>
              <a href="/admin/delete_user.php?id=<?= $user['id'] ?>" class="btn btn-danger">Delete</a>
            </td>
          </tr>
          <?php
        }
      ?>
    </tbody>
  </table>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
