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
|   smilies_insert.php - Converts smiley code to graphical emoticons
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

// Get smilies and relevant code...
// then display them in the smilie dialog box...

if (file_exists("themes/$theme/images/forums/emoticons")){
$query_smiley = "select CODE, LINK from {$db_prefix}smilies WHERE EMOTICON_ON='1' AND CODE!='' AND LINK!='' AND THEME='$theme' ORDER BY ROW desc" ;

$smiley_path="themes/$theme/images/forums/emoticons";

}
else{
$query_smiley = "select CODE, LINK from {$db_prefix}smilies WHERE EMOTICON_ON='1' AND CODE!='' AND LINK!='' AND THEME='default' ORDER BY ROW desc" ;

$smiley_path="images/forums/emoticons";

}

$formID = ($formID != '') ? $formID : 'postcontent';
$areaID = ($areaID != '') ? $areaID : 'content';

$result_smiley = mysql_query($query_smiley) or die("smilies_insert.php - Error in query: $query_smiley") ;                                  
while ($results_smiley = mysql_fetch_array($result_smiley)){
$smiley_code = $results_smiley['CODE'];
$smiley_link = $results_smiley['LINK'];

$smiley_code=htmlentities($smiley_code);


$template_hook="1";
if (file_exists("themes/$theme/templates/includes/forums/smilies_insert.template.php")){
include "themes/$theme/templates/includes/forums/smilies_insert.template.php";
}
else{
include "templates/includes/forums/smilies_insert.template.php";
}

}
?>