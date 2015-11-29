<?php

/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By LayerBulletin Team
|   (c) 2014 LayerBulletin Team
|   http://layerbulletin.com/
|   ========================================
|   style.php - change forum theme
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/myoptions/style.template.php", "start");

if($_GET['success']=='saved') {
	template_hook("pages/myoptions/style.template.php", "successChanged");
}

if ($can_change_style=='0'){

	lb_redirect("index.php?page=error&error=20","error/20");

}

elseif ($_POST['theme']!=''){


$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);

$token_name = "token_style_$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

$theme=escape_string($_POST['theme']);
$theme=str_replace("%20"," ",$theme);

mysql_query("UPDATE {$db_prefix}members SET theme='$theme' WHERE id='$my_id'");

	template_hook("pages/myoptions/style.template.php", "form");

	lb_redirect("index.php?page=myoptions&act=style&success=saved","myoptions/style/success/saved");

}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}
else{


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_style_$token_id";

$_SESSION[$token_name] = $token;

$query2 = "select THEME from {$db_prefix}members WHERE ID='$my_id'" ;
$result2 = mysql_query($query2) or die("style.php - Error in query: $query2") ;                                  
$theme = mysql_result($result2, 0);

$query2 = "select DISPLAY_NAME from {$db_prefix}themes WHERE THEME_NAME='$theme'" ;
$result2 = mysql_query($query2) or die("style.php - Error in query: $query2") ;                                  
$theme_name = mysql_result($result2, 0);

template_hook("pages/myoptions/style.template.php", "2");
}

template_hook("pages/myoptions/style.template.php", "end");

?>