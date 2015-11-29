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
|   usertitle.php - change member usertitle
 
*/

if (!defined('LB_RUN'))
	exit('<h1>ACCESS DENIED</h1>You cannot access this file directly.');

template_hook("pages/myoptions/usertitle.template.php", "start");

if($_GET['success']=='saved'){
	template_hook("pages/myoptions/usertitle.template.php", "successChanged");
}elseif($_GET['success']=='too_long'){
	template_hook("pages/myoptions/usertitle.template.php", "successShorter");
}

if ($can_change_user_title == 0)
{
	lb_redirect("index.php?page=error&error=22","error/22");
}

if ($_POST['form'] != '')
{
	$token_id	= escape_string($_POST['token_id']);
	$token_name	= "token_usertitle_$token_id";

	if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name])
	{
		$usertitle = escape_string($_POST['usertitle']);

			/*
			Check length is not greater than that allowed
		*/

			if (strlen($usertitle) > $usertitle_length)
			{
				lb_redirect("index.php?page=myoptions&act=usertitle&success=too_long","myoptions/usertitle/success/too_long");
			}

		mysql_query("UPDATE {$db_prefix}members SET usertitle='$usertitle' WHERE id='$my_id'");

		template_hook("pages/myoptions/usertitle.template.php", "form");

		lb_redirect("index.php?page=myoptions&act=usertitle&success=saved","myoptions/usertitle/success/saved");
	}
	else
	{
		lb_redirect("index.php?page=error&error=28","error/28");
	}
}
else
{
	$token_id				= md5(microtime());
	$token					= md5(uniqid(rand(),true));
	$token_name				= "token_usertitle_$token_id";
	$_SESSION[$token_name]	= $token;

	$query2		= "select ID, USERTITLE from {$db_prefix}members WHERE ID='$my_id'";
	$result2	= mysql_query($query2) or die("usertitle.php - Error in query: $query2");
	
	while ($results2 = mysql_fetch_array($result2))
	{
		$id			= $results2['ID'];
		$usertitle	= strip_slashes($results2['USERTITLE']);
		
		# Maximum characters available
		$lang_user['usertitle_length'] = sprintf($lang_user['usertitle_length'], $usertitle_length);

		template_hook("pages/myoptions/usertitle.template.php", "2");
	}
}

template_hook("pages/myoptions/usertitle.template.php", "end");

?>