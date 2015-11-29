<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
		<!-- verified -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject"> </td>
				<td style="text-align: right;"></td>
			</tr>
		</table>
		<table class="forum-board" cellpadding="0" cellspacing="0">
			<tr>
				<td class="error-header" style="width:100%;">
					<?php echo $lang['verify_email']; ?>
				</td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<?php echo $lang['verify_verified']; ?>
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='2'){ ?>
		<!-- not verified -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject"> </td>
				<td style="text-align: right;"></td>
			</tr>
		</table>
		<table class="forum-board" cellpadding="0" cellspacing="0">
			<tr>
				<td class="error-header" style="width:100%;">
					<?php echo $lang['verify_email']; ?>
				</td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<?php echo $lang['verify_failed']; ?>
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='end'){ ?>		
<?php } ?>