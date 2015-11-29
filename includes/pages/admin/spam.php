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
|   spam.php - admin options for spam-flagged posts
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

require_once "scripts/php/captcha/recaptchalib.php";

$recaptcha_site = str_replace("http://", "", $lb_domain);

$recaptcha_address = recaptcha_get_signup_url($recaptcha_site, "LayerBulletin");

$lang_admin['spam_recaptcha_desc'] = str_replace("%recaptcha_website%", $recaptcha_address, $lang_admin['spam_recaptcha_desc']);

template_hook("pages/admin/spam.template.php", "start");

if($_GET['success']=="saved"){
	template_hook("pages/admin/spam.template.php", "successSaved");
}

if ($can_change_site_settings == 0)
{
	lb_redirect('index.php?page=error&error=11', 'error/11');
	exit;
}

if ($_POST['form'] != '')
{
	$akismet_key		= escape_string($_POST['akismet_key']);
	$recaptcha_private	= escape_string($_POST['recaptcha_private']);
	$recaptcha_public	= escape_string($_POST['recaptcha_public']);

	if (tokenCheck('spam'))
	{
		// Your WordPress API key
		$GLOBALS["akismet_key"]		= $akismet_key;

		// The name of the blog you're protecting
		$GLOBALS["akismet_home"]	= $lb_domain;

		// Your User-Agent string
		$GLOBALS["akismet_ua"]		= 'LayerBulletin/1.0';

		// The Akismet hostname
		$GLOBALS["akismet_host"]	= 'rest.akismet.com';

		// Base URL to append to host and prepend to all queries
		$GLOBALS["akismet_url"]		= '1.1';

		include 'scripts/php/akismet.php';

		if (_akismet_login() === false)
		{
			$invalid_key = true;
		}
		else
		{
			$invalid_key = false;
		}
		
		# Correct akismet key or not?
		$set = 'akismet_key = "' . (($invalid_key) ? '' : $akismet_key) . '",';
		
		mysql_query('
			UPDATE
				' . $db_prefix . 'settings
			SET
				' . $set . '
				recaptcha_public = "'. $recaptcha_public . '",
				recaptcha_private = "' . $recaptcha_private . '"
		');
		
		$Cache->delete('settings');

		lb_redirect('index.php?page=admin&act=spam&success=saved', 'admin/spam/success/saved');
	}
	else
	{
		lb_redirect('index.php?page=error&error=28', 'error/28');
	}
}
else
{
	$settings		= $Cache->load('settings');
	$akismet_key	= strip_slashes($settings['akismet_key']);

	template_hook("pages/admin/spam.template.php", "1");

	if ($akismet_key == '')
	{
		template_hook("pages/admin/spam.template.php", "2");
	}
	else
	{
		template_hook("pages/admin/spam.template.php", "3");
	}

	list($token_id, $token, $token_name) = tokenCreate('spam');

	template_hook("pages/admin/spam.template.php", "4");
}

template_hook("pages/admin/spam.template.php", "end");
?>