<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
		<script language="javascript">
			function copydata() {
				document.preview.content.value = document.postcontent.content.value;
				window.open('<?php echo "$lb_domain"; ?>/includes/forums/preview.php', 'preview', 'height=400,width=700,scrollbars=yes');
			}
		</script>
<?php if ($template_hook=='start'){ /* TAG EDIT */?>
		<script type="text/javascript">
			function toggletrmessage(messageid) {
				var togglebuttonstatus = document.getElementById('trmessagetogglebutton_' + messageid);
				var trmessage = document.getElementById('tr_message_' + messageid);
				var trfooteroptions = document.getElementById('tr_messagefooter_options_' + messageid);
				if(trmessage.style.display == 'none') {
					trmessage.style.display = '';
					trfooteroptions.style.display = '';
					togglebuttonstatus.innerHTML = 'Close (-)';
				} else {
					trmessage.style.display = 'none';
					trfooteroptions.style.display = 'none';
					togglebuttonstatus.innerHTML = 'Expand (+)';
				}
			}
		</script>
<?php }elseif ($template_hook=='3'){ ?>
		<!-- inbox -->
		<div class="new-topic-placer">
			<a class="submit-button-large img-add-forum" href="<?php echo lb_link("index.php?page=messages&act=new", "messages/new"); ?>" /><?php echo $lang['button_new_message']; ?></a>
		</div>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang['messages_my_messages']; ?></td></tr>
		</table>
		<table class="forum-board" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-board-unread-sub"></td>
				<td class="forum-board-subject-sub" style="width: 30%;"><?php echo $lang['messages_subject']; ?></td>
				<td class="forum-board-started-sub"><?php echo $lang['messages_from']; ?></td>
				<td class="forum-board-started-sub"><?php echo $lang['messages_to']; ?></td>
				<td class="forum-board-replies-sub"><?php echo $lang['messages_replies']; ?></td>
				<td class="forum-board-lastpost-sub" colspan="2"><?php echo $lang['messages_last_reply']; ?></td>
			</tr>
<?php }elseif($template_hook=='4'){ ?>
			<!-- show message -->
			<tr>
				<td class="forum-index-td-left<?php echo "$alt_td_class"; ?>" style="padding: 5px;">
<?php if ($my_read_time == '0'){ ?>
					<img src="<?php echo "$message_new_img"; ?>" alt="<?php echo $lang['messages_unread']; ?>" title="<?php echo $lang['messages_unread']; ?>" />
<?php }else{ ?>
					<img src="<?php echo "$message_read_img"; ?>" alt="<?php echo $lang['messages_read']; ?>" title="<?php echo $lang['messages_read']; ?>"  />
<?php } ?>
				</td>
				<td class="forum-index-td-middle<?php echo "$alt_td_class"; ?>" style="vertical-align: middle; style="padding: 5px;"">
					<a class="topic-link-board"  href="<?php echo lb_link("index.php?page=messages&id=$topic_id", "messages/$topic_id"); ?>"><?php echo "$title"; ?></a>
				</td>
				<td class="forum-index-td-topics<?php echo "$alt_td_class"; ?>" style="padding: 5px;">
<?php if ($name==''){ ?>
					<?php echo $lang['board_topic_unregistered']; ?>
<?php }else{ ?>
					<?php echo member_link($member_from, '0'); ?>
				</td>
				<td class="forum-index-td-posts<?php echo "$alt_td_class"; ?>" style="padding: 5px;">
<?php } if ($name==''){ ?>
					<?php echo $lang['board_topic_unregistered']; ?>
<?php }else{ ?>
					<?php echo member_link($member_to, '0'); ?>
				</td>
<?php } ?>
				<td class="forum-index-td-middle<?php echo "$alt_td_class"; ?>" style="padding: 5px; width: 7%; vertical-align: middle; text-align: center;">
					<?php echo "$replies"; ?>
				</td>
				<td class="forum-index-td-posts<?php echo "$alt_td_class"; ?>" style="width: 50%; text-align: left; padding: 5px;">
					<?php echo "$last_sent_time"; ?>
					<br />
					<a class="forum-index-link-to-topic"  href="<?php echo lb_link("index.php?page=messages&id=$topic_id#last", "messages/$topic_id#last"); ?>"><?php echo $lang['messages_last_by']; ?></a> 
<?php if ($last_poster==''){ ?>
					<?php echo $lang['board_topic_unregistered']; ?>
<?php }else{ ?>
					<?php echo member_link($last_poster_id, '0'); ?>
<?php } ?>
				</td>
				<td class="forum-index-td-right<?php echo "$alt_td_class"; ?>" style="padding: 5px;">
					<a href="<?php echo lb_link("index.php?page=messages&act=del&id=$topic_id", "messages/del/$topic_id"); ?>" onclick="javascript:return confirm('<?php echo $lang['topic_remove']; ?>')"><img  src="<?php echo "$delete_icon_img"; ?>" alt="<?php echo $lang['topic_option_delete']; ?>" title="<?php echo $lang['topic_option_delete']; ?>"  /></a>
				</td>
			</tr>
<?php }elseif($template_hook=='5'){ ?>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif($template_hook=='7'){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject"><?php echo $lang['messages_new']; ?></td>
				<td style="text-align: right;"></td>
			</tr>
		</table>
		<table class="forum-jump" cellpadding="0" cellspacing="0">
			<tr><td class="forum-jump-content" style="width:100%;">	
				<form name="postcontent" method="post" class="asholder" action="<?php echo lb_link("index.php?page=messages&act=new", "messages/new"); ?>">
					<table class="forum-jump" cellpadding="0" cellspacing="0">
						<tr><td class="forum-jump-content" style="width:100%;">
							<div style="padding-left:110px;">
								<strong><?php echo $lang['messages_new_subject']; ?></strong><br />
								<input type="text" name="subject" size="50" value="" tabindex="1" /><br />
								<strong><?php echo $lang['messages_new_recipient']; ?></strong><br />
								<input type="hidden" id="member_to" name="member_to" value="<?php echo "$prepared_id"; ?>" />
								<input type="text" id="inputname" value="<?php echo "$prepared_name"; ?>" tabindex="2" /> 
							</div>
						</td></tr>
					</table>
					<div class="smilies">
						<div class="smilies-header" style="position: relative;"></div>
						<div class="smilies-content">
							<?php include "includes/forums/smilies_insert.php"; ?>
							<br />(<a href="javascript:SmiliesPopUp('<?php echo "$lb_domain"; ?>/includes/forums/smilies_popup.php')"><?php echo $lang['addreply_emoticons']; ?></a>)
						</div>
					</div>
					<div class="textarea-addreply">
						<textarea name="content" id="content" class="post" tabindex="3"></textarea>
						<script>
							bbcode_toolbar = new Control.TextArea.ToolBar.BBCode('content');
							bbcode_toolbar.toolbar.container.id = 'bbcode_toolbar';
						</script>
						<br /><br />
<?php if ($can_pm=='1'){ ?>
						<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
						<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
						<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" tabindex="4" />
					</form>
					<form name="preview" action="<?php echo "$lb_domain"; ?>/includes/forums/preview.php" method="post" target="preview">
						<input type="hidden" name="content" />
						<input type="submit" class="submit-button img-preview" name="preview" value="<?php echo $lang['button_preview']; ?>" onclick="copydata()" tabindex="5" />
					</form>
				</div>
			</td></tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>		
<?php }elseif($template_hook=='11'){ ?>
		<div class="new-topic-placer">
			<a class="submit-button-large img-add-forum" href="<?php echo lb_link("index.php?page=messages&act=new", "messages/new"); ?>" /><?php echo $lang['button_new_message']; ?></a>
		</div>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr id="top"><td class="forum-topic-subject"><?php echo "$title"; ?></td></tr>
		</table>
		<table class="forum-board" cellpadding="0" cellspacing="0">
<?php }elseif($template_hook=='12'){ ?>
			<!-- prepare message -->
			<tr id="<?php echo "$post_id"; ?>">
<?php if ($member_online=='1'){ ?>
				<td class="forum-board-member-extra member-online">
<?php }else{ ?>
				<td class="forum-board-member-extra member-offline">
<?php } ?>
<?php }elseif($template_hook=='13'){
/* TAG EDIT */
if(!empty($TAG_message_number) && $TAG_message_number < $TAG_max_message) $TAG_message_status = 0;
else $TAG_message_status = 1;
?>
<?php if ($name==''){ ?>
					<?php echo $lang['board_topic_unregistered']; ?>
<?php } else{ ?>
					<?php echo member_link($id); ?>
<?php } ?>
				</td>
<?php if ($member_online=='1'){ ?>
				<td class="forum-board-post-extra member-online">
<?php }else{ ?>
				<td class="forum-board-post-extra member-offline">
<?php } ?>
					<span class="forum-topic-time">
						<img  src="<?php echo "$trackback_img"; ?>" alt="<?php echo $lang['topic_trackback']; ?>" />&nbsp;<?php echo "$time"; ?></span>

						<span class="forum-topic-admin"><a href="javascript:void(0);" onclick="toggletrmessage(<?php echo $post_id; ?>)" id="trmessagetogglebutton_<?php echo $post_id; ?>"><?php echo(($TAG_message_status == 0) ? 'Expand (+)' : 'Close (-)'); ?></a></span>
					</span>		 
				</td>
			</tr>
			<tr id="tr_message_<?php echo $post_id; ?>"<?php echo(($TAG_message_status == 0) ? ' style="display:none;"' : ''); ?>>
				<td class="forum-board-member">
<?php if ($usertitle!=''){ ?>
					<?php echo "$usertitle"; ?><br />
<?php } ?>
<?php }elseif ($template_hook=='36'){ ?>
					<img  src="<?php echo "$pip_img"; ?>" alt="" />
<?php }elseif ($template_hook=='37'){ ?>
					<br />
					<img style="max-width: <?php echo "$attach_avatar_size"; ?>px; _width: <?php echo "$attach_avatar_size"; ?>px;" src="<?php echo "$avatar"; ?>" alt="" /> 
					<br />
<?php if ($member_role!='1'){ if ($can_warn_members=='1'){ ?>
							<a class="warn-minus" href="<?php echo lb_link("index.php?page=warn&act=minus&id=$id", "warn/minus/$id"); ?>" title="<?php echo $lang['topic_warn_remove']; ?>">&nbsp;</a><a class="warn-mods warn-level<?php echo "$graphic_level"; ?>" href="javascript:WarnPopUp('<?php echo "$lb_domain"; ?>/includes/forums/warn_popup.php?id=<?php echo "$id"; ?>')" title="<?php echo $lang['topic_warn_level']; ?> <?php echo "$graphic_warn"; ?>%">&nbsp;</a><a class="warn-plus" href="<?php echo lb_link("index.php?page=warn&act=add&id=$id", "warn/add/$id"); ?>" title="<?php echo $lang['topic_warn_add']; ?>">&nbsp;</a>
							<br />
<?php }else{ ?>
							<!-- warn bar for non-mods -->
							<a class="warn-members warn-level<?php echo "$graphic_level"; ?>" href="javascript:WarnPopUp('<?php echo "$lb_domain"; ?>/includes/forums/warn_popup.php?id=<?php echo "$id"; ?>')" title="<?php echo $lang['topic_warn_level']; ?> <?php echo "$graphic_warn"; ?>%">&nbsp;</a>
							<br />
<?php }} ?>
					<div id="warn<?php echo "$post_id"; ?>" style="display: none;">
<?php }elseif($template_hook=='14'){ ?>
<?php if ($warn_action=='add'){ ?>
						<span class="warn-add"><?php echo "$warn_notes"; ?></span>
						<br /><?php echo $lang['topic_warn_add_details']; ?>
						<br /><br />
<?php } else{ ?>
						<span class="warn-remove"><?php echo "$warn_notes"; ?></span>
						<br /><?php echo $lang['topic_warn_remove_details']; ?>
						<br /><br />
<?php } ?>
<?php }elseif($template_hook=='15'){ ?>
					</div>

<?php if ($user_group_icon!='0'){ ?>
							<!-- show group icon -->
							<div class="group"><img src="<?php echo "$group_img"; ?>" alt="" />&nbsp;&nbsp;<span style="color: <?php echo "$user_group_color"; ?>;"><?php echo "$user_group_name"; ?></span></div><br />
<?php } ?>
					<?php echo $lang['topic_member_posts']; ?> <?php echo "$num_post"; ?><br />
					<?php echo $lang['topic_member_joined']; ?> <?php echo "$register_date"; ?><br />
<?php if ($location!=''){ ?>
					<?php echo $lang['topic_member_location']; ?> <?php echo "$location"; ?><br />
<?php } ?>
				</td>
				<td class="forum-board-post">
					<?php echo "$content"; ?>
<?php }elseif($template_hook=='16'){ ?>
					<!-- signature -->
					<br />
					<br />
					<hr />
					<span class="signature">
						<?php echo "$content"; ?>
					</span>
<?php }elseif($template_hook=='17'){
/* TAG EDIT */
if(!empty($TAG_message_number) && $TAG_message_number < $TAG_max_message) $TAG_message_status = 0;
else $TAG_message_status = 1;
?>
				</td>
			</tr>
			<tr id="tr_messagefooter_options_<?php echo $post_id; ?>"<?php echo(($TAG_message_status == 0) ? ' style="display:none"' : ''); ?>>
				<td class="forum-board-member forum-board-member-bottom">
					<a class="submit-button img-top" href="#top"><?php echo $lang['button_top']; ?></a>
<?php if ($can_pm=='1'){ if ($can_pm_this_member=='1'){ ?>
					<a class="submit-button img-email-go" href="<?php echo lb_link("index.php?page=messages&act=new&id=$id", "messages/new/$id"); ?>"><?php echo $lang['button_send_pm']; ?></a>
<?php } } ?>
				</td>
				<td class="forum-board-post forum-board-post-bottom"></td>
			</tr>
			<tr><td class="forum-board-quick-edit-left border-right" colspan="2"> </td></tr>
<?php }elseif($template_hook=='18'){ ?>
		</table>
		<div id="last" class="new-topic-placer">
			<br />
			<a class="submit-button-large img-add-forum" href="<?php echo lb_link("index.php?page=messages&act=new", "messages/new"); ?>" /><?php echo $lang['button_new_message']; ?></a>
			<a class="submit-button-large img-fast-reply" href="javascript: showhide('commentForm');"><?php echo $lang['button_fast_reply']; ?></a>
		</div>
		<div id="commentForm" style="text-align: left; position: relative; display: none;">
			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr>
					<td class="forum-topic-subject"><?php echo $lang['topic_reply']; ?></td>
					<td style="text-align: right;"></td>
				</tr>
			</table>
			<table class="forum-jump" cellpadding="0" cellspacing="0">
				<tr>
					<td class="forum-jump-content" style="width:100%;">		
						<div class="smilies" style="position: relative;">
							<div class="smilies-header"></div>
							<div class="smilies-content">
								<?php include "includes/forums/smilies_insert.php"; ?>
								<br />(<a href="javascript:SmiliesPopUp('<?php echo "$lb_domain"; ?>/includes/forums/smilies_popup.php')"><?php echo $lang['addreply_emoticons']; ?></a>)
							</div>
						</div>
						<div class="textarea-addreply">
							<form name="postcontent" method="post" action="<?php echo lb_link("index.php?page=messages&act=reply", "messages/reply"); ?>">
								<textarea name="content" id="content" class="post"></textarea>
								<script>
									bbcode_toolbar = new Control.TextArea.ToolBar.BBCode('content');
									bbcode_toolbar.toolbar.container.id = 'bbcode_toolbar';
								</script>
								<input type="hidden" name="topic" value="<?php echo "$id"; ?>" />
								<br /><br />
<?php if ($can_pm=='1'){ ?>
								<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
								<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
								<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
							</form>
							<form name="preview" action="<?php echo "$lb_domain"; ?>/includes/forums/preview.php" method="post" target="preview">
								<input type="hidden" name="content" />
								<input type="submit" class="submit-button img-preview" name="preview" value="<?php echo $lang['button_preview']; ?>" onclick="copydata()" />
							</form>	
						</div>
					</td>
				</tr>
			</table>
			<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-forum-footer-contents"> </td></tr>
			</table>				
		</div>

<?php }elseif($template_hook=='19'){ ?>
		<!-- messages today -->
		<tr>
			<td colspan="7" class="forum-index-stats-header">
				<span class="message-day"><?php echo $lang['date_today']; ?></span>
			</td>
		</tr>
<?php }elseif($template_hook=='20'){ ?>
		<!-- messages yesterday -->
		<tr>
			<td colspan="7" class="forum-index-stats-header">
				<span class="message-day"><?php echo $lang['date_yesterday']; ?></span>
			</td>
		</tr>
<?php }elseif($template_hook=='21'){ ?>
		<!-- messages this week -->
		<tr>
			<td colspan="7" class="forum-index-stats-header">
				<span class="message-day"><?php echo $lang['messages_this_week']; ?></span>
			</td>
		</tr>
<?php }elseif($template_hook=='22'){ ?>
	<!-- messages older -->
		<tr>
			<td colspan="7" class="forum-index-stats-header">
				<span class="message-day"><?php echo $lang['messages_older']; ?></span>
			</td>
		</tr>
<?php }elseif ($template_hook=='deletedSuccess'){ ?>
		<div style="border:1px solid green;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang['messages_message_deleted']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='sentSuccess'){ ?>
		<div style="border:1px solid green;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang['messages_message_sent']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>				
<?php } ?>
		<script type="text/javascript">
			var options = {
				script:"<?php echo "$lb_domain"; ?>/scripts/php/autosuggest.php?json=true&limit=6&member=<?php echo "$my_id"; ?>&",
				varname:"input",
				json:true,
				shownoresults:true,
				maxresults:1000,
				cache: false,
				callback: function (obj) { document.getElementById('member_to').value = obj.id; }
			};
			var as_json = new bsn.AutoSuggest('inputname', options);
			
			
			var options_xml = {
				script: function (input) { return "<?php echo "$lb_domain"; ?>/scripts/php/autosuggest.php?input="+input+"&member_to="+document.getElementById('member_to').value; },
				varname:"input"
			};
			var as_xml = new bsn.AutoSuggest('testinput_xml', options_xml);
		</script>
