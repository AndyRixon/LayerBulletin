<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='2'){ ?>
		<!-- edit area -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject" colspan="2"><?php echo $lang['edit_post']; ?></td>
			</tr>
		</table>
		<table class="forum-jump" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<form name="postcontent" method="post" action="<?php echo lb_link("index.php?func=edit","edit"); ?>"><?php if ($title!=''){ ?>
						<table class="forum-jump" cellpadding="0" cellspacing="0">
							<tr>
								<td class="forum-jump-content" style="width:100%;">
									<div style="padding-left:110px;">
										<strong><?php echo $lang['edit_subject']; ?></strong><br />
										<input type='text' name='subject' size='50' maxlength='50' value='<?php echo "$title"; ?>' tabindex="1" /><br />
										<strong><?php echo $lang['edit_desc']; ?></strong><br />
										<input type='text' name="description" size='50' value='<?php echo "$description"; ?>' tabindex="2" />
									</div>
								</td>
							</tr>
						</table>
<?php } ?>
						<div class="smilies">
							<div class="smilies-header"></div>
							<div class="smilies-content">
								<?php include "includes/forums/smilies_insert.php"; ?>
								<br />(<a href="javascript:SmiliesPopUp('<?php echo "$lb_domain"; ?>/includes/forums/smilies_popup.php')""><?php echo $lang['addreply_emoticons']; ?></a>)
							</div>
						</div>
						<div class="textarea-addreply">
							<textarea name="content" id="content" class="post" tabindex="3"><?php echo "$content"; ?></textarea>
							<script>
								bbcode_toolbar = new Control.TextArea.ToolBar.BBCode('content');
								bbcode_toolbar.toolbar.container.id = 'bbcode_toolbar';
							</script>
<?php } elseif($template_hook=='3'){ ?>
							<div class="spacer">&nbsp;</div>
							<table class="forum-jump" cellpadding="0" cellspacing="0">
								<tr><td class="forum-jump-content full-border">
									<img  src="<?php echo "$poll_icon_img"; ?>" alt="" /> <a href="javascript: showhide('addpoll');" style="font-size: 11px;"><?php echo $lang['edit_poll']; ?></a>
									<div id="addpoll" style="display: none;">
										<br />
										<table style="width: 100%;" cellpadding="0" cellspacing="0">											<tr>												<td><strong><?php echo $lang['edit_poll_question']; ?></strong></td>												<td><input type="text" name="question" size="50" value="<?php echo "$question"; ?>" /></td>											</tr>											<tr>												<td><?php echo $lang['edit_poll_option1']; ?></td>												<td><input type="text" name="option1" size="50" value="<?php echo "$option1"; ?>" /></td>											</tr>											<tr>												<td><?php echo $lang['edit_poll_option2']; ?></td>												<td><input type="text" name="option2" size="50" value="<?php echo "$option2"; ?>" /></td>											</tr>											<tr>												<td><?php echo $lang['edit_poll_option3']; ?></td>												<td><input type="text" name="option3" size="50" value="<?php echo "$option3"; ?>" /></td>											</tr>											<tr>												<td><?php echo $lang['edit_poll_option4']; ?></td>												<td><input type="text" name="option4" size="50" value="<?php echo "$option4"; ?>" /></td>											</tr>											<tr>												<td><?php echo $lang['edit_poll_option5']; ?></td>												<td><input type="text" name="option5" size="50" value="<?php echo "$option5"; ?>" /></td>											</tr>											<tr>												<td><?php echo $lang['edit_poll_option6']; ?></td>												<td><input type="text" name="option6" size="50" value="<?php echo "$option6"; ?>" /></td>											</tr>											<tr>												<td><?php echo $lang['edit_poll_option7']; ?></td>												<td><input type="text" name="option7" size="50" value="<?php echo "$option7"; ?>" /></td>											</tr>											<tr>												<td><?php echo $lang['edit_poll_option8']; ?></td>												<td><input type="text" name="option8" size="50" value="<?php echo "$option8"; ?>" /></td>											</tr>											<tr>												<td><?php echo $lang['edit_poll_option9']; ?></td>												<td><input type="text" name="option9" size="50" value="<?php echo "$option9"; ?>" /></td>											</tr>											<tr>												<td><?php echo $lang['edit_poll_option10']; ?></td>												<td><input type="text" name="option10" size="50" value="<?php echo "$option10"; ?>" /></td>											</tr>										</table>									</div>
								</td></tr>
							</table>
<?php } elseif($template_hook=='4'){ ?>
							<div class="spacer">&nbsp;</div>
							<table class="forum-jump" cellpadding="0" cellspacing="0">
								<tr><td class="forum-jump-content full-border">
									<img  src="<?php echo "$zip_icon_img"; ?>" alt="" />
									<?php echo $lang['edit_file']; ?>
									<div id="file">
									<object name="uploadframe" data="<?php echo "$lb_domain"; ?>/uploads/upload.php?topicid=<?php echo "$new_topic"; ?>&attachtype=attachments&member=<?php echo "$uploader_id"; ?>&hash=<?php echo "$hash"; ?>" type="text/html" class="attachment-jump"></object>
									</div>
								</td></tr>
							</table><?php } elseif($template_hook=='5'){ ?><?php if ($title!=''){ ?>							<div class="spacer">&nbsp;</div>	
							<table class="forum-jump" cellpadding="0" cellspacing="0">
								<tr><td class="forum-jump-content full-border"><?php if ($can_sticky_topics=='1'){ ?><?php if ($sticky=='0'){ ?>									<strong><?php echo $lang['edit_sticky']; ?></strong>&nbsp;
									<input type="checkbox" class="checkbox" name="sticky" value="1" tabindex="4"><?php }else{ ?>									<strong><?php echo $lang['edit_sticky']; ?></strong>&nbsp;
									<input type="checkbox" class="checkbox" name="sticky" value="1" tabindex="4" checked><?php } ?>
									&nbsp;&nbsp;&nbsp;<?php } if ($can_global_announce=='1'){ if ($announce=='1'){ ?>									<strong><?php echo $lang['edit_announce']; ?></strong>&nbsp;
									<input type="checkbox" class="checkbox" name="announce" value="1" tabindex="5" checked><?php }else{ ?>									<strong><?php echo $lang['edit_announce']; ?></strong>&nbsp;
									<input type="checkbox" class="checkbox" name="announce" value="1" tabindex="5"><?php } ?>									&nbsp;&nbsp;&nbsp;<?php } if ($can_lock_topics=='1'){ if ($locked=='0'){ ?>									<strong><?php echo $lang['edit_lock']; ?></strong>&nbsp;
									<input type="checkbox" class="checkbox" name="locked" value="1" tabindex="6"><?php }else{ ?>									<strong><?php echo $lang['edit_lock']; ?></strong>&nbsp;
									<input type="checkbox" class="checkbox" name="locked" value="1" tabindex="6" checked><?php } ?>									&nbsp;&nbsp;&nbsp;				<?php } if ($can_sticky_topics=='0'){ ?>									<input type="hidden" name="sticky" value="<?php echo "$sticky"; ?>" /><?php }if ($can_global_announce=='0'){ ?>									<input type="hidden" name="announce" value="<?php echo "$announce"; ?>" /><?php }if ($can_lock_topics=='0'){ ?>									<input type="hidden" name="locked" value="<?php echo "$locked"; ?>" />				<?php } ?>								</td></tr>							</table><?php } ?>							<div class="spacer">&nbsp;</div>
							<table class="forum-jump" cellpadding="0" cellspacing="0">
								<tr><td class="forum-jump-content full-border" style="width:100%;">									<strong><?php echo $lang['edit_reason']; ?></strong><br />
									<input type="text" name="edit_reason" style="width: 98%;" tabindex="7" />
								</td></tr>
							</table>
							<br /><br />
							<input type="hidden" name="forum" value="<?php echo "$forum_id"; ?>" />
							<input type="hidden" name="topic" value="<?php echo "$topic_id"; ?>" />
							<input type="hidden" name="poll" value="<?php echo "$poll_id"; ?>" />
							<input type="hidden" name="post" value="<?php echo "$id"; ?>" />
							<input type="hidden" name="hash" value="<?php echo "$hash"; ?>" />
							<br /><br /><?php if ($can_edit_own_posts=='1' OR $can_edit_others_posts=='1'){ ?>
							<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
							<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?><?php if ($moderated=='0'){ ?>
							<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" tabindex="8" /><?php }else{ ?>
							<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" tabindex="8" onclick="javascript:return confirm('<?php echo $lang['topic_approve_warn']; ?>')" />
							<?php } ?>
							</form>
						<form name="preview" action="<?php echo "$lb_domain"; ?>/includes/forums/preview.php" method="post" target="preview">
							<input type="hidden" name="content" />
							<input type="submit" class="submit-button img-preview" name="preview" value="<?php echo $lang['button_preview']; ?>" onclick="copydata()" tabindex="9" />
						</form>
					</div>
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"></td></tr>
		</table>
		<script language="javascript">
			function copydata() {
				document.preview.content.value = document.postcontent.content.value;
				window.open('<?php echo "$lb_domain"; ?>/includes/forums/preview.php', 'preview', 'height=400,width=700,scrollbars=yes');
			}
		</script>
<?php }elseif ($template_hook=='end'){ ?><?php } ?>