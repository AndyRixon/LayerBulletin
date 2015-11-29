<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>	
		<!-- show forum rules/announcement -->
		<table class="forum-jump" cellpadding="0" cellspacing="0">
			<tr><td class="forum-jump-content">
				<?php echo "$forum_rules"; ?>
			</td></tr>
		</table>
		<div class="spacer">&nbsp;</div>
<?php }elseif ($template_hook=='2'){ ?>	
	<!-- prepare the table for sub-forums -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang['board_sub_forums']; ?></td></tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-index-td-left-sub"></td>
				<td class="forum-index-td-middle-sub"><?php echo $lang['board_forum']; ?></td>
				<td class="forum-index-td-topics-sub"><?php echo $lang['board_topics']; ?></td>
				<td class="forum-index-td-posts-sub"><?php echo $lang['board_posts']; ?></td>
				<td class="forum-index-td-right-sub"><?php echo $lang['board_lastpost']; ?></td>
			</tr>
<?php } elseif ($template_hook=='3'){ ?>
		<!-- now show the sub-forum details -->
			<tr>
				<td class="forum-index-td-left<?php echo "$alt_td_class"; ?>">
<?php if ($redirect_url!=''){ ?>
					<img src="<?php echo "$redirect_forum_img"; ?>" alt="<?php echo $lang['board_forum_locked']; ?>" title="<?php echo $redirect_url; ?>" />
<?php } elseif ($read_only=='1'){ ?>
					<img src="<?php echo "$locked_forum_img"; ?>" alt="<?php echo $lang['board_forum_locked']; ?>" title="<?php echo $lang['board_forum_locked']; ?>" />
<?php } elseif ($rows=='0'){ ?>
					<img src="<?php echo "$topic_read_img"; ?>" alt="<?php echo $lang['board_forum_new_no']; ?>" title="<?php echo $lang['board_forum_new_no']; ?>" />
<?php } elseif ($unread_posts=='0'){ ?>
					<img src="<?php echo "$topic_read_img"; ?>" alt="<?php echo $lang['board_forum_new_no']; ?>" title="<?php echo $lang['board_forum_new_no']; ?>" />
<?php } elseif ($unread_posts!='0'){ ?>
					<img src="<?php echo "$topic_unread_img"; ?>" alt="<?php echo $lang['board_forum_new']; ?>" title="<?php echo $lang['board_forum_new']; ?>" />
<?php } else{ ?>
					<img src="<?php echo "$topic_read_img"; ?>" alt="<?php echo $lang['board_forum_new_no']; ?>" title="<?php echo $lang['board_forum_new_no']; ?>" />
<?php } ?>				
				</td>
				<td class="forum-index-td-middle<?php echo "$alt_td_class"; ?>">
					<a class="forum-name-link" href="<?php echo lb_link("index.php?forum=$forum_id", "forum/$forum_title-$forum_id"); ?>"><strong><?php echo "$forum_name"; ?></strong></a><br /><?php echo "$forum_description"; ?>
<?php if ($count_sub!='0'){ ?>
					<br /><br /><?php echo $lang['board_subforums']; ?>
<?php } ?>
<?php } elseif ($template_hook=='15'){ ?>
<?php if ($count_sub_forums==$count_sub){ ?>
					<!-- show sub-forums -->
					&nbsp;<a class="subforum-name-link" href="<?php echo lb_link("index.php?forum=$sub_id", "forum/$forum_title-$sub_id"); ?>"><?php echo "$sub_name"; ?></a>
<?php } else{ $count_sub_forums=$count_sub_forums+1; ?>
					&nbsp;<a class="subforum-name-link" href="<?php echo lb_link("index.php?forum=$sub_id", "forum/$forum_title-$sub_id"); ?>"><?php echo "$sub_name"; ?></a>, 
<?php } ?>
<?php } elseif ($template_hook=='16'){ ?>
				</td>
<?php if ($redirect_url!='') { ?>
				<td class="forum-index-td-topics<?php echo "$alt_td_class"; ?>">-</td>
<?php } else { ?>
				<td class="forum-index-td-topics<?php echo "$alt_td_class"; ?>"><?php echo "$topics"; ?></td>
<?php } ?>

<?php if ($redirect_url!='') { ?>
				<td class="forum-index-td-posts<?php echo "$alt_td_class"; ?>">-</td>
<?php } else { ?>
				<td class="forum-index-td-posts<?php echo "$alt_td_class"; ?>"><?php echo "$posts"; ?></td>
<?php } ?>
				<td class="forum-index-td-right<?php echo "$alt_td_class"; ?>">
<?php if ($redirect_url!='') { ?>
-
<?php } else { ?>
<?php if ($time!=''){ ?>
					<?php echo "$time"; ?><br />
<?php if ($can_read_topics=='0'){ ?>
					<?php echo $lang['board_topic_in']; ?> <?php echo $lang['board_topic_restricted']; ?>
<?php }else{ ?>
					<?php echo $lang['board_topic_in']; ?> <a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=findpost&post=$id", "findpost/$id"); ?>"><?php echo "$title"; ?></a>
<?php } ?>
					<br />
					<?php echo $lang['board_topic_by']; ?> 
<?php if ($name=='' && $title != ''){ ?>
					<?php echo $lang['board_topic_unregistered']; ?>
<?php }else{ ?>
					<?php echo member_link($member, '0'); ?>
<?php }}} ?>
				</td>
			</tr>
<?php } elseif ($template_hook=='4'){ ?>
		<!-- show footer table for sub-forums -->
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents" style="padding: 5px; text-align: right;">&nbsp;</td></tr>
		</table>
		<br /><br />
<?php } elseif($template_hook=='5'){ ?>
		<table style="width:100%;" cellpadding="0" cellspacing="0"><tr>
<?php if ($pages <= '1'){}else{ ?>
			<!-- show page numbers -->
			<td style="padding-top: 2px; padding-bottom: 8px;">
				<?php echo $lang['board_page']; ?>
<?php $pages=(ceil($number_of_threads/$list_topics)); if (!isset($_GET['limit'])){$limit="1";}else{$limit=$_GET['limit'];} $start="1"; for($i = "1"; $i <= $pages; $i++) { $i_limit=$i; if ($i > 1){ $start=($start+1); } if ($limit==$start){ ?>
				<a class="page-active" href="<?php echo lb_link("index.php?forum=$forum&limit=$limit", "forum/$forum_title-$forum/$limit"); ?>"><?php echo "$i"; ?></a>
<?php }else{ ?>
<?php if ($_GET['limit'] >="3" && $i_limit < $_GET['limit'] - "2" OR $_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] <= "2" && $i_limit > "4" ){}else{  ?>
<?php if ($_GET['limit'] > "2" && $i_limit < $_GET['limit'] - "1"){ ?>
				<a class="page" href="<?php echo lb_link("index.php?forum=$forum&limit=1", "forum/$forum_title-$forum/1"); ?>">&lt;&lt;</a>
<?php } ?>
				<a class="page" href="<?php echo lb_link("index.php?forum=$forum&limit=$i_limit", "forum/$forum_title-$forum/$i_limit"); ?>"><?php echo "$i"; ?></a>
<?php }}} ?>
<?php if ($pages - $_GET['limit'] >= "3"){ ?>
				<a class="page" href="<?php echo lb_link("index.php?forum=$forum&limit=$pages_end", "forum/$forum_title-$forum/$pages_end"); ?>">&gt;&gt;</a>
<?php } ?>
			</td>
<?php } ?>
<?php if ($forum_read_only=='0'){ if ($can_add_topics=='1'){ ?>
			<!-- show buttons for new topic, add reply -->
			<td class="new-topic-placer">
				<a class="submit-button-large img-add-forum" href="<?php echo lb_link("index.php?func=newpost&forum=$forum", "newpost/$forum"); ?>"><?php echo $lang['button_new_topic']; ?></a>
			</td>
		</tr></table>
<?php }else{ ?>
<?php }} ?>
		<!-- start the forums header (including RSS if turned on) -->	
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0"><tr>
        	<td class="forum-topic-subject-main">
