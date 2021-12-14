<?php require_once('../../private/initialize.php') ?>

<?php
require_login(); 

if(is_post_request())
{
        $admin =[];

        $admin['firstname'] = $_POST['firstname'] ?? '';
        $admin['lastname'] = $_POST['lastname'] ?? '';
        $admin['email'] = $_POST['email'] ?? '';
        $admin['username'] = $_POST['username'] ?? '';
        $admin['password'] = $_POST['password'] ?? '';
        $admin['confirm_password'] = $_POST['confirm_password'] ?? '';

        $result = insert_admin($admin);
        if($result === true)
        {
            $new_id = mysqli_insert_id($db);
            $_SESSION['message'] = "Admin user created.";
            redirect_to(url_for('/admin/show.php?id=' . $new_id)); //??
        }
        else
        {
            $errors = $result;
        }
   
}
else
{
    $admin =[];
    $admin['firstname'] = $_POST['firstname'] ?? '';
    $admin['lastname'] = $_POST['lastname'] ?? '';
    $admin['email'] = $_POST['email'] ?? '';
    $admin['username'] = $_POST['username'] ?? '';
    $admin['password'] = $_POST['password'] ?? '';
}

?>

<?php $page_title = "Sign up Admin"; ?>
<?php include(SHARED_PATH . '/admin_header.php') ?>

<div id="content">

<a class="back-link" href="<?php echo url_for('/admin/adminList.php'); ?>">&laquo;Back to Admin list</a>
    <div class="signup">
        <h1>Sign up</h1>

        <!--display errors-->
        <?php echo display_errors($errors); ?>

        <form action="<?php echo url_for('/admin/signup.php'); ?>" method="post">
            <dl>
                <dt>First name</dt>
                <dd><input type="text" name="firstname" value="" /></dd>
            </dl>
            <dl>
                <dt>Last name</dt>
                <dd><input type="text" name="lastname" value="" /></dd>
            </dl>
            <dl>
                <dt>Email</dt>
                <dd><input type="text" name="email" value="" /></dd>
            </dl>
            <dl>
                <dt>Username</dt>
                <dd><input type="text" name="username" value="" /></dd>
            </dl>
            <dl>
                <dt>Password</dt>
                <dd><input type="password" name="password" value="" /></dd>
            </dl>
            <dl>
                <dt>Confirm password</dt>
                <dd><input type="password" name="confirm_password" value="" /></dd>
            </dl>
             
            <div>
                <p>Passwords should be at least 8 characters and include at least one uppercase letter, lowercase letter, number, and symbol.</p>
            </div>
           
            <div id="operations">
                <input type="submit" value="Sign up" />
            </div>

        </form>
    </div>

</div>



<?php include(SHARED_PATH . '/admin_footer.php') ?>