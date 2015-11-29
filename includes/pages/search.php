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
|   search.php - Search page
 
*/



if (!defined('LB_RUN')){

	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";

	exit();

}

template_hook("pages/search.template.php", "start");

$forum_form=implode("&forums[]=",$_GET['forums']);
$forum_form = htmlentities($forum_form);
$forum_form = str_replace("&nbsp;", "&", $forum_form);
$forum_form = escape_string($forum_form);

$strlen = strlen($forum_form);

$num_forums="0";

if ($strlen != 0)
	$num_forums = 1;

$_GET['topic'] = escape_string($_GET['topic']);

if ($_GET['area']=='topics'){



$member_id = (int) $_GET['search'];

$sql989 = "SELECT NAME FROM {$db_prefix}members WHERE ID='$member_id'";
$sql_result989 = mysql_query($sql989) or die ("search.php - 1 Error in query: $sql989");
$search_name = mysql_result($sql_result989, 0);



template_hook("pages/search.template.php", "1");



// Get page numbers...

$member_id = (int) $_GET['search'];

$sql989 = "SELECT ID FROM {$db_prefix}posts WHERE MEMBER='$member_id' AND TITLE!='' AND APPROVED='1' ORDER BY TOPIC_ID desc";
$sql_result989 = mysql_query($sql989) or die ("search.php - 2 Error in query: $sql989");                                 
$number_of_posts=mysql_num_rows($sql_result989);



if ($_GET['limit']==''){

$limit=0;

}

elseif($_GET['limit']=='0'){

$limit=0;

}

else {

$limit=escape_string(htmlentities($_GET['limit'])) - 1;

$limit=($limit*$list_posts);

}

$pages=ceil($number_of_posts/$list_posts);

$pages_end = $pages;

if ($pages <= '1'){

}

else{



template_hook("pages/search.template.php", "4");



}



$sql989 = "SELECT MEMBER, TIME, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, TITLE, TOPIC_ID FROM {$db_prefix}posts WHERE MEMBER='$member_id' AND TITLE!='' AND APPROVED='1' ORDER BY TOPIC_ID desc LIMIT $limit, $list_posts";

$sql_result989 = mysql_query($sql989) or die ("search.php - 3 Error in query: $sql989");

while($row = mysql_fetch_array($sql_result989)) {

$content = strip_slashes($row['CONTENT']);

			$pattern = '|[[\/\!]*?[^\[\]]*?]|si';
			$replace = '';
			$content = preg_replace($pattern, $replace, $content);
		
			$content = substr($content,0,160); 
			$content = $content."...";

$post_id = $row['ID'];

$topic_id = $row['TOPIC_ID'];

$member = $row['MEMBER'];

$time = $row['TIME'];

$forum_id = $row['FORUM_ID'];



$time = format_date($row['TIME'], '%d %b %y');



$edit_time = $row['EDIT_TIME'];



$edit_time = format_date($edit_time); 



$edit_member = $row['EDIT_MEMBER'];

$title = $row['TITLE'];

$title=strip_slashes($title);



		$can_read_topics="0";



		$query3 = "select CAN_READ_TOPICS from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;

		$result3 = mysql_query($query3) or die("search.php - 5 Error in query: $query3") ;                                  

		$can_read_topics = mysql_result($result3, 0);



if ($can_read_topics=='1'){

template_hook("pages/search.template.php", "5");

}

}

// Get page numbers...



$member_id=htmlentities($_GET['search']);

$member_id=escape_string($member_id);



$sql989 = "SELECT ID FROM {$db_prefix}posts WHERE MEMBER='$member_id' AND TITLE!='' AND APPROVED='1' ORDER BY TOPIC_ID desc";

$sql_result989 = mysql_query($sql989) or die ("search.php - 2 Error in query: $sql989");                                 

$number_of_posts=mysql_num_rows($sql_result989);



if ($_GET['limit']==''){

$limit=0;

}

elseif($_GET['limit']=='0'){

$limit=0;

}

else {

$limit=escape_string(htmlentities($_GET['limit'])) - 1;

$limit=($limit*$list_posts);

}

$pages=ceil($number_of_posts/$list_posts);

$pages_end = $pages;

if ($pages <= '1'){

}

else{



template_hook("pages/search.template.php", "4");



}

}

