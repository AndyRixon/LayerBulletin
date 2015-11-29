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
|   warn.php - warn members page
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/warn.template.php", "start");

if ($can_warn_members=='0'){
	lb_redirect("index.php?page=error&error=17","error/17");
}
else{
// if the form has been submitted..
if ($_POST['content']!=''){

$member=$_POST['member'];
$member=escape_string($member);

$content=$_POST['content'];
$content=escape_string($content);

$action=$_POST['action'];
$action=escape_string($action);

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);

$token_name = "token_warn_$member$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

if ($action=='add'){

mysql_query("UPDATE {$db_prefix}members SET warn_level=warn_level+1 WHERE id='$member'");
}
else{

mysql_query("UPDATE {$db_prefix}members SET warn_level=warn_level-1 WHERE id='$member'");
}

// Now add the warn stuff to the database to keep a record...
$time=time();

	mysql_query("INSERT INTO {$db_prefix}warn (member, notes, warned_by, action, date) VALUES ('$member', '$content', '$my_id', '$action', '$time')");

template_hook("pages/warn.template.php", "1");

	template_hook("pages/warn.template.php", "form");

	lb_redirect("index.php?page=members&id=$member","index.php?page=members&id=$member");

}
else{
 	lb_redirect("index.php?page=error&error=28","error/28");
}
}
// write a reason for the warning..
else{


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$id=$_GET['id'];
$id=escape_string($id);

$token_name = "token_warn_$id$token_id";

$_SESSION[$token_name] = $token;

$act=$_GET['act'];
$act=escape_string($act);

$query_member_stuff = "select WARN_LEVEL from {$db_prefix}members WHERE ID='$id'" ;
$result_member_stuff = mysql_query($query_member_stuff) or die("warn.php - Error in query: $query_member_stuff") ;
$secure = mysql_num_rows ($result_member_stuff);                                  
while ($results_member_stuff = mysql_fetch_array($result_member_stuff)){
$warn_level = $results_member_stuff['WARN_LEVEL'];


if ($max_warn_level <= $warn_level && $act=='add'){
template_hook("pages/warn.template.php", "3");
}

elseif($warn_level=='0' && $act=='minus'){
template_hook("pages/warn.template.php", "3");
}

elseif($my_id==$id){
template_hook("pages/warn.template.php", "4");
}

else{
template_hook("pages/warn.template.php", "2");
}

}
}
}

template_hook("pages/warn.template.php", "end");

?>