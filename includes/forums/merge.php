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
|   merge.php - merges two topics together
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("forums/merge.template.php", "start");

if ($can_merge_topics=='0'){

	lb_redirect("index.php?page=error&error=7","error/7");

}

elseif ($_POST['old_topic']!=''){

$old_topic=$_POST['old_topic'];
$old_topic=escape_string($old_topic);

$new_topic=$_POST['new_topic'];
$new_topic=escape_string($new_topic);

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);

$token_name = "token_merge_$old_topic$token_id";

   if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

// Update with new details...

$query211 = "select FORUM_ID from {$db_prefix}posts WHERE TOPIC_ID='$new_topic'" ;
$result211 = mysql_query($query211) or die("merge.php - Error in query: $query211") ;                                  
while ($results211 = mysql_fetch_array($result211)){
$new_forum_id = $results211['FORUM_ID'];
}


mysql_query("UPDATE {$db_prefix}posts SET topic_id='$new_topic', forum_id='$new_forum_id', title='', description='', sticky='0', announce='0' WHERE topic_id = '$old_topic'");

mysql_query("UPDATE {$db_prefix}settings SET stats_topics=stats_topics-1, stats_posts = stats_posts+1");	



// We're moving this topic, so remove any polls they created...

mysql_query("DELETE FROM {$db_prefix}polls WHERE topic_id ='$old_topic'");

// perform auto-cache
include "scripts/php/auto_cache.php";	

	template_hook("forums/merge.template.php", "form");

	$topic_title = topic_title($new_topic);	
	
	lb_redirect("index.php?topic=$new_topic","topic/$topic_title-$new_topic");

}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}

elseif ($_GET['forum']==''){

$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$topic=$_GET['topic'];
$topic=escape_string($topic);

$token_name = "token_merge_$topic$token_id";

$_SESSION[$token_name] = $token;

template_hook("forums/merge.template.php", "2");



$query211 = "select ID, NAME from {$db_prefix}categories WHERE PARENT='0' AND REDIRECT_URL = '' ORDER BY FORUM_ORDER asc, ID desc" ;
$result211 = mysql_query($query211) or die("merge.php - Error in query: $query211") ;                                  
while ($results211 = mysql_fetch_array($result211)){
$id = $results211['ID'];
$name = $results211['NAME'];

$name = strip_slashes($name);

template_hook("forums/merge.template.php", "3");

$query2 = "select ID, NAME from {$db_prefix}categories WHERE PARENT='$id' AND REDIRECT_URL = '' ORDER BY FORUM_ORDER asc, ID desc" ;
$result2 = mysql_query($query2) or die("merge.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$forum_id = $results2['ID'];
$forum_name = $results2['NAME'];

$forum_name = strip_slashes($forum_name);

template_hook("forums/merge.template.php", "4");

$query_sub = "select ID, NAME from {$db_prefix}categories WHERE PARENT='$forum_id' AND REDIRECT_URL = ''  ORDER BY FORUM_ORDER asc, ID desc" ;
$result_sub = mysql_query($query_sub) or die("move.php - Error in query: $query2") ;                                  
while ($results_sub = mysql_fetch_array($result_sub)){
$forum_id = $results_sub['ID'];
$forum_name = $results_sub['NAME'];

$forum_name = strip_slashes($forum_name);

template_hook("forums/merge.template.php", "5");

}

}

template_hook("forums/merge.template.php", "6");

}

template_hook("forums/merge.template.php", "7");

}

else{

template_hook("forums/merge.template.php", "2");

$query211 = "select ID, NAME from {$db_prefix}categories WHERE PARENT='0' ORDER BY FORUM_ORDER asc, ID desc" ;
$result211 = mysql_query($query211) or die("merge.php - Error in query: $query211") ;                                  
while ($results211 = mysql_fetch_array($result211)){
$id = $results211['ID'];
$name = $results211['NAME'];

$forum_name = strip_slashes($forum_name);

template_hook("forums/merge.template.php", "3");

$query2 = "select ID, NAME from {$db_prefix}categories WHERE PARENT='$id' ORDER BY FORUM_ORDER asc, ID desc" ;
$result2 = mysql_query($query2) or die("index.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$forum_id = $results2['ID'];
$forum_name = $results2['NAME'];

$forum_name = strip_slashes($forum_name);

template_hook("forums/merge.template.php", "4");

$query_sub = "select ID, NAME from {$db_prefix}categories WHERE PARENT='$forum_id' ORDER BY FORUM_ORDER asc, ID desc" ;
$result_sub = mysql_query($query_sub) or die("move.php - Error in query: $query2") ;                                  
while ($results_sub = mysql_fetch_array($result_sub)){
$forum_id = $results_sub['ID'];
$forum_name = $results_sub['NAME'];

$forum_name = strip_slashes($forum_name);

template_hook("forums/merge.template.php", "5");
}

}
template_hook("forums/merge.template.php", "6");
}

template_hook("forums/merge.template.php", "8");

$topic_id = escape_string($_GET['topic']);
$forum_id = escape_string($_GET['forum']);

$query211 = "select TOPIC_ID, TITLE from {$db_prefix}posts WHERE TITLE!='' AND TOPIC_ID!='$topic_id' AND FORUM_ID='$forum_id' ORDER BY TITLE asc" ;
$result211 = mysql_query($query211) or die("index.php - Error in query: $query211") ;                                  
while ($results211 = mysql_fetch_array($result211)){
$topic_id = $results211['TOPIC_ID'];
$title = $results211['TITLE'];

$title=strip_slashes($title);

template_hook("forums/merge.template.php", "9");

}


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$topic=$_GET['topic'];
$topic=escape_string($topic);

$token_name = "token_merge_$topic$token_id";

$_SESSION[$token_name] = $token;

template_hook("forums/merge.template.php", "10");

}

template_hook("forums/merge.template.php", "end");

?>
