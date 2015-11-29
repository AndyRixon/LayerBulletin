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
|   unsubscribe.php - cancel subscription to topic/forum
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

if ($_GET['topic']!=''){
$topic=$_GET['topic'];
$topic=escape_string($topic);

mysql_query("DELETE FROM {$db_prefix}subscribe WHERE id ='$my_id' AND subscribed_topic='$topic'");
   
	template_hook("pages/unsubscribe.template.php", "form");

	$topic_title = topic_title($topic);
	
	lb_redirect("index.php?topic=$topic","topic/$topic_title-$topic");

}
elseif ($_GET['forum']!=''){
$forum=$_GET['forum'];
$forum=escape_string($forum);

mysql_query("DELETE FROM {$db_prefix}subscribe WHERE id ='$my_id' AND subscribed_forum='$forum'");
  
	$forum_title = forum_title($forum);
  
	lb_redirect("index.php?forum=$forum","forum/$forum_title-$forum");

}

?>