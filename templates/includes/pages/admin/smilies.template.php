<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif($template_hook=="2"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['smilies_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="settings" method="post" action="<?php echo lb_link("index.php?page=admin&act=smilies","admin/smilies"); ?>">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['smilies_select']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">			
					<?php echo $lang_admin['smilies_desc']; ?><br /><br />
<?php }elseif($template_hook=="3"){ ?>
					<div style="width: 20%; float: left;">
						<img  src="<?php echo $lb_domain; ?>/<?php echo $emoticon_path; ?>/<?php echo $emoticon_file; ?>" alt="<?php echo $emoticon_file; ?>" />
					</div>
					<div style="width: 65%; float: left;">
						<?php echo $lang_admin['smilies_shortcode']; ?>
<?php if ($emoticon_code == ''){ ?>
						<input type="text" name="emoticon<?php echo $smiley_count; ?>" value=":emoticon<?php echo $smiley_count; ?>:" size="10" /><br /><br />
<?php }else{ ?>
						<input type="text" name="emoticon<?php echo $smiley_count; ?>" value="<?php echo $emoticon_code; ?>" size="10" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 15%; float: right; text-align: right;">
						<?php echo $lang_admin['smilies_on']; ?>
<?php if ($emoticon_link == $emoticon_file && $emoticon_on == 1){ ?>
						<input type="checkbox" class="checkbox" name="emoticon_on<?php echo $smiley_count; ?>" value="1" checked />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="emoticon_on<?php echo $smiley_count; ?>" value="1" />
<?php } ?>
						<input type="hidden" value="<?php echo $emoticon_file; ?>" name="file<?php echo $smiley_count; ?>" />
					</div>
<?php }elseif($template_hook=='4'){ ?>
					<div style="width: 20%; float: left;">
						<img  src="<?php echo $lb_domain; ?>/<?php echo $emoticon_path; ?>/<?php echo $emoticon_file; ?>" alt="<?php echo $emoticon_file; ?>" />
					</div>
					<div style="width: 65%; float: left;">
						<?php echo $lang_admin['smilies_shortcode']; ?> 
<?php if($emotion_code=="" || $emoticon_code==" "){ ?>
						<input type="text" name="emoticon<?php echo $smiley_count; ?>" value=":emoticon<?php echo $smiley_count; ?>:" size="10" /><br /><br />
<?php }else{ ?>
						<input type="text" name="emoticon<?php echo $smiley_count; ?>" value="<?php echo $emoticon_code; ?>" size="10" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 15%; float: right; text-align: right;">
						<?php echo $lang_admin['smilies_on']; ?> 
						<input type="checkbox" class="checkbox" name="emoticon_on<?php echo $smiley_count; ?>" value="1" />
						<input type="hidden" value="<?php echo $emoticon_file; ?>" name="file<?php echo $smiley_count; ?>" />
					</div>
<?php }elseif($template_hook=="5"){ ?>
					<input type="hidden" value="<?php echo $location; ?>" name="location" />
					<input type="hidden" value="<?php echo $smiley_count; ?>" name="total_files" />
					<input type="hidden" value="1" name="form" />
<?php }elseif($template_hook=="6"){ ?>
					<div style="float: none; clear:both; width: 100%; text-align: right"><?php echo $lang_admin['smilies_check']; ?> <input type="checkbox" class="checkbox" name="checkall" onclick="checkUncheckAll(this);" /></div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
<?php if($can_change_forum_settings=='1'){ ?>
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
<?php }elseif($template_hook=="7"){ ?>	
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['smilies_theme_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-stats-header forum-index-top"> </td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
				<?php echo $lang_admin['smilies_theme_desc']; ?><br /><br />
				<form method="post" action="index.php?">
					<select name="switch" onchange="location.href='<?php echo lb_link("index.php?page=admin&act=smilies&location=","admin/smilies/"); ?>'+(this.options[this.selectedIndex].value)">
						<option><?php echo $lang_admin['smilies_theme_select']; ?></option>
						<optgroup label="Select Theme">
							<option value="default">* <?php echo $lang_admin['smilies_theme_default']; ?></option>
							<?php list_themes_emos("themes/"); ?>
						</optgroup>
					</select>
				</form>
			</td></tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='successSaved'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['smilies_updated']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>