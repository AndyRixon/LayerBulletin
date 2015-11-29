<?php
/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By LayerBulletin Team
|   (c) 2014 LayerBulletin Team
|   http://layerbulletin.com/
|   ========================================
|   messages.php - shows private messages page
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

// TAG EDIT
$format_time = '%A, %b %d, %Y %r';

template_hook("pages/messages.template.php", "start");

// Show success messages
switch ($_GET['success']) {
	case 'deleted':
		template_hook("pages/messages.template.php", "deletedSuccess");
		break;

	case 'sent':
		template_hook("pages/messages.template.php", "sentSuccess");
		break;		
}

	// PERMISSIONS!! Can they PM?
		if ($can_pm=='0'){
		
	lb_redirect("index.php?page=error&error=12","error/12");
		
		}

if ($_GET['act']=='del'){

// First, make sure that they are the original author...

$id=$_GET['id'];
$id=escape_string($id);

$query211 = "select TOPIC_ID from {$db_prefix}messages WHERE MEMBER_FROM='$my_id' AND TITLE!='' AND TOPIC_ID='$id'" ;
$result211 = mysql_query($query211) or die("messages.php - Error in query: $query211") ;                                  
$original_author=mysql_num_rows($result211);


$query211 = "select TOPIC_ID from {$db_prefix}messages WHERE MEMBER_TO='$my_id' AND TITLE!='' AND TOPIC_ID='$id'" ;
$result211 = mysql_query($query211) or die("messages.php - Error in query: $query211") ;                                  
$original_recipient=mysql_num_rows($result211);

if ($original_author!='0'){

$id=$_GET['id'];
$id=escape_string($id);

	$query22 = "SELECT TOPIC_ID from {$db_prefix}messages WHERE MEMBER_TO=MEMBER_FROM AND TOPIC_ID='$id' AND TITLE!=''";
	$result22 = mysql_query($query22) or die("messages.php - Error in query: $query22");
	if(mysql_num_rows($result22)!='0') {
		mysql_query("UPDATE {$db_prefix}messages SET hidden_from='1' WHERE topic_id='$id' AND TITLE!=''");
		mysql_query("UPDATE {$db_prefix}messages SET hidden='1' WHERE topic_id='$id' AND TITLE!=''");

		// Remove them from the unread messages count if not read yet
		$query22 = "SELECT TOPIC_ID from {$db_prefix}messages WHERE MEMBER_TO='$my_id' AND READ_TIME='0' AND HIDDEN!='1' AND TITLE!=''";
		$result22 = mysql_query($query22) or die("messages.php - Error in query: $query22");
		$messages_number = mysql_num_rows($result22);
		mysql_query("UPDATE {$db_prefix}members SET new_pms='$messages_number' WHERE ID='$my_id'");
	}else{
		mysql_query("UPDATE {$db_prefix}messages SET hidden_from='1' WHERE topic_id='$id' AND TITLE!=''");
	}

	template_hook("pages/messages.template.php", "form_1");

	lb_redirect("index.php?page=messages&act=inbox&success=deleted","messages/success/deleted");

}
elseif ($original_recipient!='0'){
// We mask them instead...

$id=$_GET['id'];
$id=escape_string($id);

mysql_query("UPDATE {$db_prefix}messages SET hidden='1' WHERE topic_id='$id' AND TITLE!=''");

	// Remove them from the unread messages count if not read yet
	$query22 = "SELECT TOPIC_ID from {$db_prefix}messages WHERE MEMBER_TO='$my_id' AND READ_TIME='0' AND HIDDEN!='1' AND TITLE!=''";
	$result22 = mysql_query($query22) or die("messages.php - Error in query: $query22");
	$messages_number = mysql_num_rows($result22);
	mysql_query("UPDATE {$db_prefix}members SET new_pms='$messages_number' WHERE ID='$my_id'");

	template_hook("pages/messages.template.php", "form_2");

	lb_redirect("index.php?page=messages&act=inbox&success=deleted","messages/success/deleted");

}

else{
	lb_redirect("index.php?page=error&error=13","error/13");
}
}


