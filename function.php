<?php

function printUserManageAccounts(){
    global $conn;
    $stmt=$conn->prepare("SELECT * FROM users");
    $stmt->execute();
   
    if ($stmt->rowCount()>0){
        //found atlease one record
        echo "<table border='1'>";
            
            echo "<th>ID</th>";
            echo "<th>username</th>";
            echo "<th>active</th>";
            
            
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($row['active'] == 1) {
                    $manbun = 'Disable';
                } else {
                    $manbun = 'Enable';
                }
                
                //$manbun = $row['active'] == 1 ? 'Disable' : 'Enable'; This means the same as the if statement
                $editstate = ("edit_user.php?id=". $row['id']. "&state=". $manbun);
               
                
                //Repeats the output for all rows found by if statement
                echo "<tr>";
                  echo "<td>".$row['id']."</td>";
                  echo "<td>".$row['username']."</td>";
                  echo "<td>".$row['active']."</td>";
                  echo "<td><a href='$editstate'>$manbun</a></td>";
                echo "</tr>";
            }
        
        echo "</table>";
    }
    else{
        echo "<p>No Records found</p>";
    }
}
    ?>