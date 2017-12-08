<?php

require('connect.php');

if (!isset($_GET['id'])) {
    require("header.php");
    echo "<h3>No user id in post</h3>";
    require('footer.php');
    exit();
}

if (!isset($_GET['state'])) {
    require("header.php");
    echo "<h3>No user state in post</h3>";
    require('footer.php');
    exit();
}

$id = $_GET['id'];
$state = $_GET['state'];

// If enabled then we want to disable it
if ($state == 'Disable'){
    $state = 0;
} else {
    $state = 1;
}

// This means the same as the if statement
//$state = ($state == 'Disable' ? 0 : 1);

$stmt=$conn->prepare("UPDATE users SET active = :active WHERE id=:id;");
$stmt->bindparam(':id',$id);
$stmt->bindparam(':active',$state);
$stmt->execute();

// Clear headers and output
ob_get_clean();

header("location: manageaccount.php");
die("Redirecting to manageaccount.php");