<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=="2"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['home_title']; ?></td></tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<form name="submit" id="submit" method="post" action="<?php echo "$lb_domain"; ?>/index.php?page=admin">
				<tr><td class="forum-jump-content" style="width: 100%;">
					<?php echo $lang_admin['home_desc']; ?><br /><br />
					<div style="float: left; width: 98%;">
						<textarea style="float: left; width: 100%; height: 250px;" class="post" name="content" id="content"><?php echo "$content"; ?></textarea>
						<input type="hidden" name="form" value="1" />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
<?php if($can_change_forum_settings=='1' OR $can_change_site_settings=='1'){ ?>
					<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
					<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
					<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
				</td></tr>
			</form>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='1'){ ?>
		<table cellpadding="0" cellspacing="0">
			<tr><td>
<?php }elseif ($template_hook=='3'){ ?>
				<table class="forum-jump module-not-installed" cellpadding="0" cellspacing="0">
					<tr><td class="forum-jump-content">
						<img style="vertical-align: middle;" src="<?php echo "$minus_img"; ?>" alt="" /> <a style="vertical-align: middle;" href="<?php echo lb_link('index.php?page=admin&act=settings', 'admin/settings'); ?>"><?php echo $lang_admin['home_offline']; ?></a>
					</td></tr>
				</table>
			</td>
			<td style="width: 20%; padding-left: 5px;">	
<?php }elseif ($template_hook=='4'){ ?>
				<table class="forum-jump module-installed" cellpadding="0" cellspacing="0">
					<tr><td class="forum-jump-content">
						<img style="vertical-align: middle;" src="<?php echo "$plus_img"; ?>" alt="" /> <a style="vertical-align: middle;" href="<?php echo lb_link('index.php?page=admin&act=settings#offline', 'admin/settings#offline'); ?>"><?php echo $lang_admin['home_online']; ?></a>
					</td></tr>
				</table>
			</td>
			<td style="width: 20%; padding-left: 5px;">	
<?php }elseif ($template_hook=='5'){ ?>
				<table class="forum-jump module-not-installed" cellpadding="0" cellspacing="0">
					<tr><td class="forum-jump-content">
						<img style="vertical-align: middle;" src="<?php echo "$minus_img"; ?>" alt="" /> <a style="vertical-align: middle;" href="<?php echo lb_link('index.php?page=admin&act=settings#register', 'admin/settings#register'); ?>"><?php echo $lang_admin['home_noregister']; ?></a>
					</td></tr>
				</table>
			</td>
			<td style="width: 20%; padding-left: 5px;">	
<?php }elseif ($template_hook=='6'){ ?>
				<table class="forum-jump module-installed" cellpadding="0" cellspacing="0">
					<tr><td class="forum-jump-content">
						<img style="vertical-align: middle;" src="<?php echo "$plus_img"; ?>" alt="" /> <a style="vertical-align: middle;" href="<?php echo lb_link('index.php?page=admin&act=settings#register', 'admin/settings#register'); ?>"><?php echo $lang_admin['home_register']; ?></a>
					</td></tr>
				</table>
			</td>
			<td style="width: 20%; padding-left: 5px;">
<?php }elseif ($template_hook=='8'){ ?>
				<table class="forum-jump module-not-installed" cellpadding="0" cellspacing="0">
					<tr><td class="forum-jump-content">
						<img style="vertical-align: middle;" src="<?php echo "$minus_img"; ?>" alt="" /> <a style="vertical-align: middle;" href="<?php echo lb_link('index.php?page=admin&act=attachments', 'admin/attachments'); ?>"><?php echo $lang_admin['home_noattachments']; ?></a>
					</td></tr>
				</table>
			</td>
			<td style="width: 20%; padding-left: 5px;">	
<?php }elseif ($template_hook=='9'){ ?>
				<table class="forum-jump module-installed" cellpadding="0" cellspacing="0">
					<tr><td class="forum-jump-content">
						<img style="vertical-align: middle;" src="<?php echo "$plus_img"; ?>" alt="" /> <a style="vertical-align: middle;" href="<?php echo lb_link('index.php?page=admin&act=attachments', 'admin/attachments'); ?>"><?php echo $lang_admin['home_attachments']; ?></a>
					</td></tr>
				</table>
			</td>
			<td style="width: 20%; padding-left: 5px;">
<?php }elseif ($template_hook=='10'){ ?>
				<table class="forum-jump module-not-installed" cellpadding="0" cellspacing="0">
					<tr><td class="forum-jump-content">
						<img style="vertical-align: middle;" src="<?php echo "$minus_img"; ?>" alt="" /> <a style="vertical-align: middle;" href="<?php echo lb_link('index.php?page=admin&act=spam', 'admin/spam'); ?>"><?php echo $lang_admin['home_spam_blank']; ?></a>
					</td></tr>
				</table>
<?php }elseif ($template_hook=='11'){ ?>
				<table class="forum-jump module-installed" cellpadding="0" cellspacing="0">
					<tr><td class="forum-jump-content">
						<img style="vertical-align: middle;"src="<?php echo "$plus_img"; ?>" alt="" /> <a style="vertical-align: middle;" href="<?php echo lb_link('index.php?page=admin&act=spam', 'admin/spam'); ?>"><?php echo $lang_admin['home_spam_current']; ?></a>
					</td></tr>
				</table>
<?php }elseif ($template_hook=='12'){ ?>
				<table class="forum-jump module-half" cellpadding="0" cellspacing="0">
					<tr><td class="forum-jump-content">
						<img style="vertical-align: middle;"src="<?php echo "$info_img"; ?>" alt="" /> <a style="vertical-align: middle;" href="<?php echo lb_link('index.php?page=admin&act=spam', 'admin/spam'); ?>"><?php echo $lang_admin['home_spam_half']; ?></a>
					</td></tr>
				</table>
<?php } elseif ($template_hook == 13){ ?>

				<table class="forum-jump module-not-installed" cellpadding="0" cellspacing="0">
					<tr>
						<td class="forum-jump-content">
							<img style="vertical-align: middle;"src="<?php echo $minus_img; ?>" alt="" />
							<a style="vertical-align: middle;" href="<?php echo $contents[1]; ?>" target="_blank">
								<?php echo $lang_admin['home_version_update']; ?>
							</a>
						</td>
					</tr>
				</table>
			</td>
			<td style="width: 20%; padding-left: 5px;">	

<?php } elseif ($template_hook == 14){ ?>

				<table class="forum-jump module-installed" cellpadding="0" cellspacing="0">
					<tr>
						<td class="forum-jump-content">
							<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
							<?php echo $lang_admin['home_version_current']; ?>
						</td>
					</tr>
				</table>
			</td>
			<td style="width: 20%; padding-left: 5px;">	

<?php }elseif ($template_hook=='7'){ ?>
			</td></tr>
		</table>
		<div class="spacer">&nbsp;</div>
<?php }elseif ($template_hook == 15){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0" style="border:1px solid red;">
			<tr><td class="forum-topic-subject" style="border:gray;background:#EFF1F3;color:black;"><?php echo $lang_admin['home_install.php_exists']; ?></td></tr>
		</table>
		<div style="height:20px;"></div>
<?php }elseif ($template_hook == 16){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0" style="border:1px solid red;">
			<tr><td class="forum-topic-subject" style="border:gray;background:#EFF1F3;color:black;"><?php echo $lang_admin['home_update.php_exists']; ?></td></tr>
		</table>
		<div style="height:20px;"></div>
<?php }elseif ($template_hook=='successSaved'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['home_whiteboard_saved']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>