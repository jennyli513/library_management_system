<?php 
require_once('../../private/initialize.php');

$errors = [];
$username = '';
$password = '';
error_log("login000");

if(is_post_request())
{
    error_log("login111");
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if(is_blank($username))
    {
        $errors[] = "Username cannot be blank.";
    }

    if(is_blank($password))
    {
        $errors[] = "Password cannot be blank.";
    }

    if(empty($errors))
    {
        $admin = find_admin_by_username($username);
        $login_fail_msg = "Login was unsuccessful.";
        if($admin)//valid username
        {
            if(password_verify($password, $admin['hashed_password']))
            {
                log_in_admin($admin);
                redirect_to(url_for('admin/index.php'));
            }
            else //valid username, invalid password
            {
                $errors[] = $login_fail_msg;
            }
        }
        else //invalid username
        {
            $errors[] = $login_fail_msg;
        }
    }

    
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen"  href="../stylesheets/myStyleLogin.css">
    <title>Login</title>
</head>
<body >

   <div class="loginbox">
       <img src="../images/user.png" class="userPic">
       <h1>Login here</h1>
       <form class="loginform" action="login.php" method="post">
           <p>username</p>
           <input type="text" name="username" placeholder="Enter username">
           <p>password</p>
           <input type="password" name="password" placeholder="Enter password">
           <input type="submit" name="submit" value="login">  
           <a class="forgot_password" href="<?php echo url_for('/pwdRecovery/pwdResetRequest.php'); ?>">Forgot Password</a>
       </form>
       <?php echo display_login_errors($errors); ?>

   </div>
</body>
</html>