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
|   board.php - Shows forums
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

	template_hook("forums/board.template.php", "start");

	// PERMISSIONS!!! Can they view this forum???

		$can_view_forum		=	"0";
		$can_read_topics	=	"0";
		$can_add_topics		=	"0";
		$can_reply_topics	=	"0";

		$forum				=	escape_string($_GET['forum']);

if (!is_numeric($forum)){
die();
}

	// check it the forum exists
	
		$query211 = "select ID from {$db_prefix}categories WHERE ID='$forum'" ;
		$result211 = mysql_query($query211) or die("board.php - Error in query: $query211") ;                                  
		$does_exist = mysql_num_rows($result211);

		if ($does_exist == '0'){
			lb_redirect("index.php?page=error&error=25","error/25");
		}

		$query3 = "select CAN_VIEW_FORUM, CAN_READ_TOPICS, CAN_ADD_TOPICS, CAN_REPLY_TOPICS from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum'" ;
		$result3 = mysql_query($query3) or die("board.php - Error in query: $query") ;                                  
		while ($results3 = mysql_fetch_array($result3)){
			$can_view_forum		= $results3['CAN_VIEW_FORUM'];
			$can_read_topics	= $results3['CAN_READ_TOPICS'];
			$can_add_topics		= $results3['CAN_ADD_TOPICS'];
			$can_reply_topics	= $results3['CAN_REPLY_TOPICS'];
		}

	// redirect if they aren't allowed here	
		
		if ($can_view_forum=='0'){
			lb_redirect("index.php?page=error&error=2","error/2");
		}
		elseif($can_read_topics=='0'){
			lb_redirect("index.php?page=error&error=3","error/3");
		}
		
	// otherwise, carry on displaying it
	
		else
		{
			$query211	= "select NAME, PARENT, FORUM_RULES, redirect_url from {$db_prefix}categories WHERE ID='$forum_id'" ;
			$result211	= mysql_query($query211) or die("topic.php - Error in query: $query211") ;                                  
			$results211	= mysql_fetch_array($result211);
			
				$name			= strip_slashes($results211['NAME']);
				$parent			= $results211['PARENT'];
				$content		= strip_slashes($results211['FORUM_RULES']);
				$redirect_url	= strip_slashes($results211['redirect_url']);
			
			/*
			Is this a redirect forum?
		*/
		
			if ($redirect_url != '')
			{
				header('Location: ' . $redirect_url);
				exit;
			}
			
		// parse the forum rules

			if ($content!=''){
				if (file_exists("themes/$theme/scripts/php/parse.php")){
					include "themes/$theme/scripts/php/parse.php";
				}
				else{
					include "scripts/php/parse.php";				
				}
				$forum_rules = $content;
				template_hook("forums/board.template.php", "1");
			}

			$forum_name_for_this_forum	=	$name;

		// get  parent info
		
			$query211 = "select PARENT, READ_ONLY from {$db_prefix}categories WHERE ID='$forum'" ;
			$result211 = mysql_query($query211) or die("board.php - Error in query: $query211") ;                                  
			while ($results211 = mysql_fetch_array($result211)){
				$parent				= $results211['PARENT'];
				$forum_read_only	= $results211['READ_ONLY'];
			}

		// list sub-forums...

			$count_sub_alt="0";
		
			$query2 = "select ID, FORUM_ORDER, NAME from {$db_prefix}categories WHERE PARENT='$forum' ORDER BY FORUM_ORDER, ID asc" ;
			$result2 = mysql_query($query2) or die("index.php - Error in query: $query2") ;
			$number_of_kids=mysql_num_rows($result2);
			
			if ($number_of_kids!='0'){                                  
				while ($results2 = mysql_fetch_array($result2)){
					$parent_id			= $results2['ID'];
					$parent_name		= strip_slashes($results2['NAME']);

					$can_view_parent	= "0";

					// Check that the number of child forums
					// is > 0, otherwise there is no point
					// showing the parent is there?

					// Check that they've got permission to view it...

						$query_view = "select CAN_VIEW_FORUM from {$db_prefix}permissions WHERE FORUM_ID='$parent_id' AND GROUP_ID='$role'" ;
						$result_view = mysql_query($query_view) or die("index.php - Error in query: $query_view");
						$can_view_forum = mysql_result($result_view, 0);                              

						if ($can_view_forum!='0'){
							$can_view_parent="1";
						}
				}

				if ($can_view_parent!='0'){

					template_hook("forums/board.template.php", "2");

					$query21 = "select ID, NAME, DESCRIPTION, READ_ONLY, REDIRECT_URL from {$db_prefix}categories WHERE PARENT='$forum' ORDER BY FORUM_ORDER, ID asc" ;
					$result21 = mysql_query($query21) or die("board.php - Error in query: $query21");                                  
					while ($results21 = mysql_fetch_array($result21)){
						$forum_id			= $results21['ID'];
						$forum_name			= strip_slashes($results21['NAME']);
						$forum_description	= strip_slashes($results21['DESCRIPTION']);
						$read_only			= $results21['READ_ONLY'];
						$redirect_url			= $results21['REDIRECT_URL'];

						$forum_description	= str_replace("<p>", "", "$forum_description");
						$forum_description	= str_replace("</p>", "", "$forum_description");

						// PERMISSIONS!!! Can they view this forum???

							$can_view_forum		=	"0";
							$can_read_topics	=	"0";

							$query3 = "select CAN_VIEW_FORUM, CAN_READ_TOPICS from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;
							$result3 = mysql_query($query3) or die("board.php - Error in query: $query3") ;                                  
							while ($results3 = mysql_fetch_array($result3)){
								$can_view_forum		= $results3['CAN_VIEW_FORUM'];
								$can_read_topics	= $results3['CAN_READ_TOPICS'];
							}

							if ($can_view_forum!='0'){

								if ($read_only=='0'){

									if (isset($lb_name)){			$unread_posts="0";

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
									else{
										$unread_posts="0";
									}

								}

								$forum_description	=	str_replace("\n", "<br />", $forum_description);

								// check for sub-forums..

									$query_sub = "select ID from {$db_prefix}categories WHERE PARENT='$forum_id'";
									$result_sub = mysql_query($query_sub) or die("index.php - Error in query: $query_sub") ; 
									$count_sub=mysql_num_rows($result_sub); 

									$forum_title = forum_title($forum_id);
									
									$count_sub_alt=$count_sub_alt+1;

									$check_odd = checkNum($count_sub_alt);

									if ($check_odd===TRUE){
										$alt_td_class="";
									}
									else{
										$alt_td_class="-alt";	
									}
									
									template_hook("forums/board.template.php", "3");

									if ($count_sub!='0'){


										$count_sub_forums="1";
										$query_sub = "select ID, NAME from {$db_prefix}categories WHERE PARENT='$forum_id' ORDER BY FORUM_ORDER, ID asc" ;
										$result_sub = mysql_query($query_sub) or die("index.php - Error in query: $query_sub") ; 
										$count_sub=mysql_num_rows($result_sub);                                 
										while ($results_sub = mysql_fetch_array($result_sub)){
											$sub_id		= $results_sub['ID'];
											$sub_name	= escape_string($results_sub['NAME']);

											$forum_title = forum_title($sub_id);
											
											template_hook("forums/board.template.php", "15");

											$count_sub_forums++;

										}
									}

									$title	=	"";
									$time	=	"";


									$query211 = "select CAT_TOPICS, CAT_POSTS, CAT_LATEST_ID, CAT_LATEST_TOPIC, CAT_LATEST_TITLE, CAT_LATEST_TIME, CAT_LATEST_MEMBER_ID, CAT_LATEST_MEMBER_NAME from {$db_prefix}categories WHERE ID ='$forum_id'" ;
									$result211 = mysql_query($query211) or die("index.php - Error in query: $query211") ;                                  
									while ($results211 = mysql_fetch_array($result211)){
										$topics		= number_format($results211['CAT_TOPICS']);
										$posts		= number_format($results211['CAT_POSTS']);
										$id			= $results211['CAT_LATEST_ID'];
										$member 	= $results211['CAT_LATEST_MEMBER_ID'];
										$name		= $results211['CAT_LATEST_MEMBER_NAME'];
										$title		= strip_slashes($results211['CAT_LATEST_TITLE']);
										$time		= $results211['CAT_LATEST_TIME'];
										$topic_id 	= $results211['CAT_LATEST_TOPIC'];
										

										if ($time=='0' OR $time==''){
											$time="";
										}
										else{
											$time = format_date($time); 
										}

									}

									template_hook("forums/board.template.php", "16");

									$title	=	"";
									$time	=	"";
									$id		=	"";
									$member	=	"";

							}

					}

					template_hook("forums/board.template.php", "4");

				}
			}

			// hide other area if this is root forum....

				if ($parent!='0'){

				// Get page numbers...

					if ($_GET['limit']==''){
						$limit			=	"1";
						$query_limit	=	"0";
					}
					elseif($_GET['limit']<='0'){
						$limit			=	"1";
						$query_limit	=	"0";
					}
					else {
						$limit			=	escape_string($_GET['limit']) - 1;
						$limit			=	($limit*$list_topics);
						$query_limit	=	$limit;
					}

					$query_forum = "select TOPIC_ID from {$db_prefix}posts WHERE FORUM_ID='$forum' AND TITLE!='' AND APPROVED='1'";
					$result_forum = mysql_query($query_forum) or die("board.php - Error in query: $query_forum") ;                                  
					$number_of_threads=mysql_num_rows($result_forum);

					$pages	=	ceil($number_of_threads/$list_topics);

					$pages_end = $pages;

					$query_subscribe = "select ROW from {$db_prefix}subscribe WHERE ID='$my_id' AND SUBSCRIBED_FORUM='$forum'" ;
					$result_subscribe = mysql_query($query_subscribe) or die("topic.php - Error in query: $query_subscribe") ;                                  
					$subscribed_already=mysql_num_rows($result_subscribe);

					$forum_title = forum_title($forum);
					
					template_hook("forums/board.template.php", "5");

				// Show announcements first please :)
					
					$count_topics="0";
					
					$query211 = "select TOPIC_ID, ID, MEMBER, TITLE, DESCRIPTION, FORUM_ID, TIME, LAST_POST_TIME, VIEWS, STICKY, ANNOUNCE, LOCKED from {$db_prefix}posts WHERE FORUM_ID='$forum' AND TITLE!='' AND APPROVED='1' OR ANNOUNCE='1' AND TITLE!='' AND APPROVED='1' ORDER BY ANNOUNCE desc, STICKY desc, LAST_POST_TIME desc LIMIT $query_limit, $list_topics" ;
					$result211 = mysql_query($query211) or die("board.php - Error in query: $query211") ;                                  
					while ($results211 = mysql_fetch_array($result211)){
						$id 			= $results211['ID'];
						$title 			= strip_slashes($results211['TITLE']);
						$description 	= strip_slashes($results211['DESCRIPTION']);
						$member 		= $results211['MEMBER'];
						$time 			= format_date($results211['TIME']);
						$description 	= str_replace("\r","<br />",$description);
						$very_first_post_time = $results211['TIME'];
						$forum_id 		= $results211['FORUM_ID'];
						$topic_id 		= $results211['TOPIC_ID'];
						$views 			= number_format($results211['VIEWS']);
						$locked 		= $results211['LOCKED'];
						$sticky 		= $results211['STICKY'];
						$announce 		= $results211['ANNOUNCE'];
						$post_time 		= $results211['LAST_POST_TIME'];

						$read_time="0";

						$query6 = "select READ_ALL_POSTS from {$db_prefix}members WHERE ID='$my_id'" ;
						$result6 = mysql_query($query6) or die("board.php - Error in query: $query6") ;                                  
						$read_all_posts = mysql_result($result6, 0);

						$query5 = "select READ_TIME from {$db_prefix}posts_read WHERE MEMBER_ID='$my_id' AND TOPIC_ID='$topic_id' ORDER BY ROW desc LIMIT 1" ;
						$result5 = mysql_query($query5) or die("board.php - Error in query: $query5") ;                                  
						$read_time = mysql_result($result5, 0);

						$query25 = "select ID from {$db_prefix}posts WHERE TIME > '$read_time' AND TIME > '$read_all_posts' AND TOPIC_ID='$topic_id' AND APPROVED='1' ORDER BY TIME asc LIMIT 1" ;
						$result25 = mysql_query($query25) or die("board.php - Error in query: $query25") ;                                  
						$post_to_be_read = mysql_result($result25, 0);

						if ($announce=='1'){
							$sticky	=	"1";
						}

						$query = "select ID from {$db_prefix}posts WHERE TOPIC_ID='$topic_id' AND TITLE='' AND APPROVED='1'" ;
						$result = mysql_query($query) or die("board.php - Error in query: $query") ;                                  
						$replies	=	number_format(mysql_num_rows($result));

						$the_current_time = time();

					// get time difference...
					
						$difference_in_time	=	($the_current_time - $very_first_post_time);
						
						// convert to hours
					
						$difference_in_time	=	($difference_in_time/60/60/24);

						$difference_in_time	=	($replies/$difference_in_time);

						$name = '';

						$count_topics=$count_topics+1;

						$check_odd = checkNum($count_topics);

						if ($check_odd===TRUE){
							$alt_td_class="";
						}
						else{
							$alt_td_class="-alt";	
						}
						
						$query2111 = "select NAME, ROLE from {$db_prefix}members WHERE ID='$member'" ;
						$result2111 = mysql_query($query2111) or die("board.php - Error in query: $query2111") ;                                  
						while ($results2111 = mysql_fetch_array($result2111)){
							$name 			= $results2111['NAME'];
							$poster_role 	= $results2111['ROLE'];
						}

						$query = "select ID from {$db_prefix}posts WHERE  TOPIC_ID='$topic_id' AND APPROVED='1'" ;
						$result = mysql_query($query) or die("board.php - Error in query: $query") ;                                  
						$replies=number_format(mysql_num_rows($result)-1);

						$query = "select ID, TIME from {$db_prefix}posts WHERE TOPIC_ID='$topic_id' AND APPROVED='1' ORDER BY ID desc LIMIT 1" ;
						$result = mysql_query($query) or die("board.php - Error in query: $query") ;                                  
						while ($results = mysql_fetch_array($result)){
							$last_post 	= $results['ID'];
							$time 		= format_date($results['TIME']);

						}

						$query2 = "select MEMBER from {$db_prefix}posts WHERE TOPIC_ID='$topic_id' AND APPROVED='1' ORDER BY TIME desc LIMIT 1" ;
						$result2 = mysql_query($query2) or die("board.php - Error in query: $query2") ;                                  
						$last_poster_id = mysql_result($result2, 0);

						$last_poster="0";

						$query2111 = "select NAME, ROLE from {$db_prefix}members WHERE ID='$last_poster_id'" ;
						$result2111 = mysql_query($query2111) or die("board.php - Error in query: $query2111") ;                                  
						while ($results2111 = mysql_fetch_array($result2111)){
							$last_poster 	= $results2111['NAME'];
							$poster_role 	= $results2111['ROLE'];
						}

						$query = "select ID from {$db_prefix}posts WHERE TOPIC_ID='$topic_id' AND APPROVED='1'" ;
						$result = mysql_query($query) or die("topic.php - Error in query: $query") ;                                  
						$number_of_posts=mysql_num_rows($result);

						$pages		=	ceil($number_of_posts/$list_posts);
						$pages_end 	= 	$pages;

						$_GET['limit']="1";

						$query219 = "select ROW from {$db_prefix}attachments WHERE TOPICID ='$topic_id' ORDER BY ROW asc LIMIT 1" ;
						$result219 = mysql_query($query219) or die("members.php - Error in query: $query219") ;                                  
						$has_attachment=mysql_num_rows($result219);

						$topic_title = topic_title($topic_id);
						
							if ($announce=='1'){
								$status_class = "forum-board-announcement";
							}
							elseif ($sticky=='1'){
								$status_class = "forum-board-sticky";
							}
							else{
								$status_class = "";
							}
						
						template_hook("forums/board.template.php", "6");

					}

					template_hook("forums/board.template.php", "7");


					// Online Members
					// Find all online...

						$forum	=	escape_string($_GET['forum']);

						$query2 = "select ID from {$db_prefix}sessions WHERE ID<='0' AND LOCATION_FORUM='$forum'" ;
						$result2 = mysql_query($query2) or die("board.php - Error in query: $query2") ;                                  
						$guests=mysql_num_rows($result2);

						$query3 = "select ID from {$db_prefix}sessions WHERE ID>'0'  AND LOCATION_FORUM='$forum'" ;
						$result3 = mysql_query($query3) or die("board.php - Error in query: $query3") ;                                  
						$members=mysql_num_rows($result3);

						$lang['board_online_list'] = str_replace("<%1>", $guests, $lang['board_online_list']);
						$lang['board_online_list'] = str_replace("<%2>", $members, $lang['board_online_list']);

						template_hook("forums/board.template.php", "8");

						$count_online_count="1";
						$query2 = "select ID, LOCATION_FORUM, LOCATION_TOPIC, LOCATION_PAGE, TIME from {$db_prefix}sessions WHERE ID != '0' AND LOCATION_FORUM='$forum' ORDER BY TIME desc" ;
						$result2 = mysql_query($query2) or die("board.php - Error in query: $query2") ;
						$count_online=mysql_num_rows($result2);                                  
						while ($results2 = mysql_fetch_array($result2)){
							$id 			= $results2['ID'];
							$location_forum = $results2['LOCATION_FORUM'];
							$location_topic = $results2['LOCATION_TOPIC'];
							$location_page 	= $results2['LOCATION_PAGE'];
							$time 			= format_date($results2['TIME'], '%A, %R');


						// Get name...

							if ($id > '0'){

								$query21 = "select NAME, ROLE, NATIONALITY from {$db_prefix}members WHERE ID='$id'" ;
								$result21 = mysql_query($query21) or die("board.php - Error in query: $query21") ;                                  
								while ($results21 = mysql_fetch_array($result21)){
									$name 			= $results21['NAME'];
									$role 			= $results21['ROLE'];
									$nationality 	= $results21['NATIONALITY'];
								}
							}
							else{
								$query23 = "select BOT_NAME from {$db_prefix}bots WHERE BOT_ID='$id'" ;
								$result23 = mysql_query($query23) or die("board.php - Error in query: $query23") ;                                  
								$name = mysql_result($result23, 0);
								$role="3";
							}

							template_hook("forums/board.template.php", "9");

							$count_online_count	=	$count_online_count+1;

						}

						template_hook("forums/board.template.php", "10");

				}

		}

		template_hook("forums/board.template.php", "end");

?>
