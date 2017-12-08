<?php require('connect.php')?>
<?php require('header.php')?>


<?php
session_start();
if(isset($_POST['submit'])){
    //checks if submit has been clicked
    
    //get variables out of the form
    
    $username = $_POST['userbox'];
    $password = $_POST['passwordbox'];
    
     //$salt="mipatb476201";
               // $password=sha1($password.$salt);
    
    $stmt=$conn->prepare("SELECT * FROM admin WHERE username=:username AND password=:password");
    $stmt->bindparam(':username',$username);
    $stmt->bindparam(':password',$password);
    $stmt->execute();
    
    if($stmt->rowCount()>0){
        echo 'login succsessful';
        
        $row = $stmt->fetch();
        unset($row['password']); // Remove password from array so its not in session
        
        session_destroy(); // Destroy previous session (in event of logged in as user)
        session_start();
        
         $_SESSION['admin']=$row;
    }
    else{
        echo 'login failed';
    }
}
?>

<h1>Sign In Here</h1>
<?php
 echo '
            <form action="" name="login" method="POST">
            <label>Username</label><input type="text" name="userbox"><br/>
            <label>Password</label><input type="password" name="passwordbox"><br/>
            <input type="submit" name="submit">
            </form>';
  
?>



<?php require('footer.php')?>