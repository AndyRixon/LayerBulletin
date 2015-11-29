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
|   moderators.php - add/edit/delete forum moderators
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/admin/moderators.template.php", "start");

if($_GET['success']=='added') {
	template_hook("pages/admin/moderators.template.php", "successCreated");
}elseif($_GET['success']=='updated') {
	template_hook("pages/admin/moderators.template.php", "successUpdated");
}elseif($_GET['success']=='deleted') {
	template_hook("pages/admin/moderators.template.php", "successDeleted");
}

if ($can_change_site_settings=='0'){

	lb_redirect("index.php?page=error&error=11","error/11");

}

elseif ($_GET['func']=='delete')
{
	if ($_POST['agree'] != 1)
	{
		list($token_id, $token, $token_name) = tokenCreate('moderators_delete', array($_GET['forum'], $_GET['id']));
		template_hook("pages/admin/moderators.template.php", "warn");
	}
	else
	{
		$id		= (int) $_POST['id'];
		$forum	= (int) $_POST['forum'];
		
		if (tokenCheck('moderators_delete', array($forum, $id)))
		{
			mysql_query("DELETE FROM {$db_prefix}moderators WHERE member_id ='$id' AND forum_id='$forum'");
			
			# Delete cache
			$Cache->delete('moderators');

			template_hook("pages/admin/moderators.template.php", "form_1");

			lb_redirect("index.php?page=admin&act=moderators&success=deleted","admin/moderators/success/deleted");
		}
		else
		{
			lb_redirect('index.php?page=error&error=28', 'error/28');
		}
	}
}
elseif ($_POST['new_moderator_form'] == 1)
{
	$forum_id	= (int) $_POST['forum'];
	$member_id	= (int) $_POST['id'];
	
	if (tokenCheck('moderators_add_2', array($forum_id, $member_id)))
	{
		$mod_can_warn_members			= (int) $_POST['mod_can_warn_members'];
		$mod_can_ban_members			= (int) $_POST['mod_can_ban_members'];
		$mod_can_edit_own_posts			= (int) $_POST['mod_can_edit_own_posts'];
		$mod_can_edit_others_posts		= (int) $_POST['mod_can_edit_others_posts'];
		$mod_can_delete_own_posts		= (int) $_POST['mod_can_delete_own_posts'];
		$mod_can_delete_others_posts	= (int) $_POST['mod_can_delete_others_posts'];
		$mod_can_sticky_topics			= (int) $_POST['mod_can_sticky_topics'];
		$mod_can_move_topics			= (int) $_POST['mod_can_move_topics'];
		$mod_can_lock_topics			= (int) $_POST['mod_can_lock_topics'];
		$mod_can_split_topics			= (int) $_POST['mod_can_split_topics'];
		$mod_can_merge_topics			= (int) $_POST['mod_can_merge_topics'];
		$mod_can_add_polls				= (int) $_POST['mod_can_add_polls'];
		$mod_can_see_reported_posts		= (int) $_POST['mod_can_see_reported_posts'];
		$mod_can_use_html				= (int) $_POST['mod_can_use_html'];
		$mod_can_moderate_members		= (int) $_POST['mod_can_moderate_members'];

		mysql_query("INSERT INTO {$db_prefix}moderators (member_id, forum_id, can_warn_members, can_edit_members, can_ban_members, can_edit_own_posts, can_edit_others_posts, can_delete_own_posts, can_delete_others_posts, can_sticky_topics, can_move_topics, can_lock_topics, can_split_topics, can_merge_topics, can_add_polls, can_see_reported_posts, can_use_html, can_moderate_members) VALUES ('$member_id', '$forum_id', '$mod_can_warn_members', '$mod_can_edit_members', '$mod_can_ban_members', '$mod_can_edit_own_posts', '$mod_can_edit_others_posts', '$mod_can_delete_own_posts', '$mod_can_delete_others_posts', '$mod_can_sticky_topics', '$mod_can_move_topics', '$mod_can_lock_topics', '$mod_can_split_topics', '$mod_can_merge_topics', '$mod_can_add_polls', '$mod_can_see_reported_posts', '$mod_can_use_html', '$mod_can_moderate_members')");

		# Delete cache
		$Cache->delete('moderators');
		
		template_hook("pages/admin/moderators.template.php", "form_2");

		lb_redirect("index.php?page=admin&act=moderators&success=added","admin/moderators/success/added");
	}
	else
	{
		lb_redirect('index.php?page=error&error=28', 'error/28');
	}
}

