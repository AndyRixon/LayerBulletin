<?php
/*
+--------------------------------------------------------------------------
|  LayerBulletin
|  ========================================
|  By The LayerBulletin team
|  Released under the Artistic License 2.0
|  http://layerbulletin.com/
|  ========================================
|  footer.php - footer file with copyright information
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("footer.template.php", "start");	
	
	// get members role...
	
		if (isset($my_id) && ($my_id > '0')){
		
			$query211	=	"select ROLE from {$db_prefix}members WHERE ID='$my_id'" ;
			$result211	=	mysql_query($query211) or die("topic.php - Error in query: $query211") ;                                  
			$role		=	mysql_result($result211, 0);
			
		}
		else{
			$role="4";
		}

		template_hook("footer.template.php", "10");


	// style switcher

		if ($can_change_style=='1'){

			template_hook("footer.template.php", "1");
			template_hook("footer.template.php", "2");

		}

		else{
			template_hook("footer.template.php", "11");
		}

		$lang['footer_copyright']	=	str_replace("<%1>",$lb_version, $lang['footer_copyright']);
		$lang['footer_copyright']	=	str_replace("<%nburl>","<a class=\"copyright\" href=\"http://www.layerbulletin.com\">", $lang['footer_copyright']);
		$lang['footer_copyright']	=	str_replace("<%nburl2>","</a>", $lang['footer_copyright']);
		$lang['footer_board']		=	str_replace("<%1>","<a class=\"board\" href=\"$lb_domain\">$site_name</a>", $lang['footer_board']);

		template_hook("footer.template.php", "9");

	// Forum Jump

		$forum_id	=	escape_string($forum_id);

		$query211	=	"select ID, NAME from {$db_prefix}categories WHERE PARENT='0' ORDER BY FORUM_ORDER asc, ID asc" ;
		$result211	=	mysql_query($query211) or die("topic.php - Error in query: $query211") ;                                  
		while ($results211 = mysql_fetch_array($result211)){
			$parent_id		= 	$results211['ID'];
			$parent_name	=	$results211['NAME'];
			$parent_name	=	strip_slashes($parent_name);

			// PERMISSIONS!!! Can they view this forum???

				$can_view_forum="0";

				$query39		=	"select CAN_VIEW_FORUM from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$parent_id'" ;
				$result39		=	mysql_query($query39) or die("topic.php - Error in query: $query39") ;                                  
				$can_view_forum	=	mysql_result($result39, 0);

				if ($can_view_forum=='1'){
				
					$forum_title = forum_title($parent_id);
				
					template_hook("footer.template.php", "3");
				}


				$query2		=	"select ID, NAME from {$db_prefix}categories WHERE PARENT='$parent_id' ORDER BY FORUM_ORDER asc, ID asc" ;
				$result2	=	mysql_query($query2) or die("topic.php - Error in query: $query2") ;                                  
				while ($results2 = mysql_fetch_array($result2)){
					$forum_id	=	$results2['ID'];
					$forum_name	=	strip_slashes($results2['NAME']);

						// PERMISSIONS!!! Can they view this forum???

							$can_view_forum="0";

							$query32		=	"select CAN_VIEW_FORUM from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;
							$result32		=	mysql_query($query32) or die("topic.php - Error in query: $query32") ;
							$can_view_forum	=	mysql_result($result32, 0);

							if ($can_view_forum=='1'){

								$forum_title = forum_title($forum_id);
							
								template_hook("footer.template.php", "4");

								$query_sub = "select ID, NAME from {$db_prefix}categories WHERE PARENT='$forum_id' ORDER BY FORUM_ORDER asc, ID desc" ;
								$result_sub = mysql_query($query_sub) or die("move.php - Error in query: $query_sub") ;                                  
								while ($results_sub = mysql_fetch_array($result_sub)){
									$forum_sub_id	=	$results_sub['ID'];
									$forum_sub_name	=	strip_slashes($results_sub['NAME']);

										// PERMISSIONS!!! Can they view this forum???

											$can_view_sub_forum="0";

											$query_sub33		=	"select CAN_VIEW_FORUM from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_sub_id'" ;
											$result_sub33		=	mysql_query($query_sub33) or die("topic.php - Error in query: $query_sub33") ;                                  
											$can_view_sub_forum	=	mysql_result($result_sub33, 0);

											if ($can_view_sub_forum=='1'){
											
												$forum_title_sub = forum_title($forum_sub_id);
											
												template_hook("footer.template.php", "5");
											}

									}

							}
				}

				template_hook("footer.template.php", "6");

		}

		template_hook("footer.template.php", "7");
		template_hook("footer.template.php", "8");		
		template_hook("footer.template.php", "end");	

?>