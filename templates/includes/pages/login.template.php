<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
		<!-- login form -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang['login_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		
		<form name="login" method="post" action="<?php echo lb_link("index.php?page=login", "login"); ?>">
		
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-jump-content forum-index-top forum-index-bottom">
				
					<table style="border-spacing: 10px">
					
						<tr>
							<td><label for="name"><?php echo $lang['login_name']; ?></label></td>
							<td><input type="text" name="name" id="name" size="18" /></td>
						</tr>
						<tr>
							<td><label for="password"><?php echo $lang['login_pass']; ?></label></td>
							<td><input type="password" name="password" id="password" size="18" /></td>
						</tr>
						<tr>
							<td><label for="remember"><?php echo $lang['login_remember']; ?></label></td>
							<td><input type="checkbox" class="checkbox" id="remember" name="remember" /></td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="hidden" name="referer" value="<?php echo "$referer"; ?>" />			
								<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
								<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
								<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_login']; ?>" />
							</td>
						</tr>
					</table>
					
				</td>
			</tr>
			<tr>
				<td class="forum-index-stats-header forum-index-top">
					<a href="<?php echo lb_link("index.php?page=password", "password"); ?>"><?php echo $lang['login_forgot']; ?></a>
				</td>
			</tr>
		</table>
		
		</form>
		
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
		<script type="text/javascript"> 
			document.forms['login'].name.focus();
		</script>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>