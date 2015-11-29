<?php
/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By LayerBulletin Team
|   (c) 2014 LayerBulletin Team
|   http://layerbulletin.com/
|   ========================================
|   uninstall.php - Module un-install script for Shoutbox
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

mysql_query("DELETE FROM {$db_prefix}themes WHERE theme_name='layerbulletin_default'");

?>