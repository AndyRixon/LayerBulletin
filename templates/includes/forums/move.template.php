<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='2'){ ?>
		<!-- prepare form for moving topic -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang['move_topic']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>	
		<form name="submit" method="post" action="<?php echo lb_link("index.php?func=move", "move"); ?>">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"> </td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">			
					<?php echo $lang['move_select']; ?>
					<br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang['move_to']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<select name="forum">
<?php }elseif ($template_hook=='3'){ ?>
							<!-- show parent forum -->
							<optgroup label="<?php echo "$name"; ?>">
<?php }elseif ($template_hook=='4'){ ?>
								<!-- show forum -->
								<option value="<?php echo "$forum_id"; ?>"><?php echo "$forum_name"; ?></option>
<?php }elseif ($template_hook=='5'){ ?>
								<!-- show sub-forum -->
								<option value="<?php echo "$forum_id"; ?>">&nbsp;&nbsp;&nbsp;&nbsp;--> <?php echo "$forum_name"; ?></option>
<?php }elseif ($template_hook=='6'){ ?>
							</optgroup>
<?php }elseif ($template_hook=='7'){ ?>
						</select>
					</div>
					<br /><br />
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang['move_shadow']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="checkbox" class="checkbox" name="shadow_topic" value="1" checked />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<input type="hidden" name="topic" value="<?php echo "$topic"; ?>" />
<?php if ($can_move_topics=='1'){ ?>
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
<?php }elseif ($template_hook=='end'){ ?>		
<?php } ?>
