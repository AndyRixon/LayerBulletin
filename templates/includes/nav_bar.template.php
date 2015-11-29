<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
			<div id="header-menu-options">
				<div style="text-align: left; float: left;">
<?php if (isset($home)){ ?>
					<a class="header-menu-options-link" href="<?php echo "$home"; ?>"><?php echo $lang['navbar_home']; ?></a>
<?php }else{ ?>
					<a class="header-menu-options-link" href="<?php echo "$lb_domain"; ?>"><?php echo $lang['navbar_home']; ?></a>
<?php } if ($rules!=''){ ?>
					<a class="header-menu-options-link" href="<?php echo "$rules"; ?>"><?php echo $lang['navbar_rules']; ?></a>
<?php } ?>
				</div>
<?php }elseif ($template_hook=='2'){ ?>
				<div style="text-align: right; float: right;">
<?php }elseif ($template_hook=='3'){ ?>
					<a class="header-menu-options-link" href="<?php echo lb_link("index.php?page=list&list=members", "list/members"); ?>" rel="nofollow"><?php echo $lang['navbar_members']; ?></a>
					<a class="header-menu-options-link" href="<?php echo lb_link("index.php?page=search", "search"); ?>" rel="nofollow"><?php echo $lang['navbar_search']; ?></a>
					<a class="header-menu-options-link" href="<?php echo lb_link("index.php?page=help", "help"); ?>"><?php echo $lang['navbar_help']; ?></a>
				</div>
			</div>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>