<?php if ($show_rss=='1'){ ?>
				<a href="<?php echo "$lb_domain"; ?>/rss/rss.php?forum=<?php echo "$forum"; ?>" target="_blank"><img  src="<?php echo "$rss_img"; ?>" alt="<?php echo $lang['board_rss']; ?>" title="<?php echo $lang['board_rss']; ?>" /></a>&nbsp;&nbsp;
<?php } ?>
				<?php echo "$forum_name_for_this_forum"; ?>
			</td>
<?php if ($forum_read_only=='0'){ if ($_COOKIE['lb_name']!=''){ ?>
			<!-- show subscribe/unsubscribe option -->
			<td class="forum-topic-subscribe">
<?php if ($subscribed_already=='1'){ ?>
				<a class="subscribe-button img-unsubscribe" href="<?php echo lb_link("index.php?page=unsubscribe&forum=$forum", "unsubscribe/forum/$forum"); ?>">
					<?php echo $lang['button_unsubscribe_forum']; ?>
				</a>
<?php }else{ ?>
				<a class="subscribe-button img-subscribe" href="<?php echo lb_link("index.php?page=subscribe&forum=$forum", "subscribe/forum/$forum"); ?>">
					<?php echo $lang['button_subscribe_forum']; ?>
				</a>
<?php } ?>
			</td>
<?php }} ?>
		</tr></table>
		<!-- prepare the forums table for subject, topic starter, replies, views and last post -->	
		<table class="forum-board" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-board-unread-sub"></td>
				<td class="forum-board-subject-sub"><?php echo $lang['board_forum_subject']; ?></td>
				<td class="forum-board-replies-sub"><?php echo $lang['board_forum_replies']; ?></td>
				<td class="forum-board-started-sub"><?php echo $lang['board_forum_starter']; ?></td>
				<td class="forum-board-views-sub"><?php echo $lang['board_forum_views']; ?></td>
				<td class="forum-board-lastpost-sub"><?php echo $lang['board_forum_lastpost']; ?></td>
			</tr>
