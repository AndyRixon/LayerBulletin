<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo $lang['smilies_popup_title']; ?></title>
<?php if ($theme!='layerbulletin_default'){ ?>
		<link href="<?php echo "$lb_domain"; ?>/themes/layerbulletin_default/stylesheet.css" type="text/css" rel="StyleSheet" />
<?php } ?>
		<link href="<?php echo "$lb_domain"; ?>/themes/<?php echo "$theme"; ?>/stylesheet.css" type="text/css" rel="StyleSheet" />
		<!--[if lt IE 7]><script type="text/javascript" src="<?php echo "$lb_domain"; ?>/scripts/js/unitpngfix.js"></script><![endif]-->
		<script type="text/javascript" src="<?php echo "$lb_domain"; ?>/scripts/js/lb_smilies.js"></script>
	</head>
	<body style="margin-top: 0px;">
		<div style="padding: 10px;">
        	<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr>
					<td class="forum-topic-subject" colspan="2"> <?php echo $lang['smilies_popup_title']; ?></td>
				</tr>
			</table>
			<table class="forum-board" cellpadding="0" cellspacing="0">
<?php }elseif($template_hook=='2'){ ?>
				<tr>
					<td class="forum-index-td-middle<?php echo "$alt_td_class"; ?>" style="width:50%; text-align: center;">
						<img  src="<?php echo "$path/$link"; ?>" alt="" />
					</td>
					<td class="forum-index-td-middle<?php echo "$alt_td_class"; ?>" style="width:50%; text-align: center;">
						<?php echo "$code"; ?>
					</td>
				</tr>
<?php }elseif($template_hook=='3'){ ?>
			</table>
			<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-forum-footer-contents"> </td></tr>
			</table>
		</div>
	</body>
</html>
<?php }elseif ($template_hook=='end'){ ?>		
<?php } ?>