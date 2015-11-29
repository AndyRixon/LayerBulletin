<?php

/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By LayerBulletin Team
|   (c) 2014 LayerBulletin Team
|   http://layerbulletin.com/
|   ========================================
|   signature.php - change member forum signature
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/myoptions/signature.template.php", "start");

if($_GET['success']=='saved'){
	template_hook("pages/myoptions/signature.template.php", "successSaved");
}

if ($can_use_sig=='0'){

	lb_redirect("index.php?page=error&error=19","error/19");

}

elseif ($_POST['form']!=''){

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);

$token_name = "token_signature_$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

$signature=$_POST['signature'];
$signature=escape_string($signature);


mysql_query("UPDATE {$db_prefix}members SET signature='$signature' WHERE id='$my_id'");

	template_hook("pages/myoptions/signature.template.php", "form");

	lb_redirect("index.php?page=myoptions&act=signature&success=saved","myoptions/signature/success/saved");

}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}
else{


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_signature_$token_id";

$_SESSION[$token_name] = $token;

$query2 = "select ID, SIGNATURE from {$db_prefix}members WHERE ID='$my_id'" ;
$result2 = mysql_query($query2) or die("username.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$id = $results2['ID'];
$signature = $results2['SIGNATURE'];

$signature=strip_slashes($signature);
$signature=str_replace("<br />","",$signature);

$content = $signature;

// BB Parse...
if (file_exists("themes/$theme/scripts/php/parse.php")){
	include "themes/$theme/scripts/php/parse.php";
}
else{
	include "scripts/php/parse.php";				
}

template_hook("pages/myoptions/signature.template.php", "3");

}
}

template_hook("pages/myoptions/signature.template.php", "end");

?>