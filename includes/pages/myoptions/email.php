<?php
/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By LayerBulletin Team
|   (c) 2014 LayerBulletin Team
|   http://layerbulletin.com/
|   ========================================
|   email.php - change email address
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/myoptions/email.template.php", "start");

if($_GET['success']=='saved') {
	template_hook("pages/myoptions/email.template.php", "successChanged");
}

if ($_POST['email']!=''){

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);

$token_name = "token_email_$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

$email=$_POST['email'];
$email=escape_string($email);

mysql_query("UPDATE {$db_prefix}members SET email='$email' WHERE id='$my_id'");

	template_hook("pages/myoptions/email.template.php", "form");

	lb_redirect("index.php?page=myoptions&act=email&success=saved","myoptions/email/success/saved");


}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}

}
else{


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_email_$token_id";

$_SESSION[$token_name] = $token;

$query2 = "select ID, EMAIL, PASSWORD from {$db_prefix}members WHERE ID='$my_id'" ;
$result2 = mysql_query($query2) or die("email.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$id = $results2['ID'];
$email = $results2['EMAIL'];
$password = $results2['PASSWORD'];

template_hook("pages/myoptions/email.template.php", "2");

}
}

template_hook("pages/myoptions/email.template.php", "end");

?>