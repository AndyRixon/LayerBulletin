<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['themes_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="themes" method="post" enctype="multipart/form-data" action="<?php echo "$lb_domain"; ?>/index.php?page=admin&act=themes">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['themes_upload']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['themes_upload_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['themes_upload']; ?>:</strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="hidden" name="MAX_FILE_SIZE" value="100000000000" />
						<input type="hidden" name="upload" value="1" />
						<input type="file" class="file" name="uploadedfile">
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<input type="submit" class="submit-button img-upload" value="<?php echo $lang['button_upload']; ?>" />
				</td></tr>
			</table>
		</form>

		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
		<br /><br />
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['themes_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['themes_installed']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
<?php }elseif($template_hook=='3'){ ?>
			</td></tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif($template_hook == 'remote_replacement'){ ?>

	<br/><br />
	
	<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
		<tr>
			<td class="forum-topic-subject"><?php echo $lang_admin['themes_remote']; ?></td>
		</tr>
		<tr><td class="forum-index-stats-sub"></td></tr>
	</table>
	
	<table class="forum-index" cellpadding="0" cellspacing="0">
		<tr>
			<td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['themes_replacement_top']; ?></td>
		</tr>
		<tr>
			<td class="forum-jump-content forum-index-top forum-index-bottom">
				<?php echo $lang_admin['themes_replacement_desc']; ?>
			</td>
		</tr>
	</table>
<?php }elseif($template_hook=='4'){ ?>
		<br /><br />
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['themes_remote']; ?></td></tr>
			<tr><td class="forum-index-stats-sub">
				<form method="post" action="<?php echo "$lb_domain"; ?>/index.php?page=admin&act=themes&alter=rss">
					<select name="order">
						<option value="<?php echo "$module_order"; ?>"><?php echo $lang_admin['themes_list_title']; ?></option>
						<option value="downloads"><?php echo $lang_admin['themes_list_downloads']; ?></option>
						<option value="date"><?php echo $lang_admin['themes_list_submitted']; ?></option>
						<option value="module_name"><?php echo $lang_admin['themes_list_name']; ?></option>
					</select>
					<select name="limit">
						<option value="<?php echo "$module_limit"; ?>"><?php echo $lang_admin['themes_limit_title']; ?></option>
						<option value="1">1</option>
						<option value="5">5</option>
						<option value="10">10</option>	
						<option value="25">25</option>	
						<option value="50">50</option>
						<option value="100">100</option>	
						<option value="all"><?php echo $lang_admin['themes_limit_all']; ?></option>						
					</select>
					<select name="method">
						<option value="<?php echo "$module_method"; ?>"><?php echo $lang_admin['themes_order_title']; ?></option>
						<option value="asc"><?php echo $lang_admin['themes_order_asc']; ?></option>
						<option value="desc"><?php echo $lang_admin['themes_order_desc']; ?></option>						
					</select>

					<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
				</form>
			</td></tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['themes_top']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
<?php }elseif($template_hook=='5'){ ?>
				<table class="forum-jump" cellpadding="0" cellspacing="0";>
					<tr><td class="forum-jump-content">
						<table cellpadding="0" cellspacing="0"><tr>
							<td style="vertical-align: top;">
								<img src="
<?php }elseif($template_hook=='14'){ ?>
								" alt="" />
							</td>
							<td style="padding-left: 5px; vertical-align: top;">
								<strong>
<?php }elseif($template_hook=='6'){ ?>	
								</strong> (
<?php }elseif($template_hook=='7'){ ?>	
								)<br />
								<i>By 
<?php }elseif($template_hook=='8'){ ?>	
								</i> - <a href="
<?php }elseif($template_hook=='9'){ ?>
								">
<?php }elseif($template_hook=='10'){ ?>	
								</a><br /><br />
<?php }elseif($template_hook=='11'){ ?>	
								<br /><br />
								<span style="text-align: right;">
									<a class="submit-button img-upload" href="<?php echo "$lb_domain"; ?>/index.php?page=admin&act=themes&func=remote&file=
<?php }elseif($template_hook=='12'){ ?>	
									"><?php echo $lang['button_upload']; ?></a>
								</span>
							</td>
						</tr></table>
					</td></tr>
				</table>

		<div class="spacer">&nbsp;</div>
<?php }elseif($template_hook=='13'){ ?>
		<div style="width:100%; text-align: right";>
			<a href="http://themes.layerbulletin.com"><strong><?php echo $lang_admin['themes_more']; ?></strong></a>
		</div>
<?php }elseif ($template_hook=='warn'){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0"><tr>

			<td class="forum-topic-subject"> </td>
			<td style="text-align: right;"></td>

		</tr></table>

		<table class="forum-board" cellpadding="0" cellspacing="0">
			<tr>
				<td class="error-header" style="width:100%;">
					<?php echo $lang_admin['themes_warning']; ?>
				</td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<?php echo $lang_admin['themes_warning_desc']; ?>
				</td>
			</tr>
			<tr>
				<td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<form name="warn" action="<?php echo "$lb_domain"; ?>/index.php?page=admin&act=themes&func=<?php echo "$func"; ?>&file=<?php echo "$file"; ?>&theme=<?php echo "$themename"; ?>" method="post">
						<input type="hidden" name="agree" id="agree" value="1" />

						<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
						<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
						<input type="submit" class="submit-button img-submit" style="vertical-align: middle;" value="<?php echo $lang['button_submit']; ?>">
					</form>
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>