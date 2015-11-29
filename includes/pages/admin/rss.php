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
|   rss.php - set options for RSS feeds
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/admin/rss.template.php", "start");

if($_GET['success']=="saved"){
	template_hook("pages/admin/rss.template.php", "successSaved");
}

if ($can_change_forum_settings=='0'){

	lb_redirect("index.php?page=error","error");

}

else{

if ($_POST['form']!=''){

$token_id 		= escape_string($_POST['token_id']);
$token_name 	= "token_rss_$token_id";
$show_rss		= escape_string($_POST['rss']);
$show_rss_limit	= escape_string($_POST['list']);

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

mysql_query("UPDATE {$db_prefix}settings SET show_rss='$show_rss', show_rss_limit='$show_rss_limit'");

# Remove settings cache
$Cache->delete('settings');

	template_hook("pages/admin/rss.template.php", "form");

	lb_redirect("index.php?page=admin&act=rss&success=saved","admin/rss/success/saved");

}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}
else
{
	$token_id = md5(microtime());
	$token = md5(uniqid(rand(),true));

	$token_name = "token_rss_$token_id";

	$_SESSION[$token_name] = $token;

	template_hook("pages/admin/rss.template.php", "2");
}

}

template_hook("pages/admin/rss.template.php", "end");
?>