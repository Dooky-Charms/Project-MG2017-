<?php require('connect.php')?>
<?php require('header.php')?>

<?php

global $conn;

// 1. Check if we are a user
// 2. Check if user is active
// 3. Check if we have a post (form)
// 4. Check if we have post for a comment
if (  ($_SESSION['user'] && $_SESSION['user']['active']) 
      && isset($_POST) && !empty($_POST['commentbox'])) {
    
    $comment_id = $_POST['id'];
    $comment_title = $_POST['titlebox'];
    $comment_text = $_POST['commentbox'];
    $comment_by = $_SESSION['user']['username'];
    
    if (strlen($comment_text) < 10) {
        // Display error need 10 or more characters for comment
    }
    
    // SQL INSERT DATA
    /*
    INSERT INTO  `theatre`.`comments` (
        `commentid` ,
        `blog` ,
        `title` ,
        `commenttext` ,
        `owner`
        )
    VALUES (
    NULL ,  '1',  'TITLE',  'COMMENT',  'Luke'
    );
    
    INSERT INTO comments (blog, title, commenttext owner) 
    VALUE (:blogId, :title, :comment, :owner);
    */
    $data = [
        ':blogId' => $comment_id,
        ':title' => $comment_title,
        ':comment' => $comment_text,
        ':owner' => $comment_by
    ];
    
    $stmt=$conn->prepare("INSERT INTO comments (blog, title, commenttext owner) 
    VALUE (:blogId, :title, :comment, :owner);");
   

    
    /* REFRESH PAGE
    ob_get_clean(); // Clear headers
    header("location: blog.php"); // 
    die("REFERSHING"); */
}





$stmt=$conn->prepare("SELECT * FROM blog");
$stmt->execute();

while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<table border='1'>";
            
        echo "<th>blog title</th>";
        echo "<th>text</th>";
        echo "<th>time</th>";
            
        echo "<tr>";
            echo "<td>".$row['blogtitle']."</td>";
            echo "<td>".$row['blogtext']. "</td>";
            echo "<td>".$row['time']. "</td>";
    echo "</tr> </table> "; // End table
        
    $sql_comments = "SELECT * FROM comments WHERE blog = :blogId";
    $stmt_comments=$conn->prepare($sql_comments);
    $stmt_comments->bindparam(':blogId', $row['blogid']);
    $stmt_comments->execute();
    
    if ($stmt_comments->rowCount()>0) {
        echo "<br>COMMENTS for ". $row['blogtitle']. ":";
        echo "<table border='1'>";
        echo "<th>username & title</th>";
        echo "<th>comment</th>";
        
        while($comment = $stmt_comments->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
                echo "<td>".$comment['owner']." | ".$comment['title']."</td>";
                echo "<td>".$comment['commenttext']. "</td>";
            echo "</tr>"; 
        }
        
        echo "</table>"; // end table
    }
    
    if( $_SESSION['admin'] ){
        echo "<td><a href='manageblog.php?blogid=". $row['blogid'] ."'>Update</a>";
    } else if( $_SESSION['user'] && $_SESSION['user']['active'] == 1 ) {
        echo '<br><form action="" name="comments" method="POST" style="display:inline">
                <input type="hidden" name="blogid" value="'. $row['blogid']. '">
                <label>Comment on '. $row['blogtitle']. ', Title: </label>
                <input type="text" name="titlebox">.
                <label>Message</label>
                <textarea name="commentbox"></textarea>
                <input type="submit" name="submit_comments">
              </form>';
    }
    
    echo "<br><br><br>";
}

// Check if the user is active and there is a post
if( $_SESSION['user'] && $_SESSION['user']['active'] == 1 && 
        isset($_POST ['submit_comments'] )) {
    
    $blogid   = $_POST['blogid'];
    $title    = $_POST['titlebox'];
    $comment  = $_POST['commentbox'];
    $username = $_SESSION['user']['username'];

    $stmt_com_insert = $conn->prepare("
        INSERT INTO comments (blog,     title,  commenttext,  owner)
        VALUES               (:blogid, :title, :commenttext, :owner);
    ");
    
    $stmt_com_insert->bindparam(':blogid',         $blogid);
    $stmt_com_insert->bindparam(':title',          $title);
    $stmt_com_insert->bindparam(':commenttext',    $comment);
    $stmt_com_insert->bindparam(':owner',          $username);
    $stmt_com_insert->execute();
    
    // Refresh
    header ("location: blog.php");
    die ("Refreshing");
}

?>

<?php require ("footer.php") ?>