<?php
 session_start();

 $servername="localhost";
 $username="antons98";
 $password="";
 
 try{
     $conn= new PDO("mysql:host=$servername;dbname=theatre",$username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
     //echo "congrats";
 }
 catch(PDOException $e){
     //hopeffully neever needed
     die ("error connection".$e->getmessage());
 }
 
 require_once ("function.php");
?>