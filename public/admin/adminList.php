<?php

require_once('../../private/initialize.php');

require_login();

$admin_set = find_all_admins();

?>

<?php $page_title = 'Admin List'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  <div class="admins listing">
    <h1>Admin List</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/admin/signup.php'); ?>">Create New Admin</a>
    </div>

    <table class="list">
      <tr>
        <th>ID</th>
        <th>First</th>
        <th>Last</th>
        <th>Email</th>
        <th>Username</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php while($admin = mysqli_fetch_assoc($admin_set)) { ?>
        <tr>
          <td><?php echo h($admin['id']); ?></td>
          <td><?php echo h($admin['firstname']); ?></td>
          <td><?php echo h($admin['lastname']); ?></td>
          <td><?php echo h($admin['email']); ?></td>
          <td><?php echo h($admin['username']); ?></td>
          <td><a class="action" href="<?php echo url_for('/admin/show.php?id=' . h(u($admin['id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/admin/edit.php?id=' . h(u($admin['id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/admin/delete.php?id=' . h(u($admin['id']))); ?>">Delete</a></td>
        </tr>
      <?php } ?>
    </table>

    <?php
      mysqli_free_result($admin_set);
    ?>
  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>