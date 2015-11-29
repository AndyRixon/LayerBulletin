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
|   myoptions.php - shows My Options area for members
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/myoptions.template.php", "start");

if ($_COOKIE['lb_name']=='' && $_COOKIE['lb_password']==''){

	lb_redirect("index.php?page=error&error=15","error/15");

}
else{

$query29 = "select UPGRADE_ID from {$db_prefix}group_upgrade WHERE UPGRADE_FROM='$role' ORDER BY UPGRADE_ID asc" ;
$result29 = mysql_query($query29) or die("upgrade.php - Error in query: $query29");
$upgrade_total=mysql_num_rows($result29);

template_hook("pages/myoptions.template.php", "1");

$act = escape_string($_GET['act']);

if (strstr($act, '..') || strstr($act, '/'))
{
	header("HTTP/1.0 200 OK");
	header('Location: index.php?page=error&error=29');
	exit;
}

if ($_GET['act']==''){

		if (file_exists("themes/$theme/includes/pages/myoptions/home.php")){
			include "themes/$theme/includes/pages/myoptions/home.php";
		}
		elseif (@include("includes/pages/myoptions/home.php")){
		}
		else{
			header("HTTP/1.0 200 OK");
			header('Location: index.php?page=error&error=29');
			exit;
		}
}
else{

		if (file_exists("themes/$theme/includes/pages/myoptions/$act.php")){
			include "themes/$theme/includes/pages/myoptions/$act.php";
		}
		elseif (@include("includes/pages/myoptions/$act.php")){
		}
		else{
			header("HTTP/1.0 200 OK");
			header('Location: index.php?page=error&error=29');
			exit;
		}
}

template_hook("pages/myoptions.template.php", "2");

}

template_hook("pages/myoptions.template.php", "end");
?>
