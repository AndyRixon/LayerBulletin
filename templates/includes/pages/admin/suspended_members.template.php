<?php if (!defined('LB_RUN')) exit('<h1>ACCESS DENIED</h1>You cannot access this file directly.'); ?>

<?php if ($template_hook == 'start'){ ?>

	<style type="text/css">
	
		table.suspended tr th {
			border-bottom: 1px solid #999999;
		}
		
		table.suspended tr td {
			border-bottom: 1px solid #999999;
			padding: 5px;
		}
		
		table.suspended tr.row-1 td {
			background: #e1e8ef;
		}
		
			/*
			Removes the need of checkboxes and text inputs to
			fill all the space available to them.
		*/
		
			input[type="checkbox"], input[type="text"] {
				width: auto;
			}
	
	</style>

	<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
		<tr>
			<td class="forum-topic-subject"><?php echo $lang_admin['suspended_subject']; ?></td>
		</tr>
	</table>
	
	<form method="post" action="<?php echo lb_link('index.php?page=admin&act=suspended_members', 'admin/suspended_members'); ?>">
	
	<table class="forum-index" cellpadding="0" cellspacing="0">
	
		<tr>
			<td class="forum-index-stats-header forum-index-top">
				<?php echo $lang_admin['suspended_title']; ?>
			</td>
		</tr>
		
		<tr>
			<td class="forum-jump-content forum-index-top forum-index-bottom">
				<?php echo $lang_admin['suspended_desc']; ?><br /><br />
			</td>
		</tr>
		
		<tr>
			<td>
			
				<table class="suspended" width="100%" cellpadding="5px" cellspacing="0">
				
					<tr>
						<th><?php echo $lang_admin['suspended_member']; ?></th>
						<th><?php echo $lang_admin['suspended_type']; ?></th>
						<th><?php echo $lang_admin['suspended_ends']; ?></th>
						<th><?php echo $lang_admin['suspended_unban']; ?></th>
					</tr>

<?php } elseif ($template_hook == 1){ ?>

					<tr class="row-<?php echo $r; ?>">
					
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $type; ?></td>
						<td><?php echo $ends; ?></td>
						<td>
						
							<?php if ($row['banned'] == 1){ ?>
							
								<input type="checkbox" name="unban[<?php echo $row['id']; ?>]" value="1" />
								
							<?php } else { ?>
							
								<input type="hidden" name="alter[<?php echo $row['id']; ?>][orig]" value="<?php echo $ends; ?>" />
								<input type="text" name="alter[<?php echo $row['id']; ?>][new]" value="<?php echo $ends; ?>" />
								
							<?php } ?>
						
						</td>
						
					</tr>

<?php } elseif ($template_hook == 2){ ?>

					<tr>
					
						<td colspan="4" style="text-align: center">
							<h3><?php echo $lang_admin['suspended_no_members']; ?></h3>
						</td>
						
					</tr>

<?php } elseif ($template_hook == 'end'){ ?>

				</table><br />
				
			</td>
		</tr>
		
		<tr>
			<td class="forum-index-stats-header forum-index-top" style="text-align: center;">
		
				<input type="submit" class="submit-button img-submit" value="<?php echo $lang_admin['suspended_update']; ?>" />
			
			</td>
		</tr>
		
	</table>
	
	</form>
	
	<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
		<tr><td class="forum-index-forum-footer-contents"> </td></tr>
	</table>

<?php } ?>