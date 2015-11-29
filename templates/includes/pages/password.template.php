<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
		<!-- create form -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang['password_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>	
		<form name="login" method="post" action="<?php echo lb_link("index.php?page=password", "password"); ?>">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"> </td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">	
					<?php echo $lang['password_desc']; ?><br /><br />
					<?php echo $lang['password_name']; ?><br />
					<input type="text" name="name" /><br />
					<?php echo $lang['password_email']; ?><br />
					<input type="text" name="email" /><br />
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
					<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
					<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
				</td></tr>
			</table>
		</form>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php } elseif($template_hook=='2'){ ?>
		<!-- success -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject"> </td>
			</tr>
		</table>
		<table class="forum-jump" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-jump-content">
					<div class="center">
						<h3><?php echo $lang['password_change']; ?></h3>
					</div>
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php } elseif($template_hook=='3'){ ?>
		<!-- fail -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject"> </td>
			</tr>
		</table>
		<table class="forum-jump" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-jump-content">
					<div class="center">
						<h3><?php echo $lang['password_fail']; ?></h3>
					</div>
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='end'){ ?>		
<?php } ?>
