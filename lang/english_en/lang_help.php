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
|   lang_help.php - Language file - Help Area - English
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.<br />";
	exit();
}

$lang_help = array (

	// This block deals with the help page
	// You may use HTML if you wish

		// help
			'help_topics'				=> "Help Topics",
			'help_desc'					=> "Select a topic to view",
			'help_search_title'			=> "Searching Topics & Posts",
			'help_search_desc'			=> "How to use the search feature.",
			'help_active_title'			=> "Viewing Active Topics & New Posts",
			'help_active_desc'			=> "How to view all the topics which have a new reply and the new posts made since your last visit.",
			'help_email_title'			=> "Email Notification of New Messages",
			'help_email_desc'			=> "How to get emailed when a new reply is added to a topic.",
			'help_myoptions_title'		=> "Your Control Panel (My Options)",
			'help_myoptions_desc'		=> "Editing contact information, personal information, avatars, signatures, board settings, languages and theme choices.",
			'help_messages_title'		=> "Your Personal Messages",
			'help_messages_desc'		=> "How to send & delete personal messages.",
			'help_register_title'		=> "Registration Benefits",
			'help_register_desc'		=> "How to register and the added benefits of being a registered member.",
			'help_password_title'		=> "Recovering Lost or Forgotten Passwords",
			'help_password_desc'		=> "How to reset your password if you've forgotten it.",
			'help_members_title'		=> "Viewing Members Profile Information",
			'help_members_desc'			=> "How to view members contact information.",
			'help_login_title'			=> "Logging In and Out",
			'help_login_desc'			=> "How to log in and out from the board.",
			'help_posting_title'		=> "Posting",
			'help_posting_desc'			=> "A guide to the features available when posting on the boards.",
			'help_mods_title'			=> "Contacting the Moderating Team & Reporting Posts",
			'help_mods_desc'			=> "Where to find a list of the board moderators and administrators.",
			
		// help content
			'help_search_contents'		=> "The search feature is designed to allow you to quickly find topics and posts that contain the keywords you enter.<br /><br />
											All you need to do is enter a keyword into the search box, and select the forum(s) to search in. (to select multiple forums, hold down the control key on a PC, or the Shift/Apple key on a Mac) and search.<br /><br />
											In addition to searching by keyword, you are able to search by a members username,  or a combination of both. You can also choose to refine your search by selecting a date range.",
			'help_active_contents'		=> "The 'x New Post(s)' link in the member bar at the top of each page will allow you to view all of the topics which have new replies since your last visit to the board.",
			'help_email_contents'		=> "This board can notify you when a new reply is added to a topic. Many users find this useful to keep up to date on topics without the need to view the board to check for new messages.<br /><br />
											To subscribe to a topic click the 'Subscribe to this Topic' link at the top of a topic. This will send out a notification immediately after a reply has been made.<br /><br />
											You are also able to subscribe to each individual forum on the board, to be notified when a new topic is created in that particular forum. To enable this, click the 'Subscribe to this Forum' link at the top forum you wish to subscribe to.<br /><br />
											To unsubscribe from any forums or topics that you are subscribed to - just click the 'Unsubscribe from this Forum' or 'Unsubscribe from this Topic' link on the topic/forum you are subscribed to or alternatively, click the unsubscribe link in any subscription email you receive.",
			'help_myoptions_contents'	=> "The control panel is where you set up your personal preferences for the board. You can change how the board looks and operates for you from here.<br /><br />
											
											<strong>Personal Profile</strong><br /><br />
											
											<i>Edit Information:</i><br />
											Here you can specify your own personal information, such as your location & contact information.
											<i>Signature Setting</i>:<br />
											You can manage your signature from here. You may use BBcode to format your signature (to link to images, etc.) or even HTML if the board administrator has allowed it.<br /><br />
											<i>Avatar Settings:</i><br /><br />
											You can view and manage your personal avatar from here. You can upload an image from your computer to use as your avatar (the image will be resized if it is larger than the dimensions allowed by the board administrator).<br /><br />
											<i>Change Username:</i><br />
											If your usergroup has permission, you can change how your name appears on the board from here.<br /><br />
											<i>Change Usertitle:</i><br />
											If your usergroup has permission, you can change your usertitle from here.<br /><br />
											<i>Change Password:</i><br />
											You can change your current board password from here.<br /><br />

											<strong>Options:</strong><br /><br />

											<i>Upgrade Subscription</i>:<br />
											If there are subscription packages available on the board they will be displayed here. You can choose a subscription package and purchase it, or upgrade your existing subscription (depending on board-specific settings).<br /><br />
											<i>Change Timezone</i>:<br />
											If the boards default time is different to your timezone, choose the correct time offset from here.",
			'help_messages_contents'	=> "Your personal messenger allows you to send and receive messages from other members.<br /><br >

											<strong>Send a new PM</strong><br />
											This will allow you to send a message to another member. Enter a name in the relevant form field. This will be automatically filled in if you clicked a 'PM' button on the board (from the member list or a post).<br /><br />
											There is also a 'type-ahead' feature which automatically pulls users from the database as you start typing their name.<br /><br />

											<strong>Inbox</strong><br />
											Your inbox is where all new messages are sent to - sorted into date categories. Clicking on the message title will show you the message in a similar format to the board topic view. You can also delete messages from your inbox.<br /><br />",
											
			'help_register_contents'	=> "To be able to use all the features on this board, the administrator will probably require that you register for a member account. Registration is free and only takes a moment to complete.<br /><br />
											During registration, the administrator requires that you supply a valid email address. This is important as the administrator requires that you validate your registration via an email. If your e-mail does not arrive, then on the member bar at the top of the page, there will be a link that will allow you to re-send the validation e-mail.<br /><br /> 
											Once you have registered and logged in, you will have access to your personal messenger and your control panel.<br /><br />
											For more information on these items please see the relevant sections in this documentation.",
										
			'help_password_contents'	=> "Security is a big feature on this board, and to that end, all passwords are encrypted when you register.<br /?<br />
											This means that we cannot email your password to you as we hold no record of your 'uncrypted' password. You can however, apply to have your password reset.<br /><br />
											To do this, click on the <a href=\"$lb_domain/index.php?page=password\">Lost Password</a> link found on the log in page.<br /><br />
											Further instruction are available from there.",
			'help_members_contents'		=> "To view a member's profile, you can click on their name from nearly anywhere in the board.  If you'd like to view your own profile, you can click on your name in the navigation bar underneath the board's header.",
			'help_login_contents'		=> "If you have chosen not to remember your log in details, or you are accessing the board on another computer, you will need to log into the board to access your member profile and post with your registered name.<br /><br />
											When you log in, you have the choice to log in automatically when you return. Do not use this option on a shared computer for security.<br /><br />
											Logging out is simply a matter of clicking on the 'Log Out' link that is displayed when you are logged in. If you find that you are not logged out, you may need to manually remove your cookies.",
			'help_posting_contents'		=> "There are two different posting screens available. The new topic button, visible in forums and in topics allows you to add a new topic to that particular forum. When viewing a topic, there will be an add reply button, allowing you to add a new reply onto that particular topic.<br /><br />

											<strong>Posting new topics and replying</strong><br />
											When making a post, you will have the option to use BB Code when posting. This will allow you to add various types of formatting to your messages.<br /><br />

											<strong>The Toolbar</strong><br />

											From left to right:<br />
											<ul>
											<li>Bold: This will make your text appear heavier.
											<li>Italic: This will make your text italicized.
											<li>Underline: This will underline your text.
											<li>Strikethrough: This will add a strikethrough your text.
											<li>Link: Add a link to an external webpage.
											<li>Image: Add an image to your post.
											<li>Quote: Quote an external source.
											<li>Left Align: Align your text so it sticks to the left of the page.
											<li>Center Align: Align your text so it appears on the middle of the page.
											<li>Right Align: Align your text so it sticks to the right of the page.
											<li>Bullet List: Creates a standard list using bullet points.
											<li>Ordered List: Creates a list that numbers each item.
											<li>Youtube: Shows a youtube video based on the entered video ID.
											<li>Hide: Masks the contents written between the tags - becomes visible when member posts a reply.
											<li>Spoiler: Masks the contents written between the tags - becomes visible when 'Spoiler' link is clicked.
											<li>Anchor: This allows you to place a marker in your post to directly link to.
											<li>Anchor Jump: This places a link that when clicked will go directly to an anchor (see above) in that post.
											<li>Code: This will make your text appear in raw form (no formatting).
											<li>PHP Code: This will make your text appear in PHP highlighted syntax.
											</ul>
											In addtion, there is a special <strong>[html][/html]</strong> BB code tag that can be used to post HTML if your user groups has permission to do so.<br /><br/ >

											<strong>Poll Options</strong><br />
											If you have chosen to post a new poll, there will be extra option boxes available. The first input box will allow you to enter the question that you are asking in the poll. Then you will input the choices for the poll in the various textfields below that.<br /><br />

											<strong>Quoting Posts</strong><br />
											Displayed below each post in a topic, there is a 'Quote' button. Pressing this button will allow you to reply to a topic, and have the text from a particular reply quoted in your own reply.<br /><br />

											<strong>Editing Posts</strong><br />
											Below any posts that you have made, you may see an 'Edit' button. Pressing this will allow you to edit the post that you had previously made.<br /><br />
											When editing you may see an option to give a reason for the edit. Fill this in to explain the reason for your edit.<br /><br />
											If you are unable to see the edit button displayed on each post that you have made, then the administrator may have prevented you from editing posts.<br /><br />

											<strong>Quick Reply</strong><br />
											Where it has been enabled, there will be a quick reply button on each topic. Clicking this will open up a posting box on the topic view screen, cutting down on the time required to load the main posting screen. Click the quote reply button to expand the reply box and type the post inside of there.",
											
			'help_mods_contents'		=> "<strong>Contacting the moderating team</strong><br /><br />
											If you need to view the complete administration team, you can do the following:<br />

											<ul>
											<li>Email the board administrator at $default_board_email
											<li>View the <a href=\"$lb_domain/index.php?page=list&list=members\">members list</a>, select an administrative/moderator user group, then send them a PM.
											</ul>

											If you wish to contact someone about your member account, then contact an administrator - if you wish to contact someone about a post or topic, contact either a global moderator or the forum moderator.<br /><br />

											<strong>Reporting a post</strong><br />
											You'll see a 'Report' button in a post, at the bottom of a post. This function will let you report the post to the forum moderator (or the administrator(s), if there isn't a specific moderator available). You can use this function when you think the moderator(s) should be aware of the existance of that post. However, do not use this to chat with the moderator(s)!. You can use the Personal Messenger function for that.",

			);

?>