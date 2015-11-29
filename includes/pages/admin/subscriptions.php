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
|   subscriptions.php - create/edit/delete Paypal subscriptions
*/

if (!defined('LB_RUN'))
{
	exit('<h1>ACCESS DENIED</h1>You cannot access this file directly.');
}

template_hook("pages/admin/subscriptions.template.php", "start");

if($_GET['success']=="created"){
	template_hook("pages/admin/subscriptions.template.php", "successCreated");
}elseif($_GET['success']=="updated"){
	template_hook("pages/admin/subscriptions.template.php", "successUpdated");
}elseif($_GET['success']=="deleted"){
	template_hook("pages/admin/subscriptions.template.php", "successDeleted");
}

if ($can_change_site_settings == 0)
{
	lb_redirect("index.php?page=error&error=11","error/11");
}

if ($_POST['subscription_name'] != '' && $_GET['func'] == 'edit')
{
	$upgrade_id = escape_string($_POST['upgrade_id']);
	$token_id	= $_POST['token_id'];
	$token_id	= escape_string($token_id);

	$token_name = "token_subscriptions_$upgrade_id$token_id";
	
	if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name])
	{
		$subscription_name		=	escape_string($_POST['subscription_name']);
		$subscription_features	=	escape_string($_POST['subscription_features']);
		$upgrade_from			=	(int) $_POST['upgrade_from'];
		$upgrade_to				=	(int)$_POST['upgrade_to'];
		$cost					=	escape_string($_POST['cost']);
		$currency				=	escape_string($_POST['currency']);
		$frequency_one			=	(int) $_POST['frequency_one'];
		$frequency_two			=	escape_string($_POST['frequency_two']);
		$paypal_email			=	escape_string($_POST['paypal_email']);
		$upgrade_id				=	(int) $_POST['upgrade_id'];
		 
		if ($_POST['frequency_two'] != 'Once')
		{
			mysql_query("UPDATE {$db_prefix}group_upgrade SET upgrade_name='$subscription_name', upgrade_features='$subscription_features', upgrade_from='$upgrade_from', upgrade_to='$upgrade_to', upgrade_cost='$cost', upgrade_currency='$currency', upgrade_period='$frequency_one', upgrade_period_two='$frequency_two', paypal_email='$paypal_email' WHERE upgrade_id='$upgrade_id'");
		}
		else
		{
			mysql_query("UPDATE {$db_prefix}group_upgrade SET upgrade_name='$subscription_name', upgrade_features='$subscription_features', upgrade_from='$upgrade_from', upgrade_to='$pgrade_to, upgrade_cost='$cost', upgrade_currency='$currency', upgrade_period='0', upgrade_period_two='Once', paypal_email='$paypal_email' WHERE upgrade_id='$upgrade_id'");
		}

		template_hook("pages/admin/subscriptions.template.php", "form_1");

		lb_redirect("index.php?page=admin&act=subscriptions&success=updated","admin/subscriptions/success/updated");
	}
	else
	{
		lb_redirect("index.php?page=error&error=28","error/28");
	}
}
elseif ($_POST['subscription_name'] != '')
{
	$token_id = $_POST['token_id'];
	$token_id = escape_string($token_id);

	$token_name = "token_subscriptions_new_$token_id";
	
	if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name])
	{
		$subscription_name		=	escape_string($_POST['subscription_name']);
		$subscription_features	=	escape_string($_POST['subscription_features']);
		$upgrade_from			=	(int) $_POST['upgrade_from'];
		$upgrade_to				=	(int)$_POST['upgrade_to'];
		$cost					=	escape_string($_POST['cost']);
		$currency				=	escape_string($_POST['currency']);
		$frequency_one			=	(int) $_POST['frequency_one'];
		$frequency_two			=	escape_string($_POST['frequency_two']);
		$paypal_email			=	escape_string($_POST['paypal_email']);
		$upgrade_id				=	(int) $_POST['upgrade_id'];
		 
		if ($_POST['frequency_two'] != 'Once')
		{
			mysql_query("INSERT INTO {$db_prefix}group_upgrade (upgrade_name, upgrade_features, upgrade_from, upgrade_to, upgrade_cost, upgrade_currency, upgrade_period, upgrade_period_two, paypal_email) VALUES ('$subscription_name', '$subscription_features','$upgrade_from', '$upgrade_to', '$cost', '$currency', '$frequency_one', '$frequency_two', '$paypal_email')");
		}
		else
		{
			mysql_query("INSERT INTO {$db_prefix}group_upgrade (upgrade_name, upgrade_features, upgrade_from, upgrade_to, upgrade_cost, upgrade_currency, upgrade_period, upgrade_period_two, paypal_email) VALUES ('$subscription_name', '$subscription_features','$upgrade_from', '$upgrade_to', '$cost', '$currency', '0', 'Once', '$paypal_email')");
		}

		template_hook("pages/admin/subscriptions.template.php", "form_2");

		lb_redirect("index.php?page=admin&act=subscriptions&success=created","admin/subscriptions/success/created");
	}
	else
	{
		lb_redirect("index.php?page=error&error=28","error/28");
	}
}