elseif($_POST['post_edit_form']!='')
{
	$id = escape_string($_POST['id']);

	$token_id = $_POST['token_id'];
	$token_id = escape_string($token_id);

	$token_name = "token_moderators_edit_$token_id";

	if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name])
	{
		$forum_id	= (int) $_POST['forum'];
		$member_id	= (int)$_POST['id'];

		$mod_can_warn_members			= (int) $_POST['mod_can_warn_members'];
		$mod_can_ban_members			= (int) $_POST['mod_can_ban_members'];
		$mod_can_edit_members			= (int) $_POST['mod_can_edit_members'];
		$mod_can_edit_own_posts			= (int) $_POST['mod_can_edit_own_posts'];
		$mod_can_edit_others_posts		= (int) $_POST['mod_can_edit_others_posts'];
		$mod_can_delete_own_posts		= (int) $_POST['mod_can_delete_own_posts'];
		$mod_can_delete_others_posts	= (int) $_POST['mod_can_delete_others_posts'];
		$mod_can_sticky_topics			= (int) $_POST['mod_can_sticky_topics'];
		$mod_can_move_topics			= (int) $_POST['mod_can_move_topics'];
		$mod_can_lock_topics			= (int) $_POST['mod_can_lock_topics'];
		$mod_can_split_topics			= (int) $_POST['mod_can_split_topics'];
		$mod_can_merge_topics			= (int) $_POST['mod_can_merge_topics'];
		$mod_can_add_polls				= (int) $_POST['mod_can_add_polls'];
		$mod_can_see_reported_posts		= (int) $_POST['mod_can_see_reported_posts'];
		$mod_can_use_html				= (int) $_POST['mod_can_use_html'];
		$mod_can_moderate_members		= (int) $_POST['mod_can_moderate_members'];

		mysql_query("DELETE FROM {$db_prefix}moderators WHERE member_id ='$member_id' AND forum_id='$forum_id'");

		mysql_query("INSERT INTO {$db_prefix}moderators (member_id, forum_id, can_warn_members, can_edit_members, can_ban_members, can_edit_own_posts, can_edit_others_posts, can_delete_own_posts, can_delete_others_posts, can_sticky_topics, can_move_topics, can_lock_topics, can_split_topics, can_merge_topics, can_add_polls, can_see_reported_posts, can_use_html, can_moderate_members) VALUES ('$member_id', '$forum_id', '$mod_can_warn_members', '$mod_can_edit_members', '$mod_can_ban_members', '$mod_can_edit_own_posts', '$mod_can_edit_others_posts', '$mod_can_delete_own_posts', '$mod_can_delete_others_posts', '$mod_can_sticky_topics', '$mod_can_move_topics', '$mod_can_lock_topics', '$mod_can_split_topics', '$mod_can_merge_topics', '$mod_can_add_polls', '$mod_can_see_reported_posts', '$mod_can_use_html', '$mod_can_moderate_members')");

		# Delete cache
		$Cache->delete('moderators');
		
		template_hook("pages/admin/moderators.template.php", "form_3");

		lb_redirect("index.php?page=admin&act=moderators&success=updated","admin/moderators/success/updated");

	}
	else
	{
		lb_redirect("index.php?page=error&error=28","error/28");
	}
}

elseif($_GET['func']=='edit')
{
	$token_id = md5(microtime());
	$token = md5(uniqid(rand(),true));

	$member_id = escape_string($_GET['id']);
	$forum_id = escape_string($_GET['forum']);

	$token_name = "token_moderators_edit_$token_id";

	$_SESSION[$token_name] = $token;

	$query_moderators = "select can_warn_members, can_edit_members, can_ban_members, can_edit_own_posts, can_edit_others_posts, can_delete_own_posts, can_delete_others_posts, can_sticky_topics, can_move_topics, can_lock_topics, can_split_topics, can_merge_topics, can_add_polls, can_see_reported_posts, can_use_html, can_moderate_members from {$db_prefix}moderators WHERE member_id ='$member_id' AND forum_id='$forum_id'" ;
	$result_moderators = mysql_query($query_moderators) or die("moderators.php - Error in query: $query_moderators") ;                                  
	while ($results_moderators = mysql_fetch_array($result_moderators))
	{
		$mod_can_warn_members = $results_moderators['can_warn_members'];
		$mod_can_edit_members = $results_moderators['can_edit_members'];
		$mod_can_delete_members = $results_moderators['can_delete_members'];
		$mod_can_ban_members = $results_moderators['can_ban_members'];
		$mod_can_edit_own_posts = $results_moderators['can_edit_own_posts'];
		$mod_can_edit_others_posts = $results_moderators['can_edit_others_posts'];
		$mod_can_delete_own_posts = $results_moderators['can_delete_own_posts'];
		$mod_can_delete_others_posts = $results_moderators['can_delete_others_posts'];
		$mod_can_sticky_topics = $results_moderators['can_sticky_topics'];
		$mod_can_move_topics = $results_moderators['can_move_topics'];
		$mod_can_lock_topics = $results_moderators['can_lock_topics'];
		$mod_can_split_topics = $results_moderators['can_split_topics'];
		$mod_can_merge_topics = $results_moderators['can_merge_topics'];
		$mod_can_add_polls = $results_moderators['can_add_polls'];
		$mod_can_see_reported_posts = $results_moderators['can_see_reported_posts'];
		$mod_can_use_html = $results_moderators['can_use_html'];
		$mod_can_moderate_members = $results_moderators['can_moderate_members'];
	}

	$forum = escape_string($_GET['forum']);	
		
	$query3 = "select NAME from {$db_prefix}categories WHERE ID='$forum'";
	$result3 = mysql_query($query3) or die("categories.php - Error in query: $query3") ; 
	$forum_name = strip_slashes(mysql_result($result3, 0));

	$query42 = "select NAME from {$db_prefix}members WHERE ID='$member_id'" ;
	$result42 = mysql_query($query42) or die("categories.php - Error in query: $query42") ; 
	$member_name = strip_slashes(mysql_result($result42, 0));
		
	template_hook("pages/admin/moderators.template.php", "1");	
	
}

