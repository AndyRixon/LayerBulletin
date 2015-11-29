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
|   password.php - generates new password if user forgets it
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/password.template.php", "start");

if ($_POST['email']==''){


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_password_$token_id";

$_SESSION[$token_name] = $token;

template_hook("pages/password.template.php", "1");

}
else{

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);

$token_name = "token_password_$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

$name=$_POST['name'];
$email=$_POST['email'];

$name = escape_string($name);
$email = escape_string($email);


$query = "select ID from {$db_prefix}members WHERE name='$name' AND email='$email'" ;
$result = mysql_query($query) or die("login.php - Error in query: $query") ;
$members = mysql_num_rows($result);
$members_id = mysql_result($result, 0);                             

if ($members=='1'){

$new_password = createRandomPassword();

template_hook("pages/password.template.php", "2");

	$lang['email_password_title'] = str_replace("<%sitename>", $site_name, $lang['email_password_title']);
	
	$lang['email_password_content'] = str_replace("<%subscriber>", $name, $lang['email_password_content']);
	$lang['email_password_content'] = str_replace("<%password>", $new_password, $lang['email_password_content']);
	$lang['email_password_content'] = str_replace("<%site>", $lb_domain, $lang['email_password_content']);
	$lang['email_password_content'] = str_replace("<%sitename>", $site_name, $lang['email_password_content']);
	
$message=$lang['email_password_content'];
$outgoing="$email";
$from="From: $site_name <$board_email>\r\n";
$subject=$lang['email_password_title'];
mail($outgoing, $subject, $message, $from);

// Generate salt...
$salt = substr(md5(uniqid(rand(), true)), 0, 9);

// Salt the password
$new_password= md5($new_password . $salt);

$new_pass_time=time();

mysql_query("UPDATE {$db_prefix}members SET password='$new_password', password_time='$new_pass_time', pass_salt='$salt' WHERE id='$members_id'");

}

else{

template_hook("pages/password.template.php", "3");

}
}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}

template_hook("pages/password.template.php", "end");
?>