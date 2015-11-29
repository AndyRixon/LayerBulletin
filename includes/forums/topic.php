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
|   topic.php - display a topic
*/
if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("forums/topic.template.php", "start");

?>

		<script type="text/javascript">
			var addquotebutton     = "submit-button img-quote-on";
			var removequotebutton  = "submit-button button-remove img-quote-off";
		</script>

<?php

global $role;

$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$topic=$_GET['topic'];
$topic=escape_string($topic);

$token_name = "token_quickreply_$topic$token_id";

$_SESSION[$token_name] = $token;

$limit=$_GET['limit'];
$limit=escape_string($limit);

// if the first post is being moderated, redirect to
// an error page to explain...

if ($can_moderate_members=='0'){
$query2167 = "select APPROVED from {$db_prefix}posts WHERE TOPIC_ID='$topic' AND TITLE!=''" ;
$result2167 = mysql_query($query2167) or die("topic.php - Error in query: $query2167") ; 
$approved = mysql_result($result2167, 0);

if ($approved == '0'){
	lb_redirect("index.php?page=error&error=35","error/35");
}  
}

$query2167 = "select FORUM_ID, TITLE, LOCKED, STICKY, ANNOUNCE, original_topic_id from {$db_prefix}posts WHERE TOPIC_ID='$topic' AND TITLE!=''" ;

$result2167 = mysql_query($query2167) or die("topic.php - Error in query: $query2167") ; 
$does_exist = mysql_num_rows($result2167);

if ($does_exist == '0'){
	lb_redirect("index.php?page=error&error=24","error/24");
}                                 
while ($results2167 = mysql_fetch_array($result2167)){
$forum_id = $results2167['FORUM_ID'];
$title = $results2167['TITLE'];
$locked = $results2167['LOCKED'];
$sticky = $results2167['STICKY'];
$announce = $results2167['ANNOUNCE'];
$topic_original_topic_id = $results2167['original_topic_id'];
}

# Trashcan forum?
$is_trashcan = ($trashcan_enabled && $forum_id == $trashcan_forum) ? true : false;

		// PERMISSIONS!!! Can they view this forum???

		$can_view_forum="0";
		$can_read_topics="0";
		$can_add_topics="0";
		$can_reply_topics="0";
		$can_download_attachment="0";

		$query3 = "select CAN_VIEW_FORUM, CAN_READ_TOPICS, CAN_ADD_TOPICS, CAN_REPLY_TOPICS, CAN_DOWNLOAD_ATTACHMENT from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;
		$result3 = mysql_query($query3) or die("topic.php - Error in query: $query3") ;                                  
		while ($results3 = mysql_fetch_array($result3)){
		$can_view_forum = $results3['CAN_VIEW_FORUM'];
		$can_read_topics = $results3['CAN_READ_TOPICS'];
		$can_add_topics = $results3['CAN_ADD_TOPICS'];
		$can_reply_topics = $results3['CAN_REPLY_TOPICS'];
		$can_download_attachment = $results3['CAN_DOWNLOAD_ATTACHMENT'];
		}

$query211 = "select READ_ONLY from {$db_prefix}categories WHERE ID='$forum_id'" ;
$result211 = mysql_query($query211) or die("board.php - Error in query: $query211") ;                                  
$read_only = mysql_result($result211, 0);

