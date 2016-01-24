<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=="2"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['settings_global_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="settings" method="post" action="<?php echo "$lb_domain"; ?>/index.php?page=admin&act=settings">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_board_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['settings_board_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['settings_board_name']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="site_name" value="<?php echo "$site_name"; ?>" /><br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['settings_board_description']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="site_desc" value="<?php echo "$site_desc"; ?>" />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_site_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['settings_site_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['settings_site_title']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="home" value="<?php echo "$home"; ?>" />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_email_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['settings_email_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['settings_email_title']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="board_email" value="<?php echo "$default_board_email"; ?>" />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_rules_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">		
					<?php echo $lang_admin['settings_rules_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['settings_rules_title']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="rules" value="<?php echo "$rules"; ?>" />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_time_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['settings_time_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['settings_time_select']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<select name="time_offset">
							<option value="<?php echo "$time_offset"; ?>" selected="selected"><?php echo $lang_admin['settings_time_current']; ?></option>
<?php }elseif ($template_hook=="time"){ ?>
							<option value="<?php echo "$start_time_value" ?>"><?php echo "$formatted_start_time" ?></option>
<?php }elseif ($template_hook=="aftertime"){ ?>
						</select>
					</div>
				</td></tr>
				<tr><td id="offline" class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_offline_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['settings_offline_desc']; ?><br /><br />
					<div style="width: 100%; float: left;">
						<strong><?php echo $lang_admin['settings_offline_text']; ?></strong>
						<textarea class="post" name="board_offline_reason"><?php echo "$board_offline_reason"; ?></textarea>	
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['settings_offline_off']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($board_offline=="1"){ ?>
						<input type="checkbox" class="checkbox" name="board_offline" value="1" checked />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="board_offline" value="1" />
<?php } ?>
					</div>
				</td></tr>
				<tr><td id="register" class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_guests_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['settings_guests_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['settings_guests_allow']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($guest_register=="1"){ ?>
						<input type="checkbox" class="checkbox" name="guest_register" value="1" checked />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="guest_register" value="1" />
<?php } ?>
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_register_bar_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['settings_register_bar_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['settings_register_bar_allow']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($register_bar=="1"){ ?>
						<input type="checkbox" class="checkbox" name="register_bar" value="1" checked />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="register_bar" value="1" />
<?php } ?>
					</div>
				</td></tr>
				
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_email_verification']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['settings_email_verification_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['settings_email_verification_on']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($email_verification=="1"){ ?>
						<input type="checkbox" class="checkbox" name="email_verification" value="1" checked />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="email_verification" value="1" />
<?php } ?>
					</div>
				</td></tr>
				
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_member_flags']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['settings_member_flags_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['settings_member_flags_on']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($member_flags=="1"){ ?>
						<input type="checkbox" class="checkbox" name="member_flags" value="1" checked />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="member_flags" value="1" />
<?php } ?>
					</div>
				</td></tr>
				
				<tr>
					<td class="forum-index-stats-header forum-index-top">
						<?php echo $lang_admin['settings_username_title']; ?>
					</td>
				</tr>
				<tr>
					<td class="forum-jump-content forum-index-top forum-index-bottom">
						<?php echo $lang_admin['settings_username_desc']; ?><br /><br />
						
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_admin['settings_username_box']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
							<input type="text" name="username_length" value="<?php echo $username_length; ?>" />
						</div>
					</td>
				</tr>
				
				<tr>
					<td class="forum-index-stats-header forum-index-top">
						<?php echo $lang_admin['settings_usertitle_title']; ?>
					</td>
				</tr>
				<tr>
					<td class="forum-jump-content forum-index-top forum-index-bottom">
						<?php echo $lang_admin['settings_usertitle_desc']; ?><br /><br />
						
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_admin['settings_usertitle_box']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
							<input type="text" name="usertitle_length" value="<?php echo $usertitle_length; ?>" />
						</div>
					</td>
				</tr>
				
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_tags_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['settings_tags_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['settings_tags_on']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($show_gamer_tags=="1"){ ?>
						<input type="checkbox" class="checkbox" name="show_gamer_tags" value="1" checked />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="show_gamer_tags" value="1" />
<?php } ?>
					</div>
				</td></tr>
				
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_password_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">			
					<?php echo $lang_admin['settings_password_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['settings_password_days']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="change_pass_time" value="<?php echo "$change_pass_time"; ?>" onkeyup="checkit(pass_time)" />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_sef_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">	
					<?php echo $lang_admin['settings_sef_desc']; ?></span><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['settings_sef_on']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($sef_urls=="1"){ ?>
						<input type="checkbox" class="checkbox" name="sef_urls" value="1" checked />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="sef_urls" value="1" />
<?php } ?>
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_force_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">	
					<?php echo $lang_admin['settings_force_desc']; ?><br /><br />
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_admin['settings_force_views']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
							<input type="text" name="max_guest_clicks" value="<?php echo "$max_guest_clicks"; ?>" />
						</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_warn_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['settings_warn_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['settings_warn_level']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="max_warn" value="<?php echo "$max_warn"; ?>" onkeyup="checkit(max_warn)" />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_theme_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['settings_theme_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['settings_theme_select']; ?></strong>
					</div>
					<div style="width: 40%; float: left;">
						<select name="theme">
							<option value="<?php echo "$current_theme"; ?>" selected="selected"><?php echo "$current_theme_name"; ?></option>
							<optgroup label="<?php echo $lang['footer_theme']; ?>">
<?php }elseif($template_hook=="4"){ ?>
							</optgroup>
						</select>
					</div>
					<div style="width: 30%; float: left; text-align: right;">
						<input type="checkbox" class="checkbox" name="force_theme" value="1" />
						<strong><?php echo $lang_admin['settings_theme_force']; ?></strong>
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_lang_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['settings_lang_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['settings_lang_select']; ?></strong>
					</div>
					<div style="width: 40%; float: left;">
						<select name="board_lang">
							<option value="<?php echo "$board_lang"; ?>" selected="selected"><?php echo "$board_lang_name"; ?></option>
							<optgroup label="Select Language">
								<?php list_lang("lang/"); ?>
							</optgroup>
						</select>
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['settings_visitors_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['settings_visitors_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['settings_visitors_show']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($online_yesterday=="1"){ ?>
						<input type="checkbox" class="checkbox" name="online_yesterday" value="1" checked />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="online_yesterday" value="1" />
<?php } ?>
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
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
<?php }elseif ($template_hook=='successSaved'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['settings_saved']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>