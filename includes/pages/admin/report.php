<?php
/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By LayerBulletin Team
|   (c) 2014 LayerBulletin Team
|   http://layerbulletin.com/
|   ========================================
|   report.php - admin options for reported posts
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/admin/report.template.php", "start");

if($_GET['success']=="reviewed"){
	template_hook("pages/admin/report.template.php", "successReviewed");
}

if ($can_change_forum_settings=='0'){

	lb_redirect("index.php?page=error","error");

}

else{

if ($_GET['id']!=''){

$id	=	escape_string($_GET['id']);

$query2 = "select POST from {$db_prefix}report WHERE ID='$id' ORDER BY ID desc" ;
$result2 = mysql_query($query2) or die("report.php - Error in query: $query2") ;                                  
$post = strip_slashes(mysql_result($result2, 0));

mysql_query("DELETE FROM {$db_prefix}report WHERE id ='$id'");

mysql_query("UPDATE {$db_prefix}posts SET reported='0' WHERE id='$post'");

	template_hook("pages/admin/report.template.php", "form");

	lb_redirect("index.php?page=admin&act=report&success=reviewed","admin/report/success/reviewed");

}
else{

template_hook("pages/admin/report.template.php", "2");

$query2 = "select ID, POST, CONTENT, REPORTED_BY from {$db_prefix}report WHERE ACTION_TAKEN='0' ORDER BY ID desc" ;
$result2 = mysql_query($query2) or die("report.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$id = strip_slashes($results2['ID']);
$post = strip_slashes($results2['POST']);
$content = strip_slashes($results2['CONTENT']);
$reported_by = strip_slashes($results2['REPORTED_BY']);

$query9 = "select NAME from {$db_prefix}members WHERE ID='$reported_by'" ;
$result9 = mysql_query($query9) or die("report.php - Error in query: $query9") ;                                  
$name = strip_slashes(mysql_result($result9, 0));

template_hook("pages/admin/report.template.php", "3");

}

template_hook("pages/admin/report.template.php", "4");

}

}

template_hook("pages/admin/report.template.php", "end");
?>