elseif ($_GET['func']=='new')
{
	$token_id = md5(microtime());
	$token = md5(uniqid(rand(),true));

	$token_name = "token_subscriptions_new_$token_id";

	$_SESSION[$token_name] = $token;

	template_hook("pages/admin/subscriptions.template.php", "3");

	$query2 = "select GROUP_ID, GROUP_NAME from {$db_prefix}groups ORDER BY GROUP_NAME desc" ;
	$result2 = mysql_query($query2) or die("upgrade.php - Error in query: $query2") ;                                  
	while ($results2 = mysql_fetch_array($result2))
	{
		$group_id = $results2['GROUP_ID'];
		$group_name = strip_slashes($results2['GROUP_NAME']);

		template_hook("pages/admin/subscriptions.template.php", "4");
	}

	template_hook("pages/admin/subscriptions.template.php", "5");

	$query2 = "select GROUP_ID, GROUP_NAME from {$db_prefix}groups ORDER BY GROUP_NAME desc" ;
	$result2 = mysql_query($query2) or die("upgrade.php - Error in query: $query2") ;                                  
	while ($results2 = mysql_fetch_array($result2))
	{
		$group_id = $results2['GROUP_ID'];
		$group_name = strip_slashes($results2['GROUP_NAME']);

		template_hook("pages/admin/subscriptions.template.php", "4");
	}

	template_hook("pages/admin/subscriptions.template.php", "6");

}
elseif($_POST['subscriptions_delete'] == 1)
{
	$id = (int) $_POST['subscription_id'];
	
	if (tokenCheck('subscriptions_delete', $id))
	{
		mysql_query("DELETE FROM {$db_prefix}group_upgrade WHERE upgrade_id ='$id'");
		
		template_hook("pages/admin/subscriptions.template.php", "form_3");
		
		lb_redirect("index.php?page=admin&act=subscriptions&success=deleted","admin/subscriptions/success/deleted");
	}
	else
	{
		lb_redirect('index.php?page=error&error=28', 'error/28');
	}
}
elseif($_GET['func']=='edit')
{
	$token_id = md5(microtime());
	$token = md5(uniqid(rand(),true));

	$upgrade_id = escape_string($_GET['id']);

	$token_name = "token_subscriptions_$upgrade_id$token_id";

	$_SESSION[$token_name] = $token;

	$query29 = "select UPGRADE_ID, UPGRADE_NAME, UPGRADE_FEATURES, UPGRADE_FROM, UPGRADE_TO, UPGRADE_COST, UPGRADE_CURRENCY, UPGRADE_PERIOD, UPGRADE_PERIOD_TWO, PAYPAL_EMAIL from {$db_prefix}group_upgrade WHERE UPGRADE_ID='$upgrade_id'" ;
	$result29 = mysql_query($query29) or die("upgrade.php - Error in query: $query29") ;                                  
	while ($results29 = mysql_fetch_array($result29))
	{
		$upgrade_id = strip_slashes($results29['UPGRADE_ID']);
		$upgrade_name = strip_slashes($results29['UPGRADE_NAME']);
		$upgrade_features = strip_slashes($results29['UPGRADE_FEATURES']);
		$upgrade_from = strip_slashes($results29['UPGRADE_FROM']);
		$upgrade_to = strip_slashes($results29['UPGRADE_TO']);
		$upgrade_cost = strip_slashes($results29['UPGRADE_COST']);
		$upgrade_currency = strip_slashes($results29['UPGRADE_CURRENCY']);
		$upgrade_period = strip_slashes($results29['UPGRADE_PERIOD']);
		$upgrade_period_two = strip_slashes($results29['UPGRADE_PERIOD_TWO']);
		$paypal_email = strip_slashes($results29['PAYPAL_EMAIL']);

		template_hook("pages/admin/subscriptions.template.php", "8");

		$query2 = "select GROUP_ID, GROUP_NAME from {$db_prefix}groups ORDER BY GROUP_NAME asc" ;
		$result2 = mysql_query($query2) or die("upgrade.php - Error in query: $query2") ;                                  
		while ($results2 = mysql_fetch_array($result2))
		{
			$group_id = $results2['GROUP_ID'];
			$group_name = strip_slashes($results2['GROUP_NAME']);

			template_hook("pages/admin/subscriptions.template.php", "9");
		}

		template_hook("pages/admin/subscriptions.template.php", "10");

		$query2 = "select GROUP_ID, GROUP_NAME from {$db_prefix}groups ORDER BY GROUP_NAME asc" ;
		$result2 = mysql_query($query2) or die("upgrade.php - Error in query: $query2") ;                                  
		while ($results2 = mysql_fetch_array($result2))
		{
			$group_id = $results2['GROUP_ID'];
			$group_name = strip_slashes($results2['GROUP_NAME']);

			template_hook("pages/admin/subscriptions.template.php", "11");
		}

		template_hook("pages/admin/subscriptions.template.php", "12");
	}
}
else
{
	template_hook("pages/admin/subscriptions.template.php", "13");

	$query2 = "select UPGRADE_ID, UPGRADE_NAME, UPGRADE_FEATURES, UPGRADE_FROM, UPGRADE_TO, UPGRADE_COST, UPGRADE_CURRENCY, UPGRADE_PERIOD, UPGRADE_PERIOD_TWO, PAYPAL_EMAIL from {$db_prefix}group_upgrade ORDER BY UPGRADE_ID desc" ;
	$result2 = mysql_query($query2) or die("upgrade.php - Error in query: $query2") ;                                  
	while ($results2 = mysql_fetch_array($result2))
	{
		$upgrade_id = strip_slashes($results2['UPGRADE_ID']);
		$upgrade_name = strip_slashes($results2['UPGRADE_NAME']);
		$upgrade_features = strip_slashes($results2['UPGRADE_FEATURES']);
		$upgrade_from = strip_slashes($results2['UPGRADE_FROM']);
		$upgrade_to = strip_slashes($results2['UPGRADE_TO']);
		$upgrade_cost = strip_slashes($results2['UPGRADE_COST']);
		$upgrade_currency = strip_slashes($results2['UPGRADE_CURRENCY']);
		$upgrade_period = strip_slashes($results2['UPGRADE_PERIOD']);
		$upgrade_period_two = strip_slashes($results2['UPGRADE_PERIOD_TWO']);
		$paypal_email = strip_slashes($results2['PAYPAL_EMAIL']);

		list($token_id, $token, $token_name) = tokenCreate('subscriptions_delete', $upgrade_id);

		template_hook("pages/admin/subscriptions.template.php", "14");
	}

	template_hook("pages/admin/subscriptions.template.php", "15");
}

template_hook("pages/admin/subscriptions.template.php", "end");
?>