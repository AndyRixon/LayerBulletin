<?php

/*
+--------------------------------------------------------------------------
|  LayerBulletin
|  ========================================
|  By The LayerBulletin team
|  Released under the Artistic License 2.0
|  http://layerbulletin.com/
|  ========================================
|   friendlist.php - friendlist
*/
 
if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/myoptions/friendlist.template.php", "start");

switch ($_GET['success']) {
	case 'already_friend':
		template_hook("pages/myoptions/friendlist.template.php", "successAlreadyFriend");
		break;

	case 'yourself':
		template_hook("pages/myoptions/friendlist.template.php", "successYourself");
		break;

	case 'added':
		template_hook("pages/myoptions/friendlist.template.php", "successAdded");
		break;

	case 'not_friend':
		template_hook("pages/myoptions/friendlist.template.php", "successNotFriend");
		break;

	case 'removed':
		template_hook("pages/myoptions/friendlist.template.php", "successRemoved");
		break;
}

if ($_POST['add_friend'])
{
	$friend_id = escape_string($_POST['friend_id']);
	
	$query = mysql_query("SELECT `friends` FROM `{$db_prefix}members` WHERE `id`='{$my_id}'");
	$friends = mysql_fetch_array($query);
	$friends = explode(',', $friends['friends']);
	
	if (in_array($friend_id, $friends))
		lb_redirect("index.php?page=myoptions&act=friendlist&success=already_friend", "myoptions/friendlist/success/already_friend");
	elseif ($friend_id == $my_id)
		lb_redirect("index.php?page=myoptions&act=friendlist&success=yourself", "myoptions/friendlist/success/yourself");
	else
	{
		$query = mysql_query("UPDATE `{$db_prefix}members` SET `friends`= CONCAT(`friends`, '{$friend_id},') WHERE `id`='{$my_id}'");
	}
	
	lb_redirect("index.php?page=myoptions&act=friendlist&success=added", "myoptions/friendlist/success/added");
}
elseif ($_POST['delete_friend'])
{
	$friend_id = escape_string($_POST['friend_id']);

	$query = mysql_query("SELECT `friends` FROM `{$db_prefix}members` WHERE `id`='{$my_id}'");
	$friends = mysql_fetch_array($query);
	$friends = explode(',', $friends['friends']);
	
	if (!in_array($friend_id, $friends))
		lb_redirect("index.php?page=myoptions&act=friendlist&success=not_friend", "myoptions/friendlist/success/not_friend");
	else
	{
		unset($friends[array_search($friend_id, $friends)]);
		
		$friends = implode(',', $friends);
		$query = mysql_query("UPDATE `{$db_prefix}members` SET `friends`='{$friends}'");
	}
	
	lb_redirect("index.php?page=myoptions&act=friendlist&success=removed", "myoptions/friendlist/success/removed");
}
else
{
	$query = mysql_query("SELECT `friends` from `{$db_prefix}members` WHERE `id`='{$my_id}'");
	$friends = mysql_fetch_assoc($query);
	$friends = str_replace(",", "','", $friends['friends']);
	$query = mysql_query("SELECT `id`, `name` from `{$db_prefix}members` WHERE `id` IN ('{$friends}')");
	

	if (!mysql_num_rows($query))
		template_hook("pages/myoptions/friendlist.template.php", 1);
	else
	{
		template_hook("pages/myoptions/friendlist.template.php", 2);	

		while ($friend_info = mysql_fetch_array($query)) {
			$query_online = mysql_query("SELECT `id` FROM `{$db_prefix}sessions` WHERE `id`='{$friend_info['id']}' LIMIT 1");
			if(mysql_num_rows($query_online) == 1) {
				$online_status = 'Online';
			} else {
				$online_status = 'Offline';
			}
			template_hook("pages/myoptions/friendlist.template.php", 3);	
		}
			
		template_hook("pages/myoptions/friendlist.template.php", 4);
	}
}

template_hook("pages/myoptions/friendlist.template.php", "end");
	
?>