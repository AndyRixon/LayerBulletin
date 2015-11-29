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
|   index.php - the main forum index
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

global $lb_domain, $theme;

template_hook("forums/index.template.php", "start");

$query2 = "select ID, FORUM_ORDER, NAME from {$db_prefix}categories WHERE PARENT='0' ORDER BY FORUM_ORDER, ID asc" ;
$result2 = mysql_query($query2) or die("index.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$parent_id = $results2['ID'];
$collapse_id = $results2['ID'];
$parent_name = $results2['NAME'];

$parent_name=strip_slashes($parent_name);

$can_view_parent="0";

// Check that the number of child forums
// is > 0, otherwise there is no point
// showing the parent is there?


$query_child = "select ID from {$db_prefix}categories WHERE PARENT='$parent_id' ORDER BY ID asc" ;
$result_child = mysql_query($query_child) or die("index.php - Error in query: $query_child") ;                                  
while ($results_child = mysql_fetch_array($result_child)){
$child_id = $results_child['ID'];

// Check that they've got permission to view it...

$query_view = "select CAN_VIEW_FORUM from {$db_prefix}permissions WHERE FORUM_ID='$child_id' AND GROUP_ID='$role'" ;
$result_view = mysql_query($query_view) or die("index.php - Error in query: $query_view");
$can_view_forum = mysql_result($result_view, 0);                              

if ($can_view_forum!='0'){
$can_view_parent="1";
}
}

if ($can_view_parent!='0'){

$forum_title = forum_title($parent_id);

$forum_state = "forum$parent_id";


template_hook("forums/index.template.php", "1");

// set forum count to zero
$count_forums="0";

$query21 = "select ID, NAME, DESCRIPTION, READ_ONLY, REDIRECT_URL from {$db_prefix}categories WHERE PARENT='$parent_id' ORDER BY FORUM_ORDER, ID asc" ;
$result21 = mysql_query($query21) or die("index.php - Error in query: $query21") ;                                  
while ($results21 = mysql_fetch_array($result21)){
$forum_id = $results21['ID'];
$forum_name = $results21['NAME'];
$forum_description = $results21['DESCRIPTION'];
$read_only = $results21['READ_ONLY'];
$redirect_url = $results21['REDIRECT_URL'];

$forum_name=strip_slashes($forum_name);

$forum_description = str_replace("<p>", "", "$forum_description");
$forum_description = str_replace("</p>", "", "$forum_description");
$forum_description = strip_slashes($forum_description);


		// PERMISSIONS!!! Can they view this forum???

		$can_view_forum="0";
		$can_read_topics="0";

		$query3 = "select CAN_VIEW_FORUM, CAN_READ_TOPICS from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;
		$result3 = mysql_query($query3) or die("index.php - Error in query: $query3") ;                                  
		while ($results3 = mysql_fetch_array($result3)){
		$can_view_forum = $results3['CAN_VIEW_FORUM'];
		$can_read_topics = $results3['CAN_READ_TOPICS'];
		}

if ($can_view_forum=='0'){
}
else{

$count_forum=$count_forum+1;

$check_odd = checkNum($count_forum);

if ($check_odd===TRUE){
	$alt_td_class="";
}
else{
	$alt_td_class="-alt";	
}

template_hook("forums/index.template.php", "2");

if ($read_only=='0'){

		if (isset($lb_name)){

			$unread_posts="0";

					$query212 = "select TOPIC_ID from {$db_prefix}posts WHERE FORUM_ID='$forum_id' AND LAST_POST_TIME > '$read_all_posts' AND LAST_POST_TIME > '$register_date' AND APPROVED='1' AND TITLE!='' ORDER BY TOPIC_ID desc" ;
					$result212 = mysql_query($query212) or die("header.php - Error in query: $query212");
					while ($results212 = mysql_fetch_array($result212)){
						$topic_check_id = $results212['TOPIC_ID'];
	
						$query2118 = "select READ_TIME from {$db_prefix}posts_read WHERE MEMBER_ID='$my_id' AND TOPIC_ID='$topic_check_id'";
						$result2118 = mysql_query($query2118) or die("header.php - Error in query: $query2118");
						$read_count = mysql_num_rows($result2118);
						
						if ($read_count=='0'){
							$read_results="0";
						}
						else{
							$read_results = mysql_result($result2118, 0);
						}
								
							// now check posts...
							
							$query2129 = "select ID from {$db_prefix}posts WHERE TOPIC_ID='$topic_check_id' AND TIME > '$read_results' AND TIME > '$read_all_posts' AND APPROVED='1' AND MEMBER!='$my_id'";
							$result2129 = mysql_query($query2129) or die("header.php - Error in query: $query2129");
							while ($results2129 = mysql_fetch_array($result2129)){
								$post_id = $results2129['ID'];	
							
								$unread_posts	= $unread_posts + 1;

							}

			$new_posts=number_format($unread_posts);

		}

							$query_subx = "select ID from {$db_prefix}categories WHERE PARENT='$forum_id' ORDER BY FORUM_ORDER, ID asc" ;
							$result_subx = mysql_query($query_subx) or die("index.php - Error in query: $query_subx");                                 
							while ($results_subx = mysql_fetch_array($result_subx)){
							$sub_idx = $results_subx['ID'];

									// PERMISSIONS!!! Can they view this forum???

									$can_view_forum="0";

									$query3x = "select CAN_VIEW_FORUM from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$sub_idx'" ;
									$result3x = mysql_query($query3x) or die("index.php - Error in query: $query3x") ;                                  
									$can_view_forumx = mysql_result($result3x, 0);
									
									if ($can_view_forumx=='1'){

					$query212x = "select TOPIC_ID from {$db_prefix}posts WHERE FORUM_ID='$sub_idx' AND LAST_POST_TIME > '$read_all_posts' AND LAST_POST_TIME > '$register_date' AND APPROVED='1' ORDER BY TOPIC_ID desc" ;
					$result212x = mysql_query($query212x) or die("header.php - Error in query: $query212x");
					while ($results212x = mysql_fetch_array($result212x)){
						$topic_check_idx = $results212x['TOPIC_ID'];
	
						$query2118x = "select READ_TIME from {$db_prefix}posts_read WHERE MEMBER_ID='$my_id' AND TOPIC_ID='$topic_check_idx'";
						$result2118x = mysql_query($query2118x) or die("header.php - Error in query: $query2118x");
						$read_countx = mysql_num_rows($result2118x);
						
						if ($read_countx=='0'){
							$read_resultsx="0";
						}
						else{
							$read_resultsx = mysql_result($result2118x, 0);
						}
								
							// now check posts...
							
							$query2129x = "select ID from {$db_prefix}posts WHERE TOPIC_ID='$topic_check_idx' AND TIME > '$read_resultsx' AND TIME > '$read_all_posts' AND APPROVED='1' AND MEMBER!='$my_id'";
							$result2129x = mysql_query($query2129x) or die("header.php - Error in query: $query2129x");
							while ($results2129x = mysql_fetch_array($result2129x)){
								$post_idx = $results2129x['ID'];	
							
								$unread_posts	= $unread_posts + 1;

							}
							
							
							$query_sub = "select ID from {$db_prefix}categories WHERE PARENT='$forum_id' ORDER BY FORUM_ORDER, ID asc" ;
							$result_sub = mysql_query($query_sub) or die("index.php - Error in query: $query_sub");                                 
							while ($results_sub = mysql_fetch_array($result_sub)){
							$sub_id = $results_sub['ID'];

									// PERMISSIONS!!! Can they view this forum???

									$can_view_forum="0";

									$query3 = "select CAN_VIEW_FORUM from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$sub_id'" ;
									$result3 = mysql_query($query3) or die("index.php - Error in query: $query3") ;                                  
									$can_view_forum = mysql_result($result3, 0);	
							
							
					}

			$new_posts=number_format($unread_posts);

		}									
							
					}		
					}		

}
}
$forum_description=str_replace("\n", "<br />", $forum_description);
$forum_description = strip_slashes($forum_description);

// check for sub-forums..

$query_sub = "select null from {$db_prefix}categories AS c, {$db_prefix}permissions AS p WHERE c.PARENT='$forum_id' AND p.GROUP_ID='$role' AND p.FORUM_ID=c.ID AND p.CAN_VIEW_FORUM='1'";
$result_sub = mysql_query($query_sub) or die("index.php - Error in query: $query_sub") ; 
$count_sub=mysql_num_rows($result_sub);   

$forum_title = forum_title($forum_id);

template_hook("forums/index.template.php", "4");

if ($count_sub > 0)
{

$count_sub_forums="0";
$query_sub = "select ID, NAME from {$db_prefix}categories WHERE PARENT='$forum_id' ORDER BY FORUM_ORDER, ID asc" ;
$result_sub = mysql_query($query_sub) or die("index.php - Error in query: $query_sub");                                
while ($results_sub = mysql_fetch_array($result_sub)){
$sub_id = $results_sub['ID'];
$sub_name = $results_sub['NAME'];

$sub_name=strip_slashes($sub_name);

		// PERMISSIONS!!! Can they view this forum???

		$can_view_forum="0";

		$query3 = "select CAN_VIEW_FORUM from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$sub_id'" ;
		$result3 = mysql_query($query3) or die("index.php - Error in query: $query3") ;                                  
		$can_view_forum = mysql_result($result3, 0);

$count_sub_forums++;		
	
if ($can_view_forum=='1'){		
	
$forum_title = forum_title($sub_id);	
	
template_hook("forums/index.template.php", "5");

}

}
}

$time="";
$title="";
$name="";


$query211 = "select CAT_TOPICS, CAT_POSTS, CAT_LATEST_ID, CAT_LATEST_TOPIC, CAT_LATEST_TITLE, CAT_LATEST_TIME, CAT_LATEST_MEMBER_ID, CAT_LATEST_MEMBER_NAME from {$db_prefix}categories WHERE ID ='$forum_id'" ;
$result211 = mysql_query($query211) or die("index.php - Error in query: $query211") ;                                  
while ($results211 = mysql_fetch_array($result211)){
$topics = number_format($results211['CAT_TOPICS']);
$posts = number_format($results211['CAT_POSTS']);
$id = $results211['CAT_LATEST_ID'];
$member = $results211['CAT_LATEST_MEMBER_ID'];
$name = $results211['CAT_LATEST_MEMBER_NAME'];
$title = $results211['CAT_LATEST_TITLE'];
$time = $results211['CAT_LATEST_TIME'];

if ($time=='0' OR $time==''){
$time="";
}
else{
$time = format_date($time); 
}
 
$topic_id = $results211['CAT_LATEST_TOPIC'];

$title=strip_slashes($title);

}

template_hook("forums/index.template.php", "6");

$topics="0";
$posts="0";
$title="";
$name="";
$time="";

template_hook("forums/index.template.php", "7");

}

}

template_hook("forums/index.template.php", "8");
}
}

template_hook("forums/index.template.php", "9");

template_hook("forums/index.template.php", "end");

?>
