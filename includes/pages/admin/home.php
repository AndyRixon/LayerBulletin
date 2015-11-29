<?php

/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By LayerBulletin Team
|   (c) 2014 LayerBulletin Team
|   http://layerbulletin.com/
|   ========================================
|   home.php - admin home page
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/admin/home.template.php", "start");

if($_GET['success']=="saved"){
	template_hook("pages/admin/home.template.php", "successSaved");
}

if ($_POST['form']!='')
{
	$token_id = escape_string($_POST['token_id']);

	$token_name = "token_home_$token_id";
	
	if(isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name])
	{
		$content = escape_string($_POST['content']);

		// Update it...
		mysql_query("UPDATE {$db_prefix}settings SET whiteboard='$content'");

		# Delete cache
		$Cache->delete('settings');

		template_hook("pages/admin/home.template.php", "form");

		lb_redirect("index.php?page=admin&success=saved","admin/success/saved");	}
	else
	{
		lb_redirect("index.php?page=error&error=28","error/28");
	}
}
else
{
	$check_board_offline		= $Settings['board_offline'];
	$check_guest_register		= $Settings['guest_register'];
	$check_allow_attachments	= $Settings['allow_attachments'];
	$akismet_key				= $Settings['akismet_key'];
	$spam_warn					= ($akismet_key == '') ? 1 : 0;
	$recaptcha_warning			= ($recaptcha_public == '' && $recaptcha_private == '') ? 1 : 0;
	
		/*
		Check for board updates..
	*/
	
		$time			= time();
		$update_needed	= false;
	
		if ($Settings['update_check'] <= ($time - 43200))
		{
			$contents	= file_get_contents('http://www.layerbulletin.com/lb_version.txt');
			$contents	= explode('|', $contents);
			
			$update_needed = version_compare($contents[0], $Settings['lb_version'], '>') ? true : false;
			
			if (!$update_needed)
			{
				mysql_query('UPDATE ' . $db_prefix . 'settings SET update_check = ' . $time);
				
				$Cache->delete('settings');
			}
		}

	if(file_exists("install.php"))
	{
		template_hook("pages/admin/home.template.php", 15);
	}
	
	if(file_exists("update.php"))
	{
		template_hook("pages/admin/home.template.php", 16);
	}

	template_hook("pages/admin/home.template.php", "1");
	
	if ($update_needed)
	{
		template_hook('pages/admin/home.template.php', 13);
	}
	else
	{
		template_hook('pages/admin/home.template.php', 14);
	}

	if ($check_board_offline == 1)
	{
		template_hook("pages/admin/home.template.php", "3");
	}
	else
	{
		template_hook("pages/admin/home.template.php", "4");
	}
	
	if ($check_guest_register == 0)
	{
		template_hook("pages/admin/home.template.php", "5");
	}
	else
	{
		template_hook("pages/admin/home.template.php", "6");
	}
	
	if ($check_allow_attachments == 0)
	{
		template_hook("pages/admin/home.template.php", "8");
	}
	else
	{
		template_hook("pages/admin/home.template.php", "9");
	}
	
	if ($spam_warn == 1 && $recaptcha_warning == 1)
	{
		template_hook("pages/admin/home.template.php", "10");
	}
	elseif ($spam_warn == 0 && $recaptcha_warning == 0)
	{
		template_hook("pages/admin/home.template.php", "11");
	}
	else
	{
		template_hook("pages/admin/home.template.php", "12");
	}

	template_hook("pages/admin/home.template.php", "7");

	$token_id = md5(microtime());
	$token = md5(uniqid(rand(),true));

	$token_name = "token_home_$token_id";

	$_SESSION[$token_name] = $token;

	$query2 = "select WHITEBOARD from {$db_prefix}settings" ;
	$result2 = mysql_query($query2) or die("home.php - Error in query: $query2") ;                                  
	$content = strip_slashes(mysql_result($result2, 0));

	$content=str_replace("<br />","",$content);

	template_hook("pages/admin/home.template.php", "2");
}

template_hook("pages/admin/home.template.php", "end");

?>