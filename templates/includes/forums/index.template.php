<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
		<!-- Show the forums header and rows -->
		<table class="forum-board-forum-head" cellspacing="0" cellpadding="0">
			<tr>
				<td class="forum-topic-subject">
				<?php if ($show_rss=='1'){ ?>
				<a href="<?php echo "$lb_domain"; ?>/rss/rss.php?forum=all" target="_blank"><img  src="<?php echo "$rss_img"; ?>" alt="<?php echo $lang['board_rss']; ?>" title="<?php echo $lang['board_rss']; ?>" /></a>&nbsp;&nbsp;
				<?php } ?>

				<a class="forum-header" href="<?php echo lb_link("index.php?forum=$parent_id", "forum/$forum_title-$parent_id"); ?>"><?php echo "$parent_name"; ?></a></td>
				<td class="forum-topic-subscribe"><a class="forum-header" href="javascript:setstate('forum<?php echo "$parent_id"; ?>');">&#177;</a></td>
			</tr>
		</table>
		
<?php if ($_COOKIE[$forum_state]=='0'){ ?>
		<table class="forum-index" id="forum<?php echo "$parent_id"; ?>" style="display: none;" cellpadding="0" cellspacing="0">
<?php }else{ ?>
		<table class="forum-index" id="forum<?php echo "$parent_id"; ?>" style="display: table;" cellpadding="0" cellspacing="0">
<?php } ?>
			<tr>
				<td class="forum-index-td-left-sub">&nbsp;</td>				
				<td class="forum-index-td-middle-sub"><?php echo $lang['board_forum']; ?></td>
				<td class="forum-index-td-topics-sub"><?php echo $lang['board_topics']; ?></td>
				<td class="forum-index-td-posts-sub"><?php echo $lang['board_posts']; ?></td>
				<td class="forum-index-td-right-sub"><?php echo $lang['board_lastpost']; ?></td>
			</tr>
<?php } elseif ($template_hook=='2'){ ?>
			<tr>
				<!-- show forum icon -->
                <td class="forum-index-td-left<?php echo "$alt_td_class"; ?>">
<?php } elseif ($template_hook=='3'){ ?>
<?php if ($redirect_url != '') { ?>
					<img  src="<?php echo "$redirect_forum_img"; ?>" alt="<?php echo $lang['board_forum_new_no']; ?>" title="<?php echo $redirect_url; ?>" />
<?php } else { ?>
					<img  src="<?php echo "$topic_read_img"; ?>" alt="<?php echo $lang['board_forum_new_no']; ?>" title="<?php echo $lang['board_forum_new_no']; ?>" />
<?php } ?>
<?php } elseif ($template_hook=='4'){ ?>
<?php if ($redirect_url != '') { ?>
					<img  src="<?php echo "$redirect_forum_img"; ?>" alt="<?php echo $lang['board_forum_locked']; ?>" title="<?php echo $redirect_url; ?>" />
<?php } elseif ($rows=='0'){ if ($read_only=='1'){ ?>
					<img  src="<?php echo "$topic_locked_img"; ?>" alt="<?php echo $lang['board_forum_locked']; ?>" title="<?php echo $lang['board_forum_locked']; ?>" />
<?php }}elseif ($rows!='0'){ if ($read_only=='1'){ ?>
					<img  src="<?php echo "$topic_locked_img"; ?>" alt="<?php echo $lang['board_forum_locked']; ?>" title="<?php echo $lang['board_forum_locked']; ?>" />
<?php } elseif ($unread_posts=='0'){ ?>
					<img  src="<?php echo "$topic_read_img"; ?>" alt="<?php echo $lang['board_forum_new_no']; ?>" title="<?php echo $lang['board_forum_new_no']; ?>" />
<?php } elseif ($unread_posts!='0'){ ?>
					<img  src="<?php echo "$topic_unread_img"; ?>" alt="<?php echo $lang['board_forum_new']; ?>" title="<?php echo $lang['board_forum_new']; ?>" />
<?php } } ?>
				</td>
				<!-- show forum name and description -->
				<td class="forum-index-td-middle<?php echo "$alt_td_class"; ?>">
					<a class="forum-name-link" href="<?php echo lb_link("index.php?forum=$forum_id", "forum/$forum_title-$forum_id"); ?>"><strong><?php echo "$forum_name"; ?></strong></a><br /><?php echo "$forum_description"; ?>
<?php  if ($count_sub!='0'){ ?>
					<br /><br /><?php echo $lang['board_subforums']; ?>
<?php } ?>
<?php } elseif ($template_hook=='5'){ ?>
<?php if ($count_sub_forums==$count_sub){ ?>
					<!-- show sub-forums -->
					&nbsp;<a class="subforum-name-link" href="<?php echo lb_link("index.php?forum=$sub_id", "forum/$forum_title-$sub_id"); ?>"><?php echo "$sub_name"; ?></a>
<?php } else{ $count_sub_forums=$count_sub_forums+1; ?>
					&nbsp;<a class="subforum-name-link" href="<?php echo lb_link("index.php?forum=$sub_id", "forum/$forum_title-$sub_id"); ?>"><?php echo "$sub_name"; ?></a>, 
<?php }} elseif ($template_hook=='6'){ ?>
				</td>
				<!-- number of topics -->
<?php if ($redirect_url != '') { ?>
				<td class="forum-index-td-topics<?php echo "$alt_td_class"; ?>">-</td>
<?php } else { ?>
				<td class="forum-index-td-topics<?php echo "$alt_td_class"; ?>"><?php echo "$topics"; ?></td>
<?php } ?>
				<!-- number of posts -->
<?php if ($redirect_url != '') { ?>
				<td class="forum-index-td-posts<?php echo "$alt_td_class"; ?>">-</td>
<?php } else { ?>
				<td class="forum-index-td-posts<?php echo "$alt_td_class"; ?>"><?php echo "$posts"; ?></td>
<?php } ?>
				<!-- post information -->
				<td class="forum-index-td-right<?php echo "$alt_td_class"; ?>">
<?php if ($redirect_url != '') { ?>
-
<?php } else { ?>
<?php echo "$time"; ?><br />
<?php if ($can_read_topics=='0'){ ?>
					<?php echo $lang['board_topic_in']; ?> <?php echo $lang['board_topic_restricted']; ?><br />
<?php } else{ ?>
					<?php echo $lang['board_topic_in']; ?> <a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=findpost&post=$id", "findpost/$id"); ?>"><?php echo "$title"; ?></a><br />
<?php } ?>
					<?php echo $lang['board_topic_by']; ?> 	
<?php if ($name=='' && $title != ''){ ?>
					<?php echo $lang['board_topic_unregistered']; ?>
<?php } else{ ?>
					<?php echo member_link($member, '0'); ?>
<?php }} ?>
<?php } elseif ($template_hook=='7'){ ?>
				</td>
			</tr>
<?php } elseif ($template_hook=='8'){ ?>
	<!-- forum footer -->
		</table>
<?php } elseif ($template_hook=='9'){ ?>
<?php if ($_COOKIE['lb_name']!=''){ ?>
	<!-- mark all topics read -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-index-stats-sub">
					<a class="forum-header mark-read" href="<?php echo lb_link("index.php?func=markread", "markread"); ?>"><?php echo $lang['index_markread']; ?></a>
				</td>
			</tr>
		</table>
<?php } ?>
<?php }elseif ($template_hook=='end'){ ?>	
<?php } ?>
