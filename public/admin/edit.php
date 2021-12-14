<?php

require_once('../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/admin/adminList.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
  $admin = [];
  $admin['id'] = $id;
  $admin['firstname'] = $_POST['firstname'] ?? '';
  $admin['lastname'] = $_POST['lastname'] ?? '';
  $admin['email'] = $_POST['email'] ?? '';
  $admin['username'] = $_POST['username'] ?? '';
  $admin['password'] = $_POST['password'] ?? '';
  $admin['confirm_password'] = $_POST['confirm_password'] ?? '';

  $result = update_admin($admin);
  if($result === true) {
    $_SESSION['message'] = 'Admin updated successfully.';
    redirect_to(url_for('/admin/show.php?id=' . $id));
  } else {
    $errors = $result;
  }
} else {
  $admin = find_admin_by_id($id);
}

?>

<?php $page_title = 'Edit Admin'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/admin/adminList.php'); ?>">&laquo; Back to Admin List</a>

  <div class="admin edit">
    <h1>Edit Admin</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/admin/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>First name</dt>
        <dd><input type="text" name="firstname" value="<?php echo h($admin['firstname']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Last name</dt>
        <dd><input type="text" name="lastname" value="<?php echo h($admin['lastname']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Username</dt>
        <dd><input type="text" name="username" value="<?php echo h($admin['username']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Email</dt>
        <dd><input type="text" name="email" value="<?php echo h($admin['email']); ?>" /><br /></dd>
      </dl>

      <dl>
        <dt>Password</dt>
        <dd><input type="password" name="password" value="" /></dd>
      </dl>

      <dl>
        <dt>Confirm Password</dt>
        <dd><input type="password" name="confirm_password" value="" /></dd>
      </dl>
      <p>
        Passwords should be at least 8 characters and include at least one uppercase letter, lowercase letter, number, and symbol.
      </p>
      <br />

      <div id="operations">
        <input type="submit" value="Edit Admin" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
