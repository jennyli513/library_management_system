<?php 
require_once('../../private/initialize.php');

if(is_post_request())
{
    redirect_to(url_for('/admin/login.php'));
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen"  href="../stylesheets/myStyleLogin.css">
    <title>Password Reset success</title>
</head>
<body >

   <div class="loginbox">
       <h1>Congratulations!</h1>
       <p>Your password has been successfully reseted. Please click the login button to log in the system.</p>
       <form class="loginform" action="<?php echo url_for('/pwdRecovery/resetSuccess.php'); ?>" method="post">
         <input type="submit" name="submit" value="login"> 

       </form>
   </div>
</body>
</html>