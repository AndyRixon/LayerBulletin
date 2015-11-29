<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>

<?php if ($template_hook == 'start') { ?>

	<?php } elseif ($template_hook == 1) { ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0"> 
			<tr> 
				<td class="forum-topic-subject"> 
					<?php echo $lang_user['friendlist_title']; ?>				</td> 
			</tr> 
		</table> 
		<table class="forum-index" cellpadding="0" cellspacing="0"> 
			<tr> 
				<td class="forum-index-td-middle-sub" style="width: 60%; padding-left: 5px; text-align: left;"> 
					<?php echo $lang_user['friendlist_empty']; ?>			</td> 
			</tr>

			</table> 

		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0"> 
			<tr> 
				<td class="forum-index-forum-footer-contents"> 
				</td> 
			</tr> 
		</table> 

	<?php } elseif ($template_hook == 2) { ?>

		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0"> 
			<tr> 
				<td class="forum-topic-subject"> 
					<?php echo $lang_user['friendlist_title']; ?>				</td> 
			</tr> 
		</table> 
		<table class="forum-index" cellpadding="0" cellspacing="0"> 
			<tr> 
				<td class="forum-index-td-middle-sub" style="width: 60%; padding-left: 5px; text-align: left;"> 
					<?php echo $lang_user['friendlist_name']; ?>			</td> 
				<td class="forum-index-td-topics-sub" style="width: 5%; padding-left: 5px; text-align: left;"> 
					Status			</td> 
				<td class="forum-index-td-topics-sub" style="width: 10%; padding-left: 5px;"> 
					&nbsp;				</td> 
					<td class="forum-index-td-topics-sub" style="width: 10%; padding-left: 5px;"> 
					&nbsp;				</td> 
			</tr>
				<form method="post" name="delete_friend_form" action="<?php echo lb_link("index.php?page=myoptions&act=friendlist","myoptions/friendlist"); ?>">
				<input type="hidden" id="delete_friend_id" name="friend_id" value="0" />
				<input type="hidden" name="delete_friend" value="1" />
				</form>
	<?php } elseif ($template_hook == 3) { ?>			
			<tr> 
				<td class="forum-index-td-left" style="width: 20%; text-align: left; padding: 8px;"> 
					<?php echo member_link($friend_info['id']); ?>				
				</td>
				<td class="forum-index-td-left" style="width: 25%; text-align: left; padding-left: 5px;">
					<?php echo $online_status; ?>
				</td>
				<td class="forum-index-td-right" style="width: 10%; text-align: left; padding-left: 5px;"> 
					<div class="center">
						<a class="submit-button img-email-go" href="<?php echo lb_link("index.php?page=messages&act=new&id={$friend_info['id']}", "messages/new/{$friend_info['id']}"); ?>"><?php echo $lang['button_send_pm']; ?></a>
					</div>
				</td>
				<td class="forum-index-td-posts" style="width: 20%; text-align: left; padding-left: 5px;"> 

						<a href="#" onclick="if (confirm('<?php echo $lang_user['friend_delete_confirm']; ?>')) { document.getElementById('delete_friend_id').value=<?php echo $friend_info['id'] ?>; document.forms['delete_friend_form'].submit(); }"><img  src="<?php echo "$delete_icon_img"; ?>" alt="<?php echo $lang_user['friendlist_delete']; ?>" title="<?php echo $lang_user['friendlist_delete']; ?>"  /></a>				</td> 
			</tr>
	<?php } elseif ($template_hook == 4) { ?>			
		</table> 

		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0"> 
			<tr> 
				<td class="forum-index-forum-footer-contents"> 
				</td> 
			</tr> 
		</table> 

<?php }elseif ($template_hook=='successAlreadyFriend'){ ?>
		<div style="border:1px solid red;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:red;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $minus_img; ?>" alt="" />
				<?php echo $lang_user['friend_is_already_friend']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successYourself'){ ?>
		<div style="border:1px solid red;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:red;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $minus_img; ?>" alt="" />
				<?php echo $lang_user['friend_cant_add_yourself']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successAdded'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_user['friend_added']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successNotFriend'){ ?>
		<div style="border:1px solid red;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:red;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $minus_img; ?>" alt="" />
				<?php echo $lang_user['friend_is_not_your_friend']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successRemoved'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_user['friend_removed']; ?>
			</div>
		</div>
<?php }elseif ($template_hook == 'end') { ?>

<?php } ?>