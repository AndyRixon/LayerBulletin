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
|   filter.php - Add & delete word censors in posts.
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/admin/filter.template.php", "start");

if ($can_change_forum_settings == 0)
{
	lb_redirect("index.php?page=error&error=11","error/11");
	exit;
}

if ($_GET['id'] != '')
{
	$id	= (int) $_GET['id'];
	
	mysql_query("DELETE FROM {$db_prefix}censor WHERE row ='$id'");
	
	# Cache is out-of-date...
	$Cache->delete('censor');
	
	template_hook("pages/admin/filter.template.php", "form_1");
	lb_redirect("index.php?page=admin&act=filter","admin/filter");
}


elseif ($_POST['old_word'] != '')
{
	$token_id 	= escape_string($_POST['token_id']);
	$token_name = "token_filter_$token_id";
	$old_word	= escape_string($_POST['old_word']);
	$new_word	= escape_string($_POST['new_word']);
	
	if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name])
	{
		mysql_query("INSERT INTO {$db_prefix}censor (word, new_word) VALUES ('$old_word', '$new_word')");
		
		# Delete cache
		$Cache->delete('censor');
		
		template_hook("pages/admin/filter.template.php", "form_2");
		lb_redirect("index.php?page=admin&act=filter","admin/filter");

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

	$token_name = "token_filter_$token_id";

	$_SESSION[$token_name] = $token;

	template_hook("pages/admin/filter.template.php", "3");
	
	# Load censors
	foreach ($Cache->load('censor') as $censor)
	{
		$row		= $censor['row'];
		$word		= $censor['word'];
		$new_word	= $censor['new_word'];
		
		template_hook('pages/admin/filter.template.php', 4);
	}

	template_hook("pages/admin/filter.template.php", "5");
}

template_hook("pages/admin/filter.template.php", "end");
?>