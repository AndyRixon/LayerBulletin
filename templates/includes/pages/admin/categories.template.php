<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=="5"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['categories_edit_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="submit" method="post" action="<?php echo lb_link("index.php?page=admin&act=categories","admin/categories"); ?>">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['categories_edit_forum']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
				<?php echo $lang_admin['categories_edit_forum_desc']; ?><br /><br />
					<input type="text" name="name" value="<?php echo "$name"; ?>" />
				</td></tr>	
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['categories_forum_desc']; ?></td></tr>				
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">	
					<?php echo $lang_admin['categories_forum_desc_desc']; ?><br /><br />			
					<textarea rows="10" cols="98" name="description" class="post"><?php echo "$description"; ?></textarea>
					<br />				
				</td></tr>	
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['categories_forum_announce']; ?></td></tr>				
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['categories_forum_announce_desc']; ?><br /><br />			
					<textarea rows="3" cols="98" name="forum_rules" class="post"><?php echo "$forum_rules"; ?></textarea>
					<br />				
					<strong><?php echo $lang_admin['categories_edit_parent']; ?></strong>&nbsp;
					<select name="parent">
						<option value="<?php echo "$parent"; ?>"><?php echo "$parent_name"; ?></option>
						<option value="0"><?php echo $lang_admin['categories_edit_parent_no']; ?></option>
<?php }elseif ($template_hook=="6"){ ?>
						<option value="<?php echo "$id"; ?>"><?php echo "$name"; ?></option>
<?php }elseif ($template_hook=="7"){ ?>
						<option value="<?php echo "$id"; ?>">&nbsp;&nbsp;&nbsp;&nbsp;--> <?php echo "$name"; ?></option>
<?php }elseif ($template_hook=="8"){ ?>
					</select>
					<?php echo $lang_admin['categories_theme']; ?> 
					<select name="forum_theme">
<?php if ($forum_theme==''){ ?>
						<option value="" selected="selected"><?php echo $lang_admin['categories_theme_default']; ?></option>
<?php }else{ ?>
						<option value="<?php echo "$forum_theme"; ?>" selected="selected"><?php echo "$forum_theme"; ?></option>
<?php } ?>
						<optgroup label="<?php echo $lang_admin['categories_theme_select']; ?>">	
							<option value=""><?php echo $lang_admin['categories_theme_default']; ?></option>							
<?php }elseif ($template_hook=="27"){ ?>
						</optgroup>
					</select>	
					<br />
<?php if ($read_only=="0"){ ?>
					<input type="checkbox" class="checkbox" name="read_only" value="1" /> <?php echo $lang_admin['categories_read_only']; ?>
<?php }else{ ?>
					<input type="checkbox" class="checkbox" checked="checked" name="read_only" value="1" /> <?php echo $lang_admin['categories_read_only']; ?>
<?php }if ($post_count=="0"){ ?>
					<input type="checkbox" class="checkbox" name="post_count" value="1" /> <?php echo $lang_admin['categories_count']; ?>
<?php }else{ ?>
					<input type="checkbox" class="checkbox" checked="checked" name="post_count" value="1" /> <?php echo $lang_admin['categories_count']; ?>
<?php } ?>
<?php if ($redirect_url == ''){ ?>
					<input type="checkbox" class="checkbox" id="redirect_url_checkbox" onclick="showhide_redirect();" /> <?php echo $lang_admin['categories_redirection']; ?>
<?php }else{ ?>
					<input type="checkbox" class="checkbox" id="redirect_url_checkbox" checked="checked" onclick="showhide_redirect();" /> <?php echo $lang_admin['categories_redirection']; ?>
<?php } ?>
<?php if ($allow_dl_module=="0"){ ?>
					<input type="hidden" name="allow_dl_module" value="0" />
<?php }else{ ?>
					<input type="hidden" value="0" name="allow_dl_module" />
<?php } ?>
					<input type="hidden" name="id" value="<?php echo "".$_GET['id'].""; ?>" />
					<input type="hidden" name="post_edit_form" value="1" />
<?php if ($redirect_url == ''){ ?>
                                        <div id="redirect" style="display: none">
<?php } else { ?>
                                        <div id="redirect" style="display: block">
<?php } ?>
					<br /><?php echo $lang_admin['categories_redirect_url']; ?> <input type="text" id="redirect_url_input" name="redirect_url" value="<?php echo $redirect_url ?>"/>
                                        </div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
<?php if($can_change_forum_settings=='1'){ ?>
					<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
					<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
					<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
				</td></tr>
			</table>
		</form>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=="10"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['categories_new_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="submit" method="post" action="<?php echo lb_link("index.php?page=admin&act=categories","admin/categories"); ?>">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['categories_edit_forum']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['categories_edit_forum_desc']; ?><br /><br />
					<input type='text' name='name' value='' />
				</td></tr>	
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['categories_forum_desc']; ?></td></tr>				
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">	
					<?php echo $lang_admin['categories_forum_desc_desc']; ?><br /><br />			
					<textarea rows="10" cols="98" name="description" class="post"></textarea>
					<br />				
				</td></tr>	
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['categories_forum_announce']; ?></td></tr>				
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['categories_forum_announce_desc']; ?><br /><br />			
					<textarea rows="3" cols="98" name="forum_rules" class="post"></textarea>
					<br />				
					<strong><?php echo $lang_admin['categories_edit_parent']; ?></strong>&nbsp;
					<select name="parent">
<?php }elseif ($template_hook=="11"){ ?>
						<option value="<?php echo "$id"; ?>"><?php echo "$name"; ?></option>
<?php }elseif ($template_hook=="12"){ ?>
						<option value="<?php echo "$id"; ?>">&nbsp;&nbsp;&nbsp;&nbsp;--> <?php echo "$name"; ?></option>
<?php }elseif ($template_hook=="13"){ ?>
					</select>
					<?php echo $lang_admin['categories_theme']; ?> 
					<select name="forum_theme">
						<option value="" selected="selected"><?php echo $lang_admin['categories_theme_default']; ?></option>
						<optgroup label="<?php echo $lang_admin['categories_theme_select']; ?>">
<?php }elseif($template_hook=="26"){ ?>
						</optgroup>
					</select>
					<br />
					<input type="checkbox" class="checkbox" name="read_only" value="1" /> <?php echo $lang_admin['categories_read_only']; ?>
					<input type="checkbox" class="checkbox" checked="checked" name="post_count" value="1" /> <?php echo $lang_admin['categories_count']; ?>
					<input type="checkbox" class="checkbox" name="post_count" id="redirect_url_checkbox" onclick="showhide_redirect();" /> <?php echo $lang_admin['categories_redirection']; ?>
					<input type="hidden" name="new_forum_form" value="1" />
                                        <div id="redirect" style="display: none">
					<br /><?php echo $lang_admin['categories_redirect_url']; ?> <input type="text" id="redirect_url_input" name="redirect_url" />
                                        </div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
<?php if($can_change_forum_settings=='1'){ ?>
					<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
					<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
					<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
				</td></tr>
			</table>	
		</form>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=="14"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['categories_forums']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
			<form name="settings" method="post" action="<?php echo lb_link("index.php?page=admin&act=categories","admin/categories"); ?>">
				<table class="forum-index" cellpadding="0" cellspacing="0">
					<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['categories_forums_manage']; ?></td></tr>
					<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
						<?php echo $lang_admin['categories_forums_desc']; ?><br /><br />
					</td></tr>
<?php }elseif ($template_hook=="15"){ ?>
					<tr><td class="forum-index-stats-header forum-index-top">
						<div style="float: left; text-align: left;">
							<a href="<?php echo lb_link("index.php?page=admin&act=permissions&id=$id","admin/permissions/$id"); ?>" title="<?php echo $lang_admin['categories_permissions']; ?>"><?php echo "$name"; ?></a>&nbsp;&nbsp;
							<a href="<?php echo lb_link("index.php?page=admin&act=categories&func=edit&id=$id","admin/categories/edit/$id"); ?>"><img  src="<?php echo "$edit_icon_img"; ?>" alt="" /></a>
							<a href="<?php echo lb_link("index.php?page=admin&act=categories&func=delete&id=$id","admin/categories/delete/$id"); ?>"><img  src="<?php echo "$delete_icon_img"; ?>" alt="" /></a>	
						</div>
						<div style="float: right; text-align: right";>
							<input type="hidden" name="forum_id<?php echo "$id"; ?>" value="<?php echo "$id"; ?>" />
							<select name="forum_order<?php echo "$id"; ?>">
<?php }elseif ($template_hook=="16"){ ?>
<?php if ($root_counter==$forum_order){ ?>
								<option value="<?php echo "$root_counter"; ?>" selected><?php echo "$root_counter"; ?></option>
<?php }else{ ?>
								<option value="<?php echo "$root_counter"; ?>"><?php echo "$root_counter"; ?></option>
<?php } ?>
<?php }elseif ($template_hook=="17"){ ?>
							</select>
						</div>
					</td></tr>
					<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['categories_subforums']; ?></td></tr>
					<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
<?php }elseif ($template_hook=="18"){ ?>
						<div style="width: 5%; float: left; text-align: center;"></div>
						<div style="width: 55%; float: left;">
							<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=permissions&id=$id","admin/permissions/$id"); ?>" title="Click to change this forums permissions"><?php echo "$name"; ?></a>
						</div>
						<div style="width: 20%; float: left;">
							<a href="<?php echo lb_link("index.php?page=admin&act=categories&func=edit&id=$id","admin/categories/edit/$id"); ?>"><img  src="<?php echo "$edit_icon_img"; ?>" alt="" /></a>
							<a href="<?php echo lb_link("index.php?page=admin&act=categories&func=delete&id=$id","admin/categories/delete/$id"); ?>"><img  src="<?php echo "$delete_icon_img"; ?>" alt="" /></a>
							<input type="hidden" name="forum_id<?php echo "$id"; ?>" value="<?php echo "$id"; ?>" />
						</div>
						<div style="width: 20%; float: left;">
							<select name="forum_order<?php echo "$id"; ?>">
<?php }elseif ($template_hook=="19"){ ?>
<?php if ($sub_counter==$forum_order){ ?>
								<option value="<?php echo "$sub_counter"; ?>" selected><?php echo "$sub_counter"; ?></option>
<?php }else{ ?>
								<option value="<?php echo "$sub_counter"; ?>"><?php echo "$sub_counter"; ?></option>
<?php } ?>
<?php }elseif ($template_hook=="20"){ ?>
							</select><br />
						</div>
<?php }elseif ($template_hook=="21"){ ?>
						<div style="width: 5%; float: left; text-align: center;"></div>
						<div style="width: 55%; float: left;">
							&nbsp;&nbsp;&nbsp;&nbsp;--> <a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=admin&act=permissions&id=$id","admin/permissions/$id"); ?>" title="<?php echo $lang_admin['categories_permissions']; ?>"><?php echo "$name"; ?></a>
						</div>
						<div style="width: 10%; float: left;">
							<a href="<?php echo lb_link("index.php?page=admin&act=categories&func=edit&id=$id","admin/categories/edit/$id"); ?>"><img  src="<?php echo "$edit_icon_img"; ?>" alt="" /></a>
							<a href="<?php echo lb_link("index.php?page=admin&act=categories&func=delete&id=$id","admin/categories/delete/$id"); ?>"><img  src="<?php echo "$delete_icon_img"; ?>" alt="" /></a>
							<input type="hidden" name="forum_id<?php echo "$id"; ?>" value="<?php echo "$id"; ?>" />
						</div>
						<div style="width: 30%; float: left;">
							<select name="forum_order<?php echo "$id"; ?>">
<?php }elseif ($template_hook=="22"){ ?>
<?php if ($sub_counter_two==$forum_order_two){ ?>
								<option value="<?php echo "$sub_counter_two"; ?>" selected><?php echo "$sub_counter_two"; ?></option>
<?php }else{ ?>
								<option value="<?php echo "$sub_counter_two"; ?>"><?php echo "$sub_counter_two"; ?></option>
<?php } ?>
<?php }elseif ($template_hook=="23"){ ?>
							</select><br />
						</div>
<?php }elseif ($template_hook=="24"){ ?>
						<div style="width: 100%; float: left; text-align: right;">
							<a class="submit-button img-add-forum" href="<?php echo lb_link("index.php?page=admin&act=categories&func=new&id=$parent_id","admin/categories/new/$parent_id"); ?>"><?php echo $lang['button_add_forum']; ?></a>
						</div>
						<br /><br />
<?php }elseif ($template_hook=="25"){ ?>
					</td></tr>
					<tr><td class="forum-index-stats-header forum-index-top" style="text-align: right;">
						<a class="submit-button img-add-forum" href="<?php echo lb_link("index.php?page=admin&act=categories&func=new","admin/categories/new/"); ?>"><?php echo $lang['button_add_root']; ?></a>
					</td></tr>
					<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;"><hr />
						<input type="hidden" name="post_form" value="1" />
<?php if($can_change_forum_settings=='1'){ ?>
						<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
						<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
						<input type="submit" class="submit-button img-reorder" value="<?php echo $lang['button_reorder']; ?>" />
					</td></tr>
				</table>
			</form>
			<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-forum-footer-contents"> </td></tr>
			</table>
<?php }elseif ($template_hook=='warn'){ ?>
			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr>
					<td class="forum-topic-subject"> </td>
					<td style="text-align: right;"></td>
				</tr>
			</table>
			<table class="forum-board" cellpadding="0" cellspacing="0">
				<tr>
					<td class="error-header" style="width:100%;">
						<?php echo $lang_admin['categories_warning']; ?>
					</td>
				</tr>
				<tr>
					<td class="forum-jump-content" style="width:100%;">
						<?php echo $lang_admin['categories_warning_desc']; ?>
					</td>
				</tr>
				<tr>
				<td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<form name="warn" action="<?php echo "$lb_domain"; ?>/index.php?page=admin&act=categories&func=delete&id=<?php echo $_GET['id']; ?>" method="post">
						<input type="hidden" name="token_id" value="<?php echo $token_id; ?>" />
						<input type="hidden" name="<?php echo $token_name; ?>" value="<?php echo $token; ?>" />
						<input type="hidden" name="agree" id="agree" value="1" />
						<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
					</form>
				</td>
				</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='successAdded'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['categories_added']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successUpdated'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['categories_updated']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successUpdatedPerm'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['categories_updated_perm']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successDeleted'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['categories_deleted']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>
