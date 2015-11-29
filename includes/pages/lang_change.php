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
|   switcher.php - change theme from drop-down list
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

$lb_lang=$_GET['language'];
$lb_lang = escape_string($lb_lang);

if ($_COOKIE['lb_name']==''){
setcookie("lb_lang", $lb_lang, time() +31536000);
}

else{
mysql_query("UPDATE {$db_prefix}members SET board_lang='$lb_lang' WHERE id='$my_id'");
}

// return to whence they came...

$referer=$_SERVER['HTTP_REFERER'];

			header("HTTP/1.0 200 OK");
			header("Location: $referer");
			exit;

?>