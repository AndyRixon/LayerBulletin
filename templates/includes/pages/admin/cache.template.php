<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['cache_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['cache_forum_cache']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
				<?php echo $lang_admin['cache_forum_desc']; ?><br /><br />
<?php }elseif ($template_hook=='2'){ ?>
				<span class="warn-remove"><strong><?php echo $lang_admin['cache_posts_cached']; ?></strong></span>
				<br /><br />
				<?php echo $lang_admin['cache_posts_desc']; ?>
<?php }elseif ($template_hook=='3'){ ?>
			</td></tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='4'){ ?>
				<span class="warn-remove"><strong><?php echo $lang_admin['cache_members_removed']; ?></strong></span>
				<br /><br />
				<?php echo $lang_admin['cache_members_desc']; ?>
<?php }elseif ($template_hook=='5'){ ?>
				<span class="warn-remove"><strong><?php echo $lang_admin['cache_members_online']; ?></strong></span>
				<br /><br />
				<?php echo $lang_admin['cache_members_online_desc']; ?>
<?php }elseif ($template_hook=='6'){ ?>
				<span class="warn-remove"><strong><?php echo $lang_admin['cache_members_removed']; ?></strong></span>
				<br /><br />
				<?php echo $lang_admin['cache_members_desc']; ?>.
<?php }elseif ($template_hook=='7'){ ?>
				<span class="warn-remove"><strong><?php echo $lang_admin['cache_purge_success']; ?></strong></span>
				<br /><br />
				<?php echo $lang_admin['cache_purge_desc']; ?>
<?php }elseif ($template_hook=='8'){ ?>
				<span class="warn-remove"><strong><?php echo $lang_admin['cache_table_updated']; ?></strong></span>
				<br /><br />
				<?php echo $lang_admin['cache_table_desc']; ?>
<?php }elseif ($template_hook=='9'){ ?>
				<span class="warn-remove"><strong><?php echo $lang_admin['cache_messages_removed']; ?></strong></span>
				<br /><br />
				<?php echo $lang_admin['cache_messages_desc']; ?>
<?php }elseif ($template_hook=='10'){ ?>
			</td></tr>
			<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['cache_posts_cache']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
				<a href="<?php echo lb_link("index.php?page=admin&act=cache&func=posts","admin/cache/posts"); ?>"><strong><?php echo $lang_admin['cache_posts_cache']; ?></strong></a>
				<br /><?php echo $lang_admin['cache_posts_description']; ?>
			</td></tr>
			<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['cache_members_remove']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
				<a href="<?php echo lb_link("index.php?page=admin&act=cache&func=verify","admin/cache/verify"); ?>"><strong><?php echo $lang_admin['cache_members_remove']; ?></strong></a>
				<br /><?php echo $lang_admin['cache_members_desc']; ?>
			</td></tr>
			<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['cache_messages_remove']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
				<a href="<?php echo lb_link("index.php?page=admin&act=cache&func=messages","admin/cache/messages"); ?>"><strong><?php echo $lang_admin['cache_messages_remove']; ?></strong></a>
				<br /><?php echo $lang_admin['cache_messages_desc']; ?>
			</td></tr>
			<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['cache_read_posts_title']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
				<a href="<?php echo lb_link("index.php?page=admin&act=cache&func=readall","admin/cache/readall"); ?>"><strong><?php echo $lang_admin['cache_read_posts_title']; ?></strong></a>
				<br /><?php echo $lang_admin['cache_read_posts_desc']; ?>
			</td></tr>
			<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['cache_members_online_title']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
				<a href="<?php echo lb_link("index.php?page=admin&act=cache&func=online","admin/cache/online"); ?>"><strong><?php echo $lang_admin['cache_members_online_title']; ?></strong></a>
				<br /><?php echo $lang_admin['cache_members_online_explain']; ?>
			</td></tr>
			<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['cache_purge_title']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
				<?php echo $lang_admin['cache_purge_desc']; ?><br /><br />
				<form method="post" action="<?php echo lb_link("index.php?page=admin&act=cache&func=forums","admin/cache/forums"); ?>">
					<div style="width: 30%;float:left; clear:both;">
						<strong><?php echo $lang_admin['cache_purge_forum_title']; ?></strong><br />
						<?php echo $lang_admin['cache_purge_forum_desc']; ?>
						<br /><br />
					</div>
					<div style="width: 70%;float:left;">
						<select id="forums[]" style="height:150px;" multiple="multiple" name="forums[]" id="forums[]">
<?php }elseif ($template_hook=='11'){ ?>
							<option disabled="disabled" value="<?php echo "$parent_id"; ?>"><?php echo "$parent_name"; ?></option>
<?php }elseif ($template_hook=='12'){ ?>
							<option value="<?php echo "$forum_id"; ?>">|--<?php echo "$forum_name"; ?></option>
<?php }elseif ($template_hook=='13'){ ?>
							<option value="<?php echo "$forum_sub_id"; ?>">|---- <?php echo "$forum_sub_name"; ?></option>
<?php }elseif ($template_hook=='14'){ ?>
						</select>
					</div>
					<div style="width: 30%;float:left; clear:both;">
						<strong><?php echo $lang_admin['cache_purge_locked']; ?></strong>
						<br /><br />
					</div>
					<div style="width: 70%;float:left;">
						<input type="checkbox" class="checkbox" name="locked" value="1" />
						<br /><br />
					</div>
					<div style="width: 30%;float:left; clear:both;">
						<strong><?php echo $lang_admin['cache_purge_older']; ?></strong>
					</div>
					<div style="width: 70%;float:left;">
						<input type="text" name="date" value="30" size="3" /> <?php echo $lang_admin['cache_purge_days']; ?>
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
<?php if ($can_change_forum_settings=='1'){ ?>
						<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
						<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
						<input type="submit" class="submit-button img-purge" value="<?php echo $lang['button_purge']; ?>" />
				</td></tr>
			</form>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='end'){ ?>		
<?php } ?>