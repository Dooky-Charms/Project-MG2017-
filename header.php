<!DOCTYPE HTML>
<html>
    
    <head>
        <title>Theatre Group</title>
        
        <link rel="stylesheet" href="css/maincss.css" type="text/css" />
    </head>

<body>
    
    
    
    <div class="topnav" id="mytopnav">
        
        <a href="index.php">Home</a>
        <a href="blog.php">Blog</a>
        <a href="register.php">Register</a>
        <a href="contact.php">Contact</a>
        <a href="signin.php">Sign-in</a>
        <a href="adminsignup.php">Admin Sign-in</a>
        <a href="logout.php">Logout</a>
        
        <?php
            session_start();
            //create navbar for admin
             if($_SESSION['admin']){
            ?>
                <a href="manageaccount.php">Manage Account</a>
                <a href="manageblog.php"> Manage Blog</a>
             <?php
             }
     
    
        ?>
    </div>
    <div id="main">



    
