<?php 
require_once('../../private/initialize.php');

$current = date("Y-m-d H:i:s");
error_log($current);
if(is_post_request())
{
    if(isset($_POST['submit']) && $_POST['submit'])
    {
        $email = $_POST['email'] ??'';
        if(empty($email)) //if user didn't enter email
        {
            $errors[] = "Please enter your email address";
        }

        if(empty($errors))//if user enter something
        {
            //find by email
            $admin = find_admin_by_email($email);

            if(empty($admin)) //if not find
            {
                $errors[] = "Sorry, no user exists in our system with this email";
            }
            else //if found email in tbladmin table
            {
               //create a token
                $token = bin2hex(random_bytes(50)); 
               //check if the email aready exist in password_reset table
               //if no, inert new
                //if yes, update the current token
                $resultTemp= find_token_by_email($email);
                if(empty($resultTemp))
                {
                    $result = insert_token($email, $token);
                }
                else
                {
                    $result = update_token($email, $token);

                }

                
                if($result) //if insert or update token successful, sent email to user 
                {
                    $to = $email;
                    $subject = "Reset your password on LMS City of Casey";
                    $msg .= "Dear user, ";
                    $msg .= "Please click on the link to reset your password 
                    http://localhost/LMSV2/public/pwdRecovery/pwdReset.php?token=" . $token . "&email=" . $email. "";
                    $msg = wordwrap($msg, 70);
                    $headers = "From lms@gmail.com";
                    mail($to, $subject, $msg, $headers);
                    redirect_to(url_for('/pwdRecovery/pwdMessage.php'));

                }
                else
                {
                    $errors[] = $result;
                }
            }       

        }
    
    }
    if(isset($_POST['goback']) && $_POST['goback'])
    {
        redirect_to(url_for('/admin/login.php'));
    }

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen"  href="../stylesheets/myStyleLogin.css">
    <title>Recover Password</title>
</head>
<body >

   <div class="loginbox">
      
       <h1>Recover Password</h1>
       <form class="loginform" action="<?php echo url_for('/pwdRecovery/pwdResetRequest.php'); ?>" method="post">
           <p>Please enter your email accounts so we can send a link to assist you in recovering your account</p>
           <input type="text" name="email" placeholder="example@gmail.com">
           <input type="submit" name="submit" value="Send Email">  
           <input type="submit" name="goback" value="Login">
       </form>
       <?php echo display_login_errors($errors); ?>
   </div>
</body>
</html>