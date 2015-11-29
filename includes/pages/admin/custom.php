<?php
/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By LayerBulletin Team
|   (c) 2014 LayerBulletin Team
|   http://layerbulletin.com/
|   ========================================
|   custom.php - set custom profile fields
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/admin/custom.template.php", "start");

if($_GET['success']=="added") {
	template_hook("pages/admin/custom.template.php", "successAdded");
}elseif($_GET['success']=="deleted"){
	template_hook("pages/admin/custom.template.php", "successDeleted");
}elseif($_GET['success']=="updated"){
	template_hook("pages/admin/custom.template.php", "successUpdated");
}

if ($can_change_forum_settings=='0'){

	lb_redirect("index.php?page=error&error=11","error/11");

}
elseif ($_POST['custom_reorder'] == $lang['button_reorder'])
{
	$hash = $_POST['hash'];
	
	if (tokenCheck('custom_fields', $hash))
	{
		$query3 = "select ID from {$db_prefix}custom_fields ORDER BY ID desc LIMIT 1" ;
		$result3 = mysql_query($query3) or die("categories.php - Error in query: $query3") ; 
		$last = mysql_result($result3, 0);
		
		$counted="1";
		$counter="1";
		
		for ( $counter = $counted; $counter <= $last; $counter += 1)
		{
			$order_field="order_field"."$counter";
			
			$order_field=escape_string($_POST[''.$order_field.'']);
			
			mysql_query("UPDATE {$db_prefix}custom_fields set ORDER_FIELD='$order_field' WHERE id='$counter'");
		}
		
		template_hook("pages/admin/custom.template.php", "form_1");
		lb_redirect("index.php?page=admin&act=custom","admin/custom");
	}
	else
	{
		lb_redirect("index.php?page=error&error=28","error/28");
	}
}

elseif($_POST['custom_delete'] == 1)
{
	$hash = $_POST['hash'];
	
	if (tokenCheck('custom_fields', $hash))
	{
		$id	= (int) $_POST['custom_delete_id'];
		
		mysql_query("DELETE FROM {$db_prefix}custom_fields WHERE id='$id'");
		mysql_query("DELETE FROM {$db_prefix}custom_members WHERE field_id='$id'");
		
		template_hook("pages/admin/custom.template.php", "form_2");
		
		lb_redirect("index.php?page=admin&act=custom&success=deleted","admin/custom/success/deleted");
	}
	else
	{
		lb_redirect('index.php?page=error&error=28', 'error/28');
	}
}

elseif($_GET['func']=='edit'){

if($_POST['id']!=''){

$id = escape_string($_POST['id']);

$token_id = escape_string($_POST['token_id']);

$token_name = "token_custom_edit_$id$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

$field_name		= escape_string($_POST['field_name']); 
$field_desc		= escape_string($_POST['field_description']);
$order_field	= escape_string($_POST['order_field']);
 
mysql_query("UPDATE {$db_prefix}custom_fields SET NAME='$field_name', DESCRIPTION='$field_desc', ORDER_FIELD='$order_field' WHERE ID='$id'");
 
	template_hook("pages/admin/custom.template.php", "form_3");

	lb_redirect("index.php?page=admin&act=custom&success=updated","admin/custom/success/updated");

}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}
else{


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$id = escape_string($_GET['id']);

$token_name = "token_custom_edit_$id$token_id";

$_SESSION[$token_name] = $token;

$query4 = "select ID from {$db_prefix}custom_fields";
$result4 = mysql_query($query4) or die("custom.php - Error in query: $query4") ;
$number_of_fields=mysql_num_rows($result4);

$query4 = "select ID, NAME, DESCRIPTION, ORDER_FIELD from {$db_prefix}custom_fields WHERE ID='$id'";
$result4 = mysql_query($query4) or die("custom.php - Error in query: $query4") ;
while ($results4 = mysql_fetch_array($result4)){
$id = $results4['ID'];
$field_name = strip_slashes($results4['NAME']);
$field_description = strip_slashes($results4['DESCRIPTION']);
$order_field = $results4['ORDER_FIELD'];
}

template_hook("pages/admin/custom.template.php", "4");

$root_counter="1";

for ( $root_counter = $counted; $root_counter <= $number_of_fields; $root_counter += 1) {

template_hook("pages/admin/custom.template.php", "5");

}

template_hook("pages/admin/custom.template.php", "6");

}

}
elseif($_GET['func']=='new'){

if($_POST['id']!=''){

$id = escape_string($_POST['id']);

$token_id = escape_string($_POST['token_id']);

$token_name = "token_custom_new_$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

$field_name		= escape_string($_POST['field_name']); 
$field_desc		= escape_string($_POST['field_description']);
$order_field	= escape_string($_POST['order_field']);
 
mysql_query("INSERT INTO {$db_prefix}custom_fields (name, description, order_field) VALUES ('$field_name', '$field_desc', '$order_field')") or die("custom.php - Error in query: $query6") ;

	template_hook("pages/admin/custom.template.php", "form_4");

	lb_redirect("index.php?page=admin&act=custom&success=added","admin/custom/success/added");

}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}
else{


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_custom_new_$token_id";

$_SESSION[$token_name] = $token;

$query4 = "select ID from {$db_prefix}custom_fields";
$result4 = mysql_query($query4) or die("custom.php - Error in query: $query4") ;
$number_of_fields=mysql_num_rows($result4);

template_hook("pages/admin/custom.template.php", "8");

$root_counter="1";

for ( $root_counter = $counted; $root_counter <= $number_of_fields; $root_counter += 1) {

template_hook("pages/admin/custom.template.php", "9");

}

template_hook("pages/admin/custom.template.php", "10");

}

}

elseif($_GET['func']=='')
{

	$hash = md5(uniqid(mt_rand(), true));
	list($token_id, $token, $token_name) = tokenCreate('custom_fields', $hash);

	template_hook("pages/admin/custom.template.php", "11");

	$query5 = "select ID, NAME, DESCRIPTION, ORDER_FIELD from {$db_prefix}custom_fields ORDER BY ORDER_FIELD asc, ID desc";
	$result5 = mysql_query($query5) or die("custom.php - Error in query: $query5") ;
	while ($results5 = mysql_fetch_array($result5)){
	$id = $results5['ID'];
	$name = strip_slashes($results5['NAME']);
	$description = strip_slashes($results5['DESCRIPTION']);
	$order_field = $results5['ORDER_FIELD'];

	template_hook("pages/admin/custom.template.php", "12");

	$query4 = "select ID from {$db_prefix}custom_fields";
	$result4 = mysql_query($query4) or die("custom.php - Error in query: $query4") ;
	$number_of_fields=mysql_num_rows($result4);

	$query7 = "select ID, ORDER_FIELD from {$db_prefix}custom_fields WHERE id='$id'";
	$result7 = mysql_query($query7) or die("custom.php - Error in query: $query7") ;
	while ($results7 = mysql_fetch_array($result7)){
	$id = $results7['ID'];
	$order_field = $results7['ORDER_FIELD'];
	}

	template_hook("pages/admin/custom.template.php", "13");

	$root_counter="1";

	for ( $root_counter = $counted; $root_counter <= $number_of_fields; $root_counter += 1) {

	template_hook("pages/admin/custom.template.php", "14");

	}

	template_hook("pages/admin/custom.template.php", "15");

	}

	template_hook("pages/admin/custom.template.php", "16");

}

template_hook("pages/admin/custom.template.php", "end");
?>