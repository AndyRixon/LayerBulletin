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
|   groups.php - set up member groups
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/admin/groups.template.php", "start");

if($_GET['success']=="updated"){
	template_hook("pages/admin/groups.template.php", "successUpdated");
}elseif($_GET['success']=="added"){
	template_hook("pages/admin/groups.template.php", "successAdded");
}elseif($_GET['success']=="deleted"){
	template_hook("pages/admin/groups.template.php", "successDeleted");
}

if ($can_change_site_settings=='0'){

	lb_redirect("index.php?page=error&error=11","error/11");

}

else{

if ($_POST['post_new']!=''){

$token_id = escape_string($_POST['token_id']);

$token_name = "token_groups_new_$token_id";

if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

$group_name					= escape_string($_POST['group_name']);
$group_icon					= escape_string($_POST['group_icon']);
$group_color		 		= escape_string($_POST['group_color']); 
$can_view_board				= (int) $_POST['can_view_board'];
$can_warn_members	 		= (int) $_POST['can_warn_members']; 
$can_edit_members	 		= (int) $_POST['can_edit_members'];
$can_delete_members	 		= (int) $_POST['can_delete_members'];
$can_ban_members	 		= (int) $_POST['can_ban_members'];
$can_change_site_settings	= (int) $_POST['can_change_site_settings'];
$can_change_forum_settings	= (int) $_POST['can_change_forum_settings'];
$can_change_style			= (int) $_POST['can_change_style'];
$can_use_avatar				= (int) $_POST['can_use_avatar'];
$can_change_user_title		= (int) $_POST['can_change_user_title'];
$can_use_sig				= (int) $_POST['can_use_sig'];
$can_change_own_name		= (int) $_POST['can_change_own_name'];
$can_pm						= (int) $_POST['can_pm'];
$can_edit_own_posts			= (int) $_POST['can_edit_own_posts'];
$can_edit_others_posts		= (int) $_POST['can_edit_others_posts'];
$can_delete_own_posts		= (int) $_POST['can_delete_own_posts'];
$can_delete_others_posts	= (int) $_POST['can_delete_others_posts'];
$can_sticky_topics			= (int) $_POST['can_sticky_topics'];
$can_global_announce		= (int) $_POST['can_global_announce'];
$can_move_topics			= (int) $_POST['can_move_topics'];
$can_lock_topics			= (int) $_POST['can_lock_topics'];
$can_split_topics			= (int) $_POST['can_split_topics'];
$can_merge_topics			= (int) $_POST['can_merge_topics'];
$can_add_polls				= (int) $_POST['can_add_polls'];
$can_see_reported_posts		= (int) $_POST['can_see_reported_posts'];
$can_use_html				= (int) $_POST['can_use_html'];
$can_moderate_members		= (int) $_POST['can_moderate_members'];
$avoid_caspian				= (int) $_POST['avoid_caspian'];

mysql_query("INSERT INTO {$db_prefix}groups (group_name, group_icon, group_color, can_view_board, can_warn_members, can_edit_members, can_delete_members, can_ban_members, can_change_site_settings, can_change_forum_settings, can_change_style, can_use_avatar, can_change_user_title, can_use_sig, can_change_own_name, can_pm, can_edit_own_posts, can_edit_others_posts, can_delete_own_posts, can_delete_others_posts, can_sticky_topics, can_global_announce, can_move_topics, can_lock_topics, can_split_topics, can_merge_topics, can_add_polls, can_see_reported_posts, can_use_html, can_moderate_members, avoid_caspian) VALUES ('$group_name', '$group_icon', '$group_color', '$can_view_board', '$can_warn_members', '$can_edit_members', '$can_delete_members', '$can_ban_members', '$can_change_site_settings', '$can_change_forum_settings', '$can_change_style', '$can_use_avatar', '$can_change_user_title', '$can_use_sig', '$can_change_own_name', '$can_pm', '$can_edit_own_posts', '$can_edit_others_posts', '$can_delete_own_posts', '$can_delete_others_posts', '$can_sticky_topics', '$can_global_announce', '$can_move_topics', '$can_lock_topics', '$can_split_topics', '$can_merge_topics', '$can_add_polls', '$can_see_reported_posts','$can_use_html','$can_moderate_members','$avoid_caspian')");

# Delete cache
$Cache->delete('groups');

if ($_POST['group_copy_id'] != ''){

$group_copy_from = escape_string($_POST['group_copy_id']);

// copy group permissions...

// get new group_id...

$query2 = "select GROUP_ID from {$db_prefix}groups WHERE GROUP_NAME='$group_name' ORDER BY GROUP_ID asc LIMIT 1" ;
$result2 = mysql_query($query2) or die("groups.php - Error in query: $query2") ;                                  
$group_copy_id = mysql_result($result2, 0);

// now loop and insert permissions...

$query2 = "select FORUM_ID, CAN_VIEW_FORUM, CAN_READ_TOPICS, CAN_ADD_TOPICS, CAN_REPLY_TOPICS, CAN_ADD_ATTACHMENT, CAN_DOWNLOAD_ATTACHMENT from {$db_prefix}permissions WHERE group_id = '$group_copy_from'" ;
$result2 = mysql_query($query2) or die("groups.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$forum_copy_id = $results2['FORUM_ID'];
$can_view_forum_copy = $results2['CAN_VIEW_FORUM'];
$can_read_topics_copy = $results2['CAN_READ_TOPICS'];
$can_add_topics_copy = $results2['CAN_ADD_TOPICS'];
$can_reply_topics_copy = $results2['CAN_REPLY_TOPICS'];
$can_add_attachment_copy = $results2['CAN_ADD_ATTACHMENT'];
$can_download_attachment_copy = $results2['CAN_DOWNLOAD_ATTACHMENT'];

// insert results as we go...

mysql_query("INSERT INTO {$db_prefix}permissions (group_id, forum_id, can_view_forum, can_read_topics, can_add_topics, can_reply_topics, can_add_attachment, can_download_attachment) VALUES ('$group_copy_id', '$forum_copy_id', '$can_view_forum_copy', '$can_read_topics_copy', '$can_add_topics_copy', '$can_reply_topics_copy', '$can_add_attachment_copy', '$can_download_attachment_copy')");

}

}

	template_hook("pages/admin/groups.template.php", "form_1");

	lb_redirect("index.php?page=admin&act=groups&success=added","admin/groups/success/added");

}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}

