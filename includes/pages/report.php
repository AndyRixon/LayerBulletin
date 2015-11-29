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
|   report.php - Report a post page
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/report.template.php", "start");

if ($_POST['content']!=''){

$post=$_POST['post'];
$post=escape_string($post);

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);

$token_name = "token_report_$post$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

$content=$_POST['content'];
$content=escape_string($content);

mysql_query("INSERT INTO {$db_prefix}report (post, content, reported_by) VALUES ('$post', '$content', '$my_id')");

mysql_query("UPDATE {$db_prefix}posts SET reported='1' WHERE id='$post'");

template_hook("pages/report.template.php", "1");

	lb_redirect("index.php?page=findpost&post=$post","findpost/$post");

}
else{
	lb_redirect("index.php?page=error&error=28","error/28");
}
}

else{


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$post=$_GET['post'];
$post=escape_string($post);

$token_name = "token_report_$post$token_id";

$_SESSION[$token_name] = $token;

template_hook("pages/report.template.php", "2");

}

template_hook("pages/report.template.php", "end");
?>