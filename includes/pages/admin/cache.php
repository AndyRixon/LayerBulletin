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
|   cache.php - cache & purge options
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/admin/cache.template.php", "start");

if ($can_change_forum_settings == 0)
{
	lb_redirect("index.php?page=error&error=11","error/11");
	exit;
}

if ($_GET['func']=='posts')
{
	// Do post counts

	// Now get member id...

	$query212 = "select ID from {$db_prefix}members ORDER BY ID desc" ;
	$result212 = mysql_query($query212) or die("cache.php - Error in query: $query212") ;                                  
	while ($results212 = mysql_fetch_array($result212))
	{
		$member_id = strip_slashes($results212['ID']);

		$counted_posts="0";

		// First get the forum...

		$query211 = "select ID from {$db_prefix}categories WHERE POST_COUNT='1' ORDER BY ID desc" ;
		$result211 = mysql_query($query211) or die("cache.php - Error in query: $query211") ;                                  
		while ($results211 = mysql_fetch_array($result211))
		{
			$id = strip_slashes($results211['ID']);

			// Now count how many posts that member made,
			// and enter it into database

			$query213 = "select ID from {$db_prefix}posts WHERE MEMBER='$member_id' AND FORUM_ID='$id'" ;
			$result213 = mysql_query($query213) or die("cache.php - Error in query: $query213") ;                                  
			$posts = mysql_num_rows($result213);

			$counted_posts = $counted_posts + $posts;
		}

		mysql_query("UPDATE {$db_prefix}members SET user_posts='$counted_posts' WHERE id = '$member_id'");
	}

	template_hook("pages/admin/cache.template.php", "1");
	template_hook("pages/admin/cache.template.php", "2");
	template_hook("pages/admin/cache.template.php", "3");
}

elseif ($_GET['func']=='verify')
{
	// Remove unverified members
	mysql_query('DELETE FROM ' . $db_prefix . 'members WHERE verified != 1');

	// perform auto-cache
	include "scripts/php/auto_cache.php";	

	template_hook("pages/admin/cache.template.php", "1");
	template_hook("pages/admin/cache.template.php", "4");
	template_hook("pages/admin/cache.template.php", "3");
}

elseif ($_GET['func']=='online')
{
	// Reset most online

	mysql_query("UPDATE {$db_prefix}settings SET most_online='0', most_online_date = '0'");

	# Remove settings cache
	$Cache->delete('settings');

	template_hook("pages/admin/cache.template.php", "1");
	template_hook("pages/admin/cache.template.php", "5"); 
	template_hook("pages/admin/cache.template.php", "3");
}

elseif ($_GET['func']=='forums')
{
	$token_id = $_POST['token_id'];
	$token_id = escape_string($token_id);

	$token_name = "token_cache_forums_$token_id";
	
	if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name] && isset($_POST['forums']))
	{
		// Purge it bitch!

		// First, prepare the query...

		$forum = implode(",",$_POST['forums']);
		$forum = escape_string($forum);

		$locked = escape_string($_POST['locked']);

		$date = escape_string($_POST['date']);

		// convert days to seconds...
		$date=($date*24*60*60);
		$current_time=time();
		$date=($current_time - $date);

		if ($locked=='1')
		{
			// first, find any topics that had a REPLY that is older than
			// what was specified..

			$query212 = "select TOPIC_ID from {$db_prefix}posts WHERE FORUM_ID IN($forum) AND locked='1' AND LAST_POST_TIME > '$date'" ;
			$result212 = mysql_query($query212) or die("cache.php - Error in query: $query212") ;                                  
			while ($results212 = mysql_fetch_array($result212))
			{
				$topic_id = strip_slashes($results212['TOPIC_ID']);

				// Now remove any posts that match that topic_id...

				$query215 = "select ID from {$db_prefix}posts WHERE TOPIC_ID='$topic_id'" ;
				$result215 = mysql_query($query215) or die("delete.php - Error in query: $query215") ;                                  
				while ($results215 = mysql_fetch_array($result215))
				{
					$remove_id = strip_slashes($results215['ID']);

					// first, delete attachments associated with these posts...

					$query2121 = "select FILENAME from {$db_prefix}attachments WHERE POSTID='$remove_id'" ;
					$result2121 = mysql_query($query2121) or die("delete.php - Error in query: $query2121") ;                                  
					while ($results2121 = mysql_fetch_array($result2121))
					{
						$filename = strip_slashes($results2121['FILENAME']);

						foreach (glob("uploads/attachments/$filename") as $filename_original)
						{
						   unlink($filename_original);
						}

						foreach (glob("uploads/attachments/t_$filename") as $filename_thumb)
						{
						   unlink($filename_thumb);
						}

						mysql_query("DELETE FROM {$db_prefix}attachments WHERE postid ='$remove_id'");
					}
				}

				// now remove the posts

				mysql_query("DELETE FROM {$db_prefix}posts WHERE topic_id = '$topic_id'");

			}

			template_hook("pages/admin/cache.template.php", "1");
			template_hook("pages/admin/cache.template.php", "7");
			template_hook("pages/admin/cache.template.php", "3");

		}
		else
		{
			// first, find any topics that had a REPLY that is older than
			// what was specified..

			$query212 = "select TOPIC_ID from {$db_prefix}posts WHERE FORUM_ID IN($forum) AND LAST_POST_TIME > '$date'" ;
			$result212 = mysql_query($query212) or die("cache.php - Error in query: $query212") ;                                  
			while ($results212 = mysql_fetch_array($result212))
			{
				$topic_id = strip_slashes($results212['TOPIC_ID']);

				// Now remove any posts that match that topic_id...

				$query215 = "select ID from {$db_prefix}posts WHERE TOPIC_ID='$topic_id'" ;
				$result215 = mysql_query($query215) or die("delete.php - Error in query: $query215") ;                                  
				while ($results215 = mysql_fetch_array($result215))
				{
					$remove_id = strip_slashes($results215['ID']);

					// first, delete attachments associated with these posts...

					$query2121 = "select FILENAME from {$db_prefix}attachments WHERE POSTID='$remove_id'" ;
					$result2121 = mysql_query($query2121) or die("delete.php - Error in query: $query2121") ;                                  
					while ($results2121 = mysql_fetch_array($result2121))
					{
						$filename = strip_slashes($results2121['FILENAME']);

						foreach (glob("uploads/attachments/$filename") as $filename_original)
						{
						   unlink($filename_original);
						}

						foreach (glob("uploads/attachments/t_$filename") as $filename_thumb)
						{
						   unlink($filename_thumb);
						}

						mysql_query("DELETE FROM {$db_prefix}attachments WHERE postid ='$remove_id'");
					}
				}
				
				mysql_query("DELETE FROM {$db_prefix}posts WHERE topic_id = '$topic_id'");
			}
		}

		template_hook("pages/admin/cache.template.php", "1");
		template_hook("pages/admin/cache.template.php", "7");
		template_hook("pages/admin/cache.template.php", "3");

		// perform auto-cache
		include "scripts/php/auto_cache.php";	

	}
	else
	{
		lb_redirect("index.php?page=error&error=28","error/28");
	}
}

