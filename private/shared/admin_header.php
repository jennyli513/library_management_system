<?php 
  if(!isset($page_title))
  {
      $page_title ='Admin Area';
  }
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen"  href="<?php echo url_for('/stylesheets/myStyle.css'); ?>"> 
    <title>LMS-<?php echo $page_title; ?></title>
</head>
<body>
    <header>
        <div class="container">
        <h1>Library Management System</h1>
        </div>
        <div class="navContainer">
        <nav id="navbar">
            <ul>   
                <li><a href="<?php echo url_for('/admin/index.php'); ?>">Home</a></li>
                <li><a href="<?php echo url_for('/admin/signup.php'); ?>">Signup User</a></li>
                <li><a href="<?php echo url_for('/book/index.php'); ?>">Books</a></li>
                <li><a href="<?php echo url_for('/admin/logout.php'); ?>">Logout</a></li>
            </ul>
        </nav>
        <div>
    </header>
    
    <?php echo display_session_message(); ?>