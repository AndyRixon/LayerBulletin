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
|   topics.php - topic settings
 
*/

if (!defined('LB_RUN'))
{
	exit('<h1>ACCESS DENIED</h1>You cannot access this file directly.');
}

template_hook("pages/admin/topics.template.php", "start");

if($_GET['success']=='saved'){
	template_hook("pages/admin/topics.template.php", "successSaved");
}

if ($can_change_forum_settings == 0)
{
	lb_redirect('index.php?page=error&error=11', 'error/11');
}

if ($_POST['list_posts'] != '')
{
	$token_id				= escape_string($_POST['token_id']);
	$token_name				= "token_topics_$token_id";

	$list_topics			= (int) $_POST['list_topics'];
	$list_posts				= (int) $_POST['list_posts'];
	$hot_topic				= (int) $_POST['hot_topic'];
	$store_post_history		= (int) $_POST['store_post_history'];
	$quick_edit				= (int) $_POST['quick_edit'];
	$auto_merge				= (int) $_POST['auto_merge'];
	$trashcan				= array(
								'enabled'	=> (int) $_POST['trashcan_enabled'],
								'forum'		=> (int) $_POST['trashcan_forum'],
								'move'		=> (int) $_POST['trashcan_move'],
								'delete_1'	=> (int) $_POST['trashcan_delete_1'],
								'delete_2'	=> (int) $_POST['trashcan_delete_2']
							);
	$trashcan_query			= '';
	
	if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name])
	{
		if (!$trashcan['enabled'])
		{
			mysql_query('UPDATE ' . $db_prefix . 'settings SET trashcan_enabled = 0');
		}
		else
		{
			if ($trashcan_forum != $trashcan['forum'])
			{
					/*
					If this is a direct switch between two forums, we have to
					use an intermediary otherwise legit posts will be moved
					into the trashcan forum.
				*/
				
					$workaround = false;
					
					if ($trashcan_forum == $trashcan['move'])
					{
						# Fake forum id..
						$forum_id = -1;
						
						# So we know to fix this later
						$workaround = true;
					}
					else
					{
						$forum_id = $trashcan['move'];
					}
						
					/*
					Move posts out of the new trashcan forum:
				*/
				
					mysql_query('UPDATE ' . $db_prefix . 'posts SET forum_id = ' . $forum_id . ' WHERE forum_id = ' . $trashcan['forum']);
				
					/*
					Move posts from the current trashcan forum to the new one:
				*/
				
					mysql_query('UPDATE ' . $db_prefix . 'posts SET forum_id = ' . $trashcan['forum'] . ' WHERE forum_id = ' . $trashcan_forum);
				
					/*
					If a fake forum was used to move the posts, put them in the correct place:
				*/
				
					if ($workaround)
					{
						mysql_query('UPDATE ' . $db_prefix . 'posts SET forum_id = ' . $trashcan['move'] . ' WHERE forum_id = ' . $forum_id);
					}
			}
			
			$trashcan_time	= $trashcan['delete_1'] . ';' . $trashcan['delete_2'];
			$trashcan_query = ',
				trashcan_enabled		= ' . $trashcan['enabled'] . ',
				trashcan_forum			= ' . $trashcan['forum'] . ',
				trashcan_delete_time	= "' . $trashcan_time . '"
			';
			$extra 			= (!$trashcan_enabled && $trashcan['enabled']) ? ', trashcan_delete_ran = ' . time() : '';
		}
		
		mysql_query('
			UPDATE
				' . $db_prefix . 'settings
			SET
				list_topics				= ' . $list_topics . ',
				list_posts				= ' . $list_posts . ',
				hot_topic				= ' . $hot_topic . ',
				store_post_history		= ' . $store_post_history . ',
				quick_edit				= ' . $quick_edit . ',
				auto_merge				= ' . $auto_merge
				. $trashcan_query
				. $extra
		);

		# Delete settings cache
		$Cache->delete('settings');
		
		# Run auto-cache to update board index
		require $lb_root . 'scripts/php/auto_cache.php';

		template_hook("pages/admin/topics.template.php", "form");
		lb_redirect("index.php?page=admin&act=topics&success=saved","admin/topics/success/saved");
	}
	else
	{
		lb_redirect("index.php?page=error&error=28","error/28");
	}
}
else
{
	$token_id				= md5(microtime());
	$token					= md5(uniqid(rand(), true));
	$token_name				= 'token_topics_' . $token_id;
	$_SESSION[$token_name]	= $token;
	
	/*
	Get forums
*/

	$query	= mysql_query('SELECT id, name, parent FROM ' . $db_prefix . 'categories');
	$forums	= array();
	
	while ($row = mysql_fetch_assoc($query))
	{
		$forums[$row['parent']][$row['id']] = $row;
	}
	
	$trashcan = explode(';', $trashcan_delete_time);
	
	template_hook('pages/admin/topics.template.php', 2);
}

template_hook("pages/admin/topics.template.php", "end");
?>