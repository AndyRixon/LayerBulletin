<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='2'){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['permissions_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="permissions" method="post" action="<?php echo lb_link("index.php?page=admin&act=permissions","admin/permissions"); ?>">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['permissions_title_forum']; ?> - <?php echo "$name"; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">				
					<?php echo $lang_admin['permissions_desc']; ?><br /><br />
<?php }elseif ($template_hook=='3'){ ?>
					<div style="width: 22%; float: left;">
						<strong>&nbsp;</strong>
					</div>
					<div style="width: 13%; float: left; text-align: center;">
						<input type="checkbox" class="checkbox" style="display: none;" id="colcheck1" onchange="checkUncheckSome('colcheck1','<?php echo "$array_can_view_forum"; ?>');" />
						<label style="cursor: pointer;" title="<?php echo $lang_admin['permissions_click_all']; ?>" for="colcheck1"><?php echo $lang_admin['permissions_show']; ?></label>
					</div>
					<div style="width: 13%; float: left; text-align: center;">
						<input type="checkbox" class="checkbox" style="display: none;" id="colcheck2" onchange="checkUncheckSome('colcheck2','<?php echo "$array_can_read_topics"; ?>');" />
						<label style="cursor: pointer;" title="<?php echo $lang_admin['permissions_click_all']; ?>" for="colcheck2"><?php echo $lang_admin['permissions_read']; ?></label>
					</div>
					<div style="width: 13%; float: left; text-align: center;">
						<input type="checkbox" class="checkbox" style="display: none;" id="colcheck3" onchange="checkUncheckSome('colcheck3','<?php echo "$array_can_add_topics"; ?>');" />
						<label style="cursor: pointer;" title="<?php echo $lang_admin['permissions_click_all']; ?>" for="colcheck3"><?php echo $lang_admin['permissions_add']; ?></label>
					</div>
					<div style="width: 13%; float: left; text-align: center;">
						<input type="checkbox" class="checkbox" style="display: none;" id="colcheck4" onchange="checkUncheckSome('colcheck4','<?php echo "$array_can_reply_topics"; ?>');" />
						<label style="cursor: pointer;" title="<?php echo $lang_admin['permissions_click_all']; ?>" for="colcheck4"><?php echo $lang_admin['permissions_reply']; ?></label>
					</div>
					<div style="width: 13%; float: left; text-align: center;">
						<input type="checkbox" class="checkbox" style="display: none;" id="colcheck5" onchange="checkUncheckSome('colcheck5','<?php echo "$array_can_download_attachment"; ?>');" />
						<label style="cursor: pointer;" title="<?php echo $lang_admin['permissions_click_all']; ?>" for="colcheck5"><?php echo $lang_admin['permissions_download']; ?></label>
					</div>
					<div style="width: 13%; float: left; text-align: center;">
						<input type="checkbox" class="checkbox" style="display: none;" id="colcheck6" onchange="checkUncheckSome('colcheck6','<?php echo "$array_can_add_attachment"; ?>');" />
						<label style="cursor: pointer;" title="<?php echo $lang_admin['permissions_click_all']; ?>" for="colcheck6"><?php echo $lang_admin['permissions_upload']; ?></label>
					</div>
					<br /><br />
<?php }elseif ($template_hook=='4'){ ?>
					<div style="width: 22%; float: left;">
						<input type="checkbox" class="checkbox" style="display: none;" id="rowcheck<?php echo "$group_id"; ?>" onchange="checkUncheckSome('rowcheck<?php echo "$group_id"; ?>','can_view_forum<?php echo "$group_id"; ?>,can_read_topics<?php echo "$group_id"; ?>,can_add_topics<?php echo "$group_id"; ?>,can_reply_topics<?php echo "$group_id"; echo ($group_id != 4) ? ",can_add_attachment$group_id" : "" ?>,can_download_attachment<?php echo "$group_id"; ?>');" />
						<label style="cursor: pointer;" title="<?php echo $lang_admin['permissions_click_all']; ?>" for="rowcheck<?php echo "$group_id"; ?>"><strong><span style="color: <?php echo "$group_color"; ?>;"><?php echo "$group_name"; ?></span></strong></label>
					</div>
<?php }elseif ($template_hook=='5'){ ?>
					<div style="width: 13%; float: left; text-align: center;">
<?php if ($can_view_forum=='1'){ ?>
						<input type="checkbox" class="checkbox" name="can_view_forum<?php echo "$group_id"; ?>" id="can_view_forum<?php echo "$group_id"; ?>" value="<?php echo "$can_view_forum"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_view_forum<?php echo "$group_id"; ?>" id="can_view_forum<?php echo "$group_id"; ?>" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 13%; float: left; text-align: center;">
<?php if ($can_read_topics=='1'){ ?>
						<input type="checkbox" class="checkbox" name="can_read_topics<?php echo "$group_id"; ?>" id="can_read_topics<?php echo "$group_id"; ?>" value="<?php echo "$can_read_topics"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_read_topics<?php echo "$group_id"; ?>" id="can_read_topics<?php echo "$group_id"; ?>" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 13%; float: left; text-align: center;">
<?php if ($can_add_topics=='1'){ ?>
						<input type="checkbox" class="checkbox" name="can_add_topics<?php echo "$group_id"; ?>" id="can_add_topics<?php echo "$group_id"; ?>" value="<?php echo "$can_add_topics"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_add_topics<?php echo "$group_id"; ?>" id="can_add_topics<?php echo "$group_id"; ?>" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 13%; float: left; text-align: center;">
<?php if ($can_reply_topics=='1'){ ?>
						<input type="checkbox" class="checkbox" name="can_reply_topics<?php echo "$group_id"; ?>" id="can_reply_topics<?php echo "$group_id"; ?>" value="<?php echo "$can_reply_topics"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_reply_topics<?php echo "$group_id"; ?>" id="can_reply_topics<?php echo "$group_id"; ?>" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 13%; float: left; text-align: center;">
<?php if ($can_download_attachment=='1'){ ?>
						<input type="checkbox" class="checkbox" name="can_download_attachment<?php echo "$group_id"; ?>" id="can_download_attachment<?php echo "$group_id"; ?>" value="<?php echo "$can_download_attachment"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_download_attachment<?php echo "$group_id"; ?>" id="can_download_attachment<?php echo "$group_id"; ?>" value="1" /><br /><br />
<?php } ?>
					</div>
					<div style="width: 13%; float: left; text-align: center;">
<?php if ($group_id=='4'){ ?>
						<input type="checkbox" class="checkbox" name="can_add_attachment<?php echo "$group_id"; ?>" id="can_add_attachment<?php echo "$group_id"; ?>" value="<?php echo "$can_add_attachment"; ?>" disabled /><br /><br />
<?php }elseif ($can_add_attachment=='1'){ ?>
						<input type="checkbox" class="checkbox" name="can_add_attachment<?php echo "$group_id"; ?>" id="can_add_attachment<?php echo "$group_id"; ?>" value="<?php echo "$can_add_attachment"; ?>" checked /><br /><br />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="can_add_attachment<?php echo "$group_id"; ?>" id="can_add_attachment<?php echo "$group_id"; ?>" value="1" /><br /><br />
<?php } ?>
					</div>
<?php }elseif ($template_hook=='6'){ ?>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<input type="hidden" name="forum_id" value="<?php echo "$id"; ?>" />
<?php if($can_change_forum_settings=='1'){ ?>
					<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
					<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
					<input type="hidden" name="<?php echo "success" ?>" value="<?php echo $_GET['success']; ?>" />
<?php } ?>
					<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
				</td></tr>
			</table>
		</form>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>
