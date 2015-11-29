<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
								<!-- clickable smilies -->
<?php if ($_GET['func']=='edit'){ ?>
								<a style="text-decoration: none;" href="javascript:smilies(document.<?php echo $formID; ?>.<?php echo $areaID; ?>, '&nbsp;<?php echo "$smiley_code"; ?>&nbsp;');">	
<?php }else{ ?>
								<a style="text-decoration: none;" href="javascript:smilies(document.<?php echo $formID; ?>.<?php echo $areaID; ?>, '&nbsp;<?php echo "$smiley_code"; ?>&nbsp;');">
<?php } ?>
									<img  src="<?php echo "$lb_domain"; ?>/<?php echo "$smiley_path"; ?>/<?php echo "$smiley_link"; ?>" style="cursor:pointer;" alt="" />
								</a>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>