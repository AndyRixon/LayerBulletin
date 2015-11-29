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
|   logout.php - logout script
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

setcookie("lb_name", "", time() -3600);
setcookie("lb_password", "", time() -3600);
// Remove sessions...
mysql_query("DELETE FROM {$db_prefix}sessions WHERE id='$my_id'");

header("HTTP/1.0 200 OK");
header("Location: $lb_domain");
exit;

?>