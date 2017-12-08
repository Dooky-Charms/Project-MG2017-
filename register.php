<?php require('connect.php')?>
<?php require('header.php')?>


<?php
if(isset($_POST['signup'])){
    
    $username= $_POST['usernamebox'];
    $stmt=$conn->prepare("SELECT * FROM users WHERE username=:username");
    $stmt->bindParam(":username",$username);
    $stmt->execute();
    
    if($stmt->rowCount()>0){
        ?>
        <script>alert("This User already exists please try another name");</script>
  <?php  }
  else {
      $password1=$_POST['password1box'];
      $password2=$_POST['password2box'];
      $email=$_POST['emailbox'];
      $DOB=$_POST["datebox"];
      
      if ($password1==$password2){
         // $salt="mipatb476201";
          //$password1=sha1(password1.$salt);
          
          $stmt=$conn->prepare("INSERT INTO users
                                    (username,email, password)
                                    VALUES
                                    (:username, :email, :password)");
      
          $stmt->bindParam(":username", $username);
           $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password1);
            
            if($stmt->execute()){
                ?>
               <script>alert("User account created");location.href("signup.php");</script>
                    <?php
            }
            else{
                
            }
      }
            else{
                ?>
                <script>alert("passwords don't match");</script>
                <?php 
            }
      }
      
      
       
  }


?>
   <form name="signup" method="POST" action="" id="myform">
        <label>Username</label><input type="text" name="usernamebox" >
        <label>Email</label><input type="text" name="emailbox">
        <label>Password</label><input type="text" name="password1box" id="pwd1">
        <label>Re Enter Password</label><input type="text" name="password2box" id="pwd2">
        <input type="submit" name="signup">
        </form>
        
         <p id="length"></p>
    <p id="match"></p>
    
    <?php require('footer.php')?>
    