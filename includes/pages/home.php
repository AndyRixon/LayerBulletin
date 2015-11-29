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
|   home.php - Selects pages to include
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/home.template.php", "start");

template_hook("pages/home.template.php", "1");

if ($_GET['action']=='vote'){
if (file_exists("themes/$theme/includes/forums/vote.php")){
include "themes/$theme/includes/forums/vote.php";
}
else{
include "includes/forums/vote.php";
}
}
elseif ($_GET['func']=='newpost'){
if (file_exists("themes/$theme/includes/forums/newpost.php")){
include "themes/$theme/includes/forums/newpost.php";
}
else{
include "includes/forums/newpost.php";
}
}

elseif ($_GET['func']=='addreply'){
if (file_exists("themes/$theme/includes/forums/addreply.php")){
include "themes/$theme/includes/forums/addreply.php";
}
else{
include "includes/forums/addreply.php";
}
}

elseif ($_GET['func']=='edit'){
if (file_exists("themes/$theme/includes/forums/edit.php")){
include "themes/$theme/includes/forums/edit.php";
}
else{
include "includes/forums/edit.php";
}
}

elseif ($_GET['func']=='split'){
if (file_exists("themes/$theme/includes/forums/split.php")){
include "themes/$theme/includes/forums/split.php";
}
else{
include "includes/forums/split.php";
}
}

elseif ($_GET['func']=='merge'){
if (file_exists("themes/$theme/includes/forums/merge.php")){
include "themes/$theme/includes/forums/merge.php";
}
else{
include "includes/forums/merge.php";
}
}

elseif ($_GET['func']=='del'){
if (file_exists("themes/$theme/includes/forums/delete.php")){
include "themes/$theme/includes/forums/delete.php";
}
else{
include "includes/forums/delete.php";
}
}

elseif ($_GET['func']=='lock'){
if (file_exists("themes/$theme/includes/forums/lock.php")){
include "themes/$theme/includes/forums/lock.php";
}
else{
include "includes/forums/lock.php";
}
}

elseif ($_GET['func']=='unlock'){
if (file_exists("themes/$theme/includes/forums/unlock.php")){
include "themes/$theme/includes/forums/unlock.php";
}
else{
include "includes/forums/unlock.php";
}
}

elseif ($_GET['func']=='markread'){
if (file_exists("themes/$theme/includes/forums/markread.php")){
include "themes/$theme/includes/forums/markread.php";
}
else{
include "includes/forums/markread.php";
}
}
elseif ($_GET['func']=='move'){
if (file_exists("themes/$theme/includes/forums/move.php")){
include "themes/$theme/includes/forums/move.php";
}
else{
include "includes/forums/move.php";
}
}

elseif ($_GET['func'] == 'revert')
{
	if (file_exists($lb_root . 'themes/' . $theme . '/includes/forums/revert.php'))
	{
		require_once $lb_root . 'themes/' . $theme . '/includes/forums/revert.php';
	}
	else
	{
		require_once $lb_root . 'includes/forums/revert.php';
	}
}

elseif ($_GET['forum']!=''){
if (file_exists("themes/$theme/includes/forums/board.php")){
include "themes/$theme/includes/forums/board.php";
}
else{
include "includes/forums/board.php";
}
}


elseif ($_GET['topic']!=''){
if (file_exists("themes/$theme/includes/forums/topic.php")){
include "themes/$theme/includes/forums/topic.php";
}
else{
include "includes/forums/topic.php";
}
}

else{
if (file_exists("themes/$theme/includes/forums/index.php")){
include "themes/$theme/includes/forums/index.php";
}
else{
include "includes/forums/index.php";
}
if (file_exists("themes/$theme/includes/forums/online.php")){
include "themes/$theme/includes/forums/online.php";
}
else{
include "includes/forums/online.php";
}
}

template_hook("pages/home.template.php", "end");

?>