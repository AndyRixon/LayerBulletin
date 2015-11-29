<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
		<!-- forum stats -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject"><?php echo $lang['online_stats_header']; ?></td>
				<td class="forum-topic-subscribe">
					<a class="forum-header" href="javascript:setstate('forum_stats');">&#177;</a>
				</td>
			</tr>
			
			
			<tr><td class="forum-index-stats-sub" colspan="2">
				<!-- show the current time -->
				<?php echo $lang['index_time']; ?> <?php echo "$time"; ?>
			</td></tr>
		</table>
<?php if ($_COOKIE['forum_stats']=='0'){ ?>
		<table class="forum-index forum-index-top" id="forum_stats" style="display: none;" cellpadding="0" cellspacing="0">
<?php }else{ ?>
		<table class="forum-index forum-index-top" id="forum_stats" cellpadding="0" cellspacing="0">
<?php } ?>
			<tr>
                <td colspan="2" class="forum-index-stats-header">
                    <?php echo $lang['online_stats_statistics']; ?>
                </td>
            </tr>
			<tr>
				<td class="forum-index-td-stats">
					<img  src="<?php echo "$forum_stats_img"; ?>" alt="<?php echo $lang['online_stats_header']; ?>" />
				</td>
				<td class="forum-index-td-online">
					<?php echo $lang['online_stats_posts']; ?> <?php echo $lang['online_stats_member']; ?>
					<?php echo member_link($member_id, 0, 1); ?><br />
<?php if ($can_view_forum=='0'){ ?>
					<?php echo $lang['online_stats_latest']; ?> <?php echo $lang['online_stats_restricted']; ?> (<?php echo "$topic_time"; ?>)
<?php }elseif ($can_read_topics=='0'){ ?>
					<?php echo $lang['online_stats_latest']; ?> <?php echo $lang['online_stats_restricted']; ?> (<?php echo "$topic_time"; ?>)
<?php }else{ ?>
					<?php echo $lang['online_stats_latest']; ?> <a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=findpost&post=$id","findpost/$id"); ?>"><?php echo "$title"; ?></a> (<?php echo "$topic_time"; ?>)
<?php } ?>
				</td>
			</tr>
			<tr>
            	<td colspan="2" class="forum-index-stats-header">
					<?php echo $lang['online_stats_online']; ?>
				</td>
			</tr>
			<tr>
				<td class="forum-index-td-stats">
					<img  src="<?php echo "$whos_online_img"; ?>" alt="<?php echo $lang['online_stats_who']; ?>" />
				</td>
				<td class="forum-index-td-online" style="padding-top: 5px;">
<?php } elseif($template_hook=='2'){ ?>
<?php } elseif($template_hook=='3'){ ?>
					<!-- show online -->				
					<a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?page=list","online-now"); ?>"><span style="font-weight: normal;"><?php echo $lang['online_stats_recent']; ?></span></a>
<br />
<?php } elseif($template_hook=='4'){ ?>
					<span class="bot-group-color"><i><?php echo "$name"; ?></i></span>
<?php } elseif($template_hook=='5'){ ?>
					<?php echo member_link($id, '1', '1', '1'); ?>	
<?php } elseif($template_hook=='6'){ ?>
					<span class="bot-group-color"><i><?php echo "$name"; ?></i></span>, 
<?php } elseif($template_hook=='7'){ ?>
					<?php echo member_link($id, '1', '1', '1'); ?>,
<?php } elseif($template_hook=='8'){ ?>
					<hr />
					<?php echo $lang['online_stats_today']; ?><br />
<?php } elseif($template_hook=='9'){ ?>
					<?php echo member_link($id, '1'); ?>	
<?php } elseif($template_hook=='10'){ ?>
					<?php echo member_link($id, '1'); ?>,	
<?php } elseif($template_hook=='11'){ ?>
					<!-- show most users online -->
					<br />
					<?php echo $lang['online_stats_most']; ?>
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='end'){ ?>		
<?php } ?>