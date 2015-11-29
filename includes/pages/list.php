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
|   list.php - Shows group/member lists
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

$count_members_alt = "";

template_hook("pages/list.template.php", "start");

if ($_GET['list']=='members' OR $_GET['group']!=''){

template_hook("pages/list.template.php", "15");

$query3 = "select GROUP_NAME, GROUP_ID from {$db_prefix}groups WHERE GROUP_ID!='4' ORDER BY can_change_site_settings desc, can_change_forum_settings desc" ;
$result3 = mysql_query($query3) or die("list.php - Error in query: $query3") ;                                  
while ($results3 = mysql_fetch_array($result3)){
$group_name = strip_slashes($results3['GROUP_NAME']);
$group_id = $results3['GROUP_ID'];

$query = "select ID from {$db_prefix}members WHERE ROLE='$group_id'" ;
$result = mysql_query($query) or die("list.php - Error in query: $query");                                  
$number_of_members=mysql_num_rows($result);
$number_of_members=number_format($number_of_members);

template_hook("pages/list.template.php", "16");

}

template_hook("pages/list.template.php", "17");

}

if ($_GET['group']!=''){

// Get page numbers...

$group=$_GET['group'];
$group=escape_string(abs($group));

$query2 = "select GROUP_ID from {$db_prefix}groups WHERE GROUP_ID='$group'" ;
$result2 = mysql_query($query2) or die("list.php - Error in query: $query2") ;  
$does_exist = mysql_num_rows($result2);

if ($does_exist=='0'){

	lb_redirect("index.php?page=error&error=27","error/27");

}  

$query = "select ID from {$db_prefix}members WHERE ROLE='$group'" ;
$result = mysql_query($query) or die("list.php - Error in query: $query");                                  
$number_of_members=mysql_num_rows($result);

if ($_GET['limit']==''){

$limit=0;
}
elseif($_GET['limit']<='0'){
$limit=0;
}
else {
$limit=escape_string($_GET['limit']) - 1;
$limit=($limit*$list_posts);
}

$pages=ceil($number_of_members/$list_posts);
$pages_end = $pages;

if ($pages <= '1'){
}
else{

template_hook("pages/list.template.php", "1");

}

$query3 = "select GROUP_NAME from {$db_prefix}groups WHERE GROUP_ID='$group'" ;
$result3 = mysql_query($query3) or die("list.php - Error in query: $query3") ;                                  
$group_name = strip_slashes(mysql_result($result3, 0));

template_hook("pages/list.template.php", "4");

$group = escape_string(abs($_GET['group']));

// Show member name...
$query2 = "select ID, NAME, ROLE, NATIONALITY from {$db_prefix}members WHERE ROLE='$group' ORDER BY NAME asc LIMIT $limit, $list_posts" ;

$result2 = mysql_query($query2) or die("list.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$id = $results2['ID'];
$name = strip_slashes($results2['NAME']);
$group_role = $results2['ROLE'];
$nationality = $results2['NATIONALITY'];

	$count_members_alt=$count_members_alt+1;

	$check_odd = checkNum($count_members_alt);

	if ($check_odd===TRUE){
		$alt_td_class="";
	}
	else{
		$alt_td_class="-alt";	
	}

// Show location...
$location_forum="";
$location_topic="";
$location_page="";
$time="0";
$query3 = "select ID, LOCATION_FORUM, LOCATION_TOPIC, LOCATION_PAGE, TIME from {$db_prefix}sessions WHERE ID='$id'";
$result3 = mysql_query($query3) or die("list.php - Error in query: $query3") ;                                  
while ($results3 = mysql_fetch_array($result3)){
$id = $results3['ID'];
$time = $results3['TIME'];

$time = format_date($time); 

$location_forum = $results3['LOCATION_FORUM'];
$location_topic = $results3['LOCATION_TOPIC'];
$location_page = $results3['LOCATION_PAGE'];
}

if ($time!='0' && $location_forum=='' && $location_topic=='' && $location_page==''){
$location_page="index";
}

template_hook("pages/list.template.php", "5");

if ($location_topic!=''){
$query30 = "select TITLE, FORUM_ID from {$db_prefix}posts WHERE TOPIC_ID='$location_topic' AND TITLE!=''" ;
$result30 = mysql_query($query30) or die("list.php - Error in query: $query30") ;                                  
while ($results30 = mysql_fetch_array($result30)){
$title = $results30['TITLE'];
$forum_id = $results30['FORUM_ID'];
}
		// PERMISSIONS!!! Can they view this forum???

		$can_read_topics="0";
		$can_view_forum="0";

		$query31 = "select CAN_READ_TOPICS, CAN_VIEW_FORUM from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;
		$result31 = mysql_query($query31) or die("online.php - Error in query: $query31") ;                                  
		while ($results31 = mysql_fetch_array($result31)){
		$can_read_topics = $results31['CAN_READ_TOPICS'];
		$can_view_forum = $results31['CAN_VIEW_FORUM'];
		}

$title=strip_slashes($title);

$topic_title = topic_title($location_topic);

template_hook("pages/list.template.php", "6");

}
elseif($location_forum!=''){
$query3 = "select NAME from {$db_prefix}categories WHERE ID='$location_forum'" ;
$result3 = mysql_query($query3) or die("list.php - Error in query: $query3") ;                                  
$forum_name = mysql_result($result3, 0);

$forum_title = forum_title($location_forum);

template_hook("pages/list.template.php", "7");

}
elseif($location_page!=''){

// Format the pages they are viewing...

$location_page_text = location_page("list");

template_hook("pages/list.template.php", "8");

}

$query2167 = "select ROLE from {$db_prefix}members WHERE ID='$id'" ;
$result2167 = mysql_query($query2167) or die("topic.php - Error in query: $query2167") ;                                  
$users_role = mysql_result($result2167, 0);

	// PERMISSIONS! Can the recipient PM???!!!

		$query2168 = "select CAN_PM from {$db_prefix}groups WHERE GROUP_ID='$users_role'" ;
		$result2168 = mysql_query($query2168) or die("topic.php - Error in query: $query2168") ;                                  
		$can_pm_this_member = mysql_result($result2168, 0);

template_hook("pages/list.template.php", "9");

}

template_hook("pages/list.template.php", "10");

if ($_GET['limit']==''){

$limit=0;
}
elseif($_GET['limit']<='0'){
$limit=0;
}
else {
$limit=escape_string($_GET['limit']) - 1;
$limit=($limit*$list_posts);
}

$pages=ceil($number_of_members/$list_posts);
$pages_end = $pages;

if ($pages <= '1'){
}
else{

template_hook("pages/list.template.php", "1");

}

}
elseif ($_GET['list']=='members'){

// Get page numbers...

$query = "select ID from {$db_prefix}members" ;
$result = mysql_query($query) or die("list.php - Error in query: $query");                                  
$number_of_members=mysql_num_rows($result);

if ($_GET['limit']==''){

$limit=0;
}
elseif($_GET['limit']<='0'){
$limit=0;
}
else {
$limit=escape_string($_GET['limit']) - 1;
$limit=($limit*$list_posts);
}

$pages=ceil($number_of_members/$list_posts);
$pages_end = $pages;

if ($pages <= '1'){
}
else{

template_hook("pages/list.template.php", "18");

}

template_hook("pages/list.template.php", "14");

// Show member name...
$query2 = "select ID, NAME, ROLE from {$db_prefix}members ORDER BY NAME asc LIMIT $limit, $list_posts" ;

$result2 = mysql_query($query2) or die("list.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$id = $results2['ID'];
$name = strip_slashes($results2['NAME']);
$group_role = $results2['ROLE'];

	$count_members_alt=$count_members_alt+1;

	$check_odd = checkNum($count_members_alt);

	if ($check_odd===TRUE){
		$alt_td_class="";
	}
	else{
		$alt_td_class="-alt";	
	}

// Show location...
$location_forum="";
$location_topic="";
$location_page="";
$time="0";
$query3 = "select ID, LOCATION_FORUM, LOCATION_TOPIC, LOCATION_PAGE, TIME from {$db_prefix}sessions WHERE ID='$id'";
$result3 = mysql_query($query3) or die("list.php - Error in query: $query3") ;                                  
while ($results3 = mysql_fetch_array($result3)){
$id = $results3['ID'];
$time = $results3['TIME'];

$time = format_date($time); 

$location_forum = $results3['LOCATION_FORUM'];
$location_topic = $results3['LOCATION_TOPIC'];
$location_page = $results3['LOCATION_PAGE'];
}

if ($time!='0' && $location_forum=='' && $location_topic=='' && $location_page==''){
$location_page="index";
}

template_hook("pages/list.template.php", "5");

if ($location_topic!=''){
$query30 = "select TITLE, FORUM_ID from {$db_prefix}posts WHERE TOPIC_ID='$location_topic' AND TITLE!=''" ;
$result30 = mysql_query($query30) or die("list.php - Error in query: $query30") ;                                  
while ($results30 = mysql_fetch_array($result30)){
$title = $results30['TITLE'];
$forum_id = $results30['FORUM_ID'];
}
		// PERMISSIONS!!! Can they view this forum???

		$can_read_topics="0";
		$can_view_forum="0";

		$query31 = "select CAN_READ_TOPICS, CAN_VIEW_FORUM from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;
		$result31 = mysql_query($query31) or die("online.php - Error in query: $query31") ;                                  
		while ($results31 = mysql_fetch_array($result31)){
		$can_read_topics = $results31['CAN_READ_TOPICS'];
		$can_view_forum = $results31['CAN_VIEW_FORUM'];
		}

$title=strip_slashes($title);

$topic_title = topic_title($location_topic);

template_hook("pages/list.template.php", "6");

}
elseif($location_forum!=''){
$query3 = "select NAME from {$db_prefix}categories WHERE ID='$location_forum'" ;
$result3 = mysql_query($query3) or die("list.php - Error in query: $query3") ;                                  
$forum_name = mysql_result($result3, 0);

$forum_title = forum_title($location_forum);

template_hook("pages/list.template.php", "7");

}
elseif($location_page!=''){

// Format the pages they are viewing...

$location_page_text = location_page("list");

template_hook("pages/list.template.php", "8");

}

$query2167 = "select ROLE from {$db_prefix}members WHERE ID='$id'" ;
$result2167 = mysql_query($query2167) or die("topic.php - Error in query: $query2167") ;                                  
$users_role = mysql_result($result2167, 0);

	// PERMISSIONS! Can the recipient PM???!!!

		$query2168 = "select CAN_PM from {$db_prefix}groups WHERE GROUP_ID='$users_role'" ;
		$result2168 = mysql_query($query2168) or die("topic.php - Error in query: $query2168") ;                                  
		$can_pm_this_member = mysql_result($result2168, 0);

template_hook("pages/list.template.php", "9");

}

template_hook("pages/list.template.php", "10");

if ($_GET['limit']==''){

$limit=0;
}
elseif($_GET['limit']<='0'){
$limit=0;
}
else {
$limit=escape_string($_GET['limit']) - 1;
$limit=($limit*$list_posts);
}

$pages=ceil($number_of_members/$list_posts);
$pages_end = $pages;

if ($pages <= '1'){
}
else{

template_hook("pages/list.template.php", "18");

}

}

