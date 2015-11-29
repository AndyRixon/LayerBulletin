<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif($template_hook=='2'){ ?>
		<!-- prepare form for selecting topic -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang['merge_topic']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>	
		<form name="submit" method="post" action="<?php echo lb_link("index.php?func=merge","merge"); ?>">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang['merge_select']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">				
					<?php echo $lang['merge_select_desc']; ?><br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang['merge_select_forum']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<select name="forum" onchange="location.href='<?php echo lb_link("index.php?func=merge&topic=$topic&forum=","merge/$topic/"); ?>'+escape(this.options[this.selectedIndex].value)">
							<option value=""><?php echo $lang['merge_select_forum']; ?></option>
<?php }elseif($template_hook=='3'){ ?>
							<!-- show parent forum -->
							<optgroup label="<?php echo "$name"; ?>">
<?php }elseif($template_hook=='4'){ ?>
								<!-- show forum -->
<?php if ($forum_id==$_GET['forum']){ ?>
								<option value="<?php echo "$forum_id" ?>" selected><?php echo "$forum_name"; ?></option>
<?php }else{ ?>
								<option value="<?php echo "$forum_id"; ?>"><?php echo "$forum_name"; ?></option>
<?php } ?>
<?php }elseif($template_hook=='5'){ ?>
                                <!-- show sub-forum -->
                                <option value="<?php echo "$forum_id"; ?>">&nbsp;&nbsp;&nbsp;&nbsp;--> <?php echo "$forum_name"; ?></option>
<?php }elseif($template_hook=='6'){ ?>
							</optgroup>
<?php }elseif($template_hook=='7'){ ?>
						</select>
					</div>
				</td></tr>
                <tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;"></td></tr>
			</table>
		</form>
<?php }elseif($template_hook=='8'){ ?>
						</select>
					</div>
				</td></tr>
		</form>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
				<div style="width: 30%; float: left;">
					<strong><?php echo $lang['merge_select_topic']; ?></strong>
				</div>
				<div style="width: 70%; float: left;">
					<select name="new_topic">
<?php }elseif($template_hook=='9'){ ?>
						<!-- option for topic -->
						<option value="<?php echo "$topic_id"; ?>"><?php echo "$title"; ?></option>
<?php }elseif($template_hook=='10'){ ?>
						<!-- end form -->
					</select>
				</div>
			</td></tr>
			<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
				<input type="hidden" name="old_topic" value="<?php echo "$topic"; ?>" />
<?php if ($can_merge_topics=='1'){ ?>
				<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
				<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
				<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
			</td></tr>
		</form>
		</td></tr></table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='end'){ ?>		
<?php } ?>