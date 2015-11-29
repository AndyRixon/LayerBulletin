<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr><td class="forum-topic-subject"><?php echo $lang_user['information_title']; ?></td></tr>
				<tr><td class="forum-index-stats-sub"> </td></tr>
			</table>
			<form method="post" action="<?php echo lb_link("index.php?page=myoptions&act=settings","myoptions/settings"); ?>">
				<table class="forum-index" cellpadding="0" cellspacing="0">
<?php }elseif($template_hook=='2'){ ?>
					<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_user['settings_admin_email_title']; ?></td></tr>
					<tr><td class="forum-jump-content forum-index-top forum-index-bottom">		
						<?php echo $lang_user['settings_admin_email']; ?><br /><br />
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_user['settings_admin_email_desc']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
<?php if ($allow_admin_email=='1'){ ?>
							<input type="checkbox" value="1" class="checkbox" checked="checked" name="allow_admin_email" id="allow_admin_email" />
<?php }else{ ?>
							<input type="checkbox" value="1" class="checkbox" name="allow_admin_email" id="allow_admin_email" />
<?php } ?>
						</div>
<?php }elseif($template_hook=='3'){ ?>
					</td></tr>
					<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_user['settings_interface_title']; ?></td></tr>
					<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
						<?php echo $lang_user['settings_interface_desc']; ?><br /><br />
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_user['settings_interface_show_fast_reply']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
<?php if ($show_fast_reply=='1'){ ?>
							<input type="checkbox" value="1" class="checkbox" checked="checked" name="show_fast_reply" id="show_fast_reply" />
<?php }else{ ?>
							<input type="checkbox" value="1" class="checkbox" name="show_fast_reply" id="show_fast_reply" />
<?php } ?>
						</div>
					</td></tr>
					<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
						<div style="width:100%;">
							<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
							<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
							<input type="hidden" name="form_submit" value="1" />
							<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
						</div>
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
				<?php echo $lang_user['settings_saved']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>		
<?php } ?>
