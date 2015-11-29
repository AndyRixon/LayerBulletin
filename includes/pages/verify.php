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
|   verify.php - verify membership page
|   DO NOT REDISTRIBUTE THE CONTENTS OF THIS SCRIPT
+--------------------------------------------------------------------------
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/verify.template.php", "start");

if ($_GET['id']!=''){
$hash_id=$_GET['id'];
$hash_id=escape_string($hash_id);

mysql_query("UPDATE {$db_prefix}members SET verified = '1' WHERE md5(pass_salt) = '$hash_id'");

$sql="SELECT ID, NAME FROM {$db_prefix}members WHERE md5(pass_salt) = '$hash_id'";
$sql_result = mysql_query($sql) or die ("download.php - Error in query: $sql");
while($row = mysql_fetch_array($sql_result)) {
	$new_id = $row['ID'];
    $name= $row['NAME'];
}

mysql_query("UPDATE {$db_prefix}settings SET stats_member_id='$new_id', stats_member_name='$name', stats_members=stats_members+1");


template_hook("pages/verify.template.php", "1");

}

else{

$lang['verify_failed'] = str_replace("<%board_email>", $default_board_email, $lang['verify_failed']);

template_hook("pages/verify.template.php", "2");

}

template_hook("pages/verify.template.php", "end");
?>