elseif($_GET['area']=='posts'){



$member_id=htmlentities($_GET['search']);

$member_id=escape_string($member_id);



$sql989 = "SELECT NAME FROM {$db_prefix}members WHERE ID='$member_id'";

$sql_result989 = mysql_query($sql989) or die ("search.php - 6 Error in query: $sql989");

$search_name = mysql_result($sql_result989, 0);



template_hook("pages/search.template.php", "10");



// Get page numbers...



$member_id=htmlentities($_GET['search']);

$member_id=escape_string($member_id);



$sql989 = "SELECT ID FROM {$db_prefix}posts WHERE MEMBER='$member_id' AND TITLE='' AND APPROVED='1' ORDER BY ID desc";

$sql_result989 = mysql_query($sql989) or die ("search.php - 7 Error in query: $sql989");                                 

$number_of_posts=mysql_num_rows($sql_result989);



if ($_GET['limit']==''){

$limit=0;

}

elseif($_GET['limit']=='0'){

$limit=0;

}

else {

$limit=escape_string(htmlentities($_GET['limit'])) - 1;

$limit=($limit*$list_posts);

}

$pages=ceil($number_of_posts/$list_posts);

$pages_end = $pages;

if ($pages <= '1'){

}

else{



template_hook("pages/search.template.php", "11");



}



$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER FROM {$db_prefix}posts WHERE MEMBER='$member_id' AND TITLE='' AND APPROVED='1' ORDER BY ID desc LIMIT $limit, $list_posts";

$sql_result989 = mysql_query($sql989) or die ("search.php - 8 Error in query: $sql989");

while($row = mysql_fetch_array($sql_result989)) {

$content = strip_slashes($row['CONTENT']);

			$pattern = '|[[\/\!]*?[^\[\]]*?]|si';
			$replace = '';
			$content = preg_replace($pattern, $replace, $content);
		
			$content = substr($content,0,160); 
			$content = $content."...";

$post_id = $row['ID'];

$member = $row['MEMBER'];

$time = $row['TIME'];

$forum_id = $row['FORUM_ID'];

$topic_id = $row['TOPIC_ID'];



$time = format_date($row['TIME'], '%d %b %y');



$edit_time = $row['EDIT_TIME'];



$edit_time = format_date($edit_time); 



$edit_member = $row['EDIT_MEMBER'];



// Get the title...

$sql979 = "SELECT TITLE FROM {$db_prefix}posts WHERE TITLE!='' AND TOPIC_ID='$topic_id' AND APPROVED='1'";

$sql_result979 = mysql_query($sql979) or die ("search.php - 9 Error in query: $sql979");

$title = mysql_result($sql_result979, 0);

$title=strip_slashes($title);



		$can_read_topics="0";



		$query3 = "select CAN_READ_TOPICS from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;

		$result3 = mysql_query($query3) or die("search.php - 10 Error in query: $query3") ;                                  

		$can_read_topics = mysql_result($result3, 0);



if ($can_read_topics=='1'){
template_hook("pages/search.template.php", "5");
}

}



// Get page numbers...



$member_id=htmlentities($_GET['search']);

$member_id=escape_string($member_id);



$sql989 = "SELECT ID FROM {$db_prefix}posts WHERE MEMBER='$member_id' AND TITLE='' AND APPROVED='1' ORDER BY ID desc";

$sql_result989 = mysql_query($sql989) or die ("search.php - 7 Error in query: $sql989");                                 

$number_of_posts=mysql_num_rows($sql_result989);



if ($_GET['limit']==''){

$limit=0;

}

elseif($_GET['limit']=='0'){

$limit=0;

}

else {

$limit=escape_string(htmlentities($_GET['limit'])) - 1;

$limit=($limit*$list_posts);

}

$pages=ceil($number_of_posts/$list_posts);

$pages_end = $pages;

if ($pages <= '1'){

}

else{



template_hook("pages/search.template.php", "11");



}


}

