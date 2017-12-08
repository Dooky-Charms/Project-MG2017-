<?php require('connect.php')?>
<?php require('header.php')?>
<?php require('footer.php')?>

<?php
    session_start();
    session_destroy();
?>

<a href="index.php">Back to home'</a>

<?php require('footer.php'); ?>