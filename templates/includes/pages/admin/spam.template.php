<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=="1"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['spam_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="submit" id="submit" method="post" action="<?php echo "$lb_domain"; ?>/index.php?page=admin&act=spam">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['spam_key']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['spam_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['spam_key']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php }elseif ($template_hook=='2'){ ?>	
						<input type="text" name="akismet_key" class='module-not-installed' value="<?php echo "$akismet_key"; ?>" /> 
						<span class='warn-add'><?php echo $lang_admin['spam_invalid']; ?></span>
<?php }elseif ($template_hook=='3'){ ?>	
						<input type="text" name="akismet_key" class='module-installed' value="<?php echo "$akismet_key"; ?>" /> 					
<?php }elseif ($template_hook=='4'){ ?>								
						<br /><br />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['spam_recaptcha_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['spam_recaptcha_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['spam_recaptcha_public']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="recaptcha_public" value="<?php echo "$recaptcha_public"; ?>" /> 
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['spam_recaptcha_private']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="recaptcha_private" value="<?php echo "$recaptcha_private"; ?>" /> 
						<br /><br />
					</div>		
				</td></tr>							
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<input type="hidden" name="form" value="1" />
					<input type="hidden" name="token_id" value="<?php echo $token_id; ?>" />
					<input type="hidden" name="<?php echo $token_name; ?>" value="<?php echo $token; ?>" />
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
				<?php echo $lang_admin['spam_saved']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>