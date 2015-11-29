<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject"><?php echo $lang_help['help_topics']; ?></td>
			</tr>
			<tr>
				<td class="forum-index-stats-sub"> </td>
			</tr>			
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-index-stats-header forum-index-top"><?php echo $lang_help['help_desc']; ?></td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<a href="<?php echo lb_link("index.php?page=help&h=2", "help/2"); ?>"><strong><?php echo $lang_help['help_search_title']; ?></strong></a><br />
					<?php echo $lang_help['help_search_desc']; ?><br /><br />
					<a href="<?php echo lb_link("index.php?page=help&h=3", "help/3"); ?>"><strong><?php echo $lang_help['help_active_title']; ?></strong></a><br />
					<?php echo $lang_help['help_active_desc']; ?><br /><br />
					<a href="<?php echo lb_link("index.php?page=help&h=4", "help/4"); ?>"><strong><?php echo $lang_help['help_email_title']; ?></strong></a><br />
					<?php echo $lang_help['help_email_desc']; ?><br /><br />
					<a href="<?php echo lb_link("index.php?page=help&h=5", "help/5"); ?>"><strong><?php echo $lang_help['help_myoptions_title']; ?></strong></a><br />
					<?php echo $lang_help['help_myoptions_desc']; ?><br /><br />
					<a href="<?php echo lb_link("index.php?page=help&h=6", "help/6"); ?>"><strong><?php echo $lang_help['help_messages_title']; ?></strong></a><br />
					<?php echo $lang_help['help_messages_desc']; ?><br /><br />
					<a href="<?php echo lb_link("index.php?page=help&h=7", "help/7"); ?>"><strong><?php echo $lang_help['help_register_title']; ?></strong></a><br />
					<?php echo $lang_help['help_register_desc']; ?><br /><br />
					<a href="<?php echo lb_link("index.php?page=help&h=8", "help/8"); ?>"><strong><?php echo $lang_help['help_password_title']; ?></strong></a><br />
					<?php echo $lang_help['help_password_desc']; ?><br /><br />
					<a href="<?php echo lb_link("index.php?page=help&h=9", "help/9"); ?>"><strong><?php echo $lang_help['help_members_title']; ?></strong></a><br />
					<?php echo $lang_help['help_members_desc']; ?><br /><br />
					<a href="<?php echo lb_link("index.php?page=help&h=10", "help/10"); ?>"><strong><?php echo $lang_help['help_login_title']; ?></strong></a><br />
					<?php echo $lang_help['help_login_desc']; ?><br /><br />
					<a href="<?php echo lb_link("index.php?page=help&h=11", "help/11"); ?>"><strong><?php echo $lang_help['help_posting_title']; ?></strong></a><br />
					<?php echo $lang_help['help_posting_desc']; ?><br /><br />	
					<a href="<?php echo lb_link("index.php?page=help&h=12", "help/12"); ?>"><strong><?php echo $lang_help['help_mods_title']; ?></strong></a><br />
					<?php echo $lang_help['help_mods_desc']; ?>							
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"></td></tr>
		</table>
