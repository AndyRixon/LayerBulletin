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
|   online.php - Displays forum information on index
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}
  
template_hook("forums/online.template.php", "start");
  
$posts=number_format($stats_posts);                              
$topics=number_format($stats_topics);                                  
$members=number_format($stats_members);

$member_id = $stats_member_id;
$name = $stats_member_name;

$id = $stats_post_id;
$topic_id = $stats_post_topic;
$forum_id = $stats_post_forum;
$topic_time = format_date($stats_post_time); 
$title=strip_slashes($stats_post_title);

		// PERMISSIONS!!! Can they view this forum???

		$can_read_topics="0";
		$can_view_forum="0";

		$query3 = "select CAN_READ_TOPICS, CAN_VIEW_FORUM from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;
		$result3 = mysql_query($query3) or die("online.php - Error in query: $query3") ;                                  
		while ($results3 = mysql_fetch_array($result3)){
		$can_read_topics = $results3['CAN_READ_TOPICS'];
		$can_view_forum = $results3['CAN_VIEW_FORUM'];
		}

$lang['online_stats_posts'] = str_replace("<%posts>","$posts",$lang['online_stats_posts']);
$lang['online_stats_posts'] = str_replace("<%topics>","$topics",$lang['online_stats_posts']);
$lang['online_stats_posts'] = str_replace("<%1>","$members",$lang['online_stats_posts']);

$time = format_date(time(), '%A, %b %d, %Y %R');

// Find all online...

$query2 = "select ID from {$db_prefix}sessions WHERE ID<='0'" ;
$result2 = mysql_query($query2) or die("online.php - Error in query: $query2") ;                                  
$guests=mysql_num_rows($result2);

$query3 = "select ID from {$db_prefix}sessions WHERE ID>'0'" ;
$result3 = mysql_query($query3) or die("online.php - Error in query: $query3") ;                                  
$members=mysql_num_rows($result3);


$lang['online_stats_online'] = str_replace("<%guests>","<strong>$guests</strong>",$lang['online_stats_online']);
$lang['online_stats_online'] = str_replace("<%members>","<strong>$members</strong>",$lang['online_stats_online']);

template_hook("forums/online.template.php", "1");

template_hook("forums/online.template.php", "3");

$count_online_count = 1;

$query2			= "select ID, LOCATION_FORUM, LOCATION_TOPIC, LOCATION_PAGE, TIME from {$db_prefix}sessions WHERE ID!='0' ORDER BY TIME desc";
$result2		= mysql_query($query2) or die("online.php - Error in query: $query2");
$count_online	= mysql_num_rows($result2);

while ($results2 = mysql_fetch_array($result2))
{
	$id				= $results2['ID'];
	$location_forum	= $results2['LOCATION_FORUM'];
	$location_topic	= $results2['LOCATION_TOPIC'];
	$location_page	= $results2['LOCATION_PAGE'];
	$time			= format_date($results2['TIME']);


	/*// Get name...

	$query21 = "select NAME, ROLE from {$db_prefix}members WHERE ID='$id'" ;
	$result21 = mysql_query($query21) or die("online.php - Error in query: $query21") ;                                  
	while ($results21 = mysql_fetch_array($result21)){
	$name = $results21['NAME'];

	$name = strip_slashes($name);

	$role = $results21['ROLE'];
	}*/

	if ($count_online_count == $count_online)
	{
		if ($id < 0)
		{
			$query21	= "select BOT_NAME from {$db_prefix}bots WHERE BOT_ID='$id'" ;
			$result21	= mysql_query($query21) or die("board.php - Error in query: $query21") ;                                  
			$name		= mysql_result($result21, 0);
			$role		= 3;

			template_hook("forums/online.template.php", 4);
		}
		else
		{
			template_hook("forums/online.template.php", 5);
		}

	}
	else
	{
		++$count_online_count;

		if ($id < 0)
		{
			$query21	= "select BOT_NAME from {$db_prefix}bots WHERE BOT_ID='$id'" ;
			$result21	= mysql_query($query21) or die("board.php - Error in query: $query21") ;                                  
			$name		= mysql_result($result21, 0);
			$role		= 3;

			template_hook("forums/online.template.php", 6);
		}
		else
		{
			template_hook("forums/online.template.php", 7);
		}
	}
}

if ($online_yesterday == 1)
{
	// Now show last 24 hours...

	$current_time	= time();
	$yesterday		= $current_time - 86400;

	$query25		= "select ID from {$db_prefix}members WHERE LAST_ONLINE > '$yesterday'" ;
	$result25		= mysql_query($query25) or die("online.php - Error in query: $query25"); 
	$count_online	= mysql_num_rows($result25);
	$members_today	= number_format($count_online);

	$lang['online_stats_today'] = str_replace("<%members>", $members_today, $lang['online_stats_today']);

	template_hook("forums/online.template.php", 8);

	$count_online_count = 1;

	$query25		= "select ID, LAST_ONLINE from {$db_prefix}members WHERE LAST_ONLINE > '$yesterday' ORDER BY NAME asc" ;
	$result25		= mysql_query($query25) or die("online.php - Error in query: $query25"); 
	$count_online	= mysql_num_rows($result25);
	
	while ($results25 = mysql_fetch_array($result25))
	{
		$id		= $results25['ID'];
		$time	= format_date($results25['LAST_ONLINE']);

		if ($count_online_count == $count_online)
		{
			template_hook("forums/online.template.php", "9");
		}
		else
		{
			++$count_online_count;
			template_hook("forums/online.template.php", "10");
		}
	}
}

// Check in case that's the most we've EVER had! OMG OMG OMG!

$query9			= "select MOST_ONLINE from {$db_prefix}settings" ;
$result9		= mysql_query($query9) or die("online.php - Error in query: $query9");
$most_online	= mysql_result($result9, 0);

$query31		= "select ID from {$db_prefix}sessions" ;
$result31		= mysql_query($query31) or die("online.php - Error in query: $query31");
$total_people	= mysql_num_rows($result31);

if ($total_people > $most_online)
{
	$time = time();
	mysql_query("UPDATE {$db_prefix}settings SET most_online='$total_people', most_online_date='$time'");
	
	# Delete cache
	$Cache->delete('settings');
}

$query9		= "select MOST_ONLINE, MOST_ONLINE_DATE from {$db_prefix}settings";
$result9	= mysql_query($query9) or die("online.php - Error in query: $query9");

while ($results9 = mysql_fetch_array($result9))
{
	$most_online		= $results9['MOST_ONLINE'];
	$most_online_date	= format_date($results9['MOST_ONLINE_DATE']);
}

$lang['online_stats_most'] = str_replace("<%1>", $most_online, $lang['online_stats_most']);
$lang['online_stats_most'] = str_replace("<%date>", $most_online_date, $lang['online_stats_most']);

template_hook("forums/online.template.php", "11");

template_hook("forums/online.template.php", "end");

?>