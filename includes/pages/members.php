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
|   members.php - shows member profile page
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();

}



template_hook("pages/members.template.php", "start");



$id=escape_string($_GET['id']);

if (is_numeric($id) && $id > '0'){

	$query2 = "select ID, NAME, EMAIL, LOCATION, ROLE, AVATAR, REMOTE_AVATAR, SIGNATURE, NATIONALITY, USERTITLE, WARN_LEVEL, MSN, AOL, YAHOO, SKYPE, XBOX, WII, PS3, LAST_ONLINE, USER_POSTS from {$db_prefix}members WHERE ID='$id'" ;
	$result2 = mysql_query($query2) or die("members.php - Error in query: $query2") ;  
	$does_exist = mysql_num_rows($result2);

}
else{
	$does_exist="0";
}


if ($does_exist=='0'){



	lb_redirect("index.php?page=error&error=26","error/26");



}                                

while ($results2 = mysql_fetch_array($result2)){

$id = $results2['ID'];

$name = $results2['NAME'];

$users_role = $results2['ROLE'];

$location = strip_slashes($results2['LOCATION']);

$avatar = $results2['AVATAR'];

$remote_avatar = $results2['REMOTE_AVATAR'];

	if ($remote_avatar =='0'){
		$avatar = $lb_domain."/".$avatar;
	}

$signature = $results2['SIGNATURE'];
$nationality = $results2['NATIONALITY'];
$usertitle = strip_slashes($results2['USERTITLE']);
$warn_level = $results2['WARN_LEVEL'];
$msn = strip_slashes($results2['MSN']);
$aol = strip_slashes($results2['AOL']);
$yahoo = strip_slashes($results2['YAHOO']);
$skype = strip_slashes($results2['SKYPE']);
$xbox = strip_slashes($results2['XBOX']);
$wii = strip_slashes($results2['WII']);
$ps3 = strip_slashes($results2['PS3']);

$last_online = $results2['LAST_ONLINE'];
$number_posts	= $results2['USER_POSTS'];
$num_posts	= number_format($results2['USER_POSTS']);

$last_online = format_date($last_online); 

$signature=strip_slashes($signature);

}



if ($_COOKIE['lb_name']==''&& $my_id < '1'){

// hide all of this from guests...

$msn = "";

$aol = "";

$yahoo = "";

$skype = "";

$xbox = "";

$wii = "";

$ps3 = "";

}



$query21 = "select ID from {$db_prefix}sessions WHERE ID='$id'" ;

$result21 = mysql_query($query21) or die("members.php - Error in query: $query21") ;                                  

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





// Get group color

$query54 = "select CAN_CHANGE_SITE_SETTINGS, CAN_CHANGE_FORUM_SETTINGS, GROUP_ICON, GROUP_NAME, GROUP_COLOR from {$db_prefix}groups WHERE GROUP_ID='$users_role'" ;
$result54 = mysql_query($query54) or die("topic.php - Error in query: $query54") ;                                  
while ($results54 = mysql_fetch_array($result54)){
$user_can_change_site_settings = $results54['CAN_CHANGE_SITE_SETTINGS'];
$user_can_change_forum_settings = $results54['CAN_CHANGE_FORUM_SETTINGS'];
$user_group_icon = $results54['GROUP_ICON'];
$user_group_name = strip_slashes($results54['GROUP_NAME']);
$user_group_color = strip_slashes($results54['GROUP_COLOR']);

}

// show group icon
if ($user_group_icon=='1'){
	$group_img = $groups_1_img;
}
elseif ($user_group_icon=='2'){
	$group_img = $groups_2_img;
}
elseif ($user_group_icon=='3'){
	$group_img = $groups_3_img;
}
elseif ($user_group_icon=='4'){
	$group_img = $groups_4_img;
}
elseif ($user_group_icon=='5'){
	$group_img = $groups_5_img;
}
elseif ($user_group_icon=='6'){
	$group_img = $groups_6_img;
}
elseif ($user_group_icon=='7'){
	$group_img = $groups_7_img;
}
elseif ($user_group_icon=='8'){
	$group_img = $groups_8_img;
}
elseif ($user_group_icon=='9'){
	$group_img = $groups_9_img;
}
elseif ($user_group_icon=='10'){
	$group_img = $groups_10_img;
}
else{
}

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



template_hook("pages/members.template.php", "1");



$start_pip = "0";

while ($start_pip < $rank_pips){



template_hook("pages/members.template.php", "36");



$start_pip = $start_pip + 1;

}



template_hook("pages/members.template.php", "37");



template_hook("pages/members.template.php", "2");

template_hook("pages/members.template.php", "16");


// Get total number of posts...



$query2912 = "select ID from {$db_prefix}posts" ;

$result2912 = mysql_query($query2912) or die("members.php - Error in query: $query2912");

$num_posts_total=mysql_num_rows($result2912);

$num_post_total=number_format($num_posts_total);


$query2912 = "select ID from {$db_prefix}posts WHERE MEMBER='$id'" ;

$result2912 = mysql_query($query2912) or die("members.php - Error in query: $query2912");

$number_posts=mysql_num_rows($result2912);


$percentage_of_posts=round(($number_posts/$num_posts_total)*100);





$query_active = "select FORUM_ID, COUNT(ID) AS NUMBER from {$db_prefix}posts WHERE MEMBER='$id' GROUP BY forum_id ORDER BY NUMBER desc LIMIT 1" ;

$result_active = mysql_query($query_active) or die("members.php - Error in query: $query_active") ;                                  

while ($results_active = mysql_fetch_array($result_active)){

$most_active = $results_active['FORUM_ID'];

$number = $results_active['NUMBER'];

}



$percentage_of_posts2=round(($number/$number_posts)*100);



$query_forum = "select NAME from {$db_prefix}categories WHERE ID='$most_active'" ;

$result_forum = mysql_query($query_forum) or die("members.php - Error in query: $query_forum") ;                                  

$forum_name = mysql_result($result_forum, 0);



	// PERMISSIONS!!! Can they view this forum???



		$can_view_forum="0";



		$query3 = "select CAN_VIEW_FORUM from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$most_active'" ;

		$result3 = mysql_query($query3) or die("board.php - Error in query: $query") ;                                  

		$can_view_forum = mysql_result($result3, 0);





	// PERMISSIONS! Can the recipient PM???!!!



		$query2168 = "select CAN_PM from {$db_prefix}groups WHERE GROUP_ID='$users_role'" ;

		$result2168 = mysql_query($query2168) or die("members.php - Error in query: $query2168") ;                                  

		$can_pm_this_member = mysql_result($result2168, 0);



$content=$signature;



// BB Parse...

if (file_exists("themes/$theme/scripts/php/parse.php")){
	include "themes/$theme/scripts/php/parse.php";
}
else{
	include "scripts/php/parse.php";				
}



$lang['members_posts_percentage'] = str_replace("<%1>", $percentage_of_posts, $lang['members_posts_percentage']);

$lang['members_forum_percentage'] = str_replace("<%1>", $percentage_of_posts2, $lang['members_forum_percentage']);

$forum_title = forum_title($most_active);

$query = mysql_query("SELECT `friends` FROM `{$db_prefix}members` WHERE `id`='{$my_id}'");
$friends = mysql_fetch_array($query);
$friends = explode(',', $friends['friends']);
	
if (in_array($id, $friends))
	$is_friend = true;

template_hook("pages/members.template.php", "5");



template_hook("pages/members.template.php", "end");



?>