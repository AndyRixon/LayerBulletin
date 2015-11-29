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
|   autocache.php - re-caches forum index & stats
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

if ($_GET['page']!='auto_cache'){

// upgdate stats first...

	$query2 = "select ID from {$db_prefix}posts WHERE TITLE=''" ;
	$result2 = mysql_query($query2) or die("online.php - Error in query: $query2") ;                                  
	$posts=mysql_num_rows($result2);

	$query2 = "select DISTINCT TOPIC_ID from {$db_prefix}posts" ;
	$result2 = mysql_query($query2) or die("online.php - Error in query: $query2") ;                                  
	$topics=mysql_num_rows($result2);

	$query2 = "select ID from {$db_prefix}members WHERE verified='1'";
	$result2 = mysql_query($query2) or die("online.php - Error in query: $query2") ;                                  
	$members=mysql_num_rows($result2);

	$query21 = "select ID, NAME from {$db_prefix}members WHERE verified='1' ORDER BY ID desc LIMIT 1" ;
	$result21 = mysql_query($query21) or die("online.php - Error in query: $query21") ;                                  
	while ($results21 = mysql_fetch_array($result21)){
		$member_id = $results21['ID'];
		$name = $results21['NAME'];
	}

	$query21 = "select ID, TITLE, TIME, TOPIC_ID, FORUM_ID from {$db_prefix}posts WHERE APPROVED='1' ORDER BY ID desc LIMIT 1" ;
	$result21 = mysql_query($query21) or die("online.php - Error in query: $query21") ;                                  
	while ($results21 = mysql_fetch_array($result21)){
		$id = $results21['ID'];
		$title = addslashes($results21['TITLE']);
		$topic_id = $results21['TOPIC_ID'];
		$forum_id = $results21['FORUM_ID'];
		$time = $results21['TIME'];
	}
	if ($title==''){

		$query29 = "select TITLE from {$db_prefix}posts WHERE TOPIC_ID='$topic_id' AND TITLE!='' AND APPROVED='1'" ;
		$result29 = mysql_query($query29) or die("online.php - Error in query: $query29") ;                                  
		$title = addslashes(mysql_result($result29, 0));
		
	}
	
	mysql_query("UPDATE {$db_prefix}settings SET stats_topics='$topics', stats_posts='$posts', stats_member_id='$member_id', stats_member_name='$name', stats_members='$members', stats_post_id='$id', stats_post_title='$title', stats_post_forum='$forum_id', stats_post_time='$time', stats_post_topic='$topic_id'");
	
	# Remove out-of-date cache
	$Cache->delete('settings');
	
		// check for sub-forums..

			$query_sub = "select ID from {$db_prefix}categories WHERE PARENT!='0' ORDER BY ID asc";
			$result_sub = mysql_query($query_sub) or die("index.php - Error in query: $query_sub");                                 
			while ($results_sub = mysql_fetch_array($result_sub)){
				$sub_id = $results_sub['ID'];

				$topics="";
				$posts="";
				$id="";
				$topic_id="";
				$title="";
				$time="";
				$member="";
				$name="";

					// update sub forums first...

						$query211 = "select ID from {$db_prefix}posts WHERE FORUM_ID='$sub_id' AND TITLE!='' AND APPROVED='1'" ;
						$result211 = mysql_query($query211) or die("index.php - Error in query: $query211") ;                                  
						$topics=mysql_num_rows($result211);

						$query211 = "select ID from {$db_prefix}posts WHERE FORUM_ID='$sub_id' AND TITLE='' AND APPROVED='1'" ;
						$result211 = mysql_query($query211) or die("index.php - Error in query: $query211") ;                                  
						$posts=mysql_num_rows($result211);

						$query211 = "select ID, MEMBER, TITLE, TIME, TOPIC_ID from {$db_prefix}posts WHERE FORUM_ID='$sub_id' AND APPROVED='1' ORDER BY ID desc LIMIT 1" ;
						$result211 = mysql_query($query211) or die("index.php - Error in query: $query211") ;                                  
						while ($results211 = mysql_fetch_array($result211)){
							$id = $results211['ID'];
							$member = $results211['MEMBER'];
							$title = addslashes($results211['TITLE']);
							$time = $results211['TIME'];
							 
							$topic_id = $results211['TOPIC_ID'];

							$name="0";

							$query2111 = "select NAME from {$db_prefix}members WHERE ID='$member'" ;
							$result2111 = mysql_query($query2111) or die("index.php - Error in query: $query2111") ;                                  
							$name = mysql_result($result2111, 0);

							if ($title==''){

								$query29 = "select TITLE from {$db_prefix}posts WHERE TOPIC_ID='$topic_id' AND TITLE!='' AND APPROVED='1'" ;
								$result29 = mysql_query($query29) or die("index.php - Error in query: $query29") ;                                  
								$title = addslashes(mysql_result($result29, 0));
								
							}

						}

						// update here
						
						mysql_query("UPDATE {$db_prefix}categories SET cat_topics='$topics', cat_posts='$posts', cat_latest_id='$id', cat_latest_topic='$topic_id', cat_latest_title='$title', cat_latest_time='$time', cat_latest_member_id='$member', cat_latest_member_name='$name' WHERE id='$sub_id'");

			}

		// now put in total posts for each forum on index...

			$query2 = "select ID from {$db_prefix}categories WHERE PARENT='0' ORDER BY ID asc" ;
			$result2 = mysql_query($query2) or die("index.php - Error in query: $query2") ;                                  
			while ($results2 = mysql_fetch_array($result2)){
				$first_id = $results2['ID'];

			$query2x = "select ID from {$db_prefix}categories WHERE PARENT='$first_id' ORDER BY ID asc" ;
			$result2x = mysql_query($query2x) or die("index.php - Error in query: $query2x") ;                                  
			while ($results2x = mysql_fetch_array($result2x)){
				$parent_id = $results2x['ID'];					
			
			$topics="";
			$posts="";
			$id="";
			$topic_id="";
			$title="";
			$time="";
			$member="";
			$name="";

				// update index now...

					$query211 = "select ID from {$db_prefix}posts WHERE FORUM_ID IN(select ID from {$db_prefix}categories WHERE FORUM_ID='$parent_id' OR PARENT='$parent_id') AND TITLE!='' AND APPROVED='1'" ;
					$result211 = mysql_query($query211) or die("index.php - Error in query: $query211") ;                                  
					$topics=mysql_num_rows($result211);

					$query211 = "select ID from {$db_prefix}posts WHERE FORUM_ID IN(select ID from {$db_prefix}categories WHERE FORUM_ID='$parent_id' OR PARENT='$parent_id') AND TITLE='' AND APPROVED='1'" ;
					$result211 = mysql_query($query211) or die("index.php - Error in query: $query211") ;                                  
					$posts=mysql_num_rows($result211);

					$query211 = "select ID, MEMBER, TITLE, TIME, TOPIC_ID from {$db_prefix}posts WHERE FORUM_ID IN(select ID from {$db_prefix}categories WHERE FORUM_ID='$parent_id' OR PARENT='$parent_id') AND APPROVED='1' ORDER BY ID desc LIMIT 1" ;
					$result211 = mysql_query($query211) or die("index.php - Error in query: $query211") ;                                  
					while ($results211 = mysql_fetch_array($result211)){
						$id = $results211['ID'];
						$member = $results211['MEMBER'];
						$title = addslashes($results211['TITLE']);
						$time = $results211['TIME'];
						$topic_id = $results211['TOPIC_ID'];

						$name="0";

						$query2111 = "select NAME from {$db_prefix}members WHERE ID='$member'" ;
						$result2111 = mysql_query($query2111) or die("index.php - Error in query: $query2111") ;                                  
						$name = mysql_result($result2111, 0);

						if ($title==''){

							$query29 = "select TITLE from {$db_prefix}posts WHERE TOPIC_ID='$topic_id' AND TITLE!='' AND APPROVED='1'" ;
							$result29 = mysql_query($query29) or die("index.php - Error in query: $query29") ;                                  
							$title = addslashes(mysql_result($result29, 0));
							
						}

						// update here					
						
							mysql_query("UPDATE {$db_prefix}categories SET cat_topics='$topics', cat_posts='$posts', cat_latest_id='$id', cat_latest_topic='$topic_id', cat_latest_title='$title', cat_latest_time='$time', cat_latest_member_id='$member', cat_latest_member_name='$name' WHERE id='$parent_id'");


					}

	}

	}
	
}

else{

	lb_redirect("index.php?page=error","error");

}
?>