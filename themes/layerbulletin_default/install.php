<?php
/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By LayerBulletin Team
|   (c) 2014 LayerBulletin Team
|   http://layerbulletin.com/
|   ========================================
|   install.php - Module install script for Shoutbox
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

// tell the database our theme name...

mysql_query("INSERT INTO {$db_prefix}themes (theme_name, display_name, lb_version, installed, config_page) VALUES ('layerbulletin_default', 'LayerBulletin Default', '1.0.0', '1', '')");

?>