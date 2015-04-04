<?php
session_start();
//require_once('../scripts/connection.php');

require_once('../scripts/HotPosts.php');
?>

<!DOCTYPE HTML>
<html>

<head>
  <title> Social News Platform</title>
</head>

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
          <li> <a href= "#NewPost"> New Posts </a> </li>
          <li> <a href = "#Profile"> Profile </a> </li>
          <li> <a href = "http://cs2102-i.comp.nus.edu.sg/~a0101856/cs2102/scripts/Post.php" > Create a new post! </a> </li>
          <li> <a id= 'logout' href = "#logout"> Log out  </a> </li>
      </ul>
    </div>


<div class = "HotPosts">
<?php
    foreach($hotPosts as $hotPost){
      echo "<ul class =>". "<HotPostsList>";  
         echo "<li class =>". "<postvotes>". $hotPost['PVOTES']."</li>";
         echo "<li class =>"."<post_title>". $hotPost['POST_TITLE']. "</li>";
         echo "<li class =>". "<post_content>".$hotPost['POST_CONTENT']. "</li>";
         echo "<li class =>". "<post_username>". $hotPost['POST_USERNAME']. "</li>";
         echo "<li class =>". "<post_time>". $hotPost['POST_TIME']. "</li>";
       echo "</ul>";  
      }
       
?>
</div>
</body>
</html>