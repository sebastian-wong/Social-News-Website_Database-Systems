<?php
session_start();

include 'connection.php';
if (!$dbh)  {
    echo "An error occurred connecting to the database";
    exit;
  }
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
<link rel="stylesheet" href="/combo/1.18.13?/css/layouts/blog.css">
<link type="text/css" rel="stylesheet" href="../stylesheets/main.css">
<div id="header">
<h1> Social News Platform </h1>
</div>
<body>
    <!-- navigation bar -->
    <div class = "navbar">
    <!-- ordered list within unordered list -->
      <ul class = "navigation">
          <li> <a href= "#HotPost"> Hot Posts </a> </li>
          <li> <a href= "http://cs2102-i.comp.nus.edu.sg/~a0101856/cs2102/scripts/NewPostsAccToTime.php"> New Posts </a> </li>
          <li> <a href = "http://cs2102-i.comp.nus.edu.sg/~a0101856/cs2102/scripts/Profile.php"> Profile </a> </li>
          <li> <a href = "http://cs2102-i.comp.nus.edu.sg/~a0101856/cs2102/scripts/Post.php" > Create a new post! </a> </li>
          <li> <a id= 'logout' href = "http://cs2102-i.comp.nus.edu.sg/~a0101856/cs2102/templates/login.html"> Log out  </a> </li> 
      </ul>
    </div>
</body>
<?php
    $sql = "SELECT post_title, post_content , post_time, post_username, pvotes  FROM POST_WRITEPOST WHERE post_title = '".$_SESSION['post_title']."' AND post_username = '".$_SESSION['post_username']."' AND post_time = '".$_SESSION['post_time']."'";
        
        $stid = oci_parse($dbh, $sql);
        oci_execute($stid, OCI_DEFAULT);
        $row = oci_fetch_array($stid); 
        echo "<div class = "."HotPosts".">";
        //Display post that has been commented on
        echo "<ul class =". "HotPostsList".">";  
      	echo "<li id ="."post_title". ">". $row[POST_TITLE]. "</li>";
      	echo "<li id =". "post_content".">".$row[POST_CONTENT]. "</li>";
      	echo "<li id =". "post_username".">Authored by " .$row[POST_USERNAME]. "</li>";  
      	echo "<li id =". "post_time".">".  $row[POST_TIME] . "</li>";
      	echo "<li id =". "postvotes". ">". $row[PVOTES]."</li>";      
      	echo "</ul>";  
		//Find all comments on particular post
      	$sql2 = "SELECT comment_username, comment_content, comment_time, count_votes FROM CONTAINS_COMMENTS WHERE post_title = '$row[POST_TITLE]' AND post_time = '$row[POST_TIME]' AND post_username = '$row[POST_USERNAME]'";
      	//Number of comments for a post
      	$sql3 = "SELECT COUNT(*) FROM CONTAINS_COMMENTS WHERE post_title = '$row[POST_TITLE]' AND post_time = '$row[POST_TIME]' AND post_username = '$row[POST_USERNAME]'";
      
      	//Number of comments
      	$stid2 = oci_parse($dbh, $sql3);
      	oci_execute($stid2);
      	$row2 = oci_fetch_array($stid2,OCI_DEFAULT);
      	echo "<u><font color=". "blue". ">" . $row2[0] . " Comment(s)</font></u><hr>";
      	oci_free_statement($stid2);
      
      	//All comments for a post
      	$stid2 = oci_parse($dbh, $sql2);
      	oci_execute($stid2);
      	while ($row2 = oci_fetch_array($stid2,OCI_DEFAULT)) {       
        echo "<p><font color=". "grey". ">" . $row2[1] . "</font></p><br>";
        echo "<font color=". "grey". ">" . $row2[2] . " Authored by " . $row2[0]. "</font><br>";
        echo "<u><font color=". "blue". ">" . $row2[3] . " Votes</font></u><br><hr>";
 		}     
		echo "</div>";
	
oci_free_statement($stid);
oci_free_statement($stid2);
?>
</html>

