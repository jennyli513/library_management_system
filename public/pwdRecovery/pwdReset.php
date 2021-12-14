<?php 
require_once('../../private/initialize.php');

   
    if(isset($_GET['token']) && isset($_GET['email']))
    {
        $email = $_GET['email'];
       // error_log("000".$email);
        $token = $_GET['token'];
       // error_log("111".$token);

       // error_log("33335");

        if (is_post_request())
        {
            $password = $_POST['newPassword'] ?? '';
            $confirmPassword = $_POST['confirmPassword'] ?? '';
    
            //first: check if the password is the old one
            if(is_old_password($password, $email))
            {
                $errors[] = "The password you entered has been used. Please enter a new one or login. ";
            }
            else
            {
                 //second: update password in tbladmin table
                 $result1 = update_password($password, $confirmPassword, $email);
                 if($result1 === true) 
                 {
                      //delete token in password_reset table
                    $result2= delete_token($email);
                    if($result2 === true)
                    {
                        redirect_to(url_for('/pwdRecovery/resetSuccess.php?email=' . $email));
                    }
                    else
                    {
                        $errors = $result2;
                    }          
                 } 
                 else
                 {
                    $errors = $result1;
                 }
            } 
        } 

    }
    else
    {
        $errors[] = "Your link is invalid";
    }
    

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen"  href="../stylesheets/myStyleLogin.css">
    <title>Reset Password</title>
</head>
<body >
   <div class="loginBox">
       <h1>Reset Password</h1>
       <form class="loginForm" action="<?php echo url_for('/pwdRecovery/pwdReset.php?token='.$token.'&email='.$email); ?>" method="post">
           <p>Please enter your new password</p>
           <p>New password</p>
           <input type="password" name="newPassword" placeholder="">
           <p>Confirm password</p>
           <input type="password" name="confirmPassword" placeholder="">
           <input type="submit" name="submit" value="Reset Password"> 
           <a class="back-link" href="<?php echo url_for('/pwdRecovery/pwdResetRequest.php'); ?>">&laquo;Back to login</a>
           <a class="back-link" href="<?php echo url_for('/admin/login.php'); ?>">&laquo;Back to send email</a>
       </form>
      
       <div class="displayError">
        <?php echo display_login_errors($errors); ?>
    </div>
      
   </div>
</body>
</html>