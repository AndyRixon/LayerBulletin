<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=="1"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['moderators_forum']; ?> <?php echo "$forum_name"; ?> - <?php echo $lang_admin['moderators_moderator']; ?> <?php echo "$member_name"; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="settings" method="post" action="<?php echo lb_link("index.php?page=admin&act=moderators","admin/moderators"); ?>">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"> </td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">			
					<?php echo $lang_admin['moderators_desc']; ?><br /><br />
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['moderators_forum_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">				
					<?php echo $lang_admin['moderators_forum_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_edit_own_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($mod_can_edit_own_posts=="1"){ ?>
						<input type="checkbox" class="checkbox" name="mod_can_edit_own_posts" value="<?php echo "$mod_can_edit_own_posts"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="mod_can_edit_own_posts" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_edit_others_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($mod_can_edit_others_posts=="1"){ ?>
						<input type="checkbox" class="checkbox" name="mod_can_edit_others_posts" value="<?php echo "$mod_can_edit_others_posts"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="mod_can_edit_others_posts" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_delete_own_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($mod_can_delete_own_posts=="1"){ ?>
						<input type="checkbox" class="checkbox" name="mod_can_delete_own_posts" value="<?php echo "$mod_can_delete_own_posts"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="mod_can_delete_own_posts" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_delete_others_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($mod_can_delete_others_posts=="1"){ ?>
						<input type="checkbox" class="checkbox" name="mod_can_delete_others_posts" value="<?php echo "$mod_can_delete_others_posts"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="mod_can_delete_others_posts" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_polls']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($mod_can_add_polls=="1"){ ?>
						<input type="checkbox" class="checkbox" name="mod_can_add_polls" value="<?php echo "$mod_can_add_polls"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="mod_can_add_polls" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_html']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($mod_can_use_html=="1"){ ?>
						<input type="checkbox" class="checkbox" name="mod_can_use_html" value="<?php echo "$mod_can_use_html"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="mod_can_use_html" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_warn']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($mod_can_warn_members=="1"){ ?>
						<input type="checkbox" class="checkbox" name="mod_can_warn_members" value="<?php echo "$mod_can_warn_members"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="mod_can_warn_members" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_ban']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($mod_can_ban_members=="1"){ ?>
						<input type="checkbox" class="checkbox" name="mod_can_ban_members" value="<?php echo "$mod_can_ban_members"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="mod_can_ban_members" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_edit']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($mod_can_edit_members=="1"){ ?>
						<input type="checkbox" class="checkbox" name="mod_can_edit_members" value="<?php echo "$mod_can_edit_members"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="mod_can_edit_members" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_sticky']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($mod_can_sticky_topics=="1"){ ?>
						<input type="checkbox" class="checkbox" name="mod_can_sticky_topics" value="<?php echo "$mod_can_sticky_topics"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="mod_can_sticky_topics" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_move']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($mod_can_move_topics=="1"){ ?>
						<input type="checkbox" class="checkbox" name="mod_can_move_topics" value="<?php echo "$mod_can_move_topics"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="mod_can_move_topics" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_lock']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($mod_can_lock_topics=="1"){ ?>
						<input type="checkbox" class="checkbox" name="mod_can_lock_topics" value="<?php echo "$mod_can_lock_topics"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="mod_can_lock_topics" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_split']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($mod_can_split_topics=="1"){ ?>
						<input type="checkbox" class="checkbox" name="mod_can_split_topics" value="<?php echo "$mod_can_split_topics"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="mod_can_split_topics" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_merge']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($mod_can_merge_topics=="1"){ ?>
						<input type="checkbox" class="checkbox" name="mod_can_merge_topics" value="<?php echo "$mod_can_merge_topics"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="mod_can_merge_topics" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_reported']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($mod_can_see_reported_posts=="1"){ ?>
						<input type="checkbox" class="checkbox" name="mod_can_see_reported_posts" value="<?php echo "$mod_can_see_reported_posts"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="mod_can_see_reported_posts" value="1" /><br /><br />
<?php } ?>
					</div>	
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_moderate_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($mod_can_moderate_members=="1"){ ?>
						<input type="checkbox" class="checkbox" name="mod_can_moderate_members" value="<?php echo "$mod_can_moderate_members"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="mod_can_moderate_members" value="1" /><br /><br />
<?php } ?>
					</div>		
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<input type="hidden" name="post_edit_form" value="1" />
					<input type="hidden" name="forum" value="<?php echo "$forum"; ?>" />
					<input type="hidden" name="id" value="<?php echo "$member_id"; ?>" />
					<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
					<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
					<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
				</td></tr>
			</table>
		</form>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=="2"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['members_select_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="name" method="post" action="<?php echo $lb_domain; ?>/index.php?page=admin&act=moderators&func=forum" class="asholder">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"> </td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['members_select_desc']; ?><br /><br />
					<?php echo $lang_admin['members_select_name']; ?> 
					<input type="hidden" name="token_id" value="<?php echo $token_id; ?>" />
					<input type="hidden" name="<?php echo $token_name; ?>" value="<?php echo $token; ?>" />
					<input type="hidden" name="forum" value="<?php echo $forum; ?>" />
					<input type="hidden" id="id" name="id" value="" />
					<input type="text" id="inputname" value="" /> 
					<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
				</td></tr>
			</table>
		</form>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
		<script type="text/javascript">
			var options = {
				script:"<?php echo "$lb_domain"; ?>/scripts/php/autosuggest.php?json=true&admin=1&limit=20&",
				varname:"input",
				json:true,
				shownoresults:true,
				maxresults:1000,
				cache: false,
				callback: function (obj) { document.getElementById('id').value = obj.id; }
			};
			var as_json = new bsn.AutoSuggest('inputname', options);
			
			
			var options_xml = {
				script: function (input) { return "<?php echo "$lb_domain"; ?>/scripts/php/autosuggest.php?input="+input+"&member="+document.getElementById('id').value; },
				varname:"input"
			};
			var as_xml = new bsn.AutoSuggest('testinput_xml', options_xml);
		</script>
<?php }elseif ($template_hook=="3"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['moderators_forum']; ?> <?php echo "$forum_name"; ?> - <?php echo $lang_admin['moderators_moderator']; ?> <?php echo "$member_name"; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="settings" method="post" action="<?php echo lb_link("index.php?page=admin&act=moderators","admin/moderators"); ?>">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_board_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">			
					<?php echo $lang_admin['moderators_desc']; ?><br /><br />
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['moderators_forum_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['moderators_forum_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_edit_own_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="mod_can_edit_own_posts" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_edit_others_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="mod_can_edit_others_posts" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_delete_own_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="mod_can_delete_own_posts" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_delete_others_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="mod_can_delete_others_posts" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_polls']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="mod_can_add_polls" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_html']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="mod_can_use_html" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_warn']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="mod_can_warn_members" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_ban']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="mod_can_ban_members" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_edit']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="mod_can_edit_members" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_sticky']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="mod_can_sticky_topics" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_move']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="mod_can_move_topics" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_lock']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="mod_can_lock_topics" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_split']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="mod_can_split_topics" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_merge']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="mod_can_merge_topics" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_reported']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="mod_can_see_reported_posts" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_moderate_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="mod_can_moderate_members" value="1" />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<input type="hidden" name="new_moderator_form" value="1" />
					<input type="hidden" name="forum" value="<?php echo $forum; ?>" />	
					<input type="hidden" name="id" value="<?php echo $member_id; ?>" />						
