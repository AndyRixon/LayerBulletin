<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
		<!-- member page -->		
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">		
			<tr><td class="forum-topic-subject"><?php echo $lang['members_title']; ?></td></tr>	
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">		
			<tr>
				<td class="forum-index-td-middle-sub border-left" style="width: 20%;"><?php echo $lang['members_profile']; ?></td>
				<td class="forum-index-td-middle-sub" style="width: 25%;"><?php echo $lang['members_statistics']; ?></td>
				<td class="forum-index-td-middle-sub" style="width: 30%;"><?php echo $lang['members_communication']; ?></td>
<?php if ($show_gamer_tags=='1'){ ?>
				<td class="forum-index-td-middle-sub border-right" style="width: 25%;"><?php echo $lang['members_tags']; ?></td>
<?php } ?>
			</tr>
			<tr>
				<td class="forum-index-td-left" style="width: 20%; text-align: left; vertical-align: top; padding: 5px;">
<?php if ($name==''){ ?>
					<?php echo $lang['board_topic_unregistered']; ?>
<?php }else{ ?>
					<?php echo member_link($id); ?><br />
<?php }if ($usertitle!=''){ ?>
					<?php echo "$usertitle"; ?><br />
<?php } ?>
<?php }elseif ($template_hook=='36'){ ?>
					<img  src="<?php echo "$pip_img"; ?>" alt="" />
<?php }elseif ($template_hook=='37'){ ?>
					<br /><img style="max-width: <?php echo "$attach_avatar_size"; ?>px; _width: <?php echo "$attach_avatar_size"; ?>px" src="<?php echo "$avatar"; ?>" alt="" /><br />
<?php }elseif($template_hook=='2'){ ?>
<?php if ($users_role!='1'){ if ($can_warn_members=='1'){ ?>
							<a class="warn-minus" href="<?php echo lb_link("index.php?page=warn&act=minus&id=$id", "warn/minus/$id"); ?>" title="<?php echo $lang['topic_warn_remove']; ?>">&nbsp;</a><a class="warn-mods warn-level<?php echo "$graphic_level"; ?>" href="javascript:WarnPopUp('<?php echo "$lb_domain"; ?>/includes/forums/warn_popup.php?id=<?php echo "$id"; ?>')" title="<?php echo $lang['topic_warn_level']; ?> <?php echo "$graphic_warn"; ?>%">&nbsp;</a><a class="warn-plus" href="<?php echo lb_link("index.php?page=warn&act=add&id=$id", "warn/add/$id"); ?>" title="<?php echo $lang['topic_warn_add']; ?>">&nbsp;</a>
							<br />
<?php }else{ ?>
							<!-- warn bar for non-mods -->
							<a class="warn-members warn-level<?php echo "$graphic_level"; ?>" href="javascript:WarnPopUp('<?php echo "$lb_domain"; ?>/includes/forums/warn_popup.php?id=<?php echo "$id"; ?>')" title="<?php echo $lang['topic_warn_level']; ?> <?php echo "$graphic_warn"; ?>%">&nbsp;</a>
							<br />
<?php }} ?>

<?php }elseif ($template_hook=='5'){ ?>
<?php if ($user_group_icon!='0'){ ?>
							<!-- show group icon -->
							<div class="group"><img src="<?php echo "$group_img"; ?>" alt="" />&nbsp;&nbsp;<span style="color: <?php echo "$user_group_color"; ?>;"><?php echo "$user_group_name"; ?></span></div><br />
<?php } ?>
					<br />
				</td>
				<td class="forum-index-td-right" style="width: 25%; text-align: left; vertical-align: top; padding: 5px;">
					<table cellpadding="0" cellspacing="0" style="width: 100%;">
						<tr><td class="forum-index-stats-header forum-index-top border-left-none border-right-none"><?php echo $lang['members_location']; ?></td></tr>
					</table>
<?php if ($location==''){ ?>
					<i><?php echo $lang['members_no_information']; ?></i><br /><br />
<?php } else{ ?>
					<?php echo "$location"; ?><br /><br />
<?php } ?>	
					<table cellpadding="0" cellspacing="0" style="width: 100%;">
						<tr><td class="forum-index-stats-header forum-index-top border-left-none border-right-none"><?php echo $lang['members_posts_total']; ?></td></tr>
					</table>
					<?php echo "$num_posts"; ?>	(<?php echo $lang['members_posts_percentage']; ?>)<br /><br />
					<table cellpadding="0" cellspacing="0" style="width: 100%;">
						<tr><td class="forum-index-stats-header forum-index-top border-left-none border-right-none"><?php echo $lang['members_last_active']; ?></td></tr>
					</table>
					<?php echo "$last_online"; ?><br /><br />
					<table cellpadding="0" cellspacing="0" style="width: 100%;">
						<tr><td class="forum-index-stats-header forum-index-top border-left-none border-right-none"><?php echo $lang['members_most_active']; ?></td></tr>
					</table>
<?php if ($most_active==''){ ?>
					<i><?php echo $lang['members_no_information']; ?></i><br /><br />
<?php } else{ ?>
<?php if ($can_view_forum=='1'){ ?>
					<a href="<?php echo lb_link("index.php?forum=$most_active", "forum/$forum_title-$most_active"); ?>"><?php echo "$forum_name"; ?></a>
<?php }else{ ?>
					<?php echo $lang['board_topic_restricted']; ?>
<?php } ?>
					<br />(<?php echo $lang['members_forum_percentage']; ?>)<br /><br />
<?php } ?>
				</td>
<?php if ($show_gamer_tags=='1'){ ?>
				<td class="forum-index-td-posts" style="width: 30%; text-align: left; vertical-align: top; padding: 5px;">
<?php }else{ ?>
				<td class="forum-index-td-posts border-right" style="width: 30%; text-align: left; vertical-align: top; padding: 5px;">
<?php } ?>
					<table cellpadding="0" cellspacing="0" style="width: 100%;">
						<tr><td class="forum-index-stats-header forum-index-top border-left-none border-right-none"><?php echo $lang['members_msn']; ?></td></tr>
					</table>
<?php if ($msn==''){ ?>
					<i><?php echo $lang['members_no_information']; ?></i><br /><br />
<?php } else{ ?>
					<?php echo "$msn"; ?><br /><br />
<?php } ?>
					<table cellpadding="0" cellspacing="0" style="width: 100%;">
						<tr><td class="forum-index-stats-header forum-index-top border-left-none border-right-none"><?php echo $lang['members_aol']; ?></td></tr>
					</table>
<?php if ($aol==''){ ?>	
					<i><?php echo $lang['members_no_information']; ?></i><br /><br />
<?php }else{ ?>
					<?php echo "$aol"; ?><br /><br />
<?php } ?>
					<table cellpadding="0" cellspacing="0" style="width: 100%;">
						<tr><td class="forum-index-stats-header forum-index-top border-left-none border-right-none"><?php echo $lang['members_yahoo']; ?></td></tr>
					</table>
<?php if ($yahoo==''){ ?>
					<i><?php echo $lang['members_no_information']; ?></i><br /><br />
<?php }else{ ?>
					<?php echo "$yahoo"; ?><br /><br />
<?php } ?>
					<table cellpadding="0" cellspacing="0" style="width: 100%;">
						<tr><td class="forum-index-stats-header forum-index-top border-left-none border-right-none"><?php echo $lang['members_skype']; ?></td></tr>
					</table>
<?php if ($skype==''){ ?>
					<i><?php echo $lang['members_no_information']; ?></i><br /><br />
<?php } else{ ?>
					<?php echo "$skype"; ?><br /><br />
<?php } ?>
<?php if ($can_pm=='1'){if ($can_pm_this_member=='1' && $my_id!=$id){ ?>
					<table cellpadding="0" cellspacing="0" style="width: 100%;">
						<tr><td class="forum-index-stats-header forum-index-top border-left-none border-right-none">
							<a class="submit-button img-email-go" href="<?php echo lb_link("index.php?page=messages&act=new&id=$id", "messages/new/$id"); ?>"><?php echo $lang['button_send_pm']; ?></a>
						</td></tr>
					</table>
<?php }} ?>
				</td>
<?php if ($show_gamer_tags=='1'){ ?>
				<td class="forum-index-td-right" style="width: 25%; text-align: left; vertical-align: top; padding: 5px;">
					<table cellpadding="0" cellspacing="0" style="width: 100%;">
						<tr><td class="forum-index-stats-header forum-index-top border-left-none border-right-none"><?php echo $lang['members_xbox']; ?></td></tr>
					</table>
<?php if ($xbox==''){ ?>
					<i><?php echo $lang['members_no_information']; ?></i><br /><br />
<?php }else{ ?>
					<?php echo "$xbox"; ?><br /><br />
<?php } ?>
					<table cellpadding="0" cellspacing="0" style="width: 100%;">
						<tr><td class="forum-index-stats-header forum-index-top border-left-none border-right-none"><?php echo $lang['members_ps3']; ?></td></tr>
					</table>
<?php if ($ps3==''){ ?>
					<i><?php echo $lang['members_no_information']; ?></i><br /><br />
<?php }else{ ?>
					<?php echo "$ps3"; ?><br /><br />
<?php } ?>
					<table cellpadding="0" cellspacing="0" style="width: 100%;">
						<tr><td class="forum-index-stats-header forum-index-top border-left-none border-right-none"><?php echo $lang['members_wii']; ?></td></tr>
					</table>
<?php if ($wii==''){ ?>
					<i><?php echo $lang['members_no_information']; ?></i><br /><br />
<?php }else{ ?>
					<?php echo "$wii"; ?><br /><br />
<?php } ?>
				</td>
<?php } ?>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php if ($signature!=''){ ?>
		<br /><br />
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang['members_signature']; ?></td></tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-td-middle-sub border-left-right" style="width: 100%; text-align: left;"> </td></tr>
			<tr><td class="forum-index-td-left border-right" style="text-align: left; padding: 10px;">
				<span class="signature"><?php echo "$content"; ?></span>
			</td></tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php } ?>
		<div class="spacer">&nbsp;</div>
		<table class="forum-jump" cellpadding="0" cellspacing="0">
		<form method="post" name="add_friend_form" action="<?php echo lb_link("index.php?page=myoptions&act=friendlist","myoptions/friendlist"); ?>">
				<input type="hidden" name="friend_id" value="<?php echo $id ?>" />
				<input type="hidden" name="add_friend" value="1" />
		</form>
		<form method="post" name="delete_friend_form" action="<?php echo lb_link("index.php?page=myoptions&act=friendlist","myoptions/friendlist"); ?>">
				<input type="hidden" name="friend_id" value="<?php echo $id ?>" />
				<input type="hidden" name="delete_friend" value="1" />
		</form>
			<tr><td class="forum-jump-content">
				<strong>&nbsp;&nbsp;<?php echo $lang['members_options']; ?>&nbsp;</strong>
				<a class="forum-index-link-to-topic" style="font-weight: normal;" href="<?php echo lb_link("index.php?page=search&area=topics&search=$id", "search/topics/$id"); ?>"><?php echo $lang['members_view_topics']; ?></a>
				&nbsp;&nbsp;|&nbsp;&nbsp;<a class="forum-index-link-to-topic" style="font-weight: normal;" href="<?php echo lb_link("index.php?page=search&area=posts&search=$id", "search/posts/$id"); ?>"><?php echo $lang['members_view_posts']; ?></a>
<?php if (($id != $my_id) && (!$is_friend)) { ?>
				&nbsp;&nbsp;|&nbsp;&nbsp;<a class="forum-index-link-to-topic" style="font-weight: normal;" onclick="document.forms['add_friend_form'].submit();" href="#"><?php echo $lang['members_add_friend']; ?></a>
<?php } ?>

<?php if ($is_friend) { ?>
				&nbsp;&nbsp;|&nbsp;&nbsp;<a class="forum-index-link-to-topic" style="font-weight: normal;" onclick="document.forms['delete_friend_form'].submit();" href="#"><?php echo $lang['members_delete_friend']; ?></a>
<?php } ?>

<?php if ($can_edit_members=='1') { ?>
				&nbsp;&nbsp;|&nbsp;&nbsp;<a class="forum-index-link-to-topic" style="font-weight: normal;" href="<?php echo lb_link("index.php?page=admin&act=members&func=edit&id=$id", "admin/members/edit/$id"); ?>"><?php echo $lang['members_edit']; ?></a>
<?php } ?>
			</td></tr>
		</table>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>