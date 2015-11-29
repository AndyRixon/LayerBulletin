<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=="2"){ ?>
			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr><td class="forum-topic-subject"><?php echo $lang_admin['preview_title']; ?></td></tr>
				<tr><td class="forum-index-stats-sub"> </td></tr>
			</table>
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['preview_sub_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['preview_desc']; ?>
					<br /><br />
					<div style="width: 10%; float: left;">
						<strong><?php echo $lang_admin['preview_id']; ?></strong>
					</div>
					<div style="width: 20%; float: left;">
						<strong><?php echo $lang_admin['preview_member']; ?></strong>
					</div>
					<div style="width: 50%; float: left;">
						<strong><?php echo $lang_admin['preview_topic']; ?></strong>
					</div>
					<div style="width: 20%; float: left; text-align: center;">
						<strong><?php echo $lang_admin['preview_action']; ?></strong>
					</div>
<?php }elseif ($template_hook=="3"){ ?>
					<div style="width: 10%; float: left;">
						<a href="<?php echo lb_link("index.php?page=findpost&post=$post","findpost/$post"); ?>">#<?php echo "$post"; ?></a>
					</div>
					<div style="width: 20%; float: left;">
						<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=messages&act=new&id=$member_id","messages/new/$member_id"); ?>" title="<?php echo $lang_admin['preview_message']; ?>"><span class="warn-remove"><?php echo "$member_name"; ?></span></a>
					</div>
					<div style="width: 50%; float: left;">
						<?php echo "$title"; ?>
					</div>
					<div style="width: 20%; float: left; text-align: center;">
						<a href="<?php echo lb_link("index.php?page=admin&act=preview&action=approve&id=$id","admin/preview/approve/$id"); ?>"><img  src="<?php echo "$plus_img"; ?>" alt="tick" title="<?php echo $lang_admin['preview_approve']; ?>" /></a> 
						<a href="<?php echo lb_link("index.php?page=admin&act=preview&action=reject&id=$id","admin/preview/reject/$id"); ?>"><img  src="<?php echo "$minus_img"; ?>" alt="tick" title="<?php echo $lang_admin['preview_reject']; ?>" /></a>
					</div>
<?php }elseif ($template_hook=="4"){ ?>
				</td></tr>
			</table>
			<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-forum-footer-contents"> </td></tr>
			</table>
<?php }elseif ($template_hook=='successApproved'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['preview_approved']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successRejected'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['preview_rejected']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>	
<?php } ?>