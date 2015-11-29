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
|   lock.php - locks forum topics
*/


if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

	if ($can_lock_topics=='0'){
		lb_redirect("index.php?page=error&error=6","error/6");
	}

	// Get member ID...

		$name		= escape_string($_COOKIE['lb_name']);
		$password	= escape_string($_COOKIE['lb_password']);

		$query211 = "select ID from {$db_prefix}members WHERE NAME='$name' AND PASSWORD='$password'" ;
		$result211 = mysql_query($query211) or die("lock.php - Error in query: $query211") ;                                  
		$id 	= mysql_result($result211, 0);
		$time	= time();
		$topic	= escape_string($_GET['topic']);

		mysql_query("UPDATE {$db_prefix}posts SET locked='1', edit_member='$id', edit_time='$time' WHERE topic_id = '$topic' AND title!='' ");

		if ($_GET['index']!='q'){
			template_hook("forums/lock.template.php", "form");
			
			$topic_title = topic_title($topic);
			
			lb_redirect("index.php?topic=$topic","topic/$topic_title-$topic");
		}
		else{
			$query211 = "select FORUM_ID from {$db_prefix}posts WHERE TOPIC_ID='$topic'" ;
			$result211 = mysql_query($query211) or die("lock.php - Error in query: $query211") ;                                  
			$forum_id = mysql_result($result211, 0);

			$forum_title = forum_title($forum_id);
			
			lb_redirect("index.php?forum=$forum_id","forum/$forum_title-$forum_id");
		}
?>