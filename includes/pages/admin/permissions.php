<?php
/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By LayerBulletin Team
|   (c) 2014 LayerBulletin Team
|   http://layerbulletin.com/
|   ========================================
|   permissions.php - set up forum permissions
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/admin/permissions.template.php", "start");

if ($can_change_forum_settings=='0'){

	lb_redirect("index.php?page=error&error=11","error/11");

}

else{

$id=escape_string($_GET['id']);

if ($_POST['forum_id']!=''){

$forum_id = escape_string($_POST['forum_id']);

$token_id = $_POST['token_id'];
$token_id = escape_string($token_id);

$token_name = "token_permissions_$forum_id$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

// Check the info exists, if so we update it...
// (by the way, this is complicated! Observe...)

	// Get all group_id's...

		$query2 = "select GROUP_ID from {$db_prefix}groups ORDER BY group_id asc" ;
		$result2 = mysql_query($query2) or die("permissions.php - Error in query: $query2") ;                                  
		while ($results2 = mysql_fetch_array($result2)){
		$group_id = $results2['GROUP_ID'];

$can_view_forum="can_view_forum"."$group_id";
$can_view_forum=escape_string($_POST[$can_view_forum]);

$can_read_topics="can_read_topics"."$group_id";
$can_read_topics=escape_string($_POST[$can_read_topics]);

$can_add_topics="can_add_topics"."$group_id";
$can_add_topics=escape_string($_POST[$can_add_topics]);

$can_reply_topics="can_reply_topics"."$group_id";
$can_reply_topics=escape_string($_POST[$can_reply_topics]);

$can_add_attachment="can_add_attachment"."$group_id";
$can_add_attachment=escape_string($_POST[$can_add_attachment]);

$can_download_attachment="can_download_attachment"."$group_id";
$can_download_attachment=escape_string($_POST[$can_download_attachment]);


	// Now check if that group_id is in the permissions table...

		$query3 = "select GROUP_ID from {$db_prefix}permissions WHERE GROUP_ID='$group_id' AND forum_id='$forum_id'" ;
		$result3 = mysql_query($query3) or die("permissions.php - Error in query: $query3");
		$in_permissions=mysql_num_rows($result3);


			// If it IS in there, update it...
				if ($in_permissions!='0'){

					mysql_query("UPDATE {$db_prefix}permissions SET can_view_forum='$can_view_forum', can_read_topics='$can_read_topics', can_add_topics='$can_add_topics', can_reply_topics='$can_reply_topics', can_add_attachment='$can_add_attachment', can_download_attachment='$can_download_attachment' WHERE group_id='$group_id' AND forum_id='$forum_id'");
				}

			// Otherwise, insert the info...
				else{
mysql_query("INSERT INTO {$db_prefix}permissions (group_id, forum_id, can_view_forum, can_read_topics, can_add_topics, can_reply_topics, can_add_attachment, can_download_attachment) VALUES ('$group_id', '$forum_id', '$can_view_forum', '$can_read_topics', '$can_add_topics', '$can_reply_topics', '$can_add_attachment', '$can_download_attachment')");
				}

		}                            
// Now redirect...

	template_hook("pages/admin/permissions.template.php", "form");

	if($_POST['success']=="new"){
		lb_redirect("index.php?page=admin&act=categories&success=added","admin/categories/success/added");
	}else{
		lb_redirect("index.php?page=admin&act=categories&success=updated_permission","admin/categories/success/updated_permission");
	}

}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}
else{


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$forum_id = escape_string($_GET['id']);

$token_name = "token_permissions_$forum_id$token_id";

$_SESSION[$token_name] = $token;

$query2 = "select NAME from {$db_prefix}categories WHERE ID='$id'" ;
$result2 = mysql_query($query2) or die("permissions.php - Error in query: $query2") ;                                  
$name = strip_slashes(mysql_result($result2, 0));

template_hook("pages/admin/permissions.template.php", "2");

$array_can_view_forum="0";

$query2 = "select GROUP_ID from {$db_prefix}groups ORDER BY can_change_site_settings desc, can_change_forum_settings desc, group_id desc" ;
$result2 = mysql_query($query2) or die("permissions.php - Error in query: $query2") ; 
while ($results2 = mysql_fetch_array($result2)){
$group_id = $results2['GROUP_ID'];

$array_can_view_forum="can_view_forum$array_can_view_forum,can_view_forum$group_id";
$array_can_read_topics="can_read_topics$array_can_read_topics,can_read_topics$group_id";
$array_can_add_topics="can_add_topics$array_can_add_topics,can_add_topics$group_id";
$array_can_reply_topics="can_reply_topics$array_can_reply_topics,can_reply_topics$group_id";
if ($group_id != 4) $array_can_add_attachment="can_add_attachment$array_can_add_attachment,can_add_attachment$group_id";
$array_can_download_attachment="can_download_attachment$array_can_download_attachment,can_download_attachment$group_id";
}

$array_can_view_forum="$array_can_view_forum,can_view_forum0";
$array_can_add_topics="$array_can_add_topics,can_add_topics0";
$array_can_read_topics="$array_can_read_topics,can_read_topics0";
$array_can_reply_topics="$array_can_reply_topics,can_reply_topics0";
$array_can_add_attachment="$array_can_add_attachment,can_add_attachment0";
$array_can_download_attachment="$array_can_download_attachment,can_download_attachment0";

// Set out the headers

template_hook("pages/admin/permissions.template.php", "3");

// Now list the groups, along with permissions...

$query2 = "select GROUP_ID, GROUP_NAME, GROUP_COLOR from {$db_prefix}groups ORDER BY can_change_site_settings desc, can_change_forum_settings desc, group_id desc" ;
$result2 = mysql_query($query2) or die("permissions.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$group_id = $results2['GROUP_ID'];
$group_name = strip_slashes($results2['GROUP_NAME']);
$group_color = strip_slashes($results2['GROUP_COLOR']);

template_hook("pages/admin/permissions.template.php", "4");

$query3 = "select CAN_VIEW_FORUM, CAN_READ_TOPICS, CAN_ADD_TOPICS, CAN_REPLY_TOPICS, CAN_ADD_ATTACHMENT, CAN_DOWNLOAD_ATTACHMENT from {$db_prefix}permissions WHERE GROUP_ID='$group_id' AND FORUM_ID='$id'" ;
$result3 = mysql_query($query3) or die("permissions.php - Error in query: $query3") ;                                  
while ($results3 = mysql_fetch_array($result3)){
$can_view_forum = $results3['CAN_VIEW_FORUM'];
$can_read_topics = $results3['CAN_READ_TOPICS'];
$can_add_topics = $results3['CAN_ADD_TOPICS'];
$can_reply_topics = $results3['CAN_REPLY_TOPICS'];
$can_add_attachment = $results3['CAN_ADD_ATTACHMENT'];
$can_download_attachment = $results3['CAN_DOWNLOAD_ATTACHMENT'];
}

template_hook("pages/admin/permissions.template.php", "5");

}

template_hook("pages/admin/permissions.template.php", "6");

}

}

template_hook("pages/admin/permissions.template.php", "end");
?>