elseif($_GET['area']=='newposts'){

// Get page numbers...

	// find out the number of unread posts

		if (isset($lb_name)){

			$unread_posts="0";

			$post_array=array();

			// Now go through each forum...

				$query211 = "select FORUM_ID from {$db_prefix}permissions WHERE GROUP_ID='$role' AND CAN_READ_TOPICS='1' ORDER BY FORUM_ID desc" ;
				$result211 = mysql_query($query211) or die("header.php - Error in query: $query211") ;                                  
				while ($results211 = mysql_fetch_array($result211)){
					$forum_id	= $results211['FORUM_ID'];
					
					$query212 = "select TOPIC_ID from {$db_prefix}posts WHERE FORUM_ID='$forum_id' AND LAST_POST_TIME > '$read_all_posts' AND LAST_POST_TIME > '$register_date' AND APPROVED='1' ORDER BY TOPIC_ID desc" ;
					$result212 = mysql_query($query212) or die("header.php - Error in query: $query212");
					while ($results212 = mysql_fetch_array($result212)){
						$topic_check_id = $results212['TOPIC_ID'];
						
						$query2118 = "select READ_TIME from {$db_prefix}posts_read WHERE MEMBER_ID='$my_id' AND TOPIC_ID='$topic_check_id'" ;
						$result2118 = mysql_query($query2118) or die("header.php - Error in query: $query2118") ;
						$read_count = mysql_num_rows($result2118);
						
						if ($read_count=='0'){
							$read_results="0";
						}
						else{
							$read_results = mysql_result($result2118, 0);
						}
								
						
							// now check posts...
							
							$query2129 = "select ID from {$db_prefix}posts WHERE TOPIC_ID='$topic_check_id' AND TIME > '$read_results' AND TIME > '$read_all_posts' AND APPROVED='1' AND MEMBER!='$my_id'" ;
							$result2129 = mysql_query($query2129) or die("header.php - Error in query: $query2129");
							while ($results2129 = mysql_fetch_array($result2129)){
								$post_id = $results2129['ID'];	
							
								$unread_posts	= $unread_posts + 1;
								$post_array[] = $post_id;
							}
						
					}

				}

			$new_posts=number_format($unread_posts);

		}
		else{
			$number_of_posts="0";
		}

if($new_posts == 0) {

	echo 'Sorry there are no new posts. <a href="' . $lb_domain . '">Return to homepage</a>';

} else {
		
sort($post_array);	


	
$post_array = (!empty($post_array)) ? implode(",", $post_array) : 0; 



if ($_GET['limit']==''){

$limit=0;

}

elseif($_GET['limit']=='0'){

$limit=0;

}

else {

$limit=escape_string(htmlentities($_GET['limit'])) - 1;

$limit=($limit*$list_posts);

}

$pages=ceil($number_of_posts/$list_posts);

$pages_end = $pages;

if ($pages <= '1'){

}

else{

template_hook("pages/search.template.php", "19");



}

	// find out the number of unread posts

		if (isset($name)){

			$read_time="0";

			$unread_posts="0";

			// Now go through each forum...

$sql989 = "SELECT MEMBER, TIME, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, TOPIC_ID FROM {$db_prefix}posts WHERE ID IN($post_array)";

$sql_result989 = mysql_query($sql989) or die ("search.php - 3 Error in query: $sql989");

while($row = mysql_fetch_array($sql_result989)) {

$content = strip_slashes($row['CONTENT']);

			$pattern = '|[[\/\!]*?[^\[\]]*?]|si';
			$replace = '';
			$content = preg_replace($pattern, $replace, $content);
		
			$content = substr($content,0,160); 
			$content = $content."...";

$post_id = $row['ID'];

$topic_id = $row['TOPIC_ID'];

$member = $row['MEMBER'];

$time = $row['TIME'];

$forum_id = $row['FORUM_ID'];



$time = format_date($row['TIME'], '%d %b %y');



$edit_time = $row['EDIT_TIME'];



$edit_time = format_date($edit_time); 



$edit_member = $row['EDIT_MEMBER'];

$sql9891 = "SELECT TITLE FROM {$db_prefix}posts WHERE TOPIC_ID='$topic_id'AND TITLE!=''";
$sql_result9891 = mysql_query($sql9891) or die ("search.php - 3 Error in query: $sql9891");
while($row = mysql_fetch_array($sql_result9891)) {
	$title = strip_slashes($row['TITLE']);
}

		$can_read_topics="0";



		$query3 = "select CAN_READ_TOPICS from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;

		$result3 = mysql_query($query3) or die("search.php - 5 Error in query: $query3") ;                                  

		$can_read_topics = mysql_result($result3, 0);



if ($can_read_topics=='1'){

template_hook("pages/search.template.php", "5");

}

}

// Get page numbers...



$member_id=htmlentities($_GET['search']);

$member_id=escape_string($member_id);



$sql989 = "SELECT ID FROM {$db_prefix}posts WHERE MEMBER='$member_id' AND TITLE!='' AND APPROVED='1' ORDER BY TOPIC_ID desc";

$sql_result989 = mysql_query($sql989) or die ("search.php - 2 Error in query: $sql989");                                 

$number_of_posts=mysql_num_rows($sql_result989);



if ($_GET['limit']==''){

$limit=0;

}

elseif($_GET['limit']=='0'){

$limit=0;

}

else {

$limit=escape_string(htmlentities($_GET['limit'])) - 1;

$limit=($limit*$list_posts);

}

$pages=ceil($number_of_posts/$list_posts);

$pages_end = $pages;

if ($pages <= '1'){

}

else{



template_hook("pages/search.template.php", "19");



}

}

						}
						
					}


