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
|   help.php - displays help page
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}



template_hook("pages/help.template.php", "start");

// what page do we show?
$help = $_GET['h'];
$help = escape_string($help);

if ($help==''){
template_hook("pages/help.template.php", "1");
}
else{
template_hook("pages/help.template.php", $help);
}

template_hook("pages/help.template.php", "end");

?>