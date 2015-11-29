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
|   preview.php - preview post before submitting
*/

define('LB_RUN', 1);

# Hide all errors
error_reporting(0);

# Send header to correctly set the charset to utf-8
header('Content-type: text/html;charset=utf-8'); 

	/*
	Check if magic quotes are enabled
	'feature' is deprecated in PHP 5.3 & removed in PHP 6
*/

	if (version_compare(PHP_VERSION, '6.0.0', '<'))
	{
		ini_set('magic_quotes_runtime', 0);
	}

// set lb variables

$my_address="http://".$_SERVER['HTTP_HOST']."".$_SERVER['PHP_SELF'];

$lb_domain 	= str_replace('/includes/forums/preview.php', '', $my_address); 	// returns http://myforum.com/forum style address
$lb_root		= str_replace('includes/forums/preview.php', '', __FILE__);		// returns /home/account/{account}/path/to/forum style address

if (!file_exists($lb_root . 'scripts/php/functions.php'))
{
	$lb_root = str_replace('includes\forums\preview.php', '', __FILE__);	
}

require_once $lb_root . 'includes/config.php';
require_once $lb_root . 'scripts/php/functions.php';

	/*
	Load classes & create objects
*/

	require_once $lb_root . 'includes/objects/cache.php';
	$Cache = new cache($lb_root, $db_prefix);
	
	require_once $lb_root . 'includes/objects/plugin.php';
	$Plugin = new plugin($lb_root, $Cache);

$lb_name	=	escape_string($_COOKIE['lb_name']);

$subject = $_POST['subject'];
$subject = strip_slashes($subject);
$subject = stripslashes($subject);

if ($subject==''){
$subject="&nbsp;";
}

$content = $_POST['content'];

$content = str_replace("<br />", "&lt;br /&gt;", $content);

// Protect against XSS correctly
$_POST['content'] = htmlentities($content, ENT_QUOTES, 'UTF-8');

$query2 = "select THEME, ALLOW_ATTACHMENTS, SEF_URLS, BOARD_LANG from {$db_prefix}settings" ;
$result2 = mysql_query($query2) or die("header.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$allow_attachments = $results2['ALLOW_ATTACHMENTS'];
$sef_urls = $results2['SEF_URLS'];
$board_lang = $results2['BOARD_LANG'];
$theme = $results2['THEME'];
}

if (isset($_COOKIE['lb_theme'])){
$member_selected_theme=escape_string($_COOKIE['lb_theme']);
}

if (isset($lb_name)){

$query_theme = "select THEME, ROLE, BOARD_LANG from {$db_prefix}members WHERE NAME='$lb_name'" ;
$result_theme = mysql_query($query_theme) or die("structure.php - Error in query: $query_theme") ;                                  
while ($results_theme = mysql_fetch_array($result_theme)){
$member_selected_theme = $results_theme['THEME'];
$member_group = $results_theme['ROLE'];
$member_lang = $results_theme['BOARD_LANG'];
}

// check theme is available to use,,,,

$query_theme = "select THEME_NAME from {$db_prefix}themes WHERE THEME_NAME='$member_selected_theme'" ;
$result_theme = mysql_query($query_theme) or die("structure.php - Error in query: $query_theme") ;                                  
$check_theme = mysql_num_rows($result_theme);

if ($check_theme!='0' && $member_selected_theme!=''){
	$theme = $member_selected_theme;
}
}
else{
$member_group="4";
}

$can_use_html="0"; // set default

$query2 = "select CAN_USE_HTML from {$db_prefix}groups WHERE GROUP_ID='$member_group'" ;
$result2 = mysql_query($query2) or die("structure.php - Error in query: $query2"); 
while ($results2 = mysql_fetch_array($result2)){
$can_use_html = $results2['CAN_USE_HTML'];  
}                               

// select language to use...

		if (isset($member_lang) && $member_lang!=''){
			$board_lang="$member_lang";
		}
		
		if (isset($_COOKIE['lb_lang']) && (!isset($_COOKIE['lb_name']))){
			$board_lang = escape_string($_COOKIE['lb_lang']);
		}

include $lb_root . 'lang/' . $board_lang . '/lang_forum.php';		
include $lb_root . 'scripts/php/image_check.php';

if (file_exists($lb_root . 'themes/' . $theme . '/scripts/php/parse.php'))
{
	include $lb_root . 'themes/' . $theme . '/scripts/php/parse.php';
}
else
{
	include $lb_root . 'scripts/php/parse.php';				
}

template_hook('forums/preview.template.php', 1);

?>