<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr><td class="forum-topic-subject"><?php echo $lang_user['subscriptions_pm']; ?></td></tr>
				<tr><td class="forum-index-stats-sub"> </td></tr>
			</table>
			<form name="settings" method="post" action="<?php echo "$lb_domain"; ?>/index.php?page=myoptions&act=subscriptions&area=messages">
				<table class="forum-index" cellpadding="0" cellspacing="0">
					<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_user['subscriptions_pm_title']; ?></td></tr>
					<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
						<?php echo $lang_user['subscriptions_pm_desc']; ?><br /><br />
						<div style="width: 25%; float: left;">
							<?php echo $lang_user['subscriptions_pm_option']; ?>
						</div>
						<div style="width: 75%; float: left;">
<?php if ($is_subscribed=='0'){ ?>						
							<input name="subscribe" value="1" type="checkbox" class="checkbox" />
<?php }else{ ?>						
							<input name="subscribe" value="1" type="checkbox" class="checkbox" checked="checked" />	
<?php } ?>
						</div>
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
			<div class="spacer">&nbsp;</div>						
			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr><td class="forum-topic-subject"><?php echo $lang_user['subscriptions_forum']; ?></td></tr>
				<tr><td class="forum-index-stats-sub"> </td></tr>
			</table>
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_user['subscriptions_forum_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_user['subscriptions_forum_desc']; ?><br /><br />
<?php }elseif ($template_hook=='2'){ ?>
					<div style="width: 70%; float: left;">
						<a href="<?php echo lb_link("index.php?forum=$subscribed_forum", "forum/$forum_title-$subscribed_forum"); ?>"><?php echo "$forum_title"; ?></a>
					</div>
					<div style="width: 30%; float: left;">
						<a href="<?php echo "$lb_domain"; ?>/index.php?page=myoptions&act=subscriptions&id=<?php echo "$row"; ?>" onclick="javascript:return confirm('<?php echo $lang['topic_remove']; ?>')"><img  src="<?php echo "$delete_icon_img"; ?>" alt="<?php echo $lang_admin['custom_delete']; ?>" /></a>
					</div>
<?php }elseif ($template_hook=='3'){ ?>		
				</td></tr>
			</table>
			<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-forum-footer-contents"> </td></tr>
			</table>
			<div class="spacer">&nbsp;</div>
			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr><td class="forum-topic-subject"><?php echo $lang_user['subscriptions_topic']; ?></td></tr>
				<tr><td class="forum-index-stats-sub"> </td></tr>
			</table>
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_user['subscriptions_topic_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_user['subscriptions_topic_desc']; ?><br /><br />	
<?php }elseif ($template_hook=='4'){ ?>	
					<div style="width: 70%; float: left;">
						<a href="<?php echo lb_link("index.php?topic=$subscribed_topic", "topic/$topic_title-$subscribed_topic"); ?>"><?php echo "$topic_title"; ?></a>
					</div>
					<div style="width: 30%; float: left;">
						<a href="<?php echo "$lb_domain"; ?>/index.php?page=myoptions&act=subscriptions&id=<?php echo "$row"; ?>" onclick="javascript:return confirm('<?php echo $lang['topic_remove']; ?>')"><img  src="<?php echo "$delete_icon_img"; ?>" alt="<?php echo $lang_admin['custom_delete']; ?>" /></a>
					</div>	
<?php }elseif ($template_hook=='5'){ ?>	
				</td></tr>
			</table>
			<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr></table>
<?php }elseif ($template_hook=='successDeleted'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_user['subscriptions_deleted']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successPMSubscribed'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_user['subscriptions_pm_subscribed']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successPMUnsubscribed'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_user['subscriptions_pm_unsubscribed']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>				