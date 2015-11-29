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
|   members.php - edit members
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

if (isset($_GET['idemail'])){
	$_GET['id'] = $_GET['idemail'];
}

template_hook("pages/admin/members.template.php", "start");

switch ($_GET['success']) {
	case 'updated':
		template_hook("pages/admin/members.template.php", "successUpdated");
		break;
	
	case 'deleted':
		template_hook("pages/admin/members.template.php", "successDeleted");
		break;

	case 'banned':
		template_hook("pages/admin/members.template.php", "successBanned");
		break;

	case 'unbanned':
		template_hook("pages/admin/members.template.php", "successUnbanned");
		break;
}

$query2 = "select CAN_EDIT_MEMBERS from {$db_prefix}moderators WHERE MEMBER_ID='$my_id' AND CAN_EDIT_MEMBERS='1'" ;
$result2 = mysql_query($query2) or die("preview.php - Error in query: $query2") ;                                  
$can_edit_members_count=mysql_num_rows($result2);

$query2 = "select CAN_BAN_MEMBERS from {$db_prefix}moderators WHERE MEMBER_ID='$my_id' AND CAN_BAN_MEMBERS='1'" ;
$result2 = mysql_query($query2) or die("preview.php - Error in query: $query2") ;  
$can_ban_members_count=mysql_num_rows($result2);


if ($can_edit_members_count!='0'){
$can_edit_members="1";
}

if ($can_ban_members_count!='0'){
$can_ban_members="1";
}

if ($can_edit_members=='0'){

	lb_redirect("index.php?page=error&error=18","error/18");

}

