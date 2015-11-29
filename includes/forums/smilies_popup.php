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
|   smilies_popup.php - displays smilies and their code
*/

define("LB_RUN", 1);

include "../config.php";
include "../../scripts/php/functions.php";

// set lb variables

$my_address="http://".$_SERVER['HTTP_HOST']."".$_SERVER['PHP_SELF'];

$lb_domain 	= str_replace('/includes/forums/smilies_popup.php', '', $my_address); 	// returns http://myforum.com/forum style address

global $db_prefix;

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

$smilies_count_alt="";

$query2 = "select THEME, BOARD_LANG from {$db_prefix}settings" ;
$result2 = mysql_query($query2) or die("structure.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$theme = $results2['THEME'];
$board_lang = $results2['BOARD_LANG'];
}

if (isset($_COOKIE['lb_theme'])){
$member_selected_theme=escape_string($_COOKIE['lb_theme']);
}

if(isset($_COOKIE['lb_name'])){
$lb_name=escape_string($_COOKIE['lb_name']);

}

if(isset($_COOKIE['lb_password'])){
$password=escape_string($_COOKIE['lb_password']);
}

if (isset($lb_name)){

$query_theme = "select THEME, BOARD_LANG from {$db_prefix}members WHERE NAME='$lb_name' AND PASSWORD='$password'" ;
$result_theme = mysql_query($query_theme) or die("structure.php - Error in query: $query_theme") ;                                  
while ($results_theme = mysql_fetch_array($result_theme)){
$member_selected_theme = $results_theme['THEME'];
$member_lang = $results_theme['BOARD_LANG'];
}

}

// select language to use...

		if (isset($member_lang) && $member_lang!=''){
			$board_lang="$member_lang";
		}
		
		if (isset($_COOKIE['lb_lang']) && (!isset($_COOKIE['lb_name']))){
			$board_lang = escape_string($_COOKIE['lb_lang']);
		}

include "../../lang/$board_lang/lang_forum.php";

// check theme is available to use,,,,

$query_theme = "select THEME_NAME from {$db_prefix}themes WHERE THEME_NAME='$member_selected_theme'" ;
$result_theme = mysql_query($query_theme) or die("structure.php - Error in query: $query_theme") ;                                  
$check_theme = mysql_num_rows($result_theme);

if ($check_theme!='0' && $member_selected_theme!=''){
	$theme = $member_selected_theme;
}

$theme_strip=str_replace("%20"," ",$theme);


$template_hook="1";
if (file_exists("../../themes/$theme/templates/includes/forums/smilies_popup.template.php")){
include "../../themes/$theme/templates/includes/forums/smilies_popup.template.php";
}
else{
include "../../templates/includes/forums/smilies_popup.template.php";
}


// Get smilies and relevant code...
// then display them in the smilie dialog box...

if (file_exists("../../themes/$theme/images/forums/emoticons")){
$query211 = "select CODE, LINK from {$db_prefix}smilies WHERE EMOTICON_ON='1' AND THEME='$theme' ORDER BY ROW desc" ;

$path="../../themes/$theme/images/forums/emoticons";

}
else{
$query211 = "select CODE, LINK from {$db_prefix}smilies WHERE EMOTICON_ON='1' AND THEME='default' ORDER BY ROW desc" ;

$path="../../images/forums/emoticons";

}

$result211 = mysql_query($query211) or die("smilies_popup.php - Error in query: $query211") ;                                  
while ($results211 = mysql_fetch_array($result211)){
$code = $results211['CODE'];
$link = $results211['LINK'];

$code=htmlentities($code);

	$smilies_count_alt=$smilies_count_alt+1;

	$check_odd = checkNum($smilies_count_alt);

	if ($check_odd===TRUE){
		$alt_td_class="";
	}
	else{
		$alt_td_class="-alt";	
	}

$template_hook="2";
if (file_exists("../../themes/$theme/templates/includes/forums/smilies_popup.template.php")){
include "../../themes/$theme/templates/includes/forums/smilies_popup.template.php";
}
else{
include "../../templates/includes/forums/smilies_popup.template.php";
}

}



$template_hook="3";
if (file_exists("../../themes/$theme/templates/includes/forums/smilies_popup.template.php")){
include "../../themes/$theme/templates/includes/forums/smilies_popup.template.php";
}
else{
include "../../templates/includes/forums/smilies_popup.template.php";
}

?>