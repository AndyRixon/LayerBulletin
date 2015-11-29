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
|   header.php - displays header and sets out global variables
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

function location_page($part){

global $location_name, $board_lang, $db_prefix;

include "lang/$board_lang/lang_forum.php";

if ($part=='header'){

if (isset($_GET['page'])){

// Format the pages they are viewing...
if (isset($_GET['page']) && $_GET['page']=='upgrade'){
$location_name=$lang['location_upgrade'];
}
elseif (isset($_GET['page']) && $_GET['page']=='list' && $_GET['list']=='members'){
$location_name=$lang['location_member'];
}
elseif (isset($_GET['page']) && $_GET['page']=='list' && $_GET['list']!='members'){
$location_name=$lang['location_list'];
}
elseif (isset($_GET['page']) && $_GET['page']=='blocked'){
$location_name=$lang['location_blocked'];
}
elseif (isset($_GET['page']) && $_GET['page']=='suspended'){
$location_name=$lang['location_suspended'];
}
elseif (isset($_GET['page']) && $_GET['page']=='admin'){
$location_name=$lang['location_admin'];
}
elseif (isset($_GET['page']) && $_GET['page']=='login'){
$location_name=$lang['location_login'];
}
elseif (isset($_GET['page']) && $_GET['page']=='members'){
$location_name=$lang['location_members'];
}
elseif (isset($_GET['page']) && $_GET['page']=='warn'){
$location_name=$lang['location_warn'];
}
elseif (isset($_GET['page']) && $_GET['page']=='messages'){
$location_name=$lang['location_messages'];
}
elseif (isset($_GET['page']) && $_GET['page']=='myoptions'){
$location_name=$lang['location_myoptions'];
}
elseif (isset($_GET['page']) && $_GET['page']=='register'){
$location_name=$lang['location_register'];
}
elseif (isset($_GET['page']) && $_GET['page']=='search'){
$location_name=$lang['location_search'];
}
elseif (isset($_GET['page']) && $_GET['page']=='error'){
$location_name=$lang['location_error'];
}
elseif (isset($_GET['page']) && $_GET['page']=='banned'){
$location_name=$lang['location_banned'];
}
elseif (isset($_GET['page']) && $_GET['page']=='report'){
$location_name=$lang['location_report'];
}

elseif (isset($_GET['page']) && $_GET['page']=='help'){
$location_name=$lang['location_help'];
}

elseif (isset($_GET['page'])){
$location_name="Powered By LayerBulletin";
}

}

elseif(isset($_GET['forum'])){
$location_name=$location_name;
}

elseif(isset($_GET['topic'])){
$location_name=$location_name;
}

elseif(isset($_GET['func'])){

if (isset($_GET['func']) && $_GET['func']=='addreply'){
$location_name=$lang['location_addreply'];
}
elseif (isset($_GET['func']) && $_GET['func']=='edit'){
$location_name=$lang['location_edit'];
}
elseif (isset($_GET['func']) && $_GET['func']=='move'){
$location_name=$lang['location_move'];
}
elseif (isset($_GET['func']) && $_GET['func']=='merge'){
$location_name=$lang['location_merge'];
}
elseif (isset($_GET['func']) && $_GET['func']=='split'){
$location_name=$lang['location_split'];
}
elseif (isset($_GET['func']) && $_GET['func']=='newpost'){
$location_name=$lang['location_newpost'];
}

}

else{
$location_name="Powered By LayerBulletin";
}

return $location_name;

}

if ($part=='breadcrumbs'){

if (isset($_GET['page'])){

// Format the pages they are viewing...
if (isset($_GET['page']) && $_GET['page']=='upgrade'){
$location_name=$lang['location_upgrade'];
}
elseif (isset($_GET['page']) && $_GET['page']=='list' && $_GET['list']=='members'){
$location_name=$lang['location_member'];
}
elseif (isset($_GET['page']) && $_GET['page']=='list' && $_GET['list']!='members'){
$location_name=$lang['location_list'];
}
elseif (isset($_GET['page']) && $_GET['page']=='blocked'){
$location_name=$lang['location_blocked'];
}
elseif (isset($_GET['page']) && $_GET['page']=='suspended'){
$location_name=$lang['location_suspended'];
}
elseif (isset($_GET['page']) && $_GET['page']=='admin'){
$location_name=$lang['location_admin'];
}
elseif (isset($_GET['page']) && $_GET['page']=='login'){
$location_name=$lang['location_login'];
}
elseif (isset($_GET['page']) && $_GET['page']=='members'){
$location_name=$lang['location_members'];
}
elseif (isset($_GET['page']) && $_GET['page']=='warn'){
$location_name=$lang['location_warn'];
}
elseif (isset($_GET['page']) && $_GET['page']=='messages'){
$location_name=$lang['location_messages'];
}
elseif (isset($_GET['page']) && $_GET['page']=='myoptions'){
$location_name=$lang['location_myoptions'];
}
elseif (isset($_GET['page']) && $_GET['page']=='register'){
$location_name=$lang['location_register'];
}
elseif (isset($_GET['page']) && $_GET['page']=='search'){
$location_name=$lang['location_search'];
}
elseif (isset($_GET['page']) && $_GET['page']=='error'){
$location_name=$lang['location_error'];
}
elseif (isset($_GET['page']) && $_GET['page']=='banned'){
$location_name=$lang['location_banned'];
}
elseif (isset($_GET['page']) && $_GET['page']=='report'){
$location_name=$lang['location_report'];
}

elseif (isset($_GET['page']) && $_GET['page']=='help'){
$location_name=$lang['location_help'];
}

}

elseif(isset($_GET['func'])){

if (isset($_GET['func']) && $_GET['func']=='addreply'){
$location_name=$lang['location_addreply'];
}
elseif (isset($_GET['func']) && $_GET['func']=='edit'){
$location_name=$lang['location_edit'];
}
elseif (isset($_GET['func']) && $_GET['func']=='move'){
$location_name=$lang['location_move'];
}
elseif (isset($_GET['func']) && $_GET['func']=='merge'){
$location_name=$lang['location_merge'];
}
elseif (isset($_GET['func']) && $_GET['func']=='split'){
$location_name=$lang['location_split'];
}
elseif (isset($_GET['func']) && $_GET['func']=='newpost'){
$location_name=$lang['location_newpost'];
}

}

else{
$location_name="";
}

return $location_name;

}

elseif($part=='list'){

global $location_page;

if ($location_page=='upgrade'){
$location_page_text=$lang['location_l_upgrade'];
}
elseif ($location_page=='addreply'){
$location_page_text=$lang['location_l_addreply'];
}
elseif ($location_page=='list'){
$location_page_text=$lang['location_l_list'];
}
elseif ($location_page=='blocked'){
$location_page_text=$lang['location_l_blocked'];
}
elseif ($location_page=='suspended'){
$location_page_text=$lang['location_l_suspended'];;
}
elseif ($location_page=='move'){
$location_page_text=$lang['location_l_move'];;
}
elseif ($location_page=='merge'){
$location_page_text=$lang['location_l_merge'];;
}
elseif ($location_page=='split'){
$location_page_text=$lang['location_l_split'];
}
elseif ($location_page=='admin'){
$location_page_text=$lang['location_l_admin'];
}
elseif ($location_page=='login'){
$location_page_text=$lang['location_l_login'];
}
elseif ($location_page=='members'){

$location_page_text=$lang['location_l_members'];

}
elseif ($location_page=='warn'){
$location_page_text=$lang['location_l_warn'];
}
elseif ($location_page=='messages'){
$location_page_text=$lang['location_l_messages'];;
}
elseif ($location_page=='myoptions'){
$location_page_text=$lang['location_l_myoptions'];;
}
elseif ($location_page=='newpost'){
$location_page_text=$lang['location_l_newpost'];;
}
elseif ($location_page=='register'){
$location_page_text=$lang['location_l_register'];
}
elseif ($location_page=='search'){
$location_page_text=$lang['location_l_search'];
}
elseif ($location_page=='error'){
$location_page_text=$lang['location_l_error'];
}
elseif ($location_page=='banned'){
$location_page_text=$lang['location_l_banned'];
}
elseif ($location_page=='report'){
$location_page_text=$lang['location_l_report'];
}
elseif ($location_page=='index'){
$location_page_text=$lang['location_l_index'];
}
elseif ($location_page=='help'){
$location_page_text=$lang['location_l_help'];
}


else{
$location_page_text=$lang['location_l_index'];
}

return $location_page_text;

}

}

?>