<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=="4"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['groups_new_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="settings" method="post" action="<?php echo lb_link("index.php?page=admin&act=groups","admin/groups"); ?>">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"> </td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">			
					<?php echo $lang_admin['groups_global_desc']; ?><br /><br />
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['groups_name_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['groups_name_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_name_group']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="group_name" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_color']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="group_color" />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['groups_icon_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['groups_icon_desc']; ?><br /><br />
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_1_img"; ?>" alt="" /><br />
						<input type="radio" style="width: auto;" name="group_icon" value="1" />
					</div>
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_2_img"; ?>" alt="" /><br />
						<input type="radio" style="width: auto;" name="group_icon" value="2" />
					</div>	
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_3_img"; ?>" alt="" /><br />
						<input type="radio" style="width: auto;" name="group_icon" value="3" />
					</div>	
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_4_img"; ?>" alt="" /><br />
						<input type="radio" style="width: auto;" name="group_icon" value="4" />
					</div>	
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_5_img"; ?>" alt="" /><br />
						<input type="radio" style="width: auto;" name="group_icon" value="5" />
					</div>
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_6_img"; ?>" alt="" /><br />
						<input type="radio" style="width: auto;" name="group_icon" value="6" />
					</div>	
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_7_img"; ?>" alt="" /><br />
						<input type="radio" style="width: auto;" name="group_icon" value="7" />
					</div>	
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_8_img"; ?>" alt="" /><br />
						<input type="radio" style="width: auto;" name="group_icon" value="8" />
					</div>	
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_9_img"; ?>" alt="" /><br />
						<input type="radio" style="width: auto;" name="group_icon" value="9" />
					</div>
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_10_img"; ?>" alt="" /><br />
						<input type="radio" style="width: auto;" name="group_icon" value="10" />
					</div>
					<div style="float: left; text-align: center; width: 9%;">
						<?php echo $lang_admin['groups_icon_none']; ?><br />
						<input type="radio" style="width: auto;" name="group_icon" value="0" checked="checked" />
					</div>					
				</td></tr>				
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['groups_permissions_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['groups_permissions_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_view_board']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_view_board" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_change_own_name']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_change_own_name" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_change_title']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_change_user_title" value="1" />
                           <br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_messages']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_pm" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_change_theme']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_change_style" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_avatar']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_use_avatar" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_signature']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_use_sig" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_edit_own_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_edit_own_posts" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_delete_own_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_delete_own_posts" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_polls']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_add_polls" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_caspian']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="avoid_caspian" value="1" />
						<br /><br />
					</div>						
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_html']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_use_html" value="1" />
						<br /><br />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['groups_moderator_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['groups_moderator_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_warn']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_warn_members" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_ban']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_ban_members" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_edit']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_edit_members" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_delete_members']; ?></strong>
						</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_delete_members" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_edit_others_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_edit_others_posts" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_delete_others_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_delete_others_posts" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_sticky']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_sticky_topics" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_move']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_move_topics" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_lock']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_lock_topics" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_split']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_split_topics" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_merge']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_merge_topics" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_reported']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_see_reported_posts" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_moderate_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_moderate_members" value="1" />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['groups_administrator_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['groups_administrator_desc']; ?><br /><br />
<?php if ($can_change_site_settings=="1"){ ?>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_change_site']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_change_site_settings" value="1" />
						<br /><br />
					</div>
<?php }else{ ?>
					<input type="hidden" name="can_change_site_settings" value="0" />
<?php } ?>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_change_forums']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_change_forum_settings" value="1" />
						<br /><br />
					</div>
<?php if ($can_change_site_settings=="1"){ ?>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_announce']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="can_global_announce" value="1" />
					</div>
<?php } else{ ?>
					<input type="hidden" name="can_global_announce" value="0" />
<?php } ?>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['groups_permissions']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['groups_permissions_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_copy']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<select name="group_copy_id">
							<option value=""><?php echo $lang_admin['groups_copy_none']; ?></option>
<?php }elseif ($template_hook=="9"){ ?>								
							<option value="<?php echo "$group_copy_id"; ?>"><?php echo "$group_copy_name"; ?></option>	
<?php }elseif ($template_hook=="10"){ ?>	
						</select>
					</div>					
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<input type="hidden" name="post_new" value="1" />
<?php if($can_change_forum_settings=='1'){ ?>
					<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
					<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
					<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
				</td></tr>
			</table>
		</form>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=="5"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['groups_group_title']; ?> <?php echo "$group_name"; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="settings" method="post" action="<?php echo lb_link("index.php?page=admin&act=groups","admin/groups"); ?>">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"> </td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">			
					<?php echo $lang_admin['groups_global_desc']; ?><br /><br />
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['groups_name_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['groups_name_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_name_group']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="group_name" value="<?php echo "$group_name"; ?>" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_color']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="group_color" value="<?php echo "$group_color"; ?>" />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['groups_icon_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['groups_icon_desc']; ?><br /><br />
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_1_img"; ?>" alt="" /><br />
<?php if ($group_icon=='1'){ ?>						
						<input type="radio" style="width: auto;" name="group_icon" value="1" checked="checked" />
<?php }else{ ?>
						<input type="radio" style="width: auto;" name="group_icon" value="1" />
<?php } ?>						
					</div>
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_2_img"; ?>" alt="" /><br />
<?php if ($group_icon=='2'){ ?>						
						<input type="radio" style="width: auto;" name="group_icon" value="2" checked="checked" />
<?php }else{ ?>
						<input type="radio" style="width: auto;" name="group_icon" value="2" />
<?php } ?>	
					</div>	
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_3_img"; ?>" alt="" /><br />
<?php if ($group_icon=='3'){ ?>						
						<input type="radio" style="width: auto;" name="group_icon" value="3" checked="checked" />
<?php }else{ ?>
						<input type="radio" style="width: auto;" name="group_icon" value="3" />
<?php } ?>	
					</div>	
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_4_img"; ?>" alt="" /><br />
<?php if ($group_icon=='4'){ ?>						
						<input type="radio" style="width: auto;" name="group_icon" value="4" checked="checked" />
<?php }else{ ?>
						<input type="radio" style="width: auto;" name="group_icon" value="4" />
<?php } ?>	
					</div>	
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_5_img"; ?>" alt="" /><br />
<?php if ($group_icon=='5'){ ?>						
						<input type="radio" style="width: auto;" name="group_icon" value="5" checked="checked" />
<?php }else{ ?>
						<input type="radio" style="width: auto;" name="group_icon" value="5" />
<?php } ?>	
					</div>
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_6_img"; ?>" alt="" /><br />
<?php if ($group_icon=='6'){ ?>						
						<input type="radio" style="width: auto;" name="group_icon" value="6" checked="checked" />
<?php }else{ ?>
						<input type="radio" style="width: auto;" name="group_icon" value="6" />
<?php } ?>	
					</div>	
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_7_img"; ?>" alt="" /><br />
<?php if ($group_icon=='7'){ ?>						
						<input type="radio" style="width: auto;" name="group_icon" value="7" checked="checked" />
<?php }else{ ?>
						<input type="radio" style="width: auto;" name="group_icon" value="7" />
<?php } ?>	
					</div>	
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_8_img"; ?>" alt="" /><br />
<?php if ($group_icon=='8'){ ?>						
						<input type="radio" style="width: auto;" name="group_icon" value="8" checked="checked" />
<?php }else{ ?>
						<input type="radio" style="width: auto;" name="group_icon" value="8" />
<?php } ?>	
					</div>	
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_9_img"; ?>" alt="" /><br />
<?php if ($group_icon=='9'){ ?>						
						<input type="radio" style="width: auto;" name="group_icon" value="9" checked="checked" />
<?php }else{ ?>
						<input type="radio" style="width: auto;" name="group_icon" value="9" />
<?php } ?>	
					</div>
					<div style="float: left; text-align: center; width: 9%;">
						<img src="<?php echo "$groups_10_img"; ?>" alt="" /><br />
<?php if ($group_icon=='10'){ ?>						
						<input type="radio" style="width: auto;" name="group_icon" value="10" checked="checked" />
<?php }else{ ?>
						<input type="radio" style="width: auto;" name="group_icon" value="10" />
<?php } ?>	
					</div>
					<div style="float: left; text-align: center; width: 9%;">
						<?php echo $lang_admin['groups_icon_none']; ?><br />
<?php if ($group_icon=='0'){ ?>						
						<input type="radio" style="width: auto;" name="group_icon" value="0" checked="checked" />
<?php }else{ ?>
						<input type="radio" style="width: auto;" name="group_icon" value="0" />
<?php } ?>	
					</div>						
				</td></tr>				
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['groups_permissions_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['groups_permissions_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_view_board']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_view_board=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_view_board" value="<?php echo "$can_view_board"; ?>" checked />
						<br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_view_board" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_change_own_name']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_change_own_name=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_change_own_name" value="<?php echo "$can_change_own_name"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_change_own_name" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_change_title']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_change_user_title=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_change_user_title" value="<?php echo "$can_change_user_title"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_change_user_title" value="1" />
						<br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_messages']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_pm=="1"){ ?>
					<input type="checkbox" class="checkbox" name="can_pm" value="<?php echo "$can_pm"; ?>" checked />						<br /><br />
<?php }else{ ?>
					<input type="checkbox" class="checkbox" name="can_pm" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_change_theme']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_change_style=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_change_style" value="<?php echo "$can_change_style"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_change_style" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_avatar']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_use_avatar=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_use_avatar" value="<?php echo "$can_use_avatar"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_use_avatar" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_signature']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_use_sig=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_use_sig" value="<?php echo "$can_use_sig"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_use_sig" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_edit_own_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_edit_own_posts=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_edit_own_posts" value="<?php echo "$can_edit_own_posts"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_edit_own_posts" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_delete_own_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_delete_own_posts=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_delete_own_posts" value="<?php echo "$can_delete_own_posts"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_delete_own_posts" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_polls']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_add_polls=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_add_polls" value="<?php echo "$can_add_polls"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_add_polls" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_caspian']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($avoid_caspian=="1"){ ?>
						<input type="checkbox" class="checkbox" name="avoid_caspian" value="<?php echo "$avoid_caspian"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="avoid_caspian" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_html']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_use_html=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_use_html" value="<?php echo "$can_use_html"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_use_html" value="1" /><br /><br />
<?php } ?>
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['groups_moderator_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['groups_moderator_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_warn']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_warn_members=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_warn_members" value="<?php echo "$can_warn_members"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_warn_members" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_ban']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_ban_members=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_ban_members" value="<?php echo "$can_ban_members"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_ban_members" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_edit']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_edit_members=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_edit_members" value="<?php echo "$can_edit_members"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_edit_members" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_delete_members']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_delete_members=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_delete_members" value="<?php echo "$can_delete_members"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_delete_members" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_edit_others_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_edit_others_posts=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_edit_others_posts" value="<?php echo "$can_edit_others_posts"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_edit_others_posts" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_delete_others_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_delete_others_posts=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_delete_others_posts" value="<?php echo "$can_delete_others_posts"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_delete_others_posts" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_sticky']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_sticky_topics=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_sticky_topics" value="<?php echo "$can_sticky_topics"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_sticky_topics" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_move']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_move_topics=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_move_topics" value="<?php echo "$can_move_topics"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_move_topics" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_lock']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_lock_topics=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_lock_topics" value="<?php echo "$can_lock_topics"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_lock_topics" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_split']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_split_topics=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_split_topics" value="<?php echo "$can_split_topics"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_split_topics" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_merge']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_merge_topics=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_merge_topics" value="<?php echo "$can_merge_topics"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_merge_topics" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_reported']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_see_reported_posts=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_see_reported_posts" value="<?php echo "$can_see_reported_posts"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_see_reported_posts" value="1" /><br /><br />
<?php } ?>
					</div>	
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_moderate_posts']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_moderate_members=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_moderate_members" value="<?php echo "$can_moderate_members"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_moderate_members" value="1" /><br /><br />
<?php } ?>
					</div>		
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['groups_administrator_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['groups_administrator_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_change_site']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_change_site_settings_form == 1){ ?>
						<input
							type="checkbox"
							class="checkbox"
							name="can_change_site_settings"
							value="1"
							checked="checked"
							<?php echo $disabled; ?>
							<?php if ($group_id == 1){ ?>disabled="disabled"<?php } ?>
						/><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_change_site_settings" value="1" <?php echo $disabled; ?> /><br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_change_forums']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_change_forum_settings=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_change_forum_settings" value="<?php echo "$can_change_forum_settings"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_change_forum_settings" value="1" />
						<br /><br />
<?php } ?>
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_announce']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($can_global_announce=="1"){ ?>
						<input type="checkbox" class="checkbox" name="can_global_announce" value="<?php echo "$can_global_announce"; ?>" checked <?php echo "$disabled"; ?> />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_global_announce" value="1" <?php echo "$disabled"; ?> />