else{

if($_GET['func']=='delete'){

	$del_id		= (int) $_POST['id'];
	$token_id	= escape_string($_POST['token_id']);
	$token_name	= 'token_members_' . $del_id . $token_id;

	if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name])
	{
		$query2121 = "select ROLE from {$db_prefix}members WHERE ID='$del_id'" ;
		$result2121 = mysql_query($query2121) or die("delete.php - Error in query: $query2121") ; 
		
		$their_role = mysql_result($result2121, 0);
		
		if ($their_role!='1')
		{
			mysql_query("DELETE FROM {$db_prefix}members WHERE id='$del_id'")or die (mysql_error());
			
			$sql="SELECT ID, NAME FROM {$db_prefix}members ORDER BY ID desc LIMIT 1";
			$sql_result = mysql_query($sql) or die ("download.php - Error in query: $sql");
			
			while($row = mysql_fetch_array($sql_result))
			{
				$new_name = strip_slashes($row['NAME']);
				$new_id = $row['ID'];
			}
			
			mysql_query("UPDATE {$db_prefix}settings SET stats_member_id='$new_id', stats_member_name='$new_name', stats_members=stats_members-1");
			
			# Remove settings cache
			$Cache->delete('settings');
		}
		
		// perform auto-cache
		include "scripts/php/auto_cache.php";	
		
		template_hook("pages/admin/members.template.php", "form_1");
		
		lb_redirect("index.php?page=admin&act=members&success=deleted","admin/members/success/deleted");
	}
	else
	{
		lb_redirect('index.php?page=error&error=28', 'error/28');
	}
}
elseif($_GET['func']=='ban'){

	$member_id	= (int) $_POST['id'];
	$token_id	= escape_string($_POST['token_id']);
	$token_name	= 'token_members_' . $member_id . $token_id;

	if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name])
	{
		// check if they have been banned already...
		$query2121 = "select BANNED, ROLE from {$db_prefix}members WHERE ID='$member_id'" ;
		$result2121 = mysql_query($query2121) or die("delete.php - Error in query: $query2121") ;                                  
		while ($results2121 = mysql_fetch_array($result2121))
		{
			$banned = $results2121['BANNED'];
			$banned_role = $results2121['ROLE'];
		}
		
		$success;
		if ($banned=='0' && $banned_role!='1')
		{
			mysql_query("UPDATE {$db_prefix}members SET banned='1' WHERE id='$member_id'");
			$success = "banned";
		}
		else
		{
			mysql_query("UPDATE {$db_prefix}members SET banned='0' WHERE id='$member_id'");
			$success = "unbanned";
		}

		template_hook("pages/admin/members.template.php", "form_2");

		lb_redirect(
			'index.php?page=admin&act=members&func=edit&id=' . $member_id . '&success=' . $success,
			'admin/members/edit/' . $member_id . '/success/' . $success
		);
	}
	else
	{
		lb_redirect('index.php?page=error&error=28', 'error/28');
	}
}
elseif ($_POST['post_edit']!=''){

$id = escape_string($_POST['id']);

$token_id = escape_string($_POST['token_id']);

$token_name = "token_members_$id$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

if ($_POST['suspend']!=''){

// convert days to time...
$suspend_until  = escape_string($_POST['suspend']);
$suspend_until  = time() + ($suspend_until * 24 * 60 * 60);

mysql_query("UPDATE {$db_prefix}members SET suspend_date='$suspend_until' WHERE id='$id'");
}

$name		= escape_string($_POST['name']);
$role		= escape_string($_POST['role']);
$location	= escape_string($_POST['location']);
$nationality= escape_string($_POST['nationality']);
$email		= escape_string($_POST['email']);
$msn		= escape_string($_POST['msn']);
$aol		= escape_string($_POST['aol']);
$yahoo		= escape_string($_POST['yahoo']);
$skype		= escape_string($_POST['skype']);
$usertitle	= escape_string($_POST['usertitle']);
$xbox		= escape_string($_POST['xbox']);
$wii		= escape_string($_POST['wii']);
$ps3		= escape_string($_POST['ps3']);
$verify		= escape_string($_POST['verify']);
$moderate	= escape_string($_POST['moderate']);
$never_spam	= escape_string($_POST['never_spam']);

$query2 = "select NAME from {$db_prefix}members WHERE NAME='$name'" ;
$result2 = mysql_query($query2) or die("username.php - Error in query: $query2") ;                                  
$count_names = mysql_num_rows($result2);

$query2 = "select NAME from {$db_prefix}members WHERE ID='$id'" ;
$result2 = mysql_query($query2) or die("username.php - Error in query: $query2") ;                                  
$current_name = mysql_result($result2, 0);

if ($count_names!='0' && $current_name!=$name){

	lb_redirect("index.php?page=error&error=37","error/37");

}

if ($_POST['change_password']!=''){

$password=escape_string($_POST['password']);


// Generate salt...
$salt = substr(md5(uniqid(rand(), true)), 0, 9);

// Salt the password
$password= md5($password . $salt);

$new_password_time=time();

if ($show_gamer_tags=='1'){

mysql_query("UPDATE {$db_prefix}members SET name='$name', role='$role', password='$password', pass_salt='$salt', password_time='$new_password_time', location='$location', nationality='$nationality', email='$email', msn='$msn', aol='$aol', yahoo='$yahoo', skype='$skype', usertitle='$usertitle', xbox='$xbox', wii='$wii', ps3='$ps3', verified='$verify', moderate='$moderate', never_spam='$never_spam' WHERE id='$id'");

}
else{

mysql_query("UPDATE {$db_prefix}members SET name='$name', role='$role', password='$password', pass_salt='$salt', password_time='$new_password_time', location='$location', nationality='$nationality', email='$email', msn='$msn', aol='$aol', yahoo='$yahoo', skype='$skype', usertitle='$usertitle', verified='$verify', moderate='$moderate', never_spam='$never_spam' WHERE id='$id'");

}

	$lang['email_newpost_title'] = str_replace("<%forumname>", $forum_name, $lang['email_newpost_title']);
	
	$lang['email_newpost_content'] = str_replace("<%subscriber>", $subscriber_name, $lang['email_newpost_content']);

// Let the user know their password has been changed...

	$lang['email_members_pass_title'] = str_replace("<%sitename>", $site_name, $lang['email_members_pass_title']);
	
	$lang['email_members_pass_content'] = str_replace("<%subscriber>", $_POST['name'], $lang['email_members_pass_content']);
	$lang['email_members_pass_content'] = str_replace("<%sitename>", $site_name, $lang['email_members_pass_content']);
	$lang['email_members_pass_content'] = str_replace("<%password>", $_POST['password'], $lang['email_members_pass_content']);
	$lang['email_members_pass_content'] = str_replace("<%site>", $lb_domain, $lang['email_members_pass_content']);
	
$message=$lang['email_members_pass_content'];

$outgoing=$_POST['email'];
$from="From: $site_name <$board_email>\r\n";
$subject=$lang['email_members_pass_title'];


mail($outgoing, $subject, $message, $from);

}
else{

mysql_query("UPDATE {$db_prefix}members SET name='$name', role='$role', location='$location', nationality='$nationality', email='$email', msn='$msn', aol='$aol', yahoo='$yahoo', skype='$skype', usertitle='$usertitle', xbox='$xbox', wii='$wii', ps3='$ps3', verified='$verify', moderate='$moderate', never_spam='$never_spam' WHERE id='$id'");
}

if ($_POST['remove_avatar']==''){
}
else{

$query2121 = "select FILENAME from {$db_prefix}attachments WHERE POSTID='0' AND MEMBER='$id'" ;
$result2121 = mysql_query($query2121) or die("delete.php - Error in query: $query2121") ;                                  
while ($results2121 = mysql_fetch_array($result2121)){
$filename = strip_slashes($results2121['FILENAME']);

foreach (glob("uploads/avatar/$filename") as $filename_original) {
   unlink($filename_original);
}

foreach (glob("uploads/avatar/t_$filename") as $filename_thumb) {
   unlink($filename_thumb);
}


mysql_query("DELETE FROM {$db_prefix}attachments WHERE filename ='$filename'");

}

mysql_query("UPDATE {$db_prefix}members SET avatar='', remote_avatar='1' WHERE id='$id'");
}

if ($_POST['remove_signature']=='1'){
mysql_query("UPDATE {$db_prefix}members SET signature='' WHERE id='$id'");
}

// If the username has changed, email them to let them know...

	$lang['email_members_name_title'] = str_replace("<%sitename>", $site_name, $lang['email_members_name_title']);

	$lang['email_members_name_content'] = str_replace("<%oldname>", $_POST['original_name'], $lang['email_members_name_content']);	
	$lang['email_members_name_content'] = str_replace("<%subscriber>", $_POST['name'], $lang['email_members_name_content']);
	$lang['email_members_name_content'] = str_replace("<%sitename>", $site_name, $lang['email_members_name_content']);
	$lang['email_members_name_content'] = str_replace("<%site>", $lb_domain, $lang['email_members_name_content']);

if ($_POST['original_name']!=$_POST['name']){

$message=$lang['email_members_name_content'];
$outgoing=$_POST['email'];
$from="From: $site_name <$board_email>\r\n";
$subject=$lang['email_members_name_title'];
mail($outgoing, $subject, $message, $from);
}

// if the group has been changed, PM them to let them know...
if($_POST['original_role']!=$_POST['role']){

$query2167 = "select TOPIC_ID from {$db_prefix}messages ORDER BY TOPIC_ID desc LIMIT 1" ;
$result2167 = mysql_query($query2167) or die("members.php - Error in query: $query2167") ;                                  
while ($results2167 = mysql_fetch_array($result2167)){
$topic_id = $results2167['TOPIC_ID'];
$topic_id=$topic_id+1;
}

$time=time();


$query21 = "select GROUP_NAME from {$db_prefix}groups WHERE GROUP_ID='$role'" ;
$result21 = mysql_query($query21) or die("members.php - Error in query: $query21");                                  
$group_name = strip_slashes(mysql_result($result21, 0));

$message_name=escape_string($_POST['name']);

	$lang['email_members_group_content'] = str_replace("<%subscriber>", $message_name, $lang['email_members_group_content']);
	$lang['email_members_group_content'] = str_replace("<%group>", $group_name, $lang['email_members_group_content']);

$title=$lang['email_members_group_title'];
$member_to_from=escape_string($_POST['id']);

$content=$lang['email_members_group_content'];
$time=time();
mysql_query("INSERT INTO {$db_prefix}messages (topic_id, member_from, member_to, title, content, sent_time, last_post_time, hidden_from) VALUES ('$topic_id', '$my_id', '$member_to_from', '$title', '$content' ,'$time', '0', '1')");
mysql_query("UPDATE `{$db_prefix}members` SET `new_pms` = `new_pms` + 1 WHERE `id` = '{$member_to_from}'");
}

// update custom profile fields...

// custom field update

$query4321 = "select ID from {$db_prefix}custom_fields ORDER BY ID desc";
$result4321 = mysql_query($query4321) or die("custom.php - Error in query: $query4321") ;
while ($results4321 = mysql_fetch_array($result4321)){
$field_id_field = $results4321['ID'];

$query432 = "select FIELD_ID from {$db_prefix}custom_members WHERE MEMBER_ID='$id' AND FIELD_ID='$field_id_field'";
$result432 = mysql_query($query432) or die("information.php - Error in query: $query432") ;

$number_of_fields=mysql_num_rows($result432);

$field_content_id="custom"."$field_id_field";

$field_content_field=escape_string($_POST[$field_content_id]);

if ($number_of_fields=='0' && $field_content_field!=''){
mysql_query("INSERT INTO {$db_prefix}custom_members (field_id, content, member_id) VALUES ('$field_id_field', '$field_content_field', '$id')");
}

elseif($number_of_fields!='0' && $field_content_field==''){

mysql_query("DELETE FROM {$db_prefix}custom_members WHERE MEMBER_ID='$id' AND FIELD_ID='$field_id_field'");

}

elseif($number_of_fields!='0' && $field_content_field!=''){

while ($results432 = mysql_fetch_array($result432)){
$field_id = $results432['FIELD_ID'];


mysql_query("UPDATE {$db_prefix}custom_members SET content='$field_content_field' WHERE MEMBER_ID='$id' AND FIELD_ID='$field_id_field'");

}

}
}

	template_hook("pages/admin/members.template.php", "form_3");

	lb_redirect("index.php?page=admin&act=members&success=updated","admin/members/success/updated");

}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}

