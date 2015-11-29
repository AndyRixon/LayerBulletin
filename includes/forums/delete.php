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
|   delete.php - deletes posts, topics and relevant polls & attachments
*/

if (!defined('LB_RUN'))
{
	exit('<h1>ACCESS DENIED</h1>You cannot access this file directly.');
}

$post = (int) $_POST['post_delete_id'];

if ($can_delete_others_posts != 1)
{
		/*
		Check whether this is their post
	*/
	
		$query	= mysql_query('SELECT member FROM ' . $db_prefix . 'posts WHERE id = ' . $post);
		$row	= mysql_fetch_assoc($query);
		
		if ($row['member'] != $my_id || $can_delete_own_posts != 1)
		{
			lb_redirect("index.php?page=error&error=4","error/4");
		}
}

if ($_POST['post_delete'] == $lang['button_delete'] && tokenCheck('topic_post_delete', $post))
{
	$query21 = '
		SELECT p.title, p2.title AS topic_title, p.description, p.content, p.member, p.address, p.topic_id, p.forum_id, p.time, p.last_post_time
		FROM ' . $db_prefix . 'posts p
			INNER JOIN ' . $db_prefix . 'posts p2
			ON p.topic_id = p2.topic_id AND p2.title != ""
		WHERE p.id = ' . $post;
	$result21 = mysql_query($query21) or die("delete.php - Error in query: $query21");
	
	while ($results21 = mysql_fetch_array($result21))
	{
		$title 			= $results21['title'];
		$topic_title	= $results21['topic_title'];
		$desc			= $results21['description'];
		$content		= $results21['content'];
		$member			= $results21['member'];
		$addr			= $results21['address'];
		$topic_id 		= $results21['topic_id'];
		$forum_id 		= $results21['forum_id'];
		$time	 		= $results21['time'];
		$last_post_time	= $results21['last_post_time'];
	}
	
	/*
	If the trashcan forum is enabled then we don't delete the post.
	Instead, it gets moved to the trashcan
	(unless of course, it's already in the trashcan; then it goes for good)...
*/

	if ($trashcan_enabled && $forum_id != $trashcan_forum)
	{
	
		/*
		So, are we dealing with a topic or single post?
	*/
	
		if ($title != '')
		{
			# Move & lock it...
			mysql_query('
				UPDATE ' . $db_prefix . 'posts
				SET forum_id = ' . $trashcan_forum . ', original_forum_id = ' . $forum_id . ', trashcan_time = ' . time() . ', locked = 1
				WHERE title != "" AND topic_id = ' . $topic_id
			);
			
			/*
			If any posts from this topic were previously deleted, merge them back
		*/
		
			mysql_query('
				UPDATE ' . $db_prefix . 'posts
				SET topic_id = ' . $topic_id . ', original_topic_id = 0, forum_id = ' . $trashcan_forum . ', title = ""
				WHERE original_topic_id = ' . $topic_id
			);
			
			mysql_query('
				UPDATE ' . $db_prefix . 'posts
				SET forum_id = ' . $trashcan_forum . ', original_forum_id = ' . $forum_id . '
				WHERE topic_id = ' . $topic_id
			);
		}
		else
		{
			
			/*
			Deleted posts will be grouped into topics to make them easier to restore.
			First see if another post from this topic is already present.
		*/
			
			$query = mysql_query('
				SELECT topic_id, forum_id
				FROM ' . $db_prefix . 'posts
				WHERE forum_id = ' . $trashcan_forum . ' AND original_topic_id = ' . $topic_id
			);
			$row = mysql_fetch_assoc($query);
			
			if (!empty($row))
			{
				# Topic already exists, simply move the post
				mysql_query('
					UPDATE ' . $db_prefix . 'posts
					SET
						original_topic_id = ' . $topic_id . ',
						topic_id = ' . $row['topic_id'] . ',
						original_forum_id = ' . $forum_id . ',
						forum_id = ' . $trashcan_forum . '
					WHERE id = ' . $post
				);
			}
			else
			{
			
				/*
				A topic for this post isn't present in the trashcan.
				Create a fake topic to group deleted replies together.
				First, find the id to be given to the new topic:
			*/
			
				$query	= mysql_query('SELECT topic_id FROM ' . $db_prefix . 'posts WHERE title != "" ORDER BY topic_id DESC LIMIT 1');
				$row	= mysql_fetch_assoc($query);
				
					$new_topic_id = $row['topic_id'] + 1;
				
				
				/*
				Now create a new topic with these details
			*/
			
				mysql_query('
					INSERT INTO ' . $db_prefix . 'posts
					(
						title, description, content, member, address, time, topic_id, original_topic_id, forum_id, original_forum_id, trashcan_time,
						last_post_time, locked
					)
					VALUES
					(
						"' . $topic_title . '",
						"' . $desc . '",
						"' . $content . '",
						' . $member . ',
						"' . $addr . '",
						' . $time . ',
						' . $new_topic_id . ',
						' . $topic_id . ',
						' . $trashcan_forum . ',
						' . $forum_id . ',
						' . time() . ',
						' . $last_post_time . ',
						1
					)
				');
				
				/*
				Move attachments to the new post
			*/
			
				$new_id = mysql_insert_id();
				mysql_query('UPDATE ' . $db_prefix . 'attachments SET postid = ' . $new_id . ', topicid = ' . $new_topic_id . ' WHERE postid = ' . $post);
				
				/*
				Now delete the orignal post.
			*/
			
				mysql_query('DELETE FROM ' . $db_prefix . 'posts WHERE id = ' . $post);
			}
		}
		
		/*
		Run auto-cache to show updated information.
	*/
	
		# Auto-cache overwrites $topic_id, so use a different name
		$topic = $topic_id;
	
		include 'scripts/php/auto_cache.php';
		
		/*
		And redirect the user back to the topic.
	*/

		template_hook('forums/delete.template.php', 'form_2');
		lb_redirect('index.php?topic=' . $topic, 'topic/' . $topic_title . '-' . $topic);
	}
	else
	{
	
		if ($title != '')
		{
			$query212 = "select ID from {$db_prefix}posts WHERE TOPIC_ID='$topic_id'";
			$result212 = mysql_query($query212) or die("delete.php - Error in query: $query212");
			
			while ($results212 = mysql_fetch_array($result212))
			{
				$remove_id 	= $results212['ID'];

				/*
				Delete the attachments
			*/

				$query2121 = "select FILENAME from {$db_prefix}attachments WHERE POSTID='$remove_id'";
				$result2121 = mysql_query($query2121) or die("delete.php - Error in query: $query2121");
				
				while ($results2121 = mysql_fetch_array($result2121))
				{
					unlink($lb_root . 'uploads/attachments/' . $results2121['FILENAME']);
					unlink($lb_root . 'uploads/attachments/t_' . $results2121['FILENAME']);

					mysql_query("DELETE FROM {$db_prefix}attachments WHERE postid ='$remove_id'");
				}
						
				/*
				If it was in the moderation queue, remove it..
			*/
			
				mysql_query("DELETE FROM {$db_prefix}moderate WHERE postid='$remove_id'");
			}

			/*
			Remove the posts and any edits made to them
		*/

			mysql_query('DELETE FROM ' . $db_prefix . 'posts WHERE topic_id = ' . $topic_id);
			mysql_query('DELETE FROM ' . $db_prefix . 'posts_edit WHERE topic = ' . $topic_id);

			/*
			Poll present? Remove that also...
		*/
					
			mysql_query('
				DELETE
					p.*, pv.*
				FROM
					' . $db_prefix . 'polls p
					
					INNER JOIN ' . $db_prefix . 'polls_votes pv
					ON p.id = pv.poll_id
				
				WHERE
					p.topic_id = ' . $topic_id
			);

			/*
			Auto-Cache
		*/
					
			include 'scripts/php/auto_cache.php';	

			/*
			Finish off & redirect
		*/
		
			$forum_title = forum_title($forum_id);
			
			template_hook('forums/delete.template.php', 'form_1');
			lb_redirect('index.php?forum=' . $forum_id, 'forum/' . $forum_title . '-' . $redirect);

		}
		else
		{

			$post=escape_string($_GET['post']);

			mysql_query("DELETE FROM {$db_prefix}moderate WHERE postid ='$post'");			

		// Replace the last reply in the database...

			$query21 = "select TOPIC_ID from {$db_prefix}posts WHERE ID='$post'" ;
			$result21 = mysql_query($query21) or die("delete.php - Error in query: $query21") ;                                  
			$topic_id = mysql_result($result21, 0);				
			
			mysql_query("DELETE FROM {$db_prefix}posts WHERE id ='$post'");
			
			$query2 = "select ID, TIME, FORUM_ID, TOPIC_ID from {$db_prefix}posts WHERE TOPIC_ID='$topic_id' ORDER BY ID desc LIMIT 1" ;
			$result2 = mysql_query($query2) or die("newpost.php - Error in query: $query2") ;                                  
			while ($results2 = mysql_fetch_array($result2)){
				$post_id 		= $results2['ID'];
				$post_time 		= $results2['TIME'];
				$post_forum 	= $results2['FORUM_ID'];
				$post_topic 	= $results2['TOPIC_ID'];
			}

			$query2 = "select TITLE from {$db_prefix}posts WHERE TITLE!='' AND TOPIC_ID='$post_topic'" ;
			$result2 = mysql_query($query2) or die("newpost.php - Error in query: $query2") ;                                  
			$post_title = mysql_result($result2, 0);

			$query21 = "select TIME from {$db_prefix}posts WHERE TOPIC_ID='$topic_id' ORDER BY ID desc" ;
			$result21 = mysql_query($query21) or die("delete.php - Error in query: $query21") ;                                  
			$time = mysql_result($result21, 0);

			mysql_query("UPDATE {$db_prefix}posts SET last_post_time='$time' WHERE topic_id = '$topic_id' AND TITLE!=''");

			$query2121 = "select FILENAME from {$db_prefix}attachments WHERE POSTID='$post'" ;
			$result2121 = mysql_query($query2121) or die("delete.php - Error in query: $query2121") ;                                  
			while ($results2121 = mysql_fetch_array($result2121)){
				$filename = $results2121['FILENAME'];

				foreach (glob("uploads/attachments/$filename") as $filename_original) {
				   unlink($filename_original);
				}

				foreach (glob("uploads/attachments/t_$filename") as $filename_thumb) {
				   unlink($filename_thumb);
				}

				mysql_query("DELETE FROM {$db_prefix}attachments WHERE postid ='$post'");

			}

			$redirect=$topic_id;

			// perform auto-cache
			
				include "scripts/php/auto_cache.php";	

			template_hook("forums/delete.template.php", "form_2");

			$topic_title = topic_title($redirect);							
			
			lb_redirect("index.php?topic=$redirect","topic/$topic_title-$redirect");

		}
	}
}
else
{
	lb_redirect('index.php?page=error&error=28', 'error/28');
}
?>