<?php

require_once('../../private/initialize.php');

require_login();

$id = $_GET['id'] ?? '1'; // PHP > 7.0
$admin = find_admin_by_id($id);

?>

<?php $page_title = 'Show Admin'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/admin/adminList.php'); ?>">&laquo; Back to Admin List</a>

  <div class="admin show">

    <h1>Admin: <?php echo h($admin['username']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>First name</dt>
        <dd><?php echo h($admin['firstname']); ?></dd>
      </dl>
      <dl>
        <dt>Last name</dt>
        <dd><?php echo h($admin['lastname']); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($admin['email']); ?></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($admin['username']); ?></dd>
      </dl>
    </div>

  </div>

</div>
<?php include(SHARED_PATH . '/admin_footer.php') ?>
