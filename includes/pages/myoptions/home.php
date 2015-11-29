<?php

/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By LayerBulletin Team
|   (c) 2014 LayerBulletin Team
|   http://layerbulletin.com/
|   ========================================
|   home.php - main My Options page
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/myoptions/home.template.php", "start");

if($_GET['success']=="saved") {
	template_hook("pages/myoptions/home.template.php", "successSaved");
}

if ($_POST['form']!=''){

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);

$token_name = "token_home_$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

$content=$_POST['content'];
$content=escape_string($content);

// Update it...
mysql_query("UPDATE {$db_prefix}members SET whiteboard='$content' WHERE id='$my_id'");

	template_hook("pages/myoptions/home.template.php", "form");

	lb_redirect("index.php?page=myoptions&success=saved","myoptions/success/saved");

}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}
else{


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_home_$token_id";

$_SESSION[$token_name] = $token;

$query2 = "select WHITEBOARD from {$db_prefix}members WHERE ID='$my_id'" ;
$result2 = mysql_query($query2) or die("home.php - Error in query: $query2") ;                                  
$content = mysql_result($result2, 0);

$content=strip_slashes($content);
$content=str_replace("<br />","",$content);

template_hook("pages/myoptions/home.template.php", "1");

}

template_hook("pages/myoptions/home.template.php", "end");
?>