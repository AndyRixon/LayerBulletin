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
|   newpost.php - post a new topic in a forum
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}
	
template_hook("forums/newpost.template.php", "start");
	
if ($_POST['subject']!=''){

$forum=$_POST['forum'];
$forum=escape_string($forum);

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);

$token_name = "token_newpost_$forum$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

		// PERMISSIONS!!! Can they view this forum???

		$can_add_topics="0";

		$query3 = "select CAN_ADD_TOPICS from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum'" ;
		$result3 = mysql_query($query3) or die("newpost.php - Error in query: $query3") ;                                  
		$can_add_topics = mysql_result($result3, 0);

if ($can_add_topics=='0'){

	lb_redirect("index.php?page=error&error=9","error/9");

}

else{

// Get member ID...

$name=$_COOKIE['lb_name'];
$name=escape_string($name);

$password=$_COOKIE['lb_password'];
$password=escape_string($password);

$query211 = "select ID from {$db_prefix}members WHERE NAME='$name' AND PASSWORD='$password'" ;
$result211 = mysql_query($query211) or die("newpost.php - Error in query: $query211") ;                                  
$id = mysql_result($result211, 0);

// Get last topic ID...

$topic_id="0";
$query2 = "select TOPIC_ID from {$db_prefix}posts WHERE TITLE!='' ORDER BY TOPIC_ID desc LIMIT 1" ;
$result2 = mysql_query($query2) or die("newpost.php - Error in query: $query2") ;
$count_topics = mysql_num_rows($result2);                                  
$topic_id = mysql_result($result2, 0);

$topic_id=$topic_id+1;
if ($topic_id=='0'){
$topic_id="1";
}
elseif($topic_id==''){
$topic_id="1";
}
elseif($count_topics=='0'){
$topic_id="1";
}

$time=time();

$subject=$_POST['subject'];
$subject=escape_string($subject);
$description=$_POST['description'];
$description=escape_string($description);
$content=$_POST['content'];
$content=escape_string($content);
$forum=$_POST['forum'];
$forum=escape_string($forum);
$sticky=$_POST['sticky'];
$sticky=escape_string($sticky);
$locked=$_POST['locked'];
$locked=escape_string($locked);
$announce=$_POST['announce'];
$announce=escape_string($announce);

if ($moderated=='1'){
mysql_query("INSERT INTO {$db_prefix}posts (member, address, title, description, content, topic_id, forum_id, sticky, announce, locked, last_post_time, time, approved) VALUES ('$id', '$REMOTE_ADDR', '$subject', '$description', '$content', '$topic_id', '$forum', '$sticky', '$announce', '$locked', '$time', '$time', '0')");

}
else{
mysql_query("INSERT INTO {$db_prefix}posts (member, address, title, description, content, topic_id, forum_id, sticky, announce, locked, last_post_time, time) VALUES ('$id', '$REMOTE_ADDR', '$subject', '$description', '$content', '$topic_id', '$forum', '$sticky', '$announce', '$locked', '$time', '$time')");
}

$query2 = "select ID from {$db_prefix}posts WHERE TITLE!='' ORDER BY TOPIC_ID desc LIMIT 1" ;
$result2 = mysql_query($query2) or die("newpost.php - Error in query: $query2") ;                                  
$post_id = mysql_result($result2, 0);

caspian_trigger($post_id);

if ($moderated=='1'){
mysql_query("INSERT INTO {$db_prefix}moderate (postid, title, member_id, member_name, time) VALUES ('$post_id', '$subject', '$id', '$name', '$time')");

mysql_query("UPDATE {$db_prefix}settings SET stats_topics=stats_topics+1, stats_post_id='$post_id'");

}
else{
mysql_query("UPDATE {$db_prefix}settings SET stats_topics=stats_topics+1, stats_post_id='$post_id', stats_post_title='$subject', stats_post_forum='$forum', stats_post_time='$time', stats_post_topic='$topic_id'");
}

$query334 = "select POST_COUNT from {$db_prefix}categories WHERE ID='$forum'" ;
		$result334 = mysql_query($query334) or die("newpost.php - Error in query: $query334") ;                                  
		$post_count = mysql_result($result334, 0);
		
//Increment the Post Count?

if($post_count=='1'){
mysql_query("UPDATE {$db_prefix}members SET user_posts=user_posts+1 WHERE id = '$my_id'");
}else{
}

if ($_POST['question']!=''){

$question=$_POST['question'];
$question=escape_string($question);

$option1=$_POST['option1'];
$option1=escape_string($option1);
$option2=$_POST['option2'];
$option2=escape_string($option2);
$option3=$_POST['option3'];
$option3=escape_string($option3);
$option4=$_POST['option4'];
$option4=escape_string($option4);
$option5=$_POST['option5'];
$option5=escape_string($option5);
$option6=$_POST['option6'];
$option6=escape_string($option6);
$option7=$_POST['option7'];
$option7=escape_string($option7);
$option8=$_POST['option8'];
$option8=escape_string($option8);
$option9=$_POST['option9'];
$option9=escape_string($option9);
$option10=$_POST['option10'];
$option10=escape_string($option10);

$multiple=escape_string($_POST['multiple']);

mysql_query("INSERT INTO {$db_prefix}polls (topic_id, question, option1, option2, option3, option4, option5, option6, option7, option8, option9, option10, poll_type) VALUES ('$topic_id', '$question', '$option1', '$option2', '$option3', '$option4', '$option5', '$option6', '$option7', '$option8', '$option9', '$option10', '$multiple')");
}

// We now need to convert the hash that was generated
// for file uploads, and add the post ID that this file
// was uploaded for...

$query2 = "select ID, FORUM_ID from {$db_prefix}posts WHERE TITLE!='' AND TOPIC_ID='$topic_id'" ;
$result2 = mysql_query($query2) or die("newpost.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$post_id = $results2['ID'];
$forum = $results2['FORUM_ID'];
}

// Update the attachments table with the post ID...

$hash=$_POST['hash'];
$hash=escape_string($hash);

mysql_query("UPDATE {$db_prefix}attachments SET postid='$post_id', topicid='$topic_id' WHERE hash = '$hash'");


if ($moderated!='1'){
// Email people that have subscribed...
	$query_subscribe = "select ID from {$db_prefix}subscribe WHERE SUBSCRIBED_FORUM='$forum'" ;
	$result_subscribe = mysql_query($query_subscribe) or die("newpost.php - Error in query: $query_subscribe") ;                                  
	while ($results_subscribe = mysql_fetch_array($result_subscribe)){
	$subscriber_id = $results_subscribe['ID'];

	$query_email = "select EMAIL, NAME from {$db_prefix}members WHERE ID='$subscriber_id'" ;
	$result_email = mysql_query($query_email) or die("newpost.php - Error in query: $query_email") ;                                  
	while ($results_email = mysql_fetch_array($result_email)){
	$subscriber_email = $results_email['EMAIL'];
	$subscriber_name = $results_email['NAME'];
	}

	$query_forum_name = "select NAME from {$db_prefix}categories WHERE ID='$forum'" ;
	$result_forum_name = mysql_query($query_forum_name) or die("newpost.php - Error in query: $query_forum_name") ;                                  
	$forum_name = mysql_result($result_forum_name, 0);

	$lang['email_newpost_title'] = str_replace("<%forumname>", $forum_name, $lang['email_newpost_title']);
	
	$lang['email_newpost_content'] = str_replace("<%subscriber>", $subscriber_name, $lang['email_newpost_content']);
	$lang['email_newpost_content'] = str_replace("<%forumname>", $forum_name, $lang['email_newpost_content']);
	$lang['email_newpost_content'] = str_replace("<%sitename>", $site_name, $lang['email_newpost_content']);
	$lang['email_newpost_content'] = str_replace("<%site>", $lb_domain, $lang['email_newpost_content']);
	$lang['email_newpost_content'] = str_replace("<%forum>", $forum, $lang['email_newpost_content']);
	$lang['email_newpost_content'] = str_replace("<%post>", $post_id, $lang['email_newpost_content']);
	
// Prepare message...
$message=$lang['email_newpost_content'];

$outgoing="$subscriber_email";
$from="From: $site_name <$board_email>\r\n";
$subject=$lang['email_newpost_title'];


mail($outgoing, $subject, $message, $from);

	}
}
	
$redirect_topic=$topic_id;	
	
// perform auto-cache
include "scripts/php/auto_cache.php";		
	
	template_hook("forums/newpost.template.php", "form");

	$topic_title = topic_title($redirect_topic);
	
	lb_redirect("index.php?topic=$redirect_topic","topic/$topic_title-$redirect_topic");

}
}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}

