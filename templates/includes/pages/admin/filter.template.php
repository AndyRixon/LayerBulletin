<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=="3"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['filter_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="settings" method="post" action="<?php echo lb_link("index.php?page=admin&act=filter","admin/filter"); ?>">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['filter_filter']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['filter_desc']; ?><br /><br />
<?php }elseif ($template_hook=="4"){ ?>
					<div style="width: 35%; float: left; vertical-align: middle;">
						<strong><?php echo "$word"; ?></strong>
					</div>
					<div style="width: 30%; float:left; vertical-align: middle;">
						<?php echo $lang_admin['filter_becomes']; ?>
					</div>
					<div style="width: 30%; float: left; vertical-align: middle;">
						<strong><?php echo "$new_word"; ?></strong>
					</div>
					<div style="width: 5%; float: left; vertical-align: middle;">
						<a href="<?php echo lb_link("index.php?page=admin&act=filter&id=$row","admin/filter/$row"); ?>" onclick="javascript:return confirm('<?php echo $lang['topic_remove']; ?>')"><img  src="<?php echo "$delete_icon_img"; ?>" alt="<?php echo $lang_admin['custom_delete']; ?>" /></a>
					</div>
<?php }elseif ($template_hook=="5"){ ?>
					<br /><br />
					<div style="width: 35%; float:left; vertical-align: middle;">
						<input type="text" size="10" name="old_word" />
					</div>
					<div style="width: 30%; float:left; vertical-align: middle; text-align: center;">
						<?php echo $lang_admin['filter_becomes']; ?>
					</div>
					<div style="width: 35%; float:left; vertical-align: middle;">
						<input type="text" size="10" name="new_word" />
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
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>