elseif ($_GET['act']=='inbox'){

$count_message_alt="";

// We'll show messages like a forum :)

template_hook("pages/messages.template.php", "3");

// todays messages...
// Get today's date at midnight...

$server_time=mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
$user_time=mktime((date("H")+$offset),date("i"),date("s"),date("m"),date("d"),date("Y"));
if(floor(($user_time-$server_time)/86400) >= '1'){
$todays_date  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
}
elseif(floor(($user_time-$server_time)/86400) < '0'){
$todays_date  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
}
else{
$todays_date = date("F j, Y" );
}
$today_message=strtotime($todays_date);
$today_message=$today_message + $time_offset;

// Yesterday...
$yesterday_message=$today_message -86400;

// Last week
$week_message=$today_message -604800;

$number_today="0";
$number_yesterday="0";
$number_this_week="0";
$number_older="0";

$query211 = "select TOPIC_ID, ID, MEMBER_FROM, MEMBER_TO, SENT_TIME, LAST_POST_TIME from {$db_prefix}messages WHERE MEMBER_TO='$my_id' AND HIDDEN='0' AND TITLE!='' OR MEMBER_FROM='$my_id' AND HIDDEN_FROM='0' AND TITLE!='' GROUP BY TOPIC_ID ORDER BY LAST_POST_TIME desc, SENT_TIME desc, TOPIC_ID desc";
$result211 = mysql_query($query211) or die("messages.php - Error in query: $query211");

while ($results211 = mysql_fetch_array($result211)){
$id = $results211['ID'];
$topic_id = $results211['TOPIC_ID'];
$member_from = $results211['MEMBER_FROM'];
$member_to = $results211['MEMBER_TO'];
$sent_time = $results211['SENT_TIME'];
$last_post_time = $results211['LAST_POST_TIME'];

	$count_message_alt=$count_message_alt+1;

	$check_odd = checkNum($count_message_alt);

	if ($check_odd===TRUE){
		$alt_td_class="";
	}
	else{
		$alt_td_class="-alt";	
	}

if ($last_post_time > $today_message && $number_today=='0'){
template_hook("pages/messages.template.php", "19");
$number_today++;
}

if ($last_post_time < $today_message && $last_post_time > $yesterday_message && $number_yesterday=='0'){
template_hook("pages/messages.template.php", "20");
$number_yesterday++;
}

if ($last_post_time > $week_message && $last_post_time < $yesterday_message && $number_this_week=='0'){
template_hook("pages/messages.template.php", "21");
$number_this_week++;
}

if ($last_post_time < $week_message && $number_older=='0'){
template_hook("pages/messages.template.php", "22");
$number_older++;
}

$query212 = "select TITLE from {$db_prefix}messages WHERE TOPIC_ID='$topic_id' AND TITLE!=''" ;
$result212 = mysql_query($query212) or die("messages.php - Error in query: $query212") ;                               
$title = mysql_result($result212, 0);

$title=strip_slashes($title);
$content=strip_slashes($content);

$time = format_date($time); 

// Get last ID where it equals $my_id and see
// if this message has been read by $my_id...

// Set default read time...
$my_read_time="1";

$query21 = "select READ_TIME from {$db_prefix}messages WHERE TOPIC_ID='$topic_id' AND MEMBER_TO='$my_id' ORDER BY ID desc LIMIT 1" ;
$result21 = mysql_query($query21) or die("messages.php - Error in query: $query21"); 
$read_num = mysql_num_rows($result21);

if ($read_num!='0'){                                 
$my_read_time = mysql_result($result21, 0);
}

$query210 = "select HIDDEN from {$db_prefix}messages WHERE TOPIC_ID='$topic_id' AND MEMBER_TO='$my_id' AND TITLE!=''" ;
$result210 = mysql_query($query210) or die("messages.php - Error in query: $query210") ;                                  
$hidden_message = mysql_result($result210, 0);

$query2 = "select HIDDEN_FROM from {$db_prefix}messages WHERE TOPIC_ID='$topic_id' AND MEMBER_FROM='$my_id' AND TITLE!=''" ;
$result2 = mysql_query($query2) or die("messages.php - Error in query: $query2") ;                                  
$hidden_message_from = mysql_result($result2, 0);

$query2111 = "select NAME, ROLE from {$db_prefix}members WHERE ID='$member_from'" ;
$result2111 = mysql_query($query2111) or die("messages.php - Error in query: $query2111") ;                                   
while ($results2111 = mysql_fetch_array($result2111)){
$name = $results2111['NAME'];
$role_from = $results2111['ROLE'];
}

$query8 = "select ID from {$db_prefix}messages WHERE TOPIC_ID='$topic_id' AND TITLE=''" ;
$result8 = mysql_query($query8) or die("messages.php - Error in query: $query8") ;                                  
$replies=number_format(mysql_num_rows($result8));

$query998 = "select ID, SENT_TIME from {$db_prefix}messages WHERE TOPIC_ID='$topic_id' ORDER  BY ID desc LIMIT 1" ;
$result998 = mysql_query($query998) or die("messages.php - Error in query: $query998") ;                                  
while ($results998 = mysql_fetch_array($result998)){
$last_post = $results998['ID'];
$last_sent_time = $results998['SENT_TIME'];

$last_sent_time = format_date($last_sent_time); 

}

$query2 = "select MEMBER_FROM from {$db_prefix}messages WHERE TOPIC_ID='$topic_id' ORDER  BY SENT_TIME desc LIMIT 1" ;
$result2 = mysql_query($query2) or die("messages.php - Error in query: $query2") ;                                  
$last_poster_id = mysql_result($result2, 0);

$last_poster = '';

$query2185 = "select NAME, ROLE from {$db_prefix}members WHERE ID='$last_poster_id'" ;
$result2185 = mysql_query($query2185) or die("messages.php - Error in query: $query2185") ;                                   
while ($results2185 = mysql_fetch_array($result2185)){
$last_poster = $results2185['NAME'];
$last_role = $results2185['ROLE'];
}

$query2185 = "select NAME, ROLE from {$db_prefix}members WHERE ID='$member_to'" ;
$result2185 = mysql_query($query2185) or die("messages.php - Error in query: $query2185") ;                                   
while ($results2185 = mysql_fetch_array($result2185)){
$name_to = $results2185['NAME'];
$role_to = $results2185['ROLE'];
}


if ($hidden_message=='0' && $my_id==$member_to){
template_hook("pages/messages.template.php", "4");                            
}

elseif ($hidden_message_from=='0' && $my_id==$member_from){
template_hook("pages/messages.template.php", "4");                             
}

}


template_hook("pages/messages.template.php", "5"); 

}
elseif($_GET['act']=='new'){

if ($_POST['content']!='' && $_POST['member_to']!='' && $_POST['member_to']!='0'){

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);

$token_name = "token_messages_$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

// do a check and make sure the username exists, if not, return to error page

$member_to=$_POST['member_to'];
$member_to=escape_string($member_to);

$query2167		= 'SELECT name, email, subscribe_pm, board_lang FROM ' . $db_prefix . 'members WHERE id = ' . $member_to;
$result2167		= mysql_query($query2167) or die("messages.php - Error in query: $query2167");
$row			= mysql_fetch_assoc($result2167);
$members_result	= mysql_num_rows($result2167);

	$is_subscribed 		= $row['subscribe_pm'];
	$subscriber_name	= $row['name'];
	$subscriber_email	= $row['email'];
	$recipient_lang		= $row['board_lang'];

if ($members_result != 1)
{
	lb_redirect("index.php?page=error&error=31","error/31");
}

// okay, so they exist, but are you sending a PM to yourself???

if ($member_to == $my_id)
{
	lb_redirect("index.php?page=error","error");
}

$query2167 = "select TOPIC_ID from {$db_prefix}messages ORDER BY TOPIC_ID desc LIMIT 1" ;
$result2167 = mysql_query($query2167) or die("messages.php - Error in query: $query2167") ;                                  
$topic_id = mysql_result($result2167, 0);

$topic_id=$topic_id+1;

$time=time();

$subject=$_POST['subject'];
$subject=escape_string($subject);
$content=$_POST['content'];
$content=escape_string($content);
if ($subject==''){
	$subject="(No Subject)";
}

mysql_query("INSERT INTO {$db_prefix}messages (topic_id, member_from, member_to, title, content, sent_time, last_post_time) VALUES ('$topic_id', '$my_id', '$member_to', '$subject', '$content', '$time', '$time')");

mysql_query("UPDATE {$db_prefix}members SET new_pms=new_pms+1 WHERE ID='$member_to'");

// send email to recipient...

if ($is_subscribed == 1)
{
	$query1 = "select NAME from {$db_prefix}members WHERE ID='$my_id'" ;
	$result1 = mysql_query($query1) or die("subscriptions.php - Error in query: $query1") ; 
	$subscriber_from = mysql_result($result1, 0);

	// Prepare message...

	$from = strip_slashes($subscriber_from);
	
	/*
	Load the recipients language
*/

	# First save this lang
	$oldLang = $lang;
	
	# Now load
	include $lb_root . '/lang/' . $recipient_lang . '/lang_forum.php';

	$lang['email_pm_content']	= str_replace("<%subscriber>", $subscriber_name, $lang['email_pm_content']);
	$lang['email_pm_content']	= str_replace("<%site>", $lb_domain, $lang['email_pm_content']);
	$lang['email_pm_content']	= str_replace("<%sitename>", $site_name, $lang['email_pm_content']);
	$lang['email_pm_title']		= str_replace("<%from>", $from, $lang['email_pm_title']);
	$from						= "From: $site_name <$board_email>\r\n";

	mail($subscriber_email, $lang['email_pm_title'], $lang['email_pm_content'], $from);
	
	# Revert back to the other lang
	$lang = $oldLang;
	unset($oldLang);
}

	template_hook("pages/messages.template.php", "form_3");

	lb_redirect("index.php?page=messages&act=inbox&success=sent","messages/success/sent");

}
else{
	lb_redirect("index.php?page=error&error=28","error/28");
}
}
else{


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_messages_$token_id";

$_SESSION[$token_name] = $token;

if (isset($_GET['id'])){
$prepared_id=escape_string($_GET['id']);

$queryname = "select NAME from {$db_prefix}members WHERE ID ='$prepared_id'" ;
$resultname = mysql_query($queryname) or die("members.php - Error in query: $queryname") ;                                  
$prepared_name = mysql_result($resultname, 0);

}

template_hook("pages/messages.template.php", "7");

}
}
elseif($_GET['act']=='reply'){

$topic=$_POST['topic'];
$topic=escape_string($topic);

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);

