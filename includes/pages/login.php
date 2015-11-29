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
|   login.php - login script
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/login.template.php", "start");

if (!empty($lb_name)){
	header("HTTP/1.0 200 OK");
	header("Location: $lb_domain");
}

if ($_POST['name']==''){

$referer = escape_string($_SERVER['HTTP_REFERER']);
$referer = str_replace("&amp;", "&", $referer);

$pos = strpos($referer, "$lb_domain/index.php?page=error");
if ($pos !== false){
	$referer = "";
}

$pos = strpos($referer, "$lb_domain/error");
if ($pos !== false){
	$referer = "";
}

$pos = strpos($referer, "$lb_domain/offline");
if ($pos !== false){
	$referer = "";
}

$pos = strpos($referer, "$lb_domain/index.php?page=offline");
if ($pos !== false){
	$referer = "";
}

$pos = strpos($referer, "$lb_domain/myoptions/password");
if ($pos !== false){
	$referer = "";
}

$pos = strpos($referer, "$lb_domain/index.php?page=myoptions&act=password");
if ($pos !== false){
	$referer = "";
}

$pos = strpos($referer, "$lb_domain/error/12");
if ($pos !== false){
	$referer = "$lb_domain/messages";
}

$pos = strpos($referer, "$lb_domain/index.php?page=error&error=12");
if ($pos !== false){
	$referer = "$lb_domain/index.php?page=messages&act=inbox";
}

	/*
	Don't redirect back to installer after installation.
*/

	if (strpos($referer, $lb_domain . '/install.php') !== false)
	{
		$referer = '';
	}

	/*
	Don't redirect back to register after registration.
*/

	if ( (strpos($referer, $lb_domain . '/index.php?page=register') !== false) || (strpos($referer, $lb_domain . '/register') !== false) )
	{
		$referer = '';
	}

	/*
	Don't redirect back to verification notice after complete verification.
*/

	if ( (strpos($referer, $lb_domain . '/index.php?page=verify') !== false) || (strpos($referer, $lb_domain . '/verify') !== false) )
	{
		$referer = '';
	}

$pos = strpos($referer, "$lb_domain");
if ($pos === false){
	$referer = "";
}

$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_login_$token_id";

$_SESSION[$token_name] = $token;

template_hook("pages/login.template.php", "1");

}
else{

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);

$token_name = "token_login_$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){


$name=$_POST['name'];
$password=$_POST['password'];
$referer=$_POST['referer'];

$name = escape_string($name);
$password = escape_string($password);
$referer = escape_string($referer);

$query1 = "select PASS_SALT from {$db_prefix}members WHERE NAME='$name'" ;
$result1 = mysql_query($query1) or die("username.php - Error in query: $query1") ;                               
$pass_salt = mysql_result($result1, 0);

// Salt the password
$password= md5($password . $pass_salt);


$query = "select ID from {$db_prefix}members WHERE name='$name' AND password='$password'" ;
$result = mysql_query($query) or die("login.php - Error in query: $query") ;                                  
$members = mysql_num_rows($result);

if ($members=='1'){

if ($_POST['remember']!=''){
setcookie("lb_name", $name, time() +31536000);
setcookie("lb_password", $password, time() +31536000);
}
else{
setcookie("lb_name", $name);
setcookie("lb_password", $password);
}
header("HTTP/1.0 200 OK");
if($referer!=''){
$referer = preg_replace('/\\s+/', '', $referer); 
header("Location: $referer");
}
else{
header("Location: $lb_domain");
}
exit;
}
else{

	lb_redirect("index.php?page=error&error=33","error/33");

}
}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}

template_hook("pages/login.template.php", "end");
?>