<?php }elseif ($template_hook=='2'){ ?>		
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td id="top" class="forum-topic-subject"><?php echo $lang_help['help_search_title']; ?></td>
			</tr>
			<tr>
				<td class="forum-index-stats-sub"> </td>
			</tr>			
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-index-stats-header forum-index-top"><?php echo $lang_help['help_search_desc']; ?></td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<?php echo $lang_help['help_search_contents']; ?>						
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"></td></tr>
		</table>	
<?php }elseif ($template_hook=='3'){ ?>		
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td id="top" class="forum-topic-subject"><?php echo $lang_help['help_active_title']; ?></td>
			</tr>
			<tr>
				<td class="forum-index-stats-sub"> </td>
			</tr>			
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-index-stats-header forum-index-top"><?php echo $lang_help['help_active_desc']; ?></td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<?php echo $lang_help['help_active_contents']; ?>						
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"></td></tr>
		</table>		
<?php }elseif ($template_hook=='4'){ ?>		
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td id="top" class="forum-topic-subject"><?php echo $lang_help['help_email_title']; ?></td>
			</tr>
			<tr>
				<td class="forum-index-stats-sub"> </td>
			</tr>			
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-index-stats-header forum-index-top"><?php echo $lang_help['help_email_desc']; ?></td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<?php echo $lang_help['help_email_contents']; ?>						
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"></td></tr>
		</table>
<?php }elseif ($template_hook=='5'){ ?>		
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td id="top" class="forum-topic-subject"><?php echo $lang_help['help_myoptions_title']; ?></td>
			</tr>
			<tr>
				<td class="forum-index-stats-sub"> </td>
			</tr>			
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr>	
				<td class="forum-index-stats-header forum-index-top"><?php echo $lang_help['help_myoptions_desc']; ?></td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<?php echo $lang_help['help_myoptions_contents']; ?>						
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"></td></tr>
		</table>			
<?php }elseif ($template_hook=='6'){ ?>		
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td id="top" class="forum-topic-subject"><?php echo $lang_help['help_messages_title']; ?></td>
			</tr>
			<tr>
				<td class="forum-index-stats-sub"> </td>
			</tr>			
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-index-stats-header forum-index-top"><?php echo $lang_help['help_messages_desc']; ?></td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<?php echo $lang_help['help_messages_contents']; ?>						
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"></td></tr>
		</table>			
<?php }elseif ($template_hook=='7'){ ?>		
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td id="top" class="forum-topic-subject"><?php echo $lang_help['help_register_title']; ?></td>
			</tr>
			<tr>
				<td class="forum-index-stats-sub"> </td>
			</tr>			
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-index-stats-header forum-index-top"><?php echo $lang_help['help_register_desc']; ?></td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<?php echo $lang_help['help_register_contents']; ?>						
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"></td></tr>
		</table>			
	<?php }elseif ($template_hook=='8'){ ?>		
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td id="top" class="forum-topic-subject"><?php echo $lang_help['help_password_title']; ?></td>
			</tr>
			<tr>
				<td class="forum-index-stats-sub"> </td>
			</tr>			
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr>	
				<td class="forum-index-stats-header forum-index-top"><?php echo $lang_help['help_password_desc']; ?></td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<?php echo $lang_help['help_password_contents']; ?>						
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"></td></tr>
		</table>	
<?php }elseif ($template_hook=='9'){ ?>		
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td id="top" class="forum-topic-subject"><?php echo $lang_help['help_members_title']; ?></td>
			</tr>
			<tr>
				<td class="forum-index-stats-sub"> </td>
			</tr>			
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-index-stats-header forum-index-top"><?php echo $lang_help['help_members_desc']; ?></td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<?php echo $lang_help['help_members_contents']; ?>						
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"></td></tr>
		</table>		
<?php }elseif ($template_hook=='10'){ ?>		
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td id="top" class="forum-topic-subject"><?php echo $lang_help['help_login_title']; ?></td>
			</tr>
			<tr>
				<td class="forum-index-stats-sub"> </td>
			</tr>			
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-index-stats-header forum-index-top"><?php echo $lang_help['help_login_desc']; ?></td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<?php echo $lang_help['help_login_contents']; ?>						
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"></td></tr>
		</table>		
<?php }elseif ($template_hook=='11'){ ?>		
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td id="top" class="forum-topic-subject"><?php echo $lang_help['help_posting_title']; ?></td>
			</tr>
			<tr>
				<td class="forum-index-stats-sub"> </td>
			</tr>			
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-index-stats-header forum-index-top"><?php echo $lang_help['help_posting_desc']; ?></td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<?php echo $lang_help['help_posting_contents']; ?>						
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"></td></tr>
		</table>		
	<?php }elseif ($template_hook=='12'){ ?>		
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td id="top" class="forum-topic-subject"><?php echo $lang_help['help_mods_title']; ?></td>
			</tr>
			<tr>
				<td class="forum-index-stats-sub"> </td>
			</tr>			
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-index-stats-header forum-index-top"><?php echo $lang_help['help_mods_desc']; ?></td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<?php echo $lang_help['help_mods_contents']; ?>						
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"></td></tr>
		</table>	
<?php }elseif ($template_hook=='end'){ ?>		
<?php } ?>