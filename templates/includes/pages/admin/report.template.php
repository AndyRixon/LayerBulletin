<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=="2"){ ?>
			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr><td class="forum-topic-subject"><?php echo $lang_admin['report_title']; ?></td></tr>
				<tr><td class="forum-index-stats-sub"> </td></tr>
			</table>
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['report_action']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['report_action_desc']; ?><br /><br />
					<div style="width: 15%; float: left;">
						<strong><?php echo $lang_admin['report_post']; ?></strong>
					</div>
					<div style="width: 20%; float: left;">
						<strong><?php echo $lang_admin['report_by']; ?></strong>
					</div>
					<div style="width: 50%; float: left;">
						<strong><?php echo $lang_admin['report_reason']; ?></strong>
					</div>
					<div style="width: 15%; float: left; text-align: center;">
						<strong><?php echo $lang_admin['report_reviewed']; ?></strong>
					</div>
<?php }elseif ($template_hook=="3"){ ?>
					<div style="width: 15%; float: left;">
						<a href="<?php echo lb_link("index.php?page=findpost&post=$post","findpost/$post"); ?>">#<?php echo "$post"; ?></a>
					</div>
					<div style="width: 20%; float: left;">
						<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=messages&act=new&id=$reported_by","messages/new/$reported_by"); ?>" title="<?php echo $lang_admin['report_pm']; ?>"><span class="warn-remove"><?php echo "$name"; ?></span></a>
					</div>
					<div style="width: 50%; float: left;">
						<?php echo "$content"; ?>
					</div>
					<div style="width: 15%; float: left; text-align: center;">
						<a href="<?php echo lb_link("index.php?page=admin&act=report&id=$id","admin/report/$id"); ?>"><img src="<?php echo "$plus_img"; ?>" alt="tick" title="<?php echo $lang_admin['report_action_taken']; ?>" /></a>
					</div>
<?php }elseif ($template_hook=="4"){ ?>
				</td></tr>
			</table>
			<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-forum-footer-contents"> </td></tr>
			</table>
<?php }elseif ($template_hook=='successReviewed'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['report_reviewed_2']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>