elseif ($_GET['pf']==''){

$search = strip_slashes(htmlentities($_GET['search']));

template_hook("pages/search.template.php", "12");



$query211 = "select ID, NAME from {$db_prefix}categories WHERE PARENT='0' ORDER BY FORUM_ORDER asc, ID asc" ;

$result211 = mysql_query($query211) or die("topic.php - Error in query: $query211") ;                                  

while ($results211 = mysql_fetch_array($result211)){

$parent_id = $results211['ID'];

$parent_name = strip_slashes($results211['NAME']);



		// PERMISSIONS!!! Can they view this forum???



		$can_view_forum="0";



		$query39 = "select CAN_VIEW_FORUM from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$parent_id'" ;

		$result39 = mysql_query($query39) or die("topic.php - Error in query: $query39") ;                                  

		$can_view_forum = mysql_result($result39, 0);



if ($can_view_forum=='1'){



template_hook("pages/search.template.php", "15");



}





$query2 = "select ID, NAME from {$db_prefix}categories WHERE PARENT='$parent_id' ORDER BY FORUM_ORDER asc, ID asc" ;

$result2 = mysql_query($query2) or die("topic.php - Error in query: $query2") ;                                  

while ($results2 = mysql_fetch_array($result2)){

$forum_id = $results2['ID'];

$forum_name = strip_slashes($results2['NAME']);

$query31 = "select FORUM_ID from {$db_prefix}posts WHERE TOPIC_ID='$topic' AND TITLE!='' AND APPROVED='1'" ;

$result31 = mysql_query($query31) or die("Query failed") ;                                  

$topic_forum_id = mysql_result($result31, 0);



		// PERMISSIONS!!! Can they view this forum???



		$can_view_forum="0";



		$query32 = "select CAN_VIEW_FORUM from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;

		$result32 = mysql_query($query32) or die("topic.php - Error in query: $query32") ;                                  

		$can_view_forum = mysql_result($result32, 0);





if ($can_view_forum=='1'){





template_hook("pages/search.template.php", "16");





$query_sub = "select ID, NAME from {$db_prefix}categories WHERE PARENT='$forum_id' ORDER BY FORUM_ORDER asc, ID desc" ;

$result_sub = mysql_query($query_sub) or die("move.php - Error in query: $query_sub") ;                                  

while ($results_sub = mysql_fetch_array($result_sub)){

$forum_sub_id = $results_sub['ID'];

$forum_sub_name = strip_slashes($results_sub['NAME']);



		// PERMISSIONS!!! Can they view this forum???



		$can_view_sub_forum="0";



		$query_sub33 = "select CAN_VIEW_FORUM from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_sub_id'" ;

		$result_sub33 = mysql_query($query_sub33) or die("topic.php - Error in query: $query_sub33") ;                                  

		$can_view_sub_forum = mysql_result($result_sub33, 0);



if ($can_view_sub_forum=='1'){



template_hook("pages/search.template.php", "17");



}



}







}

}

}



template_hook("pages/search.template.php", "18");



}

