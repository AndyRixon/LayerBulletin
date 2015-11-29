<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=="3"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['ranks_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="settings" method="post" action="<?php echo lb_link("index.php?page=admin&act=ranks","admin/ranks"); ?>">
			
			<input type="hidden" name="token_id" value="<?php echo $token_id; ?>" />
			<input type="hidden" name="<?php echo $token_name; ?>" value="<?php echo $token; ?>" />
			<input type="hidden" name="hash" value="<?php echo $hash; ?>" />
			
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['ranks_ranks']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['ranks_desc']; ?><br /><br />
					<div style="width: 30%; float: left; vertical-align: middle;">
						<strong><?php echo $lang_admin['ranks_rank_title']; ?></strong>
					</div>
					<div style="width: 30%; float:left; vertical-align: middle;">
						<strong><?php echo $lang_admin['ranks_rank_posts']; ?></strong>
					</div>
					<div style="width: 30%; float: left; vertical-align: middle;">
						<strong><?php echo $lang_admin['ranks_rank_pips']; ?></strong>
					</div>
					<div style="width: 10%; float: left; vertical-align: middle; text-align: right;"></div>					
<?php }elseif ($template_hook=="4"){ ?>
					<div style="width: 30%; float: left; vertical-align: middle;">
						<?php echo "$rank_title"; ?>
					</div>
					<div style="width: 30%; float:left; vertical-align: middle;">
						<?php echo "$rank_posts"; ?>
					</div>
					<div style="width: 30%; float: left; vertical-align: middle;">
<?php }elseif ($template_hook=="6"){ ?>						
						<img  src="<?php echo "$pip_img"; ?>" alt="" />
<?php }elseif ($template_hook=="7"){ ?>							
					</div>
					<div style="width: 10%; float: left; vertical-align: middle; text-align: right;">
					
						<input type="hidden" name="delete_id" value="<?php echo $rank_id; ?>" />
						<input
							type="image"
							name="ranks_delete"
							value="1"
							style="border: none; margin: 0; width: auto; padding: 0;"
							src="<?php echo $delete_icon_img; ?>"
							alt="<?php echo $lang_admin['custom_delete']; ?>"
							onclick="javascript:return confirm('<?php echo $lang['topic_remove']; ?> (<?php echo $rank_title; ?>)')"
						/>
						
					</div>
<?php }elseif ($template_hook=="5"){ ?>
					<br /><br />
					<div style="width: 30%; float:left; vertical-align: middle;">
						<input type="text" size="10" name="rank_title" />
					</div>
					<div style="width: 30%; float:left; vertical-align: middle;">
						<input type="text" size="10" name="rank_posts" />
					</div>
					<div style="width: 40%; float:left; vertical-align: middle;">
						<input type="text" size="10" name="rank_pips" />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
<?php if($can_change_forum_settings=='1'){ ?>
					<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
					<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
					<input type="submit" name="ranks_add" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
				</td></tr>
			</table>
		</form>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='successAdded'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['ranks_added']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successDeleted'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['ranks_deleted']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>