$token_name = "token_messages_$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

// Who was this to anyway?

$query211 = "select MEMBER_FROM, MEMBER_TO from {$db_prefix}messages WHERE MEMBER_TO!=MEMBER_FROM AND TOPIC_ID='$topic' ORDER BY ID desc LIMIT 1" ;
$result211 = mysql_query($query211) or die("messages.php - Error in query: $query211") ;                                  
while ($results211 = mysql_fetch_array($result211)){
$member_to = $results211['MEMBER_TO'];
$member_from = $results211['MEMBER_FROM'];
}

if ($member_from==$my_id){
$member_to=$member_to;
}
else{
$member_to=$member_from;
}

// Insert reply
$time=time();

$topic=$_POST['topic'];
$topic=escape_string($topic);

$content=$_POST['content'];
$content=escape_string($content);

mysql_query("INSERT INTO {$db_prefix}messages (topic_id, member_to, member_from, content, sent_time) VALUES ('$topic', '$member_to', '$my_id', '$content', '$time')");

mysql_query("UPDATE {$db_prefix}members SET new_pms=new_pms+1 WHERE ID='$member_to'");

// Update messages to say when last reply was

$time=time();

$topic=$_POST['topic'];
$topic=escape_string($topic);

mysql_query("UPDATE {$db_prefix}messages SET last_post_time='$time', hidden='0', hidden_from='0' WHERE topic_id='$topic' AND TITLE!=''");


