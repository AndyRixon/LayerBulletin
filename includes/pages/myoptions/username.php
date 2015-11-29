<?php

/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By LayerBulletin Team
|   (c) 2014 LayerBulletin Team
|   http://layerbulletin.com/
|   ========================================
|   username.php - change member username
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/myoptions/username.template.php", "start");

if($_GET['success']=='saved'){
	template_hook("pages/myoptions/username.template.php", "successChanged");
}

if ($can_change_own_name=='0'){

	lb_redirect("index.php?page=error&error=21","error/21");

}
elseif ($_POST['username']!=''){

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);

$token_name = "token_username_$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

$username=$_POST['username'];
$username=escape_string($username);

$query2 = "select NAME from {$db_prefix}members WHERE NAME='$username'" ;
$result2 = mysql_query($query2) or die("username.php - Error in query: $query2") ;                                  
$count_names = mysql_num_rows($result2);

if ($count_names!='0'){

	lb_redirect("index.php?page=error&error=37","error/37");

}

$original_name=$_POST['original_name'];
$original_name=escape_string($original_name);

$email=$_POST['email'];
$email=escape_string($email);

mysql_query("UPDATE {$db_prefix}members SET name='$username' WHERE id='$my_id'");
setcookie("lb_name", $username, time() +31536000);

	$lang['email_members_name_title'] = str_replace("<%sitename>", $site_name, $lang['email_members_name_title']);

	$lang['email_members_name_content'] = str_replace("<%oldname>", $original_name, $lang['email_members_name_content']);	
	$lang['email_members_name_content'] = str_replace("<%subscriber>", $username, $lang['email_members_name_content']);
	$lang['email_members_name_content'] = str_replace("<%sitename>", $site_name, $lang['email_members_name_content']);
	$lang['email_members_name_content'] = str_replace("<%site>", $lb_domain, $lang['email_members_name_content']);

$message=$lang['email_members_name_content'];
$outgoing="$email";
$from="From: $site_name <$board_email>\r\n";
$subject=$lang['email_members_name_title'];
mail($outgoing, $subject, $message, $from);

	template_hook("pages/myoptions/username.template.php", "form");

	lb_redirect("index.php?page=myoptions&act=username&success=saved","myoptions/username/success/saved");

}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}
else{


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_username_$token_id";

$_SESSION[$token_name] = $token;

$query2 = "select ID, NAME, EMAIL from {$db_prefix}members WHERE ID='$my_id'" ;
$result2 = mysql_query($query2) or die("username.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$id = $results2['ID'];
$name = $results2['NAME'];
$email = $results2['EMAIL'];

$email=strip_slashes($email);

template_hook("pages/myoptions/username.template.php", "2");

}
}

template_hook("pages/myoptions/username.template.php", "end");

?>