else{

if ($_GET['forum']==''){

	lb_redirect("index.php?page=error&error=36","error/36");

}

$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$forum=$_GET['forum'];
$forum=escape_string($forum);

$token_name = "token_newpost_$forum$token_id";

$_SESSION[$token_name] = $token;

		// PERMISSIONS!!! Can they view this forum???

		$can_add_topics="0";
		$can_add_attachment="0";

		$query3 = "select CAN_ADD_TOPICS, CAN_ADD_ATTACHMENT from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum'" ;
		$result3 = mysql_query($query3) or die("newpost.php - Error in query: $query3") ;                                  
		while ($results3 = mysql_fetch_array($result3)){
		$can_add_topics = $results3['CAN_ADD_TOPICS'];
		$can_add_attachment = $results3['CAN_ADD_ATTACHMENT'];
		}
		

if ($can_add_topics=='0'){

	lb_redirect("index.php?page=error&error=9","error/9");

}

else{

template_hook("forums/newpost.template.php", "2");

if ($allow_attachments=='0'){
}
elseif ($can_add_attachment=='1'){

// Get hash for temporary ID
$hash=time();

template_hook("forums/newpost.template.php", "3");

$name=$_COOKIE['lb_name'];
$name=escape_string($name);

$password=$_COOKIE['lb_password'];
$password=escape_string($password);

$query3 = "select ID from {$db_prefix}members WHERE NAME='$name' AND PASSWORD='$password'" ;
$result3 = mysql_query($query3) or die("newpost.php - Error in query: $query3") ;                                  
$uploader_id = mysql_result($result3, 0);


// Iframe the upload form...

template_hook("forums/newpost.template.php", "4");

}
else{
}

$forum=$_GET['forum'];
$forum=escape_string($forum);

template_hook("forums/newpost.template.php", "5");

}
}

template_hook("forums/newpost.template.php", "end");

?>