else{

$search = strip_slashes(htmlentities($_GET['search']));

template_hook("pages/search.template.php", "12");



$query211 = "select ID, NAME from {$db_prefix}categories WHERE PARENT='0' ORDER BY FORUM_ORDER asc, ID asc" ;

$result211 = mysql_query($query211) or die("topic.php - Error in query: $query211") ;                                  

while ($results211 = mysql_fetch_array($result211)){

$parent_id = $results211['ID'];

$parent_name = strip_slashes($results211['NAME']);



		// PERMISSIONS!!! Can they view this forum???

		$can_view_forum="0";

		$query39 = "select CAN_VIEW_FORUM from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$parent_id'" ;

		$result39 = mysql_query($query39) or die("topic.php - Error in query: $query39") ;                                  

		$can_view_forum = mysql_result($result39, 0);



if ($can_view_forum=='1'){


template_hook("pages/search.template.php", "15");

}





$query2 = "select ID, NAME from {$db_prefix}categories WHERE PARENT='$parent_id' ORDER BY FORUM_ORDER asc, ID asc" ;

$result2 = mysql_query($query2) or die("topic.php - Error in query: $query2") ;                                  

while ($results2 = mysql_fetch_array($result2)){

$forum_id = $results2['ID'];

$forum_name = strip_slashes($results2['NAME']);





$topic=$_GET['topic'];

$topic=escape_string(htmlentities($topic));


$query31 = "select FORUM_ID from {$db_prefix}posts WHERE TOPIC_ID='$topic' AND TITLE!='' AND APPROVED='1'" ;

$result31 = mysql_query($query31) or die("Query failed") ;                                  

$topic_forum_id = mysql_result($result31, 0);



		// PERMISSIONS!!! Can they view this forum???



		$can_view_forum="0";



		$query32 = "select CAN_VIEW_FORUM from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;

		$result32 = mysql_query($query32) or die("topic.php - Error in query: $query32") ;                                  

		$can_view_forum = mysql_result($result32, 0);





if ($can_view_forum=='1'){





template_hook("pages/search.template.php", "16");





$query_sub = "select ID, NAME from {$db_prefix}categories WHERE PARENT='$forum_id' ORDER BY FORUM_ORDER asc, ID desc" ;

$result_sub = mysql_query($query_sub) or die("move.php - Error in query: $query_sub") ;                                  

while ($results_sub = mysql_fetch_array($result_sub)){

$forum_sub_id = $results_sub['ID'];

$forum_sub_name = strip_slashes($results_sub['NAME']);



		// PERMISSIONS!!! Can they view this forum???



		$can_view_sub_forum="0";



		$query_sub33 = "select CAN_VIEW_FORUM from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_sub_id'" ;

		$result_sub33 = mysql_query($query_sub33) or die("topic.php - Error in query: $query_sub33") ;                                  

		$can_view_sub_forum = mysql_result($result_sub33, 0);



if ($can_view_sub_forum=='1'){



template_hook("pages/search.template.php", "17");



}



}





}

}

}



template_hook("pages/search.template.php", "18");





// Get page numbers...



$words = trim(htmlentities($_GET['search']));

$words=strip_slashes($words);



$search = str_replace("%20", " ", $words);



$searchstring = escape_string($search);



// Doesn't matter if time is set,

// We'll sort something out :)



	$startdate=$_GET['startdate'];

	$startdate=escape_string(htmlentities($startdate));

	$page_start=$startdate;



	if ($startdate==''){

		$startdate="0";

	}

	else{

		$startdate=explode("-",$startdate);

		$startdate=mktime($startdate[3], $startdate[4], $startdate[5], $startdate[1], $startdate[0], $startdate[2]);

	}



	$enddate=$_GET['enddate'];

	$enddate=escape_string(htmlentities($enddate));

	

	$enddate_form=escape_string($enddate);



	if ($enddate==''){

		$enddate=time();

	}

	else{

		$enddate=explode("-",$enddate);

		$enddate=mktime(23, 59, 59, $enddate[1], $enddate[0], $enddate[2]);

	}



if ($num_forums=='1' && $_GET['author_id']!=''){


$forum = array_map('intval', $_GET['forums']);
$forum = implode(',', $forum);


$author=$_GET['author'];
$author = escape_string(htmlentities($author));

$id = (int) $_GET['author_id'];


if ($searchstring!=''){

$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE FORUM_ID IN($forum) AND TIME >= '$startdate' AND TIME <= '$enddate' AND MEMBER='$id' AND APPROVED='1' AND MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) ORDER BY score DESC";

}



else{



$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE FORUM_ID IN($forum) AND MEMBER='$id' AND TIME >= '$startdate' AND TIME <= '$enddate' AND APPROVED='1' ORDER BY ID DESC ";



}


}



