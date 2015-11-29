<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<!-- show site name and location -->
		<title><?php echo "$site_name"; ?> | <?php echo "$location_name"; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="<?php echo "$location_text"; ?>" />
		<meta name="keywords" content="<?php echo "$site_name, $site_desc, $location_name"; ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
		<link rel="shortcut icon" href="<?php echo "$lb_domain"; ?>/favicon.ico" />
<?php if (isset($_GET['forum']) && $show_rss=='1'){ ?>
		<!-- show rss for forum -->
		<link href="<?php echo "$lb_domain"; ?>/rss/rss.php?forum=<?php echo "$forum"; ?>" rel="alternate" type="application/rss+xml" title="<?php echo $lang['header_rss_forum']; ?>" />
<?php } ?>
		<!-- show stylesheet -->
<?php if ($theme!='layerbulletin_default'){ ?>
		<link href="<?php echo "$lb_domain"; ?>/themes/layerbulletin_default/stylesheet.css" type="text/css" rel="StyleSheet" />
<?php } ?>
		<link href="<?php echo "$lb_domain"; ?>/themes/<?php echo "$theme"; ?>/stylesheet.css" type="text/css" rel="StyleSheet" />		
		<style type="text/css">
			select, option {
				behavior: url(<?php echo "$lb_domain"; ?>/scripts/lb_select.htc);
			}
		</style>							
		<script type="text/javascript">
			var clear="<?php echo "$lb_domain"; ?>/scripts/js/clear.gif" 
		</script>	
	
		<!--[if lt IE 7]><script type="text/javascript" src="<?php echo "$lb_domain"; ?>/scripts/js/unitpngfix.js"></script><![endif]-->
		<script type="text/javascript" src="<?php echo "$lb_domain"; ?>/scripts/js/lb_js.js"></script>
		<script type="text/javascript" src="<?php echo "$lb_domain"; ?>/scripts/js/prototype.js"></script>
		<script type="text/javascript" src="<?php echo "$lb_domain"; ?>/scripts/js/controltextarea.js"></script>
		<script type="text/javascript" src="<?php echo "$lb_domain"; ?>/scripts/js/control.textarea.bbcode.js"></script>		

		<script type="text/javascript">
			function SmiliesPopUp(URL) {
			day = new Date();
			id = day.getTime();
			eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=300,height=400');");
			}
			function WarnPopUp(URL) {
			day = new Date();
			id = day.getTime();
			eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=400');");
			}			
		</script>
<?php }elseif ($template_hook=='before_body'){ ?>	
	</head>						
	<body>
<?php }elseif ($template_hook=='after_body'){ ?>				
<?php if (!isset($lb_name) && $register_bar=='1' && $guest_register=='1' && $_GET['page'] !='register'){ ?>
		<div id="explorerbar"><a href="<?php echo lb_link("index.php?page=register", "register"); ?>"><?php echo $lang['header_guest']; ?></a></div>
<?php } ?>
		<div class="site-width">
			<!-- show the site name and description in the header -->
			<div class="header">
				<div class="header-left">
					<a href="<?php echo "$lb_domain"; ?>"><img  src="<?php echo "$header_left_img"; ?>" alt="" /></a>
				</div>
				<div class="header-right">
					<a class="header-site-name" href="<?php echo "$lb_domain"; ?>" ><strong><?php echo "$site_name"; ?></strong></a><br />
					<span class="header-text-sub"><?php echo "$site_desc"; ?></span>
				</div>
			</div>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>
