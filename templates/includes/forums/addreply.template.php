<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='2'){ ?>
		<!-- start reply area -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject"><?php echo $lang['topic_reply']; ?></td>
				<td style="text-align: right;"></td>
			</tr>
		</table>
		<table class="forum-jump" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<div class="smilies">
						<div class="smilies-header"></div>
						<div class="smilies-content">
							<!-- insert smilies -->
							<?php include "includes/forums/smilies_insert.php"; ?>
							<br />(<a href="javascript:SmiliesPopUp('<?php echo "$lb_domain"; ?>/includes/forums/smilies_popup.php')"><?php echo $lang['addreply_emoticons']; ?></a>)
						</div>
					</div>
					<div class="textarea-addreply">
						<form method="post" name="postcontent" action="<?php echo lb_link("index.php?func=addreply", "addreply"); ?>">
							<!-- show textarea -->
							<textarea name="content" id="content" class="post" tabindex="1"><?php echo "$quote"; ?></textarea>
							<script>
								bbcode_toolbar = new Control.TextArea.ToolBar.BBCode('content');
								bbcode_toolbar.toolbar.container.id = 'bbcode_toolbar';
							</script>
<?php if ($allow_attachments=='0'){} elseif ($can_add_attachment=='1'){ ?>
							<!-- show attachments area -->
							<div class="spacer">&nbsp;</div>
							<table class="forum-jump" cellpadding="0" cellspacing="0">
								<tr><td class="forum-jump-content full-border">
									<img  src="<?php echo "$zip_icon_img"; ?>" alt="" /> <?php echo $lang['addreply_attach']; ?>
									<div id="file">
										<object name="uploadframe" data="<?php echo "$lb_domain"; ?>/uploads/upload.php?topicid=<?php echo "$topic"; ?>&attachtype=attachments&member=<?php echo "$uploader_id"; ?>&hash=<?php echo "$hash"; ?>" type="text/html" class="attachment-jump"></object>
									</div>
								</td></tr>
							</table>
							<div class="spacer">&nbsp;</div>
<?php } ?>
							<input type="hidden" name="topic" value="<?php echo "$topic"; ?>" />
							<input type="hidden" name="hash" value="<?php echo "$hash"; ?>" />
<?php if ($can_reply_topics=='1'){ ?>
							<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
							<input type="hidden" name="token_addreply_<?php echo "$topic$token_id"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
<?php if ($moderated=='0'){ ?>
							<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" onclick="bb_delcookie();" tabindex="2" />
<?php }else{ ?>
							<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" onclick="bb_delcookie();" tabindex="2" onclick="javascript:return confirm('<?php echo $lang['topic_approve_warn']; ?>')"  />
<?php } ?>
						</form>
						<form name="preview" action="<?php echo "$lb_domain"; ?>/includes/forums/preview.php" method="post" target="preview">
							<input type="hidden" name="content" />
							<input type="submit" class="submit-button img-preview" name="preview" value="<?php echo $lang['button_preview']; ?>" onclick="copydata()" tabindex="3" />
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
<?php }elseif ($template_hook=='form'){ ?>
	
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>