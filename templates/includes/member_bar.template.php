<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
			<table cellpadding="0" cellspacing="0" style="width: 100%; vertical-align: middle;">
				<tr>
<?php if (!isset($_COOKIE['lb_name'])){ ?>
					<td class="header-menu-guest">
<?php } elseif (isset($report_number) && $report_number!='0' && $can_change_forum_settings=='1'){ ?>
					<td class="header-menu-report">
<?php } elseif (isset($moderate_number) && $moderate_number!='0' && $can_moderate_members=='1'){ ?>
					<td class="header-menu-report">
<?php } elseif (isset($messages_number) && $messages_number!='0'){ ?>
					<td class="header-menu-message">
<?php }else{ ?>
					<td class="header-menu">
<?php } ?>
						<!-- show links on the nav-bar -->
<?php if (isset($lb_name)){ ?>
						<span class="nav-bar-text"><?php echo $lang['navbar_loggedin']; ?></span>&nbsp;<?php echo member_link($my_id); ?>
<?php } else{ ?>
						<span class="nav-bar-text"><?php echo $lang['navbar_guest']; ?></span>
<?php }if (!isset($lb_name) && !isset($lb_password)){ ?>
						&nbsp;|&nbsp;&nbsp;<a  href="<?php echo lb_link("index.php?page=login", "login"); ?>" rel="nofollow"><?php echo $lang['navbar_login']; ?></a>
						&nbsp;|&nbsp;&nbsp;<a  href="<?php echo lb_link("index.php?page=register", "register"); ?>"><?php echo $lang['navbar_register']; ?></a>
<?php } elseif ($name!='' && $password!=''){ if ($can_change_site_settings=='1'){ ?>
						&nbsp;|&nbsp;&nbsp;<a  href="<?php echo lb_link("index.php?page=admin", "admin"); ?>"><?php echo $lang['navbar_admin']; ?></a>
<?php } elseif ($can_change_forum_settings=='1'){ ?>
						&nbsp;|&nbsp;&nbsp;<a  href="<?php echo lb_link("index.php?page=admin", "admin"); ?>"><?php echo $lang['navbar_mod']; ?></a>
<?php } ?>
						&nbsp;|&nbsp;&nbsp;<a  href="<?php echo lb_link("index.php?page=myoptions", "myoptions"); ?>"><?php echo $lang['navbar_user']; ?></a>
<?php if ($unread_posts!='0'){ ?>
						&nbsp;|&nbsp;&nbsp;<a  href="<?php echo lb_link("index.php?page=search&area=newposts", "newposts"); ?>"><?php echo $lang['header_tab_forums_new']; ?></a>
<?php } ?>			
<?php  if ($can_pm=='0'){ }elseif ($messages_number!='0'){ ?>
						&nbsp;|&nbsp;&nbsp;<a  href="<?php echo lb_link("index.php?page=messages&act=inbox", "messages"); ?>"><img  src="<?php echo "$email_img"; ?>" /> <?php echo $lang['navbar_message_new']; ?></a>
<?php }elseif ($messages_number=='0'){ ?>
						&nbsp;|&nbsp;&nbsp;<a  href="<?php echo lb_link("index.php?page=messages&act=inbox", "messages"); ?>"><?php echo $lang['navbar_message']; ?></a>
<?php }if ($report_number!='0' && $can_change_forum_settings!='0'){ ?>
						&nbsp;|&nbsp;&nbsp;<a  href="<?php echo lb_link("index.php?page=admin&act=report", "admin/report"); ?>"><img  src="<?php echo "$report_img"; ?>" /> <?php echo $lang['navbar_report']; ?></a>
<?php }if ($moderate_number!='0' && $can_change_forum_settings!='0'){ ?>
						&nbsp;|&nbsp;&nbsp;<a  href="<?php echo lb_link("index.php?page=admin&act=preview", "admin/preview"); ?>"><img  src="<?php echo "$comments_img"; ?>" /> <?php echo $lang['navbar_moderated']; ?></a>
<?php }} ?>
<?php }elseif ($template_hook=='2'){ ?>
<?php if (isset($_COOKIE['lb_name'])){ ?>	
						&nbsp;|&nbsp;&nbsp;<a  href="<?php echo lb_link("index.php?page=logout", "logout"); ?>"><?php echo $lang['navbar_logout']; ?></a>
<?php } ?>
					</td>
				</tr>
			</table>
			
<?php if ($board_offline=='1' && isset($lb_name) && $_GET['page']!='offline' && $_GET['page']!='login' && $_GET['page']!='logout'){ ?>

			<table cellpadding="0" cellspacing="0" style="width: 100%; vertical-align: middle;">
				<tr>
					<td class="header-menu-guest">
						<img src="<?php echo "$info_img"; ?>" alt="" />&nbsp;&nbsp;<span class="warn-add"><?php echo $lang['navbar_offline']; ?></span>
					</td>
				</tr>
			</table>


<?php } ?>

<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>