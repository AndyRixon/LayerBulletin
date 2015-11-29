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
|   findpost.php - forum post redirection
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

// Hello... can I help you? Oh, you want directions
// to a post? Sure.. follow me...

// First, you need to find out how many posts there
// are in the thread...

$post=$_GET['post'];
$post=escape_string($post);

$query211 = "select TOPIC_ID from {$db_prefix}posts WHERE ID='$post'" ;
$result211 = mysql_query($query211) or die("findpost.php - Error in query: $query211") ;
$does_exist = mysql_num_rows($result211);

$topic_id = mysql_result($result211, 0);

if ($does_exist == '0'){

 	lb_redirect("index.php?page=error&error=24","error/24");

}                                                                  


$query = "select ID from {$db_prefix}posts WHERE TOPIC_ID='$topic_id' AND ID <= '$post'" ;
$result = mysql_query($query) or die("findpost.php - Error in query: $query") ;                                  
$number_of_posts=mysql_num_rows($result);

$pages=(ceil($number_of_posts/$list_posts));
if($pages=='0'){
$pages="1";
}

// Now we have our page number, topic and post, return the result!

template_hook("pages/findpost.template.php", "form");

	$topic_title = topic_title($topic_id);

	lb_redirect("index.php?topic=$topic_id&limit=$pages#p$post","topic/$topic_title-$topic_id/$pages#p$post");

?>