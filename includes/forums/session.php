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
|   session.php - Holds info on who is online
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

$ip_address = escape_string($_SERVER['REMOTE_ADDR']);

if ($role=='4'){
if (isset($_GET['topic'])){
// If they have too may clicks, redirect them...

$query3 = "select GUEST_CLICKS from {$db_prefix}sessions WHERE ID='0' AND ADDRESS='$ip_address'" ;
$result3 = mysql_query($query3) or die("session.php - Error in query: $query3") ;                                  
$current_guest_clicks = mysql_num_rows($result3);

if ($max_guest_clicks > '-1'){
if($current_guest_clicks >= $max_guest_clicks){

	template_hook("forums/session.template.php", "form");

	lb_redirect("index.php?page=blocked","blocked");

}
}
}
}

// First thing is first, remove any entries that are more than 15 minutes old...

$fifteen = (time()-(15*60));

$query2 = "select ID, TIME, ADDRESS from {$db_prefix}sessions WHERE TIME < '$fifteen'" ;
$result2 = mysql_query($query2) or die("session.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$id = $results2['ID'];
$time = $results2['TIME'];
$address = $results2['ADDRESS'];

// Delete the rows...
mysql_query("DELETE FROM {$db_prefix}sessions WHERE time='$time'");
}

// Now we get the location, and insert it into a readable format

if (isset($_GET['func'])){
$page=escape_string($_GET['func']);
$forum_id = "";
$topic_id = "";
}

elseif (isset($_GET['page'])){
$page=escape_string($_GET['page']);
$forum_id = "";
$topic_id = "";
}


elseif (isset($_GET['forum'])){
$forum_id=escape_string($_GET['forum']);
$topic_id="";
$page="";
}

elseif (isset($_GET['topic']) && is_numeric($_GET['topic'])){

$topic_id = escape_string($_GET['topic']);

$query3 = "select FORUM_ID from {$db_prefix}posts WHERE TOPIC_ID='$topic_id' AND TITLE!=''" ;
$result3 = mysql_query($query3) or die("session.php - Error in query: $query3") ;                                  
while ($results3 = mysql_fetch_array($result3)){
$forum_id = $results3['FORUM_ID'];
$topic_id = escape_string($_GET['topic']);
$page="";
}
}

else{
$page="index";
$forum_id = "";
$topic_id = "";
}

if ($page=='' && $forum_id=='' && $topic_id==''){
$page="index";
$forum_id = "";
$topic_id = "";
}

if (isset($my_id)){
$id=$my_id;
}

// Now check in case it is a search engine :)

if(!isset($_COOKIE['lb_name'])){
$id="0";
}

if ($id == '0'){

$bot_id="0";

$query_bot = "select BOT_ID, BOT_NAME from {$db_prefix}bots ORDER BY BOT_ID desc" ;
$result_bot = mysql_query($query_bot) or die("session.php - Error in query: $query_bot") ;                                 
while ($results_bot = mysql_fetch_array($result_bot)){
$bot_id = $results_bot['BOT_ID'];
$bot_name = $results_bot['BOT_NAME'];

$pos = strpos($_SERVER['HTTP_USER_AGENT'], $bot_name);

if ($pos === false){
}
else{
$id=$bot_id;
}

}

}

$guest_id=$id;

// If this person is a member, check that they don't have a session stored...
if ($id > '0'){

// Update last online time if they don't already have a session stored...
$time=time();
mysql_query("UPDATE {$db_prefix}members SET last_online='$time' WHERE id = '$id' ");

// remove old entry
mysql_query("DELETE FROM {$db_prefix}sessions WHERE id='$id'");

// insert new entry
$time=time();
mysql_query("INSERT INTO {$db_prefix}sessions (id, address, location_forum, location_topic, location_page, time) VALUES ('$id', '$ip_address', '$forum_id', '$topic_id', '$page', '$time')");

}

// If the ID is 0, then this person is a guest, so first check that they aren't already listed...
elseif($guest_id <= '0'){

$query2 = "select ID from {$db_prefix}sessions WHERE ADDRESS='$ip_address' LIMIT 1" ;
$result2 = mysql_query($query2) or die("session.php - Error in query: $query2");                                  
$num=mysql_num_rows($result2);

$query_2 = "select ID from {$db_prefix}sessions WHERE ID='$guest_id' AND ID!='0' LIMIT 1" ;
$result_2 = mysql_query($query_2) or die("session.php - Error in query: $query_2") ;                                  
$num_spiders=mysql_num_rows($result_2);

if ($num_spiders=='1'){
$num="1";
}

// If there is no result, it's a new guest. INSERT the database with the info...
if ($num=='0'){
$time=time();
mysql_query("INSERT INTO {$db_prefix}sessions (id, address, location_forum, location_topic, location_page, time) VALUES ('$guest_id', '$ip_address', '$forum_id', '$topic_id', '$page', '$time')");
}

// If there is a result, we UPDATE the database...
else{

if (isset($_GET['topic']) && $max_guest_clicks > '-1'){
$add="1";
}
else{
$add="0";
}

$time=time();

$query_clicks = "select GUEST_CLICKS from {$db_prefix}sessions WHERE ID='$guest_id' AND ADDRESS='$ip_address'" ;
$result_clicks = mysql_query($query_clicks) or die("session.php - Error in query: $query_clicks") ;                                  
$current_guest_clicks = mysql_num_rows($result_clicks);

if ($num_spiders=='0'){
if (isset($current_guest_clicks) && $current_guest_clicks >= $max_guest_clicks){
mysql_query("UPDATE {$db_prefix}sessions SET address='$ip_address', location_forum='$forum_id', location_topic='$topic_id', location_page='$page', time='$time', guest_clicks=guest_clicks + $add WHERE ADDRESS='$ip_address'");
}
else{
mysql_query("UPDATE {$db_prefix}sessions SET time='$time', address='$ip_address', location_forum='$forum_id', location_topic='$topic_id', location_page='$page', guest_clicks=guest_clicks + $add WHERE ADDRESS='$ip_address'");
}
}
else{
mysql_query("UPDATE {$db_prefix}sessions SET location_forum='$forum_id', location_topic='$topic_id', location_page='$page', time='$time' WHERE id = '$guest_id'");
}

}
}

?>