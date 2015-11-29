<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
		<!-- myoptions links -->
		<div class="myoptions-left" style="width: 20%; float: left;">
			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr><td class="forum-topic-subject"><?php echo $lang['myoptions_profile']; ?></td></tr>
			</table>
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'">
						<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=myoptions", "myoptions"); ?>"><?php echo $lang['myoptions_home']; ?></a>
					</td>
				</tr>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'">
						<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=myoptions&act=information", "myoptions/information"); ?>"><?php echo $lang['myoptions_information']; ?></a>
					</td>
				</tr>
<?php if ($can_use_avatar=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'">
						<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=myoptions&act=avatar", "myoptions/avatar"); ?>"><?php echo $lang['myoptions_avatar']; ?></a>
					</td>
				</tr>
<?php } if ($can_use_sig=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'">
						<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=myoptions&act=signature", "myoptions/signature"); ?>"><?php echo $lang['myoptions_signature']; ?></a>
					</td>
				</tr>
<?php } if ($can_change_own_name=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'">
						<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=myoptions&act=username", "myoptions/username"); ?>"><?php echo $lang['myoptions_username']; ?></a>
					</td>
				</tr>
<?php } if ($can_change_user_title=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'">
						<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=myoptions&act=usertitle", "myoptions/usertitle"); ?>"><?php echo $lang['myoptions_usertitle']; ?></a>
					</td>
				</tr>
<?php } ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'">
						<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=myoptions&act=password", "myoptions/password"); ?>"><?php echo $lang['myoptions_password']; ?></a>
					</td>
				</tr>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'">
						<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=myoptions&act=email", "myoptions/email"); ?>"><?php echo $lang['myoptions_email']; ?></a>
					</td>
				</tr>
			</table>
			<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-forum-footer-contents"> </td></tr>
			</table>
			<br />

			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr><td class="forum-topic-subject"><?php echo $lang['myoptions_community']; ?></td></tr>
			</table>
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'">
						<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=myoptions&act=friendlist", "myoptions/friendlist"); ?>"><?php echo $lang_user['friendlist_title']; ?></a>
					</td>
				</tr>

			<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-forum-footer-contents"> </td></tr>
			</table>
			<br />

			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr><td class="forum-topic-subject"><?php echo $lang['myoptions_options']; ?></td></tr>
			</table>
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'">
						<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=myoptions&act=settings", "myoptions/settings"); ?>"><?php echo $lang['myoptions_general_settings']; ?></a>
					</td>
				</tr>
<?php if ($can_change_style=='1'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'">
						<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=myoptions&act=style", "myoptions/style"); ?>"><?php echo $lang['myoptions_theme']; ?></a>
					</td>
				</tr>
<?php } ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'">
						<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=myoptions&act=timezone", "myoptions/timezone"); ?>"><?php echo $lang['myoptions_timezone']; ?></a>
					</td>
				</tr>
<?php if ($upgrade_total!='0'){ ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'">
						<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=upgrade", "upgrade"); ?>"><?php echo $lang['myoptions_upgrade']; ?></a>
					</td>
				</tr>
<?php } ?>
				<tr>
					<td class="forum-jump-content forum-index-top" onmouseover="this.className='forum-jump-content-hover forum-index-top'" onmouseout="this.className='forum-jump-content forum-index-top'">
						<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=myoptions&act=subscriptions", "myoptions/subscriptions"); ?>"><?php echo $lang['myoptions_subscriptions']; ?></a>
					</td>
				</tr>
			</table>
			<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-forum-footer-contents"> </td></tr>
			</table>
		</div>
		<div class="myoptions-right" style="width: 80%; float: left;">
			<div class="my-controls-content" style="padding-left: 20px;">
<?php } elseif ($template_hook=='2'){ ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>	
<?php } ?>