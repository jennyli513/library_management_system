<?php
function log_in_admin($admin)
{
    //renerating the ID protects the admin from sessio fixation
    session_regenerate_id();
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['username'] = $admin['username'];

    return true;
}

//function to check if a user is logged in
function is_logged_in()
{
    return isset($_SESSION['admin_id']);
}

//function to require a valid login before access the page
function require_login()
{
    if(!is_logged_in())
    {
        redirect_to(url_for('/admin/login.php'));
    }
    else
    {
        //do nothing
    }
}
//function to log out admin
function log_out_admin()
{
    unset($_SESSION['admin_id']); 
    unset($_SESSION['last_login']);
    unset($_SESSION['username']);

    return true;
}

?>