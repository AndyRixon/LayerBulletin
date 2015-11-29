<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=="3"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['members_edit_title']; ?> <?php echo "$name"; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="settings" method="post" action="<?php echo lb_link("index.php?page=admin&act=members","admin/members"); ?>">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['members_topic_top_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">			
					<?php echo $lang_admin['members_topic_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_topic_name']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="name" onkeyup="checkalpha(settings.name)" value="<?php echo "$name"; ?>" /><br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_topic_title']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="usertitle" value="<?php echo "$usertitle"; ?>" /><br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_topic_group']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<select name="role">
<?php }elseif ($template_hook=="4"){ ?>
<?php if ($role!='1' && $group_id=='1'){}elseif ($group_id==$their_role){ ?>
							<option value="<?php echo "$group_id"; ?>" selected><?php echo "$group_name"; ?></option>
<?php }else{ ?>
							<option value="<?php echo "$group_id"; ?>"><?php echo "$group_name"; ?></option>
<?php } ?>
<?php }elseif ($template_hook=="5"){ ?>
						</select>
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_topic_location']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="location" value="<?php echo "$location"; ?>" /><br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_topic_nationality']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<select name="nationality">
							<option value=""></option>
<?php }elseif ($template_hook=="6"){ ?>
<?php if($nationshort==$nationality){ ?>
							<option value="<?php echo "$nationshort"; ?>" selected="selected"><?php echo "$nationname"; ?></option>
<?php }else{ ?>
							<option value="<?php echo "$nationshort"; ?>"><?php echo "$nationname"; ?></option>
<?php } ?>
<?php }elseif ($template_hook=="7"){ ?>
						</select>
						<br /><br />
					</div>
<?php if ($verify_member!='1'){	?>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_topic_verify']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">					
						<input type="checkbox" class="checkbox" name="verify" value="1" />
					</div>
<?php }else{ ?>
						<input type="hidden" name="verify" value="1" />	
<?php } ?>						
					<br /><br />						
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_topic_avatar']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="remove_avatar" value="1" />
					</div>
					<br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_topic_signature']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="remove_signature" value="1" />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['members_mod_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['members_mod_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_mod_option']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($moderate=='1'){	?>
						<input type="checkbox" class="checkbox" name="moderate" value="1" checked="checked" />
<?php }else{ ?>					
						<input type="checkbox" class="checkbox" name="moderate" value="1" />
<?php } ?>
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['members_spam_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['members_spam_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_spam_option']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($never_spam=='1'){ ?>
						<input type="checkbox" class="checkbox" name="never_spam" value="1" checked="checked" />
<?php }else{ ?>					
						<input type="checkbox" class="checkbox" name="never_spam" value="1" />
<?php } ?>
					</div>						
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['members_suspend_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['members_suspend_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_suspend_days']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="suspend" onkeyup="checkit(suspend)" /><br /><br />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['members_comm_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['members_comm_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_comm_email']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="email" value="<?php echo "$email"; ?>" /><br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_comm_msn']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="msn" value="<?php echo "$msn"; ?>" /><br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_comm_aol']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="aol" value="<?php echo "$aol"; ?>" /><br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_comm_yim']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="yahoo" value="<?php echo "$yahoo"; ?>" /><br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_comm_skype']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="skype" value="<?php echo "$skype"; ?>" />
					</div>
				</td></tr>