<?php if($can_change_site_settings=='1'){ ?>
					<input type="hidden" name="token_id" value="<?php echo $token_id; ?>" />
					<input type="hidden" name="<?php echo $token_name; ?>" value="<?php echo $token; ?>" />
<?php } ?>
					<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
				</td></tr>
			</table>
		</form>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=="14"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['moderators_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['moderators_title_desc']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
				<?php echo $lang_admin['moderators_desc_title']; ?><br /><br />
			</td></tr>
<?php }elseif ($template_hook=="15"){ ?>
			<tr><td class="forum-index-stats-header forum-index-top">
				<?php echo "$name"; ?>
			</td></tr>
			<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['categories_subforums']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
<?php }elseif ($template_hook=="18"){ ?>
				<div style="width: 50%; float: left; padding-top: 5px; padding-bottom: 5px;">
					<?php echo "$name"; ?>
				</div>
				<div style="width: 50%; float: left; text-align: right; padding-top: 5px; padding-bottom: 5px;">
					<a class="submit-button img-add-user" href="<?php echo lb_link("index.php?page=admin&act=moderators&func=forum&forum=$id","admin/moderators/forum/$id"); ?>"><?php echo $lang['button_add_moderator']; ?></a>
				</div>
<?php }elseif ($template_hook=="4"){ ?>		
				<div style="width: 20%; float: left;">&nbsp;</div>
				<div style="width: 25%; float: left; text-align: right">
					<?php echo "$member_name"; ?>&nbsp;&nbsp;	
				</div>
				<div style="width: 55%; float: left;">
					<a href="<?php echo lb_link("index.php?page=admin&act=moderators&func=edit&forum=$id&id=$member_id","admin/moderators/edit/$id/$member_id"); ?>"><img  src="<?php echo "$edit_icon_img"; ?>" alt="" /></a>
					<a href="<?php echo lb_link("index.php?page=admin&act=moderators&func=delete&forum=$id&id=$member_id","admin/moderators/delete/$id/$member_id"); ?>" onclick="javascript:return confirm('<?php echo $lang['topic_remove']; ?>')"><img  src="<?php echo "$delete_icon_img"; ?>" alt="" /></a>
				</div>
<?php }elseif ($template_hook=="19"){ ?>	
				<hr />
<?php }elseif ($template_hook=="21"){ ?>
				<div style="width: 50%; float: left; padding-top: 5px; padding-bottom: 5px;">
					&nbsp;&nbsp;&nbsp;&nbsp;--> <?php echo "$name"; ?>
				</div>
				<div style="width: 50%; float: left; text-align: right; padding-top: 5px; padding-bottom: 5px;">
					<a class="submit-button img-add-user" href="<?php echo lb_link("index.php?page=admin&act=moderators&func=forum&forum=$id","admin/moderators/forum/$id"); ?>"><?php echo $lang['button_add_moderator']; ?></a>
				</div>
<?php }elseif ($template_hook=="25"){ ?>
			</td></tr>
			<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;"> </td></tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='warn'){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0"><tr>
				<td class="forum-topic-subject"> </td>
				<td style="text-align: right;"></td>
		</tr></table>
		<table class="forum-board" cellpadding="0" cellspacing="0">
			<tr>
				<td class="error-header" style="width:100%;">
					<?php echo $lang_admin['moderators_warning']; ?>
				</td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<?php echo $lang_admin['moderators_warning_desc']; ?>
				</td>
			</tr>
			<tr>
				<td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<form name="warn" action="<?php echo "$lb_domain"; ?>/index.php?page=admin&act=moderators&func=delete&id=<?php echo $_GET['id']; ?>&forum=<?php echo $_GET['forum']; ?>" method="post">
						<input type="hidden" name="agree" id="agree" value="1" />
						<input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>" />	
						<input type="hidden" name="forum" id="forum" value="<?php echo $_GET['forum']; ?>" />
						<input type="hidden" name="token_id" value="<?php echo $token_id; ?>" />
						<input type="hidden" name="<?php echo $token_name; ?>" value="<?php echo $token; ?>" />
						<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
					</form>
				</td>
			</tr>	
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='successCreated'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['moderators_created']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successUpdated'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['moderators_updated']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successDeleted'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['moderators_deleted']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>