if ($can_view_forum=='0'){
	lb_redirect("index.php?page=error&error=2","error/2");
}
elseif($can_read_topics=='0'){
	lb_redirect("index.php?page=error&error=3","error/3");
}
else{

template_hook("forums/topic.template.php", "1");

global $role;

// Update views...
$topic=$_GET['topic'];
$topic=escape_string($topic);
mysql_query("UPDATE {$db_prefix}posts SET views=views+1 WHERE topic_id = '$topic' AND TITLE!=''");

// Insert posts_read

$read_time=time()+1;

if ($my_id >'0'){

mysql_query("DELETE FROM {$db_prefix}posts_read WHERE member_id='$my_id' AND topic_id='$topic'");

mysql_query("INSERT INTO {$db_prefix}posts_read (member_id, topic_id, read_time) VALUES ('$my_id', '$topic', '$read_time')");

}

// Get page numbers...



$query = "select ID from {$db_prefix}posts WHERE TOPIC_ID='$topic'" ;
$result = mysql_query($query) or die("topic.php - Error in query: $query") ;                                  
$number_of_posts=mysql_num_rows($result);

$limit = (!$_GET['limit'] || $_GET['limit'] < 0  || !is_numeric($_GET['limit'])) ? 0 : escape_string($_GET['limit']) - 1;
$limit = ($limit * $list_posts);


$pages=ceil($number_of_posts/$list_posts);
$pages_end = $pages;

if ($pages <= '1'){
}
else{

$topic_title = topic_title($topic);

template_hook("forums/topic.template.php", "2");

}

$query211 = "select TITLE from {$db_prefix}posts WHERE TOPIC_ID='$topic' AND TITLE!=''" ;
$result211 = mysql_query($query211) or die("topic.php - Error in query: $query211") ;                                  
$title = mysql_result($result211, 0);

$title=strip_slashes($title);

$query_subscribe = "select ROW from {$db_prefix}subscribe WHERE ID='$my_id' AND SUBSCRIBED_TOPIC='$topic'" ;
$result_subscribe = mysql_query($query_subscribe) or die("topic.php - Error in query: $query_subscribe") ;                                  
$subscribed_already=mysql_num_rows($result_subscribe);

template_hook("forums/topic.template.php", "5");

// Does it have a poll?

$query5 = "select TOPIC_ID from {$db_prefix}polls WHERE TOPIC_ID='$topic'" ;
$result5 = mysql_query($query5) or die("topic.php - Error in query: $query5") ;
$has_poll = mysql_num_rows($result5);                                  

if($has_poll=='1'){

$query6 = "select ID, QUESTION, OPTION1, OPTION2, OPTION3, OPTION4, OPTION5, OPTION6, OPTION7, OPTION8, OPTION9, OPTION10, POLL_TYPE from {$db_prefix}polls WHERE TOPIC_ID='$topic'" ;
$result6 = mysql_query($query6) or die("topic.php - Error in query: $query6") ;                                  
while ($results6 = mysql_fetch_array($result6)){
$poll_id = $results6['ID'];
$question = $results6['QUESTION'];
$option1 = $results6['OPTION1'];
$option2 = $results6['OPTION2'];
$option3 = $results6['OPTION3'];
$option4 = $results6['OPTION4'];
$option5 = $results6['OPTION5'];
$option6 = $results6['OPTION6'];
$option7 = $results6['OPTION7'];
$option8 = $results6['OPTION8'];
$option9 = $results6['OPTION9'];
$option10 = $results6['OPTION10'];
$poll_type = $results6['POLL_TYPE'];
}

$question=strip_slashes($question);
$option1=strip_slashes($option1);
$option2=strip_slashes($option2);
$option3=strip_slashes($option3);
$option4=strip_slashes($option4);
$option5=strip_slashes($option5);
$option6=strip_slashes($option6);
$option7=strip_slashes($option7);
$option8=strip_slashes($option8);
$option9=strip_slashes($option9);
$option10=strip_slashes($option10);

if ($poll_type=='1'){
$input = "checkbox";
}
else{
$input = "radio";
}

// Total Votes

$query69 = "select VOTE_ID from {$db_prefix}polls_votes WHERE POLL_ID='$poll_id'" ;
$result69 = mysql_query($query69) or die("topic.php - Error in query: $query69") ;                                  
$total_votes=mysql_num_rows($result69);

$query69 = "select VOTE_ID from {$db_prefix}polls_votes WHERE POLL_ID='$poll_id' GROUP BY USER_ID" ;
$result69 = mysql_query($query69) or die("topic.php - Error in query: $query69") ;                                  
$total_votes_results=mysql_num_rows($result69);

// If they have voted already, or if they are logged out,
// show results instead of options...

$name=$_COOKIE['lb_name'];
$name=escape_string($name);
$password=$_COOKIE['lb_password'];
$password=escape_string($password);

$query7 = "select ID from {$db_prefix}members WHERE NAME='$name' AND PASSWORD='$password'" ;
$result7 = mysql_query($query7) or die("topic.php - Error in query: $query7") ;                                  
$member_id = mysql_result($result7, 0);

$query8 = "select VOTE_ID from {$db_prefix}polls_votes WHERE USER_ID='$member_id' AND POLL_ID='$poll_id'" ;
$result8 = mysql_query($query8) or die("topic.php - Error in query: $query8") ;                                  
$voted=mysql_num_rows($result8);

// If the topic is locked, so must the poll be...
if ($locked=='1'){

$voted="1";
}

if ($can_reply_topics=='0'){
$voted_check="1";
$voted="1";
}
if ($_GET['showresults']!=''){
$voted="1";
$voted_check="0";
}

if ($voted=='0'){

$topic_title = topic_title($topic);

template_hook("forums/topic.template.php", "6");

}

else{

// Show results

template_hook("forums/topic.template.php", "7");

$query8 = "select VOTE_ID from {$db_prefix}polls_votes WHERE POLL_ID='$poll_id' AND VOTE='1'" ;
$result8 = mysql_query($query8) or die("topic.php - Error in query: $query8") ;                                  
$option_votes=mysql_num_rows($result8);
$percentage=number_format(($option_votes/$total_votes)*100);
$px="px";

$width=($percentage*5);

$show_option=$option1;

template_hook("forums/topic.template.php", "8");

$query8 = "select VOTE_ID from {$db_prefix}polls_votes WHERE POLL_ID='$poll_id' AND VOTE='2'" ;
$result8 = mysql_query($query8) or die("topic.php - Error in query: $query8") ;                                  
$option_votes=mysql_num_rows($result8);
$percentage=number_format(($option_votes/$total_votes)*100);
$px="px";

$width=($percentage*5);

$show_option=$option2;

template_hook("forums/topic.template.php", "8");

if ($option3!=''){

$query8 = "select VOTE_ID from {$db_prefix}polls_votes WHERE POLL_ID='$poll_id' AND VOTE='3'" ;
$result8 = mysql_query($query8) or die("topic.php - Error in query: $query8") ;                                  
$option_votes=mysql_num_rows($result8);
$percentage=number_format(($option_votes/$total_votes)*100);
$px="px";

$width=($percentage*5);

$show_option=$option3;

template_hook("forums/topic.template.php", "8");
}

if ($option4!=''){

$query8 = "select VOTE_ID from {$db_prefix}polls_votes WHERE POLL_ID='$poll_id' AND VOTE='4'" ;
$result8 = mysql_query($query8) or die("topic.php - Error in query: $query8") ;                                  
$option_votes=mysql_num_rows($result8);
$percentage=number_format(($option_votes/$total_votes)*100);
$px="px";

$width=($percentage*5);

$show_option=$option4;

template_hook("forums/topic.template.php", "8");
}

if ($option5!=''){

$query8 = "select VOTE_ID from {$db_prefix}polls_votes WHERE POLL_ID='$poll_id' AND VOTE='5'" ;
$result8 = mysql_query($query8) or die("topic.php - Error in query: $query8") ;                                  
$option_votes=mysql_num_rows($result8);
$percentage=number_format(($option_votes/$total_votes)*100);
$px="px";

$width=($percentage*5);

$show_option=$option5;

template_hook("forums/topic.template.php", "8");
}

if ($option6!=''){

$query8 = "select VOTE_ID from {$db_prefix}polls_votes WHERE POLL_ID='$poll_id' AND VOTE='6'" ;
$result8 = mysql_query($query8) or die("topic.php - Error in query: $query8") ;                                  
$option_votes=mysql_num_rows($result8);
$percentage=number_format(($option_votes/$total_votes)*100);
$px="px";

$width=($percentage*5);

$show_option=$option6;

template_hook("forums/topic.template.php", "8");
}

if ($option7!=''){

$query8 = "select VOTE_ID from {$db_prefix}polls_votes WHERE POLL_ID='$poll_id' AND VOTE='7'" ;
$result8 = mysql_query($query8) or die("topic.php - Error in query: $query8") ;                                  
$option_votes=mysql_num_rows($result8);
$percentage=number_format(($option_votes/$total_votes)*100);
$px="px";

$width=($percentage*5);

$show_option=$option7;

template_hook("forums/topic.template.php", "8");
}

if ($option8!=''){

$query8 = "select VOTE_ID from {$db_prefix}polls_votes WHERE POLL_ID='$poll_id' AND VOTE='8'" ;
$result8 = mysql_query($query8) or die("topic.php - Error in query: $query8") ;                                  
$option_votes=mysql_num_rows($result8);
$percentage=number_format(($option_votes/$total_votes)*100);
$px="px";

$width=($percentage*5);

$show_option=$option8;

template_hook("forums/topic.template.php", "8");
}

if ($option9!=''){

$query8 = "select VOTE_ID from {$db_prefix}polls_votes WHERE POLL_ID='$poll_id' AND VOTE='9'" ;
$result8 = mysql_query($query8) or die("topic.php - Error in query: $query8") ;                                  
$option_votes=mysql_num_rows($result8);
$percentage=number_format(($option_votes/$total_votes)*100);
$px="px";

$width=($percentage*5);

$show_option=$option9;

template_hook("forums/topic.template.php", "8");
}

if ($option10!=''){

$query8 = "select VOTE_ID from {$db_prefix}polls_votes WHERE POLL_ID='$poll_id' AND VOTE='10'" ;
$result8 = mysql_query($query8) or die("topic.php - Error in query: $query8") ;                                  
$option_votes=mysql_num_rows($result8);
$percentage=number_format(($option_votes/$total_votes)*100);
$px="px";

$width=($percentage*5);

$show_option=$option10;

template_hook("forums/topic.template.php", "8");
}

template_hook("forums/topic.template.php", "9");

if ($locked=='1'){
$voted_check="1";
}

if ($voted_check=='0'){

$topic_title = topic_title($topic);

template_hook("forums/topic.template.php", "10");

}

template_hook("forums/topic.template.php", "11");

}

}

template_hook("forums/topic.template.php", "12");

if ($can_moderate_members=='1'){
$query211 = "select MEMBER, TIME, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, EDIT_REASON, TITLE, DESCRIPTION, STICKY, ANNOUNCE, REPORTED, APPROVED, original_topic_id from {$db_prefix}posts WHERE TOPIC_ID='$topic' ORDER BY TIME asc LIMIT $limit, $list_posts";
}
else{
$query211 = "select MEMBER, TIME, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, EDIT_REASON, TITLE, DESCRIPTION, STICKY, ANNOUNCE, REPORTED, APPROVED, original_topic_id from {$db_prefix}posts WHERE TOPIC_ID='$topic' AND APPROVED='1' ORDER BY TIME asc LIMIT $limit, $list_posts";
}

$result211 = mysql_query($query211) or die("topic.php - Error in query: $query211") ;                                  
while ($results211 = mysql_fetch_array($result211)){
$content = $results211['CONTENT']; // strip_slashes removed here

$original_topic_id = $results211['original_topic_id'];

$edit_form_title = strip_slashes($results211['TITLE']);
$edit_form_desc = strip_slashes($results211['DESCRIPTION']);
$edit_form_content = $results211['CONTENT'];
$edit_form_content= strip_slashes($edit_form_content);
$reported = $results211['REPORTED'];

$edit_form_sticky = $results211['STICKY'];
$edit_form_announce = $results211['ANNOUNCE'];

$post_id = $results211['ID'];
$member = $results211['MEMBER'];
$time = $results211['TIME'];
$forum_id = $results211['FORUM_ID'];
$approved = $results211['APPROVED'];

$time = format_date($time); 

$edit_time = $results211['EDIT_TIME'];
$edit_reason = $results211['EDIT_REASON'];
$edit_reason = strip_slashes($edit_reason);

$edit_time = format_date($edit_time); 

$edit_member = $results211['EDIT_MEMBER'];
$title = $results211['TITLE'];

$title=strip_slashes($title);

if ($approved=='0'){

// get the ID so we can approve
// in the topic view
$query291 = "select ID from {$db_prefix}moderate WHERE POSTID='$post_id'" ;
$result291 = mysql_query($query291) or die("topic.php - Error in query: $query291") ;                                  
$moderate_post = mysql_result($result291, 0);
}

$query291 = "select NAME, ROLE from {$db_prefix}members WHERE ID='$edit_member'" ;
$result291 = mysql_query($query291) or die("topic.php - Error in query: $query291") ;                                  
while ($results291 = mysql_fetch_array($result291)){
$edit_member_name = $results291['NAME'];

$edit_member_name = strip_slashes($edit_member_name);

$edit_role = $results291['ROLE'];
}

$name		= '';
$cv_rank	= 0;

$query2 = "select ID, NAME, LOCATION, AVATAR, REMOTE_AVATAR, SIGNATURE, NATIONALITY, USERTITLE, WARN_LEVEL, REGISTER_DATE, USER_POSTS, ROLE from {$db_prefix}members WHERE ID='$member'" ;
$result2 = mysql_query($query2) or die("topic.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$id = $results2['ID'];
$name = $results2['NAME'];

$name = strip_slashes($name);

$profile_name = $results2['NAME'];

$profile_name = strip_slashes($profile_name);

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
$number_posts	= $results2['USER_POSTS'];
$num_posts	= number_format($results2['USER_POSTS']);
$member_role = $results2['ROLE'];

$register_date=format_date($register_date, '%d %B %Y');

$usertitle=strip_slashes($usertitle);
$signature=strip_slashes($signature);
}

// Get group color
$query54 = "select CAN_CHANGE_SITE_SETTINGS, CAN_CHANGE_FORUM_SETTINGS, GROUP_ICON, GROUP_NAME, GROUP_COLOR from {$db_prefix}groups WHERE GROUP_ID='$member_role'" ;
$result54 = mysql_query($query54) or die("topic.php - Error in query: $query54") ;                                  
while ($results54 = mysql_fetch_array($result54)){
$user_can_change_site_settings = $results54['CAN_CHANGE_SITE_SETTINGS'];
$user_can_change_forum_settings = $results54['CAN_CHANGE_FORUM_SETTINGS'];
$user_group_icon = $results54['GROUP_ICON'];
$user_group_name = strip_slashes($results54['GROUP_NAME']);
$user_group_color = strip_slashes($results54['GROUP_COLOR']);
}

// Show online/offline icon

$query21 = "select ID from {$db_prefix}sessions WHERE ID='$id'" ;
$result21 = mysql_query($query21) or die("topic.php - Error in query: $query21") ;                                  
$member_online=mysql_num_rows($result21);

// Get avatar...
if ($avatar==''){
$avatar = $default_avatar;

}
else{

$ext = strtolower(strrchr($avatar,"."));


}

// Show graphic...
$level			= ($warn_level / $max_warn) * 5;
$graphic_level	= floor($level);
$graphic_warn 	= round($level * 20);

// get title and pips...
$query_rank = "select RANK_TITLE, RANK_PIPS from {$db_prefix}ranks WHERE RANK_POSTS <= '$number_posts' ORDER BY RANK_POSTS desc LIMIT 1" ;
$result_rank = mysql_query($query_rank) or die("topic.php - Error in query: $query_rank") ;                                  
while ($results_rank = mysql_fetch_array($result_rank)){
$rank_title = strip_slashes($results_rank['RANK_TITLE']);
$rank_pips = $results_rank['RANK_PIPS'];
}

if ($usertitle==''){
$usertitle = "$rank_title";
}

$topic_trackback_text = sprintf($lang['topic_trackback_text'], lb_link('index.php?page=findpost&post=' . $post_id, 'findpost/' . $post_id));

	/*
	Hook after the member's name
*/

	$username_hook = '';
	
	if ($code = $Plugin->hook('topic', 'after_username'))
	{
		eval($code);
	}
	
	/*
	Decide when & how to show the revert link
*/

	$show_revert = false;
	
	if ($trashcan_enabled && $trashcan_forum == $forum_id)
	{
		if ($topic_original_topic_id != 0)
		{
			$show_revert = true;
		}
		elseif ($original_topic_id == 0 && $title != '')
		{
			$show_revert = true;
		}
		else
		{
			$show_revert = false;
		}
	}
	
	list($revert_token_id, $revert_token, $revert_token_name) = tokenCreate('topic_post_revert', $post_id);

template_hook("forums/topic.template.php", "14");

$start_pip = "0";
while ($start_pip < $rank_pips){

template_hook("forums/topic.template.php", "36");

$start_pip = $start_pip + 1;
}

template_hook("forums/topic.template.php", "37");

// show group icon
if (isset(${'groups_' . $user_group_icon . '_img'}))
{
	$group_img = ${'groups_' . $user_group_icon . '_img'};
}

// BB Parse...
	if (file_exists("themes/$theme/scripts/php/parse.php")){
		include "themes/$theme/scripts/php/parse.php";
	}
	else{
		include "scripts/php/parse.php";				
	}
	
	/*
	Hook after the user's information.
*/
	
	$user_info_hook = '';
	
	if ($code = $Plugin->hook('topic', 'user_info'))
	{
		eval($code);
	}

template_hook("forums/topic.template.php", "17");

$result_custom = mysql_query('
	SELECT cf.name, cm.content
	FROM ' . $db_prefix . 'custom_fields cf
		INNER JOIN ' . $db_prefix . 'custom_members cm
		ON cf.id = cm.field_id AND cm.member_id = ' . $id . '
	ORDER BY cf.order_field ASC
');
while ($results_custom = mysql_fetch_assoc($result_custom))
{
	$custom_field_name		= $results_custom['name'];
	$custom_profile_content	= $results_custom['content'];
	
	template_hook('forums/topic.template.php', 32);
}

template_hook("forums/topic.template.php", "31");

// Check for attachments...

$query2 = "select ROW from {$db_prefix}attachments WHERE POSTID='$post_id'" ;
$result2 = mysql_query($query2) or die("topic.php - Error in query: $query2") ;
$attachments = mysql_num_rows($result2);

if ($attachments!='0'){
if ($can_download_attachment=='1'){

$query2 = "select ROW, ORIGINAL_FILENAME, FILENAME, FILESIZE, DOWNLOADS, HASH from {$db_prefix}attachments WHERE POSTID='$post_id'" ;
$result2 = mysql_query($query2) or die("topic.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$row = $results2['ROW'];
$original_filename = $results2['ORIGINAL_FILENAME'];
$filename = $results2['FILENAME'];
$filesize = $results2['FILESIZE'];
$hash = $results2['HASH'];
$downloads = $results2['DOWNLOADS'];
$downloads=number_format($downloads);

if ($attach_done[$row]!='1'){

if ($filesize=='0' OR $filesize==''){
$filesize = $lang['topic_attach_filesize'];
}
elseif ($filesize < 1024){
$filesize = "$filesize bytes";
}
elseif ($filesize < 1048576){
$filesize = $filesize/1024;
$filesize = round($filesize,2);
$filesize = $filesize."kb";
}
else{
$filesize = $filesize/1048576;
$filesize = round($filesize,2);
$filesize = $filesize."mb";
}


// Check if it's an image...
$parts	= explode('.', $filename);
$ext	= $parts[count($parts)-1];			
$ext	= strtolower($ext);

if ($ext=='jpeg'){

			$imgSx = imagesx($lb_domain.'/uploads/attachments/'.$filename);
			$imgSy = imagesy($lb_domain.'/uploads/attachments/'.$filename);


$filename="t_$filename";

template_hook("forums/topic.template.php", "18");

}
elseif ($ext=='jpg'){

			$imgSx = imagesx($lb_domain.'/uploads/attachments/'.$filename);
			$imgSy = imagesy($lb_domain.'/uploads/attachments/'.$filename);


$filename="t_$filename";

template_hook("forums/topic.template.php", "18");

}
elseif ($ext=='gif'){

			$imgSx = imagesx($lb_domain.'/uploads/attachments/'.$filename);
			$imgSy = imagesy($lb_domain.'/uploads/attachments/'.$filename);


$filename="t_$filename";

template_hook("forums/topic.template.php", "18");
}
elseif ($ext=='png'){

			$imgSx = imagesx($lb_domain.'/uploads/attachments/'.$filename);
			$imgSy = imagesy($lb_domain.'/uploads/attachments/'.$filename);



$filename="t_$filename";

template_hook("forums/topic.template.php", "18");

}
else{

template_hook("forums/topic.template.php", "19");

}
}
}
}
else{

template_hook("forums/topic.template.php", "20");

}
}

template_hook("forums/topic.template.php", "21");

if ($edit_reason!=''){

template_hook("forums/topic.template.php", "22");

}




if ($can_edit_others_posts=='1'){
if($store_post_history=='1'){
$query1211 = "select ROW, CONTENT, MEMBER, DATE, EDIT_REASON from {$db_prefix}posts_edit WHERE POST='$post_id' ORDER BY ROW desc LIMIT 10";
$result1211 = mysql_query($query1211) or die("topic.php - Error in query: $query1211");  

$edited_count = mysql_num_rows($result1211);



if ($edited_count!='0'){

template_hook("forums/topic.template.php", "33");

}
                                
while ($results1211 = mysql_fetch_array($result1211)){
$edited_row = $results1211['ROW'];
$edited_content = $results1211['CONTENT'];

$edited_content=strip_slashes($edited_content);

$edited_member = $results1211['MEMBER'];
$edited_date = $results1211['DATE'];
$edited_reason = $results1211['EDIT_REASON'];

$edited_date = format_date($edited_date, '%m/%d/%y %H:%M'); 

$edited_reason = strip_slashes($edited_reason);

$content=$edited_content;

// spoiler tags screw rest of post, sort it!
$content=str_replace("[spoiler]","[spoiler_edit]",$content);
$content=str_replace("[/spoiler]","[/spoiler_edit]",$content);

if ($edited_reason==''){
$edited_reason = $lang['topic_edited_unknown'];
}

$query_edit = "select NAME, ROLE from {$db_prefix}members WHERE ID = '$edited_member'" ;
$result_edit = mysql_query($query_edit) or die("topic.php - Error in query: $query_edit") ;                                  
while ($results_edit = mysql_fetch_array($result_edit)){
$edited_by_name = $results_edit['NAME'];

$edited_by_name = strip_slashes($edited_by_name);

$edited_member_role = $results_edit['ROLE'];
}

// BB Parse...
	if (file_exists("themes/$theme/scripts/php/parse.php")){
		include "themes/$theme/scripts/php/parse.php";
	}
	else{
		include "scripts/php/parse.php";				
	}

if ($edited_count!='0'){

template_hook("forums/topic.template.php", "34");

}

}

if ($edited_count!='0'){

template_hook("forums/topic.template.php", "35");

}

}

}

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

template_hook("forums/topic.template.php", "23");

}

$query2167 = "select ROLE from {$db_prefix}members WHERE ID='$id'" ;
$result2167 = mysql_query($query2167) or die("topic.php - Error in query: $query2167") ;                                  
$users_role = mysql_result($result2167, 0);

	// PERMISSIONS! Can the recipient PM???!!!

		$query2168 = "select CAN_PM from {$db_prefix}groups WHERE GROUP_ID='$users_role'" ;
		$result2168 = mysql_query($query2168) or die("topic.php - Error in query: $query2168") ;                                  
		$can_pm_this_member = mysql_result($result2168, 0);

$query29 = "select NAME from {$db_prefix}members WHERE ID='$member'" ;
$result29 = mysql_query($query29) or die("topic.php - Error in query: $query29") ;                                  
$member_name = mysql_result($result29, 0);

$member_name = strip_slashes($member_name);

$token_name_edit = "token_edit_$post_id$token_id";

$_SESSION[$token_name_edit] = $token;

list($delete_token_id, $delete_token, $delete_token_name) = tokenCreate('topic_post_delete', $post_id);

	/*
	Hook next to the reply, quote, edit, buttons.
*/

	$post_buttons_hook = '';
	
	if ($code = $Plugin->hook('topic', 'post_buttons'))
	{
		eval($code);
	}
	
template_hook("forums/topic.template.php", "24");

// now reset everything...
$usertitle="";
$avatar="";
$remote_avatar="";
$id="";
$warn_notes="";
$role="";
$member_role="";
$group_img = "";
$rank_title="";
$rank_pips="";
$member_online="";
$user_group_icon="";
$user_group_name="";
$user_group_color="";
$role_img="";
$num_posts="0";
$register_date="";
$location="";
$custom_field_name="";
$custom_profile_content="";
$signature = "";

}

// Find all online...
$query2 = "select ID from {$db_prefix}sessions WHERE ID<='0' AND LOCATION_TOPIC='$topic'" ;
$result2 = mysql_query($query2) or die("topic.php - Error in query: $query2") ;                                  
$guests=mysql_num_rows($result2);


$query3 = "select ID from {$db_prefix}sessions WHERE ID>'0'  AND LOCATION_TOPIC='$topic'" ;
$result3 = mysql_query($query3) or die("topic.php - Error in query: $query3") ;                                  
$members=mysql_num_rows($result3);

$lang['topic_viewing'] = str_replace("<%1>", "<strong>$guests</strong>", $lang['topic_viewing']);
$lang['topic_viewing'] = str_replace("<%2>", "<strong>$members</strong>", $lang['topic_viewing']);

// are there any previous topics?
$query2918 = "select TOPIC_ID from {$db_prefix}posts WHERE TOPIC_ID < '$topic' AND FORUM_ID = '$forum_id'";
$result2918 = mysql_query($query2918) or die("topic.php - Error in query: $query2918") ;                                  
$previous_topic = mysql_num_rows($result2918);

if ($previous_topic!='0'){
	$query2918 = "select TOPIC_ID from {$db_prefix}posts WHERE TOPIC_ID < '$topic' AND FORUM_ID = '$forum_id' ORDER BY TOPIC_ID desc LIMIT 1";
	$result2918 = mysql_query($query2918) or die("topic.php - Error in query: $query2918") ;                                  
	$previous_topic_id = mysql_result($result2918, 0);
}

else{
	$previous_topic_id="";
	$lang['topic_previous']="";
}

// are there any future topics?
$query2918 = "select TOPIC_ID from {$db_prefix}posts WHERE TOPIC_ID > '$topic' AND FORUM_ID = '$forum_id' ORDER BY TOPIC_ID desc LIMIT 1" ;
$result2918 = mysql_query($query2918) or die("topic.php - Error in query: $query2918") ;                                  
$next_topic = mysql_num_rows($result2918);

if ($next_topic!='0'){
	$query2918 = "select TOPIC_ID from {$db_prefix}posts WHERE TOPIC_ID > '$topic' AND FORUM_ID = '$forum_id' ORDER BY TOPIC_ID desc LIMIT 1";
	$result2918 = mysql_query($query2918) or die("topic.php - Error in query: $query2918") ;                                  
	$next_topic_id = mysql_result($result2918, 0);
}
else{
	$next_topic_id="";
	$lang['topic_next']="";
}

$previous_title = topic_title($previous_topic_id);
$next_title = topic_title($next_topic_id);

template_hook("forums/topic.template.php", "25");

$count_online_count="1";
$query2 = "select ID, LOCATION_FORUM, LOCATION_TOPIC, LOCATION_PAGE, TIME from {$db_prefix}sessions WHERE ID!='0' AND LOCATION_TOPIC='$topic' ORDER BY TIME desc" ;
$result2 = mysql_query($query2) or die("topic.php - Error in query: $query2") ;
$count_online=mysql_num_rows($result2);                               
while ($results2 = mysql_fetch_array($result2)){
$id = $results2['ID'];
$time = $results2['TIME'];

$time = format_date($time, '%A, %R');

$location_forum = $results2['LOCATION_FORUM'];
$location_topic = $results2['LOCATION_TOPIC'];
$location_page = $results2['LOCATION_PAGE'];

// Get name...

if ($id > '0'){

$query21 = "select NAME, ROLE, NATIONALITY from {$db_prefix}members WHERE ID='$id'" ;
$result21 = mysql_query($query21) or die("topic.php - Error in query: $query21") ;                                  
while ($results21 = mysql_fetch_array($result21)){
$name = $results21['NAME'];

$name = strip_slashes($name);

$role = $results21['ROLE'];
$nationality = $results21['NATIONALITY'];
}
}
else{
$query21 = "select BOT_NAME from {$db_prefix}bots WHERE BOT_ID='$id'" ;
$result21 = mysql_query($query21) or die("board.php - Error in query: $query21") ;                                  
$name = mysql_result($result21, 0);
$role="3";
}

if ($count_online_count==$count_online){

template_hook("forums/topic.template.php", "26");

}
else{
$count_online_count=$count_online_count+1;

template_hook("forums/topic.template.php", "27");

}
}

template_hook("forums/topic.template.php", "28");


// Get page numbers...

$query = "select ID from {$db_prefix}posts WHERE TOPIC_ID='$topic'" ;
$result = mysql_query($query) or die("topic.php - Error in query: $query") ;                                  
$number_of_posts=mysql_num_rows($result);

if ($_GET['limit']==''){

$limit=0;
}
elseif($_GET['limit']=='0'){
$limit=0;
}
else {
$limit=escape_string($_GET['limit']) - 1;
$limit=($limit*$list_posts);
}

$pages=ceil($number_of_posts/$list_posts);
$pages_end = $pages;

if ($pages <= '1'){
}
else{

template_hook("forums/topic.template.php", "2");

}

template_hook("forums/topic.template.php", "29");

// Can they Post?

template_hook("forums/topic.template.php", "30");

}

template_hook("forums/topic.template.php", "end");

?>