elseif($num_forums=='1' && $_GET['author_id']==''){

$forum = array_map('intval', $_GET['forums']);
$forum = implode(',', $forum);

if ($searchstring!=''){



$sql989 = "SELECT MEMBER, MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE FORUM_ID IN($forum) AND TIME >= '$startdate' AND TIME <= '$enddate' AND APPROVED='1' AND MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) ORDER BY score DESC ";



}



else{


$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE FORUM_ID IN($forum) AND TIME >= '$startdate' AND TIME <= '$enddate' AND APPROVED='1' ORDER BY ID DESC";

}



}



elseif($num_forums=='0' && $_GET['author_id']!=''){



$author=$_GET['author'];

$author = escape_string(htmlentities($author));



$id = (int) $_GET['author_id'];



if ($searchstring!=''){



if ($_GET['topic']!=''){

$topic = (int) $_GET['topic'];

$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE MEMBER='$id' AND TIME >= '$startdate' AND TIME <= '$enddate' AND AND TOPIC_ID='$topic' AND APPROVED='1' AND MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) ORDER BY score DESC ";

}

else{

$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE MEMBER='$id' AND TIME >= '$startdate' AND TIME <= '$enddate' AND APPROVED='1' AND MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) ORDER BY score DESC ";

}

}



else{

if ($_GET['topic']!=''){

$topic = (int) $_GET['topic'];

$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE MEMBER='$id' AND TIME >= '$startdate' AND TIME <= '$enddate' AND TOPIC_ID='$topic' AND APPROVED='1' ORDER BY ID DESC ";

}

else{

$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE MEMBER='$id' AND TIME >= '$startdate' AND TIME <= '$enddate' AND APPROVED='1' ORDER BY ID DESC ";

}

}



}



elseif($num_forums=='0' && $_GET['author_id']==''){



if ($searchstring!=''){

if ($_GET['topic']!=''){

$topic = (int) $_GET['topic'];

$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE MEMBER='$id' AND TIME >= '$startdate' AND TIME <= '$enddate' AND TOPIC_ID='$topic' AND TOPIC_ID='$topic' AND APPROVED='1' ORDER BY ID DESC ";

}

else{

$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE TIME >= '$startdate' AND TIME <= '$enddate' AND APPROVED='1' AND MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) ORDER BY score DESC ";

}

}



else{

if ($_GET['topic']!=''){

$topic = (int) $_GET['topic'];

$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE TIME >= '$startdate' AND TIME <= '$enddate' AND TOPIC_ID='$topic' AND APPROVED='1' ORDER BY ID DESC ";

}

else{

$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE TIME >= '$startdate' AND TIME <= '$enddate' AND APPROVED='1' ORDER BY ID DESC ";

}

}



}



