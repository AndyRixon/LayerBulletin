<?php

@ini_set('zlib.output_compression', 1);

error_reporting(0);
ini_set('magic_quotes_runtime', 0);

ob_start();
session_start();

define("LB_RUN", 1);
define("LB_VERSION", '1.1.6');

$my_address		= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$lb_domain 	= str_replace('/install.php', '', $my_address);
$lb_root		= str_replace('install.php', '', __FILE__);

if(file_exists($lb_root . "/cache/installer.lock")){
	echo "<div style='padding:10px; background: #ECD5D8; color: #BC2A4D; border:1px solid #BC2A4D;'>The installer is currently locked, please remove the installer.lock file from the cache directory to continue!</div>";
	exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>
<title>LayerBulletin | Install</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico" />
<link href="themes/layerbulletin_default/stylesheet.css" type="text/css" rel="stylesheet" />
		<!--[if lt IE 7]><script type="text/javascript" src="scripts/js/unitpngfix.js"></script><![endif]-->

<style type="text/css">
.site-width{
	-moz-border-radius-bottomleft:10px;
	-moz-border-radius-bottomright:10px;
	-moz-border-radius-topleft:10px;
	-moz-border-radius-topright:10px;
	-webkit-border-radius-bottomleft:10px;
	-webkit-border-radius-bottomright:10px;
	-wekbit-border-radius-topleft:10px;
	-webkit-border-radius-topright:10px;
	-webkit-border-bottom-left-radius: 10px;
	-webkit-border-bottom-right-radius: 10px;
	-webkit-border-top-left-radius: 10px;
	-webkit-border-top-right-radius: 10px;	
}

button[type=submit] {
	width: auto;
	padding-top: 0px;
	padding-bottom: 0px;
	padding-left: 22px;
	padding-right: 0px;
	_padding-top: 2px;
	_padding-bottom: 2px;
	_padding-left: 2px;
	background-color: transparent;
	color: #0B2233;
	font-size: 11px;
	font-weight: bold;
	text-decoration: none;
	cursor: pointer;
	border: none;
	background-repeat: no-repeat;
	background-position: 4px 50%;
}
</style>
</head>
<body>

		<script type="text/javascript">
			function check_license() {

				if (document.getElementById('license').checked == false) {
					alert('You need to agree to the license to continue!');
                                        return false;
				}
			}

			function check_passwords() {

				if (document.getElementById('pass').value != document.getElementById('check_pass').value) {
					alert('Passwords don\'t match!');
                                        return false;
				}
			}
		</script>


<div class="site-width">

		<div class="header">
		<div class="header-left">
			<a href="#"><img src="images/pages/header-left.png" alt="" /></a>
		</div>

		<div class="header-right">

			<a class="header-site-name" href="#" ><strong>LayerBulletin v<?php echo LB_VERSION ?></strong></a><br />

			<span class="header-text-sub">Forum Software Installation</span>
		</div>

		</div>
<table cellpadding="0" cellspacing="0" style="width:100%; vertical-align: middle;"><tr>
		<td class="header-menu">

			<span class="header-links">

			<span style="color: black;">Installation Progress:</span>&nbsp;&nbsp;			

<?php if ($_GET['step']==''){ ?>

			<span style="color: #3C8AD9;">T's & C's</span> | Folder Permissions | Database Details | Admin Details | Complete Installation

<?php } elseif ($_GET['step']=='2'){
if ($_POST['prev_step'] != 1){
header("HTTP/1.0 200 OK");
header("Location: install.php");
exit;
}
?>
			T's & C's | <span style="color: #3C8AD9;">Folder Permissions</span> | Database Details | Admin Details | Complete Installation

<?php } elseif ($_GET['step']=='3'){
if ($_POST['prev_step'] != 2 && $_SESSION['prev_step'] != 4){
header("HTTP/1.0 200 OK");
header("Location: install.php");
exit;
}
?>
			T's & C's | Folder Permissions | <span style="color: #3C8AD9;">Database Details</span> | Admin Details | Complete Installation

<?php } elseif ($_GET['step']=='4'){
if ($_POST['prev_step'] != 3){
header("HTTP/1.0 200 OK");
header("Location: install.php");
exit;
}
?>
			T's & C's | Folder Permissions | <span style="color: #3C8AD9;">Database Details</span> | Admin Details | Complete Installation

<?php } elseif ($_GET['step']=='5'){
if ($_POST['prev_step'] != 4 && $_SESSION['prev_step'] != 4){
header("HTTP/1.0 200 OK");
header("Location: install.php");
exit;
}
?>
			T's & C's | Folder Permissions | Database Details | <span style="color: #3C8AD9;">Admin Details</span> | Complete Installation

<?php } elseif ($_GET['step']=='6'){
if ($_POST['prev_step'] != 5){
header("HTTP/1.0 200 OK");
header("Location: install.php");
exit;
}
?>
			T's & C's | Folder Permissions | Database Details | Admin Details | <span style="color: #3C8AD9;">Complete Installation</span>

<?php } ?>

			</span>

		</td></tr></table>

		<div class="spacer">&nbsp;</div>


		<div class="content" style="border-left: none; border-right: none;">
		<table cellspacing="0" cellpadding="0" style="width:100%;"><tr><td>

<?php

// Set db_ global...
global $db_prefix;

if (!extension_loaded('gd')){
?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>

				<td class="forum-topic-subject">Installation</td>
			</tr>
		</table>
			<table class="forum-jump" cellpadding="0" cellspacing="0">
				<tr>
					<td class="error-header" style="width:100%;">
						GD Library Not Found!
					</td>
				</tr>
				<tr>
					<td class="forum-jump-content" style="width:100%;">
						Installation can not continue because we could not find the GD library on your server.<br />Please contact the server administrator to get this installed.

					</td>
				</tr>
			
		</table>

		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>	
<?php
}

elseif ($_POST['username']!=''){

include "includes/config.php";

// Start database install...

mysql_query("CREATE TABLE `{$db_prefix}attachments` (
  `row` int(11) NOT NULL auto_increment,
  `filename` varchar(255) NOT NULL default '',
  `filesize` int(11) NOT NULL default '0',
  `original_filename` varchar(255) NOT NULL default '',
  `hash` int(11) NOT NULL default '0',
  `postid` int(11) NOT NULL default '0',
  `topicid` int(11) NOT NULL default '0', 
  `member` int(11) NOT NULL default '0',
  `downloads` int(11) NOT NULL default '0',
  `file_total_rating` int(11) NOT NULL default '0',
  `file_number_rating` int(11) NOT NULL default '0',
  PRIMARY KEY  (`row`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");


mysql_query("CREATE TABLE `{$db_prefix}bots` (
  `bot_id` int(11) NOT NULL default '0',
  `bot_name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`bot_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("INSERT INTO `{$db_prefix}bots` (`bot_id`, `bot_name`) VALUES 
(-1, 'AbiLogicBot'),
(-2, 'Accoona-AI-Agent'),
(-3, 'AnyApexBot'),
(-4, 'B-l-i-t-z-B-O-T'),
(-5, 'Baiduspider'),
(-6, 'BlitzBOT'),
(-7, 'FAST-WebCrawler'),
(-8, 'FurlBot'),
(-9, 'FyberSpider'),
(-10, 'genieBot'),
(-11, 'Gigabot'),
(-12, 'Googlebot'),
(-13, 'Googlebot-Image'),
(-14, 'hl_ftien_spider'),
(-15, 'ia_archiver'),
(-16, 'ichiro'),
(-17, 'IRLbot'),
(-18, 'Jyxobot'),
(-19, 'LapozzBot'),
(-20, 'Larbin'),
(-21, 'mabontland'),
(-22, 'MJ12bot'),
(-23, 'MojeekBot'),
(-24, 'msnbot'),
(-25, 'MSRBot'),
(-26, 'nicebot'),
(-27, 'noxtrumbot'),
(-28, 'Nusearch Spider'),
(-29, 'OmniExplorer_Bot'),
(-30, 'Orbiter'),
(-31, 'Pompos'),
(-32, 'Psbot'),
(-33, 'RufusBot'),
(-34, 'SandCrawler'),
(-35, 'SBIder'),
(-36, 'SearchSight'),
(-37, 'Seekbot'),
(-38, 'semanticdiscovery'),
(-39, 'Sensis Web Crawler'),
(-40, 'Shoula robot'),
(-41, 'sogou spider'),
(-42, 'Speedy Spider'),
(-43, 'StackRambler'),
(-44, 'SurveyBot'),
(-45, 'SynooBot'),
(-46, 'Teoma'),
(-47, 'TerrawizBot'),
(-48, 'Thumbnail.CZ robot'),
(-49, 'VoilaBot'),
(-50, 'voyager'),
(-51, 'Websquash.com'),
(-52, 'WoFindeIch Robot'),
(-53, 'Yahoo! Slurp'),
(-54, 'Yahoo! Slurp China'),
(-55, 'YahooSeeker'),
(-56, 'yoogliFetchAgent'),
(-57, 'Zao'),
(-58, 'Zealbot'),
(-59, 'zspider'),
(-60, 'Zyborg'),
(-61, 'Twiceler');");

mysql_query("CREATE TABLE `{$db_prefix}categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `forum_rules` text NOT NULL,
  `parent` int(11) NOT NULL default '1',
  `theme` varchar(255) NOT NULL default '', 
  `forum_order` int(11) NOT NULL default '1',
  `read_only` tinyint(1) NOT NULL default '0',
  `post_count` tinyint(1) NOT NULL default '1',
  `cat_topics` int(11) NOT NULL default '0',
  `cat_posts` int(11) NOT NULL default '0',
  `cat_latest_id` int(11) NOT NULL default '0',
  `cat_latest_topic` int(11) NOT NULL default '0',
  `cat_latest_time` varchar(255) NOT NULL default '',
  `cat_latest_title` varchar(255) NOT NULL default '',
  `cat_latest_member_id` int(11) NOT NULL default '0',
  `cat_latest_member_name` varchar(255) NOT NULL default '',
  `redirect_url` VARCHAR( 255 ) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("CREATE TABLE `{$db_prefix}censor` (
  `row` int(11) NOT NULL auto_increment,
  `word` varchar(255) NOT NULL default '',
  `new_word` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`row`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("CREATE TABLE `{$db_prefix}custom_fields` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `order_field` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("CREATE TABLE `{$db_prefix}custom_members` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL default '0',
  `field_id` int(11) NOT NULL default '0',
  `content` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("CREATE TABLE `{$db_prefix}group_upgrade` (
  `upgrade_id` int(11) NOT NULL auto_increment,
  `upgrade_name` varchar(255) NOT NULL default '',
  `upgrade_features` text NOT NULL,
  `upgrade_from` int(11) NOT NULL default '0',
  `upgrade_to` int(11) NOT NULL default '0',
  `upgrade_cost` varchar(255) NOT NULL default '',
  `upgrade_currency`  varchar(255) NOT NULL default '',
  `upgrade_period` int(11) NOT NULL default '0',
  `upgrade_period_two` varchar(255) NOT NULL default '',
  `paypal_email` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`upgrade_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("CREATE TABLE `{$db_prefix}group_upgrade_details` (
  `row` int(11) NOT NULL auto_increment,
  `member` int(11) NOT NULL default '0',
  `subscription` int(11) NOT NULL default '0',
  `expires` int(11) NOT NULL default '0',
  PRIMARY KEY  (`row`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("CREATE TABLE `{$db_prefix}groups` (
  `group_id` int(11) NOT NULL auto_increment,
  `group_name` varchar(255) NOT NULL default '',
  `group_color` varchar(255) NOT NULL default '',
  `group_icon` int(3) NOT NULL default '0', 
  `can_view_board` tinyint(1) NOT NULL default '0',
  `can_warn_members` tinyint(1) NOT NULL default '0',
  `can_edit_members` tinyint(1) NOT NULL default '0',
  `can_delete_members` tinyint(1) NOT NULL default '0',
  `can_ban_members` tinyint(1) NOT NULL default '0',
  `can_change_site_settings` tinyint(1) NOT NULL default '0',
  `can_change_forum_settings` tinyint(1) NOT NULL default '0',
  `can_change_style` tinyint(1) NOT NULL default '0',
  `can_use_avatar` tinyint(1) NOT NULL default '0',
  `can_change_user_title` tinyint(1) NOT NULL default '0',
  `can_use_sig` tinyint(1) NOT NULL default '0',
  `can_change_own_name` tinyint(1) NOT NULL default '0',
  `can_pm` tinyint(1) NOT NULL default '0',
  `can_edit_own_posts` tinyint(1) NOT NULL default '0',
  `can_edit_others_posts` tinyint(1) NOT NULL default '0',
  `can_delete_own_posts` tinyint(1) NOT NULL default '0',
  `can_delete_others_posts` tinyint(1) NOT NULL default '0',
  `can_sticky_topics` tinyint(1) NOT NULL default '0',
  `can_global_announce` tinyint(1) NOT NULL default '0',
  `can_move_topics` tinyint(1) NOT NULL default '0',
  `can_lock_topics` tinyint(1) NOT NULL default '0',
  `can_split_topics` tinyint(1) NOT NULL default '0',
  `can_merge_topics` tinyint(1) NOT NULL default '0',
  `can_add_polls` tinyint(1) NOT NULL default '0',
  `can_see_reported_posts` tinyint(1) NOT NULL default '0',
  `can_use_html` tinyint(1) NOT NULL default '0',
  `can_moderate_members` tinyint(1) NOT NULL default '0',
  `avoid_caspian` tinyint(1) NOT NULL default '0', 
  PRIMARY KEY  (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("INSERT INTO `{$db_prefix}groups` (`group_id`, `group_name`, `group_color`, `group_icon`, `can_view_board`, `can_warn_members`, `can_edit_members`, `can_delete_members`, `can_ban_members`, `can_change_site_settings`, `can_change_forum_settings`, `can_change_style`, `can_use_avatar`, `can_change_user_title`, `can_use_sig`, `can_change_own_name`, `can_pm`, `can_edit_own_posts`, `can_edit_others_posts`, `can_delete_own_posts`, `can_delete_others_posts`, `can_sticky_topics`, `can_global_announce`, `can_move_topics`, `can_lock_topics`, `can_split_topics`, `can_merge_topics`, `can_add_polls`, `can_see_reported_posts`, `can_use_html`, `can_moderate_members`, `avoid_caspian`) VALUES 
(1, 'Administrator', 'red', 10, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'Global Moderator', 'blue', 0, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1),
(3, 'Member', 'black', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0),
(4, 'Guest', 'gray', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);");

mysql_query("CREATE TABLE `{$db_prefix}members` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `usertitle` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `role` int(11) NOT NULL default '2',
  `password` varchar(255) NOT NULL default '',
  `password_time` int(10) NOT NULL default '0',
  `pass_salt` varchar(255) NOT NULL default '',
  `theme` varchar(255) NOT NULL default '',
  `board_lang` varchar(255) NOT NULL default '',
  `time_offset` varchar(255) NOT NULL default '',
  `read_all_posts` int(11) NOT NULL default '0',
  `avatar` varchar(255) NOT NULL default '',
  `remote_avatar` tinyint(1) NOT NULL default '1', 
  `signature` text NOT NULL,
  `location` varchar(255) NOT NULL default '',
  `nationality` varchar(255) NOT NULL default '',
  `msn` varchar(255) NOT NULL default '',
  `aol` varchar(255) NOT NULL default '',
  `yahoo` varchar(255) NOT NULL default '',
  `skype` varchar(255) NOT NULL default '',
  `xbox` varchar(255) NOT NULL default '',
  `wii` varchar(255) NOT NULL default '',
  `ps3` varchar(255) NOT NULL default '',
  `last_online` int(11) NOT NULL default '0',
  `warn_level` int(11) NOT NULL default '0',
  `suspend_date` int(11) NOT NULL default '0',
  `whiteboard` text NOT NULL,
  `register_date` int(11) NOT NULL default '0',
  `verified` tinyint(1) NOT NULL default '0',
  `user_posts` int(11) NOT NULL default '0',
  `banned` tinyint(1) NOT NULL default '0',
  `new_pms` tinyint(1) NOT NULL default '0',
  `allow_admin_email` tinyint(1) NOT NULL default '1',
  `moderate` tinyint(1) NOT NULL default '0',
  `subscribe_pm` tinyint(1) NOT NULL default '1',
  `never_spam` tinyint(1) NOT NULL default '0',
  `show_fast_reply` TINYINT( 1 ) NOT NULL DEFAULT '0',
  `friends` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

$username = escape_string($_POST['username']);
$email = escape_string($_POST['email']);
$password = escape_string($_POST['password']);

// Generate salt...
$salt = substr(md5(uniqid(rand(), true)), 0, 9);

// Salt the password
$password= md5($password . $salt);


$time=time();

mysql_query("INSERT INTO `{$db_prefix}members` (`id`, `name`, `usertitle`, `email`, `role`, `password`, `password_time`, `pass_salt`, `theme`, `board_lang`, `time_offset`, `read_all_posts`, `avatar`, `signature`, `location`, `nationality`, `msn`, `aol`, `yahoo`, `skype`, `xbox`, `wii`, `ps3`, `last_online`, `warn_level`, `suspend_date`, `whiteboard`, `register_date`, `verified`, `user_posts`, `banned`, `new_pms`, `allow_admin_email`, `moderate`, `subscribe_pm`, `never_spam`, `remote_avatar`) VALUES 

(1, '$username', '', '$email', 1, '$password', '$time', '$salt', '', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '$time' ,1, 0, 0, 1, 1, 0, 0, 0, 1);");

mysql_query("CREATE TABLE `{$db_prefix}messages` (
  `id` int(11) NOT NULL auto_increment,
  `topic_id` int(11) NOT NULL default '0',
  `member_from` int(11) NOT NULL default '0',
  `member_to` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `content` text NOT NULL,
  `sent_time` int(11) NOT NULL default '0',
  `last_post_time` int(11) NOT NULL default '0',
  `read_time` int(11) NOT NULL default '0',
  `hidden` tinyint(1) NOT NULL default '0',
  `hidden_from` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

	/*
	Add welcome PM message
*/

	mysql_query('
		INSERT INTO ' . $db_prefix . 'messages
		(topic_id, member_from, member_to, title, content, sent_time, last_post_time, hidden)
		VALUES
		(1, 1, 1, "Welcome to LayerBulletin",
		"' . $username . ',
' . chr(10) . chr(13) . '
' . chr(10) . chr(13) . '
Thank you for choosing LayerBulletin as your forum software.
' . chr(10) . chr(13) . '
' . chr(10) . chr(13) . '
We hope that the installation process was straightforward for you, and that you feel that you can get started straight away - if not you can ask our staff and community at our [url=http://www.layerbulletin.com]Community Forums[/url].
' . chr(10) . chr(13) . '
' . chr(10) . chr(13) . '
If you are in need of any assistance, our team and community members can help you, our [url=http://www.layerbulletin.com]Community Forum[/url] is full of tips and tricks for you to expand your community with ease - it is also the one-stop place where you can get in touch with our support staff and the development team should you need any further help.
' . chr(10) . chr(13) . '
' . chr(10) . chr(13) . '
We encourage you to provide us with feedback to help us improve on our software to make your stay here and experience much more enjoyable - After all, our software is built for our community.
' . chr(10) . chr(13) . '
' . chr(10) . chr(13) . '
LayerBulletin comes complete with an update checker from within the [url=' . $lb_domain . '/index.php?page=admin]Admin Control Panel[/url] (Admin CP) so that you can ensure you have the latest bug fixes so that you can rest assured that your community is secure from those pesky back-doors - the update checker checks for updates every 12 hours.
' . chr(10) . chr(13) . '
' . chr(10) . chr(13) . '
Andy Rixon,
' . chr(10) . chr(13) . '
On behalf of the LayerBulletin Team
' . chr(10) .chr(13) . '
[url=http://www.layerbulletin.com]http://www.layerbulletin.com[/url]",
		' . $time . ',
		' . $time . ',
		1
		)
	') or die (mysql_error());
	

mysql_query("CREATE TABLE `{$db_prefix}moderate` (
  `id` int(11) NOT NULL auto_increment,
  `postid` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `member_id` int(11) NOT NULL default '0',
  `member_name` varchar(255) NOT NULL default '',
  `time` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("CREATE TABLE `{$db_prefix}moderators` (
  `row` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL default '0',
  `forum_id` int(11) NOT NULL default '0',
  `can_warn_members` tinyint(1) NOT NULL default '0', 
  `can_ban_members` tinyint(1) NOT NULL default '0',
  `can_edit_members` tinyint(1) NOT NULL default '0',
  `can_edit_own_posts` tinyint(1) NOT NULL default '0', 
  `can_edit_others_posts` tinyint(1) NOT NULL default '0',
  `can_delete_own_posts` tinyint(1) NOT NULL default '0',
  `can_delete_others_posts` tinyint(1) NOT NULL default '0',
  `can_sticky_topics` tinyint(1) NOT NULL default '0',  
  `can_move_topics` tinyint(1) NOT NULL default '0', 
  `can_lock_topics` tinyint(1) NOT NULL default '0',
  `can_split_topics` tinyint(1) NOT NULL default '0',
  `can_merge_topics` tinyint(1) NOT NULL default '0', 
  `can_add_polls` tinyint(1) NOT NULL default '0',
  `can_see_reported_posts` tinyint(1) NOT NULL default '0', 
  `can_use_html` tinyint(1) NOT NULL default '0',
  `can_moderate_members` tinyint(1) NOT NULL default '0', 
  PRIMARY KEY  (`row`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("CREATE TABLE `{$db_prefix}modules` (
  `id` int(11) NOT NULL auto_increment,
  `module_name` varchar(255) NOT NULL default '',
  `display_name` varchar(255) NOT NULL default '',
  `lb_version` varchar(255) NOT NULL default '', 
  `installed` tinyint(1) NOT NULL default '0', 
  `config_page` varchar(255) NOT NULL default '',   
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");


mysql_query("CREATE TABLE `{$db_prefix}nations` (
  `nation_name` varchar(255) NOT NULL default '',
  `nation_short` varchar(255) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("INSERT INTO `{$db_prefix}nations` (`nation_name`, `nation_short`) VALUES 
('Argentina', 'ar'),
('Australia', 'au'),
('Austria', 'at'),
('Belarus', 'by'),
('Belgium', 'be'),
('Brazil', 'br'),
('Bulgaria', 'bg'),
('Canada', 'ca'),
('China', 'cn'),
('Croatia', 'hr'),
('Czech Republic', 'cz'),
('Denmark', 'dk'),
('Egypt', 'eg'),
('England', 'en'),
('Finland', 'fi'),
('France', 'fr'),
('Germany', 'de'),
('Greece', 'gr'),
('Hong Kong', 'hk'),
('Hungary', 'hu'),
('Iceland', 'is'),
('India', 'in'),
('Ireland', 'ie'),
('Italy', 'it'),
('Japan', 'jp'),
('Morocco', 'ma'),
('N. Ireland', 'nir'),
('Netherlands', 'nl'),
('New Zealand', 'nz'),
('Nigeria', 'ng'),
('Norway', 'no'),
('Poland', 'pl'),
('Portugal', 'pt'),
('Romania', 'ro'),
('Russia', 'ru'),
('Scotland', 'sco'),
('Slovakia', 'sk'),
('Slovenia', 'sl'),
('South Africa', 'za'),
('Spain', 'es'),
('Sweden', 'se'),
('Switzerland', 'ch'),
('Thailand', 'th'),
('Tunisia', 'tn'),
('Turkey', 'tr'),
('U.S.A', 'us'),
('Ukraine', 'ua'),
('United Kingdom', 'gb'),
('Wales', 'wal'),
('Europe', 'eu'),
('Afghanistan', 'af'),
('Albania', 'al'),
('Algeria', 'dz'),
('American Samoa', 'as'),
('Andorra', 'ad'),
('Angola', 'ao'),
('Anguilla', 'ai'),
('Antigua & Barbuda', 'ag'),
('Armenia', 'am'),
('Aruba', 'aw'),
('Azerbaijan', 'az'),
('Bahamas', 'bs'),
('Bahrain', 'bh'),
('Bangladesh', 'bd'),
('Barbados', 'bb'),
('Belize', 'bz'),
('Benin', 'bj'),
('Bermuda', 'bm'),
('Bhutan', 'bt'),
('Bolivia', 'bo'),
('Bosnia', 'ba'),
('Botswana', 'bw'),
('Brunei', 'bn'),
('Burkina Faso', 'bf'),
('Burundi', 'bi'),
('Cambodia', 'kh'),
('Cameroon', 'cm'),
('Cape Verde', 'cv'),
('Cayman Islands', 'ky'),
('Central African Rep.', 'cf'),
('Chad', 'td'),
('Chile', 'cl'),
('Colombia', 'co'),
('Comoros', 'km'),
('Congo', 'cg'),
('Cook Islands', 'ck'),
('Costa Rica', 'cr'),
('Cuba', 'cu'),
('Cyprus', 'cy'),
('Djibouti', 'dj'),
('Dominica', 'dm'),
('Dominican Republic', 'do'),
('Ecuador', 'ec'),
('El Salvador', 'sv'),
('Equatorial Guinea', 'gq'),
('Eritrea', 'er'),
('Estonia', 'ee'),
('Ethiopia', 'et'),
('Faroe Islands', 'fo'),
('Fiji', 'fj'),
('French Guyana', 'gf'),
('Gabon', 'ga'),
('Gambia', 'gm'),
('Georgia', 'ge'),
('Ghana', 'gh'),
('Grenada', 'gd'),
('Guadeloupe', 'gp'),
('Guam', 'gu'),
('Guatemala', 'gt'),
('Guinea', 'gn'),
('Guinea-Bissau', 'gw'),
('Guyana', 'gy'),
('Haiti', 'ht'),
('Honduras', 'hn'),
('Indonesia', 'id'),
('Iran', 'ir'),
('Iraq', 'iq'),
('Israel', 'il'),
('Jamaica', 'jm'),
('Jordan', 'jo'),
('Kazakhstan', 'kz'),
('Kenya', 'ke'),
('Kuwait', 'kw'),
('Kyrgyzstan', 'kg'),
('Laos', 'la'),
('Latvia', 'lv'),
('Lebanon', 'lb'),
('Lesotho', 'ls'),
('Liberia', 'lr'),
('Libya', 'ly'),
('Liechtenstein', 'li'),
('Lithuania', 'lt'),
('Luxembourg', 'lu'),
('Macau', 'mo'),
('FYR of Macedonia', 'mk'),
('Madagascar', 'mg'),
('Malawi', 'mw'),
('Malaysia', 'my'),
('Maldives', 'mv'),
('Mali', 'ml'),
('Malta', 'mt'),
('Martinique', 'mq'),
('Mauritania', 'mr'),
('Mauritius', 'mu'),
('Mayotte', 'yt'),
('Mexico', 'mx'),
('Moldova', 'md'),
('Monaco', 'mc'),
('Mongolia', 'mn'),
('Montenegro', 'me'),
('Montserrat', 'ms'),
('Mozambique', 'mz'),
('Myanmar', 'mm'),
('Namibia', 'na'),
('Nepal', 'np'),
('Netherlands Antilles', 'an'),
('New Caledonia', 'nc'),
('Nicaragua', 'ni'),
('Niger', 'ne'),
('Northern Mariana', 'mp'),
('Oman', 'om'),
('Pakistan', 'pk'),
('Palestine', 'ps'),
('Panama', 'pa'),
('Papua New Guinea', 'pg'),
('Paraguay', 'py'),
('Peru', 'pe'),
('Philippines', 'ph'),
('Puerto Rico', 'pr'),
('Qatar', 'qa'),
('Reunion', 're'),
('Rwanda', 'rw'),
('Saint Helena', 'sh'),
('Saint Lucia', 'lc'),
('Samoa', 'ws'),
('San Marino', 'sm'),
('Sao Tome and Principe', 'st'),
('Saudi Arabia', 'sa'),
('Senegal', 'sn'),
('Serbia', 'rs'),
('Seychelles', 'sc'),
('Sierra Leone', 'sl'),
('Singapore', 'sg'),
('Solomon Islands', 'sb'),
('Somalia', 'so'),
('Sri Lanka', 'lk'),
('Sudan', 'sd'),
('Surinam', 'sr'),
('Swaziland', 'sz'),
('Syria', 'sy'),
('Tajikistan', 'tj'),
('Tanzania', 'tz'),
('Tonga', 'tg'),
('Trinidad & Tobago', 'tt'),
('Turkmenistan', 'tm'),
('Turks & Caicos Is.', 'tc'),
('U.A.E', 'ae'),
('Uganda', 'ug'),
('Uruguay', 'uy'),
('Uzbekistan', 'uz'),
('Vanuata', 'vu'),
('Venezuela', 've'),
('Vietnam', 'vn'),
('Wallis & Futuna', 'wf'),
('Yemen', 'ye'),
('Zambia', 'zm'),
('Zimbabwe', 'zw');");

mysql_query("CREATE TABLE `{$db_prefix}permissions` (
  `row` int(11) NOT NULL auto_increment,
  `group_id` int(11) NOT NULL default '0',
  `forum_id` int(11) NOT NULL default '0',
  `can_view_forum` tinyint(1) NOT NULL default '0',
  `can_read_topics` tinyint(1) NOT NULL default '0',
  `can_add_topics` tinyint(1) NOT NULL default '0',
  `can_reply_topics` tinyint(1) NOT NULL default '0',
  `can_add_attachment` tinyint(1) NOT NULL default '0',
  `can_download_attachment` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`row`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("CREATE TABLE `{$db_prefix}polls` (
  `id` int(11) NOT NULL auto_increment,
  `topic_id` int(11) NOT NULL default '0',
  `question` varchar(255) NOT NULL default '',
  `option1` varchar(255) NOT NULL default '',
  `option2` varchar(255) NOT NULL default '',
  `option3` varchar(255) NOT NULL default '',
  `option4` varchar(255) NOT NULL default '',
  `option5` varchar(255) NOT NULL default '',
  `option6` varchar(255) NOT NULL default '',
  `option7` varchar(255) NOT NULL default '',
  `option8` varchar(255) NOT NULL default '',
  `option9` varchar(255) NOT NULL default '',
  `option10` varchar(255) NOT NULL default '',
  `poll_type` tinyint(1) NOT NULL default '0',
  `end_date` int(11) NOT NULL default '0', 
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("CREATE TABLE `{$db_prefix}polls_votes` (
  `vote_id` int(11) NOT NULL auto_increment,
  `poll_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `vote` int(11) NOT NULL default '0',
  PRIMARY KEY  (`vote_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("CREATE TABLE `{$db_prefix}posts` (
  `id` int(11) NOT NULL auto_increment,
  `member` int(11) NOT NULL default '0',
  `address` varchar(255) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `content` text NOT NULL,
  `time` int(11) NOT NULL default '0',
  `views` int(11) NOT NULL default '0',
  `topic_id` int(11) NOT NULL default '0',
  `forum_id` int(11) NOT NULL default '0',
  `sticky` tinyint(1) NOT NULL default '0',
  `announce` tinyint(1) NOT NULL default '0',
  `locked` tinyint(1) NOT NULL default '0',
  `edit_member` int(11) NOT NULL default '0',
  `edit_time` int(11) NOT NULL default '0',
  `edit_reason` varchar(255) NOT NULL default '',
  `last_post_time` int(11) NOT NULL default '0',
  `reported` tinyint(1) NOT NULL default '0',
  `approved` tinyint(1) NOT NULL default '1',
  `original_topic_id` INT( 10 ) UNSIGNED NOT NULL,
  `original_forum_id` INT( 10 ) UNSIGNED NOT NULL,
  `trashcan_time` INT( 10 ) UNSIGNED NOT NULL,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `title` (`title`,`description`,`content`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("CREATE TABLE `{$db_prefix}posts_edit` (
  `row` int(11) NOT NULL auto_increment,
  `topic` int(11) NOT NULL default '0',
  `post` int(11) NOT NULL default '0',
  `member` int(11) NOT NULL default '0',
  `content` text NOT NULL,
  `edit_reason` varchar(255) NOT NULL default '',
  `date` int(11) NOT NULL default '0',
  PRIMARY KEY  (`row`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("CREATE TABLE `{$db_prefix}posts_read` (
  `row` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL default '0',
  `topic_id` int(11) NOT NULL default '0',
  `read_time` int(11) NOT NULL default '0',
  PRIMARY KEY  (`row`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("CREATE TABLE `{$db_prefix}ranks` (
  `id` int(11) NOT NULL auto_increment,
  `rank_title` varchar(255) NOT NULL default '',
  `rank_posts` int(11) NOT NULL default '0',
  `rank_pips` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("INSERT INTO `{$db_prefix}ranks` (`id`, `rank_title`, `rank_posts`, `rank_pips`) VALUES
(2, 'Newbie', 0, 1),
(3, 'General Poster', 100, 2),
(4, 'To Much Time', 250, 3),
(5, 'Addicted', 500, 4),
(6, 'Supernova', 1000, 5);");

mysql_query("CREATE TABLE `{$db_prefix}report` (
  `id` int(11) NOT NULL auto_increment,
  `post` int(11) NOT NULL default '0',
  `content` text NOT NULL,
  `reported_by` int(11) NOT NULL default '0',
  `action_taken` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("CREATE TABLE `{$db_prefix}seo` (
  `seo_id` int(11) NOT NULL auto_increment,
  `seo_off` varchar(255) NOT NULL default '0',
  `seo_on` varchar(255) NOT NULL default '0', 
  PRIMARY KEY  (`seo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("INSERT INTO `{$db_prefix}seo` (`seo_id`, `seo_off`, `seo_on`) VALUES
(1, 'index.php?page=offline', 'offline'),
(2, 'index.php?page=verify&id=$1', 'verify/(.*)'),
(3, 'index.php?page=subscribe&forum=$1', 'subscribe/forum/(.*)'),
(4, 'index.php?page=unsubscribe&forum=$1', 'unsubscribe/forum/(.*)'),
(5, 'index.php?page=subscribe&topic=$1', 'subscribe/topic/(.*)'),
(6, 'index.php?page=unsubscribe&topic=$1', 'unsubscribe/topic/(.*)'),
(7, 'index.php?page=upgrade', 'upgrade'),
(8, 'index.php?func=addreply&topic=$1&quote=$2', 'addreply/(.*)/(.*)'),
(9, 'index.php?func=addreply&topic=$1', 'addreply/(.*)'),
(10, 'index.php?func=addreply', 'addreply'),
(11, 'index.php?page=list&group=$1&limit=$2', 'list/group/(.*)/(.*)'),
(12, 'index.php?page=list&group=$1', 'list/group/(.*)'),
(13, 'index.php?page=list&limit=$1', 'online-now/(.*)'),
(14, 'index.php?page=list', 'online-now'),
(15, 'index.php?func=markread', 'markread'),
(16, 'index.php?page=blocked', 'blocked'),
(17, 'index.php?page=suspended', 'suspended'),
(18, 'index.php?page=history&post=$1&entry=$2', 'history/(.*)/(.*)'),
(19, 'index.php?func=del&post=$1', 'del/(.*)'),
(20, 'index.php?func=edit&post=$1', 'edit/(.*)'),
(21, 'index.php?func=edit', 'edit'),
(22, 'index.php?func=move&topic=$1', 'move/(.*)'),
(23, 'index.php?func=move', 'move'),
(24, 'index.php?func=merge&topic=$1&forum=$2', 'merge/(.*)/(.*)'),
(25, 'index.php?func=merge&topic=$1', 'merge/(.*)'),
(26, 'index.php?func=merge', 'merge'),
(27, 'index.php?func=split&post=$1', 'split/(.*)'),
(28, 'index.php?func=split', 'split'),
(29, 'index.php?page=admin&act=smilies&location=$1', 'admin/smilies/(.*)'),
(30, 'index.php?page=admin&act=smilies', 'admin/smilies'),
(31, 'index.php?func=lock&index=q&topic=$1', 'lock/q/(.*)'),
(32, 'index.php?func=unlock&index=q&topic=$1', 'unlock/q/(.*)'),
(33, 'index.php?func=lock&topic=$1', 'lock/(.*)'),
(34, 'index.php?func=unlock&topic=$1', 'unlock/(.*)'),
(35, 'index.php?func=markread', 'markread/(.*)'),
(36, 'index.php?page=findpost&post=$1', 'findpost/(.*)'),
(37, 'index.php?title=$1&forum=$2&limit=$3', 'forum/(.*)-(.*)/(.*)'),
(38, 'index.php?title=$1&forum=$2', 'forum/(.*)-(.*)'),
(39, 'download.php?attach=$1&filename=$2', 'download/(.*)/(.*)'),
(40, 'index.php?page=login', 'login'),
(41, 'index.php?page=logout', 'logout'),
(42, 'index.php?page=password', 'password'),
(43, 'index.php?page=members&title=$1&id=$2', 'members/(.*)-(.*)'),
(44, 'index.php?page=warn&act=$1&id=$2', 'warn/(.*)/(.*)'),
(46, 'index.php?page=messages&act=inbox', 'messages'),
(47, 'index.php?page=messages&act=new&id=$1', 'messages/new/(.*)'),
(48, 'index.php?page=messages&act=new', 'messages/new'),
(49, 'index.php?page=messages&act=reply', 'messages/reply'),
(50, 'index.php?page=messages&act=del&id=$1', 'messages/del/(.*)'),
(51, 'index.php?page=messages&id=$1', 'messages/(.*)'),
(52, 'index.php?page=myoptions&act=customstyle', 'myoptions/customstyle'),
(53, 'index.php?page=myoptions&act=style', 'myoptions/style'),
(54, 'index.php?page=myoptions&act=timezone', 'myoptions/timezone'),
(55, 'index.php?page=myoptions&act=email', 'myoptions/email'),
(56, 'index.php?page=myoptions&act=password', 'myoptions/password'),
(57, 'index.php?page=myoptions&act=username', 'myoptions/username'),
(58, 'index.php?page=myoptions&act=usertitle', 'myoptions/usertitle'),
(59, 'index.php?page=myoptions&act=information', 'myoptions/information'),
(60, 'index.php?page=myoptions&act=signature', 'myoptions/signature'),
(61, 'index.php?page=myoptions&act=avatar', 'myoptions/avatar'),
(62, 'index.php?page=myoptions&act=$1', 'myoptions/(.*)'),
(63, 'index.php?page=myoptions', 'myoptions'),
(64, 'index.php?page=admin&act=subscriptions&func=edit&id=$1', 'admin/subscriptions/edit/(.*)'),
(65, 'index.php?page=admin&act=subscriptions&func=delete&id=$1', 'admin/subscriptions/delete/(.*)'),
(66, 'index.php?page=admin&act=subscriptions&func=edit', 'admin/subscriptions/edit'),
(67, 'index.php?page=admin&act=subscriptions&func=new', 'admin/subscriptions/new'),
(68, 'index.php?page=admin&act=subscriptions', 'admin/subscriptions'),
(69, 'index.php?page=admin&act=report&id=$1', 'admin/report/(.*)'),
(71, 'index.php?page=admin&act=report', 'admin/report'),
(72, 'index.php?page=admin&act=permissions&id=$1', 'admin/permissions/(.*)'),
(73, 'index.php?page=admin&act=permissions', 'admin/permissions'),
(74, 'index.php?page=admin&act=categories&func=new&id=$1', 'admin/categories/new/(.*)'),
(75, 'index.php?page=admin&act=categories&func=new', 'admin/categories/new'),
(76, 'index.php?page=admin&act=categories&func=edit&id=$1', 'admin/categories/edit/(.*)'),
(77, 'index.php?page=admin&act=categories&func=delete&id=$1', 'admin/categories/delete/(.*)'),
(78, 'index.php?page=admin&act=rss', 'admin/rss'),
(79, 'index.php?page=admin&act=members&func=edit&id=$1', 'admin/members/edit/(.*)'),
(80, 'index.php?page=admin&act=members&func=delete&id=$1', 'admin/members/delete/(.*)'),
(81, 'index.php?page=admin&act=members&func=ban&id=$1', 'admin/members/ban/(.*)'),
(82, 'index.php?page=admin&act=members', 'admin/members'),
(83, 'index.php?page=admin&act=groups&func=edit&id=$1', 'admin/groups/edit/(.*)'),
(84, 'index.php?page=admin&act=groups&func=edit&id=$1', 'admin/groups/delete/(.*)'),
(85, 'index.php?page=admin&act=groups&func=new', 'admin/groups/new'),
(86, 'index.php?page=admin&act=groups', 'admin/groups'),
(87, 'index.php?page=admin&act=categories', 'admin/categories'),
(88, 'index.php?page=admin&act=attachments', 'admin/attachments'),
(89, 'index.php?page=admin&act=topics', 'admin/topics'),
(90, 'index.php?page=admin&act=settings', 'admin/settings'),
(91, 'index.php?page=admin&act=email', 'admin/email'),
(92, 'index.php?page=admin&act=preview&action=approve&id=$1&post=$2', 'admin/preview/approve/(.*)/(.*)'),
(93, 'index.php?page=admin&act=preview&action=approve&id=$1', 'admin/preview/approve/(.*)'),
(94, 'index.php?page=admin&act=preview&action=reject&id=$1', 'admin/preview/reject/(.*)'),
(95, 'index.php?page=admin&act=preview', 'admin/preview'),
(96, 'index.php?page=admin&act=custom&func=reorder', 'admin/custom/reorder'),
(97, 'index.php?page=admin&act=custom&func=new', 'admin/custom/new'),
(98, 'index.php?page=admin&act=custom&func=edit&id=$1', 'admin/custom/edit/(.*)'),
(99, 'index.php?page=admin&act=custom&func=delete&id=$1', 'admin/custom/delete/(.*)'),
(100, 'index.php?page=admin&act=custom&func=edit', 'admin/custom/edit'),
(101, 'index.php?page=admin&act=custom', 'admin/custom'),
(102, 'index.php?page=admin&act=moderators&func=forum&forum=$1&id=$2', 'admin/moderators/forum/(.*)/(.*)'),
(103, 'index.php?page=admin&act=moderators&func=forum&forum=$1', 'admin/moderators/forum/(.*)'),
(104, 'index.php?page=admin&act=moderators&func=delete&forum=$1&id=$2', 'admin/moderators/delete/(.*)/(.*)'),
(105, 'index.php?page=admin&act=moderators&func=edit&forum=$1&id=$2', 'admin/moderators/edit/(.*)/(.*)'),
(106, 'index.php?page=admin&act=moderators', 'admin/moderators'),
(107, 'index.php?page=admin&act=cache&func=readall', 'admin/cache/readall'),
(108, 'index.php?page=admin&act=cache&func=forums', 'admin/cache/forums'),
(109, 'index.php?page=admin&act=cache&func=messages', 'admin/cache/messages'),
(110, 'index.php?page=admin&act=cache&func=online', 'admin/cache/online'),
(111, 'index.php?page=admin&act=cache&func=verify', 'admin/cache/verify'),
(112, 'index.php?page=admin&act=cache&func=posts', 'admin/cache/posts'),
(113, 'index.php?page=admin&act=cache', 'admin/cache'),
(114, 'index.php?page=admin&act=modules&func=install&module=$1', 'admin/modules/install/(.*)'),
(115, 'index.php?page=admin&act=modules&func=remove&module=$1', 'admin/modules/remove/(.*)'),
(116, 'index.php?page=admin&act=modules&func=delete&module=$1', 'admin/modules/delete/(.*)'),
(144, 'index.php?page=admin&act=themes&func=install&theme=$1', 'admin/themes/install/(.*)'),
(145, 'index.php?page=admin&act=themes&func=remove&theme=$1', 'admin/themes/remove/(.*)'),
(146, 'index.php?page=admin&act=themes&func=delete&theme=$1', 'admin/themes/delete/(.*)'),
(147, 'index.php?page=admin&act=themes', 'admin/themes'),
(148, 'index.php?page=help&h=$1', 'help/(.*)'),
(149, 'index.php?page=admin&act=ranks&id=$1', 'admin/ranks/(.*)'),
(150, 'index.php?page=admin&act=ranks', 'admin/ranks'),
(151, 'index.php?page=verify', 'verify'),
(152, 'index.php?page=myoptions&act=subscriptions', 'myoptions/subscriptions'),
(153, 'index.php?page=list&list=members', 'list/members'),
(154, 'index.php?page=admin&act=spam', 'admin/spam'),
(155, 'index.php?page=search&area=newposts&list=$1', 'newposts/(.*)'),
(156, 'index.php?page=search&area=newposts', 'newposts'),
(157, 'index.php?page=list&list=members&limit=$1',  'list/members/(.*)'),
(158, 'index.php?page=admin&act=modules', 'admin/modules'),
(159, 'index.php?page=admin&act=filter&id=$1', 'admin/filter/(.*)'),
(160, 'index.php?page=admin&act=filter', 'admin/filter'),
(161, 'index.php?page=admin', 'admin'),
(162, 'index.php?func=newpost&forum=$1', 'newpost/(.*)'),
(163, 'index.php?func=newpost', 'newpost'),
(164, 'index.php?page=register&agree=yes', 'register/agree'),
(165, 'index.php?page=register&error=$1', 'register/(.*)'),
(166, 'index.php?page=register', 'register'),
(167, 'index.php?page=search&area=topics&search=$1&limit=$2', 'search/topics/(.*)/(.*)'),
(168, 'index.php?page=search&area=topics&search=$1', 'search/topics/(.*)'),
(169, 'index.php?page=search&area=posts&search=$1&limit=$2', 'search/posts/(.*)/(.*)'),
(170, 'index.php?page=search&area=posts&search=$1', 'search/posts/(.*)'),
(171, 'index.php?page=search&search=$1&page=$2', 'search/(.*)/(.*)'),
(172, 'index.php?page=search&search=$1', 'search/(.*)'),
(173, 'index.php?page=search', 'search'),
(174, 'index.php?page=error&error=$1', 'error/(.*)'),
(175, 'index.php?page=error', 'error'),
(176, 'index.php?page=banned', 'banned'),
(177, 'index.php?page=report&post=$1', 'report/(.*)'),
(178, 'index.php?page=report', 'report'),
(179, 'index.php?page=help', 'help'),
(180, 'index.php?title=$1&topic=$2&limit=$3&showresults=$4', 'topic/(.*)-(.*)/(.*)/(.*)'),
(181, 'index.php?title=$1&topic=$2&limit=$3', 'topic/(.*)-(.*)/(.*)'),
(182, 'index.php?title=$1&topic=$2', 'topic/(.*)-(.*)'),
(183, 'index.php?action=vote&topic=$1', 'vote/(.*)'),
(184, 'index.php?page=myoptions&act=friendlist', 'myoptions/friendlist'),
(185, 'index.php?page=myoptions&act=settings', 'myoptions/settings'),
(186, 'index.php?page=admin&act=suspended_members', 'admin/suspended_members'),
(187, 'index.php?page=messages&act=inbox&success=$1', 'messages/success/(.*)'),
(188, 'index.php?page=myoptions&act=subscriptions&success=$1', 'myoptions/subscriptions/success/(.*)'),
(189, 'index.php?page=myoptions&act=timezone&success=$1', 'myoptions/timezone/success/(.*)'),
(190, 'index.php?page=myoptions&act=settings&success=$1', 'myoptions/settings/success/(.*)'),
(191, 'index.php?page=myoptions&act=style&success=$1', 'myoptions/style/success/(.*)'),
(192, 'index.php?page=myoptions&act=friendlist&success=$1', 'myoptions/friendlist/success/(.*)'),
(193, 'index.php?page=myoptions&success=$1', 'myoptions/success/(.*)'),
(194, 'index.php?page=myoptions&act=information&success=$1', 'myoptions/information/success/(.*)'),
(195, 'index.php?page=myoptions&act=avatar&success=$1', 'myoptions/avatar/success/(.*)'),
(196, 'index.php?page=myoptions&act=signature&success=$1', 'myoptions/signature/success/(.*)'),
(197, 'index.php?page=myoptions&act=usertitle&success=$1', 'myoptions/usertitle/success/(.*)'),
(198, 'index.php?page=myoptions&act=username&success=$1', 'myoptions/username/success/(.*)'),
(199, 'index.php?page=myoptions&act=email&success=$1', 'myoptions/email/success/(.*)'),
(200, 'index.php?page=myoptions&act=password&success=$1', 'myoptions/password/success/(.*)'),
(201, 'index.php?page=admin&act=moderators&success=$1', 'admin/moderators/success/(.*)'),
(202, 'index.php?page=admin&act=topics&success=$1', 'admin/topics/success/(.*)'),
(203, 'index.php?page=admin&act=subscriptions&success=$1', 'admin/subscriptions/success/(.*)'),
(204, 'index.php?page=admin&act=ranks&success=$1', 'admin/ranks/success/(.*)'),
(205, 'index.php?page=admin&act=groups&success=$1', 'admin/groups/success/(.*)'),
(206, 'index.php?page=admin&act=members&success=$1', 'admin/members/success/(.*)'),
(207, 'index.php?page=admin&act=rss&success=$1', 'admin/rss/success/(.*)'),
(208, 'index.php?page=admin&act=smilies&success=$1', 'admin/smilies/success/(.*)'),
(209, 'index.php?page=admin&act=preview&success=$1', 'admin/preview/success/(.*)'),
(210, 'index.php?page=admin&act=report&success=$1', 'admin/report/success/(.*)'),
(211, 'index.php?page=admin&act=custom&success=$1', 'admin/custom/success/(.*)'),
(212, 'index.php?page=admin&act=categories&success=$1', 'admin/categories/success/(.*)'),
(213, 'index.php?page=admin&act=attachments&success=$1', 'admin/attachments/success/(.*)'),
(214, 'index.php?page=admin&act=spam&success=$1', 'admin/spam/success/(.*)'),
(215, 'index.php?page=admin&act=settings&success=$1', 'admin/settings/success/(.*)'),
(216, 'index.php?page=admin&act=members&func=edit&id=$1&success=$2', 'admin/members/edit/(.*)/success/(.*)'),
(217, 'index.php?page=admin&act=permissions&id=$1&success=$2', 'admin/permissions/(.*)/success/(.*)'),
(218, 'index.php?page=admin&success=$1', 'admin/success/(.*)');");

mysql_query("CREATE TABLE `{$db_prefix}sessions` (
  `id` varchar(255) NOT NULL default '0',
  `time` int(11) NOT NULL default '0',
  `address` varchar(255) NOT NULL default '',
  `location_forum` varchar(255) NOT NULL default '',
  `location_topic` varchar(255) NOT NULL default '',
  `location_page` varchar(255) NOT NULL default '',
  `guest_clicks` int(11) NOT NULL default '0',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("CREATE TABLE `{$db_prefix}settings` (
  `site_name` varchar(255) NOT NULL default '',
  `site_desc` varchar(255) NOT NULL default '',
  `theme` varchar(255) NOT NULL default '',
  `time_offset` varchar(255) NOT NULL default '',
  `most_online` int(11) NOT NULL default '0',
  `list_topics` int(11) NOT NULL default '30',
  `list_posts` int(11) NOT NULL default '30',
  `hot_topic` int(11) NOT NULL default '100',
  `most_online_date` int(11) NOT NULL default '0',
  `allow_attachments` tinyint(1) NOT NULL default '1',
  `attach_avatar_size` int(11) NOT NULL default '125',
  `attach_img_size` int(11) NOT NULL default '150',
  `show_rss` tinyint(1) NOT NULL default '0',
  `show_rss_limit` int(11) NOT NULL default '50',
  `module_order` varchar(255) NOT NULL default 'downloads',
  `module_limit` varchar(255) NOT NULL default '5',
  `module_method` varchar(255) NOT NULL default 'desc',  
  `theme_order` varchar(255) NOT NULL default 'downloads',
  `theme_limit` varchar(255) NOT NULL default '5',
  `theme_method` varchar(255) NOT NULL default 'desc',  
  `show_gamer_tags` tinyint(1) NOT NULL default '0',
  `max_guest_clicks` int(11) NOT NULL default '-1',
  `max_warn` int(11) NOT NULL default '5',
  `sef_urls` tinyint(1) NOT NULL default '0',
  `whiteboard` text NOT NULL,
  `guest_register` tinyint(1) NOT NULL default '1',
  `register_bar` tinyint(1) NOT NULL default '0',  
  `board_offline` tinyint(1) NOT NULL default '0',
  `board_offline_reason` text NOT NULL,
  `online_yesterday` int(11) NOT NULL default '0',
  `rules` varchar(255) NOT NULL default '',
  `change_pass_time` int(10) NOT NULL default '90',
  `home` varchar(255) NOT NULL default '',
  `store_post_history` tinyint(1) NOT NULL default '1', 
  `quick_edit` tinyint(1) NOT NULL default '0',
  `board_lang` varchar(255) NOT NULL default '',
  `board_email` varchar(255) NOT NULL default '',
  `lb_version` varchar(255) NOT NULL default '',
  `stats_topics` int(11) NOT NULL default '0',
  `stats_posts` int(11) NOT NULL default '0',
  `stats_members` int(11) NOT NULL default '0',
  `stats_member_id` int(11) NOT NULL default '0',
  `stats_member_name` varchar(255) NOT NULL default '',
  `stats_post_id` int(11) NOT NULL default '0', 
  `stats_post_title` varchar(255) NOT NULL default '',
  `stats_post_forum` int(11) NOT NULL default '0', 
  `stats_post_time` int(11) NOT NULL default '0',
  `stats_post_topic` int(11) NOT NULL default '0',
  `akismet_key` varchar(255) NOT NULL default '',  
  `recaptcha_public` varchar(255) NOT NULL default '',  
  `recaptcha_private` varchar(255) NOT NULL default '',
  `auto_merge` tinyint(1) NOT NULL default '1',
  `username_length` tinyint(3) unsigned NOT NULL default '20',
  `usertitle_length` tinyint(3) unsigned NOT NULL default '20',
  `trashcan_enabled` TINYINT( 1 ) UNSIGNED NOT NULL,
  `trashcan_forum` INT( 10 ) UNSIGNED NOT NULL,
  `trashcan_delete_time` VARCHAR( 4 ) NOT NULL,
  `trashcan_delete_ran` INT( 10 ) UNSIGNED NOT NULL,
  `update_check` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY  (`site_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

$site_name = (!empty($_POST['site_name'])) ? escape_string($_POST['site_name']) : 'LayerBulletin 1.1.6';
$site_desc = (!empty($_POST['site_desc'])) ? escape_string($_POST['site_desc']) : 'Your forum description here';

mysql_query("INSERT INTO `{$db_prefix}settings` (`site_name`, `site_desc`, `theme`, `time_offset`, `most_online`, `list_topics`, `list_posts`, `hot_topic`, `most_online_date`, `allow_attachments`, `attach_avatar_size`, `attach_img_size`, `show_rss`, `show_rss_limit`, `module_order`, `module_limit`, `module_method`, `theme_order`, `theme_limit`, `theme_method`, `show_gamer_tags`, `max_guest_clicks`, `max_warn`, `sef_urls`, `whiteboard`, `guest_register`, `register_bar`, `board_offline`, `online_yesterday`, `rules`, `change_pass_time`, `home`, `store_post_history`, `board_lang`, `lb_version`, `board_offline_reason`, `quick_edit`, `stats_topics`, `stats_posts`, `stats_member_id`, `stats_member_name`, `stats_post_id`, `stats_post_title`, `stats_post_forum`, `stats_post_time`, `stats_post_topic`, `stats_members`, `board_email`, `akismet_key`, `recaptcha_public`, `recaptcha_private`, `auto_merge`) VALUES 
('{$site_name}', '{$site_desc}', 'layerbulletin_default', 0, 0, 30, 30, 50, 0, 0, 125, 150, 0, 50, 'downloads', 5, 'desc', 'downloads', 5, 'desc', 0, -1, 5, 0, '', 0, 0, 0, 0, '', 90, '$lb_domain', '1', 'english_en', '". LB_VERSION ."', 'This forum is temporarily offline', '0','0','0','1','$username','0','','0','0','0', '1','','','','','1');");

mysql_query("CREATE TABLE `{$db_prefix}smilies` (
  `row` int(11) NOT NULL auto_increment,
  `code` varchar(255) NOT NULL default '',
  `link` varchar(255) NOT NULL default '',
  `emoticon_on` tinyint(1) NOT NULL default '0',
  `theme` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`row`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("INSERT INTO `{$db_prefix}smilies` (`row`, `code`, `link`, `emoticon_on`, `theme`) VALUES 
(1, ':angel:', 'angel.png', 1, 'default'),
(2, ':wtf:', 'annoyed.png', 1, 'default'),
(3, ':blush:', 'blush.png', 1, 'default'),
(4, ':emoticon4:', 'brb.png', 0, 'default'),
(5, ':confused:', 'confused.png', 1, 'default'),
(6, ':cool:', 'cool.png', 1, 'default'),
(7, ':cry:', 'cry.png', 1, 'default'),
(8, ':devil:', 'devil.png', 1, 'default'),
(9, ':emoticon9:', 'fume.png', 0, 'default'),
(10, ':geek:', 'geek.png', 1, 'default'),
(11, ':D', 'grin.png', 1, 'default'),
(12, ':)', 'happy.png', 1, 'default'),
(13, ':heart:', 'heart.png', 1, 'default'),
(14, ':emoticon14:', 'love.png', 0, 'default'),
(15, ':mad:', 'mad.png', 1, 'default'),
(16, ':ninja:', 'ninja.png', 1, 'default'),
(17, ':emoticon17:', 'odd.png', 0, 'default'),
(18, ':emoticon18:', 'phone.png', 0, 'default'),
(19, ':(', 'sad.png', 1, 'default'),
(20, ':o', 'shocked.png', 1, 'default'),
(21, ':sick:', 'sick.png', 1, 'default'),
(22, ':thdn:', 'thumbsdown.png', 1, 'default'),
(23, ':thup:', 'thumbsup.png', 1, 'default'),
(24, ':p', 'tounge.png', 1, 'default'),
(25, ':emoticon25:', 'unsure.png', 0, 'default'),
(26, ':whistle:', 'whistle.png', 1, 'default'),
(27, ';)', 'wink.png', 1, 'default')");

mysql_query("CREATE TABLE `{$db_prefix}subscribe` (
  `row` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL default '0',
  `subscribed_topic` varchar(255) NOT NULL default '0',
  `subscribed_forum` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`row`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("CREATE TABLE `{$db_prefix}themes` (
  `id` int(11) NOT NULL auto_increment,
  `theme_name` varchar(255) NOT NULL default '',
  `display_name` varchar(255) NOT NULL default '',
  `lb_version` varchar(255) NOT NULL default '', 
  `installed` tinyint(1) NOT NULL default '0', 
  `config_page` varchar(255) NOT NULL default '',   
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

mysql_query("INSERT INTO `{$db_prefix}themes` (`id`, `theme_name`, `display_name`, `lb_version`, `installed`, `config_page`) VALUES 
('1', 'layerbulletin_default', 'LayerBulletin Default', '', '1', '');");


mysql_query("CREATE TABLE `{$db_prefix}warn` (
  `id` int(11) NOT NULL auto_increment,
  `member` int(11) NOT NULL default '0',
  `notes` text NOT NULL,
  `date` int(11) NOT NULL default '0',
  `warned_by` int(11) NOT NULL default '0',
  `action` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci");

/* Log the user in. 7-day cookie */
setcookie( 'lb_name', $username, time() +604800 );
setcookie( 'lb_password', $password, time() +604800 );

	/*
	Create cache
*/

	require_once $lb_root . 'includes/objects/cache.php';
	$Cache = new cache($lb_root, $db_prefix);
	
	$Cache->load('groups');
	$Cache->load('settings');
	
mysql_close($_dbConn);

?>


		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>

				<td class="forum-topic-subject">Installation</td>
			</tr>
		</table>
			<table class="forum-jump" cellpadding="0" cellspacing="0">
				<tr>
					<td class="error-header" style="width:100%;" colspan="2">
						Installation Complete!
					</td>
				</tr>
				<tr>
					<td class="forum-jump-content" style="width: 55%; border-right: none; vertical-align: top;">
						<a href="index.php" style="color:#3C738E; font-size:16px; font-weight:bold; text-decoration:none;">Click here to view your forum!</a><br /><br />
						<span style="color: red;">Please remember to remove or rename install.php from your forum directory and we hope you enjoy using LayerBulletin.</span>
					</td>
					<td class="forum-jump-content" style="width: 45%; border-left: none;">
						Thank you for installing LayerBulletin. <a href="http://www.layerbulletin.com/register" target="_blank">Register on our community forum</a> to receive messages and announcements.<br /><br />
						<div style="text-align: center; width: 100%;">
							<a href="http://www.layerbulletin.com" target="_blank">LayerBulletin Community Forums</a>
						</div>
					</td>
				</tr>
			
		</table>

		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>	
<?php

$lockInstaller = fopen($lb_root . "/cache/installer.lock", 'w');
$lockUpdater = fopen($lb_root . "/cache/updater.lock", 'w');
fclose($lockInstaller);
fclose($lockUpdater);

}

elseif($_GET['step']=='2'){
?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>

				<td class="forum-topic-subject">Installation</td>
			</tr>
		</table>
			<table class="forum-jump" cellpadding="0" cellspacing="0">
				<tr>
					<td class="error-header" style="width:100%;">
						Step Two: Prepare Directories
					</td>
				</tr>
				<tr>
					<td class="forum-jump-content" style="width:100%;">
<?php
echo "Please CHMOD the following directories that have warnings against them. To do this, download an FTP client such as <a href='http://www.filezilla-project.org/'>Filezilla</a>, right click on the directories we have listed below, and set their permissions so that you can write to the directory (0777).<br /><br />Alternatively, you can let LayerBulletin <i>attempt</i> to do this automatically for you via our FTP option on the right.<br /><br /><hr /><br /><br />";

$warning_count="0";

echo "<div style=\"width: 100%;position:relative;\">";
echo "<div style=\"width: 50%; float: left;\">";

echo "<span style=\"width: 25%; float:left;\"><table cellpadding=\"0\" cellspacing=\"0\">";

$filename = "./";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px;\">Root folder</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">Root folder</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

echo "<tr><td colspan=\"2\"><br /><strong>Cache Directory:<strong><br /></td></tr>";

$filename = "cache";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

echo "<tr><td colspan=\"2\"><br /><strong>Images Directories:</strong><br /></td></tr>";

$filename = "images";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}
$filename = "images/buttons";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}
$filename = "images/flags";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}
$filename = "images/forums";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}
$filename = "images/groups";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}
$filename = "images/members";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}
$filename = "images/messages";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}
$filename = "images/pages";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}
$filename = "images/textarea";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

echo "<tr><td colspan=\"2\"><br /><strong>Core Code Directories:<strong><br /></td></tr>";

$filename = "includes";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

$filename = "includes/forums";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

$filename = 'includes/objects';
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

$filename = "includes/pages";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}


$filename = "includes/pages/admin";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

$filename = "includes/pages/myoptions";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

echo "<tr><td colspan=\"2\"><br /><strong>Language Directories:</strong><br /></td></tr>";

$filename = "lang";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

$filename = "lang/english_en";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}
echo "</table></span>";
echo "<span style=\"width: 50%;float: right;\"><table cellpadding=\"0\" cellspacing=\"0\">";
echo "<tr><td colspan=\"2\"><strong>Modules Directories:</strong><br /></td></tr>";

$filename = "modules";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

echo "<tr><td colspan=\"2\"><br /><strong>Script/Functions Directories:</strong><br /></td></tr>";

$filename = "scripts";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

$filename = "scripts/js";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

$filename = "scripts/php";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

echo "<tr><td colspan=\"2\"><br /><strong>Templates Directories:</strong><br /></td></tr>";

$filename = "templates/includes";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

$filename = "templates/includes/forums";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

$filename = "templates/includes/pages";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

$filename = "templates/includes/pages/admin";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

$filename = "templates/includes/pages/myoptions";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

echo "<tr><td colspan=\"2\"><br /><strong>Themes Directories:</strong><br /></td></tr>";

$filename = "themes";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

$filename = "themes/layerbulletin_default";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

echo "<tr><td colspan=\"2\"><br /><strong>Attachments & Avatar Directories:</strong><br /></td></tr>";


$filename = "uploads/attachments";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

$filename = "uploads/avatar";
if (is_writable($filename)) {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; border-bottom: 2px solid #E4EAF2;\">$filename</td><td><img src=\"images/pages/plus.png\" alt=\"\" /></td></tr>";
} else {
    echo "<tr><td style=\"width: 60%; padding-left: 20px; background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\">$filename</td><td style=\"background-color: #ECD5D8; border-bottom: 2px solid #E4EAF2;\"><img src=\"images/pages/minus.png\" alt=\"\" /></td></tr>";
$warning_count=$warning_count+1;
}

if ($warning_count > 0)
{
	echo '
		<td colspan="2" style="padding-top:40px;">
			<form method="post" action="install.php?step=2">
				<span style="font-style: italics; font-weight: bold">
					<input type="hidden" name="prev_step" value="1" />
					Before continuing, please CHMOD the directories, then
					<button type="submit" class="submit-button img-reorder">Refresh</button>
				</span>
			</form>
		</td>
	';
}
else
{
	echo '
		<td colspan="2" style="padding-top: 40px;">
			<form method="post" action="install.php?step=3">
				<span style="font-style: italics; font-weight: bold">
					Folder permissions are correct.
				</span>
				<br /><br />
				<input type="hidden" name="prev_step" value="2" />
				<input type="submit" class="submit-button img-submit" value="Submit" />
				</span>
			</form>
		</td>
	';
}

echo "</table></span><br /><br />";

echo "</div>";

echo "<div style=\"width: 40%; float: left;\">";

echo "<strong>Optional FTP CHMOD</strong><br />";
echo "If you wish, you may let LayerBulletin <i>attempt</i> to automatically configure your folders for you. To do this, enter your FTP details into the box below and the installation script will alter the directories required to work properly.";

echo "<br /><br />";

echo "<form method=\"post\" action=\"install.php?step=ftp\">";

echo "<div style='width: 30%; float: left;'>";
echo "FTP Username:";
echo "</div>";
echo "<div style='width: 70%; float: left;'>";
echo "<input type='text' name='ftp_username' value='' /><br /><br />";
echo "</div>";

echo "<div style='width: 30%; float: left;'>";
echo "FTP Password:";
echo "</div>";
echo "<div style='width: 70%; float: left;'>";
echo "<input type='password' name='ftp_password' value='' /><br /><br />";
echo "</div>";

echo "<div style='width: 30%; float: left;'>";
echo "&nbsp;";
echo "</div>";
echo "<div style='width: 70%; float: left;'>";
echo "<input type='submit' class='submit-button img-submit' value='Submit' />";
echo "</div>";
echo "</div>";

echo "</form>";

echo "</div>";

echo "</div>";

?>

					</td>
				</tr>
			
		</table>

		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php

}

elseif($_GET['step']=='3'){
?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>

				<td class="forum-topic-subject">Installation</td>
			</tr>
		</table>
			<table class="forum-jump" cellpadding="0" cellspacing="0">
				<tr>
					<td class="error-header" style="width:100%;">
						Step Three: Database Details
					</td>
				</tr>
				<tr>
					<td class="forum-jump-content" style="width:100%;">
<?php
echo "Please enter your database details below. If you are unsure of any of the details, please contact your website hosts who should be able to assist you. Values that shouldn't change have already been filled in for you.<br /><br />";

if ($_SESSION['error_conn'] || $_SESSION['error_db'])
{
	echo 'One or more errors occured:';
	echo '<ul>';
	
	if ($_SESSION['error_conn'] == true)
	{
		echo '<li>';
		echo '<span style="color: red">A connection to the server could not be established. Please ensure that the correct information has been entered for \'hostname\', \'login name\' and \'password\'.</span>';
		echo '</li>';
	}
	if ($_SESSION['error_db'] == true)
	{
		echo '<li>';
		echo '<span style="color: red">The specified database could not be found.</span>';
		echo '</li>';
	}
	
	echo '</ul>';
	echo '<br />';
}

echo "<form method='post' action='install.php?step=4'>";
echo "<div style='padding-left: 30px;'>";
echo "<div style='width: 10%; float: left;'>";
echo "Hostname:";
echo "</div>";
echo "<div style='width: 90%; float: left;'>";
echo "<input type='text' name='mysql_host' value='localhost' /><br /><br />";
echo "</div>";

echo "<div style='width: 10%; float: left;'>";
echo "Login Name:";
echo "</div>";
echo "<div style='width: 90%; float: left;'>";
echo "<input type='text' name='mysql_login' value='' /><br /><br />";
echo "</div>";

echo "<div style='width: 10%; float: left;'>";
echo "Password:";
echo "</div>";
echo "<div style='width: 90%; float: left;'>";
echo "<input type='password' name='mysql_pass' value='' /><br /><br />";
echo "</div>";

echo "<div style='width: 10%; float: left;'>";
echo "Database Name:";
echo "</div>";
echo "<div style='width: 90%; float: left;'>";
echo "<input type='text' name='mysql_database' value='' /><br /><br />";
echo "</div>";

echo "<div style='width: 10%; float: left;'>";
echo "Database Prefix:";
echo "</div>";
echo "<div style='width: 90%; float: left;'>";
echo "<input type='text' name='db_prefix' value='lb_' /><br /><br />";
echo "</div>";


$my_address="http://".$_SERVER['HTTP_HOST']."".$_SERVER['PHP_SELF'];
$my_address=str_replace("/install.php","",$my_address);

echo "<div style='width: 10%; float: left;'>";
echo "Site Address:";
echo "</div>";
echo "<div style='width: 90%; float: left;'>";
echo "<input type='text' name='site_address' value='$my_address' /><br /><br />";
echo "</div>";

echo "<div style='width: 10%; float: left;'>";
echo "<input type='hidden' name='step' value='4' />";
echo "&nbsp;";
echo "</div>";
echo "<div style='width: 90%; float: left;'>";
echo "<input type='hidden' name='prev_step' value='3' />";
echo "<input type='submit' class='submit-button img-submit' value='Submit' />";
echo "</div>";
echo "</div>";
echo "</form>";
?>

					</td>
				</tr>
			
		</table>

		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php

}

elseif($_GET['step']=='4')
{

	// is config.php present?
	if (file_exists('includes/config.php'))
	{ 
		header('HTTP/1.0 200 OK');
		header('Location: index.php'); 
		exit;
	}
	
	/*
	Check data is ok
*/

	$connection	= mysql_connect($_POST['mysql_host'], $_POST['mysql_login'], escape_string($_POST['mysql_pass']));
	$database	= mysql_select_db($_POST['mysql_database']);
	$error		= false;
	
	unset($_SESSION['error_conn']);
	if ($connection === false)
	{
		$error = $_SESSION['error_conn'] = true;
	}
	
	unset($_SESSION['error_db']);
	if ($database === false)
	{
		$error = $_SESSION['error_db'] = true;
	}
	
	if ($error)
	{
		$_SESSION['prev_step'] = 4;
		header('Location: install.php?step=3');
		exit;
	}
	else
	{
		$ourFileName	= 'includes/config.php';
		$ourFileHandle	= fopen($ourFileName, 'w') or die("can't open file");

		$stringData = '<?php
/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By the LayerBulletin team
|	Released under the Artistic License 2.0
|	Please read the LICENSE file included with the download for more
|	information on what you can do
|	http://layerbulletin.com/
|	========================================
|	By LayerBulletin Team
|   (c) 2014 LayerBulletin
|   http://layerbulletin.com/
|   ========================================
|   config.php - Set database and site address details in here
+--------------------------------------------------------------------------
*/

if (!defined(\'LB_RUN\')){
	echo \'<h1>ACCESS DENIED</h1>You cannot access this file directly.\';
	exit();
}


// Mysql Settings
 $mysql_host		= "' . $_POST['mysql_host'] . '";
 $mysql_login		= "' . $_POST['mysql_login'] . '";
 $mysql_pass		= "' . strip_slashes($_POST['mysql_pass']) . '";
 $mysql_database	= "' . $_POST['mysql_database'] . '";
 $db_prefix			= "' . $_POST['db_prefix'] . '";

 $_dbConn = mysql_connect($mysql_host, $mysql_login, $mysql_pass)
 	or die (\'Database Login Incorrect: config.php\');
 mysql_select_db($mysql_database, $_dbConn)
 	or die (\'Unable to select the database: config.php\');

?>';

		fwrite($ourFileHandle, $stringData);
		fclose($ourFileHandle);
		
		$_SESSION['prev_step'] = 4;
		header('Location: install.php?step=5');
	}
}

elseif($_GET['step']=='5'){
?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>

				<td class="forum-topic-subject">Installation</td>
			</tr>
		</table>
			<table class="forum-jump" cellpadding="0" cellspacing="0">
				<tr>
					<td class="error-header" style="width:100%;">
						Step Five: Enter Administrator Username, Password & Email Address
					</td>
				</tr>
				<tr>
					<td class="forum-jump-content" style="width:100%;">
					<?php
echo "Please enter your desired username, password & email address. Once submitted, these details will be used as the default forum administrator.<br /><br />";
echo "<form method='post' action='install.php?step=6' onsubmit='return check_passwords()'>";
echo "<div style='padding-left: 30px;'>";
echo "<div style='width: 10%; float: left;'>";
echo "Forum name:";
echo "</div>";
echo "<div style='width: 90%; float: left;'>";
echo "<input type='text' name='site_name' /><br /><br />";
echo "</div>";
echo "<div style='width: 10%; float: left;'>";
echo "Forum description:";
echo "</div>";
echo "<div style='width: 90%; float: left;'>";
echo "<input type='text' name='site_desc' /><br /><br />";
echo "</div>";
echo "<div style='width: 10%; float: left;'>";
echo "Username:";
echo "</div>";
echo "<div style='width: 90%; float: left;'>";
echo "<input type='text' name='username' /><br /><br />";
echo "</div>";
echo "<div style='width: 10%; float: left;'>";
echo "Password:";
echo "</div>";
echo "<div style='width: 90%; float: left;'>";
echo "<input type='password' id='pass' name='password' /><br /><br />";
echo "</div>";
echo "<div style='width: 10%; float: left;'>";
echo "Repeat password:";
echo "</div>";
echo "<div style='width: 90%; float: left;'>";
echo "<input type='password' id='check_pass' name='check_password' value='' /><br /><br />";
echo "</div>";
echo "<div style='width: 10%; float: left;'>";
echo "Email:";
echo "</div>";
echo "<div style='width: 90%; float: left;'>";
echo "<input type='text' name='email' /><br /><br />";
echo "</div>";
echo "<div style='width: 10%; float: left;'>";
echo "&nbsp;";
echo "</div>";
echo "<div style='width: 90%; float: left;'>";
echo "<input type='hidden' name='prev_step' value='5' />";
echo "<input type='submit' class='submit-button img-submit' value='Submit' />";
echo "</div>";
echo "</div>";
echo "</form>";
?>

					</td>
				</tr>
			
		</table>

		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php
}

elseif($_GET['step']=='ftp'){

$my_address=$_SERVER['PHP_SELF'];
$ftp_path=str_replace("/install.php","",$my_address);

$ftp_details['ftp_user_name'] = $_POST['ftp_username'];
$ftp_details['ftp_user_pass'] = $_POST['ftp_password'];
$ftp_details['ftp_root'] = '/public_html';
$ftp_details['ftp_server'] = 'ftp'.$_SERVER['HTTP_HOST'];

function chmod_11oo10($path, $mod, $ftp_details)
{
    // extract ftp details (array keys as variable names)
    extract ($ftp_details);
   
    // set up basic connection
    $conn_id = ftp_connect('localhost');
   
    // login with username and password
    $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
   
    // try to chmod $path directory
    if (ftp_site($conn_id, 'CHMOD '.$mod.' '.$ftp_root.$path) !== false) {
        $success="true";
    }
    else {
        $success="false";
    }

    // close the connection
    ftp_close($conn_id);
    return $success;
}

chmod_11oo10("$ftp_path", "777", $ftp_details);

chmod_11oo10("$ftp_path/cache", "777", $ftp_details);

chmod_11oo10("$ftp_path/images", "777", $ftp_details);
chmod_11oo10("$ftp_path/images/buttons", "777", $ftp_details);
chmod_11oo10("$ftp_path/images/flags", "777", $ftp_details);
chmod_11oo10("$ftp_path/images/forums", "777", $ftp_details);
chmod_11oo10("$ftp_path/images/groups", "777", $ftp_details);
chmod_11oo10("$ftp_path/images/buttons", "777", $ftp_details);
chmod_11oo10("$ftp_path/images/members", "777", $ftp_details);
chmod_11oo10("$ftp_path/images/messages", "777", $ftp_details);
chmod_11oo10("$ftp_path/images/pages", "777", $ftp_details);
chmod_11oo10("$ftp_path/images/textarea", "777", $ftp_details);

chmod_11oo10("$ftp_path/includes", "777", $ftp_details);
chmod_11oo10("$ftp_path/includes/forums", "777", $ftp_details);
chmod_11oo10("$ftp_path/includes/pages", "777", $ftp_details);
chmod_11oo10("$ftp_path/includes/pages/admin", "777", $ftp_details);
chmod_11oo10("$ftp_path/includes/pages/myoptions", "777", $ftp_details);

chmod_11oo10("$ftp_path/lang", "777", $ftp_details);
chmod_11oo10("$ftp_path/lang/english_en", "777", $ftp_details);

chmod_11oo10("$ftp_path/modules", "777", $ftp_details);

chmod_11oo10("$ftp_path/scripts", "777", $ftp_details);
chmod_11oo10("$ftp_path/scripts/js", "777", $ftp_details);
chmod_11oo10("$ftp_path/scripts/php", "777", $ftp_details);

chmod_11oo10("$ftp_path/templates/includes", "777", $ftp_details);
chmod_11oo10("$ftp_path/templates/includes/forums", "777", $ftp_details);
chmod_11oo10("$ftp_path/templates/includes/pages", "777", $ftp_details);
chmod_11oo10("$ftp_path/templates/includes/pages/admin", "777", $ftp_details);
chmod_11oo10("$ftp_path/templates/includes/pages/myoptions", "777", $ftp_details);

chmod_11oo10("$ftp_path/themes", "777", $ftp_details);
chmod_11oo10("$ftp_path/themes/layerbulletin_default", "777", $ftp_details);

chmod_11oo10("$ftp_path/uploads/attachments", "777", $ftp_details);
chmod_11oo10("$ftp_path/uploads/avatar", "777", $ftp_details);

header("HTTP/1.0 200 OK");
header("Location: install.php?step=2");

}

else{
?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>

				<td class="forum-topic-subject">Installation</td>
			</tr>
		</table>
			<table class="forum-jump" cellpadding="0" cellspacing="0">
				<tr>
					<td class="error-header" style="width:100%;">
						Step One: Licence Agreement
					</td>
				</tr>
				<tr>
					<td class="forum-jump-content" style="width:100%;">
					<?php
echo "<form method='post' onsubmit='return check_license()' action='install.php?step=2'>";
echo "<div style='padding-left: 30px;'>";
echo "<textarea class='terms' style='width: 98%; padding: 5px;' readonly rows=\"10\" cols=\"98\">";
echo "Artistic License 2.0
Copyright (c) 2000-2006, The Perl Foundation.

Everyone is permitted to copy and distribute verbatim copies of this license document, but changing it is not allowed.

Preamble
This license establishes the terms under which a given free software Package may be copied, modified, distributed, and/or redistributed. The intent is that the Copyright Holder maintains some artistic control over the development of that Package while still keeping the Package available as open source and free software.

You are always permitted to make arrangements wholly outside of this license directly with the Copyright Holder of a given Package. If the terms of this license do not permit the full use that you propose to make of the Package, you should contact the Copyright Holder and seek a different licensing arrangement.

Definitions
\"Copyright Holder\" means the individual(s) or organization(s) named in the copyright notice for the entire Package.

\"Contributor\" means any party that has contributed code or other material to the Package, in accordance with the Copyright Holder's procedures.

\"You\" and \"your\" means any person who would like to copy, distribute, or modify the Package.

\"Package\" means the collection of files distributed by the Copyright Holder, and derivatives of that collection and/or of those files. A given Package may consist of either the Standard Version, or a Modified Version.

\"Distribute\" means providing a copy of the Package or making it accessible to anyone else, or in the case of a company or organization, to others outside of your company or organization.

\"Distributor Fee\" means any fee that you charge for Distributing this Package or providing support for this Package to another party. It does not mean licensing fees.

\"Standard Version\" refers to the Package if it has not been modified, or has been modified only in ways explicitly requested by the Copyright Holder.

\"Modified Version\" means the Package, if it has been changed, and such changes were not explicitly requested by the Copyright Holder.

\"Original License\" means this Artistic License as Distributed with the Standard Version of the Package, in its current version or as it may be modified by The Perl Foundation in the future.

\"Source\" form means the source code, documentation source, and configuration files for the Package.

\"Compiled\" form means the compiled bytecode, object code, binary, or any other form resulting from mechanical transformation or translation of the Source form.

Permission for Use and Modification Without Distribution
(1) You are permitted to use the Standard Version and create and use Modified Versions for any purpose without restriction, provided that you do not Distribute the Modified Version.

Permissions for Redistribution of the Standard Version
(2) You may Distribute verbatim copies of the Source form of the Standard Version of this Package in any medium without restriction, either gratis or for a Distributor Fee, provided that you duplicate all of the original copyright notices and associated disclaimers. At your discretion, such verbatim copies may or may not include a Compiled form of the Package.

(3) You may apply any bug fixes, portability changes, and other modifications made available from the Copyright Holder. The resulting Package will still be considered the Standard Version, and as such will be subject to the Original License.

Distribution of Modified Versions of the Package as Source
(4) You may Distribute your Modified Version as Source (either gratis or for a Distributor Fee, and with or without a Compiled form of the Modified Version) provided that you clearly document how it differs from the Standard Version, including, but not limited to, documenting any non-standard features, executables, or modules, and provided that you do at least ONE of the following:

(a) make the Modified Version available to the Copyright Holder of the Standard Version, under the Original License, so that the Copyright Holder may include your modifications in the Standard Version.
(b) ensure that installation of your Modified Version does not prevent the user installing or running the Standard Version. In addition, the Modified Version must bear a name that is different from the name of the Standard Version.
(c) allow anyone who receives a copy of the Modified Version to make the Source form of the Modified Version available to others under
(i) the Original License or
(ii) a license that permits the licensee to freely copy, modify and redistribute the Modified Version using the same licensing terms that apply to the copy that the licensee received, and requires that the Source form of the Modified Version, and of any works derived from it, be made freely available in that license fees are prohibited but Distributor Fees are allowed.
Distribution of Compiled Forms of the Standard Version or Modified Versions without the Source
(5) You may Distribute Compiled forms of the Standard Version without the Source, provided that you include complete instructions on how to get the Source of the Standard Version. Such instructions must be valid at the time of your distribution. If these instructions, at any time while you are carrying out such distribution, become invalid, you must provide new instructions on demand or cease further distribution. If you provide valid instructions or cease distribution within thirty days after you become aware that the instructions are invalid, then you do not forfeit any of your rights under this license.

(6) You may Distribute a Modified Version in Compiled form without the Source, provided that you comply with Section 4 with respect to the Source of the Modified Version.

Aggregating or Linking the Package
(7) You may aggregate the Package (either the Standard Version or Modified Version) with other packages and Distribute the resulting aggregation provided that you do not charge a licensing fee for the Package. Distributor Fees are permitted, and licensing fees for other components in the aggregation are permitted. The terms of this license apply to the use and Distribution of the Standard or Modified Versions as included in the aggregation.

(8) You are permitted to link Modified and Standard Versions with other works, to embed the Package in a larger work of your own, or to build stand-alone binary or bytecode versions of applications that include the Package, and Distribute the result without restriction, provided the result does not expose a direct interface to the Package.

Items That are Not Considered Part of a Modified Version
(9) Works (including, but not limited to, modules and scripts) that merely extend or make use of the Package, do not, by themselves, cause the Package to be a Modified Version. In addition, such works are not considered parts of the Package itself, and are not subject to the terms of this license.

General Provisions
(10) Any use, modification, and distribution of the Standard or Modified Versions is governed by this Artistic License. By using, modifying or distributing the Package, you accept this license. Do not use, modify, or distribute the Package, if you do not accept this license.

(11) If your Modified Version has been derived from a Modified Version made by someone other than you, you are nevertheless required to ensure that your Modified Version complies with the requirements of this license.

(12) This license does not grant you the right to use any trademark, service mark, tradename, or logo of the Copyright Holder.

(13) This license includes the non-exclusive, worldwide, free-of-charge patent license to make, have made, use, offer to sell, sell, import and otherwise transfer the Package with respect to any patent claims licensable by the Copyright Holder that are necessarily infringed by the Package. If you institute patent litigation (including a cross-claim or counterclaim) against any party alleging that the Package constitutes direct or contributory patent infringement, then this Artistic License to you shall terminate on the date that such litigation is filed.

(14) Disclaimer of Warranty: THE PACKAGE IS PROVIDED BY THE COPYRIGHT HOLDER AND CONTRIBUTORS \"AS IS\" AND WITHOUT ANY EXPRESS OR IMPLIED WARRANTIES. THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, OR NON-INFRINGEMENT ARE DISCLAIMED TO THE EXTENT PERMITTED BY YOUR LOCAL LAW. UNLESS REQUIRED BY LAW, NO COPYRIGHT HOLDER OR CONTRIBUTOR WILL BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, OR CONSEQUENTIAL DAMAGES ARISING IN ANY WAY OUT OF THE USE OF THE PACKAGE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.";

echo "</textarea>";
echo "<br /><br />";
echo "<input type='checkbox' id='license' name='prev_step' value='1' class='checkbox'><strong> I agree to the above license</strong></input>";
echo "<br /><br />";
echo "<input type='submit' class='submit-button img-submit' value='Submit'/>";
echo "</form>";

?>
					</td>
				</tr>
			
		</table>

		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>

<?php

}
?>

<div class="spacer">&nbsp;</div>
<table class="forum-jump" cellspacing="0" cellpadding="0">
	<tr>
		<td class="forum-jump-content" style="vertical-align@ middle;">

				<span style="width: 100%; text-align: center; float: left;">
					Powered by
					<a href="http://www.layerbulletin.com">LayerBulletin</a> v<?php echo LB_VERSION; ?>
				</span>
		</td>
	</tr>
</table>

		</td></tr></table>
		</div></div>
		
</body></html>
<?php
		function strip_slashes($string) {
		
			if (get_magic_quotes_gpc()){
		
				$string = stripslashes($string);
			
			}
				
			$string = str_replace("&amp;", "&", $string);

	   		return $string;
		}

		function escape_string($string) {

			$string = addslashes($string);

			$string = htmlspecialchars($string);
			return $string;
		}
ob_flush();
?>