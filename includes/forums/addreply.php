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
|   addreply.php - replies to topics and posts
*/

if (!defined('LB_RUN'))
{
	exit('<h1>ACCESS DENIED</h1>You cannot access this file directly.');
}

template_hook("forums/addreply.template.php", "start");

if ($_POST['content'] != '')
{
	$topic				= escape_string($_POST['topic']);
	$token_id			= escape_string($_POST['token_id']);
	$token_name_quick	= "token_quickreply_$topic$token_id";
	$token_name			= "token_addreply_$topic$token_id";

	setcookie("mqpid", "", time() -3600, '/');
	
	if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name] OR isset($_POST[$token_name_quick]) && isset($_SESSION[$token_name_quick]) && $_SESSION[$token_name_quick] == $_POST[$token_name_quick])
	{
		// Get forum ID...
		$query = "select FORUM_ID from {$db_prefix}posts WHERE TOPIC_ID='$topic' AND TITLE!=''" ;
		$result = mysql_query($query) or die("addreply.php - Error in query: $query") ;                                  
		$forum_id = mysql_result($result, 0);

		// PERMISSIONS!!! Can they view this forum???

		$can_add_attachment="0";
		$can_reply_topics="0";
		
		$query312 = "select CAN_REPLY_TOPICS, CAN_ADD_ATTACHMENT from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;
		$result312 = mysql_query($query312) or die("addreply.php - Error in query: $query312") ;                                  
		while ($results312 = mysql_fetch_array($result312))
		{
			$can_reply_topics = $results312['CAN_REPLY_TOPICS'];
			$can_add_attachment = $results312['CAN_ADD_ATTACHMENT'];
		}

		if ($can_reply_topics == 0)
		{
			lb_redirect("index.php?page=error&error=1","error/1");
		}
		else
		{
			// Get last poster ID...

			$topic = escape_string($_POST['topic']);

			$query287 = "select MEMBER, ID, CONTENT, TIME from {$db_prefix}posts WHERE TOPIC_ID='$topic' ORDER BY ID desc LIMIT 1" ;
			$result287 = mysql_query($query287) or die("addreply.php - Error in query: $query287") ;                                  
			while ($results287 = mysql_fetch_array($result287))
			{
				$member = $results287['MEMBER'];
				$last_id = $results287['ID'];
				$post_id = $last_id;
				$original_content = addslashes($results287['CONTENT']);
				$time = $results287['TIME'];
			}

			$query287 = "select TITLE from {$db_prefix}posts WHERE TOPIC_ID='$topic' AND TITLE!=''" ;
			$result287 = mysql_query($query287) or die("addreply.php - Error in query: $query287") ;                                  
			$title = mysql_result($result287, 0);

			if ($member == $my_id)
			{
				// current time...
				$current_time=time();
				$time_epoch=$time;

				// Check that under 15 minutes have passed...

				$epoch = $current_time - $time_epoch;

				if ($epoch < 900 && $auto_merge == 1)
				{
					$new_content = escape_string($_POST['content']);

					//Update the post
					$content		= $original_content . "\r\n\r\n" . $new_content;
					$current_time	= time();	
					mysql_query("UPDATE {$db_prefix}posts SET content='$content', time='$current_time' WHERE id = '$last_id'");

					if ($moderated == 1)
					{
						mysql_query("UPDATE {$db_prefix}posts SET approved='0' WHERE id = '$last_id'");
					}

					$edit_time = time();

					$original_content = escape_string($original_content);
					
					mysql_query("INSERT INTO {$db_prefix}posts_edit (topic, post, member, content, edit_reason, date) VALUES ('$topic', '$last_id', '$my_id', '$original_content', 'Auto-Merge of Reply Posted Within Last 15 Minutes', '$edit_time')");

					if ($moderated == 1)
					{
						mysql_query("INSERT INTO {$db_prefix}moderate (postid, title, member_id, member_name, time) VALUES ('$last_id', '$title', '$my_id', '$name', '$edit_time')");
					}

					// Update the attachments table with the post ID...
						
					$hash = escape_string($_POST['hash']);

					mysql_query("UPDATE {$db_prefix}attachments SET postid='$last_id', topicid='$topic' WHERE hash = '$hash'");
				}
				else
				{
					$current_time	= time();
					$topic			= escape_string($_POST['topic']);
					$new_content	= escape_string($_POST['content']);

					if ($moderated == 1)
					{
						mysql_query("INSERT INTO {$db_prefix}posts (member, address, content, topic_id, forum_id, time, approved) VALUES ('$my_id', '".$_SERVER['REMOTE_ADDR']."', '$new_content', '$topic', '$forum_id', '$current_time', '0')");
					}	
					else
					{
						mysql_query("INSERT INTO {$db_prefix}posts (member, address, content, topic_id, forum_id, time) VALUES ('$my_id', '".$_SERVER['REMOTE_ADDR']."', '$new_content', '$topic', '$forum_id', '$current_time')");
					}
						
					$query2 = "select ID from {$db_prefix}posts ORDER BY ID desc LIMIT 1" ;
					$result2 = mysql_query($query2) or die("newpost.php - Error in query: $query2") ;                                  
					$post_id = mysql_result($result2, 0);

					if ($moderated == 1)
					{
						mysql_query("INSERT INTO {$db_prefix}moderate (postid, title, member_id, member_name, time) VALUES ('$post_id', '$title', '$my_id', '$name', '$current_time')");
					}

					$query2 = "select TITLE from {$db_prefix}posts WHERE TITLE!='' AND ID='$post_id'" ;
					$result2 = mysql_query($query2) or die("newpost.php - Error in query: $query2") ;                                  
					$title = mysql_result($result2, 0);			
						
					$query334 = "select POST_COUNT from {$db_prefix}categories WHERE ID='$forum_id'" ;
					$result334 = mysql_query($query334) or die("newpost.php - Error in query: $query334") ;                                  
					$post_count = mysql_result($result334, 0);
					
					//Increment the Post Count?
					if ($post_count == 1)
					{
						mysql_query("UPDATE {$db_prefix}members SET user_posts=user_posts+1 WHERE id = '$my_id'");
					}

					$new_content = escape_string($_POST['content']);
						
					$query = "select ID from {$db_prefix}posts WHERE TOPIC_ID='$topic' AND MEMBER='$my_id' AND CONTENT='$new_content'" ;
					$result = mysql_query($query) or die("addreply.php - Error in query: $query") ;                                  
					$post_id = mysql_result($result, 0);

					// Update the attachments table with the post ID...
					$hash = escape_string($_POST['hash']);
					
					mysql_query("UPDATE {$db_prefix}attachments SET postid='$post_id', topicid='$topic' WHERE hash = '$hash'");
				}
			}
			else
			{
				// Insert reply
				$current_time	= time();
				$topic			= escape_string($_POST['topic']);
				$new_content	= escape_string($_POST['content']);
				
				if ($moderated == 1)
				{
					mysql_query("INSERT INTO {$db_prefix}posts (member, address, content, topic_id, forum_id, time, approved) VALUES ('$my_id', '".$_SERVER['REMOTE_ADDR']."', '$new_content', '$topic', '$forum_id', '$current_time', '0')");
					mysql_query("INSERT INTO {$db_prefix}moderate (postid, title, member_id, member_name, time) VALUES ('$post_id', '$title', '$my_id', '$name', '$current_time')");
				}
				else
				{
					mysql_query("INSERT INTO {$db_prefix}posts (member, address, content, topic_id, forum_id, time) VALUES ('$my_id', '".$_SERVER['REMOTE_ADDR']."', '$new_content', '$topic', '$forum_id', '$current_time')");
				}	
				
				$query334 = "select POST_COUNT from {$db_prefix}categories WHERE ID='$forum_id'" ;
				$result334 = mysql_query($query334) or die("newpost.php - Error in query: $query334") ;                                  
				$post_count = mysql_result($result334, 0);
					
				//Increment the Post Count?

				if ($post_count == 1)
				{
					mysql_query("UPDATE {$db_prefix}members SET user_posts=user_posts+1 WHERE id = '$my_id'");
				}
				
				$new_content = escape_string($_POST['content']);

				$query95 = "select ID from {$db_prefix}posts WHERE TOPIC_ID='$topic' AND MEMBER='$my_id' AND CONTENT='$new_content'" ;
				$result95 = mysql_query($query95) or die("addreply.php - Error in query: $query95") ;                                  
				$post_id = mysql_result($result95, 0);
				
				// Update the attachments table with the post ID...
				$hash = escape_string($_POST['hash']);
				
				mysql_query("UPDATE {$db_prefix}attachments SET postid='$post_id', topicid='$topic' WHERE hash = '$hash'");
			}

			// Update topic to say when last reply was
			$time = $current_time = time();

			if ($moderated != 1)
			{
				mysql_query("UPDATE {$db_prefix}posts SET last_post_time='$current_time' WHERE topic_id='$topic' AND TITLE!=''");
			}

			$new_content = escape_string($_POST['content']);

			$query_topic = "select TITLE from {$db_prefix}posts WHERE topic_id='$topic' AND TITLE!=''" ;
			$result_topic = mysql_query($query_topic) or die("addreply.php - Error in query: $query_topic") ;                                  
			$topic_title = mysql_result($result_topic, 0);
				
			if ($moderated != 1)
			{
				// Email people that have subscribed...
				$query_subscribe = "select ID from {$db_prefix}subscribe WHERE SUBSCRIBED_TOPIC='$topic'" ;
				$result_subscribe = mysql_query($query_subscribe) or die("addreply.php - Error in query: $query_subscribe") ;                                  
				while ($results_subscribe = mysql_fetch_array($result_subscribe))
				{
					$subscriber_id = $results_subscribe['ID'];

					$query_email = "select EMAIL, NAME from {$db_prefix}members WHERE ID='$subscriber_id'" ;
					$result_email = mysql_query($query_email) or die("addreply.php - Error in query: $query_email") ;                                  
					while ($results_email = mysql_fetch_array($result_email))
					{
						$subscriber_email = $results_email['EMAIL'];
						$subscriber_name = $results_email['NAME'];
					}

					// Prepare message...

					$lang['email_addreply_content'] = str_replace("<%subscriber>", $subscriber_name, $lang['email_addreply_content']);
					$lang['email_addreply_content'] = str_replace("<%title>", $topic_title, $lang['email_addreply_content']);
					$lang['email_addreply_content'] = str_replace("<%site>", $lb_domain, $lang['email_addreply_content']);
					$lang['email_addreply_content'] = str_replace("<%id>", $post_id, $lang['email_addreply_content']);
					$lang['email_addreply_content'] = str_replace("<%topic>", $topic, $lang['email_addreply_content']);
					$lang['email_addreply_content'] = str_replace("<%sitename>", $site_name, $lang['email_addreply_content']);

					$lang['email_addreply_title'] = str_replace("<%title>", $topic_title, $lang['email_addreply_title']);

					$message=$lang['email_addreply_content'];
					$outgoing="$subscriber_email";
					$from="From: $site_name <$board_email>\r\n";
					$subject=$lang['email_addreply_title'];

					mail($outgoing, $subject, $message, $from);
				}
			}
			
			/*
			Any modules needing to do anything?
		*/
		
			if ($code = $Plugin->hook('addreply', 'reply_added'))
			{
				eval($code);
			}
			
			// perform auto-cache
			include "scripts/php/auto_cache.php";

			template_hook("forums/addreply.template.php", "form");
			
			caspian_trigger($post_id);

			lb_redirect("index.php?page=findpost&post=$post_id","findpost/$post_id");
		}
	}
	else
	{
		lb_redirect("index.php?page=error&error=28","error/28");
	}
}
else{


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$topic=$_GET['topic'];
$topic=escape_string($topic);

$token_name = "token_addreply_$topic$token_id";

$_SESSION[$token_name] = $token;
		
		$query3 = "select FORUM_ID from {$db_prefix}posts WHERE TOPIC_ID='$topic'" ;
		$result3 = mysql_query($query3) or die("addreply.php - Error in query: $query3") ;                                  
		$forum_id = mysql_result($result3, 0);

		// PERMISSIONS!!! Can they view this forum???

		$can_add_attachment="0";
		$can_reply_topics="0";
		
		$query312 = "select CAN_REPLY_TOPICS, CAN_ADD_ATTACHMENT from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;
		$result312 = mysql_query($query312) or die("addreply.php - Error in query: $query312") ;                                  
		while ($results312 = mysql_fetch_array($result312)){
		$can_reply_topics = $results312['CAN_REPLY_TOPICS'];
		$can_add_attachment = $results312['CAN_ADD_ATTACHMENT'];
		}


if ($can_reply_topics == 0)	lb_redirect("index.php?page=error&error=1","error/1");
else
{
	// Are they quoting a post?
	if ($_GET['quote'] != '' ) {

		$quote = $_GET['quote'];
		$quote = escape_string($quote);

		// PERMISSIONS!!! Can they view this quote???
	
		$query_quote_permissions = "SELECT `can_read_topics` from `{$db_prefix}permissions` AS permissions, `{$db_prefix}posts` as posts WHERE permissions.group_id='{$role}' AND permissions.forum_id=posts.forum_id AND posts.id='{$quote}'";
		$result_quote_permissions = mysql_query($query_quote_permissions) or die("addreply.php - Error in query: $query_quote_permissions") ;  
	
		$result_quote_permissions = mysql_fetch_array($result_quote_permissions);
		$can_read_topics = $result_quote_permissions['can_read_topics'];

		if ($can_read_topics == 0)
		{
			$quote = '';
		}
		else
		{
			$query217 = "select MEMBER, CONTENT, TOPIC_ID  from {$db_prefix}posts WHERE ID='$quote'";
			$result217 = mysql_query($query217) or die("addreply.php - Error in query: $query217");
			while ($results217 = mysql_fetch_array($result217)) {
			
				$member_id = $results217['MEMBER'];
				$quote_content = $results217['CONTENT'];
				$topic_id = $results217['TOPIC_ID'];

				$quote_content=strip_slashes($quote_content);

				$query2112 = "select NAME from {$db_prefix}members WHERE ID='$member_id'" ;
				$result2112 = mysql_query($query2112) or die("Query failed") ;                                  
				$member_name = mysql_result($result2112, 0);

				$quote="&#91;quote name=$member_name trackback=$quote&#93;$quote_content&#91;/quote&#93;";

				$quote=str_replace("<br />","","$quote");

			}
		}
		
	}
	else
	{
		$quote = '';
	}
		
$name = $_COOKIE['lb_name'];
$name = escape_string($name);

$password = $_COOKIE['lb_password'];
$password = escape_string($password);

$hash = time();

$query3 = "select ID from {$db_prefix}members WHERE NAME='$name' AND PASSWORD='$password'";
$result3 = mysql_query($query3) or die("addreply.php - Error in query: $query3");
$uploader_id = mysql_result($result3, 0);

$topic = $_GET['topic'];
$topic = escape_string($topic);


// check cookie for quoted posts...

if ($_COOKIE['mqpid']!='')
{
	$array	= explode(',', $_COOKIE['mqpid']);

	foreach ($array as $key => $quoteID)
	{
		$array[$key] = (int) $quoteID;
	}

	$array	= implode(',', $array);

	$query217 = "select MEMBER, CONTENT, TOPIC_ID, ID  from {$db_prefix}posts WHERE ID IN($array) ORDER BY ID desc";
	$result217 = mysql_query($query217) or die("addreply.php - Error in query: $query217");
	
	while ($results217 = mysql_fetch_array($result217))
	{

		$id = $results217['ID'];
	
		// PERMISSIONS!!! Can they view this quote???
	
		$query_quote_permissions = "SELECT `can_read_topics` from `{$db_prefix}permissions` AS permissions, `{$db_prefix}posts` as posts WHERE permissions.group_id='{$role}' AND permissions.forum_id=posts.forum_id AND posts.id='{$id}'";
		$result_quote_permissions = mysql_query($query_quote_permissions) or die("addreply.php - Error in query: $query_quote_permissions") ;  
	
		$result_quote_permissions = mysql_fetch_array($result_quote_permissions);
		$can_read_topics = $result_quote_permissions['can_read_topics'];	

		if ($can_read_topics != 0)
		{
		
			$member_id = $results217['MEMBER'];
			$quote_content = $results217['CONTENT'];
			$topic_id = $results217['TOPIC_ID'];

			$quote_content=strip_slashes($quote_content);

			$query2112 = "select NAME from {$db_prefix}members WHERE ID='$member_id'" ;
			$result2112 = mysql_query($query2112) or die("Query failed") ;                                  
			$member_name = mysql_result($result2112, 0);

			$quote_temp="&#91;quote name=$member_name trackback=$id&#93;$quote_content&#91;/quote&#93;";

			$quote_temp=str_replace("<br />","","$quote_temp");

			$quote="$quote_temp

$quote";
		}
	}

}
	
template_hook("forums/addreply.template.php", "2");

}

}

template_hook("forums/addreply.template.php", "end");

?>