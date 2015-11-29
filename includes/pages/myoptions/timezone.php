<?php

/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By LayerBulletin Team
|   (c) 2014 LayerBulletin Team
|   http://layerbulletin.com/
|   ========================================
|   timezone.php - change forum timezone
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/myoptions/timezone.template.php", "start");

if($_GET['success']=='saved'){
	template_hook("pages/myoptions/timezone.template.php", "successSaved");
}

if ($_POST['time_offset']!=''){

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);

$token_name = "token_timezone_$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

$time_offset=$_POST['time_offset'];
$time_offset=escape_string($time_offset);

mysql_query("UPDATE {$db_prefix}members SET time_offset='$time_offset' WHERE id='$my_id'");

	template_hook("pages/myoptions/timezone.template.php", "form");

	lb_redirect("index.php?page=myoptions&act=timezone&success=saved","myoptions/timezone/success/saved");

}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}
else{


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_timezone_$token_id";

$_SESSION[$token_name] = $token;

$query2 = "select ID, TIME_OFFSET from {$db_prefix}members WHERE ID='$my_id'" ;
$result2 = mysql_query($query2) or die("timezone.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$id = $results2['ID'];
$timezone = $results2['TIME_OFFSET'];
}

$server_time = time() - ($time_offset * 60 * 60);
$server_time = format_date($server_time, '%A, %b %d, %Y %R');

$my_time = time();
$my_time = format_date($my_time, '%A, %b %d, %Y %R');

template_hook("pages/myoptions/timezone.template.php", "2");

$start_time = time() - 43200;
$start_time_value = "-12";

while($start_time_value!="14"){

$time_offset="0";
$formatted_start_time = format_date($start_time, '%A, %d %b %Y (%H:%M)');

template_hook("pages/myoptions/timezone.template.php", "time");

$start_time = $start_time + 1800;
$start_time_value = $start_time_value + 0.5;

}

template_hook("pages/myoptions/timezone.template.php", "aftertime");

}

template_hook("pages/myoptions/timezone.template.php", "end");

?>