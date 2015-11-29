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
|   permissions.php - gets users permissions from database
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

	/*
	Load the groups cache
*/
	
	$Groups = $Cache->load('groups');
	
	# Quick way of assigning the variables
	foreach ($Groups[$role] as $field => $value)
	{
		$$field = $value;
	}

if (isset($my_id))
{
	# Load moderators cache
	$Moderators = $Cache->load('moderators');
	
	/*
	If they're a moderator for a forum, give them admin cp access
*/
	
	$canMod = false;
	if (!empty($Moderators[$my_id]))
	{
		$can_change_forum_settings	= 1;
		$canMod						= true;
	}
	
	if ($canMod && isset($_GET['forum']) && is_numeric($_GET['forum']) && $_GET['func'] != 'merge' && $_GET['page'] != 'admin')
	{
		$forum_id = (int) $_GET['forum'];
	}
	elseif ($canMod && isset($_GET['topic']) && is_numeric($_GET['topic']))
	{
		$topic_id = (int) $_GET['topic'];
		
		/*
		This is a topic, so find which forum it belongs to...
	*/
	
		$query2	= mysql_query('SELECT forum_id FROM ' . $db_prefix . 'posts WHERE topic_id = ' . $topic_id . ' AND title != ""');
		$row	= mysql_fetch_assoc($query2);
		
			$forum_id = $row['forum_id'];
	}
	
	/*
	If they're a moderator for this forum, override their group permissions
*/

	if ($canMod)
	{
		foreach ($Moderators[$my_id][$forum_id] as $p => $value)
		{
			# Override...
			$$p = $value;
		}
	}
}
?>