<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject"> </td>
			</tr>
		</table>
		<table class="forum-board" cellpadding="0" cellspacing="0">
			<tr>
				<td class="error-header" style="width:100%;">
<?php } elseif ($template_hook=='2'){ ?>
					<?php echo $lang['blocked_register']; ?>
<?php } elseif ($template_hook=='3'){ ?>
					<?php echo $lang['blocked_wait']; ?>
				</td>
			</tr>
			<tr>
				<td class="forum-jump-content">
<?php } elseif ($template_hook=='4'){ ?>
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>