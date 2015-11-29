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
|   revert.php - Revert a post from the trashcan forum
 
*/

if (!defined('LB_RUN'))
{
	exit('<h1>ACCESS DENIED</h1>You cannot access this file directly.');
}

if ($trashcan_enabled != 1)
{
	lb_redirect('index.php', '');
}

if ($can_delete_others_posts != 1)
{
	lb_redirect('index.php?page=error&error=4', 'error/4');
}

$post_id = (int) $_POST['post_revert_id'];

if (tokenCheck('topic_post_revert', $post_id))
{
	/*
	| First step is to get this posts info. This can then by used
	| to determine if it's in the trashcan forum or not.
	\----------------------------------------------------------------*/
		
		$query	= mysql_query('SELECT title, topic_id, original_topic_id, forum_id, original_forum_id FROM ' . $db_prefix . 'posts WHERE id = ' . $post_id);
		$info	= mysql_fetch_assoc($query);

	/*
	| Now lets check if they have permission to access the trashcan forum
	\------------------------------------------------------------------------*/

		$query	= mysql_query('SELECT can_view_forum FROM ' . $db_prefix . 'permissions WHERE group_id = ' . $role . ' AND forum_id = ' . $info['forum_id']);
		$row	= mysql_fetch_assoc($query);

		if ($row['can_view_forum'] != 1)
		{
			lb_redirect('index.php?page=error&error=2', 'error/2');
		}
		
	if ($info['forum_id'] == $trashcan_forum)
	{
		if ($info['title'] != '' && $info['original_topic_id'] == 0)
		{
			mysql_query('
				UPDATE ' . $db_prefix . 'posts
				SET forum_id = original_forum_id, original_forum_id = 0, locked = 0
				WHERE topic_id = ' . $info['topic_id']
			);
			
			$redirect = $info['topic_id'];
		}
		elseif ($info['original_topic_id'] != 0)
		{
			mysql_query('
				UPDATE ' . $db_prefix . 'posts
				SET
					title = "",
					forum_id = ' . $info['original_forum_id'] . ',
					original_forum_id = 0,
					topic_id = ' . $info['original_topic_id'] . ',
					original_topic_id = 0
				WHERE id = ' . $post_id
			);
			
			if ($info['title'] != '')
			{
				mysql_query('
					UPDATE ' . $db_prefix . 'posts
					SET title = "' . $info['title'] . '"
					WHERE topic_id = ' . $info['topic_id'] . '
					ORDER BY id ASC
					LIMIT 1
				');
			}
			
			$redirect = $info['original_topic_id'];
		}
	}

	require_once $lb_root . 'scripts/php/auto_cache.php';
	lb_redirect('index.php?topic=' . $redirect, 'topic/' . $info['title'] . '-' . $redirect);
}
else
{
	lb_redirect('index.php?page=error&error=28', 'error/28');
}

?>