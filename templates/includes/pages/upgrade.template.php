<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
		<!-- cancel subscription -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang['upgrade_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>	
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang['upgrade_cancel_success']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">	
				<div style="width: 100%; float: left;">
					<?php echo $lang['upgrade_cancel_message']; ?>
				</div>
			</td></tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='2'){ ?>
		<!-- sucessful upgrade -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang['upgrade_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>	
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang['upgrade_subscribe_success']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">		
				<div style="width: 100%; float: left;">
					<?php echo $lang['upgrade_subscribe_message']; ?>.
				</div>
			</td></tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='3'){ ?>
		<!-- start area for subscription options -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang['upgrade_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>	
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang['upgrade_select']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">	
					<?php echo $lang['upgrade_select_desc']; ?><br /><br />
					<span class="upgrade-warning"><?php echo $lang['upgrade_warning']; ?></span><br /><br />
<?php } elseif($template_hook=='4'){ ?>
					<!-- show upgrade options -->
					<div style="width: 20%; float: left;">
						<strong><?php echo $lang['upgrade_name']; ?></strong><br />
						<?php echo "$upgrade_name"; ?>
					</div>
					<div style="width: 45%; float: left;">
						<strong><?php echo $lang['upgrade_features']; ?></strong><br />
						<?php echo "$upgrade_features"; ?>
					</div>
					<div style="width: 10%; float: left;">
						&nbsp;
					</div>
					<div style="width: 25%; float: left;">
						<!-- construct paypal form -->
						<form name="paypal_submit_hidden" id="paypal_submit_hidden" action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="rm" value="2">
<?php if ($upgrade_period_two=='Once'){ ?>
							<input type="hidden" name="cmd" value="_xclick">
<?php } else{ ?>
							<input type="hidden" name="cmd" value="_xclick-subscriptions">
<?php } ?>
							<input type="hidden" name="business" value="<?php echo "$paypal_email"; ?>">
							<input type="hidden" name="item_name" value="<?php echo "$upgrade_name"; ?> for Member #<?php echo "$my_id"; ?>">
							<input type="hidden" name="item_number" value="<?php echo "$upgrade_id"; ?>">
<?php if ($upgrade_period_two=='Once'){ ?>
							<input type="hidden" name="amount" value="<?php echo "$upgrade_cost"; ?>">
<?php } else{ ?>
							<input type="hidden" name="a3" value="<?php echo "$upgrade_cost";?>">
<?php } ?>
							<input type="hidden" name="no_shipping" value="0">
							<input type="hidden" name="return" value="<?php echo "$lb_domain"; ?>/index.php?page=upgrade&status=return">
							<input type="hidden" name="notify_url" value="<?php echo "$lb_domain"; ?>/index.php?page=upgrade&status=paid&member=<?php echo "$my_id"; ?>">
							<input type="hidden" name="cancel_return" value="<?php echo "$lb_domain"; ?>/index.php?page=upgrade&status=cancel">
							<input type="hidden" name="no_note" value="1">
							<input type="hidden" name="currency_code" value="<?php echo "$upgrade_currency"; ?>">
							<input type="hidden" name="lc" value="GB">
<?php if ($upgrade_period_two=='Once'){ ?>
							<input type="hidden" name="bn" value="PP-BuyNowBF">
<?php }else{ ?>
							<input type="hidden" name="bn" value="PP-SubscriptionsBF">
							<input type="hidden" name="p3" value="<?php echo "$upgrade_period"; ?>">
							<input type="hidden" name="t3" value="<?php echo "$upgrade_period_two"; ?>">
							<input type="hidden" name="src" value="1">
							<input type="hidden" name="sra" value="1">
<?php } ?>
							<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
							<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
							<input  type="image" class="img" src="https://www.paypal.com/en_US/i/btn/x-click-but5.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
						</form>
						<br />
						(<?php echo $lang['upgrade_cost']; ?> <strong><?php echo "$upgrade_cost $upgrade_currency"; ?></strong>
<?php if ($upgrade_period_two!='Once'){ ?>
						<?php echo $lang['upgrade_every']; ?> <?php echo "$upgrade_period "; ?>
<?php if ($upgrade_period_two=='D'){ ?>
						<?php echo $lang['upgrade_days']; ?>)
<?php }elseif ($upgrade_period_two=='W'){ ?>
						<?php echo $lang['upgrade_weeks']; ?>)
<?php }elseif ($upgrade_period_two=='M'){ ?>
						<?php echo $lang['upgrade_months']; ?>)
<?php }elseif ($upgrade_period_two=='Y'){ ?>
						<?php echo $lang['upgrade_years']; ?>)
<?php }} else{ ?>
						)
						<br /><br />
<?php } ?>
					</div>
<?php } elseif($template_hook=='5'){ ?>
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='end'){ ?>		
<?php } ?>