<?php } elseif ($template_hook=='6'){ ?>
			<tr>
				<!-- now show the topic icon -->
                <td class="forum-board-unread<?php echo "$alt_td_class"; ?><?php echo " $status_class"; ?>">
<?php if ($can_lock_topics=='1' && $locked=='0'){ ?>
					<a href="<?php echo lb_link("index.php?func=lock&index=q&topic=$topic_id", "lock/q/$topic_id"); ?>">
<?php }elseif ($can_lock_topics=='1' && $locked=='1'){ ?>
					<a href="<?php echo lb_link("index.php?func=unlock&index=q&topic=$topic_id", "unlock/q/$topic_id"); ?>">
<?php }if ($locked=='0'){ if ($read_all_posts > $post_time){ if ($sticky=='1'){ ?>
						<img src="<?php echo "$pinned_read_img"; ?>" alt="<?php echo $lang['board_forum_sticky_new_no']; ?>" title="<?php echo $lang['board_forum_sticky_new_no']; ?>" />
<?php }else{ ?>
						<img src="<?php echo "$read_img"; ?>" alt="<?php echo $lang['board_forum_new_no']; ?>" title="<?php echo $lang['board_forum_new_no']; ?>" />
<?php }}elseif ($read_time > $post_time){if ($sticky=='1'){ ?>
						<img src="<?php echo "$pinned_read_img"; ?>" alt="<?php echo $lang['board_forum_sticky_new_no']; ?>" title="<?php echo $lang['board_forum_sticky_new_no']; ?>" />
<?php }elseif ($difference_in_time >= $hot_topic && $replies >= $hot_topic){ ?>
						<img src="<?php echo "$read_hot_img"; ?>" alt="<?php echo $lang['board_forum_hot_new_no']; ?>" title="<?php echo $lang['board_forum_hot_new_no']; ?>" />
<?php }else{ ?>
						<img src="<?php echo "$read_img"; ?>" alt="<?php echo $lang['board_forum_new_no']; ?>" title="<?php echo $lang['board_forum_new_no']; ?>" />
<?php }} elseif ($sticky=='1'){ ?>
						<img src="<?php echo "$pinned_unread_img"; ?>" alt="<?php echo $lang['board_forum_sticky_new']; ?>" title="<?php echo $lang['board_forum_sticky_new']; ?>" />
<?php } elseif ($difference_in_time >= $hot_topic && $replies >= $hot_topic){ ?>
						<img src="<?php echo "$unread_hot_img"; ?>" alt="<?php echo $lang['board_forum_hot_new']; ?>" title="<?php echo $lang['board_forum_hot_new']; ?>" />
<?php } else{ ?>
						<img src="<?php echo "$unread_img"; ?>" alt="<?php echo $lang['board_forum_new']; ?>" title="<?php echo $lang['board_forum_new']; ?>" />
<?php }} elseif ($locked=='1'){ ?>
						<img src="<?php echo "$topic_locked_img"; ?>" alt="<?php echo $lang['board_forum_topic_locked']; ?>" title="<?php echo $lang['board_forum_topic_locked']; ?>" />
<?php } ?>
					</a>
				</td>
				<!-- show topic title now -->
				<td class="forum-board-subject<?php echo "$alt_td_class"; ?><?php echo " $status_class"; ?>">
<?php if ($read_all_posts < $post_time && $read_time < $post_time){ ?>
					<a href="<?php echo lb_link("index.php?page=findpost&post=$post_to_be_read", "findpost/$post_to_be_read"); ?>"><img  src="<?php echo "$new_post_img"; ?>" alt="*" title="<?php echo $lang['board_forum_unread']; ?>" /></a>
<?php } ?>
<?php if ($has_attachment!='0'){ ?>
					<img src="<?php echo "$attach_img"; ?>" alt="" title="" />
<?php } ?>
<?php if ($sticky=='1'){if ($announce=='1'){ ?>
					<strong><?php echo $lang['board_announcement']; ?> </strong>
					<a class="forum-index-topic-sticky" href="<?php echo lb_link("index.php?topic=$topic_id", "topic/$topic_title-$topic_id"); ?>"><?php echo "$title"; ?></a>
<?php }else{ ?>
					<a class="forum-index-topic-sticky" href="<?php echo lb_link("index.php?topic=$topic_id", "topic/$topic_title-$topic_id"); ?>"><?php echo "$title"; ?></a>
<?php }}else{ ?>
					<a class="topic-link-board" href="<?php echo lb_link("index.php?topic=$topic_id", "topic/$topic_title-$topic_id"); ?>"><?php echo "$title"; ?></a>
<?php } ?>
					<!-- topic description -->
					<br /><span class="topic-description"><?php echo "$description"; ?></span>
					<!-- page numbers -->
<?php if ($pages <= '1'){}else{ ?>
					<div style="float: none;">
<?php $pages=(ceil($number_of_posts/$list_posts)); if (!isset($_GET['limit'])){$_GET['limit']="1";} $start="1"; for($i = "1"; $i <= $pages; $i++) { $i_limit=$i; if ($i > 1){ $start=($start+1); } if ($_GET['limit']==$start){ ?>
						<a class="page-small" href="<?php echo lb_link("index.php?topic=$topic_id&limit=$i_limit", "topic/$topic_title-$topic_id/$i_limit"); ?>"><?php echo "$i"; ?></a>
<?php } else{ ?>
<?php if ($_GET['limit'] >="3" && $i_limit < $_GET['limit'] - "2" OR $_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] <= "2" && $i_limit > "4" ){}else{  ?>
<?php if ($_GET['limit'] > "2" && $i_limit < $_GET['limit'] - "1"){ ?>
						<a class="page-small" href="<?php echo lb_link("index.php?topic=$topic_id&limit=1", "topic/$topic_title-$topic_id/1"); ?>">&lt;&lt;</a>
<?php } ?>
						<a class="page-small" href="<?php echo lb_link("index.php?topic=$topic_id&limit=$i_limit", "topic/$topic_title-$topic_id/$i_limit"); ?>"><?php echo "$i"; ?></a>
<?php }}} ?>
<?php if ($pages_end - $_GET['limit'] >= "3"){ ?>
						<a class="page-small" href="<?php echo lb_link("index.php?topic=$topic_id&limit=$pages_end", "topic/$topic_title-$topic_id/$pages_end"); ?>">&gt;&gt;</a>
<?php } ?>
<?php } ?>	
					</div>
				</td>
				<td class="forum-board-replies<?php echo "$alt_td_class"; ?><?php echo " $status_class"; ?>"><?php echo "$replies"; ?></td>
				<td class="forum-board-started<?php echo "$alt_td_class"; ?><?php echo " $status_class"; ?>">
