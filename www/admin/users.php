<?php
// require all libs
require_once('../lib/lib.php');
// include header
include_once('../views/header.php');

admin_guard();
$users = get_all_users();
// filter out the current user
$users = array_filter($users, function($user) {
  return $user['id'] !== get_session_user()['id'];
});
?>

<h1>User Admin</h1>
<table>
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
            <a href="/admin/make_admin.php?id=<?= $user['id'] ?>">Make Admin</a>
            <a href="/admin/verify.php?id=<?= $user['id'] ?>">Verify</a>
            <a href="/admin/ban.php?id=<?= $user['id'] ?>">Ban</a>
            <a href="/admin/delete_user.php?id=<?= $user['id'] ?>">Delete</a>
          </td>
        </tr>
        <?php
      }
    ?>
  </tbody>
</table>
