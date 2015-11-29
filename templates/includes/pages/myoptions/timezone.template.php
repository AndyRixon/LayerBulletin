<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='2'){ ?>
			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr><td class="forum-topic-subject"><?php echo $lang_user['timezone_title']; ?></td></tr>
				<tr><td class="forum-index-stats-sub"> </td></tr>
			</table>
			<form name="settings" method="post" action="<?php echo lb_link("index.php?page=myoptions&act=timezone","myoptions/timezone"); ?>">
				<table class="forum-index" cellpadding="0" cellspacing="0">
					<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_user['timezone_change']; ?></td></tr>
					<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
						<?php echo $lang_user['timezone_desc']; ?><br /><br />
						<strong><?php echo $lang_user['timezone_default']; ?></strong> <?php echo "$server_time"; ?><br />
						<strong><?php echo $lang_user['timezone_set']; ?></strong> <?php echo "$my_time"; ?><br />
						<br /><br />
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_user['timezone_select']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
							<select name="time_offset">
								<option value="<?php echo "$timezone"; ?>" selected="selected"><?php echo $lang_user['timezone_current']; ?></option>
<?php }elseif ($template_hook=="time"){ ?>
								<option value="<?php echo "$start_time_value" ?>"><?php echo "$formatted_start_time" ?></option>
<?php }elseif ($template_hook=="aftertime"){ ?>
							</select>
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
<?php }elseif ($template_hook=='successSaved'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_user['timezone_changed']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>	
<?php } ?>