else{

// Get page numbers...

$group=$_GET['group'];
$group=escape_string(abs($group));

$query3 = "select ID from {$db_prefix}sessions ORDER BY TIME desc";
$result3 = mysql_query($query3) or die("list.php - Error in query: $query3") ;                                   
$number_of_members=mysql_num_rows($result3);

if ($_GET['limit']==''){

$limit=0;
}
elseif($_GET['limit']<='0'){
$limit=0;
}
else {
$limit=escape_string($_GET['limit']) - 1;
$limit=($limit*$list_posts);
}

$pages=($number_of_members/$list_posts);
$pages_end = $pages;

if ($pages <= '1'){
}
else{

template_hook("pages/list.template.php", "11");

}

template_hook("pages/list.template.php", "12");

$location_forum="";
$location_topic="";
$location_page="";
$time="0";

$query31 = "select ID, LOCATION_FORUM, LOCATION_TOPIC, LOCATION_PAGE, TIME from {$db_prefix}sessions ORDER BY TIME desc LIMIT $limit, $list_posts";
$result31 = mysql_query($query31) or die("list.php - Error in query: $query31") ;                                  
while ($results31 = mysql_fetch_array($result31)){
$id = $results31['ID'];
$time = $results31['TIME'];

$time = format_date($time);

	$count_members_alt=$count_members_alt+1;

	$check_odd = checkNum($count_members_alt);

	if ($check_odd===TRUE){
		$alt_td_class="";
	}
	else{
		$alt_td_class="-alt";	
	}

$location_forum = $results31['LOCATION_FORUM'];
$location_topic = $results31['LOCATION_TOPIC'];
$location_page = $results31['LOCATION_PAGE'];

if ($time!='0' && $location_forum=='' && $location_topic=='' && $location_page==''){
$location_page="index";
}

// Show member name...
if ($id > '0'){
$query2 = "select NAME, ROLE, NATIONALITY from {$db_prefix}members WHERE ID='$id'" ;
$result2 = mysql_query($query2) or die("list.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$name = strip_slashes($results2['NAME']);
$group_role = $results2['ROLE'];
$nationality = $results2['NATIONALITY'];
}
}

if ($id <= '0'){
$group_role="4";
$nationality="0";
}

if ($id =='0'){
$name="Guest";
}
elseif ($id < '0'){

$query21 = "select BOT_NAME from {$db_prefix}bots WHERE BOT_ID='$id'" ;
$result21 = mysql_query($query21) or die("board.php - Error in query: $query21") ;                                  
$name = mysql_result($result21, 0);
}

template_hook("pages/list.template.php", "5");

if ($location_topic!=''){
$query30 = "select TITLE, FORUM_ID from {$db_prefix}posts WHERE TOPIC_ID='$location_topic' AND TITLE!=''" ;
$result30 = mysql_query($query30) or die("list.php - Error in query: $query30") ;                                  
while ($results30 = mysql_fetch_array($result30)){
$title = $results30['TITLE'];
$forum_id = $results30['FORUM_ID'];

$title=strip_slashes($title);
}
		// PERMISSIONS!!! Can they view this forum???

		$can_read_topics="0";
		$can_view_forum="0";

		$query312 = "select CAN_READ_TOPICS, CAN_VIEW_FORUM from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;
		$result312 = mysql_query($query312) or die("online.php - Error in query: $query312") ;                                  
		while ($results312 = mysql_fetch_array($result312)){
		$can_read_topics = $results312['CAN_READ_TOPICS'];
		$can_view_forum = $results312['CAN_VIEW_FORUM'];
		}

$topic_title = topic_title($location_topic);
		
template_hook("pages/list.template.php", "6");

}

elseif($location_forum!=''){
$query35 = "select NAME from {$db_prefix}categories WHERE ID='$location_forum'" ;
$result35 = mysql_query($query35) or die("list.php - Error in query: $query35") ;                                  
$forum_name = mysql_result($result35, 0);

$forum_title = forum_title($location_forum);

template_hook("pages/list.template.php", "7");

}

elseif($location_page!='' OR $location_forum=='' && $location_topic=='' && $location_page==''){
// Format the pages they are viewing...

$location_page_text = location_page("list");

template_hook("pages/list.template.php", "8");

}

$query2167 = "select ROLE from {$db_prefix}members WHERE ID='$id'" ;
$result2167 = mysql_query($query2167) or die("topic.php - Error in query: $query2167") ;                                  
$users_role = mysql_result($result2167, 0);

if ($id <= '0'){
$users_role="4";
}

	// PERMISSIONS! Can the recipient PM???!!!

		$query2168 = "select CAN_PM from {$db_prefix}groups WHERE GROUP_ID='$users_role'" ;
		$result2168 = mysql_query($query2168) or die("topic.php - Error in query: $query2168") ;                                  
		$can_pm_this_member = mysql_result($result2168, 0);

template_hook("pages/list.template.php", "9");

}

template_hook("pages/list.template.php", "10");

if ($_GET['limit']==''){

$limit=0;
}
elseif($_GET['limit']<='0'){
$limit=0;
}
else {
$limit=escape_string($_GET['limit']) - 1;
$limit=($limit*$list_posts);
}

$pages=($number_of_members/$list_posts);
$pages_end = $pages;

if ($pages <= '1'){
}
else{

template_hook("pages/list.template.php", "11");

}

}

template_hook("pages/list.template.php", "end");

?>