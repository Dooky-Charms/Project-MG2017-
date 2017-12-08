<?php require('connect.php')?>
<?php require('header.php')?>
<?php

echo'
  <form name="update" action="" method="GET">
   <input name="blogtitle"  type="text"   value="'.$row["title"].'"> 
   <input name="blogtext"  type="text"   value="'.$row["title"].'"> 
 
 
  </form>';



?>
<?php require('footer.php')?>
