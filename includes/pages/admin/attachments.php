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
|   attachments.php - Set whether to allow attachments & max image sizes.
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/admin/attachments.template.php", "start");

if($_GET['success']=="saved"){
	template_hook("pages/admin/attachments.template.php", "successSaved");
}

if ($can_change_site_settings=='0')
{
	lb_redirect("index.php?page=error&error=11","error/11");
}

if ($_POST['post_form']!='')
{
	$token_id 				= escape_string($_POST['token_id']);
	$token_name 			= "token_attachments_$token_id";
	$allow_attachments		= (int) $_POST['allow_attachments'];
	$attach_img_size		= (int) $_POST['attach_img_size'];
	$attach_avatar_size		= (int) $_POST['attach_avatar_size'];

	if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name])
	{
		mysql_query("UPDATE {$db_prefix}settings SET allow_attachments='$allow_attachments', attach_img_size='$attach_img_size', attach_avatar_size='$attach_avatar_size'");
		
		# Delete settings cache
		$Cache->delete('settings');
		
		template_hook("pages/admin/attachments.template.php", "form");
		lb_redirect("index.php?page=admin&act=attachments&success=saved","admin/attachments/success/saved");
	}
	else
	{
		lb_redirect("index.php?page=error&error=28","error/28");
	}
}
else
{
	$token_id = md5(microtime());
	$token = md5(uniqid(rand(),true));

	$token_name = "token_attachments_$token_id";

	$_SESSION[$token_name] = $token;

	template_hook("pages/admin/attachments.template.php", "2");
}

template_hook("pages/admin/attachments.template.php", "end");

?>