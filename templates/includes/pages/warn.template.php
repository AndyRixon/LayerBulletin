<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='2'){ ?>
		<!-- reason for warning -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang['warn_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>	
		<form name="settings" method="post" action="<?php echo lb_link("index.php?page=warn","warn/add/" . $id); ?>">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang['warn_select']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">			
					<?php echo $lang['warn_reason_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang['warn_reason_title']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="content" value="" style="width: 98%;" /><br /><br />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
<?php if ($_GET['act']=='add'){ ?>
					<input type="hidden" value="add" name="action" />
<?php } else{ ?>
					<input type="hidden" value="minus" name="action" />
<?php } ?>
<?php if ($can_warn_members=='1'){ ?>
					<input type="hidden" value="<?php echo "$id"; ?>" name="member" />
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
<?php } elseif ($template_hook=='3'){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject"> </td>
				<td style="text-align: right;"></td>
			</tr>
		</table>
		<table class="forum-board" cellpadding="0" cellspacing="0">
			<tr>
				<td class="error-header" style="width:100%;">
					<?php echo $lang['warn_error']; ?>
				</td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<?php echo $lang['warn_error_way']; ?>
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php } elseif ($template_hook=='4'){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject"> </td>
				<td style="text-align: right;"></td>
			</tr>
		</table>
		<table class="forum-board" cellpadding="0" cellspacing="0">
			<tr>
				<td class="error-header" style="width:100%;">
					<?php echo $lang['warn_error']; ?>
				</td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<?php echo $lang['warn_error_self']; ?>
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='end'){ ?>		
<?php } ?>