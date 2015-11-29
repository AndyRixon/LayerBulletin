<?php
/*
+--------------------------------------------------------------------------
|  LayerBulletin
|  ========================================
|  By The LayerBulletin team
|  Released under the Artistic License 2.0
|  http://layerbulletin.com/
|  ========================================
|+--------------------------------------------------------------------------
|   split.php - split topic in two
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

if ($can_split_topics=='0'){
	lb_redirect("index.php?page=error&error=10","error/10");
}

else{

if ($_POST['title']==''){

$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$post=$_GET['post'];
$post=escape_string($post);

$token_name = "token_split_$post$token_id";

$_SESSION[$token_name] = $token;

template_hook("forums/split.template.php", "1");

}
else{

$post=$_POST['post'];
$post=escape_string($post);

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);
$token_name = "token_split_$post$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

// Move all posts to new topic...

// Get last topic ID...

$query2 = "select TOPIC_ID from {$db_prefix}posts WHERE TITLE!='' ORDER BY TOPIC_ID desc LIMIT 1" ;
$result2 = mysql_query($query2) or die("split.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$topic_id = $results2['TOPIC_ID'];
$topic_id=$topic_id+1;
}

$query21 = "select TOPIC_ID from {$db_prefix}posts WHERE ID='$post'" ;
$result21 = mysql_query($query21) or die("split.php - Error in query: $query21") ;                                  
$old_topic_id = mysql_result($result21, 0);

$time=time();

$title=$_POST['title'];
$title=escape_string($title);
$post=$_POST['post'];
$post=escape_string($post);
$description=$_POST['description'];
$description=escape_string($description);

mysql_query("UPDATE {$db_prefix}posts SET title='$title', description='$description', topic_id='$topic_id', last_post_time='$time' WHERE id = '$post'");

mysql_query("UPDATE {$db_prefix}posts SET topic_id='$topic_id' WHERE id > '$post' AND topic_id='$old_topic_id'");

mysql_query("UPDATE {$db_prefix}settings SET stats_topics=stats_topics+1, stats_posts = stats_posts-1");	

$redirect=$topic_id;

// perform auto-cache
include "scripts/php/auto_cache.php";	

	template_hook("forums/split.template.php", "form");

	$topic_title = topic_title($redirect);	
	
	lb_redirect("index.php?topic=$redirect","topic/$topic_title-$redirect");

}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}

}

?>