<?php
@ini_set('zlib.output_compression', 1);

error_reporting(0);
ini_set('magic_quotes_runtime', 0);

ob_start();
session_start();

define("NOVA_RUN", 1);
define("LB_RUN", 1);
define("LB_VERSION", '1.1.6');

$my_address		= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$lb_domain 	= str_replace('/update.php', '', $my_address);
$lb_root		= str_replace('update.php', '', __FILE__);

if(file_exists($lb_root . "/cache/updater.lock")){
	echo "<div style='padding:10px; background: #ECD5D8; color: #BC2A4D; border:1px solid #BC2A4D;'>The updater is currently locked, please remove the updater.lock file from the cache directory to continue!</div>";
	exit();
}
echo '<title>LayerBulletin '.LB_VERSION.' Updater!</title>';
include 'includes/config.php';
$new_mysql_host = $mysql_host;
$new_mysql_login = $mysql_login;
$new_mysql_pass = $mysql_pass;
$new_mysql_database = $mysql_database;
$new_db_prefix = $db_prefix;
switch($_GET['step']) {
	case '1':
		echo 'The updater is currently updating the config.php file. Please wait...';
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
 $mysql_host		= "' . $new_mysql_host . '";
 $mysql_login		= "' . $new_mysql_login . '";
 $mysql_pass		= "' . $new_mysql_pass . '";
 $mysql_database	= "' . $new_mysql_database . '";
 $db_prefix			= "' . $new_db_prefix . '";

 $_dbConn = mysql_connect($mysql_host, $mysql_login, $mysql_pass)
 	or die (\'Database Login Incorrect: config.php\');
 mysql_select_db($mysql_database, $_dbConn)
 	or die (\'Unable to select the database: config.php\');

?>';

		fwrite($ourFileHandle, $stringData);
		fclose($ourFileHandle);
		echo '<br />The updater has successfully updated the config.php file.<br /><a href="update.php?step=2">Click here to continue with the update!</a>';
	break;
	case '2':
		unlink('cache/settings.php');
		echo 'LayerBulletin is currently updating the database, please wait...';
			mysql_query("ALTER TABLE `{$db_prefix}themes` CHANGE COLUMN `nova_version` `lb_version` VARCHAR(255) NOT NULL DEFAULT '' AFTER `display_name`;");
			mysql_query("ALTER TABLE `{$db_prefix}settings` CHANGE COLUMN `nova_version` `lb_version` VARCHAR(255) NOT NULL DEFAULT '' AFTER `board_email`;");
			mysql_query("ALTER TABLE `{$db_prefix}modules` CHANGE COLUMN `nova_version` `lb_version` VARCHAR(255) NOT NULL DEFAULT '' AFTER `display_name`;");
			mysql_query("UPDATE {$db_prefix}themes SET theme_name='layerbulletin_default' WHERE theme_name='novaboard_default'");
			mysql_query("UPDATE {$db_prefix}settings SET theme='layerbulletin_default' WHERE theme='novaboard_default'");
			mysql_query("UPDATE {$db_prefix}settings SET lb_version='1.1.6' WHERE lb_version='1.1.5'");
			mysql_query("UPDATE {$db_prefix}members SET theme='layerbulletin_default' WHERE theme='novaboard_default'");
			mysql_query("INSERT INTO `{$db_prefix}seo` (`seo_id`, `seo_off`, `seo_on`) VALUES
				(187, 'index.php?page=messages&act=inbox&success=$1', 'messages/success/(.*)');");
			mysql_query("INSERT INTO `{$db_prefix}seo` (`seo_id`, `seo_off`, `seo_on`) VALUES
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
				(199, 'index.php?page=myoptions&act=email&success=$1', 'myoptions/email/success/(.*)');");
			mysql_query("INSERT INTO `{$db_prefix}seo` (`seo_id`, `seo_off`, `seo_on`) VALUES
				(200, 'index.php?page=myoptions&act=password&success=$1', 'myoptions/password/success/(.*)');");
			mysql_query("INSERT INTO `{$db_prefix}seo` (`seo_id`, `seo_off`, `seo_on`) VALUES
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
			echo '<br />Database has now been updated!<br /><a href="update.php?step=3">Click here to continue with the update!</a>';
	break;
	case '3':
		$lockUpdater = fopen($lb_root . "/cache/updater.lock", 'w');
		fclose($lockUpdater);
		echo 'You have successfully updated to LayerBulletin '.LB_VERSION.'<br /><strong>Please remember to remove the update.php file!</strong><br /><br /><a href="index.php">Click here to go to your forums!</a>';
	break;
	default:
		echo "Welcome to the Updater Script for LayerBulletin ".LB_VERSION;
		echo "<div style='padding:10px; background: #ECD5D8; color: #BC2A4D; border:1px solid #BC2A4D;'>Please make sure that the config.php file in your includes directory has writable (777) permissions before continuing.<br /><a href='update.php?step=1'>Click here to start the updater!</a></div>";
	break;
}
?>