elseif ($_GET['func']=='edit'){


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

if (isset($_GET['idemail'])){
$id = escape_string($_GET['idemail']);
}
elseif(isset($_GET['id'])){
$id = escape_string($_GET['id']);
}
elseif (isset($_GET['inputname'])){
$id = escape_string($_GET['inputname']);
};

// check they exist, if not return an error...
$query2167 = "select NAME from {$db_prefix}members WHERE ID='$id' OR NAME='$id'" ;
$result2167 = mysql_query($query2167) or die("messages.php - Error in query: $query2167") ;                                  
$members_result = mysql_num_rows($result2167);

if ($members_result!='1'){

	lb_redirect("index.php?page=error&error=31","error/31");

}

$token_name = "token_members_$id$token_id";

$_SESSION[$token_name] = $token;

$query2 = "select ID, NAME, EMAIL, ROLE, PASSWORD, AVATAR, SIGNATURE, USERTITLE, LOCATION, NATIONALITY, MSN, AOL, YAHOO, SKYPE, XBOX, WII, PS3, BANNED, VERIFIED, MODERATE, NEVER_SPAM from {$db_prefix}members WHERE ID='$id' OR NAME='$id'" ;
$result2 = mysql_query($query2) or die("members.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$id = $results2['ID'];
$name = strip_slashes($results2['NAME']);
$email = strip_slashes($results2['EMAIL']);
$their_role = $results2['ROLE'];
$password = $results2['PASSWORD'];
$avatar = strip_slashes($results2['AVATAR']);
$signature = strip_slashes($results2['SIGNATURE']);
$location = strip_slashes($results2['LOCATION']);
$nationality = strip_slashes($results2['NATIONALITY']);
$msn = strip_slashes($results2['MSN']);
$aol = strip_slashes($results2['AOL']);
$yahoo = strip_slashes($results2['YAHOO']);
$skype = strip_slashes($results2['SKYPE']);
$xbox = strip_slashes($results2['XBOX']);
$wii = strip_slashes($results2['WII']);
$ps3 = strip_slashes($results2['PS3']);
$usertitle = strip_slashes($results2['USERTITLE']);
$banned = $results2['BANNED'];
$verify_member = $results2['VERIFIED'];
$moderate = $results2['MODERATE'];
$never_spam = $results2['NEVER_SPAM'];

template_hook("pages/admin/members.template.php", "3");

$query3 = "select GROUP_ID, GROUP_NAME from {$db_prefix}groups WHERE GROUP_ID!='4' ORDER BY GROUP_NAME" ;
$result3 = mysql_query($query3) or die("members.php - Error in query: $query3") ;                                  
while ($results3 = mysql_fetch_array($result3)){
$group_id = $results3['GROUP_ID'];
$group_name = strip_slashes($results3['GROUP_NAME']);

// Don't allow mods to demote admins or upgrade themselves to admin!

template_hook("pages/admin/members.template.php", "4");

}

template_hook("pages/admin/members.template.php", "5");

$query21 = "select NATION_NAME, NATION_SHORT from {$db_prefix}nations ORDER BY NATION_NAME asc" ;
$result21 = mysql_query($query21) or die("members.php - Error in query: $query21") ;                                  
while ($results21 = mysql_fetch_array($result21)){
$nationname = $results21['NATION_NAME'];
$nationshort = $results21['NATION_SHORT'];

template_hook("pages/admin/members.template.php", "6");

}

template_hook("pages/admin/members.template.php", "7");

$query432 = "select ID, NAME, DESCRIPTION, ORDER_FIELD from {$db_prefix}custom_fields ORDER BY ID desc";
$result432 = mysql_query($query432) or die("custom.php - Error in query: $query432") ;
while ($results432 = mysql_fetch_array($result432)){
$field_id = $results432['ID'];
$field_name = strip_slashes($results432['NAME']);
$field_description = strip_slashes($results432['DESCRIPTION']);
$order_field = $results432['ORDER_FIELD'];

$query433 = "select CONTENT from {$db_prefix}custom_members WHERE MEMBER_ID='$id' AND FIELD_ID='$field_id'";
$result433 = mysql_query($query433) or die("custom.php - Error in query: $query433") ;
$field_content = strip_slashes(mysql_result($result433, 0));

template_hook("pages/admin/members.template.php", "8");

}

template_hook("pages/admin/members.template.php", "9");


}


}
else{

template_hook("pages/admin/members.template.php", "10");

}
}

template_hook("pages/admin/members.template.php", "end");
?>