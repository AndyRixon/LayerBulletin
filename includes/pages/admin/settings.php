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
|   settings.php - general settings for forum
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/admin/settings.template.php", "start");

if($_GET['success']=="saved") {
	template_hook("pages/admin/settings.template.php", "successSaved");
}

if ($can_change_site_settings == 0)
{
	lb_redirect("index.php?page=error","error");
	exit;
}

if ($_POST['site_name']!='')
{
	$token_id = $_POST['token_id'];
	$token_id = escape_string($token_id);

	$token_name = "token_settings_$token_id";

	if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name])
	{
		$new_theme				= escape_string($_POST['theme']);
		$site_name				= escape_string($_POST['site_name']);
		$site_desc				= escape_string($_POST['site_desc']);
		$max_guest_clicks		= escape_string($_POST['max_guest_clicks']);
		$show_gamer_tags		= (int) $_POST['show_gamer_tags'];
		$max_warn				= (int) $_POST['max_warn'];
		$sef_urls				= (int) $_POST['sef_urls'];
		$time_offset			= escape_string($_POST['time_offset']);
		$guest_register			= (int) $_POST['guest_register'];
		$register_bar			= (int) $_POST['register_bar'];
		$email_verification		= (int) $_POST['email_verification'];
		$board_offline			= (int) $_POST['board_offline'];
		$board_offline_reason	= escape_string($_POST['board_offline_reason']);
		$online_yesterday		= (int) $_POST['online_yesterday'];
		$rules					= escape_string($_POST['rules']);
		$change_pass_time		= (int) $_POST['change_pass_time'];
		$home					= escape_string($_POST['home']);
		$board_lang				= escape_string($_POST['board_lang']);
		$board_email			= escape_string($_POST['board_email']);
		$username_length		= ($_POST['username_length'] < 3) ? 3 : (int) $_POST['username_length'];
		$usertitle_length		= (int) $_POST['usertitle_length'];

		if ($change_pass_time <= 0)
		{
			$change_pass_time = 0;
		}

		mysql_query("UPDATE {$db_prefix}settings SET site_name='$site_name', site_desc='$site_desc', max_guest_clicks='$max_guest_clicks', show_gamer_tags='$show_gamer_tags', max_warn='$max_warn', theme='$new_theme', sef_urls='$sef_urls', time_offset='$time_offset', guest_register='$guest_register', register_bar='$register_bar', email_verification='$email_verification', board_offline='$board_offline', board_offline_reason='$board_offline_reason', online_yesterday='$online_yesterday', rules='$rules', change_pass_time='$change_pass_time', home='$home', board_lang='$board_lang', board_email='$board_email', username_length = " . $username_length . ", usertitle_length = " . $usertitle_length);

		# Delete cache
		$Cache->delete('settings');

		if ($sef_urls == 1)
		{
			htaccess_create();
		}
		else
		{
			unlink($lb_root . '.htaccess');
		}

		if ($_POST['force_theme'] == 1)
		{
			mysql_query("UPDATE {$db_prefix}members SET theme=''");
		}

		// to be safe, make sef_url off and return...

		$sef_urls = 0;

		template_hook("pages/admin/settings.template.php", "form");

		lb_redirect("index.php?page=admin&act=settings&success=saved","admin/settings/success/saved");

	}
	else
	{
		lb_redirect("index.php?page=error&error=28","error/28");
	}
}
else{


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_settings_$token_id";

$_SESSION[$token_name] = $token;

$current_theme = $Settings['theme'];

$query21 = "select DISPLAY_NAME from {$db_prefix}themes WHERE THEME_NAME='$current_theme'" ;
$result21 = mysql_query($query21) or die("style.php - Error in query: $query21") ;                                  
$current_theme_name = strip_slashes(mysql_result($result21, 0));

// explode into 2 parts {lang}_{flag} then put into options for selections

	$board_lang_option = explode("_", $board_lang);

// Capital letters please...

	$board_lang_name = ucfirst($board_lang_option[0]);

template_hook("pages/admin/settings.template.php", "2");

$start_time = time() - 43200;
$start_time_value = "-12";

while($start_time_value!="14"){

$time_offset="0";
$formatted_start_time = format_date($start_time, '%A, %d %b %Y (%H:%M)');

template_hook("pages/admin/settings.template.php", "time");

$start_time = $start_time + 1800;
$start_time_value = $start_time_value + 0.5;

}

template_hook("pages/admin/settings.template.php", "aftertime");

list_themes("themes/");

template_hook("pages/admin/settings.template.php", "4");
}

template_hook("pages/admin/settings.template.php", "end");
?>