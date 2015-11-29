<?php

/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By LayerBulletin Team
|   (c) 2014 LayerBulletin Team
|   http://layerbulletin.com/
|   ========================================
|   password.php - change member password
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/myoptions/password.template.php", "start");

if($_GET['success']=='saved'){
	template_hook("pages/myoptions/password.template.php", "successSaved");
}

$query1 = "select ID, PASSWORD, PASSWORD_TIME, PASS_SALT from {$db_prefix}members WHERE ID='$my_id'" ;
$result1 = mysql_query($query1) or die("username.php - Error in query: $query1") ;                                 
while ($results1 = mysql_fetch_array($result1)){
$current = $results1['PASSWORD'];
$password_time = $results1['PASSWORD_TIME'];
$pass_salt = $results1['PASS_SALT'];
}

$new_pass_time=time();


if ($_POST['password']!=''){

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);
$token_name = "token_password_$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

$pass= md5($_POST['pass'] . $pass_salt); // current password

// Generate salt...
$salt = substr(md5(uniqid(rand(), true)), 0, 9);

$password= md5($_POST['password'] . $salt);
$check_password= md5($_POST['password'] . $pass_salt); // entered NEW password with database salt

if($check_password == $current){ // first check if posted NEW password = current password.

template_hook("pages/myoptions/password.template.php", "1");

}
elseif($pass != $current){
	lb_redirect("index.php?page=error&error=38","error/38");
}
else{ // second, check if posted current password does not equal current password.

mysql_query("UPDATE {$db_prefix}members SET password='$password', password_time='$new_pass_time', pass_salt='$salt' WHERE id='$my_id'");

	template_hook("pages/myoptions/password.template.php", "form");
	setcookie("lb_password", $password, time() +31536000);
	lb_redirect("index.php?page=myoptions&act=password&success=saved","myoptions/password/success/saved");

}
}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}
else{


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_password_$token_id";

$_SESSION[$token_name] = $token;

$current_password_time= $password_time + ((60*60*24)*$change_pass_time);

template_hook("pages/myoptions/password.template.php", "3");

}

template_hook("pages/myoptions/password.template.php", "end");

?>