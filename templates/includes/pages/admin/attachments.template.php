<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='2'){ ?>
			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr><td class="forum-topic-subject"><?php echo $lang_admin['attachments_title']; ?></td></tr>
				<tr><td class="forum-index-stats-sub"> </td></tr>
			</table>
			<form name="settings" method="post" action="<?php echo lb_link("index.php?page=admin&act=attachments","admin/attachments"); ?>">
				<table class="forum-index" cellpadding="0" cellspacing="0">
					<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['attachments_change']; ?></td></tr>
					<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
						<?php echo $lang_admin['attachments_desc']; ?><br /><br />
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_admin['attachments_allow']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
<?php if ($allow_attachments=='1'){ ?>
							<input type="checkbox" class="checkbox" name="allow_attachments" value="<?php echo "$allow_attachments"; ?>" checked />
<?php }else{ ?>
							<input type="checkbox" class="checkbox" name="allow_attachments" value="1" />
<?php } ?>
						</div>
					</td></tr>
					<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['attachments_size_title']; ?></td></tr>
					<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
						<?php echo $lang_admin['attachments_size_desc']; ?><br /><br />
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_admin['attachments_size_avatar']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">	
							<input type="text" name="attach_avatar_size" value="<?php echo "$attach_avatar_size"; ?>" /><br /><br />
						</div>
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_admin['attachments_size_img']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">	
							<input type="text" name="attach_img_size" value="<?php echo "$attach_img_size"; ?>" /><br /><br />
						</div>
					</td></tr>
					<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
						<input type="hidden" name="post_form" value="1" />
<?php if($can_change_site_settings=='1'){ ?>
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
				<?php echo $lang_admin['attachments_saved']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>