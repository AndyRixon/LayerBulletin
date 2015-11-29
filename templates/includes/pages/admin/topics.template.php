<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=="2"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['topics_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="settings" method="post" action="<?php echo lb_link("index.php?page=admin&act=topics","admin/topics"); ?>">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['topics_topic_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['topics_topic_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['topics_topic_page']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="list_topics" value="<?php echo "$list_topics"; ?>" size="3" onkeyup="checkit(list_topics)" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['topics_posts_page']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="list_posts" value="<?php echo "$list_posts"; ?>" size="3" onkeyup="checkit(list_posts)" />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['topics_hot_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['topics_hot_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['topics_hot_value']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="hot_topic" value="<?php echo "$hot_topic"; ?>" size="3" onkeyup="checkit(hot_topic)" />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['topics_edit_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['topics_edit_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['topics_edit_store']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($store_post_history=="1"){ ?>
						<input type="checkbox" class="checkbox" name="store_post_history" value="<?php echo "$store_post_history"; ?>" checked />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="store_post_history" value="1" />
<?php } ?>
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['topics_quick_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['topics_quick_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['topics_quick_show']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($quick_edit=="1"){ ?>
						<input type="checkbox" class="checkbox" name="quick_edit" value="<?php echo "$quick_edit"; ?>" checked />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="quick_edit" value="1" />
<?php } ?>
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['topics_merge_title']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang_admin['topics_merge_desc']; ?><br /><br />

					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['topics_merge_show']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
<?php if ($auto_merge=="1"){ ?>
						<input type="checkbox" class="checkbox" name="auto_merge" value="<?php echo "$auto_merge"; ?>" checked />
<?php }else{ ?>
						<input type="checkbox" class="checkbox" name="auto_merge" value="1" />
<?php } ?>
					</div>
				</td></tr>
				
				<tr>
					<td class="forum-index-stats-header forum-index-top">
						<?php echo $lang_admin['topics_trashcan_title']; ?>
					</td>
				</tr>
				<tr>
					<td class="forum-jump-content forum-index-top forum-index-bottom">
						<?php echo $lang_admin['topics_trashcan_desc']; ?><br /><br />

						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_admin['topics_trashcan_enabled']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
						
							<?php if ($trashcan_enabled == 1){ ?>
								<input type="checkbox" class="checkbox" name="trashcan_enabled" value="1" checked />
							<?php } else { ?>
								<input type="checkbox" class="checkbox" name="trashcan_enabled" value="1" />
							<?php } ?>
							
							<br /><br />
						</div>
						
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_admin['topics_trashcan_forum']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
						
							<select name="trashcan_forum">
							
								<?php foreach ($forums[0] as $forum){ ?>
								
									<optgroup label="<?php echo $forum['name']; ?>">
									
										<?php foreach ($forums[$forum['id']] as $forum1){ ?>
										
											<option
												value="<?php echo $forum1['id']; ?>"
												<?php if ($trashcan_forum == $forum1['id']){ ?>selected="selected"<?php } ?>
											>
												<?php echo $forum1['name']; ?>
											</option>
											
												<?php foreach($forums[$forum1['id']] as $forum2){ ?>
												
													<option
														value="<?php echo $forum2['id']; ?>"
														<?php if ($trashcan_forum == $forum2['id']){ ?>selected="selected"<?php } ?>
													>
														--> <?php echo $forum2['name']; ?>
													</option>
													
												<?php } ?>
										
										<?php } ?>
									
									</optgroup>
								
								<?php } ?>
							
							</select>
							
							<br /><br />
						
						</div>
						
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_admin['topics_trashcan_move']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
						
							<select name="trashcan_move">
							
								<?php foreach ($forums[0] as $forum){ ?>
								
									<optgroup label="<?php echo $forum['name']; ?>">
									
										<?php foreach ($forums[$forum['id']] as $forum1){ ?>
										
											<option value="<?php echo $forum1['id']; ?>">
												<?php echo $forum1['name']; ?>
											</option>
											
												<?php foreach($forums[$forum1['id']] as $forum2){ ?>
												
													<option value="<?php echo $forum2['id']; ?>">
														--> <?php echo $forum2['name']; ?>
													</option>
													
												<?php } ?>
										
										<?php } ?>
									
									</optgroup>
								
								<?php } ?>
							
							</select>
							
							<br /><br />
						
						</div>
						
						<div style="width: 30%; float: left;">
							<strong><?php echo $lang_admin['topics_trashcan_delete']; ?></strong>
						</div>
						<div style="width: 70%; float: left;">
						
							<select name="trashcan_delete_1">
								<option value="--">--</option>
								
								<?php for ($i = 1; $i <= 30; ++$i) : ?>
								
									<option
										value="<?php echo $i; ?>"
										<?php if ($trashcan[0] == $i){ ?>selected="selected"<?php } ?>
									><?php echo $i; ?></option>
								
								<?php endfor; ?>
							</select>
							
							<select name="trashcan_delete_2">
								<option value="0">----------</option>
								
								<option value="1" <?php if ($trashcan[1] == 1){ ?>selected="selected"<?php } ?>>
									<?php echo $lang_admin['subscriptions_days']; ?>
								</option>
								
								<option value="2" <?php if ($trashcan[1] == 2){ ?>selected="selected"<?php } ?>>
									<?php echo $lang_admin['subscriptions_weeks']; ?>
								</option>
								
								<option value="3" <?php if ($trashcan[1] == 3){ ?>selected="selected"<?php } ?>>
									<?php echo $lang_admin['subscriptions_months']; ?>
								</option>
								
								<option value="4" <?php if ($trashcan[1] == 4){ ?>selected="selected"<?php } ?>>
									<?php echo $lang_admin['subscriptions_years']; ?>
								</option>
							</select>
						
						</div>
					</td>
				</tr>
				
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
<?php }elseif ($template_hook=='successSaved'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['topics_saved']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>