<?php } ?>
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['groups_permissions']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['groups_permissions_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['groups_copy']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<select name="group_copy_id">
							<option value=""><?php echo $lang_admin['groups_copy_none']; ?></option>
<?php }elseif ($template_hook=="11"){ ?>								
							<option value="<?php echo "$group_copy_id"; ?>"><?php echo "$group_copy_name"; ?></option>	
<?php }elseif ($template_hook=="12"){ ?>	
						</select>
					</div>							
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<input type="hidden" name="post_edit" value="1" />
					<input type="hidden" name="group_id" value="<?php echo "".$_GET['id'].""; ?>" />
					<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
					<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
					<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
				</td></tr>
			</table>
		</form>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif($template_hook=="6"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['groups_user_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['groups_user_option']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
				<?php echo $lang_admin['groups_user_desc']; ?><br /><br />
<?php }elseif($template_hook=="7"){ ?>
				<div style="width: 10%; float: left;">&nbsp;</div>
				<div style="width: 40%; float: left;">
					<strong><span style="color: <?php echo "$group_color"; ?>;"><?php echo "$group_name"; ?></span></strong>
				</div>
				<div style="width: 50%; float: left;">
					<a href="<?php echo lb_link("index.php?page=admin&act=groups&func=edit&id=$group_id","admin/groups/edit/$group_id"); ?>"><img  src="<?php echo "$edit_icon_img"; ?>" alt="<?php echo $lang_admin['custom_edit']; ?>" /></a>
<?php if ($group_id=="1"){}elseif ($group_id=="4"){}elseif ($group_id=="3"){}else{ ?>
					<form name="delete_one" method="post" action="<?php echo $lb_domain; ?>/index.php?page=admin&act=groups&func=delete">
					
						<input type="hidden" name="token_id" value="<?php echo $token_id; ?>" />
						<input type="hidden" name="<?php echo $token_name; ?>" value="<?php echo $token; ?>" />
						<input type="hidden" name="group" id="group" value="<?php echo $group_id; ?>">
						<input onclick="javascript:return confirm('<?php echo $lang['topic_remove']; ?>')" type="image" class="img" style="padding: 0px;" src="<?php echo $delete_icon_img; ?>" name="submit" />						
					</form>
<?php } ?>
				</div>
				<br />
<?php }elseif($template_hook=="8"){ ?>
			</td></tr>
			<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
				<a class="submit-button img-group" href="<?php echo lb_link("index.php?page=admin&act=groups&func=new","admin/groups/new"); ?>"><?php echo $lang['button_group']; ?></a>
			</td></tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='successAdded'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['groups_added']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successUpdated'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['groups_updated']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successDeleted'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['groups_deleted']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>		
<?php } ?>