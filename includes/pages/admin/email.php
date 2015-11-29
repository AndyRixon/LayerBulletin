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
|   email.php - Mass Email Members
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/admin/email.template.php", "start");

if ($can_change_forum_settings=='0'){

	lb_redirect("index.php?page=error&error=11","error/11");

}


else{

if ($_POST['form']!=''){

// Send the email...

$token_id = escape_string($_POST['token_id']);

$token_name = "token_admin_email_$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name] && isset($_POST['email_group'])){

$email_group=implode(",",$_POST['email_group']);
$email_group=escape_string($email_group);

$query212 = "select EMAIL, NAME from {$db_prefix}members WHERE ROLE IN($email_group) AND ALLOW_ADMIN_EMAIL='1' ORDER BY ROLE" ;
$result212 = mysql_query($query212) or die("email.php - Error in query: $query212") ;                                  
while ($results212 = mysql_fetch_array($result212)){
$member_email = strip_slashes($results212['EMAIL']);
$member_name = strip_slashes($results212['NAME']);

$outgoing=$member_email;
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= "From: $site_name <$board_email>\r\n";
$subject="Message from $site_name";

$message = wordwrap(nl2br(stripslashes($_POST['content'])),70);

$message = "Dear $member_name,<br /><br />" . $message. "<br /><br />Regards,<br />$site_name Administrators<br />($lb_domain)";

mail($outgoing, $subject, $message, $headers);

}

template_hook("pages/admin/email.template.php", "4");

}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}

else{


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_admin_email_$token_id";

$_SESSION[$token_name] = $token;

template_hook("pages/admin/email.template.php", "1");

$query211 = "select GROUP_ID, GROUP_NAME from {$db_prefix}groups WHERE GROUP_ID!='4' ORDER BY CAN_CHANGE_SITE_SETTINGS desc, CAN_CHANGE_FORUM_SETTINGS desc, GROUP_NAME desc" ;
$result211 = mysql_query($query211) or die("topic.php - Error in query: $query211") ;                                  
while ($results211 = mysql_fetch_array($result211)){
$group_id = strip_slashes($results211['GROUP_ID']);
$group_name = strip_slashes($results211['GROUP_NAME']);

template_hook("pages/admin/email.template.php", "2");

}

template_hook("pages/admin/email.template.php", "3");

}

}

template_hook("pages/admin/email.template.php", "end");
?>