elseif ($_GET['func']=='forum')
{
	if ($_POST['id'] == '')
	{
		$forum = (int) $_GET['forum'];
		
		if ($forum == 0)
		{
			lb_redirect('index.php?page=admin&act=moderators', 'admin/moderators');
		}
		
		list($token_id, $token, $token_name) = tokenCreate('moderators_add', $forum);
		template_hook("pages/admin/moderators.template.php", "2");
	}
	else
	{
		$forum = (int) $_POST['forum'];
		
		if (tokenCheck('moderators_add', $forum))
		{
			$member_id = (int) $_POST['id'];

			$query3 = "select NAME from {$db_prefix}categories WHERE ID='$forum'";
			$result3 = mysql_query($query3) or die("categories.php - Error in query: $query3") ; 
			$forum_name = strip_slashes(mysql_result($result3, 0));

			$query42 = "select NAME from {$db_prefix}members WHERE ID='$member_id'" ;
			$result42 = mysql_query($query42) or die("categories.php - Error in query: $query42") ; 
			$member_name = strip_slashes(mysql_result($result42, 0));
			
			list($token_id, $token, $token_name) = tokenCreate('moderators_add_2', array($forum, $member_id));

			template_hook("pages/admin/moderators.template.php", "3");
		}
		else
		{
			lb_redirect('index.php?page=error&error=28', 'error/28');
		}
	}
}

else
{
	template_hook("pages/admin/moderators.template.php", "14");

	$query3 = "select ID, NAME from {$db_prefix}categories WHERE PARENT='0' ORDER BY FORUM_ORDER, ID asc" ;
	$result3 = mysql_query($query3) or die("categories.php - Error in query: $query3") ; 
	$number_of_forums=mysql_num_rows($result3);
	while ($results3 = mysql_fetch_array($result3))
	{
		$id = $results3['ID'];
		$parent_id = $results3['ID'];
		$name = $results3['NAME'];

		$name = strip_slashes($name);

		template_hook("pages/admin/moderators.template.php", "15");

		$query4 = "select ID, NAME from {$db_prefix}categories WHERE PARENT='$id' ORDER BY FORUM_ORDER, ID asc" ;
		$result4 = mysql_query($query4) or die("categories.php - Error in query: $query4") ; 
		while ($results4 = mysql_fetch_array($result4))
		{
			$id = $results4['ID'];
			$name = $results4['NAME'];

			$name = strip_slashes($name);

			template_hook("pages/admin/moderators.template.php", "18");

			$query41 = "select MEMBER_ID from {$db_prefix}moderators WHERE FORUM_ID='$id' ORDER BY ROW desc" ;
			$result41 = mysql_query($query41) or die("categories.php - Error in query: $query41") ; 
			while ($results41 = mysql_fetch_array($result41))
			{
				$member_id = $results41['MEMBER_ID'];

				$query42 = "select NAME from {$db_prefix}members WHERE ID='$member_id'" ;
				$result42 = mysql_query($query42) or die("categories.php - Error in query: $query42") ; 
				$member_name = strip_slashes(mysql_result($result42, 0));

				template_hook("pages/admin/moderators.template.php", "4");
			}

			template_hook("pages/admin/moderators.template.php", "19");

			// sub-forums...
			$query_sub = "select ID, NAME from {$db_prefix}categories WHERE PARENT='$id' ORDER BY FORUM_ORDER, ID asc" ;
			$result_sub = mysql_query($query_sub) or die("categories.php - Error in query: $query_sub") ; 
			while ($results_sub = mysql_fetch_array($result_sub))
			{
				$id = $results_sub['ID'];
				$name = $results_sub['NAME'];

				$name = strip_slashes($name);

				template_hook("pages/admin/moderators.template.php", "21");

				$query43 = "select MEMBER_ID from {$db_prefix}moderators WHERE FORUM_ID='$id' ORDER BY ROW desc" ;
				$result43 = mysql_query($query43) or die("categories.php - Error in query: $query43") ; 
				while ($results43 = mysql_fetch_array($result43))
				{
					$member_id = $results43['MEMBER_ID'];

					$query44 = "select NAME from {$db_prefix}members WHERE ID='$member_id'" ;
					$result44 = mysql_query($query44) or die("categories.php - Error in query: $query44") ; 
					$member_name = strip_slashes(mysql_result($result44, 0));

					template_hook("pages/admin/moderators.template.php", "4");
				}
			}
		}
	}

	template_hook("pages/admin/moderators.template.php", "25");

}

template_hook("pages/admin/moderators.template.php", "end");
?>