elseif($_GET['func']=='delete')
{
	$group_delete =(int) $_POST['group'];

	if (tokenCheck('groups_delete', $group_delete))
	{
		if (!in_array($group_delete, array(1,3,4)))
		{
			// Automatically move everyone to the members group...
			mysql_query("UPDATE {$db_prefix}members SET role = 3 WHERE role = '" . $group_delete . "'");
			
			// then delete...
			mysql_query("DELETE FROM {$db_prefix}groups WHERE group_id ='$group_delete'");
			
			# Cache needs rebuilding
			$Cache->delete('groups');
			
			// and remove forum permissions...
			mysql_query("DELETE FROM {$db_prefix}permissions WHERE group_id ='$group_delete'");
		}

		template_hook("pages/admin/groups.template.php", "form_2");

		lb_redirect("index.php?page=admin&act=groups&success=deleted","admin/groups/success/deleted");
	}
	else
	{
		lb_redirect('index.php?page=error&error=28', 'error/28');
	}

}

elseif ($_POST['post_edit'] != '')
{
	$token_id 	= escape_string($_POST['token_id']);
	$groupid	= (int) $_POST['group_id'];

	$token_name = "token_groups_$groupid$token_id";
	
	if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name])
	{
		$group_name					= escape_string($_POST['group_name']);
		$group_color		 		= escape_string($_POST['group_color']); 
		$group_icon			 		= escape_string($_POST['group_icon']);
		$can_view_board				= (int) $_POST['can_view_board'];
		$can_warn_members	 		= (int) $_POST['can_warn_members']; 
		$can_edit_members	 		= (int) $_POST['can_edit_members'];
		$can_delete_members	 		= (int) $_POST['can_delete_members'];
		$can_ban_members	 		= (int) $_POST['can_ban_members'];
		$can_change_site_settings	= (int) $_POST['can_change_site_settings'];
		$can_change_forum_settings	= (int) $_POST['can_change_forum_settings'];
		$can_change_style			= (int) $_POST['can_change_style'];
		$can_use_avatar				= (int) $_POST['can_use_avatar'];
		$can_change_user_title		= (int) $_POST['can_change_user_title'];
		$can_use_sig				= (int) $_POST['can_use_sig'];
		$can_change_own_name		= (int) $_POST['can_change_own_name'];
		$can_pm						= (int) $_POST['can_pm'];
		$can_edit_own_posts			= (int) $_POST['can_edit_own_posts'];
		$can_edit_others_posts		= (int) $_POST['can_edit_others_posts'];
		$can_delete_own_posts		= (int) $_POST['can_delete_own_posts'];
		$can_delete_others_posts	= (int) $_POST['can_delete_others_posts'];
		$can_sticky_topics			= (int) $_POST['can_sticky_topics'];
		$can_global_announce		= (int) $_POST['can_global_announce'];
		$can_move_topics			= (int) $_POST['can_move_topics'];
		$can_lock_topics			= (int) $_POST['can_lock_topics'];
		$can_split_topics			= (int) $_POST['can_split_topics'];
		$can_merge_topics			= (int) $_POST['can_merge_topics'];
		$can_add_polls				= (int) $_POST['can_add_polls'];
		$can_see_reported_posts		= (int) $_POST['can_see_reported_posts'];
		$can_use_html				= (int) $_POST['can_use_html'];
		$can_moderate_members		= (int) $_POST['can_moderate_members'];
		$avoid_caspian				= (int) $_POST['avoid_caspian'];
		
		if ($groupid == 1)
		{
			$can_change_site_settings = 1;
		}
		 
		mysql_query("UPDATE {$db_prefix}groups SET group_name='$group_name', group_color='$group_color', can_view_board='$can_view_board', can_warn_members='$can_warn_members', can_edit_members='$can_edit_members', can_delete_members='$can_delete_members', can_ban_members='$can_ban_members', can_change_site_settings='$can_change_site_settings', can_change_forum_settings='$can_change_forum_settings', can_change_style='$can_change_style', can_use_avatar='$can_use_avatar', can_change_user_title='$can_change_user_title', can_use_sig='$can_use_sig', can_change_own_name='$can_change_own_name', can_pm='$can_pm', can_edit_own_posts='$can_edit_own_posts', can_edit_others_posts='$can_edit_others_posts', can_delete_own_posts='$can_delete_own_posts', can_delete_others_posts='$can_delete_others_posts', can_sticky_topics='$can_sticky_topics', can_global_announce='$can_global_announce', can_move_topics='$can_move_topics', can_lock_topics='$can_lock_topics', can_split_topics='$can_split_topics', can_merge_topics='$can_merge_topics', can_add_polls='$can_add_polls', can_see_reported_posts='$can_see_reported_posts', can_use_html='$can_use_html' , can_moderate_members='$can_moderate_members' , avoid_caspian='$avoid_caspian', group_icon='$group_icon' WHERE group_id='$groupid'");

		# Delete cache
		$Cache->delete('groups');

		if ($_POST['group_copy_id'] != '')
		{
			$group_copy_id = (int) $_POST['group_copy_id'];

			// now loop and insert permissions...

			mysql_query("DELETE FROM {$db_prefix}permissions WHERE group_id ='$groupid'");

			$query2 = "select FORUM_ID, CAN_VIEW_FORUM, CAN_READ_TOPICS, CAN_ADD_TOPICS, CAN_REPLY_TOPICS, CAN_ADD_ATTACHMENT, CAN_DOWNLOAD_ATTACHMENT from {$db_prefix}permissions WHERE group_id = '$group_copy_id'" ;
			$result2 = mysql_query($query2) or die("groups.php - Error in query: $query2");
			
			while ($results2 = mysql_fetch_array($result2))
			{
				$forum_copy_id = $results2['FORUM_ID'];
				$can_view_forum_copy = $results2['CAN_VIEW_FORUM'];
				$can_read_topics_copy = $results2['CAN_READ_TOPICS'];
				$can_add_topics_copy = $results2['CAN_ADD_TOPICS'];
				$can_reply_topics_copy = $results2['CAN_REPLY_TOPICS'];
				$can_add_attachment_copy = $results2['CAN_ADD_ATTACHMENT'];
				$can_download_attachment_copy = $results2['CAN_DOWNLOAD_ATTACHMENT'];

				// insert results as we go...

				mysql_query("INSERT INTO {$db_prefix}permissions (group_id, forum_id, can_view_forum, can_read_topics, can_add_topics, can_reply_topics, can_add_attachment, can_download_attachment) VALUES ('$groupid', '$forum_copy_id', '$can_view_forum_copy', '$can_read_topics_copy', '$can_add_topics_copy', '$can_reply_topics_copy', '$can_add_attachment_copy', '$can_download_attachment_copy')");
			}

		}
		
		# Re-load cache
		$Cache->load('groups');

		template_hook("pages/admin/groups.template.php", "form_3");

		lb_redirect("index.php?page=admin&act=groups&success=updated","admin/groups/success/updated");

	}
	else
	{
		lb_redirect("index.php?page=error&error=28","error/28");
	}
}

