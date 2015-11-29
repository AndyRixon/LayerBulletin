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
|   register.php - shows registration page
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/register.template.php", "start");

if ($_COOKIE['lb_name']!='' && $_COOKIE['lb_password']!='')
	lb_redirect("index.php?page=error&error=40","error/40");

require_once "scripts/php/captcha/recaptchalib.php";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;


if ($guest_register=='0'){

	lb_redirect("index.php?page=error&error=16","error/16");

}
else{

if (($_POST['form']=='' && $_POST['agree']!='') OR ($_GET['error']!='')){


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_register_$token_id";

$_SESSION[$token_name] = $token;

# Maximum characters for username
$lang['register_username_length'] = sprintf($lang['register_username_length'], $username_length);

template_hook("pages/register.template.php", "1");

if($recaptcha_public!='' && $recaptcha_private!=''){
template_hook("pages/register.template.php", "recaptcha");
}
else{
template_hook("pages/register.template.php", "captcha");
}
template_hook("pages/register.template.php", "5");

}

elseif ($_POST['form']!=''){

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);

$token_name = "token_register_$token_id";

if($recaptcha_public!='' && $recaptcha_private!=''){
	$resp = recaptcha_check_answer ($recaptcha_private,
	                                  $_SERVER["REMOTE_ADDR"],
	                                  $_POST["recaptcha_challenge_field"],
	                                  $_POST["recaptcha_response_field"]);
}

if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){


if(($_SESSION['security_code'] == $_POST['security_code']) && (!empty($_SESSION['security_code'])) ) {
	$pass_captcha="1";
}
elseif($recaptcha_public!='' && $recaptcha_private!='' && $resp->is_valid){
	$pass_captcha="1";
}
else{
	$pass_captcha="0";
}

if ($pass_captcha=='1'){


$name = $_POST['name'];

	/*
	Name checks.
*/

	if (!preg_match('|^[a-zA-Z0-9!@#$%^&*();:_.\\\\ /\t-]+$|', $name) ) {

		lb_redirect("index.php?page=error&error=32","error/32");

	}
	
	if (strlen($name) > $username_length)
	{
		template_hook('pages/register.template.php', 'form_7');
		lb_redirect('index.php?page=register&error=7', 'register/7');
		exit;
	}

// do the spamcheck...

$spam_name = escape_string($name);
$spam_email = escape_string($email);
$spam_address = escape_string($_SERVER['REMOTE_ADDR']);

$check_spam = checkspam($spam_name, $spam_email, $spam_address);

if ($check_spam=='true'){

	lb_redirect("index.php?page=error&error=34","error/34");

}

// if it passes the check... let's continue...

$name = escape_string($name);

$email = $_POST['email'];
$email = escape_string($email);


$pos = strrpos($name, "'");
if ($pos === false) {

// Check username isn't taken...

$query = "select NAME from {$db_prefix}members WHERE NAME='$name'" ;
$result = mysql_query($query) or die("register.php - Error in query: $query") ;                                  
$members_clash = mysql_num_rows($result);

// Check email isn't taken...

$query_email = "select EMAIL from {$db_prefix}members WHERE EMAIL='$email'" ;
$result_email = mysql_query($query_email) or die("register.php - Error in query: $query") ;                                  
$email_clash = mysql_num_rows($result_email);

if ($members_clash>='1'){

	template_hook("pages/register.template.php", "form_1");

	lb_redirect("index.php?page=register&error=2","register/2");

}
elseif($_POST['name']==''){

	template_hook("pages/register.template.php", "form_2");

	lb_redirect("index.php?page=register&error=1","register/1");

}
elseif($_POST['password']==''){

	template_hook("pages/register.template.php", "form_3");

	lb_redirect("index.php?page=register&error=3","register/3");

}

elseif($email_clash >= '1'){

	template_hook("pages/register.template.php", "form_4");

	lb_redirect("index.php?page=register&error=6","register/6");

}

elseif($_POST['email']==''){

	template_hook("pages/register.template.php", "form_5");

	lb_redirect("index.php?page=register&error=4","register/4");

}

$name =$_POST['name'];
$name = escape_string($name);

$email =$_POST['email'];
$email = escape_string($email);

$password = $_POST['password'];
$password = escape_string($password);

// Generate salt...
$salt = substr(md5(uniqid(mt_rand(), true)), 0, 9);

// Salt the password
$password= md5($password . $salt);

$register_date=time();

mysql_query("INSERT INTO {$db_prefix}members (name, password, email, role, register_date, password_time, pass_salt) VALUES ('$name', '$password', '$email', '3', '$register_date', '$register_date', '$salt')");

$sql="SELECT PASS_SALT FROM {$db_prefix}members WHERE name = '$name'";
$sql_result = mysql_query($sql) or die ("download.php - Error in query: $sql");
while($row = mysql_fetch_array($sql_result)) {
    $hash_id = $row['PASS_SALT'];
    $hash_id=md5($hash_id);
}

	/*
	Modules may want to do something straight after registration...
*/

	if ($code = $Plugin->hook('register', 'register_done'))
	{
		eval($code);
	}

$lang['register_email_verify'] = str_replace("<%board_email>", $default_board_email, $lang['register_email_verify']);

template_hook("pages/register.template.php", "2");

	$lang['email_register_title'] = str_replace("<%sitename>", $site_name, $lang['email_register_title']);
	
	$lang['email_register_content'] = str_replace("<%subscriber>", $name, $lang['email_register_content']);
	$lang['email_register_content'] = str_replace("<%password>", $_POST['password'], $lang['email_register_content']);
	$lang['email_register_content'] = str_replace("<%sitename>", $site_name, $lang['email_register_content']);	
	$lang['email_register_content'] = str_replace("<%site>", $lb_domain, $lang['email_register_content']);
	$lang['email_register_content'] = str_replace("<%hash>", $hash_id, $lang['email_register_content']);	

$message=$lang['email_register_content'];

$outgoing=$_POST['email'];
$headers="From: $site_name <$board_email>\r\n";
$headers.="Content-type: text/plain; charset=UTF-8;\r\n";
$subject=$lang['email_register_title'];

mail($outgoing, $subject, $message, $headers);

}
else{

template_hook("pages/register.template.php", "3");

}

unset($_SESSION['security_code']);
}
else {
	template_hook("pages/register.template.php", "form_6");
	$_SESSION['session_name']=$_POST['name'];
	$_SESSION['session_email']=$_POST['email'];
	lb_redirect("index.php?page=register&error=5","register/5");
}
}
else{
	lb_redirect("index.php?page=error&error=28","error/28");
}
}

else{

template_hook("pages/register.template.php", "4");

}

}

template_hook("pages/register.template.php", "end");
?>
