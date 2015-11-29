<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['modules_title']; ?></td></tr>
<tr><td class="forum-index-stats-sub"> </td></tr>
</table>
			<form name="modules" method="post" enctype="multipart/form-data" action="<?php echo "$lb_domain"; ?>/index.php?page=admin&act=modules">
		<table class="forum-index" cellpadding="0" cellspacing="0">
		<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['modules_upload']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['modules_upload_desc']; ?><br /><br />
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_admin['modules_upload']; ?>:</strong>
						</div>
						<div style="width: 70%; float: left;">
<input type="hidden" name="MAX_FILE_SIZE" value="100000000000" />
<input type="hidden" name="upload" value="1" />
<input type="file" class="file" name="uploadedfile">
						</div>
</td></tr>
			<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<input type="submit" class="submit-button img-upload" value="<?php echo $lang['button_upload']; ?>" />
		</form>
</td></tr></table>
<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
<tr><td class="forum-index-forum-footer-contents"> </td></tr></table>
<br /><br />
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['modules_title']; ?></td></tr>
<tr><td class="forum-index-stats-sub"> </td></tr>
</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['modules_installed']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
<?php }elseif($template_hook=='3'){ ?>
</td></tr></table>

				<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
					<tr><td class="forum-index-forum-footer-contents"> </td></tr>
				</table>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>