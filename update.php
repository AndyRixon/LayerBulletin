<?php
@ini_set('zlib.output_compression', 1);

error_reporting(0);
ini_set('magic_quotes_runtime', 0);

ob_start();
session_start();

define("LB_RUN", 1);
define("LB_VERSION", '1.1.8');

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
			mysql_query("UPDATE `".$new_db_prefix."settings` SET `lb_version` = '1.1.8'");
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
