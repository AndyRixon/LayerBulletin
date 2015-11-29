<?php if ($template_hook=='start'){ ?>
<?php }elseif($template_hook=='1'){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if ($theme!='layerbulletin_default'){ ?>
		<link href="<?php echo "$lb_domain"; ?>/themes/layerbulletin_default/stylesheet.css" type="text/css" rel="StyleSheet" />
<?php } ?>
		<link href="<?php echo "$lb_domain"; ?>/themes/<?php echo "$theme"; ?>/stylesheet.css" type="text/css" rel="StyleSheet" />
		<!--[if lt IE 7]><script type="text/javascript" src="<?php echo "$lb_domain"; ?>/scripts/js/unitpngfix.js"></script><![endif]-->	
		<script type="text/javascript" src="<?php echo "$lb_domain"; ?>/scripts/js/animatedcollapse.js"></script>
	</head>
	<body>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject"><?php echo $lang['preview_title']; ?> <?php echo $subject; ?></td>
			</tr>
		</table>
		<table class="forum-board">
			<tr>
				<td class="forum-board-post">
					<?php echo $content; ?>
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"></td></tr>
		</table>
	</body>
</html>			
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>