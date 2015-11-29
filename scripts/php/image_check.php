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
|   image_check.php - checks images to use on forum exist in theme
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

// Select path for images

$header_left_img		=	image_check("pages/header-left.png");

$key_img				=	image_check("buttons/key.png");
$zip_icon_img			=	image_check("forums/zip_icon.png");
$locked_forum_img		=	image_check("forums/locked_forum.png");
$redirect_forum_img		=	image_check("forums/redirect_forum.png");
$topic_read_img			= 	image_check("forums/topic_read.png");

$topic_unread_img		=	image_check("forums/topic_unread.png");
$rss_img				=	image_check("forums/rss.png");

$pinned_read_img		=	image_check("forums/pinned_read.png");
$pinned_unread_img		=	image_check("forums/pinned_unread.png");

$read_img				=	image_check("forums/topic_read.png");
$unread_img				=	image_check("forums/topic_unread.png");
$read_hot_img			=	image_check("forums/read_hot.png");
$unread_hot_img			=	image_check("forums/unread_hot.png");
$topic_locked_img		=	image_check("forums/topic_locked.png");

$poll_icon_img			=	image_check("forums/poll_icon.png");
$topic_read_img			=	image_check("forums/topic_read.png");
$forum_stats_img		=	image_check("forums/forum_stats.png");
$whos_online_img		=	image_check("forums/whos_online.png");

$emoticon_path_two		=	image_check("forums/emoticons");
$vote_img				=	image_check("forums/vote.png");
$results_img			=	image_check("forums/results.png");
$poll_left_img			=	image_check("forums/poll_left.png");
$poll_middle_img		=	image_check("forums/poll_middle.png");

$poll_right_img			=	image_check("forums/poll_right.png");
$trackback_img			=	image_check("forums/trackback.png");

$delete_icon_img		=	image_check("forums/delete-icon.png");
$comments_img			=	image_check("forums/comments.png");

$edit_icon_img			=	image_check("forums/edit-icon.png");
$new_post_img			=	image_check("forums/new_post.png");
$email_img				=	image_check("forums/email.png");

$minus_img				=	image_check("pages/minus.png");
$plus_img				=	image_check("pages/plus.png");
$comments_img			=	image_check("forums/comments.png");

$home_img				=	image_check("pages/home.png");

$attach_img				=	image_check("forums/attach.gif");

$pip_img				=	image_check("members/pip.png");
$message_read_img		=	image_check("messages/message_read.png");
$message_new_img		=	image_check("messages/message_new.png");

$default_avatar			=	image_check("members/default_avatar.png");

$info_img				=	image_check("pages/information.png");

$groups_1_img			=	image_check("groups/gold_star.png");
$groups_2_img			=	image_check("groups/group.png");
$groups_3_img			=	image_check("groups/information.png");
$groups_4_img			=	image_check("groups/lightbulb.png");
$groups_5_img			=	image_check("groups/lightning.png");
$groups_6_img			=	image_check("groups/money.png");
$groups_7_img			=	image_check("groups/shield.png");
$groups_8_img			=	image_check("groups/silver_star.png");
$groups_9_img			=	image_check("groups/star.png");
$groups_10_img			=	image_check("groups/user_suit.png");

// Select path to folders

$emoticon_path			=	folder_check("forums/emoticons");
$flag_path				=	folder_check("flags");

?>