<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr><td class="forum-topic-subject"><?php echo $lang_user['information_title']; ?></td></tr>
				<tr><td class="forum-index-stats-sub"> </td></tr>
			</table>
			<form method="post" action="<?php echo lb_link("index.php?page=myoptions&act=information","myoptions/information"); ?>">
				<table class="forum-index" cellpadding="0" cellspacing="0">
					<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_user['information_location']; ?></td></tr>
					<tr><td class="forum-jump-content forum-index-top forum-index-bottom">		
						<?php echo $lang_user['information_location_desc']; ?><br /><br />
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_user['information_loc']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
							<input type="text" value="<?php echo "$location"; ?>" name="location" /><br /><br />
						</div>
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_user['information_nat']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
							<select name="nationality">
								<option value=""></option>
<?php }elseif($template_hook=='2'){ ?>
<?php if($nationshort==$nationality){ ?>
								<option value="<?php echo "$nationshort"; ?>" selected="selected"><?php echo "$nationname"; ?></option>
<?php }else{ ?>
								<option value="<?php echo "$nationshort"; ?>"><?php echo "$nationname"; ?></option>
<?php } } elseif($template_hook=='3'){ ?>
							</select><br /><br />
						</div>
					</td></tr>
					<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_user['information_com']; ?></td></tr>
					<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
						<?php echo $lang_user['information_com_desc']; ?><br /><br />
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_user['information_wlm']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
							<input type="text"  value="<?php echo "$msn"; ?>" name="msn" /><br /><br />
						</div>
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_user['information_aol']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
							<input type="text"  value="<?php echo "$aol"; ?>" name="aol" /><br /><br />
						</div>
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_user['information_yim']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
							<input type="text"  value="<?php echo "$yahoo"; ?>" name="yim" /><br /><br />
						</div>
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_user['information_skype']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
							<input type="text"  value="<?php echo "$skype"; ?>" name="skype" /><br /><br />
						</div>
					</td></tr>
<?php if ($show_gamer_tags=='1'){ ?>
					<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_user['information_tags']; ?></td></tr>
					<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
						<?php echo $lang_user['information_tags_desc']; ?><br /><br />
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_user['information_tags_xbox']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
							<input type="text"  value="<?php echo "$xbox"; ?>" name="xbox" /><br /><br />
						</div>
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_user['information_tags_wii']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
							<input type="text"  value="<?php echo "$wii"; ?>" name="wii" /><br /><br />
						</div>
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_user['information_tags_ps3']; ?></strong><br />
						</div>
						<div style="width: 70%; float: left;">
							<input type="text"  value="<?php echo "$ps3"; ?>" name="ps3" /><br /><br />
						</div>	
					</td></tr>							
<?php } ?>
<?php }elseif($template_hook=='custom'){ ?>
					<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_user['information_custom']; ?></td></tr>
					<tr><td class="forum-jump-content forum-index-top forum-index-bottom">		
						<?php echo $lang_user['information_custom_desc']; ?><br /><br />
<?php }elseif($template_hook=='4'){ ?>
						<div style="width: 30%; float: left;">
							<strong><?php echo "$field_name"; ?>:</strong>							
						</div>
						<div style="width: 70%; float: left;">
							<?php echo "$field_description"; ?><br />
                            <input type="text" value="<?php echo "$field_content"; ?>" name="custom<?php echo "$field_id"; ?>" id="custom<?php echo "$field_id"; ?>" /><br /><br />
						</div>
<?php } elseif($template_hook=='5'){ ?>
					</td></tr>
					<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
						<div style="width:100%;">
							<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
							<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
							<input type="hidden" name="form_submit" value="1" />
							<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
						</div>
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
				<?php echo $lang_user['information_saved']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>		
<?php } ?>
