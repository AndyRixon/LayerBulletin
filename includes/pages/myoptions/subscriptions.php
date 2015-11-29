<?php
/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By LayerBulletin Team
|   (c) 2014 LayerBulletin Team
|   http://layerbulletin.com/
|   ========================================
|   subscriptions.php - view subscribed topics & forums
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_subscriptions_$token_id";

$_SESSION[$token_name] = $token;

template_hook("pages/myoptions/subscriptions.template.php", "start");

if($_GET['success']=='deleted'){
	template_hook("pages/myoptions/subscriptions.template.php", "successDeleted");
}elseif($_GET['success']=='subscribed'){
	template_hook("pages/myoptions/subscriptions.template.php", "successPMSubscribed");
}elseif($_GET['success']=='unsubscribed'){
	template_hook("pages/myoptions/subscriptions.template.php", "successPMUnsubscribed");
}

if (isset($_GET['id'])){

$row = $_GET['id'];
$row = escape_string($row);

// check we subscribed to it. If not, fire an error...

$query1 = "select ROW from {$db_prefix}subscribe WHERE ID='$my_id' AND ROW='$row'" ;
$result1 = mysql_query($query1) or die("subscriptions.php - Error in query: $query1") ;                               
$is_valid = mysql_num_rows($result1);

if ($is_valid=='0'){
	lb_redirect("index.php?page=error&error","error");
}
else{

mysql_query("DELETE FROM {$db_prefix}subscribe WHERE row ='$row'");

	template_hook("pages/myoptions/subscriptions.template.php", "form_2");

	lb_redirect("index.php?page=myoptions&act=subscriptions&success=deleted","myoptions/subscriptions/success/deleted");

}

}

elseif($_GET['area']=='messages'){

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);

$token_name = "token_subscriptions_$token_id";

$subscribe = $_POST['subscribe'];
$subscribe = escape_string($subscribe);

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

// update database...
mysql_query("UPDATE {$db_prefix}members SET subscribe_pm='$subscribe' WHERE id='$my_id'");

	template_hook("pages/myoptions/subscriptions.template.php", "form_3");

	$un_subscribe = $_POST['subscribe']=='1' ? "subscribed" : "unsubscribed";

	lb_redirect("index.php?page=myoptions&act=subscriptions&success=" . $un_subscribe,"myoptions/subscriptions/success/" . $un_subscribe);

}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}

}

else{

$query1 = "select SUBSCRIBE_PM from {$db_prefix}members WHERE ID='$my_id'" ;
$result1 = mysql_query($query1) or die("subscriptions.php - Error in query: $query1") ; 
$is_subscribed = mysql_result($result1, 0);

template_hook("pages/myoptions/subscriptions.template.php", "1");

$query1 = "select ROW, SUBSCRIBED_FORUM from {$db_prefix}subscribe WHERE ID='$my_id' AND SUBSCRIBED_FORUM!=''" ;
$result1 = mysql_query($query1) or die("subscriptions.php - Error in query: $query1") ;                               
while ($results1 = mysql_fetch_array($result1)){
$row = $results1['ROW'];
$subscribed_forum = $results1['SUBSCRIBED_FORUM'];

$query12 = "select NAME from {$db_prefix}categories WHERE ID='$subscribed_forum'" ;
$result12 = mysql_query($query12) or die("subscriptions.php - Error in query: $query12") ;                               
$forum_title = mysql_result($result12, 0);
$forum_title = strip_slashes($forum_title);

template_hook("pages/myoptions/subscriptions.template.php", "2");

}

template_hook("pages/myoptions/subscriptions.template.php", "3");

$query1 = "select ROW, SUBSCRIBED_TOPIC from {$db_prefix}subscribe WHERE ID='$my_id' AND SUBSCRIBED_TOPIC!='0'" ;
$result1 = mysql_query($query1) or die("subscriptions.php - Error in query: $query1") ;                               
while ($results1 = mysql_fetch_array($result1)){
$row = $results1['ROW'];
$subscribed_topic = $results1['SUBSCRIBED_TOPIC'];

$query12 = "select TITLE from {$db_prefix}posts WHERE TOPIC_ID='$subscribed_topic'" ;
$result12 = mysql_query($query12) or die("subscriptions.php - Error in query: $query12") ;                               
$topic_title = mysql_result($result12, 0);
$topic_title = strip_slashes($topic_title);

template_hook("pages/myoptions/subscriptions.template.php", "4");

}

template_hook("pages/myoptions/subscriptions.template.php", "5");

}

template_hook("pages/myoptions/subscriptions.template.php", "end");

?>