<?php require_once('../../private/initialize.php') ?>
<?php require_login(); ?>

<?php $page_title = "Admin Menu"; ?>
<?php include(SHARED_PATH . '/admin_header.php') ?>

<div id="content">
            <div class="mainmenu">
                <h1>Welcome <?php echo $_SESSION['username']; ?></h1>

                <div class="menu">
                <nav id="navMenu">
                    <ul>
                        <li><a href="<?php echo url_for('/book/index.php'); ?>">Manage books</a></li>
                        <li><a href="<?php echo url_for('/admin/adminList.php'); ?>">Manage admin users</a></li>
                        <li><a href="<?php echo url_for('/book/search.php'); ?>">Search for books</a></li>
                    </ul>
                </nav>
                </div>
            </div>
</div>


<?php include(SHARED_PATH . '/admin_footer.php') ?>