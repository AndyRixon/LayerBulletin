<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=="1"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['email_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="submit" id="submit" method="post" action="<?php echo "$lb_domain"; ?>/index.php?page=admin&act=email">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['email_sub_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">					
					<div style="float: left; width: 98%;">
						<?php echo $lang_admin['email_mass_desc']; ?>
						<textarea style="float: left; width: 100%; height: 250px;" class="post" name="content" id="content"></textarea>
						<input type="hidden" name="form" value="1" />
						<br /><br />
<?php if($can_change_forum_settings=='1' OR $can_change_site_settings=='1'){ ?>
						<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
						<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
					</div>
					<div style="width: 30%;float:left; clear:both;">
						<strong><?php echo $lang_admin['email_groups']; ?></strong><br />
						<?php echo $lang_admin['email_groups_desc']; ?>
						<br /><br />
					</div>
					<div style="width: 70%;float:left;">
						<select id="email_group[]" style="height:80px;" multiple="multiple" name="email_group[]" id="email_group[]">
<?php }elseif($template_hook=='2'){ ?>
							<option value="<?php echo "$group_id"; ?>"><?php echo "$group_name"; ?></option>
<?php }elseif($template_hook=='3'){ ?>
						</select>
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">					
					<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />			
				</td></tr>
			</table>
		</form>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif($template_hook=='4'){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"> </td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-stats-header forum-index-top"> </td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom" style="text-align: center;">
				<?php echo $lang_admin['email_sent']; ?>
			</td></tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>