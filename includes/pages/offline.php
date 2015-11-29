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
|   offline.php - Shows forum offline page
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/offline.template.php", "start");

// are we offline???
if ($board_offline!='1'){
	header("HTTP/1.0 200 OK");
	header('Location: '.$lb_domain.'');
	exit;
}
else{
// convert the board offline reason from BB -> HTML

$content=$board_offline_reason;
$content=strip_slashes($content);

// BB Parse...
if (file_exists("themes/$theme/scripts/php/parse.php")){
	include "themes/$theme/scripts/php/parse.php";
}
else{
	include "scripts/php/parse.php";				
}

$board_offline_reason = $content;

$board_offline_reason = str_replace("\n", "<br />", $board_offline_reason);

template_hook("pages/offline.template.php", "1");
}

template_hook("pages/offline.template.php", "end");
?>