<?php if ($name==''){ ?>
					<?php echo $lang['board_topic_unregistered']; ?>
<?php }else{ ?>
					<?php echo member_link($member, '0'); ?>
				</td>
<?php } ?>
				<td class="forum-board-views<?php echo "$alt_td_class"; ?><?php echo " $status_class"; ?>"><?php echo "$views"; ?></td>
				<!-- post info -->
                <td class="forum-board-lastpost<?php echo "$alt_td_class"; ?><?php echo " $status_class"; ?>"><?php echo "$time"; ?><br />
					<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=findpost&post=$last_post", "findpost/$last_post"); ?>"><span class="topic-description"><?php echo $lang['board_lastpost_by']; ?></a></a> 
<?php if ($last_poster=='0'){ ?>
					<?php echo $lang['board_topic_unregistered']; ?>
<?php }else{ ?>
					<?php echo member_link($last_poster_id, '0'); ?>
<?php } ?>
				</td>
			</tr>
<?php } elseif ($template_hook=='7'){ ?>
		<!-- footer for forum table -->
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents" style="padding: 5px; text-align: right;">
				<form method="get" name="searchform" action="<?php echo "$lb_domain"; ?>/index.php?">
					<input type="text" class="search-box" name="search" value="<?php echo $lang['board_search']; ?>" onfocus="ClearForm();" />
					<input type="hidden" name="page" value="search" />
					<input type="hidden" value="1" name="pf" />
					<input type="hidden" value="<?php echo "$forum"; ?>" name="forums[]" id="forums[]" />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="submit-button img-preview" value="<?php echo $lang['button_search']; ?>" />
				</form>		
			</td></tr>
		</table>
<?php } elseif ($template_hook=='8'){ ?>
		<!-- online list -->
		<div class="spacer">&nbsp;</div>
		<table class="forum-jump" cellpadding="0" cellspacing="0">
        	<tr><td class="forum-jump-content-online">
				<?php echo $lang['board_online_list']; ?>
			</td></tr>
			<tr><td class="forum-jump-content">
<?php } elseif ($template_hook=='9'){ ?>
				<!-- show the names of the members online (including bots) -->
<?php if ($count_online_count==$count_online){if ($id < '0'){ ?>
				<span class="bot-group-color"><i><?php echo "$name"; ?></i></span>
<?php }else{ ?>
				<?php echo member_link($id, '1', '1', '1'); ?>
<?php }}else{$count_online_count=$count_online_count+1;if ($id < '0'){?>
				<span class="bot-group-color"><i><?php echo "$name"; ?></i></span>,
<?php }else{ ?>
				<?php echo member_link($id, '1', '1', '1'); ?>,
<?php }} ?>
<?php }elseif ($template_hook=='10'){ ?>
			</td></tr>
		</table>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>
