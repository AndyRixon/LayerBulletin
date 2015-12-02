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
|   lang_forum.php - Language file - Forum Areas - English
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.<br />";
	exit();
}

$lang = array (

	// This block deals with the header, footer and navigation bar

		// header
			'header_tab_forums_new'      	=> "View New Posts",
			'header_guest'      			=> "You are browsing this forum as a guest. Click this bar to register and get full member benefits.",

		// nav_bar
			'navbar_loggedin'				=> "Logged in as: ",
			'navbar_guest'					=> "Hello <i>Guest</i>!",
			'navbar_search'					=> "Search",
			'navbar_rules'					=> "Forum Rules",
			'navbar_login'					=> "Login",
			'navbar_logout'					=> "Logout",
			'navbar_register'				=> "Register",
			'navbar_admin'					=> "Admin CP",
			'navbar_mod'					=> "Moderator CP",
			'navbar_user'					=> "My Options",	
			'navbar_message_new'			=> "<%1> New Message(s)",
			'navbar_message'				=> "No New Messages",
			'navbar_report'					=> "New Reported Posts",
			'navbar_moderated'				=> "New Moderated Posts",
			'navbar_help'					=> "Help",
			'navbar_home'					=> "Home",
			'navbar_rules'					=> "Rules",
			'navbar_members'				=> "Members",
			'navbar_offline'				=> "This board's status is currently set to 'Offline' which means only administrators can view this forum.",

		//footer
			'footer_theme'       			=> "Select Theme",
			'footer_theme_title'			=> "Theme Selector",
			'footer_language_title'			=> "Language",
			'footer_language'				=> "Select Language",
			'footer_copyright'     			=> "Powered by <%nburl>LayerBulletin v<%1><%nburl2>",
			'footer_board'     				=> "All Content &copy; <%1>",
			'footer_nav'					=> "Site Navigation",
			'footer_nav_areas'				=> "Site Areas",
			'footer_nav_forum'				=> "Forum Index",
			'footer_nav_admin'				=> "Admin CP",
			'footer_nav_mod'				=> "Moderator CP",
			'footer_nav_user'				=> "My Options",
			'footer_nav_messages'			=> "My Messages",
			'footer_nav_search'				=> "Search",
			'footer_nav_forum_cats'			=> "Forum Categories",


	// This block deals with forum areas (addreply, newpost, board, edit, lock, move etc.)
	// Some language elements may be used more than once on different pages

		// addreply
			'addreply_emoticons'			=> "View Code",
			'addreply_attach'				=> "Attach A File",

		// board
			'board_forum'					=> "Forum",
			'board_subject'					=> "Subject",
			'board_topics'					=> "Topics",
			'board_posts'					=> "Posts",
			'board_lastpost'				=> "Last Post",
			'board_lastpost_by'				=> "Last Post By:",
			'board_forum_locked'			=> "Locked Forum",
			'board_forum_new_no'			=> "No New Posts",
			'board_forum_sticky_new_no'		=> "(Sticky Topic) No New Posts",
			'board_forum_hot_new_no'		=> "(Hot Topic) No New Posts",	
			'board_forum_new'				=> "New Posts",
			'board_forum_sticky_new'		=> "(Sticky Topic) New Posts",
			'board_forum_hot_new'			=> "(Hot Topic) New Posts",
			'board_forum_topic_locked'		=> "Locked Topic",
			'board_subforums'				=> "Subforums:",
			'board_sub_forums'				=> "Sub-Forums",
			'board_topic_in'				=> "In:",
			'board_topic_restricted'		=> "<i>Restricted Forum</i>",
			'board_topic_by'				=> "By:",
			'board_topic_unregistered'		=> "-Unregistered-",
			'board_page'					=> "Page:",
			'board_topic_new'				=> "Post New Topic",
			'board_rss'						=> "Get the RSS feed for this forum",
			'board_unsubscribe'				=> "Unsubscribe From This Forum",
			'board_subscribe'				=> "Subscribe To This Forum",
			'board_forum_subject'			=> "Subject",
			'board_forum_starter'			=> "Topic Starter",
			'board_forum_replies'			=> "Replies",
			'board_forum_views'				=> "Views",
			'board_forum_lastpost'			=> "Last Post",
			'board_forum_unread'			=> "View Unread Posts",
			'board_announcement'			=> "Announcement:",
			'board_online_list'				=> "<strong><%1></strong> Guest(s), <strong><%2></strong> Member(s) Viewing This Forum:",
			'board_search'					=> "Search Forum...",

		// edit
			'edit_post'						=> "Edit Post",
			'edit_subject'					=> "Topic Subject",
			'edit_desc'						=> "Topic Description",
			'edit_poll'						=> "Poll Options",
			'edit_poll_question'			=> "Question:",
			'edit_poll_option1'				=> "Option 1:",
			'edit_poll_option2'				=> "Option 2:",
			'edit_poll_option3'				=> "Option 3:",
			'edit_poll_option4'				=> "Option 4:",
			'edit_poll_option5'				=> "Option 5:",
			'edit_poll_option6'				=> "Option 6:",
			'edit_poll_option7'				=> "Option 7:",
			'edit_poll_option8'				=> "Option 8:",
			'edit_poll_option9'				=> "Option 9:",
			'edit_poll_option10'			=> "Option 10:",
			'edit_poll_multiple'			=> "Multiple Votes?",	
			'edit_file'						=> "File Attachments:",
			'edit_sticky'					=> "Sticky Topic?",
			'edit_lock'						=> "Lock Topic?",
			'edit_announce'					=> "Global Announcement?",
			'edit_reason'					=> "Reason for Edit",

		// index
			'index_markread'				=> "Mark All Topics Read",
			'index_time'					=> "Time Now Is:",

		// merge
			'merge_topic'					=> "Merge Topic",
			'merge_select'					=> "Select Forum & Topic To Merge To",
			'merge_select_desc'				=> "Firstly, select the forum with the topic you wish to merge this thread into, then select the actual thread that you wish to merge with this one. Posts will be sorted in date order.",
			'merge_select_forum'			=> "Select Forum",
			'merge_select_topic'			=> "Select Topic",

		// move
			'move_topic'					=> "Move Topic",
			'move_select'					=> "Select a forum to move this topic to, then hit Submit.",
			'move_to'						=> "Move To:",
			'move_shadow'					=> 'Create shadow topic?',

		// newpost
			'newpost_heading'				=> "New Topic",
			'newpost_subject'				=> "Topic Subject",
			'newpost_description'			=> "Topic Description",
			'newpost_poll'					=> "Add a Poll to this Topic",			

		// online
			'online_stats_header'			=> "Forum Stats",
			'online_stats_posts'			=> "<%posts> posts in <%topics> topics by <%1> member(s).",
			'online_stats_member'			=> "Latest Member: ",
			'online_stats_latest'			=> "Latest Post:",
			'online_stats_restricted'		=> "<i>Restricted Topic</i>",
			'online_stats_who'				=> "Who's Online",
			'online_stats_online'			=> "<%guests> Guest(s), <%members> Member(s) Online",
			'online_stats_recent'			=> "Users online in last 15 minutes:",
			'online_stats_today'			=> "<%members> members online in last 24 hours:",
			'online_stats_most'				=> "Most users online ever was <%1> on <%date>",
			'online_stats_statistics'		=> "Board Statistics",

		// preview
			'preview_title'					=> "Preview:",			
			
		// smilies_popup
			'smilies_popup_title'			=> "Emoticon List",

		// split
			'split_title'					=> "Split Topic",
			'split_topic'					=> "Split Topic Details",
			'split_details'					=> "In the fields below, please enter the new title (and description if required) of the split topic. All posts below the post you selected to be split will be moved to this new topic.",
			'split_topic_title'				=> "Title",
			'split_topic_desc'				=> "Description",

		// topic
			'topic_home'					=> "Home",
			'topic_new'						=> "New Topic",
			'topic_reply'					=> "Add Reply",
			'topic_quote'					=> "Quote Post",
			'topic_quote_title'				=> "Quote:",
			'topic_quick'					=> "Quick Reply",
			'topic_unsubscribe'				=> "Unsubscribe From This Topic",
			'topic_subscribe'				=> "Subscribe To This Topic",
			'topic_poll'					=> "Poll:",
			'topic_poll_results'			=> "Show Results",
			'topic_poll_vote'				=> "Vote",
			'topic_poll_total'				=> "Total Votes:",
			'topic_online'					=> "Online Now!",	
			'topic_warn_level'				=> "Warn Level:",
			'topic_warn_add'				=> "Add Warning",
			'topic_warn_remove'				=> "Remove Warning",
			'topic_warn_add_details'		=> "Warned by <%name> on <%date>",
			'topic_warn_remove_details'		=> "Removed by <%name> on <%date>",
			'topic_member_role'				=> "Role",
			'topic_member_posts'			=> "Posts:",
			'topic_member_joined'			=> "Joined:",
			'topic_member_location'			=> "Location:",
			'topic_trackback'				=> "Trackback URL",
			'topic_trackback_text'			=> 'Use the following URL to link to this post: %s',
			'topic_option_split'			=> "Split Posts",
			'topic_option_move'				=> "Move Topic",
			'topic_option_merge'			=> "Merge Topic",
			'topic_option_lock'				=> "Lock Topic",
			'topic_option_unlock'			=> "Unlock Topic",
			'topic_img'						=> "Attached Image",
			'topic_downloads'				=> "Downloads",
			'topic_attachments_permission'	=> "You do not have permission to download attachments in this forum",
			'topic_edited_by'				=> "Last edited by:",
			'topic_edited_reason'			=> "Reason:",
			'topic_edited_unknown'			=> "Unknown Reason",
			'topic_attach_filesize'			=> "Unknown Filesize",
			'topic_tags'					=> "TAGS:",
			'topic_top'						=> "Go To Top",
			'topic_option_pm'				=> "Send A Message",
			'topic_option_edit'				=> "Edit Post",
			'topic_option_delete'			=> "Delete",
			'topic_option_report'			=> "Report Post",
			'topic_viewing'					=> "<%1> Guest(s), <%2> Member(s) Viewing This Topic:",
			'topic_remove'					=> "Are you sure you want to delete this?",
			'topic_revert'					=> 'Are you sure you want to revert this?',
			'topic_approve'					=> "Approve Post",
			'topic_approve_warn'			=> "This message will be viewed by a moderator before being made available and thus will not show on the forum until this time. Continue?",			
			'topic_edit_history'			=> "Post Edit History",
			'topic_edit_history_by'			=> "Edited By",			
			'topic_edit_history_reason'		=> "Reason for Edit",	
			'topic_edit_history_date'		=> "Date of Edit",
			'topic_edit_history_previous'	=> "Previous",
			'topic_search'					=> "Search Topic...",
			'topic_previous'				=> "<< Previous",
			'topic_next'					=> "Next >>",
			
			// RC2 ADDITIONS
			'topic_hidden_top'				=> "Reply to view post",
			'topic_hidden_content'			=> "CONTENT HIDDEN",
			'topic_spoiler'					=> "Spoiler Alert",
			'topic_spoiler_click'			=> "Click to View",
			
	// This block deals with the pages folder within LayerBulletin.
	// Primarily, this is search, messages, error pages etc.

		// admin
			'admin_title_board'				=> "Board Settings",
			'admin_link_home'				=> "Administration Home",
			'admin_link_global'				=> "Global Settings",
			'admin_link_topics'				=> "Topics & Posts",
			'admin_link_spam'				=> "Spam Protection",
			'admin_link_censor'				=> "Word Censor",
			'admin_link_attachments'		=> "Attachments & Images",
			'admin_link_modules'			=> "Modules",
			'admin_link_themes'				=> "Themes",			

			'admin_title_forums'			=> "Forum Settings",
			'admin_link_categories'			=> "Categories",
			'admin_link_custom'				=> "Custom Fields",
			'admin_link_reported'			=> "Reported Posts",
			'admin_link_approve'			=> "Approve Posts",			
			'admin_link_emoticons'			=> "Emoticons",
			'admin_link_rss'				=> "Syndication",
			'admin_link_cache'				=> "Cache & Purge",

			'admin_title_members'			=> "Member Settings",
			'admin_link_member_edit'		=> "Edit Member",
			'admin_link_groups'				=> "User Groups",
			'admin_link_ranks'				=> "Member Ranks",
			'admin_link_moderators'			=> "Moderators",	
			'admin_link_mass_email'			=> "Mass Email",			
			'admin_link_paypal'				=> "PayPal Subscriptions",

		// banned
			'banned_message'				=> "This Account Has Been Banned",
			'banned_message_desc'			=> "This users account has been banned.<br /><br />There could be a few reasons why this could be:<ul><li>Your warn level has increased to 100% due to repeated breaking of the rules<li>You received an immediate ban due to a very serious breach of the rules<li>You attempted to create an alias</ul>If you believe this ban to be in error please contact a site administrator.",

		// blocked
			'blocked_register'				=> "To View Topics, Please Register.",
			'blocked_wait'					=> "To View More Topics, Please Register Or Wait:",
			'blocked_complete'				=> "You may now view more topics!",

		// error
			'error_title'					=> "Error!",
			'error_message'					=> "You Do Not Have Permission To Use This Feature",

		// list
			'list_group'					=> "Group",
			'list_name'						=> "Member Name",
			'list_members'					=> "Member List",
			'list_location'					=> "Forum Location",
			'list_time'						=> "Time",
			'list_guest'					=> "Guest",
			'list_viewing_topic'			=> "Viewing Topic:",
			'list_viewing_forum'			=> "Viewing Forum:",
			'list_select'					=> "Select a Member Group",

		// login
			'login_title'					=> "Login",
			'login_name'					=> "Name:",
			'login_pass'					=> "Password:",
			'login_remember'				=> "Remember Me?",
			'login_forgot'					=> "Help! I Forgot My Password",

		// members
			'members_title'					=> "Member Profile Area",
			'members_profile'				=> "Profile Details",
			'members_statistics'			=> "Forum Statistics",
			'members_communication'			=> "Communication",
			'members_tags'					=> "Gamer Tags",
			'members_location'				=> "Location",
			'members_posts_total'			=> "Total Posts",
			'members_posts_percentage'		=> "<%1>% of forum total",
			'members_last_active'			=> "Last Active:",
			'members_most_active'			=> "Most Active In:",
			'members_forum_percentage'		=> "<%1>% of members posts",
			'members_msn'					=> "Snapchat",
			'members_no_information'		=> "No Information",
			'members_aol'					=> "BlackBerry Messenger",
			'members_yahoo'					=> "Instagram",
			'members_skype'					=> "Skype",
			'members_xbox'					=> "Xbox Live",
			'members_ps3'					=> "Playstation Network",
			'members_wii'					=> "Nintendo Wii",
			'members_signature'				=> "Signature",
			'members_options'				=> "Options",
			'members_view_topics'			=> "View Members Topics",
			'members_view_posts'			=> "View Members Posts",
			'members_edit'					=> "Edit This Member",
			'members_add_friend'			=> "Add friend",
			'members_delete_friend'			=> "Delete friend",
			
		// messages
			'messages_new_message'			=> "New Message",
			'messages_my_messages'			=> "My Messages",
			'messages_subject'				=> "Subject",
			'messages_from'					=> "From",
			'messages_to'					=> "To",
			'messages_replies'				=> "Replies",
			'messages_last_reply'			=> "Last Message",
			'messages_unread'				=> "New Messages",
			'messages_read'					=> "No New Messages",
			'messages_last_by'				=> "Last Message By:",
			'messages_new'					=> "New Private Message",
			'messages_new_subject'			=> "Message Subject",
			'messages_new_recipient'		=> "Message Recipient",
			'messages_this_week'			=> "This Week",
			'messages_older'				=> "Older Messages",
			'messages_message_deleted'		=> "You have successfully deleted the private message.",
			'messages_message_sent'			=> "You have successfully sent the private message.",
			
		// myoptions	
			'myoptions_profile'				=> "Profile",
			'myoptions_home'				=> "My Options Home",
			'myoptions_information'			=> "Edit Information",
			'myoptions_avatar'				=> "Avatar Settings",
			'myoptions_signature'			=> "Signature Settings",
			'myoptions_username'			=> "Change Username",
			'myoptions_usertitle'			=> "Change Usertitle",
			'myoptions_password'			=> "Change Password",
			'myoptions_email'				=> "Change Email Address",
			
			'myoptions_options'				=> "Options",
			'myoptions_theme'				=> "Change Forum Theme",
			'myoptions_general_settings'	=> "General settings",
			'myoptions_timezone'			=> "Timezone Settings",
			'myoptions_upgrade'				=> "Upgrade Membership",
			'myoptions_subscriptions'		=> "View Subscriptions",
			'myoptions_guide'				=> "View User Guide",
			
			'myoptions_community'			=> "Community",
			
		// offline
			'offline_title'					=> "Offline",
			
		// password
			'password_title'				=> "Password Recovery Request Form",
			'password_desc'					=> "If you have forgotten your password, enter your username and email address in the box below to get a new password emailed to you. This email address must match what you have stored in your profile.",
			'password_name'					=> "Name:",
			'password_email'				=> "Email:",
			'password_change'				=> "A New Password Has Been Sent To Your Email Address",
			'password_fail'					=> "That Username/Email Combination Does Not Exist",
			
		// register
			'register_title'				=> "Register",
			'register_info'					=> "Your Information",
			'register_username'				=> "Username",
			'register_username_length'		=> 'The administrators have set a maximum length of <span style="font-weight: bold">%d</span> characters.',
			'register_taken'				=> "That username is already taken",
			'register_required'				=> "Required",
			'register_length'				=> 'The username entered was too long.',
			'register_password'				=> "Password",
			'register_email'				=> "Email Address",
			'register_email_taken'			=> "Email Address Already In Use",
			'register_security'				=> "Enter The Security Code:",
			'register_security_wrong'		=> "Wrong Code",
			'register_thanks'				=> "Thank You For Registering",
			'register_email_verify'			=> "Please Check Your Email Inbox For A Validation Link.<br /><br />In the event your email does not appear:<ul><li>Check your spam folder for emails from this website<li>Wait a few more minutes for the email to arrive<li>Contact a forum administrator on <strong><%board_email></strong> to get your account manually approved.</ul>",
			'register_apostrophe'			=> "Error! You can not use an apostrophe in your username, please try again.",
			'register_terms'				=> "Terms & Conditions",
			'register_agree'				=> "I Agree to the above Terms & Conditions",
			'register_terms_conditions_warn'				=> "You must accept the Terms & Conditions!",
			'register_password_repeat'				=> "Repeat password",
			
		// report
			'report_title'					=> "Report Post",
			'report_desc'					=> "Please explain why you are reporting the post in the area provided below. When done, click Submit.",
			
		// search
			'search_topics_started'			=> "Topics Started By:",
			'search_posts_by'				=> "Posts By",
			'search_show_form'				=> "Show Search Form",
			'search_title'					=> "Forum Search",
			'search_desc'					=> "Enter the keywords that you wish to search for in here. If you want to find posts or topics by a specific member, please go to their profile and click the link to View Posts/Topics at the bottom of the page.",
			
			'search_search'					=> "Search:",
			'search_search_query'			=> "Enter your query here",
			'search_author'					=> "Author:",
			'search_author_desc'			=> "If you wish to get posts by a particular member, enter their name here",
			'search_date'					=> "Date:",
			'search_date_desc'				=> "Enter dates to search between (dd-mm-yyyy)",
			'search_forums'					=> "Forums",
			'search_forums_desc'			=> "Select the forums you wish to search in. You can select more than one forum.",	

		// suspended
			'suspended_desc'				=> "You Have Been Suspended. Your Suspension Is Lifted In:",
			'suspended_complete'			=> "Your suspension has been lifted!",
			
		// upgrade
			'upgrade_title'					=> "Paid Group Upgrade Options",
			'upgrade_cancel_success'		=> "Successful Cancellation!",
			'upgrade_cancel_message'		=> "Thank you! Your membership has been cancelled.",
			
			'upgrade_subscribe_success'		=> "Successful Purchase!",
			'upgrade_subscribe_message'		=> "Thank You! Your membership has been upgraded.",
			
			'upgrade_warning'				=> "Please note that if you cancel a paid subscription or if your card expires, your subscription will be cancelled automatically.",
			
			'upgrade_select'				=> "Select Upgrade Package",
			'upgrade_select_desc'			=> "To gain access to extra forums, or better member permissions, you can pay for a group upgrade. You will pay for your upgrade via Paypal (A Paypal account is required to use this feature.)",
			'upgrade_name'					=> "Upgrade Name",
			'upgrade_features'				=> "Features",
			
			'upgrade_cost'					=> "Cost:",
			'upgrade_every'					=> "Every",
			'upgrade_days'					=> "Days",
			'upgrade_weeks'					=> "Weeks",		
			'upgrade_months'				=> "Months",	
			'upgrade_years'					=> "Years",	

		// verify
			'verify_email'					=> "Email Verification",
			'verify_verified'				=> "Your Account Is Now Verified<br /><br />You may now login to the forum using the login link.",
			'verify_failed'					=> "You Must Verify Your Account To Continue<br /><br />If you haven't received your email please try the following:<ul><li>Check your spam folder for emails from this website<li>Wait a few more minutes for the email to arrive<li>Contact a forum administrator on <strong><%board_email></strong> to get your account manually approved.</ul>",
			
		// warn
			'warn_title'					=> "Warning Area",
			'warn_select'					=> "Add/Remove Warning",
			'warn_reason_desc'				=> "Enter a reason for taking your action. This will be stored in the database so you can check them at any time by clicking on a members warn level.",
			'warn_reason_title'				=> "Reason For Warn Adjustment",
			
			'warn_error'					=> "Error!",
			'warn_error_way'				=> "This Members Warning Level Can Not Be Adjusted This Way",
			'warn_error_self'				=> "You Can't Warn Yourself!",
			'warn_title_reason'				=> "Reason For Action",
			'warn_title_details'			=> "Action Details",
			
	// This next part deals with the location that is shown in
	// the browser title and the online/group lists
	
		// locations
			'location_upgrade'				=> "Membership Upgrade",
			'location_list'					=> "Online List",
			'location_member'				=> "Member List",			
			'location_blocked'				=> "Blocked",
			'location_suspended'			=> "Suspended",
			'location_admin'				=> "Admin Control Panel",
			'location_login'				=> "Log In",
			'location_members'				=> "Viewing Member Profile",
			'location_warn'					=> "Adjusting A Members Warn Level",
			'location_messages'				=> "Private Messages",
			'location_myoptions'			=> "User Control Panel",
			'location_register'				=> "Register",
			'location_search'				=> "Search",
			'location_error'				=> "Error",
			'location_banned'				=> "Banned",
			'location_report'				=> "Report Post",
			'location_addreply'				=> "Reply To Topic",
			'location_edit'					=> "Edit Area",
			'location_move'					=> "Move Topic",
			'location_merge'				=> "Merge Topic",
			'location_split'				=> "Split Topic",
			'location_newpost'				=> "New Topic",
			'location_help'					=> "Help Area",
			
			'location_l_upgrade'			=> "Viewing Membership Upgrade Options",
			'location_l_addreply'			=> "Replying To Topic",
			'location_l_member'				=> "Viewing Member List",
			'location_l_list'				=> "Viewing Online List",			
			'location_l_blocked'			=> "Being Asked To Register To Continue",
			'location_l_suspended'			=> "Being Told They Are Suspended",
			'location_l_move'				=> "Moving A Topic",
			'location_l_merge'				=> "Merging Topics",
			'location_l_split'				=> "Splitting A Topic",
			'location_l_admin'				=> "Viewing Admin CP",
			'location_l_login'				=> "Logging In",
			'location_l_members'			=> "Viewing Members Profile",
			'location_l_warn'				=> "Adjusting Members Warn Level",
			'location_l_messages'			=> "Viewing Private Messages",
			'location_l_myoptions'			=> "Viewing User Control Panel",
			'location_l_newpost'			=> "Posting New Topic",
			'location_l_register'			=> "Registering Account",
			'location_l_search'				=> "Searching Forum",
			'location_l_error'				=> "Being Told They Have Insufficient Privileges To Use A Feature",
			'location_l_banned'				=> "Being Told They Are Banned",
			'location_l_report'				=> "Reporting A Post",
			'location_l_index'				=> "Viewing Forum Index",
			'location_l_help'				=> "Viewing Help Area",
			
		// upload form
			'upload_avatar'					=> "Current Avatar",
			'upload_option'					=> "Delete Uploaded Attachments",
			'upload_add'					=> "Insert Attachments Into Text Editor",
			'upload_insert'					=> "Insert",
			'upload_remove'					=> "Remove",
			'upload_box'					=> "Please Wait...",
			
			'button_submit'					=> "Submit",
			'button_upload'					=> "Upload",
			'button_install'				=> "Install",
			'button_remove'					=> "Remove",
			'button_uninstall'				=> "Uninstall",
			'button_add_forum'				=> "Add Forum",
			'button_add_root'				=> "Add Root",
			'button_reorder'				=> "Reorder",
			'button_add_field'				=> "Add Field",
			'button_purge'					=> "Purge",
			'button_ban'					=> "Ban",
			'button_unban'					=> "Unban",			
			'button_delete'					=> "Delete",
			'button_group'					=> "Add Group",
			'button_add_moderator'			=> "Add Moderator",
			'button_add_subscription'		=> "Add Subscription",
			'button_send_pm'				=> "PM",
			'button_login'					=> "Login",
			'button_new_message'			=> "New Message",
			'button_fast_reply'				=> "Fast Reply",
			'button_top'					=> "Top",
			'button_preview'				=> "Preview",
			'button_register'				=> "Register",
			'button_search_form'			=> "Show Search Form",
			'button_search'					=> "Search",
			'button_new_topic'				=> "New Topic",
			'button_add_reply'				=> "Add Reply",
			'button_reply'					=> "Reply",
			'button_move'					=> "Move",
			'button_merge'					=> "Merge",
			'button_split'					=> "Split",
			'button_lock'					=> "Lock",
			'button_unlock'					=> "Unlock",
			'button_revert'					=> 'Revert',
			'button_quote'					=> "Quote",
			'button_quick_edit'				=> "Quick Edit",
			'button_edit'					=> "Edit",
			'button_report'					=> "Report",
			'button_approve'				=> "Approve",
			'button_subscribe_topic'		=> "Subscribe to this Topic",
			'button_unsubscribe_topic'		=> "Unsubscribe from this Topic",
			'button_subscribe_forum'		=> "Subscribe to this Forum",
			'button_unsubscribe_forum'		=> "Unsubscribe from this Forum",
			'button_markread'				=> "Mark All As Read",
			'button_update'					=> "Update",
			'button_results'				=> "Results",
			'button_poll'					=> "Vote",
			
	// Warn users when they click on Admin link
	// 1.0.3
	
			'parse_url_warn'				=> "Warning, this link will take you to the Admin CP",
			
	// This part is the terms and conditions that guests must
	// agree to before signing up.
	
		// terms
			'terms_conditions'				=>"Terms & Conditions

1. By registering on this site you agree to abide by all terms & conditions laid out on this agreement as well as any additional terms that the administrators of this site apply to their forums.

2. By submitting your membership details you agree that we will hold on record your valid email address that the site administrators can contact you with if the need arises. At no point however, will we send unsolicited 'spam' emails to your account nor share your email address with third parties.

3. You agree that we may hold a record of your IP address whenever you post on this forum as well as when you first register on this forum.

4. You agree that you will not post links to warez content or share any other material on this forum that may be illegal in your state/country.

5. You agree that you will not attempt, nor encourage others to attempt, to gain access to areas you or others have insufficient privileges to view or use.

6. You agree that if you break any of these terms and/or any additional terms the administrators set for their forum that your account may be suspended without warning and you may lose all rights to post on this forum.",
	
	// This part deals with the way dates are formatted for
	// this particular language. For details on what each part
	// means, please visit http://uk3.php.net/strftime

		// date
			'date_format'					=> "%A, %b %d, %Y %H:%M",  // Weekday, nn Month, Year HH:MM
			'date_today'					=> "Today",
			'date_yesterday'				=> "Yesterday",
			'date_minute'					=> "Minute Ago",
			'date_minutes'					=> "Minutes Ago",	
			'date_hour'						=> "Hour Ago",	
			'date_hours'					=> "Hours Ago",	
			
	// this part is for the various emails that the board
	// may send out....
	
			'email_addreply_title'			=> "New Reply To Topic: <%title>",
			'email_addreply_content'		=> "Hi <%subscriber>,

You have received this email because you wish to be notified when the topic: <%title> has had a reply.

Follow this link to view the topic: <%site>/index.php?page=findpost&post=<%id>

To unsubscribe from further notifications, you can click the Unsubscribe link at the top of the topic, or alternatively click the link below:

<%site>/index.php?page=unsubscribe&topic=<%topic>

Regards,
<%sitename> Team.",

			'email_newpost_title'			=> "New Topic Added To: <%forumname>",
			'email_newpost_content'			=> "Hi <%subscriber>,

You have received this email because you wish to be notified when a new topic was added to the forum <%forumname> on <%sitename>.

Follow this link to view the topic: <%site>/index.php?page=findpost&post=<%post>

To unsubscribe from further notifications, you can click the Unsubscribe link at the top of the forum, or alternatively click the link below:

<%site>/index.php?page=unsubscribe&forum=<%forum>

Regards,
<%sitename> Team.",

			'email_password_title'			=> "Password Change on <%sitename>",
			'email_password_content'		=> "Dear: <%subscriber>,

This is an email to let you know that your password has been changed on <%sitename>.

To log-in, please use the following details:

-----------------------------------
Username: <%subscriber>
Password: <%password>
-----------------------------------

Regards,

<%sitename>
(<%site>)",

			'email_register_title'			=> "<%sitename> Verification Email",
			'email_register_content'		=> "Hello <%subscriber>,

You are receiving this email because your email address was used to register on <%sitename> with the following details:

-----------------------------------
Username: <%subscriber>
Password: <%password>
-----------------------------------

To continue, please validate your account by clicking the link below:
<%site>/index.php?page=verify&id=<%hash>.

If you did not register on this website, please disregard this email. Your details will be removed from our system.

Regards,
<%sitename> Team.",

'email_register_title1'			=> "<%sitename> Welcome Email",
			'email_register_content1'		=> "Hello <%subscriber>,

You are receiving this email because your email address was used to register on <%sitename> with the following details:

-----------------------------------
Username: <%subscriber>
Password: <%password>
-----------------------------------

Regards,
<%sitename> Team.",

			'email_members_pass_title'		=> "Password Change on <%sitename>",
			'email_members_pass_content'	=> "Dear: <%subscriber>,

This is an email to let you know that your password has been changed on <%sitename>.

To log-in, please use the following information:

-----------------------------------
Username: <%subscriber>
Password: <%password>
-----------------------------------

Regards,

<%sitename>
(<%site>)",

			'email_members_name_title'		=> "Username Change on <%sitename>",
			'email_members_name_content'	=> "Dear: <%oldname>,

This is an email to let you know that your username has been changed on <%sitename>.

To log-in, please use the following username:

-----------------------------------
Username: <%subscriber>
-----------------------------------

Regards,

<%site>
(<%sitename>)",

			'email_members_group_title'		=> "Your User Group Has Changed!",
			'email_members_group_content'	=> "Hi <%subscriber>,

Your usergroup has changed!

You are now a member of [b]<%group>[/b] group.

Please delete this Private Message once it has been read.",

			'email_pm_title'			=> "New Private Message from <%from>",
			'email_pm_content'			=> "Hi <%subscriber>,

You have received this email because you wish to be notified when you have received a new Private Message.

Follow this link to view your inbox: <%site>/index.php?page=messages&act=inbox

Regards,
<%sitename> Team.",
	
);

?>
