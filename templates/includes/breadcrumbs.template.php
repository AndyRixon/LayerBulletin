<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
				<!-- breadcrumbs -->
				<div class="breadcrumbs">
					<img  src="<?php echo "$home_img"; ?>" alt="" />&nbsp;  
					<a  href="<?php echo "$lb_domain"; ?>"><strong><?php echo $lang['topic_home']; ?></strong></a>
<?php }elseif ($template_hook=='2'){ ?>		
<?php if ($parent_id_two!='0' AND $parent_id_last!=''){ ?>
					 > <a  href="<?php echo lb_link("index.php?forum=$parent_id_last", "forum/$forum_title_parent_last-$parent_id_last"); ?>"><strong><?php echo "$parent_name_last"; ?></strong></a>
<?php } ?>
<?php if ($parent!='0'){ ?>
					 > <a  href="<?php echo lb_link("index.php?forum=$parent_id", "forum/$forum_title_parent-$parent_id"); ?>"><strong><?php echo "$parent_name"; ?></strong></a>
<?php } ?>
					 > <a  href="<?php echo lb_link("index.php?forum=$forum_id", "forum/$forum_title-$forum_id"); ?>"><strong><?php echo "$name"; ?></strong></a>
<?php }elseif ($template_hook=='3'){ ?>
					 > <a  href="<?php echo lb_link("index.php?topic=$topic", "topic/$topic_title-$topic"); ?>"><strong><?php echo "$title"; ?></strong></a>
<?php }elseif ($template_hook == 6){ ?>
	<?php echo $extra; ?>
<?php }elseif ($template_hook=='4'){ ?>
		 			<span class="breadrumbs-location"> > <strong><?php echo "$location_name"; ?></strong></span>
<?php }elseif ($template_hook=='5'){ ?>
				</div>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>