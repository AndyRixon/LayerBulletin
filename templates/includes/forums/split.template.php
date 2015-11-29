<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
		<!-- split form -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang['split_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="settings" method="post" action="<?php echo lb_link("index.php?func=split", "split"); ?>">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang['split_topic']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang['split_details']; ?>
					<br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang['split_topic_title']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="title" value="<?php echo "$title"; ?>" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang['split_topic_desc']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="description" value="<?php echo "$description"; ?>" />
						<br /><br />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<input type="hidden" name="post" value="<?php echo "$post"; ?>" />
<?php if ($can_split_topics=='1'){ ?>
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