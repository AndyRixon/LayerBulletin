<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
		<!-- admin option links -->
		<div class="myoptions-left" style="width: 20%; float: left;">
			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr>
					<td class="forum-topic-subject"><?php echo $lang['admin_title_board']; ?></td>
				</tr>
			</table>
			<table class="forum-index" style="width: 100%;" cellpadding="0" cellspacing="0">
<?php if ($can_change_site_settings=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin", "admin"); ?>"><?php echo $lang['admin_link_home']; ?></a></td>
				</tr>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=settings", "admin/settings"); ?>"><?php echo $lang['admin_link_global']; ?></a></td>
				</tr>
<?php } if ($can_change_forum_settings=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=topics", "admin/topics"); ?>"><?php echo $lang['admin_link_topics']; ?></a></td>
				</tr>
<?php } if ($can_change_forum_settings=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=spam", "admin/spam"); ?>"><?php echo $lang['admin_link_spam']; ?></a></td>
				</tr>			
<?php } if ($can_change_site_settings=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=attachments", "admin/attachments"); ?>"><?php echo $lang['admin_link_attachments']; ?></a></td>
				</tr>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=modules", "admin/modules"); ?>"><?php echo $lang['admin_link_modules']; ?></a></td>
				</tr>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=themes", "admin/themes"); ?>"><?php echo $lang['admin_link_themes']; ?></a></td>
				</tr>
<?php } ?>
			</table>
			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr><td class="forum-topic-subject"><?php echo $lang['admin_title_forums']; ?></td></tr>
			</table>
			<table class="forum-index" cellpadding="0" cellspacing="0">
<?php if ($can_change_forum_settings=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=categories", "admin/categories"); ?>"><?php echo $lang['admin_link_categories']; ?></a></td>
				</tr>
<?php } if ($can_change_forum_settings=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=custom", "admin/custom"); ?>"><?php echo $lang['admin_link_custom']; ?></a></td>
				</tr>			
<?php } if ($can_change_forum_settings=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=smilies", "admin/smilies"); ?>"><?php echo $lang['admin_link_emoticons']; ?></a></td>
				</tr>
<?php } if ($can_change_site_settings=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=rss", "admin/rss"); ?>"><?php echo $lang['admin_link_rss']; ?></a></td>
				</tr>
<?php } if ($can_change_forum_settings=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=cache", "admin/cache"); ?>"><?php echo $lang['admin_link_cache']; ?></a></td>
				</tr>
<?php } ?>
			</table>
			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr><td class="forum-topic-subject"><?php echo $lang['admin_title_members']; ?></td></tr>
			</table>
			<table class="forum-index" cellpadding="0" cellspacing="0">
<?php if ($can_change_forum_settings=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=members", "admin/members"); ?>"><?php echo $lang['admin_link_member_edit']; ?></a></td>
				</tr>
<?php } if ($can_change_site_settings=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=groups", "admin/groups"); ?>"><?php echo $lang['admin_link_groups']; ?></a></td>
				</tr>
<?php } if ($can_change_forum_settings=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=ranks", "admin/ranks"); ?>"><?php echo $lang['admin_link_ranks']; ?></a></td>
				</tr>
<?php } if ($can_change_site_settings=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=moderators", "admin/moderators"); ?>"><?php echo $lang['admin_link_moderators']; ?></a></td>
				</tr>
<?php }if ($can_change_forum_settings=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=email", "admin/email"); ?>"><?php echo $lang['admin_link_mass_email']; ?></a></td>
				</tr>
<?php } if ($can_change_site_settings=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=subscriptions", "admin/subscriptions"); ?>"><?php echo $lang['admin_link_paypal']; ?></a></td>
				</tr>
<?php } if ($can_change_site_settings=='1'){ ?>
	<tr>
		<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'">
		
			<a class="forum-index-link-to-topic" href="<?php echo lb_link('index.php?page=admin&act=suspended_members', 'admin/suspended_members'); ?>">
				<?php echo $lang_admin['suspended_subject']; ?>
			</a>
		
		</td>
	</tr>
	</table>
			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr><td class="forum-topic-subject"><?php echo $lang['admin_title_mods']; ?></td></tr>
			</table>
			<table class="forum-index" cellpadding="0" cellspacing="0">
			<?php } if ($can_change_forum_settings=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=report", "admin/report"); ?>"><?php echo $lang['admin_link_reported']; ?></a></td>
				</tr>
<?php } if ($can_change_forum_settings=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=preview", "admin/preview"); ?>"><?php echo $lang['admin_link_approve']; ?></a></td>
				</tr>
				<?php } if ($can_change_forum_settings=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=filter", "admin/filter"); ?>"><?php echo $lang['admin_link_censor']; ?></a></td>
				</tr>
<?php } ?>
			</table>

<?php } elseif ($template_hook=='2'){ ?>			
<?php if ($can_change_site_settings=='1'){ ?>
			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr><td class="forum-topic-subject"><?php echo $lang['admin_link_modules']; ?></td></tr>
			</table>
			<table class="forum-index" cellpadding="0" cellspacing="0">
<?php } ?>
<?php } elseif ($template_hook=='3'){ ?>	
<?php if ($can_change_site_settings=='1'){ ?>		
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'"><a class="forum-index-link-to-topic" href="<?php echo "$lb_domain"; ?>/index.php?page=admin&act=<?php echo "$config_page"; ?>"><?php echo "$display_name"; ?></a></td>
				</tr>
<?php } ?>
<?php } elseif ($template_hook=='4'){ ?>
<?php if ($can_change_site_settings=='1'){ ?>			
			</table>
<?php } ?>	
<?php } elseif ($template_hook=='5'){ ?>		
		</div>
		<div class="myoptions-right" style="width: 80%; float: left;">
			<div class="my-controls-content" style="padding-left: 20px;">
<?php } elseif ($template_hook=='6'){ ?>
			</div>
		</div>
<?php } elseif ($template_hook=='end'){ ?>		
<?php } ?>