$sql_result989 = mysql_query($sql989) or die ("Error in query: $sql989");                                 

$number_of_posts=mysql_num_rows($sql_result989);



if ($_GET['limit']==''){

$limit=0;

}

elseif($_GET['limit']=='0'){

$limit=0;

}

else {

$limit = ((int) $_GET['limit']) - 1;

$limit = ($limit*$list_posts);

}



$pages=ceil($number_of_posts/$list_posts);

$pages_end = $pages;



if ($pages <= '1'){

}

else{



template_hook("pages/search.template.php", "14");



}



$words = trim(htmlentities($_GET['search']));

$words=strip_slashes($words);



$search = str_replace("%20", " ", $words);



$searchstring = escape_string($search);



// Get results from database...



// Doesn't matter if time is set,

// We'll sort something out :)



	$startdate=$_GET['startdate'];

	$startdate=escape_string(htmlentities($startdate));



	if ($startdate==''){

		$startdate="0";

	}

	else{

		$startdate=explode("-",$startdate);

		$startdate=mktime($startdate[3], $startdate[4], $startdate[5], $startdate[1], $startdate[0], $startdate[2]);

	}



	$enddate=htmlentities($_GET['enddate']);

	$enddate=escape_string($enddate);

	

	$enddate_form=escape_string($enddate);	



	if ($enddate==''){

		$enddate=time();

	}

	else{

		$enddate=explode("-",$enddate);

		$enddate=mktime(23, 59, 59, $enddate[1], $enddate[0], $enddate[2]);

	}



if ($num_forums=='1' && $_GET['author_id']!=''){



$forum = array_map('intval', $_GET['forums']);
$forum = implode(',', $forum);



$author=htmlentities($_GET['author']);

$author = escape_string($author);



$id = (int) $_GET['author_id'];



if ($searchstring!=''){



$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE FORUM_ID IN($forum) AND MEMBER='$id' AND TIME > '$startdate' AND TIME < '$enddate' AND APPROVED='1' AND MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) ORDER BY score DESC LIMIT $limit, $list_posts";



}



else{



$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE FORUM_ID IN($forum) AND MEMBER='$id' AND TIME > '$startdate' AND TIME < '$enddate' AND APPROVED='1' ORDER BY ID DESC LIMIT $limit, $list_posts";



}



}



elseif($num_forums=='1' && $_GET['author_id']==''){



$forum = array_map('intval', $_GET['forums']);
$forum = implode(',', $forum);



if ($searchstring!=''){



$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE FORUM_ID IN($forum) AND MEMBER='$id' AND TIME > '$startdate' AND TIME < '$enddate' AND APPROVED='1' AND MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) ORDER BY score DESC LIMIT $limit, $list_posts";



}



else{





$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE FORUM_ID IN($forum) AND TIME > '$startdate' AND TIME < '$enddate' AND APPROVED='1' ORDER BY ID DESC LIMIT $limit, $list_posts";



}



}



elseif($num_forums=='0' && $_GET['author']!=''){



$author=htmlentities($_GET['author']);

$author = escape_string($author);



$id = (int) $_GET['author_id'];



if ($searchstring!=''){

if ($_GET['topic']!=''){

$topic = (int) $_GET['topic'];

$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE MEMBER='$id' AND TIME > '$startdate' AND TIME < '$enddate' AND APPROVED='1' AND TOPIC_ID='$topic' AND MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) ORDER BY score DESC LIMIT $limit, $list_posts";

}

else{

$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE MEMBER='$id' AND TIME > '$startdate' AND TIME < '$enddate' AND APPROVED='1' AND MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) ORDER BY score DESC LIMIT $limit, $list_posts";

}

}