elseif($_GET['func']=='new'){


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_groups_new_$token_id";

$_SESSION[$token_name] = $token;

template_hook("pages/admin/groups.template.php", "4");

$query2 = "select GROUP_ID, GROUP_NAME from {$db_prefix}groups ORDER BY can_change_site_settings desc, can_change_forum_settings desc, group_name asc" ;
$result2 = mysql_query($query2) or die("groups.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$group_copy_id = $results2['GROUP_ID'];
$group_copy_name = strip_slashes($results2['GROUP_NAME']);

template_hook("pages/admin/groups.template.php", "9");

}

template_hook("pages/admin/groups.template.php", "10");

}

elseif($_GET['func']=='edit'){


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$group_id = escape_string($_GET['id']);

$token_name = "token_groups_$group_id$token_id";

$_SESSION[$token_name] = $token;

$query2 = "select GROUP_ID, GROUP_NAME, GROUP_COLOR, GROUP_ICON, CAN_VIEW_BOARD, CAN_WARN_MEMBERS, CAN_EDIT_MEMBERS, CAN_DELETE_MEMBERS, CAN_BAN_MEMBERS, CAN_CHANGE_SITE_SETTINGS, CAN_CHANGE_FORUM_SETTINGS, CAN_CHANGE_STYLE, CAN_USE_AVATAR, CAN_CHANGE_USER_TITLE, CAN_USE_SIG, CAN_CHANGE_OWN_NAME, CAN_PM, CAN_EDIT_OWN_POSTS, CAN_EDIT_OTHERS_POSTS, CAN_DELETE_OWN_POSTS, CAN_DELETE_OTHERS_POSTS, CAN_STICKY_TOPICS, CAN_GLOBAL_ANNOUNCE, CAN_MOVE_TOPICS, CAN_LOCK_TOPICS, CAN_SPLIT_TOPICS, CAN_MERGE_TOPICS, CAN_ADD_POLLS, CAN_SEE_REPORTED_POSTS, CAN_USE_HTML, CAN_MODERATE_MEMBERS, AVOID_CASPIAN from {$db_prefix}groups WHERE GROUP_ID='$group_id'" ;
$result2 = mysql_query($query2) or die("groups.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$group_id = $results2['GROUP_ID'];
$group_name = strip_slashes($results2['GROUP_NAME']);
$group_icon = strip_slashes($results2['GROUP_ICON']);
$group_color = strip_slashes($results2['GROUP_COLOR']);
$can_view_board = $results2['CAN_VIEW_BOARD'];
$can_warn_members = $results2['CAN_WARN_MEMBERS'];
$can_edit_members = $results2['CAN_EDIT_MEMBERS'];
$can_delete_members = $results2['CAN_DELETE_MEMBERS'];
$can_ban_members = $results2['CAN_BAN_MEMBERS'];
$can_change_site_settings_form = $results2['CAN_CHANGE_SITE_SETTINGS'];
$can_change_forum_settings = $results2['CAN_CHANGE_FORUM_SETTINGS'];
$can_change_style = $results2['CAN_CHANGE_STYLE'];
$can_use_avatar = $results2['CAN_USE_AVATAR'];
$can_change_user_title = $results2['CAN_CHANGE_USER_TITLE'];
$can_use_sig = $results2['CAN_USE_SIG'];
$can_change_own_name = $results2['CAN_CHANGE_OWN_NAME'];
$can_pm = $results2['CAN_PM'];
$can_edit_own_posts = $results2['CAN_EDIT_OWN_POSTS'];
$can_edit_others_posts = $results2['CAN_EDIT_OTHERS_POSTS'];
$can_delete_own_posts = $results2['CAN_DELETE_OWN_POSTS'];
$can_delete_others_posts = $results2['CAN_DELETE_OTHERS_POSTS'];
$can_sticky_topics = $results2['CAN_STICKY_TOPICS'];
$can_global_announce = $results2['CAN_GLOBAL_ANNOUNCE'];
$can_move_topics = $results2['CAN_MOVE_TOPICS'];
$can_lock_topics = $results2['CAN_LOCK_TOPICS'];
$can_split_topics = $results2['CAN_SPLIT_TOPICS'];
$can_merge_topics = $results2['CAN_MERGE_TOPICS'];
$can_add_polls = $results2['CAN_ADD_POLLS'];
$can_see_reported_posts = $results2['CAN_SEE_REPORTED_POSTS'];
$can_use_html = $results2['CAN_USE_HTML'];
$can_moderate_members = $results2['CAN_MODERATE_MEMBERS'];
$avoid_caspian = $results2['AVOID_CASPIAN'];

if ($can_change_site_settings=="0"){
$disabled="disabled";
}
else{
$disabled="";
}

template_hook("pages/admin/groups.template.php", "5");

$query2 = "select GROUP_ID, GROUP_NAME from {$db_prefix}groups ORDER BY can_change_site_settings desc, can_change_forum_settings desc, group_name asc" ;
$result2 = mysql_query($query2) or die("groups.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$group_copy_id = $results2['GROUP_ID'];
$group_copy_name = strip_slashes($results2['GROUP_NAME']);

template_hook("pages/admin/groups.template.php", "11");

}

template_hook("pages/admin/groups.template.php", "12");

}
}
else
{
	template_hook("pages/admin/groups.template.php", "6");

	$query2 = "select GROUP_ID, GROUP_NAME, GROUP_COLOR from {$db_prefix}groups ORDER BY GROUP_ID" ;
	$result2 = mysql_query($query2) or die("groups.php - Error in query: $query2") ;                                  
	while ($results2 = mysql_fetch_array($result2))
	{
		$group_id = $results2['GROUP_ID'];
		$group_name = strip_slashes($results2['GROUP_NAME']);
		$group_color = strip_slashes($results2['GROUP_COLOR']);
		
		list($token_id, $token, $token_name) = tokenCreate('groups_delete', $group_id);

		template_hook("pages/admin/groups.template.php", "7");
	}

	template_hook("pages/admin/groups.template.php", "8");
}

}

template_hook("pages/admin/groups.template.php", "end");
?>