<?php if ($show_gamer_tags=='1'){ ?>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['members_tags_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['members_tags_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_tags_xbox']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="xbox" value="<?php echo "$xbox"; ?>" /><br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_tags_wii']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="wii" value="<?php echo "$wii"; ?>" /><br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_tags_ps3']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="ps3" value="<?php echo "$ps3"; ?>" />
					</div>
				</td></tr>
<?php } ?>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['members_custom_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['members_custom_desc']; ?><br /><br />
<?php }elseif ($template_hook=="8"){ ?>
					<div style="width: 30%; float: left;">
						<strong><?php echo "$field_name"; ?>:</strong>
					</div>
					<div style="width: 70%; float: left;">
						<?php echo "$field_description"; ?><br />
						<input type="text" value="<?php echo "$field_content"; ?>" name="custom<?php echo "$field_id"; ?>" id="custom<?php echo "$field_id"; ?>" /><br /><br />
					</div>
<?php }elseif ($template_hook=="9"){ ?>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['members_password_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['members_password_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_password_change']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="change_password" value="1" /><br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['members_password_new']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="password" name="password" />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<input type="hidden" name="post_edit" value="1" />
					<input type="hidden" name="id" value="<?php echo "".$_GET['id'].""; ?>" />
					<input type="hidden" name="original_name" value="<?php echo "$name"; ?>" />
					<input type="hidden" name="original_role" value="<?php echo "$their_role"; ?>" />
					<div style="width:50%; float:left;">
<?php if($can_edit_members=='1'){ ?>
						<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
						<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
						<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
					</div>
				</form>
				<div style="width:50%; float:right; text-align:right; padding-top:2px;">
<?php if ($their_role!='1'){ ?>	
<?php if ($can_ban_members=='1'){ ?>			
<?php if ($banned=='0'){ ?>
					<form name="ban_member" method="post" action="<?php echo "$lb_domain"; ?>/index.php?page=admin&act=members&func=ban">
						<input type="hidden" name="token_id" value="<?php echo $token_id; ?>" />
						<input type="hidden" name="<?php echo $token_name; ?>" value="<?php echo $token; ?>" />
						<input type="hidden" name="id" id="id" value="<?php echo "".$_GET['id'].""; ?>">
						<input onclick="javascript:return confirm('<?php echo $lang_admin['members_ban']; ?>')" type="submit" class="submit-button button-remove img-ban" value="<?php echo $lang['button_ban']; ?>" />					
					</form>
<?php } else{ ?>
					<form name="ban_member" method="post" action="<?php echo "$lb_domain"; ?>/index.php?page=admin&act=members&func=ban">
						<input type="hidden" name="token_id" value="<?php echo $token_id; ?>" />
						<input type="hidden" name="<?php echo $token_name; ?>" value="<?php echo $token; ?>" />
						<input type="hidden" name="id" id="id" value="<?php echo "".$_GET['id'].""; ?>">
						<input onclick="javascript:return confirm('<?php echo $lang_admin['members_unban']; ?>')" type="submit" class="submit-button img-ban" value="<?php echo $lang['button_unban']; ?>" />							
					</form>
<?php }} ?>	
					<form name="unban_member" method="post" action="<?php echo "$lb_domain"; ?>/index.php?page=admin&act=members&func=delete">
						<input type="hidden" name="token_id" value="<?php echo $token_id; ?>" />
						<input type="hidden" name="<?php echo $token_name; ?>" value="<?php echo $token; ?>" />
						<input type="hidden" name="id" id="id" value="<?php echo "".$_GET['id'].""; ?>">
						<input onclick="javascript:return confirm('<?php echo $lang['topic_remove']; ?>')" type="submit" class="submit-button img-delete-member" value="<?php echo $lang['button_delete']; ?>" />						
					</form>
				</div>
<?php } ?>
			</td></tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=="10"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['members_select_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-stats-header forum-index-top"> </td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
				<?php echo $lang_admin['members_select_desc']; ?>
			</td></tr>
			<tr><td class="forum-index-stats-header forum-index-top"> </td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">			
				<form name="name" method="get" action="<?php echo "$lb_domain"; ?>/index.php" class="asholder">
					<?php echo $lang_admin['members_select_name']; ?> 
					<input type="hidden" name="page" value="admin" />
					<input type="hidden" name="act" value="members" />
					<input type="hidden" name="func" value="edit" />
					<input type="hidden" id="id" name="id" value="" />
                    <input type="text" id="inputname" name="inputname" value="" /> 
					<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
				</form>
			</td></tr>
			<tr><td class="forum-index-stats-header forum-index-top"> </td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
				<form name="email" method="get" action="<?php echo "$lb_domain"; ?>/index.php" class="asholder">
					<?php echo $lang_admin['members_select_email']; ?> 
					<input type="hidden" name="page" value="admin" />
					<input type="hidden" name="act" value="members" />
					<input type="hidden" name="func" value="edit" />
					<input type="hidden" id="idemail" name="idemail" value="" />
					<input type="text" id="inputemail" value="" /> 
					<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
				</form>
			</td></tr>
		</table>
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
<script type="text/javascript">
	var options = {
		script:"<?php echo "$lb_domain"; ?>/scripts/php/autosuggest.php?json=true&admin=1&email=1&limit=20&",
		varname:"input",
		json:true,
		shownoresults:true,
		maxresults:1000,
		cache: false,
		callback: function (obj) { document.getElementById('idemail').value = obj.id; }
	};
	var as_json = new bsn.AutoSuggest('inputemail', options);
	
	
	var options_xml = {
		script: function (input) { return "<?php echo "$lb_domain"; ?>/scripts/php/autosuggest.php?input="+input+"&member="+document.getElementById('idemail').value; },
		varname:"input"
	};
	var as_xml = new bsn.AutoSuggest('testinput_xml', options_xml);
</script>		
<?php }elseif ($template_hook=='successUpdated'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['members_updated']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successDeleted'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['members_deleted']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successBanned'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['members_banned']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successUnbanned'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['members_unbanned']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>