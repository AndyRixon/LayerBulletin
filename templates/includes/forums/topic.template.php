<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
		 <table style="width:100%;" cellspacing="0" cellpadding="0">
			 <tr>
<?php }elseif ($template_hook=='2'){ ?>
				<td style="padding-top: 2px; padding-bottom:2px; padding-left: 5px;">
<?php if ($pages <= '1'){}else{  ?>
					<!-- show page numbers -->
					<?php echo $lang['board_page']; ?>
<?php $pages=(ceil($number_of_posts/$list_posts)); if (!isset($_GET['limit'])){$_GET['limit']="1";} $start="1"; for($i = "1"; $i <= $pages; $i++) { $i_limit=$i; if ($i > 1){ $start=($start+1); } if ($_GET['limit']==$start){ ?>
					<a class="page-active" href="<?php echo lb_link("index.php?topic=$topic&limit=$i_limit", "topic/$topic_title-$topic/$i_limit"); ?>"><?php echo "$i"; ?></a>
<?php } else{ ?>
<?php if ($_GET['limit'] >="3" && $i_limit < $_GET['limit'] - "2" OR $_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] <= "2" && $i_limit > "4" ){}else{  ?>
<?php if ($_GET['limit'] > "2" && $i_limit < $_GET['limit'] - "1"){ ?>
					<a class="page" href="<?php echo lb_link("index.php?topic=$topic&limit=1", "topic/$topic_title-$topic/1"); ?>">&lt;&lt;</a>
<?php } ?>
					<a class="page" href="<?php echo lb_link("index.php?topic=$topic&limit=$i_limit", "topic/$topic_title-$topic/$i_limit"); ?>"><?php echo "$i"; ?></a>
<?php }}} ?>
<?php if ($pages - $_GET['limit'] >= "3"){ ?>
					<a class="page" href="<?php echo lb_link("index.php?topic=$topic&limit=$pages_end", "topic/$topic_title-$topic/$pages_end"); ?>">&gt;&gt;</a>
<?php } ?>
				</td>
<?php } ?>
<?php }elseif ($template_hook=='5'){ ?>
				<!-- new topic/add reply -->
                <td class="new-topic-placer">
<?php if ($read_only=='1'){} elseif($can_add_topics=='1'){ ?>
					<a class="submit-button-large img-add-forum" href="<?php echo lb_link("index.php?func=newpost&forum=$forum_id", "newpost/$forum_id"); ?>"><?php echo $lang['button_new_topic']; ?></a>
<?php } if ($locked=='1'){} elseif($can_reply_topics=='1'){ ?>
					<a class="submit-button-large img-add-reply" href="<?php echo lb_link("index.php?func=addreply&topic=$topic", "addreply/$topic"); ?>"><?php echo $lang['button_add_reply']; ?></a>
<?php } elseif($can_add_topics=='0'){} ?>
				</td>
			</tr>
		</table>
		<!-- topic header bar -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject-main"><?php echo "$title"; ?></td>
<?php if ($locked=='0'){ if ($lb_name!=''){ ?>
				<td class="forum-topic-subscribe">
<?php if ($subscribed_already=='1'){ ?>
					<a class="subscribe-button img-unsubscribe" href="<?php echo lb_link("index.php?page=unsubscribe&topic=$topic", "unsubscribe/topic/$topic"); ?>"><?php echo $lang['button_unsubscribe_topic']; ?></a>
<?php }else{ ?>
					<a class="subscribe-button img-subscribe" href="<?php echo lb_link("index.php?page=subscribe&topic=$topic", "subscribe/topic/$topic"); ?>"><?php echo $lang['button_subscribe_topic']; ?></a>
<?php } ?>
				</td>
<?php }} ?>
			</tr>
		</table>
<?php } elseif($template_hook=='6'){ ?>
		<!--  polls form -->
		<form method="post" action="<?php echo lb_link("index.php?action=vote&topic=$topic", "vote/$topic"); ?>">
			<table class="forum-jump" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-td-middle-sub border-left-right">
					<strong><?php echo $lang['topic_poll']; ?> <?php echo "$question"; ?></strong>
				</td></tr>
				<tr><td class="forum-jump-content">
<?php if($poll_type=='0'){ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option" value="1"><?php echo "$option1"; ?><br />
<?php }else{ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option1" value="1"><?php echo "$option1"; ?><br />
<?php } ?>
<?php if($poll_type=='0'){ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option" value="2"><?php echo "$option2"; ?><br />
<?php }else{ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option2" value="2"><?php echo "$option2"; ?><br />
<?php } ?>
<?php if ($option3!=''){ ?>
<?php if($poll_type=='0'){ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option" value="3"><?php echo "$option3"; ?><br />
<?php }else{ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option3" value="3"><?php echo "$option3"; ?><br />
<?php } ?>
<?php } ?>
<?php if ($option4!=''){ ?>
<?php if($poll_type=='0'){ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option" value="4"><?php echo "$option4"; ?><br />
<?php }else{ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option4" value="4"><?php echo "$option4"; ?><br />
<?php } ?>
<?php } ?>
<?php if ($option5!=''){ ?>
<?php if($poll_type=='0'){ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option" value="5"><?php echo "$option5"; ?><br />
<?php }else{ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option5" value="5"><?php echo "$option5"; ?><br />
<?php } ?>
<?php } ?>
<?php if ($option6!=''){ ?>
<?php if($poll_type=='0'){ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option" value="6"><?php echo "$option6"; ?><br />
<?php }else{ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option6" value="6"><?php echo "$option6"; ?><br />
<?php } ?>
<?php } ?>
<?php if ($option7!=''){ ?>
<?php if($poll_type=='0'){ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option" value="7"><?php echo "$option7"; ?><br />
<?php }else{ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option7" value="7"><?php echo "$option7"; ?><br />
<?php } ?>
<?php } ?>
<?php if ($option8!=''){ ?>
<?php if($poll_type=='0'){ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option" value="8"><?php echo "$option8"; ?><br />
<?php }else{ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option8" value="8"><?php echo "$option8"; ?><br />
<?php } ?>
<?php } ?>
<?php if ($option9!=''){ ?>
<?php if($poll_type=='0'){ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option" value="9"><?php echo "$option9"; ?><br />
<?php }else{ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option9" value="9"><?php echo "$option9"; ?><br />
<?php } ?>
<?php } ?>
<?php if ($option10!=''){ ?>
<?php if($poll_type=='0'){ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option" value="10"><?php echo "$option10"; ?><br />
<?php }else{ ?>
					<input class="checkbox" type="<?php echo "$input"; ?>" name="option10" value="10"><?php echo "$option10"; ?><br />
<?php } ?>
<?php } ?>
					<input type="hidden" value="<?php echo "$poll_id"; ?>" name="poll_id">
					<div class="center">
						<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
						<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
						<input type="submit" class="submit-button img-poll" value="<?php echo $lang['topic_poll_vote']; ?>" />
						<a class="submit-button img-submit" href="<?php echo lb_link("index.php?topic=$topic&limit=1&showresults=1", "topic/$topic_title-$topic/1/showresults"); ?>"><?php echo $lang['topic_poll_results']; ?></a>
					</div>
					<hr />
					<div class="center"><strong><?php echo $lang['topic_poll_total']; ?> <?php echo "$total_votes_results"; ?></strong></div>
				</td></tr>
			</table>
		</form>
<?php }elseif ($template_hook=='7'){ ?>
		<!-- prepare to show results -->
		<table class="forum-jump" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-td-middle-sub border-left-right">
				<strong><?php echo $lang['topic_poll']; ?> <?php echo "$question"; ?></strong>
			</td></tr>
			<tr><td class="forum-jump-content">
				<table style="width:100%; text-align: left;" cellpadding="0" cellspacing="0">
                	<!-- show results -->
<?php }elseif ($template_hook=='8'){ ?>
					<tr>
						<td><?php echo "$show_option"; ?></td>
						<td>[<strong><?php echo "$option_votes"; ?></strong>]</td>
						<td>
							<div class="poll-color" style="width: <?php echo "$width$px"; ?>;">&nbsp;</div>
							&nbsp;&nbsp;&nbsp;[<?php echo "$percentage"; ?>%]
						</td>
					</tr>
<?php }elseif ($template_hook=='9'){ ?>
				</table>
<?php }elseif ($template_hook=='10'){ ?>
							<!-- link to vote -->
							<div class="center"><br /><br />
								<a class="submit-button img-poll" href="<?php echo lb_link("index.php?topic=$topic", "topic/$topic_title-$topic"); ?>"><?php echo $lang['button_poll']; ?></a>
							</div>
<?php }elseif ($template_hook=='11'){ ?>
							<!-- show total votes -->
							<hr />
							<div class="center">
								<strong><?php echo $lang['topic_poll_total']; ?> <?php echo "$total_votes_results"; ?></strong>
							</div>
						</td>
					</tr>
                </table>
<?php }elseif ($template_hook=='12'){ ?>
				<!-- prepare to show posts -->
				<table class="forum-board" cellspacing="0" cellpadding="0">
<?php }elseif ($template_hook=='14'){ ?>

					<tr class="topic-trackback-text" style="display: none" id="trackback_url_<?php echo $post_id; ?>">
						<td colspan='2' class="forum-board-trackback">
							<?php echo $topic_trackback_text; ?>
						</td>
					</tr>
					
					<!-- member profile -->
					<tr id="p<?php echo "$post_id"; ?>" >
<?php if ($member_online=='1'){ ?>
						<td class="forum-board-member-extra member-online">
<?php }else{ ?>
						<td class="forum-board-member-extra member-offline">
<?php } ?>
<?php if ($name==''){ ?>
							 <?php echo $lang['board_topic_unregistered']; ?>
<?php }else{ ?>
							<?php echo member_link($id); ?>
<?php } ?>
							
							<!-- Module Hook -->
							<?php echo $username_hook; ?>
							
							<br />
						</td>
<?php if ($member_online=='1'){ ?>
						<td class="forum-board-post-extra member-online">
<?php }else{ ?>
						<td class="forum-board-post-extra member-offline">
<?php } ?>
							<!-- show topic time -->
							<span class="forum-topic-time">
								
								<?php echo $time; ?> |
								
								<!-- trackback link -->
								
								<a href="#trackback_url_<?php echo $post_id; ?>" onclick="showhide('trackback_url_<?php echo $post_id; ?>', '');">
									<?php echo $lang['topic_trackback']; ?>
								</a>
							
							</span>
							<!-- admin options -->
							<span class="forum-topic-admin">
<?php if ($is_trashcan == false){ if ($title==''){ if ($can_split_topics=='1'){ ?>
								<a class="submit-button img-split" href="<?php echo lb_link("index.php?func=split&post=$post_id", "split/$post_id"); ?>"><?php echo $lang['button_split']; ?></a>
<?php }} ?>
<?php if ($title!=''){ if ($can_move_topics=='1'){ ?>
								<a class="submit-button img-move" href="<?php echo lb_link("index.php?func=move&topic=$topic", "move/$topic"); ?>"><?php echo $lang['button_move']; ?></a>
<?php } if ($can_merge_topics=='1'){ ?>
								<a class="submit-button img-merge" href="<?php echo lb_link("index.php?func=merge&topic=$topic", "merge/$topic"); ?>"><?php echo $lang['button_merge']; ?></a>
<?php }} if ($title!='' && $locked=='0'){ if ($can_lock_topics=='1'){ ?>
								<a class="submit-button img-lock" href="<?php echo lb_link("index.php?func=lock&topic=$topic", "lock/$topic"); ?>"><?php echo $lang['button_lock']; ?></a>
<?php }} elseif ($title!='' && $locked=='1'){ if ($can_lock_topics=='1'){ ?>
								<a class="submit-button img-unlock" href="<?php echo lb_link("index.php?func=unlock&topic=$topic", "unlock/$topic"); ?>"><?php echo $lang['button_unlock']; ?></a>
<?php }}} else { ?>

	<?php if ($show_revert == true){ ?>
	
		<form method="post" action="<?php echo lb_link('index.php?func=revert&post=' . $post_id, 'revert/' . $post_id); ?>">
		
			<input type="hidden" name="post_revert_id" value="<?php echo $post_id; ?>" />
			<input type="hidden" name="token_id" value="<?php echo $revert_token_id; ?>" />
			<input type="hidden" name="<?php echo $revert_token_name; ?>" value="<?php echo $revert_token; ?>" />
			<input
				type="submit"
				name="post_revert"
				class="submit-button img-move"
				alt="<?php echo $lang_admin['custom_delete']; ?>"
				value="<?php echo $lang['button_revert']; ?>"
				onclick="javascript:return confirm('<?php echo $lang['topic_revert']; ?>')"
			/>
		
		</form>
	
	<?php } ?>

<?php } ?>
							</span>
						</td>
					</tr>
					
					<tr>
						<td class="forum-board-member">
<?php if ($usertitle!=''){ ?>
							<?php echo "$usertitle"; ?>
							<br />
<?php } ?>
<?php }elseif ($template_hook=='36'){ ?>
							<img  src="<?php echo "$pip_img"; ?>" alt="" />
<?php }elseif ($template_hook=='37'){ ?>
							<br />
							<img style="max-width: <?php echo "$attach_avatar_size"; ?>px; _width: <?php echo "$attach_avatar_size"; ?>px" src="<?php echo "$avatar"; ?>" alt="" />
							<br />
							<!-- warn bar -->
<?php if ($member_role!='1'){ if ($can_warn_members=='1'){ ?>
							<a class="warn-minus" href="<?php echo lb_link("index.php?page=warn&act=minus&id=$id", "warn/minus/$id"); ?>" title="<?php echo $lang['topic_warn_remove']; ?>">&nbsp;</a><a class="warn-mods warn-level<?php echo "$graphic_level"; ?>" href="javascript:WarnPopUp('<?php echo "$lb_domain"; ?>/includes/forums/warn_popup.php?id=<?php echo "$id"; ?>')" title="<?php echo $lang['topic_warn_level']; ?> <?php echo "$graphic_warn"; ?>%">&nbsp;</a><a class="warn-plus" href="<?php echo lb_link("index.php?page=warn&act=add&id=$id", "warn/add/$id"); ?>" title="<?php echo $lang['topic_warn_add']; ?>">&nbsp;</a>
							<br />
<?php }else{ ?>
							<!-- warn bar for non-mods -->
							<a class="warn-members warn-level<?php echo "$graphic_level"; ?>" href="javascript:WarnPopUp('<?php echo "$lb_domain"; ?>/includes/forums/warn_popup.php?id=<?php echo "$id"; ?>')" title="<?php echo $lang['topic_warn_level']; ?> <?php echo "$graphic_warn"; ?>%">&nbsp;</a>
							<br />
<?php }} ?>

<?php }elseif ($template_hook=='17'){ ?>
<?php if ($user_group_icon!='0'){ ?>
							<!-- show group icon -->
							<div class="group"><img src="<?php echo "$group_img"; ?>" alt="" />&nbsp;&nbsp;<span style="color: <?php echo "$user_group_color"; ?>;"><?php echo "$user_group_name"; ?></span></div><br />
<?php } ?>
							<!-- show forum stats -->
							<?php echo $lang['topic_member_posts']; ?> <?php echo "$num_posts"; ?>
							<br />
							<?php echo $lang['topic_member_joined']; ?> <?php echo "$register_date"; ?> 
<?php if ($location != ''){ ?>
							<br />
							<?php echo $lang['topic_member_location']; ?> <?php echo "$location"; ?>
<?php } ?>
							
							<!-- Module Hook -->
							<?php if ($user_info_hook != ''){ ?>
							
								<br />
								<?php echo $user_info_hook; ?>
							
							<?php } ?>
							
							<br />
<?php }elseif ($template_hook=='32'){ ?>
<?php if ($custom_profile_content!=''){ ?>
							<?php echo "$custom_field_name"; ?>: <?php echo "$custom_profile_content"; ?><br />
<?php } ?>
<?php }elseif ($template_hook=='31'){ ?>
							<br />
						</td>
<?php if ($approved=='0' && $can_moderate_members=='1'){ ?>
						<td class="forum-board-moderated">
<?php }elseif ($reported=='1' && $can_see_reported_posts=='1'){ ?>
						<td class="forum-board-reported">
<?php }else{ ?>
						<td class="forum-board-post">
<?php } ?>
							<!-- post content -->
							<?php echo "$content"; ?>			
							<br /><br />						
<?php }elseif ($template_hook=='18'){ ?>
							<!-- image attachment -->
							<div class="attachment">
<?php if ($filesize!='0'){ ?>
								<?php echo $lang['topic_img']; ?> (<?php echo "$filesize"; ?>)<br />
<?php } else{ ?>
								<?php echo $lang['topic_img']; ?><br />
<?php } ?>
								<a href="<?php echo lb_link("download.php?attach=$row&filename=$original_filename", "download/$row/$original_filename"); ?>"><img  src="<?php echo "$lb_domain"; ?>/uploads/attachments/<?php echo "$filename"; ?>" alt="<?php echo $lang['topic_img']; ?>" /></a>
								<br /><strong><?php echo "$downloads"; ?></strong> <?php echo $lang['topic_downloads']; ?>
							</div>
<?php }elseif ($template_hook=='19'){ ?>
							<!-- file attachment -->
							<div style="width: 100%; clear: both;">
								<img  src="<?php echo "$zip_icon_img"; ?>" alt="file" /> <a class="post" href="<?php echo lb_link("download.php?attach=$row&filename=$original_filename", "download/$row/$original_filename"); ?>"><?php echo "$original_filename"; ?></a><br />
								<span class="keyword-tags"> 
<?php if ($filesize!='0'){ ?>
									<?php echo "$filesize"; ?>
<?php } ?>
									 - <?php echo "$downloads"; ?> <?php echo $lang['topic_downloads']; ?>
								</span>
							</div>
<?php }elseif ($template_hook=='20'){ ?>
							<!-- file attachment hidden -->
							<fieldset class="post-attachment-warning">
								<?php echo $lang['topic_attachments_permission']; ?>
							</fieldset>
<?php }elseif ($template_hook=='21'){ ?>
							<!-- post edit -->
							<div style="clear:both;"> </div>
<?php if ($edit_member=='0'){ } else{ ?>
							<div class="edited-by">
								
								<span class="small-text"><?php echo $lang['topic_edited_by']; ?> 	<?php echo member_link($edit_member, '0'); ?>	
					 			- <?php echo "$edit_time"; ?>.</span>
							</div>
<?php }} elseif ($template_hook=='22'){ ?>
							<!-- post edit reason -->
							<div class="edited-by">
								<?php echo $lang['topic_edited_reason']; ?> <i><?php echo "$edit_reason"; ?></i>
							</div>
<?php }elseif ($template_hook=='23'){ ?>
							<!-- signature -->
							<hr />
							<span class="signature">
								<?php echo "$content"; ?>
							</span>
<?php }elseif ($template_hook=='24'){ ?>
							<!-- close post area tags -->
						</td>
					</tr>
					<!-- top/pm links -->
					<tr>
						<td class="forum-board-member forum-board-member-bottom">
							<a class="submit-button img-top" href="#top"><?php echo $lang['button_top']; ?></a>
<?php if ($can_pm=='1'){ if ($can_pm_this_member=='1'){ ?>
							<a class="submit-button img-email-go" href="<?php echo lb_link("index.php?page=messages&act=new&id=$id", "messages/new/$id"); ?>"><?php echo $lang['button_send_pm']; ?></a>
<?php }} ?>
						</td>
						<td class="forum-board-post forum-board-post-bottom">&nbsp;
							<!-- admin links -->
<?php if ($locked!='1'){ if ($can_reply_topics=='1'){ ?>
							<a class="submit-button img-add-reply" href="<?php echo lb_link("index.php?func=addreply&topic=$topic&quote=$post_id", "addreply/$topic/$post_id"); ?>"><?php echo $lang['button_reply']; ?></a>
							<a class="submit-button img-quote-on" id="mad_<?php echo "$post_id"; ?>" name="mad_<?php echo "$post_id"; ?>" href="#" onclick="lbquote(<?php echo "$post_id"; ?>); return false;"><?php echo $lang['button_quote']; ?></a>
<?php }} if ($can_edit_others_posts=='1'){ ?>
<?php if ($quick_edit=='1' && $locked!='1'){ ?>
							<a class="submit-button img-fast-reply" href="javascript: showhide('edit_<?php echo "$post_id"; ?>');"><?php echo $lang['button_quick_edit']; ?></a>
<?php } ?>
							<a class="submit-button img-edit" href="<?php echo lb_link("index.php?func=edit&post=$post_id", "edit/$post_id"); ?>"><?php echo $lang['button_edit']; ?></a>
<?php } elseif($member==$my_id){ if ($locked!='1'){ if ($can_edit_own_posts=='1'){ ?>
<?php if ($quick_edit=='1' && $locked!='1'){ ?>
							<a class="submit-button img-fast-reply" href="javascript: showhide('edit_<?php echo "$post_id"; ?>');"><?php echo $lang['button_quick_edit']; ?></a>
<?php } ?>
							<a class="submit-button img-edit" href="<?php echo lb_link("index.php?func=edit&post=$post_id", "edit/$post_id"); ?>"><?php echo $lang['button_edit']; ?></a>
							
<?php }}} if (($can_delete_others_posts == 1 || ($member == $my_id && $can_delete_own_posts == 1)) && $locked != 1){ ?>

							<form method="post" action="<?php echo lb_link('index.php?func=del&post=' . $post_id, 'del/' . $post_id); ?>">
							
								<input type="hidden" name="post_delete_id" value="<?php echo $post_id; ?>" />
								<input type="hidden" name="token_id" value="<?php echo $delete_token_id; ?>" />
								<input type="hidden" name="<?php echo $delete_token_name; ?>" value="<?php echo $delete_token; ?>" />
								<input
									type="submit"
									name="post_delete"
									class="submit-button img-delete-member"
									alt="<?php echo $lang_admin['custom_delete']; ?>"
									value="<?php echo $lang['button_delete']; ?>"
									onclick="javascript:return confirm('<?php echo $lang['topic_remove']; ?>')"
								/>
							
							</form>

<?php } if ($lb_name!=''){ if ($can_warn_members=='0'){ ?>
							<a class="submit-button img-error" href="<?php echo lb_link("index.php?page=report&post=$post_id", "report/$post_id"); ?>"><?php echo $lang['button_report']; ?></a>
<?php }} ?>
<?php if ($can_moderate_members=='1' && $approved=='0'){ ?>
							<a class="submit-button button-update img-error" href="<?php echo lb_link("index.php?page=admin&act=preview&action=approve&id=$moderate_post&post=$post_id", "admin/preview/approve/$moderate_post/$post_id"); ?>"><?php echo $lang['button_approve']; ?></a>
<?php } ?>
							
							<!-- Hook location -->
							<?php echo $post_buttons_hook; ?>
						
						</td>
					</tr>
					<tr><td class="forum-board-post-bottom-extra" colspan="2">&nbsp;</td></tr>
<?php if ($locked!='1' && $can_edit_own_posts=='1' && $member==$my_id OR $locked!='1' && $can_edit_others_posts=='1'){ ?>
<?php if ($quick_edit=='1'){ ?>
					<tr>
						<!--<td class="forum-board-edit-left forum-index-bottom"></td>-->
						<td class="forum-board-edit-right forum-index-bottom" colspan="2" style="width: 1px">
							<div class="<?php echo "$slide-state"; ?>" id="edit_<?php echo "$post_id"; ?>" style="display: none; padding: 10px">
								<div class="smilies" style="position: relative;">
									<div class="smilies-header"></div>
									<div class="smilies-content">
									
										<?php
											$formID = $areaID = 'editcontent_' . $post_id;										
											include 'includes/forums/smilies_insert.php';
										?>
										
										<br />(<a href="javascript:SmiliesPopUp('<?php echo "$lb_domain"; ?>/includes/forums/smilies_popup.php')"><?php echo $lang['addreply_emoticons']; ?></a>)
									</div>
								</div>
								<div class="textarea-addreply">
									<form name="editcontent_<?php echo $post_id; ?>" method="post" action="<?php echo lb_link("index.php?func=edit","edit"); ?>">
										<!-- textarea -->
										<textarea name="editcontent_<?php echo $post_id; ?>" id="editcontent_<?php echo "$post_id"; ?>" class="post"><?php echo "$edit_form_content"; ?></textarea>
										<script>
											bbcode_toolbar = new Control.TextArea.ToolBar.BBCode('editcontent_<?php echo "$post_id"; ?>');
											bbcode_toolbar.toolbar.container.id = 'bbcode_toolbar';
										</script>
										<input type="hidden" name="forum" value="<?php echo "$forum_id"; ?>" />
										<input type="hidden" name="subject" value="<?php echo "$edit_form_title"; ?>" />
										<input type="hidden" name="description" value="<?php echo "$edit_form_desc"; ?>" />
										<input type="hidden" name="topic" value="<?php echo "$topic"; ?>" />
										<input type="hidden" name="post" value="<?php echo "$post_id"; ?>" />
										<input type="hidden" name="sticky" value="<?php echo "$edit_form_sticky"; ?>" />
										<input type="hidden" name="announce" value="<?php echo "$edit_form_announce"; ?>" />
										<br /><br />
<?php if ($can_edit_own_posts=='1' OR $can_edit_others_posts=='1'){ ?>
										<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
										<input type="hidden" name="<?php echo "$token_name_edit"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
<?php if ($moderated=='0'){ ?>
										<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
<?php }else{ ?>
										<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" onclick="javascript:return confirm('<?php echo $lang['topic_approve_warn']; ?>')" />
<?php } ?>
									</form>
								</div>	
							</div>
						</td>
					</tr>
	
<?php }} ?>
<?php }elseif ($template_hook=='25'){ ?>
					<!-- close the post area -->
					<tr>
						<td class="forum-board-quick-edit-left forum-index-top" style="padding: 5px;">
							<a class="forum-header" href="<?php echo lb_link("index.php?topic=$previous_topic_id", "topic/$previous_title-$previous_topic_id"); ?>""><?php echo $lang['topic_previous']; ?></a>
							&nbsp;&nbsp;<a class="forum-header" href="<?php echo lb_link("index.php?topic=$next_topic_id", "topic/$next_title-$next_topic_id"); ?>""><?php echo $lang['topic_next']; ?></a>
						</td>
						<td class="forum-board-quick-edit-right forum-index-top" style="padding: 5px; text-align: right;">
							<form method="get" name="searchform" action="<?php echo "$lb_domain"; ?>/index.php?">
								<input type="text" class="search-box" name="search" value="<?php echo $lang['topic_search']; ?>" onfocus="ClearForm();" />
								<input type="hidden" name="page" value="search" />
								<input type="hidden" value="1" name="pf" />
								<input type="hidden" value="<?php echo "$topic"; ?>" name="topic" id="topic" />
								<input type="submit" class="submit-button img-preview"  value="<?php echo $lang['button_search']; ?>" />
							</form>	
						</td>
					</tr>
				</table>
				<!-- prepare to show online members -->
				<div class="spacer">&nbsp;</div>
				<table class="forum-jump" cellpadding="0" cellspacing="0" style="text-align: left;">
               		<tr>
                		<td class="forum-jump-content-online">
							<?php echo $lang['topic_viewing']; ?>
						</td>
					</tr>
					<tr>
                    	<td class="forum-jump-content">
<?php }elseif ($template_hook=='26'){ ?>
<?php if ($id < '0'){ ?>
							<span class="bot-group-color"><i><?php echo "$name"; ?></i></span>
<?php }else{ ?>
							<?php echo member_link($id, '1', '1', '1'); ?>	
<?php } ?>
<?php }elseif ($template_hook=='27'){ ?>
<?php if ($id < '0'){ ?>
							<span class="bot-group-color"><i><?php echo "$name"; ?></i></span>, 
<?php }else{ ?>
							<?php echo member_link($id, '1', '1', '1'); ?>,	
<?php } ?>
<?php }elseif ($template_hook=='28'){ ?>
						</td>
					</tr>
				</table>
				<table style="width: 100%;" cellpadding="0" cellspacing="0">
					<tr>
<?php }elseif ($template_hook=='29'){ ?>
<?php }elseif ($template_hook=='30'){ ?>
						<!-- new topic/add reply -->
						<td class="new-topic-placer">
<?php if ($read_only=='1'){} elseif($can_add_topics=='1'){ ?>
							<a class="submit-button-large img-add-forum" href="<?php echo lb_link("index.php?func=newpost&forum=$forum_id", "newpost/$forum_id"); ?>"><?php echo $lang['button_new_topic']; ?></a>
<?php } if ($locked=='1'){} elseif($can_reply_topics=='1'){ ?>
							<a class="submit-button-large img-add-reply" href="<?php echo lb_link("index.php?func=addreply&topic=$topic", "addreply/$topic"); ?>"><?php echo $lang['button_add_reply']; ?></a>	
							<!-- quick reply -->
							<a class="submit-button-large img-fast-reply" href="javascript: showhide('commentForm');"><?php echo $lang['button_fast_reply']; ?></a>		
<?php } ?>
						</td>
					</tr>
               </table>
<?php if ($locked=='1'){} elseif($can_reply_topics=='1'){ ?>
<?php if ($show_fast_reply == 1) { ?>		
				<div id="commentForm" style="text-align: left; position: relative; display: block;">
<?php } else { ?>
				<div id="commentForm" style="text-align: left; position: relative; display: none;">
<?php } ?>
					<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
						<tr>
							<td class="forum-topic-subject"><?php echo $lang['topic_reply']; ?></td>
						</tr>
					</table>
					<table class="forum-jump" cellpadding="0" cellspacing="0" style="border-bottom: none;">
						<tr>
							<td class="forum-jump-content" style="width:100%;">
								<div class="smilies" style="position: relative;">
									<div class="smilies-header"></div>
									<div class="smilies-content">
										<?php include "includes/forums/smilies_insert.php"; ?>
										<br />(<a href="javascript:SmiliesPopUp('<?php echo "$lb_domain"; ?>/includes/forums/smilies_popup.php')"><?php echo $lang['addreply_emoticons']; ?></a>)
									</div>
								</div>
								<div class="textarea-addreply">
									<form method="post" name="postcontent" action="<?php echo lb_link("index.php?func=addreply", "addreply"); ?>">
										<textarea name="content" id="content" class="post" ></textarea>
										<script type="text/javascript">
											bbcode_toolbar = new Control.TextArea.ToolBar.BBCode('content');
											bbcode_toolbar.toolbar.container.id = 'bbcode_toolbar';
										</script>
										<input type="hidden" name="topic" value="<?php echo "$topic"; ?>" />
										<br /><br />
<?php if ($can_reply_topics=='1'){ ?>
										<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
										<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
<?php if ($moderated=='0'){ ?>
										<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
<?php }else{ ?>
										<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" onclick="javascript:return confirm('<?php echo $lang['topic_approve_warn']; ?>')" />

<?php } ?>
									</form>
									<form name="preview" action="<?php echo "$lb_domain"; ?>/includes/forums/preview.php" method="post" target="preview">
										<input type="hidden" name="content" />
										<input type="submit" class="submit-button img-preview" name="preview" value="<?php echo $lang['button_preview']; ?>" onclick="copydata()" />
									</form>
								</div>
							</td>
						</tr>
					</table>
					<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
						<tr><td class="forum-index-forum-footer-contents"> </td></tr>
					</table>
					<script language="javascript">
						function copydata() {
    						document.preview.content.value = document.postcontent.content.value;
							window.open('<?php echo "$lb_domain"; ?>/includes/forums/preview.php', 'preview', 'height=400,width=700,scrollbars=yes');
						}
					</script>		
				</div>

<?php } ?>
<?php }elseif($template_hook=='33'){ ?>
				<br />
				<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
					<tr>
						<td class="forum-topic-subject" style="width:100%;"><?php echo $lang['topic_edit_history']; ?></td>
					</tr>
				</table>
				<table class="forum-board" cellpadding="0" cellspacing="0">
					<tr>
						<td class="forum-board-subject-sub" style="border-left: 1px solid white;">
							<span class="small-text"><?php echo $lang['topic_edit_history_by']; ?></span>
						</td>
						<td class="forum-board-subject-sub">
							<span class="small-text"><?php echo $lang['topic_edit_history_reason']; ?></span>
						</td>
						<td class="forum-board-subject-sub">
							<span class="small-text"><?php echo $lang['topic_edit_history_date']; ?></span>
						</td>
						<td class="forum-board-subject-sub" style="border-right: 1px solid white;">
							<span class="small-text"><?php echo $lang['topic_edit_history_previous']; ?></span>
						</td>
					</tr>
<?php }elseif($template_hook=='34'){ ?>
					<tr>
						<td class="forum-board-subject" style="border-left: 1px solid white;">
							<?php echo member_link($edited_member, '0'); ?>	
						</td>
						<td class="forum-board-subject">
							<a href="<?php echo lb_link("index.php?page=history&post=$post_id&entry=$edited_row", "history/$post_id/$edited_row"); ?>"  onclick="javascript:return confirm('<?php echo $lang['topic_remove']; ?>')"><img  src="<?php echo "$delete_icon_img"; ?>" alt="" /></a>&nbsp;
							<span class="small-text"><?php echo "$edited_reason"; ?></span>
						</td>
						<td class="forum-board-subject">
							<span class="small-text"><?php echo "$edited_date"; ?></span>
						</td>
						<td class="forum-board-subject" style="text-align: center; border-right: 1px solid white;">
							<a href="javascript: showhide('edit_content<?php echo "$edited_row"; ?>');"><img src="<?php echo "$new_post_img"; ?>" alt="" /></a>
						</td>
					</tr>
					<tr>
						<td class="forum-jump-content" style="width: 100%; padding: 0px; border-bottom: none;" colspan="4">
							<div id="edit_content<?php echo "$edited_row"; ?>" style="display: none;">
								<div style="padding: 5px;">
									<?php echo "$content"; ?>
								</div>
							</div>
						</td>
					</tr>

<?php }elseif($template_hook=='35'){ ?>
				</table>
				<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
					<tr><td class="forum-index-forum-footer-contents"> </td></tr>
				</table>
<?php }elseif ($template_hook=='end'){ ?>		
<?php } ?>
