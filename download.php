<?php

@ini_set('allow_url_fopen', 1);
@ini_set('zlib.output_compression', 1);
ob_start();

// only pages with LB_RUN defined can be run
	define("LB_RUN", 1);

// gather database information
	include "includes/config.php";

// make the database_prefix global so all scripts can use it
	global $db_prefix;

// is LB_RUN defined?
	if (!defined('LB_RUN')){
		echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
		exit();
	}

// call the functions	
	include "scripts/php/functions.php";


$my_address="http://".$_SERVER['HTTP_HOST']."".$_SERVER['PHP_SELF'];

$lb_domain 	= str_replace('/download.php', '', $my_address); 	// returns http://myforum.com/forum style address

	
// Can this member download this file?

	$attach					=	escape_string($_GET['attach']);
	$original_filename		=	escape_string($_GET['filename']);
	
	// echo "$original_filename";

	$sql="SELECT POSTID FROM {$db_prefix}attachments WHERE row = '$attach' AND original_filename = '$original_filename' LIMIT 1";
	$sql_result = mysql_query($sql) or die ("download.php - Error in query: $sql");
	$postid = mysql_result($sql_result, 0);

	$role="0";

	$name		=	escape_string($_COOKIE['lb_name']);
	$password	=	escape_string($_COOKIE['lb_password']);

	$sql="SELECT ROLE FROM {$db_prefix}members WHERE name = '$name' AND PASSWORD = '$password'";
	$sql_result = mysql_query($sql) or die ("download.php - Error in query: $sql");
	$role = mysql_result($sql_result, 0);

	if($role=='0'){
		$role="4";
	}

	$sql="SELECT FORUM_ID FROM {$db_prefix}posts WHERE id = '$postid'";
	$sql_result = mysql_query($sql) or die ("download.php - Error in query: $sql");
	$forum_id = mysql_result($sql_result, 0);

	$can_download_attachment="0";

	$query3 = "select CAN_DOWNLOAD_ATTACHMENT from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;
	$result3 = mysql_query($query3) or die("download.php - Error in query: $query3") ;                                  
	$can_download_attachment = mysql_result($result3, 0);

	if ($can_download_attachment=='1'){

		mysql_query("UPDATE {$db_prefix}attachments SET downloads=downloads+1 WHERE row = '$attach' AND original_filename = '$original_filename'");

		$sql="SELECT FILENAME FROM {$db_prefix}attachments WHERE row = '$attach' AND original_filename = '$original_filename' LIMIT 1";
		$sql_result = mysql_query($sql) or die ("download.php - Error in query: $sql");
		$filename = mysql_result($sql_result, 0);
		
		header("HTTP/1.0 200 OK");
		header("Location: $lb_domain/uploads/attachments/$filename");
		exit;
		mysql_free_result($sql_result);
		mysql_close();

	}
	else{
	
		header("HTTP/1.0 200 OK");
		header("Location: $lb_domain/index.php?page=error&error=23");
		exit;
		mysql_free_result($sql_result);
		mysql_close();

	}
	
ob_flush();

?>