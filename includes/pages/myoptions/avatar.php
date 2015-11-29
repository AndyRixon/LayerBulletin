<?php

/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By LayerBulletin Team
|   (c) 2014 LayerBulletin Team
|   http://layerbulletin.com/
|   ========================================
|   avatar.php - form for uploading avatar
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/myoptions/avatar.template.php", "start");

if($_GET['success']=='saved'){
	template_hook("pages/myoptions/avatar.template.php", "successSaved");
}

if ($_POST['token_id']!=''){

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);

$token_name = "token_avatar_$token_id";

if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

$avatar=$_POST['avatar'];
$avatar=escape_string($avatar);

mysql_query("UPDATE {$db_prefix}members SET avatar='$avatar', remote_avatar='1' WHERE id='$my_id'");

// attempt to remove the old avatar...

$query2121 = "select FILENAME from {$db_prefix}attachments WHERE POSTID='0' AND MEMBER='$my_id'" ;
$result2121 = mysql_query($query2121) or die("uploader.php - Error in query: $query2121") ;                                  
while ($results2121 = mysql_fetch_array($result2121)){
$filename = $results2121['FILENAME'];

foreach (glob("avatar/$filename") as $filename_original) {
   unlink($filename_original);
}

foreach (glob("avatar/t_$filename") as $filename_thumb) {
   unlink($filename_thumb);
}

mysql_query("DELETE FROM {$db_prefix}attachments WHERE filename ='$filename'");

}

	template_hook("pages/myoptions/avatar.template.php", "form");

	lb_redirect("index.php?page=myoptions&act=avatar&success=saved","myoptions/avatar/success/saved");
 
}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}

}
else{

$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_avatar_$token_id";

$_SESSION[$token_name] = $token;

$query2 = "select AVATAR, REMOTE_AVATAR from {$db_prefix}members WHERE ID='$my_id'" ;
$result2 = mysql_query($query2) or die("header.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
	$avatar = $results2['AVATAR'];
	$remote_avatar = $results2['REMOTE_AVATAR'];
}

	if ($remote_avatar =='0'){
		$avatar = $lb_domain."/".$avatar;
	}

// Get hash for temporary ID
$hash=time();

template_hook("pages/myoptions/avatar.template.php", "1");

}

template_hook("pages/myoptions/avatar.template.php", "end");

?>