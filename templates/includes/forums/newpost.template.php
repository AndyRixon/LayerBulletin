<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='2'){ ?>
		<!-- new topic form -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject"><?php echo $lang['newpost_heading']; ?></td>
				<td style="text-align: right;"></td>
			</tr>
		</table>
		<table class="forum-jump" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<form id="postcontent" method="post" name="postcontent" action="<?php echo lb_link("index.php?func=newpost","newpost"); ?>">
						<table class="forum-jump" cellpadding="0" cellspacing="0">
							<tr>
								<td class="forum-jump-content" style="width:100%;">
									<div style="padding-left:110px;">
										<strong><?php echo $lang['newpost_subject']; ?></strong>
										<br />
										<input type="text" name="subject" size="50" value="" maxlength="50" tabindex="1" />
										<br />
										<strong><?php echo $lang['newpost_description']; ?></strong>
										<br />
										<input type="text" name="description" size="50" value="" tabindex="2" />
										<br />
									</div>
								</td>
							</tr>
						</table>
						<div class="smilies">
							<div class="smilies-header"></div>
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
<?php if ($can_add_polls=='1'){ ?>
							<!-- polls area -->
                            <div class="spacer">&nbsp;</div>
							<table class="forum-jump full-border" cellpadding="0" cellspacing="0">
								<tr><td class="forum-jump-content">
									<img  src="<?php echo "$poll_icon_img"; ?>" alt="" /> <a href="javascript: showhide('addpoll');" style="font-size: 11px;"><?php echo $lang['newpost_poll']; ?></a>
									<div id="addpoll" style="display: none;">
										<br />
										<table style="width: 100%;">
											<tr>
												<td><strong><?php echo $lang['edit_poll_question']; ?></strong></td>
												<td><input type="text" name="question" size="50" value="" /></td>
											</tr>
											<tr>
												<td><?php echo $lang['edit_poll_option1']; ?></td>
												<td><input type="text" name="option1" size="50" value="" /></td>
											</tr>
											<tr>
												<td><?php echo $lang['edit_poll_option2']; ?></td>
												<td><input type="text" name="option2" size="50" value="" /></td>
											</tr>
											<tr>
												<td><?php echo $lang['edit_poll_option3']; ?></td>
												<td><input type="text" name="option3" size="50" value="" /></td>
											</tr>
											<tr>
												<td><?php echo $lang['edit_poll_option4']; ?></td>
												<td><input type="text" name="option4" size="50" value="" /></td>
											</tr>
											<tr>
												<td><?php echo $lang['edit_poll_option5']; ?></td>
												<td><input type="text" name="option5" size="50" value="" /></td>
											</tr>
											<tr>
												<td><?php echo $lang['edit_poll_option6']; ?></td>
												<td><input type="text" name="option6" size="50" value="" /></td>
											</tr>
											<tr>
												<td><?php echo $lang['edit_poll_option7']; ?></td>
												<td><input type="text" name="option7" size="50" value="" /></td>
											</tr>
											<tr>
												<td><?php echo $lang['edit_poll_option8']; ?></td>
												<td><input type="text" name="option8" size="50" value="" /></td>
											</tr>
											<tr>
												<td><?php echo $lang['edit_poll_option9']; ?></td>
												<td><input type="text" name="option9" size="50" value="" /></td>
											</tr>
											<tr>
												<td><?php echo $lang['edit_poll_option10']; ?></td>
												<td><input type="text" name="option10" size="50" value="" /></td>
											</tr>
                                            <tr>
												<td><?php echo $lang['edit_poll_multiple']; ?></td>
												<td><input type="checkbox" class="checkbox" name="multiple" value="1" /></td>
											</tr>
										</table>
									</div>
								</td></tr>
							</table>

<?php } ?>
<?php }elseif ($template_hook=='3'){ ?>
							<!-- prepare attachments area -->
							<div class="spacer">&nbsp;</div>
							<table class="forum-jump" cellpadding="0" cellspacing="0">
								<tr><td class="forum-jump-content full-border">
									<img  src="<?php echo "$zip_icon_img"; ?>" alt="" /> <?php echo $lang['edit_file']; ?>
									<div id="file">
<?php }elseif ($template_hook=='4'){ ?>
										<!-- show upload form -->
										<object id="uploadframe" standby="Loading..." data="<?php echo "$lb_domain"; ?>/uploads/upload.php?topicid=<?php echo "$new_topic"; ?>&attachtype=attachments&member=<?php echo "$uploader_id"; ?>&hash=<?php echo "$hash"; ?>" type="text/html" class="attachment-jump"></object>
									</div>
								</td></tr>
							</table>
<?php }elseif ($template_hook=='5'){ ?>
							<!-- final options and close form -->
							<div class="spacer">&nbsp;</div>
							<table class="forum-jump" cellpadding="0" cellspacing="0">
								<tr><td class="forum-jump-content full-border">
<?php if ($can_sticky_topics=='1'){ ?>
									<strong><?php echo $lang['edit_sticky']; ?></strong>&nbsp;
									<input type="checkbox" class="checkbox" name="sticky" value="1" tabindex="4">
									&nbsp;&nbsp;&nbsp;
<?php }else{ ?>
									<input type="hidden" name="sticky" value="0" />
<?php }if ($can_global_announce=='1'){ ?>
									<strong><?php echo $lang['edit_announce']; ?></strong>&nbsp;
									<input type="checkbox" class="checkbox" name="announce" value="1" tabindex="5">
<?php }else{ ?>
									<input type="hidden" name="announce" value="0" />
<?php }if ($can_lock_topics=='1'){ ?>
									<strong><?php echo $lang['edit_lock']; ?></strong>&nbsp;
									<input type="checkbox" class="checkbox" name="locked" value="1" tabindex="6">
<?php }else{ ?>
									<input type="hidden" name="locked" value="0" />
<?php } ?>
								</td></tr>
							</table>
							<input type="hidden" name="forum" value="<?php echo "$forum"; ?>" />
							<input type="hidden" name="hash" value="<?php echo "$hash"; ?>" />
							<div class="spacer">&nbsp;</div>
<?php if ($can_add_topics=='1'){ ?>
							<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
							<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
<?php if ($moderated=='0'){ ?>
							<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" tabindex="7" />
<?php }else{ ?>
							<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" tabindex="7" onclick="javascript:return confirm('<?php echo $lang['topic_approve_warn']; ?>')" />
<?php } ?>
						</form>
						<form name="preview" action="<?php echo "$lb_domain"; ?>/includes/forums/preview.php" method="post" target="preview">
							<input type="hidden" name="content" />
							<input type="hidden" name="subject" />
							<input type="submit" class="submit-button img-preview" name="preview" value="<?php echo $lang['button_preview']; ?>" onclick="copydata()" tabindex="8" />
						</form>
					</div>
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
		<script language="javascript">
			function copydata() {
				document.preview.content.value = document.postcontent.content.value;
				document.preview.subject.value = document.postcontent.subject.value;
				window.open('<?php echo "$lb_domain"; ?>/includes/forums/preview.php', 'preview', 'height=400,width=700,scrollbars=yes');
			}
		</script>
<?php }elseif ($template_hook=='form'){ ?>
	
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>