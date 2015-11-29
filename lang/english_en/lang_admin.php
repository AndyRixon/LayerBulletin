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
|   lang_admin.php - Language file - Admin CP Areas - English
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.<br />";
	exit();
}

$lang_admin = array (

	// this area deals with the admin control panel
		
		// attachments
			'attachments_title'				=> "Attachment & Image Settings",
			'attachments_change'			=> "Allow File Uploading",
			'attachments_desc'				=> "Allowing people to attach files to their posts directly on your forum cuts out the hassle of people having to find alternative sites to upload and link to files. However allowing people to upload files to your site also means you will use more bandwidth. If bandwidth is a concern to you, untick this box and disable attachments for future posts.",
			'attachments_allow'				=> "Allow Attachments?",
			'attachments_size_title'		=> "Attached Image Dimensions",
			'attachments_size_desc'			=> "Configure the maximum <i>width</i> of images on your boards. They will be resized to match these dimensions.",
			'attachments_size_img'			=> "Image Width (px):",
			'attachments_size_avatar'		=> "Avatar Width (px):",
			'attachments_saved'				=> "You have successfully saved the attachment & image settings.",

		// cache
			'cache_title'					=> "Cache & Purge Settings",
			'cache_forum_cache'				=> "Re-cache forum areas",
			'cache_forum_desc'				=> "This area allows you to re-cache certain areas of the forum database. For example, if you delete user posts frequently or change forum options so that the post count is incremental and then it isn't then running the appropriate cache script will update your database with the proper data.",
			
			'cache_posts_cache'				=> "Re-cache users post counts",
			'cache_posts_cached'			=> "Post counts re-cached",
			'cache_posts_desc'				=> "All users have had their post counts updated. It is a good idea to re-cache your forum on a regular basis if you tend to change a lot of forum settings or delete a lot of posts. That way your database will stay up to date.",
			'cache_posts_description'		=> "It is a good idea to re-cache your members post counts on a regular basis if you tend to change a lot of forum settings or delete a lot of posts. That way your database will stay up to date.",
			
			'cache_members_remove'			=> "Remove unverified members",
			'cache_members_removed'			=> "Non-verified members removed",
			'cache_members_desc'			=> "It is a good idea to run this probably about once a month to trim down the size of your members table in the database. Some people might type their email address in incorrectly when going through the registration process, and this is a major reason why some accounts will remain unverified. Spam bots will also have unverified accounts, so removing their details will remove details of any bots that have signed up.",
			
			'cache_members_online_title'	=> "Reset most users online",
			'cache_members_online'			=> "Most users online has been reset",
			'cache_members_online_desc'		=> "This option has reset the most users online to zero.",
			'cache_members_online_explain'	=> "This option will reset the most users online to zero.",

			'cache_purge_success'			=> "Purge Successful!",
			'cache_purge_desc'				=> "The topic purge was successful. Please now re-cache member posts.",
			
			'cache_table_updated'			=> "Member Table Updated",
			'cache_table_desc'				=> "Members table has now been updated to show that they read all posts at this time. No new topics or posts will be displayed to them until a new post or topic is made.",
			
			'cache_messages_remove'			=> "Remove deleted private messages",
			'cache_messages_removed'		=> "Deleted private messages have been removed",
			'cache_messages_desc'			=> "When a user deletes a private message it still remains in the database. This is down to the way private messages works on LayerBulletin. This option will remove private messages that have been deleted by both the sender and the receiver.",
			
			'cache_read_posts_title'		=> "Mark all posts read by all members",
			'cache_read_posts_desc'			=> "The <i>posts_read</i> table can become very large remembering what posts members have read. You can empty the table and force all members to have all posts marked as read by using this option.",
			
			'cache_purge_title'				=> "Purge forum topics",
			'cache_purge_desc'				=> "This area allows you to purge forum topics that are older than a specified date.",
			'cache_purge_forum_title'		=> "Forums:",
			'cache_purge_forum_desc'		=> "Select the forums you wish to purge. You can select more than one forum.",
			'cache_purge_locked'			=> "Locked Only?",
			'cache_purge_older'				=> "Older Than:",
			'cache_purge_days'				=> "Days",
			
		// categories
			'categories_edit_title'			=> "Edit Forum",
			'categories_edit_forum'			=> "Forum Name",
			'categories_edit_forum_desc'	=> "Enter your forum name here. Make it as short and to the point as you can. Please do not use HTML or BB Code.",			
			'categories_forum_desc'			=> "Forum Description",
			'categories_forum_desc_desc'	=> "Enter your forum description. Please be as clear and concise as possible so visitors know immediately what to expect when they view the category.",			

			'categories_forum_announce'		=> "Forum Announcement",
			'categories_forum_announce_desc'=> "You can write an announcement at the top of your forum. This can either be something like important information that is specific to that category or a list of rules. BB Code is enabled.",			
			'categories_edit_parent'		=> "Parent Forum:",
			'categories_edit_parent_no'		=> "No Parent",
			
			'categories_theme'				=> "Forum Theme:",	
			'categories_theme_default'		=> "*Board Default",
			'categories_theme_select'		=> "Select Theme",
			
			'categories_read_only'			=> "Read Only?",
			'categories_count'				=> "Increment Post Count?",
			
			'categories_new_title'			=> "New Forum",
			
			'categories_forums'				=> "Forum Category Settings",
			'categories_forums_manage'		=> "Category Management",
			'categories_forums_desc'		=> "This page lists all your forums and has a number of options. Firstly, on this page you can re-order your forums and sub-forums so it changes the order they display on the forum index. Secondly, you can edit/delete individual forums/sub-forums by clicking the appropriate icon - the pencil icon for edit, the red cross for delete (please delete sub-forums before root forums). Adding a forum is done by clicking the Add Forum/Add Root Forum button, and finally, to set permissions just click the forums name.",
			
			'categories_subforums'			=> "Subforums:",
			'categories_permissions'		=> "Click here to change this forums permissions",
			
			'categories_warning'			=> "Warning!",
			'categories_warning_desc'		=> "You are about to perform an action that would result in changes to your forums categories. Do not proceed if:<ul><li>You clicked on a link given to you by someone else<li>You reached this page without navigating through the Admin CP first<li>You are unsure of the action you are about to do.</ul>",

            'categories_redirection' 		=> "Forum Redirection",      
            'categories_redirect_url'		=> "Redirect url:", 

            'categories_added'				=> "You have successfully added a forum.",
            'categories_updated'			=> "You have successfully updated a forum.",
            'categories_updated_perm'		=> "You have successfully updated the permissions for a forum.",
            'categories_deleted'			=> "You have successfully deleted a forum.",

		
		// custom
			'custom_edit_title'				=> "Editing Fields",
			'custom_field_name'				=> "Field Name",
			'custom_field_description'		=> "Field Description",
			'custom_field_order'			=> "Field Order",
			
			'custom_new_title'				=> "Creating Field",
			
			'custom_fields'					=> "Custom Field Settings",
			'custom_fields_list'			=> "Field List",
			'custom_fields_desc'			=> "You can create fields that you want your members to fill in that will also show in their profiles. Your current fields are below.",
			'custom_fields_new'				=> "New Field",
			'custom_fields_order'			=> "Re-order fields",			
			
			'custom_edit'					=> "Edit",
			'custom_delete'					=> "Delete",
			'custom_added'					=> "You have successfully added a custom field.",
			'custom_updated'				=> "You have successfully updated a custom field.",
			'custom_removed'				=> "You have successfully deleted a custom field.",
			
		// mass email
			'email_title'					=> "Mass Email Settings",
			'email_sub_title'				=> "Mass Email Member Groups",
			'email_groups'					=> "Member Groups",
			'email_groups_desc'				=> "Select member groups to email. (You may select more than one)",
			'email_sent'					=> "Your Email Has Been Sent!",
			'email_mass_desc'				=> "This tool will allow you to send out a mass email to all users in a specific usergroup (or all usergroups).<br /><br />The users username and the community signature is automatically added to the email. All you have to do is fill in the content of the email.",
			
		// filter	
			'filter_title'					=> "Word Censor Settings",
			'filter_filter'					=> "Swear Filter",
			'filter_desc'					=> "Listed below are the current words that are filtered out in the forum. To add more, just enter the words to be filtered in the right hand box and what they should be changed to in the left hand box. To delete words, just hit the delete icon.",
			'filter_becomes'				=> "Becomes ->",
			
		// groups
			'groups_new_title'				=> "Group Settings: New Group",
			'groups_global_desc'			=> "On this screen you set the GLOBAL options for your member groups. Forum specific options are set under the Permissions area of the Forums section. These global settings for groups over-ride forum-specific permissions.",
			'groups_name_title'				=> "Name & Colour",
			'groups_name_desc'				=> "Set the name and the colour of your group. The colour can be set by using hex values (#000000) or by declaring the colour itself (white, black, etc.)",
			'groups_name_group'				=> "Group Name",
			'groups_color'					=> "Group Colour",
			
			'groups_permissions_title'		=> "User Permissions",
			'groups_permissions_desc'		=> "Set the permissions that affect the way this group uses standard forum features.",
			
			'groups_view_board'				=> "Can View Board?",
			'groups_change_own_name'		=> "Can Change Own Name?",
			'groups_change_title'			=> "Can Change User Title?",
			'groups_messages'				=> "Can Send/Receive Private Messages?",
			'groups_change_theme'			=> "Can Change Theme?",
			'groups_avatar'					=> "Can Use Avatar?",
			'groups_signature'				=> "Can Use Signature?",
			'groups_edit_own_posts'			=> "Can Edit Own Posts?",
			'groups_delete_own_posts'		=> "Can Delete Own Posts?",
			'groups_polls'					=> "Can Add Polls?",
			
			'groups_moderator_title'		=> "Moderator Permissions",
			'groups_moderator_desc'			=> "These options allow this member group to have moderator powers such as editing members, warning members, etc.",
			
			'groups_warn'					=> "Can Warn Members?",
			'groups_ban'					=> "Can Ban Members?",
			'groups_edit'					=> "Can Edit Members?",
			'groups_delete_members'			=> "Can Delete Members?",
			'groups_edit_others_posts'		=> "Can Edit Others Posts?",
			'groups_delete_others_posts'	=> "Can Delete Others Posts?",
			'groups_sticky'					=> "Can Sticky Topics?",
			'groups_move'					=> "Can Move Topics?",
			'groups_lock'					=> "Can Lock Topics?",
			'groups_split'					=> "Can Split Topics?",
			'groups_merge'					=> "Can Merge Topics?",
			'groups_reported'				=> "Can View Reported Posts in Topic View?",
			'groups_moderate_posts'			=> "Can Moderate Posts?",
			'groups_html'					=> "Can Use HTML Tag?",
			'groups_caspian'				=> "Avoid SPAM Checks?",			
			
			'groups_administrator_title'	=> "Administrator Permissions",
			'groups_administrator_desc'		=> "This allows this group to edit site and forum settings which are found in the administrator area.",
			
			'groups_change_site'			=> "Can Change Site Settings?",
			'groups_change_forums'			=> "Can Change Forum Settings?",
			'groups_announce'				=> "Can Global Announce?",
			
			'groups_group_title'			=> "Group Settings:",
			
			'groups_user_title'				=> "User Group Settings",
			'groups_user_option'			=> "Add/Edit/Delete",
			'groups_user_desc'				=> "User groups are handled in this area. This sets the global board permissions. Forum specific permissions are set under the Permissions area of the Forums section. User Group permissions over-rule forum specific permissions.",
			
			'groups_permissions'			=> "Copy Forum Permissions",
			'groups_permissions_desc'		=> "You can copy an entire groups forum permissions to use as a basis for this groups permissions if you so wish. This saves you from having to go through every single forum adding permissions.",
			'groups_copy'					=> "Copy From:",
			'groups_copy_none'				=> "None",
			
			'groups_icon_title'				=> "Select Group Icon",
			'groups_icon_desc'				=> "You can specify a group icon to display under their profile information. This will have one of the below images as well as their group name alongside it. If you do not wish for a group to have an icon displayed, just select 'None' from the options.",
			'groups_icon_none'				=> "None",

			'groups_added'					=> "You have successfully added a new user group.",
			'groups_updated'				=> "You have successfully updated an user group.",
			'groups_deleted'				=> "You have successfully deleted an user group.",
			
		// home
			'home_title'					=> "Admin Whiteboard",
			'home_install.php_exists'		=> "Security Notice: The install.php file still exists. The installer is locked but we advise you to remove/rename install.php file for security reasons!",
			'home_update.php_exists'		=> "Security Notice: The update.php file still exists. The updater is locked but we advise you to remove/rename update.php file for security reasons!",
			'home_desc'						=> "Keep note snippets here that all other administrators can view and edit",
			'home_offline'					=> "Your forum is offline",	
			'home_online'					=> "Your forum is online",
			'home_noregister'				=> "Registrations are off",
			'home_register'					=> "Registrations are on",	
			'home_attachments'				=> "Attachments are on",
			'home_noattachments'			=> "Attachments are off",	
			'home_spam_blank'				=> "No Spam Protection",
			'home_spam_half'				=> "Some Spam Protection",			
			'home_spam_current'				=> "Full Spam Protection",
			'home_version_update'			=> 'An update is available',
			'home_version_current'			=> 'Latest version',
			'home_whiteboard_saved'			=> "You have successfully saved the admin whiteboard.",
	
		// members
			'members_edit_title'			=> "Editing Member:",
			
			'members_topic_top_title'			=> "Topic Viewable Details",
			'members_topic_desc'			=> "Editing a members name will require them to log back in with their new name. An email will automatically be sent to their registered email address informing them of the change. A Private Message will be sent to them if their group has been altered.",
			'members_topic_name'			=> "Name",
			'members_topic_title'			=> "User Title",
			'members_topic_group'			=> "User Group",
			'members_topic_location'		=> "Location",
			'members_topic_nationality'		=> "Nationality",
			'members_topic_avatar'			=> "Remove Avatar?",
			'members_topic_signature'		=> "Remove Signature?",
			'members_topic_verify'			=> "Verify Member?",
			
			'members_suspend_title'			=> "Suspend Member",
			'members_suspend_desc'			=> "You can suspend a member for a set duration from here. Set the number of days that the member is suspended from the board. Their permissions to use the forum will be removed entirely.",
			'members_suspend_days'			=> "Days To Suspend Member:",
			
			'members_comm_title'			=> "Communication Details",
			'members_comm_desc'				=> "This area is for things like the primary email address or Instant Messaging names. Primary email address must not be left blank.",
			'members_comm_email'			=> "Primary Email",
			'members_comm_msn'				=> "Snapchat",
			'members_comm_aol'				=> "BlackBerry Messenger",
			'members_comm_yim'				=> "Instagram",
			'members_comm_skype'			=> "Skype",
			
			'members_tags_title'			=> "Gamer Tags",
			'members_tags_desc'				=> "Gamer tags are a way of communicating with other players of online console games.",
			'members_tags_xbox'				=> "Xbox Live",
			'members_tags_wii'				=> "Nintendo Wii",
			'members_tags_ps3'				=> "Playstation Network",
			
			'members_custom_title'			=> "Custom Profile Fields",
			'members_custom_desc'			=> "Extra profile fields created by board administrators.",
			
			'members_password_title'		=> "Change Password",
			'members_password_desc'			=> "If the password needs changed, change it here. Make sure the Change Password option is ticked before submitting the form. An email will be dispatched to this user to inform them of the change.",
			'members_password_change'		=> "Change Password?",
			'members_password_new'			=> "New Password",
			
			'members_select_title'			=> "Edit Members",
			'members_select_desc'			=> "In the members area you can edit a members profile including specific permissions that over-ride their group permissions. To delete a member, select their name from the list and then press delete at the bottom of the page.",
			'members_select_name'			=> "Member Name:",
			'members_select_email'			=> "Member Email:",
			
			'members_ban'					=> "Are you sure you want to ban this member?",
			'members_ban_option'			=> "Ban this member",
			
			'members_unban'					=> "Are you sure you want to unban this member?",
			'members_unban_option'			=> "Unban this member",
			'members_mod_title'				=> "Moderate Posts",
			'members_mod_desc'				=> "Check this option if you wish to preview this members posts before they are publically viewable by the rest of the board.",
			'members_mod_option'			=> "Moderate Users Posts?",
			'members_spam_title'			=> "Avoid SPAM Checks",
			'members_spam_option'			=> "Avoid SPAM Checks?",			
			'members_spam_desc'				=> "Selecting this option means that this members posts will never be checked for SPAM. This verifies this person as a trusted member but you shouldn't need to check this option unless a post written by this member is flagged as potential SPAM when it isn't.",

			'members_updated'				=> "You have successfully updated an user.",
			'members_deleted'				=> "You have successfully deleted an user.",
			'members_banned'				=> "You have successfully banned this user.",
			'members_unbanned'				=> "You have successfully unbanned this user.",
			
		// moderators
			'moderators_title'				=> "Forum Moderator Settings",
			'moderators_title_desc'			=> "Moderator Management Area",
			'moderators_desc_title'			=> "This page lists all your forum moderators in an easy to view area where you can edit, delete and add moderators to a specific forum and set permissions they can only use in that forum.",
			'moderators_forum'				=> "Forum:",
			'moderators_moderator'			=> "Moderator:",
			'moderators_desc'				=> "Set forum specific permissions for this member. This member will then be able to use these permissions in the forum you have specified.",
			'moderators_forum_title'		=> "Forum Specific Permissions",
			'moderators_forum_desc'			=> "Set the permissions that affect the way this group uses this specific forum features.",
			'moderators_warning'			=> "Warning!",
			'moderators_warning_desc'		=> "You are about to perform an action that would result in changes to your forums moderators. Do not proceed if:<ul><li>You clicked on a link given to you by someone else<li>You reached this page without navigating through the Admin CP first<li>You are unsure of the action you are about to do.</ul>",
			'moderators_created'			=> "You have added a moderator.",
			'moderators_updated'			=> "You have updated the privileges of a moderator.",
			'moderators_deleted'			=> "You have removed a moderator.",
					
			
			
		// modules
			'modules_title'					=> "Module Settings",
			'modules_upload'				=> "Upload Modules",
			'modules_upload_desc'			=> "Upload a module using the upload form below. The module will then be available to install in the list below (indicated with a red border to show it is not yet installed).",
			'modules_installed'				=> "Available Modules",
			'modules_remote'				=> "Remote Install Modules",
			'modules_top'					=> "Remotely Available Modules",
			'modules_list_title'			=> "Select List Method",
			'modules_list_downloads'		=> "View By Most Downloads",
			'modules_list_submitted'		=> "View By Date Submitted",
			'modules_list_name'				=> "View By Module Name",
			'modules_limit_title'			=> "Limit",
			'modules_limit_all'				=> "All",
			'modules_order_title'			=> "Order By",
			'modules_order_desc'			=> "Descending",
			'modules_order_asc'				=> "Ascending",			
			'modules_more'					=> "View More...",
			'modules_warning'				=> "Warning!",
			'modules_warning_desc'			=> "You are about to perform an action that would result in changes to your forums modules. Do not proceed if:<ul><li>You clicked on a link given to you by someone else<li>You reached this page without navigating through the Admin CP first<li>You are unsure of the action you are about to do.</ul>",
			'modules_replacement_top'		=> 'Remote install is currently disabled.',
			'modules_replacement_desc'		=> 'The remote module installer is currently disabled and will eventually be removed from LayerBulletin all together. You can get modules from the <a href="http://www.layerbulletin.com" target="_blank">LayerBulletin Community Forums</a>.',
			
			
		// permissions
			'permissions_title'				=> "Forum Permissions",
			'permissions_title_forum'		=> "Forum Specific Permissions",
			'permissions_desc'				=> "For every user group you can specify what they can and can not do in each of your forums. By default, when a new user group is created, all it's permissions are set to Off. User group permissions over-rule forum specific permissions.<br /><br />You can quickly set all permissions by clicking either the permission title or the user group title.",
			'permissions_click_all'			=> "Click here to set full permissions for this group",
			'permissions_show'				=> "Show",
			'permissions_read'				=> "Read",
			'permissions_add'				=> "Add",
			'permissions_reply'				=> "Reply",
			'permissions_download'			=> "Download",
			'permissions_upload'			=> "Upload",
			
		// preview
			'preview_title'					=> "Moderated Posts Centre",
			'preview_sub_title'				=> "Moderated Posts Requiring Approval",
			'preview_desc'					=> "The following posts require approval before being viewable by other members. Please review the post and select whether to approve or reject it.",
			'preview_id'					=> "Post ID",
			'preview_member'				=> "Member",
			'preview_topic'					=> "Topic Title",
			'preview_action'				=> "Approve/Reject",
			'preview_message'				=> "Send A Message",
			'preview_approve'				=> "Approve Post",
			'preview_reject'				=> "Reject Post",
			'preview_approved'				=> "You have successfully approved that post.",
			'preview_rejected'				=> "You have successfully rejected that post.",
			
		// ranks	
			'ranks_title'					=> "Member Rank Settings",
			'ranks_ranks'					=> "Add/Remove Ranks",
			'ranks_desc'					=> "Create custom member ranks in this area. Ranks appear under a members name if they don't have a usertitle set. Pips will appear on all user-groups apart from those that have access to administrative or moderator functions. To remove a rank, hit the delete icon.",
			'ranks_rank_title'				=> "Rank Title",
			'ranks_rank_posts'				=> "No. of Posts Required",
			'ranks_rank_pips'				=> "No. of Pips to Show",
			'ranks_added'					=> "You have successfully added a new rank.",
			'ranks_deleted'					=> "You have successfully deleted a rank.",
			
		// report
			'report_title'					=> "Report Centre",
			'report_action'					=> "Reported Posts Requiring Action",
			'report_action_desc'			=> "The following reported posts require action by a moderator or administrator. When action has been taken, please click the green tick icon.",
			'report_post'					=> "Post #",
			'report_by'						=> "Reported By",
			'report_reason'					=> "Reason",
			'report_reviewed'				=> "Reviewed?",
			'report_pm'						=> "PM this member",
			'report_action_taken'			=> "Click here when action has been taken",
			'report_reviewed_2'				=> "You have successfully removed that report from the moderation queue.",
			
		// rss
			'rss_title'						=> "Syndication Settings",
			'rss_syndication_title'			=> "Forum Syndication",
			'rss_syndication_desc'			=> "Allowing forum syndication means that people can get the latest posts from your forums on their desktop or using other programs without having to visit the forum itself. With this setting turned on, an RSS logo will appear beside a category name to let people know the forum is available for RSS.",
			'rss_on'						=> "Turn RSS On?",
			'rss_posts'						=> "Number of posts to list?",
			'rss_saved'						=> "You have successfully saved the syndication settings.",
			
		// settings
			'settings_global_title'			=> "Global Settings",
			'settings_board_title'			=> "Board Name & Description",
			'settings_board_desc'			=> "Enter a name for your board and it's description.",
			'settings_board_name'			=> "Board Name",
			'settings_board_description'	=> "Board Description",
			'settings_site_title'			=> "Site Homepage",
			'settings_site_desc'			=> "Enter a URL to link to your site homepage, which will place a link in your board header.",

			'settings_email_title'			=> "Board Email",
			'settings_email_desc'			=> "Enter an email address that will be used if members are having trouble with certain areas. This must be a valid address, but for security reasons it is best to write it as <i>myname[at]domain[dot]com</i> instead of <i>myname@domain.com</i> so that bots do not detect it.",
			
			'settings_rules_title'			=> "Rules",
			'settings_rules_desc'			=> "Specify where your Rules page is, and it can be modified here to appear in your board header.",
			
			'settings_time_title'			=> "Change Timezone",
			'settings_time_desc'			=> "If the board time is out, you can offset it by changing it's timezone here. This value is used if a user has not specified an offset in their control panel.",
			'settings_time_select'			=> "Select a Timezone:",
			'settings_time_current'			=> "Current Timezone",
			'settings_time_hours'			=> "hours",
			
			'settings_offline_title'		=> "Turn Board Online/Offline",
			'settings_offline_desc'			=> "If you are making major changes to your forum, it is always best to turn your board offline. Turning it offline only allows administrators to view the forum (or other groups with permission to change site settings).",
			'settings_offline_off'			=> "Turn board offline?",
			'settings_offline_text'			=> "Reason for board being offline? (BB Code Enabled)",
			
			'settings_guests_title'			=> "Guest Registrations",
			'settings_guests_desc'			=> "Turning off this option means no further guests can register to become a member of your forum.",
			'settings_guests_allow'			=> "Allow registrations?",
			
			'settings_register_bar_title'	=> "Registration Bar",
			'settings_register_bar_desc'	=> "This displays a bar at the top of the forum to tell guests they should register.",
			'settings_register_bar_allow'	=> "Show Register Bar?",
			
			'settings_username_title'		=> 'Maximum username length',
			'settings_username_desc'		=> 'Set the maximum number of characters that members\' username can be.',
			'settings_username_box'			=> 'Maximum length:',
			
			'settings_usertitle_title'		=> 'Maximum usertitle length',
			'settings_usertitle_desc'		=> 'Set the maximum number of characters available for members\' usertitles.',
			'settings_usertitle_box'		=> 'Maximum length:',
			
			'settings_tags_title'			=> "Gamer Tags",
			'settings_tags_desc'			=> "Showing gamer tags in members profiles allows your members to interact with each other via their games consoles. This information is not shown to guests.",
			'settings_tags_on'				=> "Turn on gamer tags?",
			
			'settings_password_title'		=> "Password Security",
			'settings_password_desc'		=> "For added security, members should change their password frequently. Enter the number of days a members password is valid for before being told to change it. Setting this option to <strong>0</strong> or <strong>any negative number</strong> will disable it.",
			'settings_password_days'		=> "Valid Days",
			
			'settings_sef_title'			=> "Search Engine Friendly URL's",
			'settings_sef_desc'				=> "Change the look of your board url's. Instead of showing something like <strong>http://www.mydomain.com/index.php?topic=1&limit=5</strong> by turning this option on, it would become <strong>http://www.mydomain.com/topic/1/5</strong>.<br />Please check for <i>mod_rewrite</i> in the list of loaded Apache modules on your server.<br /><span style='color: red;'>If it exists, you can use this function, if not, do NOT tick this box!</span>",
			'settings_sef_on'				=> "Turn on SEF URL's?",
						
			'settings_force_title'			=> "Force Guest Register",
			'settings_force_desc'			=> "If a guest has permission to view topics, you can limit the number they can view by changing this setting. When they reach this limit they will be asked to register. Setting this to <strong>-1</strong> will turn off the limit allowing guests to browse all topics they have permission to view.",
			'settings_force_views'			=> "Maximum topic views",
			
			'settings_warn_title'			=> "Warnings",
			'settings_warn_desc'			=> "Set the maximum number of warnings you can give members before they are automatically banned.",
			'settings_warn_level'			=> "Maximum Warn Level",
			
			'settings_theme_title'			=> "Default Theme",
			'settings_theme_desc'			=> "Select the default theme that is used for the forum. Members can change their theme in My Options if they have sufficient permission to. Tick Force box if you want all members to use this theme.",
			'settings_theme_select'			=> "Select Theme:",
			'settings_theme_force'			=> "Force?",
			
			'settings_lang_title'			=> "Board Language",
			'settings_lang_desc'			=> "Select the default language that is used for the forum. Members can change their language using the drop-down box at the bottom of every page.",
			'settings_lang_select'			=> "Select Language:",
			
			'settings_visitors_title'		=> "Show Last 24 Hours Visitors",
			'settings_visitors_desc'		=> "You can show the members that have visited in the last 24 hours by turning on this option The list will appear at the bottom of your forum index.",
			'settings_visitors_show'		=> "Show yesterdays visitors?",
			'settings_saved'				=> "You have successfully saved the global settings.",
			
		// smilies
			'smilies_title'					=> "Board Emoticons",
			'smilies_select'				=> "Select Emoticons",
			'smilies_desc'					=> "Select emoticons from emoticon folder and input the code they should use to display them on this page.",
			'smilies_shortcode'				=> "Shorthand Code:",
			'smilies_on'					=> "On?",
			'smilies_check'					=> "Check/Uncheck All",
			
			'smilies_theme_title'			=> "Emoticon Settings",
			'smilies_theme_desc'			=> "Select the theme that your emoticons are placed in. The next page allows you to assign custom short-codes for each emoticon.",
			'smilies_theme_select'			=> "Select Emoticon Location",
			'smilies_theme_default'			=> "Default Emoticons",
			'smilies_updated'				=> "You have updated the emoticons settings.",
			
		// spam
			'spam_title'					=> "Spam Protection Settings",
			'spam_key'						=> "Akismet Key",
			'spam_invalid'					=> "Invalid Key",			
			'spam_desc'						=> "Akismet is the best way to identify posts as spam or not. To use this service, you must register to obtain an API key.<br /><br />
												You can get your API key by going to your <a href='https://akismet.com/account/' target='_blank'>Akismet Account page</a> and then clicking Reveal on the right hand side.<br /><br />
												Copy and paste that key into the text box below to get instantly protected from spam posts.",
			'spam_recaptcha_title'			=> "reCAPTCHA Verification",
			'spam_recaptcha_desc'			=> "reCAPTCHA is a human verification script that can replace the default CAPTCHA on the boards registration screen. It provides better security than our standard CAPTCHA and so its use is very much encouraged.<br /><br />
												You will need a valid public & private key for this to work (please do not simply fill in the fields with anything other than valid keys otherwise the registration page will not operate properly). To get your keys, you need to sign up to the <a href='https://www.google.com/recaptcha/admin' target='_blank'>reCAPTCHA website</a>.",
			'spam_recaptcha_public'			=> "Public Key",
			'spam_recaptcha_private'		=> "Private Key",
			'spam_saved'					=> "You have successfully saved the spam protection settings.",
			
		// subscriptions
			'subscriptions_title'			=> "Subscriptions",
			'subscriptions_create_new'		=> "Create New Subscription",
			'subscriptions_edit'			=> "Edit Subscription",
			'subscriptions_name'			=> "Subscription Name",
			'subscriptions_features'		=> "Subscription Features",
			'subscriptions_groups'			=> "Upgrade Groups",
			'subscriptions_cost'			=> "Subscription Cost",
			
			'subscriptions_currency'		=> "Subscription Currency",
			
			'subscriptions_gbp'				=> "British Pounds",
			'subscriptions_aud'				=> "Australian Dollars",
			'subscriptions_cad'				=> "Canadian Dollars",
			'subscriptions_czk'				=> "Czeck Koruna",
			'subscriptions_dkk'				=> "Danish Kroner",
			'subscriptions_eur'				=> "Euros",
			'subscriptions_hkd'				=> "Hong Kong Dollars",
			'subscriptions_huf'				=> "Hungarian Forint",
			'subscriptions_jpy'				=> "Japanese Yen",
			'subscriptions_nzd'				=> "New Zealand Dollars",
			'subscriptions_nok'				=> "Norwegian Krone",
			'subscriptions_pln'				=> "Polish Zlotych",
			'subscriptions_sgd'				=> "Singapore Dollars",
			'subscriptions_sek'				=> "Swedish Kronor",
			'subscriptions_chf'				=> "Swiss Francs",
			'subscriptions_usd'				=> "US Dollars",
			
			'subscriptions_days'			=> "Day(s)",
			'subscriptions_weeks'			=> "Week(s)",
			'subscriptions_months'			=> "Month(s)",
			'subscriptions_years'			=> "Years(s)",
					
			'subscriptions_frequency'		=> "Payment Frequency",
			
			'subscriptions_once'			=> "Leave the frequency options if this is a one-off payment",
			'subscriptions_email'			=> "PayPal Address",
			
			'subscriptions_active'			=> "Paypal Settings",
			'subscriptions_options'			=> "Edit/Delete Subscriptions",
			'subscriptions_options_desc'	=> "In this area you can select to edit or delete a subscription.",

			'subscriptions_created'			=> "You have successfully created a new subscription.",
			'subscriptions_updated'			=> "You have successfully updated a subscription.",
			'subscriptions_deleted'			=> "You have successfully deleted a subscription.",
			
		// themes
			'themes_title'					=> "Theme Settings",
			'themes_upload'					=> "Upload Themes",
			'themes_upload_desc'			=> "Upload a theme using the upload form below. The theme will then be available to install in the list below (indicated with a red border to show it is not yet installed).",
			'themes_installed'				=> "Available Themes",
			'themes_remote'					=> "Remote Install Themes",
			'themes_top'					=> "Remotely Available Themes",
			'themes_list_title'				=> "Select List Method",
			'themes_list_downloads'			=> "View By Most Downloads",
			'themes_list_submitted'			=> "View By Date Submitted",
			'themes_list_name'				=> "View By Theme Name",
			'themes_limit_title'			=> "Limit",
			'themes_limit_all'				=> "All",
			'themes_order_title'			=> "Order By",
			'themes_order_desc'				=> "Descending",
			'themes_order_asc'				=> "Ascending",				
			'themes_more'					=> "View More...",
			'themes_warning'				=> "Warning!",
			'themes_warning_desc'			=> "You are about to perform an action that would result in changes to your forums themes. Do not proceed if:<ul><li>You clicked on a link given to you by someone else<li>You reached this page without navigating through the Admin CP first<li>You are unsure of the action you are about to do.</ul>",
			'themes_replacement_top'		=> 'Remote install is currently disabled.',
			'themes_replacement_desc'		=> 'The remote module installer is currently disabled and will eventually be removed from LayerBulletin all together. You can get modules from the <a href="http://www.layerbulletin.com" target="_blank">LayerBulletin Community Forums</a>.',
			
		// topics
			'topics_title'					=> "Topic & Post Settings",
			'topics_topic_title'			=> "Topic & Post View",
			'topics_topic_desc'				=> "The option below selects how many topics & posts are shown on any one page. For Topics, this is the amount of topics showing in a forum, and for posts, this is the amount of posts shown in an individual topics. The default setting of 30 for each is normally a good value to use.",
			'topics_topic_page'				=> "Number of Topics on a Page",
			'topics_posts_page'				=> "Number of Posts on a Page",
			
			'topics_hot_title'				=> "Hot Topics",
			'topics_hot_desc'				=> "Set this value to the average number of posts in a topic per day since it started, for that topic to become hot. For example: A topic has been open for 3 days, and has had an average of 30 replies per day. If your Hot Topic Value is less than 30, this topic will show up as a hot topic. If your value is more than 30, it will not show up as a hot topic.",
			'topics_hot_value'				=> "Hot Topic Value",
			
			'topics_edit_title'				=> "Record Post Edit History",
			'topics_edit_desc'				=> "You can set the board to keep a record of any edits that are made to posts. Any member group that has permission to edit other peoples posts will see any edit history for any post that has had changes made to it. You can see who edited the post, at what time, and what the post looked like before that entry was made. Every history entry can be deleted.",
			'topics_edit_store'				=> "Store post edit history?",
			
			'topics_key_title'				=> "Keyword Tags",
			'topics_key_desc'				=> "Keyword tags are a list of the most popular words used in a topic. These dynamically update as more replies are added. By clicking on a tag, it will bring up a list of other topics or posts that may be related.",
			'topics_key_show'				=> "Show keyword tags?",
			
			'topics_quick_title'			=> "Quick Edit",
			'topics_quick_desc'				=> "Turning on quick edit in posts allows people to make quick changes to their posts by showing the textbox with their posts content inside directly below the message they wish to edit.",
			'topics_quick_show'				=> "Use quick edit?",
			
			'topics_merge_title'			=> "Auto Merge",
			'topics_merge_desc'				=> "This automatically merges two posts by the same member in the same topic that are posted within 15 minutes of each other when that member is the last person to reply to that topic. It appends that members reply to the bottom of their last post.",
			'topics_merge_show'				=> "Use auto merge?",
			
			'topics_trashcan_title'			=> 'Trashcan Forum',
			'topics_trashcan_desc'			=> 'If the trashcan forum is enabled, any deleted posts will be moved to this forum instead of being permanently deleted. If you are changing the forum to be used for the trashcan, select which forum to move all current posts to.',
			'topics_trashcan_enabled'		=> 'Enable?',
			'topics_trashcan_forum'			=> 'Which Forum Should be Used?',
			'topics_trashcan_move'			=> 'Move Posts From this Forum to:',
			'topics_trashcan_delete'		=> 'Delete Posts Older Than:',
			
			'topics_announce_title'			=> "Announcements",
			'topics_announce_desc'			=> "By default when you post an announcement on your forum, it acts just like a normal topics in that it has the ability to show as the latest reply in any of your forums. This is useful if you want people to notice new replies, but it may have the effect of showing up as the latest reply in EVERY forum on your forum index. Untick this box if you want to hide new replies to announcements on the forum index.",
			'topics_announce_show'			=> "Show Announcements on Forum Index?",
			'topics_saved'					=> "You have successfully saved the Topic & Post settings.",
			
			'suspended_subject'				=> 'Suspended Members',
			'suspended_title'				=> 'View currently banned/suspended members.',
			'suspended_desc'				=> 'This page allows you to view members who are currently banned or suspended. It should help you to keep track of members you have banned or suspended and will allow you to unban or change their suspension date.<br /><br />Note: To unsuspend a member, leave the \'change suspension\' box empty.',
	
			'suspended_member'				=> 'Member Name',
			'suspended_type'				=> 'Type',
			'suspended_ends'				=> 'Suspension Ends On',
			'suspended_unban'				=> 'Unban / Change Suspension',
	
			'suspended_no_members'			=> 'There are no banned/suspended members to display',
			'suspended_banned'				=> 'Banned',
			'suspended_suspended'			=> 'Suspended',
	
			'suspended_n/a'					=> 'N/A',
	
			'suspended_update'				=> 'Update Members'			
);
?>