elseif ($_GET['func']=='readall')
{
	// put read all date into members profiles

	$read_all=time();

	mysql_query("UPDATE {$db_prefix}members SET read_all_posts='$read_all'");

	// Now empty the read_all table

	mysql_query("DELETE FROM {$db_prefix}posts_read");

	template_hook("pages/admin/cache.template.php", "1");
	template_hook("pages/admin/cache.template.php", "8");
	template_hook("pages/admin/cache.template.php", "3");
}


elseif ($_GET['func']=='messages')
{
	// Remove deleted private messages
	mysql_query('DELETE FROM ' . $db_prefix . 'messages WHERE hidden = 1 AND hidden_from = 1 AND title != ""');
	
	template_hook("pages/admin/cache.template.php", "1");
	template_hook("pages/admin/cache.template.php", "9");
	template_hook("pages/admin/cache.template.php", "3");
}

else
{
	$token_id = md5(microtime());
	$token = md5(uniqid(rand(),true));

	$token_name = "token_cache_forums_$token_id";

	$_SESSION[$token_name] = $token;

	template_hook("pages/admin/cache.template.php", "1");
	template_hook("pages/admin/cache.template.php", "10");

	$query211 = "select ID, NAME from {$db_prefix}categories WHERE PARENT='0' ORDER BY FORUM_ORDER asc, ID asc" ;
	$result211 = mysql_query($query211) or die("topic.php - Error in query: $query211") ;                                  
	while ($results211 = mysql_fetch_array($result211))
	{
		$parent_id = strip_slashes($results211['ID']);
		$parent_name = strip_slashes($results211['NAME']);

		template_hook("pages/admin/cache.template.php", "11");

		$query2 = "select ID, NAME from {$db_prefix}categories WHERE PARENT='$parent_id' ORDER BY FORUM_ORDER asc, ID asc" ;
		$result2 = mysql_query($query2) or die("topic.php - Error in query: $query2") ;                                  
		while ($results2 = mysql_fetch_array($result2))
		{
			$forum_id = strip_slashes($results2['ID']);
			$forum_name = strip_slashes($results2['NAME']);

			template_hook("pages/admin/cache.template.php", "12");

			$query_sub = "select ID, NAME from {$db_prefix}categories WHERE PARENT='$forum_id' ORDER BY FORUM_ORDER asc, ID desc" ;
			$result_sub = mysql_query($query_sub) or die("move.php - Error in query: $query_sub") ;                                  
			while ($results_sub = mysql_fetch_array($result_sub))
			{
				$forum_sub_id = strip_slashes($results_sub['ID']);
				$forum_sub_name = strip_slashes($results_sub['NAME']);

				template_hook("pages/admin/cache.template.php", "13");
			}
		}
	}

	template_hook("pages/admin/cache.template.php", "14");
}  

template_hook("pages/admin/cache.template.php", "end");
?>