else{

if ($_GET['topic']!=''){

$topic = (int) $_GET['topic'];

$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE MEMBER='$id' AND TIME > '$startdate' AND TIME < '$enddate' AND APPROVED='1' ANDORDERTOPIC_ID='$topic' ORDER BY ID DESC LIMIT $limit, $list_posts";

}

else{

$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE MEMBER='$id' AND TIME > '$startdate' AND TIME < '$enddate' AND APPROVED='1' ORDER BY ID DESC LIMIT $limit, $list_posts";

}

}



}



elseif($num_forums=='0' && $_GET['author_id']==''){





if ($searchstring!=''){

if ($_GET['topic']!=''){

$topic = (int) $_GET['topic'];

$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE TIME > '$startdate' AND TIME < '$enddate' AND APPROVED='1' AND TOPIC_ID='$topic' AND MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) ORDER BY score DESC LIMIT $limit, $list_posts";

}

else{

$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE TIME > '$startdate' AND TIME < '$enddate' AND APPROVED='1' AND MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) ORDER BY score DESC LIMIT $limit, $list_posts";

}

}



else{

if ($_GET['topic']!=''){

$topic = (int) $_GET['topic'];

$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE TIME > '$startdate' AND TIME < '$enddate' AND APPROVED='1' AND TOPIC_ID='$topic' ORDER BY ID DESC LIMIT $limit, $list_posts";

}

else{

$sql989 = "SELECT MEMBER, TIME, TOPIC_ID, FORUM_ID, CONTENT, ID, EDIT_TIME, EDIT_MEMBER, MATCH(TITLE, DESCRIPTION, CONTENT) AGAINST ('*$searchstring*' IN BOOLEAN MODE) AS score FROM {$db_prefix}posts WHERE TIME > '$startdate' AND TIME < '$enddate' AND APPROVED='1' ORDER BY ID DESC LIMIT $limit, $list_posts";

}

}



}

$sql_result989 = mysql_query($sql989) or die ("search.php - 12 Error in query: $sql989");
$number_of_results=mysql_num_rows($sql_result989);
$max_score="0";


while($row = mysql_fetch_array($sql_result989)) {

$content = strip_slashes($row['CONTENT']);

			$pattern = '|[[\/\!]*?[^\[\]]*?]|si';
			$replace = '';
			$content = preg_replace($pattern, $replace, $content);

$post_id = $row['ID'];
$member = $row['MEMBER'];
$time = format_date($row['TIME'], '%d %b %y');
$forum_id = $row['FORUM_ID'];
$topic_id = $row['TOPIC_ID'];
$score = $row['score'];

$title="";


// Get the title...

$sql979 = "SELECT TITLE FROM {$db_prefix}posts WHERE TITLE!='' AND TOPIC_ID='$topic_id' AND APPROVED='1'";
$sql_result979 = mysql_query($sql979) or die ("search.php - 13 Error in query: $sql979");
$title = mysql_result($sql_result979, 0);

$words = preg_split ("/\s+/", "$words");
$words = join('|',$words);

if ($searchstring!=''){

	$title = preg_replace("/($words)/i","<strong>\\0</strong>",$title);

	if (strpos($words, "http://") === false){

		if (strpos($words, "www") === false){

			$content = substr($content,0,160); 
			$content = $content."...";

			$content = preg_replace("/($words)/i","<strong>\\0</strong>",$content);

		}

	}

}

$title=strip_slashes($title);

		$can_read_topics="0";

		$query3 = "select CAN_READ_TOPICS from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;
		$result3 = mysql_query($query3) or die("search.php - 14 Error in query: $query3") ;                                  
		$can_read_topics = mysql_result($result3, 0);



if ($can_read_topics=='1'){
	template_hook("pages/search.template.php", "5");
}

}

if ($_GET['limit']==''){

$limit=0;

}

elseif($_GET['limit']=='0'){

$limit=0;

}

else {

$limit=htmlentities($_GET['limit']) - 1;

$limit=($limit*$list_posts);

}



$pages=ceil($number_of_posts/$list_posts);

$pages_end = $pages;



if ($pages <= '1'){

}

else{



template_hook("pages/search.template.php", "14");



}

}


template_hook("pages/search.template.php", "end");

?>