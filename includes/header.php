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
|   header.php - displays header and sets out global variables
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

       #---------------------- 
	   # Get modules 
	   #---------------------- 

			$query29 = "select id, module_name from {$db_prefix}modules ORDER BY id DESC";
			$result29 = mysql_query($query29) or die("modules.php - Error in query: $query");
			
			$modules = array();
				
			while ($row = mysql_fetch_assoc($result29))

				$modules[$row['id']] = $row;
			
			$content = '<?php' . "\n";
			
			if (!empty($modules))
				$content .= '$cache = ' . var_export($modules, true) . ';';
			else
				$content .= '$cache = array();';
			$content .= "\n" . '?>';
			$handle = fopen('cache/modules.php', 'w');
			fwrite($handle, $content);
			fclose($handle); 	 		
		
	// get site information
	
		$Settings = $Cache->load('settings');
		
			$site_name				= strip_slashes($Settings['site_name']);
			$site_desc				= strip_slashes($Settings['site_desc']);
			$list_topics			= $Settings['list_topics'];
			$list_posts				= $Settings['list_posts'];
			$hot_topic				= $Settings['hot_topic'];
			$allow_attachments		= $Settings['allow_attachments'];
			$attach_img_size		= strip_slashes($Settings['attach_img_size']);
			$attach_avatar_size		= strip_slashes($Settings['attach_avatar_size']);
			$show_rss				= $Settings['show_rss'];
			$show_rss_limit			= $Settings['show_rss_limit'];
			$show_gamer_tags		= $Settings['show_gamer_tags'];
			$max_guest_clicks		= $Settings['max_guest_clicks'];
			$max_warn_level			= $Settings['max_warn'];
			$max_warn				= $Settings['max_warn'];
			$time_offset			= $Settings['time_offset'];
			$sef_urls				= $Settings['sef_urls'];
			$online_yesterday		= $Settings['online_yesterday'];
			$board_offline			= $Settings['board_offline'];
			$board_offline_reason	= strip_slashes($Settings['board_offline_reason']);
			$guest_register			= $Settings['guest_register'];
			$rules					= strip_slashes($Settings['rules']);
			$change_pass_time		= $Settings['change_pass_time'];
			$home					= strip_slashes($Settings['home']);
			$store_post_history	 	= $Settings['store_post_history'];
			$quick_edit				= $Settings['quick_edit'];
			$board_lang				= strip_slashes($Settings['board_lang']);
			$lb_version				= $Settings['lb_version'];
			$stats_topics			= $Settings['stats_topics'];
			$stats_posts			= $Settings['stats_posts'];
			$stats_members			= $Settings['stats_members'];
			$stats_member_id		= $Settings['stats_member_id'];
			$stats_member_name		= strip_slashes($Settings['stats_member_name']);
			$stats_post_id			= $Settings['stats_post_id'];
			$stats_post_title		= $Settings['stats_post_title'];
			$stats_post_forum		= $Settings['stats_post_forum'];
			$stats_post_time		= $Settings['stats_post_time'];
			$stats_post_topic		= $Settings['stats_post_topic'];
			$default_board_email	= strip_slashes($Settings['board_email']);
			$register_bar			= $Settings['register_bar'];
			$module_order			= $Settings['module_order'];
			$module_limit			= $Settings['module_limit'];
			$module_method			= strip_slashes($Settings['module_method']);
			$theme_order			= $Settings['theme_order'];
			$theme_limit			= $Settings['theme_limit'];
			$theme_method			= strip_slashes($Settings['theme_method']);
			$auto_merge				= $Settings['auto_merge'];
			$akismet_key			= strip_slashes($Settings['akismet_key']);
			$recaptcha_private		= strip_slashes($Settings['recaptcha_private']);
			$recaptcha_public		= strip_slashes($Settings['recaptcha_public']);
			$username_length		= $Settings['username_length'];
			$usertitle_length		= $Settings['usertitle_length'];
			$trashcan_enabled		= $Settings['trashcan_enabled'];
			$trashcan_forum			= $Settings['trashcan_forum'];
			$trashcan_delete_time	= $Settings['trashcan_delete_time'];
			$trashcan_delete_ran	= $Settings['trashcan_delete_ran'];
			
	// check if password is allowed to expire
	
		if($change_pass_time <= 0) {
			$allow_pass_exp = 0;
		} else {
			$allow_pass_exp = 1;
		}

	// set default email address
	
		$board_email = "noreply@" . preg_replace('/^www\./', '', $_SERVER['HTTP_HOST'], 1);

	// remove .domain.com problem email address
	
		$board_email = str_replace("noreply@.", "noreply@", $board_email);
		
	// now set it as default address
		
		ini_set('sendmail_from', $board_email);

	// unset home
		if ($home==''){
			unset($home);
		}

	// check .htaccess exists. If it doesn't, don't use sef_url's
	
		if (!file_exists(".htaccess")){
			$sef_urls="0";
		}

	// Check their login details match what we've got held in the database
	// and if they are guff, chuck them off...

		if (isset($_COOKIE['lb_name'])){

			$lb_name		=	escape_string($_COOKIE['lb_name']);
			$lb_name		=	str_replace("'", "", $lb_name);
			
			if (!preg_match('|^[a-zA-Z0-9!@#$%^&*();:_.\\\\ /\t-]+$|', $lb_name) ) {
			
				setcookie("lb_name", $name, time() -1);
				setcookie("lb_password", $password, time() -1);

				lb_redirect("index.php?page=error&error=32","error/32");

			}
			$lb_password	=	escape_string($_COOKIE['lb_password']);

			// get member details...
			
				$fields = array(
					'm.id', 'm.role', 'm.warn_level', 'm.suspend_date', 'm.verified', 'm.password_time', 'm.read_all_posts', 'm.board_lang', 
					'm.banned', 'm.register_date', 'm.new_pms', 'm.nationality', 'm.moderate', 'm.time_offset', 'm.show_fast_reply'
				);
				
				$tables = array(
					'default' => array(
						0 => array(
							'name'	=> 'members',
							'short'	=> 'm'
						)
					)
				);
				
				$where = array('name = "' . $name . '"', 'password = "' . $password  . '"');
				
				$limit	= array();
				$order	= array();
				
				/*
				Allow modules to select extra stuff
			*/
			
				if ($code = $Plugin->hook('header', 'member_info_query'))
				{
					eval($code);
				}
			
				$query_member_stuff		= buildQuery($fields, $tables, $where, $order, $limit);
				$result_member_stuff	= mysql_query($query_member_stuff) or die("header.php - Error in query: $query_member_stuff") ;
				$secure					= mysql_num_rows($result_member_stuff);
				$results_member_stuff	= mysql_fetch_assoc($result_member_stuff);
				
					$role				= $results_member_stuff['role'];
					$my_id				= $results_member_stuff['id'];
					$warn_level			= $results_member_stuff['warn_level'];
					$suspend_date		= $results_member_stuff['suspend_date'];
					$verified			= $results_member_stuff['verified'];
					$read_all_posts 	= $results_member_stuff['read_all_posts'];
					$member_lang		= $results_member_stuff['board_lang'];
					$member_banned		= $results_member_stuff['banned'];
					$password_time		= $results_member_stuff['password_time'];
					$register_date		= $results_member_stuff['register_date'];
					$new_pms			= $results_member_stuff['new_pms'];
					$nationality		= $results_member_stuff['nationality'];
					$moderated			= $results_member_stuff['moderate'];
					$member_offset		= $results_member_stuff['time_offset'];
					$time_offset		= $member_offset;
					$show_fast_reply	= $results_member_stuff['show_fast_reply'];
					$password_time		= $password_time + ((24*60*60)*$change_pass_time);
					$current_time		= time();

			// are they a guest? If so, set member group accordingly...
				
				if ($my_id < '0'){
					$role="4";
				}

		// check if paypal subscription is still valid...
		
			$query219 = "select SUBSCRIPTION, EXPIRES from {$db_prefix}group_upgrade_details WHERE MEMBER ='$my_id'" ;
			$result219 = mysql_query($query219) or die("members.php - Error in query: $query219");
			$subscribe_number = mysql_num_rows($result219);

			if ($subscribe_number!='0'){ 
			                                 
				while ($results219 = mysql_fetch_array($result219)){
					$subscription	= $results219['SUBSCRIPTION'];
					$expires		= $results219['EXPIRES'];
				}

				if ($current_time >= $expires){

				// downgrade them....
				
					$query29 = "select UPGRADE_FROM from {$db_prefix}group_upgrade WHERE UPGRADE_ID='$subscription'" ;
					$result29 = mysql_query($query29) or die("upgrade.php - Error in query: $query29") ;                                  
					$upgrade_from = mysql_result($result29, 0);

					mysql_query("UPDATE {$db_prefix}members SET role = '$upgrade_from' WHERE role = '$upgrade_to' AND ID='$my_id'");
					mysql_query("DELETE from {$db_prefix}group_upgrade_details WHERE member='$my_id' AND subscription='$subscription'");

				}

			}
			
		// if the member info is wrong, remove cookie and redirect

			if ($secure=='0'){
				setcookie("lb_name", $name, time() -1);
				setcookie("lb_password", $password, time() -1);
				if ($_GET['page']!='login'){

					template_hook("header.template.php", "form_1");
					lb_redirect("index.php?page=login","login");

				}
			}
			
		// still to verify?	
		
			elseif($verified=='0'){
				setcookie("lb_name", $name, time() -1);
				setcookie("lb_password", $password, time() -1);
				
				if ($_GET['page']!='verify'){

					template_hook("header.template.php", "form_2");
					lb_redirect("index.php?page=verify","verify");

				}
			}

		// has their password expired?	
			
			elseif($password_time < $current_time && $allow_pass_exp == 1){
				if ($_GET['page']!='myoptions' && $_GET['act']!='password'){

					template_hook("header.template.php", "form_3");
					lb_redirect("index.php?page=myoptions&act=password","myoptions/password");

				}
			}


			else{
			
			// do nothing
			
			}
		}
		
	// not logged in? guest alert!

		elseif (!isset($_COOKIE['lb_name'])){
			$role="4";
		}
		
	// set language

		if (isset($member_lang) && $member_lang!=''){
			$board_lang="$member_lang";
		}

	// Do you speekee english cookie?
	
		if (isset($_COOKIE['lb_lang']) && (!isset($_COOKIE['lb_name']))){
			$board_lang = escape_string($_COOKIE['lb_lang']);
		}

	// Prepare all images to use...
	
		include "scripts/php/image_check.php";

	// Get global permissions...
	
		include "includes/pages/permissions.php";


	// Check in case themember is suspended...
	
		$current_date_and_time = time();

		if (isset($suspend_date)){

			if ($current_date_and_time <= $suspend_date){
				if ($_GET['page']!='suspended' && $_GET['page']!='logout'){
					template_hook("header.template.php", "form_4");
					lb_redirect("index.php?page=suspended","suspended");
				}
			}
		}
		
	// are they banned?	
	
		if (isset($warn_level) && isset($member_banned)){
			if ($max_warn_level <= $warn_level OR $member_banned=='1'){
				if ($_GET['page']!='banned' && $_GET['page']!='logout'){

					template_hook("header.template.php", "form_5");
					lb_redirect("index.php?page=banned","banned");

				}
			}
		}

	// is this a forum?
	
		if (isset($_GET['forum']) && !isset($_GET['page'])){

			$forum = (int) $_GET['forum'];

			$query22 = "select NAME from {$db_prefix}categories WHERE ID ='$forum'" ;
			$result22 = mysql_query($query22) or die("header.php - Error in query: $query22") ;                                  
			while ($results22 = mysql_fetch_array($result22)){
				$location_name = $results22['NAME'];
				$location_name=strip_slashes($location_name);
			}
		}
		
	// or is it a topic?	
		
		elseif(isset($_GET['topic']) && !isset($_GET['page'])){

			$topic = (int) $_GET['topic'];

			$query22 = "select TITLE from {$db_prefix}posts WHERE TOPIC_ID ='$topic' AND TITLE!=''" ;
			$result22 = mysql_query($query22) or die("header.php - Error in query: $query22") ;                                  
			while ($results22 = mysql_fetch_array($result22)){
				$location_name	= $results22['TITLE'];
				$location_name	= strip_slashes($location_name);
			}
		}

	// Check the set time offset...

		if(isset($_COOKIE['lb_name'])){
			$name=escape_string($_COOKIE['lb_name']);
		}
		
		if(isset($_COOKIE['lb_password'])){
			$password=escape_string($_COOKIE['lb_password']);
		}

	// check for the existance of private messages, moderated members
	// and reported posts
		
		if (isset($my_id)){

			$messages_number=$new_pms;

			if ($can_pm=='0'){
				$messages_number="0";
			}

			$query26 = "select ID from {$db_prefix}report" ;
			$result26 = mysql_query($query26) or die("header.php - Error in query: $query26");
			$report_number	= mysql_num_rows($result26);

			$query26 = "select ID from {$db_prefix}moderate" ;
			$result26 = mysql_query($query26) or die("header.php - Error in query: $query26");
			$moderate_number = mysql_num_rows($result26);

		}

		if (!isset($_COOKIE['lb_name'])){
			$new_posts="";
			$messages_number="";
		}
		
	// find out the number of unread posts

		if (isset($lb_name)){

			$unread_posts="0";

			// Now go through each forum...

				$query211 = "select FORUM_ID from {$db_prefix}permissions WHERE GROUP_ID='$role' AND CAN_READ_TOPICS='1' ORDER BY FORUM_ID desc" ;
				$result211 = mysql_query($query211) or die("header.php - Error in query: $query211");                                  
				while ($results211 = mysql_fetch_array($result211)){
					$forum_id	= $results211['FORUM_ID'];
					
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
					}
				}

			$new_posts=number_format($unread_posts);

		}
		else{
			$unread_posts="0";
		}

	// Get language files...

		include "lang/$board_lang/lang_forum.php";

		if (isset($_GET['page']) && $_GET['page'] == 'admin'){
			include "lang/$board_lang/lang_admin.php";
		}
	
		if (isset($_GET['page']) && $_GET['page'] == 'error'){
			include "lang/$board_lang/lang_error.php";
		}

		if (isset($_GET['page']) && $_GET['page'] == 'myoptions'){
			include "lang/$board_lang/lang_myoptions.php";
		}
	
		if (isset($_GET['page']) && $_GET['page'] == 'help'){
			include "lang/$board_lang/lang_help.php";
		}	

	// Set variables for some date things (trust me, we need this)

		$format_time	=	$lang['date_format'];
		$date_today		=	$lang['date_today'];
		$date_yesterday	= 	$lang['date_yesterday'];
		$date_minute	= 	$lang['date_minute'];
		$date_minutes	= 	$lang['date_minutes'];	
		$date_hour		= 	$lang['date_hour'];	
		$date_hours		= 	$lang['date_hours'];		

	// Get the script that handles locations

		include "scripts/php/location.php";

		$location_name = location_page("header");
		$location_text = "$site_name, $site_desc, $location_name";

	// prepare the SEO meta for topics	
		
		if (isset($_GET['topic']) && ($_GET['page']!='search')){

			$location_text	= '';
			$topic			= (int) $topic;

			$query211 = "select CONTENT from {$db_prefix}posts WHERE TOPIC_ID='$topic' AND TITLE!=''";
			$result211 = mysql_query($query211) or die("topic.php - Error in query: $query211");
			$location_results = mysql_num_rows($result211);	

			if ($location_results!='0'){
				$location_text_string = strip_slashes(mysql_result($result211, 0));

				$location_text_string = explode(" ", $location_text_string);
				for ($wordCounter=0; $wordCounter<30; $wordCounter++) {
					$location_text .= $location_text_string[$wordCounter]." ";
				}
				 $location_text = $location_text."...";
				 $location_text = str_replace(" ...", "...", $location_text);
				 $location_text = str_replace("<br />", "", $location_text);
				 $location_text = str_replace("\r\n", " ", $location_text);
				 
				 function stripBBCode($text_to_search) {
					 $pattern = '|[[\/\!]*?[^\[\]]*?]|si';
					 $replace = '';
					 return preg_replace($pattern, $replace, $text_to_search);
				}

				$location_text = stripBBCode($location_text);
				$location_text = strip_tags($location_text); 
			}
		}
		
	// prepare the SEO meta for forums	
		
		elseif (isset($_GET['forum']) && ($_GET['page']!='search')){

			$location_text	= '';
			$forum			= (int) $forum;

			$query211 = "select DESCRIPTION from {$db_prefix}categories WHERE ID='$forum'";
			$result211 = mysql_query($query211) or die("topic.php - Error in query: $query211");
			$location_results = mysql_num_rows($result211);	

			if ($location_results!='0'){
				$location_text_string = strip_slashes(mysql_result($result211, 0));

				$location_text_string = explode(" ", $location_text_string);
				for ($wordCounter=0; $wordCounter<30; $wordCounter++) {
					$location_text .= $location_text_string[$wordCounter]." ";
				}
				 $location_text = $location_text."...";
				 $location_text = str_replace(" ...", "...", $location_text);
				 $location_text = str_replace("<br />", "", $location_text);
				 $location_text = str_replace("\r\n", " ", $location_text);
				 
				 function stripBBCode($text_to_search) {
					 $pattern = '|[[\/\!]*?[^\[\]]*?]|si';
					 $replace = '';
					 return preg_replace($pattern, $replace, $text_to_search);
				}

				$location_text = stripBBCode($location_text);
				$location_text = strip_tags($location_text); 
			}
		}
		
			/*
			If trashcan is running, delete any posts older than the cut-off point
		*/
		
			if ($trashcan_enabled && ($trashcan_delete_ran <= time() - (60 * 60 * 24)))
			{
			
				/*
				Change delete frequency into timestamp value
			*/
			
				$multiplier			= 60 * 60 * 24;
				$trashcan_delete	= explode(';', $trashcan_delete_time);
			
				switch ($trashcan_delete[1])
				{
					case 0:
					default:
						$trashcan_time = 0;
						break;
					
					case 1:
						$trashcan_time = $trashcan_delete[0] * $multiplier;
						break;
						
					case 2:
						$trashcan_time = $trashcan_delete[0] * $multiplier * 7;
						break;
						
					case 3:
						$trashcan_time = $trashcan_delete[0] * $multiplier * 30;
						break;
					
					case 4:
						$trashcan_time = $trashcan_delete[0] * $multiplier * 365;
						break;
				}
				
				$currentTime = time();
				
				if ($trashcan_time != 0)
				{
					$query = mysql_query('
						SELECT id, topic_id
						FROM ' . $db_prefix . 'posts
						WHERE trashcan_time <= (' . ($currentTime - $trashcan_time) . ') AND title != "" AND forum_id = ' . $trashcan_forum
					);
					$found = mysql_num_rows($query);
					
					while ($row = mysql_fetch_assoc($query))
					{
						$query2 = mysql_query('SELECT id FROM ' . $db_prefix . 'posts WHERE topic_id = ' . $row['topic_id']);
						
						while ($row2 = mysql_fetch_assoc($query2))
						{
							$query3 = mysql_query('SELECT filename FROM ' . $db_prefix . 'attachments WHERE postid = ' . $row['id']);
							
							while ($row3 = mysql_fetch_assoc($query2))
							{
								unlink($lb_root . 'uploads/attachments/' . $row3['filename']);
								unlink($lb_root . 'uploads/attachments/t_' . $row3['filename']);
							}
							
							mysql_query('DELETE FROM ' . $db_prefix . 'attachments WHERE postid = ' . $row2['id']);
							mysql_query('DELETE FROM ' . $db_prefix . 'moderate WHERE postid = ' . $row2['id']);
						}
						
						/*
						Remove the posts and any edits made to them
					*/

						mysql_query('DELETE FROM ' . $db_prefix . 'posts WHERE topic_id = ' . $row['topic_id']);
						mysql_query('DELETE FROM ' . $db_prefix . 'posts_edit WHERE topic = ' . $row['topic_id']);
					}
					
					if ($found > 0)
					{
						require $lb_root . 'scripts/php/auto_cache.php';
					}
				}
				
				mysql_query('UPDATE ' . $db_prefix . 'settings SET trashcan_delete_ran = ' . $currentTime);
			}

		template_hook("header.template.php", "start");
		template_hook("header.template.php", "1");

	// sort some cache control
	
		header("Cache-Control: private");
		header("Pragma: private");
		
	// pull in some clever templates

		template_hook("header.template.php", "before_body");
		template_hook("header.template.php", "after_body");

	// parse lang file to show number of new messages	
		
		$lang['navbar_message_new'] = str_replace("<%1>",$messages_number, $lang['navbar_message_new']);

	// now even more templates	
		
		template_hook("nav_bar.template.php", "start");
		template_hook("nav_bar.template.php", "1");
		template_hook("nav_bar.template.php", "2");
		template_hook("nav_bar.template.php", "3");
		template_hook("nav_bar.template.php", "end");
		
		template_hook("member_bar.template.php", "start");
		template_hook("member_bar.template.php", "1");
		template_hook("member_bar.template.php", "2");
		template_hook("member_bar.template.php", "end");

		template_hook("header.template.php", "2");

	// Now include the members session information
	
		include "includes/forums/session.php";

	// if the board is offline, redirect if not admin
		
		if ($can_change_site_settings!='1' && $board_offline=='1' && $_GET['page']!='offline' && $_GET['page']!='login' && $_GET['page']!='verify'){
			template_hook("header.template.php", "form_6");
			lb_redirect("index.php?page=offline","offline");
		}

	// require registration to view board?	
		
		if ($can_view_board=='0' && $_GET['page']!='error' && $_GET['page']!='register' && $_GET['page']!='login' && $_GET['page']!='verify'){
			lb_redirect("index.php?page=error&error=30","error/30");
		}

	// final template hook. PHEW!	
	
		template_hook("header.template.php", "end");

?>