$topic=$_POST['topic'];
$topic=escape_string($topic);

// send email to recipient...

$query1 = "select SUBSCRIBE_PM from {$db_prefix}members WHERE ID='$member_to'" ;
$result1 = mysql_query($query1) or die("subscriptions.php - Error in query: $query1") ; 
$is_subscribed = mysql_result($result1, 0);

if ($is_subscribed == 1)
{
	$query1		= 'SELECT name, email, board_lang FROM ' . $db_prefix . 'members WHERE id = ' . $member_to;
	$result1	= mysql_query($query1) or die("subscriptions.php - Error in query: $query1");
	$row		= mysql_fetch_assoc($result1);

		$subscriber_name 	= $row['name'];
		$subscriber_email	= $row['email'];
		$subscriber_lang	= $row['board_lang'];
		
	# First save this language
	$oldLang = $lang;

	# Now load
	include $lb_root . '/lang/' . $subscriber_lang . '/lang_forum.php';

	// Prepare message...

		$from = strip_slashes($lb_name);
		
		$lang['email_pm_content']	= str_replace("<%subscriber>", $subscriber_name, $lang['email_pm_content']);
		$lang['email_pm_content']	= str_replace("<%site>", $lb_domain, $lang['email_pm_content']);
		$lang['email_pm_content']	= str_replace("<%sitename>", $site_name, $lang['email_pm_content']);
		$lang['email_pm_title']		= str_replace("<%from>", $from, $lang['email_pm_title']);
		
		$message		= $lang['email_pm_content'];
		$outgoing		= $subscriber_email;
		$from			= "From: $site_name <$board_email>\r\n";
		$subject		= $lang['email_pm_title'];
		
		mail($outgoing, $subject, $message, $from);
	
	# And change back...
	$lang = $oldLang;
}

	template_hook("pages/messages.template.php", "form_4");

	lb_redirect("index.php?page=messages&id=$topic#last","messages/$topic#last");

}
else{
	lb_redirect("index.php?page=error&error=28","error/28");
}
}
else{



$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_messages_$token_id";

$_SESSION[$token_name] = $token;

// Tell database that the last message to this person
// has been read (easier said than done!)

$read_time=time();

$id=$_GET['id'];
$id=escape_string($id);

mysql_query("UPDATE {$db_prefix}messages SET read_time='$read_time' WHERE topic_id = '$id' AND MEMBER_TO='$my_id'");

$query22 = "select TOPIC_ID from {$db_prefix}messages WHERE MEMBER_TO ='$my_id' AND READ_TIME='0' AND HIDDEN!='1' AND TITLE!=''" ;
$result22 = mysql_query($query22) or die("header.php - Error in query: $query22");
$messages_number=mysql_num_rows($result22);

mysql_query("UPDATE {$db_prefix}members SET new_pms='$messages_number' WHERE ID='$my_id'");

$id=$_GET['id'];
$id=escape_string($id);

$query211 = "select TITLE from {$db_prefix}messages WHERE TOPIC_ID='$id' AND TITLE!=''" ;
$result211 = mysql_query($query211) or die("messages.php - Error in query: $query211") ;                                  
$title = mysql_result($result211, 0);

$title=strip_slashes($title);

template_hook("pages/messages.template.php", "11");

$query211 = "select ID, MEMBER_FROM, MEMBER_TO, CONTENT, SENT_TIME from {$db_prefix}messages WHERE TOPIC_ID='$id'  AND member_from='$my_id' OR TOPIC_ID='$id' AND member_to='$my_id' ORDER BY ID asc" ;
$result211 = mysql_query($query211) or die("messages.php - Error in query: $query211") ; 
$check_can_view=mysql_num_rows($result211);

if ($check_can_view=='0'){

	lb_redirect("index.php?page=error&error=14","error/14");

}
else{                                 
/* TAG EDIT */
$TAG_max_message = mysql_num_rows($result211) - 1;
$TAG_message_number = 0;

while ($results211 = mysql_fetch_array($result211)){
$id = $results211['ID'];
$post_id = $results211['ID'];
$member_from = $results211['MEMBER_FROM'];
$member_to = $results211['MEMBER_TO'];
$content = $results211['CONTENT'];
$sent_time = $results211['SENT_TIME'];

//TAG EDIT
$TAG_message_number ++;

$time = format_date($sent_time);

$content=strip_slashes($content);

$name		= '';
$cv_rank	= 0;

$query2 = "select ID, NAME, USER_POSTS, LOCATION, AVATAR, REMOTE_AVATAR, SIGNATURE, NATIONALITY, ROLE, USERTITLE, WARN_LEVEL, REGISTER_DATE from {$db_prefix}members WHERE ID='$member_from'" ;
$result2 = mysql_query($query2) or die("topic.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$id = $results2['ID'];
$name = $results2['NAME'];
$location = strip_slashes($results2['LOCATION']);
$avatar = $results2['AVATAR'];

$remote_avatar = $results2['REMOTE_AVATAR'];

	if ($remote_avatar =='0'){
		$avatar = $lb_domain."/".$avatar;
	}

$signature = $results2['SIGNATURE'];
$nationality = $results2['NATIONALITY'];
$usertitle = $results2['USERTITLE'];
$warn_level = $results2['WARN_LEVEL'];
$register_date = $results2['REGISTER_DATE'];
$member_role = $results2['ROLE'];
$user_posts = $results2['USER_POSTS'];

$num_post=number_format($user_posts);

$register_date=format_date($register_date, '%d %B %Y');

$usertitle=strip_slashes($usertitle);
$signature=strip_slashes($signature);
}

$query54 = "select CAN_CHANGE_SITE_SETTINGS, CAN_CHANGE_FORUM_SETTINGS, GROUP_ICON, GROUP_NAME, GROUP_COLOR from {$db_prefix}groups WHERE GROUP_ID='$member_role'" ;
$result54 = mysql_query($query54) or die("topic.php - Error in query: $query54") ;                                  
while ($results54 = mysql_fetch_array($result54)){
$user_can_change_site_settings = $results54['CAN_CHANGE_SITE_SETTINGS'];
$user_can_change_forum_settings = $results54['CAN_CHANGE_FORUM_SETTINGS'];
$user_group_icon = $results54['GROUP_ICON'];
$user_group_name = strip_slashes($results54['GROUP_NAME']);
$user_group_color = strip_slashes($results54['GROUP_COLOR']);
}

// show group icon
if ($user_group_icon != 0 && $user_group_icon <= 10)
{
	$group_img = ${'groups_' . $user_group_icon . '_img'};
}

// Show online/offline icon

$query21 = "select ID from {$db_prefix}sessions WHERE ID='$id'" ;
$result21 = mysql_query($query21) or die("topic.php - Error in query: $query21") ;                                  
$member_online=mysql_num_rows($result21);

template_hook("pages/messages.template.php", "12");

// Get avatar...
if ($avatar==''){
$avatar = $default_avatar;
}
else{

$ext = strtolower(strrchr($avatar,"."));

}

// Show graphic...
$graphic_level=floor($warn_level/$max_warn*5);
$graphic_warn = $graphic_level*10;

// get title and pips...
$query_rank = "select RANK_TITLE, RANK_PIPS from {$db_prefix}ranks WHERE RANK_POSTS <= '$user_posts' ORDER BY RANK_POSTS desc LIMIT 1" ;
$result_rank = mysql_query($query_rank) or die("topic.php - Error in query: $query_rank") ;                                  
while ($results_rank = mysql_fetch_array($result_rank)){
$rank_title = strip_slashes($results_rank['RANK_TITLE']);
$rank_pips = $results_rank['RANK_PIPS'];
}

if ($usertitle==''){
$usertitle = "$rank_title";
}

template_hook("pages/messages.template.php", "13");

$start_pip = "0";
while ($start_pip < $rank_pips){

template_hook("pages/messages.template.php", "36");

$start_pip = $start_pip + 1;
}

template_hook("pages/messages.template.php", "37");

// BB Parse...
if (file_exists("themes/$theme/scripts/php/parse.php")){
	include "themes/$theme/scripts/php/parse.php";
}
else{
	include "scripts/php/parse.php";				
}

template_hook("pages/messages.template.php", "15"); 

// Now.. what about that sig huh?...
if ($signature!=''){

$content=$signature;

// BB Parse...
if (file_exists("themes/$theme/scripts/php/parse.php")){
	include "themes/$theme/scripts/php/parse.php";
}
else{
	include "scripts/php/parse.php";				
}

template_hook("pages/messages.template.php", "16");

}

$query2167 = "select ROLE from {$db_prefix}members WHERE ID='$id'" ;
$result2167 = mysql_query($query2167) or die("topic.php - Error in query: $query2167") ;                                  
$users_role = mysql_result($result2167, 0);

	// PERMISSIONS! Can the recipient PM???!!!

		$query2168 = "select CAN_PM from {$db_prefix}groups WHERE GROUP_ID='$users_role'" ;
		$result2168 = mysql_query($query2168) or die("topic.php - Error in query: $query2168") ;                                  
		$can_pm_this_member = mysql_result($result2168, 0);

template_hook("pages/messages.template.php", "17");

}

}

$id=$_GET['id'];
$id=escape_string($id);

template_hook("pages/messages.template.php", "18");

}

template_hook("pages/messages.template.php", "end");
?>
