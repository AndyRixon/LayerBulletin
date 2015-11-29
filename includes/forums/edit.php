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
|   edit.php - Edit forum posts
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

	template_hook("forums/edit.template.php", "start");

	if ($can_edit_own_posts=='0'){
		if ($can_edit_others_posts=='0'){

			lb_redirect("index.php?page=error&error=5","error/5");

		}
	}
	else{

		if (isset($_POST['post'])){
			$post	= escape_string($_POST['post']);
		}
		else{
			$post	= escape_string($_GET['post']);
		}
		
		$post_content = $_POST['content'];

		$content_prepare = "editcontent_$post";

		if ($post_content==''){
			$post_content = $_POST[$content_prepare];
		}

		$query211 = "select ID, TITLE, DESCRIPTION, CONTENT, TOPIC_ID, MEMBER, STICKY, ANNOUNCE, FORUM_ID from {$db_prefix}posts WHERE ID='$post'" ;
		$result211 = mysql_query($query211) or die("edit.php - Error in query: $query211") ;                                  
		while ($results211 = mysql_fetch_array($result211)){
			$id 			= $results211['ID'];
			$member 		= $results211['MEMBER'];
			$title 			= $results211['TITLE'];
			$description 	= $results211['DESCRIPTION'];
			$content 		= $results211['CONTENT'];
			$topic_id 		= $results211['TOPIC_ID'];
			$sticky 		= $results211['STICKY'];
			$announce		= $results211['ANNOUNCE'];
			$forum_id 		= $results211['FORUM_ID'];
		}

		$name		= escape_string($_COOKIE['lb_name']);
		$password	= escape_string($_COOKIE['lb_password']);

		$query2199 = "select ID from {$db_prefix}members WHERE NAME='$name' AND PASSWORD='$password'" ;
		$result2199 = mysql_query($query2199) or die("edit.php - Error in query: $query2199") ;                                  
		$creator_id = mysql_result($result2199, 0);

		if($can_edit_others_posts =='0' && $creator_id!=$member){

			lb_redirect("index.php?page=error&error=5","error/5");

		}

		if ($post_content!=''){

			$post		= escape_string($_POST['post']);
			$token_id 	= escape_string($_POST['token_id']);
			$token_name = "token_edit_$post$token_id";

			if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

				// Post the edit...

					$name		= escape_string($_COOKIE['lb_name']);
					$password	= escape_string($_COOKIE['lb_password']);

					$query211 = "select ID from {$db_prefix}members WHERE NAME='$name' AND PASSWORD='$password'" ;
					$result211 = mysql_query($query211) or die("edit.php - Error in query: $query211") ;                                  
					$id = mysql_result($result211, 0);

					$time			= time();
					$title			= escape_string($_POST['subject']);
					$description	= escape_string($_POST['description']);
					$content		= escape_string($post_content);
					$sticky			= escape_string($_POST['sticky']);
					$locked			= escape_string($_POST['locked']);
					$announce		= escape_string($_POST['announce']);
					$forum			= escape_string($_POST['forum']);
					$topic			= escape_string($_POST['topic']);
					$edit_reason	= escape_string($_POST['edit_reason']);
					$edit_time 		= time();

					$query211 = "select CONTENT from {$db_prefix}posts WHERE ID='$post'" ;
					$result211 = mysql_query($query211) or die("edit.php - Error in query: $query211") ;                                  
					$original_content = mysql_result($result211, 0);
					$original_content = addslashes($original_content);

					if($store_post_history=='1'){
						mysql_query("INSERT INTO {$db_prefix}posts_edit (topic, post, member, content, edit_reason, date) VALUES ('$topic', '$post', '$my_id', '$original_content', '$edit_reason', '$edit_time')");
					}
					if ($moderated=='1'){
						mysql_query("UPDATE {$db_prefix}posts SET title='$title', description='$description', content='$content', edit_member='$id', edit_time='$time', edit_reason='$edit_reason', sticky='$sticky', announce='$announce', locked='$locked', forum_id='$forum', approved='0' WHERE id = '$post' AND topic_id='$topic'");
						mysql_query("INSERT INTO {$db_prefix}moderate (postid, title, member_id, member_name, time) VALUES ('$post', '$title', '$my_id', '$name', '$time')");
					}
					else{
						mysql_query("UPDATE {$db_prefix}posts SET title='$title', description='$description', content='$content', edit_member='$id', edit_time='$time', edit_reason='$edit_reason', sticky='$sticky', announce='$announce', locked='$locked', forum_id='$forum', approved='1' WHERE id = '$post' AND topic_id='$topic'");
					}
					
					// if the title is not blank, then update the poll
					
					if ($title!=''){
					
						$question	= escape_string($_POST['question']);
						$option1	= escape_string($_POST['option1']);
						$option2	= escape_string($_POST['option2']);
						$option3	= escape_string($_POST['option3']);
						$option4	= escape_string($_POST['option4']);
						$option5	= escape_string($_POST['option5']);
						$option6	= escape_string($_POST['option6']);
						$option7	= escape_string($_POST['option7']);
						$option8	= escape_string($_POST['option8']);
						$option9	= escape_string($_POST['option9']);
						$option10	= escape_string($_POST['option10']);
						$poll		= escape_string($_POST['poll']);

						mysql_query("UPDATE {$db_prefix}polls SET question='$question', option1='$option1', option2='$option2', option3='$option3', option4='$option4', option5='$option5', option6='$option6', option7='$option7', option8='$option8', option9='$option9', option10='$option10'  WHERE id = '$poll'");

						// Remove votes for poll options that have been deleted...
						
							if ($_POST['question']==''){
								mysql_query("DELETE FROM {$db_prefix}polls WHERE id ='$poll'");
								mysql_query("DELETE FROM {$db_prefix}polls_votes WHERE poll_id ='$poll'");
							}

							elseif ($_POST['option1']==''){
								mysql_query("DELETE FROM {$db_prefix}polls_votes WHERE poll_id ='$poll' AND vote='1'");
							}
							elseif ($_POST['option2']==''){
								mysql_query("DELETE FROM {$db_prefix}polls_votes WHERE poll_id ='$poll' AND vote='2'");
							}
							elseif ($_POST['option3']==''){
								mysql_query("DELETE FROM {$db_prefix}polls_votes WHERE poll_id ='$poll' AND vote='3'");
							}
							elseif ($_POST['option4']==''){
								mysql_query("DELETE FROM {$db_prefix}polls_votes WHERE poll_id ='$poll' AND vote='4'");
							}
							elseif ($_POST['option5']==''){
								mysql_query("DELETE FROM {$db_prefix}polls_votes WHERE poll_id ='$poll' AND vote='5'");
							}
							elseif ($_POST['option6']==''){
								mysql_query("DELETE FROM {$db_prefix}polls_votes WHERE poll_id ='$poll' AND vote='6'");
							}
							elseif ($_POST['option7']==''){
								mysql_query("DELETE FROM {$db_prefix}polls_votes WHERE poll_id ='$poll' AND vote='7'");
							}
							elseif ($_POST['option8']==''){
								mysql_query("DELETE FROM {$db_prefix}polls_votes WHERE poll_id ='$poll' AND vote='8'");
							}
							elseif ($_POST['option9']==''){
								mysql_query("DELETE FROM {$db_prefix}polls_votes WHERE poll_id ='$poll' AND vote='9'");
							}
							elseif ($_POST['option10']==''){
								mysql_query("DELETE FROM {$db_prefix}polls_votes WHERE poll_id ='$poll' AND vote='10'");
							}
					}
						// Now add new attachments...
						// Update the attachments table with the post ID...

							$post	= escape_string($_POST['post']);
							$hash	= escape_string($_POST['hash']);
							$topic	= escape_string($_POST['topic']);

							mysql_query("UPDATE {$db_prefix}attachments SET postid='$post', topicid='$topic' WHERE hash = '$hash'");

							template_hook("forums/edit.template.php", "form");

						// perform auto-cache
						
							include "scripts/php/auto_cache.php";		
							lb_redirect("index.php?page=findpost&post=$post","findpost/$post");

			}
			else{
				lb_redirect("index.php?page=error&error=28","error/28");
			}
		}
		else{

			$token_id 				= md5(microtime());
			$token 					= md5(uniqid(rand(),true));
			$post					= escape_string($_GET['post']);
			$token_name 			= "token_edit_$post$token_id";
			$_SESSION[$token_name] 	= $token;

			$query211 = "select ID, TITLE, DESCRIPTION, CONTENT, TOPIC_ID, MEMBER, STICKY, ANNOUNCE, LOCKED from {$db_prefix}posts WHERE ID='$post'" ;
			$result211 = mysql_query($query211) or die("edit.php - Error in query: $query211") ;                                  
			while ($results211 = mysql_fetch_array($result211)){
				$id 			= $results211['ID'];
				$member 		= $results211['MEMBER'];
				$title 			= strip_slashes($results211['TITLE']);
				$description 	= strip_slashes($results211['DESCRIPTION']);
				$content 		= strip_slashes($results211['CONTENT']);
				$topic_id 		= $results211['TOPIC_ID'];
				$sticky 		= $results211['STICKY'];
				$announce 		= $results211['ANNOUNCE'];
				$locked 		= $results211['LOCKED'];
			}
			
			$content		= str_replace("<br />","",$content);
			$title			= str_replace("'","&#39;",$title);
			$description	= str_replace("'","&#39;",$description);

			template_hook("forums/edit.template.php", "2");

				// START Polls options...

					$post	= escape_string($_GET['post']);

					$query218 = "select TOPIC_ID from {$db_prefix}posts WHERE ID='$post'" ;
					$result218 = mysql_query($query218) or die("edit.php - Error in query: $query218") ;                                  
					$topic_id_for_poll = mysql_result($result218, 0);

					$query217 = "select ID, QUESTION, OPTION1, OPTION2, OPTION3, OPTION4, OPTION5, OPTION6, OPTION7, OPTION8, OPTION9, OPTION10 from {$db_prefix}polls WHERE TOPIC_ID='$topic_id_for_poll'" ;
					$result217 = mysql_query($query217) or die("edit.php - Error in query: $query217") ;                                  
					while ($results217 = mysql_fetch_array($result217)){
						$poll_id 	= strip_slashes($results217['ID']);
						$question 	= strip_slashes($results217['QUESTION']);
						$option1 	= strip_slashes($results217['OPTION1']);
						$option2 	= strip_slashes($results217['OPTION2']);
						$option3 	= strip_slashes($results217['OPTION3']);
						$option4 	= strip_slashes($results217['OPTION4']);
						$option5 	= strip_slashes($results217['OPTION5']);
						$option6 	= strip_slashes($results217['OPTION6']);
						$option7 	= strip_slashes($results217['OPTION7']);
						$option8 	= strip_slashes($results217['OPTION8']);
						$option9 	= strip_slashes($results217['OPTION9']);
						$option10 	= strip_slashes($results217['OPTION10']);
					}

					if ($question!='' && $title!=''){
						template_hook("forums/edit.template.php", "3");
					}
					
				// END Polls options...

				// START files options...

				// Get hash for temporary ID
				// Keep it as we've had before for this post to keep everything uniform..

					$post	= escape_string($_GET['post']);

					$query2178 = "select HASH from {$db_prefix}attachments WHERE POSTID='$post' LIMIT 1" ;
					$result2178 = mysql_query($query2178) or die("edit.php - Error in query: $query2178") ;                                  
					$hash = mysql_result($result2178, 0);

					if ($hash=='' OR $hash=='0'){
						$hash=time();
					}

				// Get forum ID...

					$post	= escape_string($_GET['post']);

					$query = "select FORUM_ID from {$db_prefix}posts WHERE ID='$post'" ;
					$result = mysql_query($query) or die("edit.php - Error in query: $query") ;                                  
					$forum_id = mysql_result($result, 0);


				// PERMISSIONS!!! Can they view this forum???

					$can_add_attachment="0";

					$query3 = "select CAN_ADD_ATTACHMENT from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;
					$result3 = mysql_query($query3) or die("edit.php - Error in query: $query3") ;                                  
					$can_add_attachment = mysql_result($result3, 0);


					if ($can_add_attachment=='1'){

						$name		= escape_string($_COOKIE['lb_name']);
						$password	= escape_string($_COOKIE['lb_password']);

						$query3 = "select ID from {$db_prefix}members WHERE NAME='$name' AND PASSWORD='$password'" ;
						$result3 = mysql_query($query3) or die("edit.php - Error in query: $query3") ;                                  
						$uploader_id = mysql_result($result3, 0);

						template_hook("forums/edit.template.php", "4");

					}

					template_hook("forums/edit.template.php", "5");

		}
	}

	template_hook("forums/edit.template.php", "end");

?>