<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=="4"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['custom_edit_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-stats-header forum-index-top"></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
				<form name="edit" method="post" action="<?php echo lb_link("index.php?page=admin&act=custom&func=edit","admin/custom/edit"); ?>">
					<div style="width:30%; float: left;"><strong><?php echo $lang_admin['custom_field_name']; ?></strong><br /><br /></div>
					<div style="width:70%; float: left;"><input type="text" name="field_name" value="<?php echo "$field_name"; ?>" /><br /><br /></div>
					<div style="width:30%; float: left;"><strong><?php echo $lang_admin['custom_field_description']; ?></strong><br /><br /></div>
					<div style="width:70%; float: left;"><textarea rows="4" style="width:98%;" name="field_description"><?php echo "$field_description"; ?></textarea><br /><br /></div>
					<div style="width:30%; float: left;"><strong><?php echo $lang_admin['custom_field_order']; ?></strong><br /><br /></div>
					<div style="width:70%; float: left;">
						<select name="order_field">
<?php }elseif ($template_hook=="5"){ ?>
<?php if ($root_counter==$order_field){ ?>
							<option value="<?php echo "$root_counter"; ?>" selected><?php echo "$root_counter"; ?></option>
<?php }else{ ?>
							<option value="<?php echo "$root_counter"; ?>"><?php echo "$root_counter"; ?></option>
<?php } ?>
<?php }elseif ($template_hook=="6"){ ?>
						</select>
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<input type="hidden" name="id" value="<?php echo "$id"; ?>" />
					<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
					<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
					<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
				</td></tr>
			</form>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=="8"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['custom_new_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-stats-header forum-index-top"></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
				<form name="edit" method="post" action="<?php echo lb_link("index.php?page=admin&act=custom&func=new","admin/custom/new"); ?>">
					<div style="width:30%; float: left;"><strong><?php echo $lang_admin['custom_field_name']; ?></strong><br /><br /></div>
					<div style="width:70%; float: left;"><input type="text" name="field_name" value="" /><br /><br /></div>
					<div style="width:30%; float: left;"><strong><?php echo $lang_admin['custom_field_description']; ?></strong><br /><br /></div>
					<div style="width:70%; float: left;"><textarea rows="4" style="width:98%;" name="field_description"></textarea><br /><br /></div>
					<div style="width:30%; float: left;"><strong><?php echo $lang_admin['custom_field_order']; ?></strong><br /><br /></div>
					<div style="width:70%; float: left;">
						<select name="order_field">
<?php }elseif ($template_hook=="9"){ ?>
							<option value="<?php echo "$root_counter"; ?>"><?php echo "$root_counter"; ?></option>
<?php }elseif ($template_hook=="10"){ ?>
						</select>
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<input type="hidden" name="id" value="<?php echo "$id"; ?>" />
<?php if($can_change_forum_settings=='1'){ ?>
					<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
					<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
					<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
				</td></tr>
			</form>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=="11"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['custom_fields']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form method="post" action="<?php echo lb_link("index.php?page=admin&act=custom","admin/custom"); ?>">
		
			<?php if ($can_change_forum_settings == 1){ ?>
				<input type="hidden" name="token_id" value="<?php echo $token_id; ?>" />
				<input type="hidden" name="<?php echo $token_name; ?>" value="<?php echo $token; ?>" />
				<input type="hidden" name="hash" value="<?php echo $hash; ?>" />
			<?php } ?>
			
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['custom_fields_list']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">		
					<?php echo $lang_admin['custom_fields_desc']; ?><br /><br />
<?php }elseif ($template_hook=="12"){ ?>
					<div style="width:50%; float:left;"><a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=custom&func=edit&id=$id","admin/custom/edit/$id"); ?>"><?php echo "$name"; ?></a></div>
					<div style="width:25%; text-align:right; float:left;">
					
						<a href="<?php echo lb_link("index.php?page=admin&act=custom&func=edit&id=$id","admin/custom/edit/$id"); ?>">
							<img  src="<?php echo "$edit_icon_img"; ?>" alt="<?php echo $lang_admin['custom_edit']; ?>" />
						</a>
						
						<input type="hidden" name="custom_delete_id" value="<?php echo $id; ?>" />
						<input
							type="image"
							name="custom_delete"
							value="1"
							style="border: none; margin: 0; width: auto; padding: 0;"
							src="<?php echo $delete_icon_img; ?>"
							alt="<?php echo $lang_admin['custom_delete']; ?>"
							onclick="javascript:return confirm('<?php echo $lang['topic_remove']; ?> (<?php echo $name; ?>)')"
						/>
					
					</div>
					<div style="width:25%; text-align:right; float:left;">
<?php }elseif ($template_hook=="13"){ ?>
						<select name="order_field<?php echo "$id"; ?>">
<?php }elseif ($template_hook=="14"){ ?>
<?php if ($root_counter==$order_field){ ?>
							<option value="<?php echo "$root_counter"; ?>" selected><?php echo "$root_counter"; ?></option>
<?php } else{ ?>
							<option value="<?php echo "$root_counter"; ?>"><?php echo "$root_counter"; ?></option>
<?php } ?>
<?php }elseif ($template_hook=="15"){ ?>
						</select>
					</div>
<?php }elseif ($template_hook=="16"){ ?>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<div style="width:50%; text-align:left; float:left;">
						<a class="submit-button img-add-forum" href="<?php echo lb_link("index.php?page=admin&act=custom&func=new","admin/custom/new"); ?>"><?php echo $lang['button_add_field']; ?></a>
					</div>
					<div style="width:50%; text-align:right; float:left;">
						<input type="submit" name="custom_reorder" class="submit-button img-reorder" value="<?php echo $lang['button_reorder']; ?>" />
					</div>
				</td></tr>
			</table>
		</form>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='successAdded'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['custom_added']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successUpdated'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['custom_updated']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successDeleted'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['custom_removed']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>					
<?php } ?>