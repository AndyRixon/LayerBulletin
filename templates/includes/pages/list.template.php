<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
<?php if ($pages <= '1'){}else{ ?>
		<!-- show page numbers -->
		<div style="padding-top: 5px; padding-bottom: 5px;">
		<?php echo $lang['board_page']; ?>	
<?php $pages=(ceil($number_of_members/$list_posts)); if (!isset($_GET['limit'])){$_GET['limit']="1";} $start="1"; for($i = "1"; $i <= $pages; $i++) { $i_limit=$i; if ($i > 1){ $start=($start+1); } if ($_GET['limit']==$start){ ?>
		<a class="page-active" href="<?php echo lb_link("index.php?page=list&group=$group&limit=$i_limit", "list/group/$group/$i_limit"); ?>"><?php echo "$i"; ?></a>
<?php } else{ ?>
<?php if ($_GET['limit'] >="3" && $i_limit < $_GET['limit'] - "2" OR $_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] <= "2" && $i_limit > "4" ){}else{  ?>
<?php if ($_GET['limit'] > "2" && $i_limit < $_GET['limit'] - "1"){ ?>
		<a class="page" href="<?php echo lb_link("index.php?page=list&group=$group&limit=1", "list/group/$group/1"); ?>">&lt;&lt;</a>
<?php } ?>
		<a class="page" href="<?php echo lb_link("index.php?page=list&group=$group&limit=$i_limit", "list/group/$group/$i_limit"); ?>"><?php echo "$i"; ?></a>
<?php }}} ?>
<?php if ($pages - $_GET['limit'] >= "3"){ ?>
		<a class="page" href="<?php echo lb_link("index.php?page=list&group=$group&limit=$pages_end", "list/group/$group/$pages_end"); ?>">&gt;&gt;</a>
<?php } ?>
		</div>
<?php } ?>
<?php } elseif($template_hook=='4'){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject">
					<?php echo "$group_name"; ?> <?php echo $lang['list_group']; ?>
				</td>
			</tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-index-td-middle-sub" style="width: 25%;">
					<?php echo $lang['list_name']; ?>
				</td>
				<td class="forum-index-td-topics-sub" style="width: 40%; text-align: left; padding-left: 5px;">
					<?php echo $lang['list_location']; ?>
				</td>
				<td class="forum-index-td-topics-sub" style="width: 15%; text-align: left; padding-left: 5px;">
					<?php echo $lang['list_time']; ?>
				</td>
				<td class="forum-index-td-topics-sub" style="width: 10%; text-align: left; padding-left: 5px;">
					&nbsp;
				</td>
			</tr>
<?php } elseif($template_hook=='5'){ ?>
			<tr>
				<td class="forum-index-td-left<?php echo "$alt_td_class"; ?>" style="width: 30%; text-align: left; padding: 8px;">
<?php if ($id=='0'){ ?>
					<img  src="<?php echo "$lb_domain"; ?>/<?php echo "$flag_path"; ?>/0.png" alt="" />
					<?php echo $lang['list_guest']; ?>
<?php }elseif ($id < '0'){ ?>
					<img  src="<?php echo "$lb_domain"; ?>/<?php echo "$flag_path"; ?>/0.png" alt="" />
					<i><?php echo "$name"; ?></i>
<?php }else{ ?>
					<?php echo member_link($id); ?>
<?php } ?>					
				</td>
				<td class="forum-index-td-right<?php echo "$alt_td_class"; ?>" style="width: 30%; text-align: left; padding-left: 5px;">
<?php } elseif($template_hook=='6'){ ?>
<?php if ($can_view_forum=='0'){ ?>
					<!-- viewing topic -->
					<?php echo $lang['list_viewing_topic']; ?> <?php echo $lang['online_stats_restricted']; ?>
<?php }elseif ($can_read_topics=='0'){ ?>
					<!-- viewing topic -->
					<?php echo $lang['list_viewing_topic']; ?> <?php echo $lang['online_stats_restricted']; ?>
<?php }else{ ?>
					<!-- viewing topic -->
					<?php echo $lang['list_viewing_topic']; ?> <a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?topic=$location_topic", "topic/$topic_title-$location_topic"); ?>"><?php echo "$title"; ?></a>
<?php }} elseif($template_hook=='7'){ ?>
					<!-- viewing forum -->
					<?php echo $lang['list_viewing_forum']; ?> <a class="forum-index-link-to-topic" href="<?php echo lb_link("index.php?forum=$location_forum", "forum/$forum_title-$location_forum"); ?>"><?php echo "$forum_name"; ?></a>
<?php } elseif($template_hook=='8'){ ?>
					<!-- viewing page -->
					<?php echo "$location_page_text"; ?>
<?php } elseif($template_hook=='9'){ ?>
				</td>
				<td class="forum-index-td-posts<?php echo "$alt_td_class"; ?>" style="width: 20%; text-align: left; padding-left: 5px;">
<?php if ($time!='0'){ ?>
						<?php echo "$time"; ?>
<?php } ?>
				</td>
				<td class="forum-index-td-right<?php echo "$alt_td_class"; ?>" style="width: 10%; text-align: left; padding-left: 5px;">
<?php if ($can_pm=='1'){ if ($can_pm_this_member=='1'){ ?>
					<div class="center">
						<a class="submit-button img-email-go" href="<?php echo lb_link("index.php?page=messages&act=new&id=$id", "messages/new/$id"); ?>"><?php echo $lang['button_send_pm']; ?></a>
					</div>
<?php }} ?>
				</td>
			</tr>
<?php } elseif($template_hook=='10'){ ?>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-index-forum-footer-contents"> 
				</td>
			</tr>
		</table>
<?php } elseif($template_hook=='12'){ ?>
		<!-- online last 15 minutes -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject">
					<?php echo $lang['online_stats_recent']; ?>
				</td>
			</tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-index-td-middle-sub" style="width: 25%; padding-left: 5px; text-align: left;">
					<?php echo $lang['list_name']; ?>
				</td>
				<td class="forum-index-td-topics-sub" style="width: 40%; padding-left: 5px; text-align: left;">
					<?php echo $lang['list_location']; ?>
				</td>
				<td class="forum-index-td-topics-sub" style="width: 15%; padding-left: 5px; text-align: left;">
					<?php echo $lang['list_time']; ?>
				</td>
				<td class="forum-index-td-topics-sub" style="width: 10%;">
					&nbsp;
				</td>
			</tr>
<?php } elseif($template_hook=='13'){ ?>
			<tr>
				<td class="forum-index-td-left" style="width: 30%; text-align: left; padding-left: 5px;">
<?php if ($id <= '0'){ ?>
					<span style="color:<?php echo "$group_color"; ?>;">
						<?php echo "$name"; ?>
					</span>
<?php }else{ ?>
					<?php echo member_link($id, '0'); ?>
<?php } ?>
				</td>
<?php } elseif ($template_hook=='11'){ ?>
<?php if ($pages <= '1'){}else{ ?>
				<!-- show page numbers -->
				<div style="padding-top: 5px; padding-bottom: 5px;">
				<?php echo $lang['board_page']; ?>
<?php $pages=(ceil($number_of_members/$list_posts)); if (!isset($_GET['limit'])){$_GET['limit']="1";} $start="1"; for($i = "1"; $i <= $pages; $i++) { $i_limit=$i; if ($i > 1){ $start=($start+1); } if ($_GET['limit']==$start){ ?>
				<a class="page-active" href="<?php echo lb_link("index.php?page=list&limit=$i_limit", "online/$i_limit"); ?>"><?php echo "$i"; ?></a>
<?php } else{ ?>
<?php if ($_GET['limit'] >="3" && $i_limit < $_GET['limit'] - "2" OR $_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] <= "2" && $i_limit > "4" ){}else{  ?>
<?php if ($_GET['limit'] > "2" && $i_limit < $_GET['limit'] - "1"){ ?>
				<a class="page" href="<?php echo lb_link("index.php?page=list&limit=1", "online/1"); ?>">&lt;&lt;</a>
<?php } ?>
				<a class="page" href="<?php echo lb_link("index.php?page=list&limit=$i_limit", "online/$i_limit"); ?>"><?php echo "$i"; ?></a>
<?php }}} ?>
<?php if ($pages - $_GET['limit'] >= "3"){ ?>
				<a class="page" href="<?php echo lb_link("index.php?page=list&limit=$pages_end", "online/$pages_end"); ?>">&gt;&gt;</a>
<?php } ?>
				</div>
<?php } ?>
<?php } elseif($template_hook=='14'){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject">
					<?php echo $lang['list_members']; ?>
				</td>
			</tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-index-td-middle-sub border-left" style="width: 25%;">
					<?php echo $lang['list_name']; ?>
				</td>
				<td class="forum-index-td-topics-sub" style="width: 40%; text-align: left; padding-left: 5px;">
					<?php echo $lang['list_location']; ?>
				</td>
				<td class="forum-index-td-topics-sub" style="width: 15%; text-align: left; padding-left: 5px;">
					<?php echo $lang['list_time']; ?>
				</td>
				<td class="forum-index-td-topics-sub border-right" style="width: 10%; text-align: left; padding-left: 5px;">
					&nbsp;
				</td>
			</tr>
<?php }elseif ($template_hook=='15'){ ?>		
			<div style="width: 100%; text-align: right;">
				<form method="post" action="index.php?">
<?php if ($sef_urls=='1'){ ?>
					<select name="forum" onchange="location.href='<?php echo "$lb_domain"; ?>/list/group/'+escape(this.options[this.selectedIndex].value)">
<?php }else{ ?>
					<select name="forum" onchange="location.href='<?php echo "$lb_domain"; ?>/index.php?page=list&group='+(this.options[this.selectedIndex].value)">
<?php } ?>
						<option value=""><?php echo $lang['list_select']; ?></option>
<?php }elseif ($template_hook=='16'){ ?>
						<option value="<?php echo "$group_id"; ?>"><?php echo "$group_name ($number_of_members)"; ?></option>
<?php }elseif ($template_hook=='17'){ ?>			
					</select>
				</form>&nbsp;
			</div>
			<div class="spacer">&nbsp;</div>
<?php }elseif ($template_hook=='18'){ ?>
<?php if ($pages <= '1'){}else{ ?>
			<!-- show page numbers -->
			<div style="padding-top: 5px; padding-bottom: 5px;">
			<?php echo $lang['board_page']; ?>
<?php $pages=(ceil($number_of_members/$list_posts)); if (!isset($_GET['limit'])){$_GET['limit']="1";} $start="1"; for($i = "1"; $i <= $pages; $i++) { $i_limit=$i; if ($i > 1){ $start=($start+1); } if ($_GET['limit']==$start){ ?>
			<a class="page-active" href="<?php echo lb_link("index.php?page=list&list=members&limit=$i_limit", "list/members/$i_limit"); ?>"><?php echo "$i"; ?></a>
<?php } else{ ?>
<?php if ($_GET['limit'] >="3" && $i_limit < $_GET['limit'] - "2" OR $_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] <= "2" && $i_limit > "4" ){}else{  ?>
<?php if ($_GET['limit'] > "2" && $i_limit < $_GET['limit'] - "1"){ ?>
			<a class="page" href="<?php echo lb_link("index.php?page=list&list=members&limit=1", "list/members/1"); ?>">&lt;&lt;</a>
<?php } ?>
			<a class="page" href="<?php echo lb_link("index.php?page=list&list=members&limit=$i_limit", "list/members/$i_limit"); ?>"><?php echo "$i"; ?></a>
<?php }}} ?>
<?php if ($pages - $_GET['limit'] >= "3"){ ?>
			<a class="page" href="<?php echo lb_link("index.php?page=list&list=members&limit=$pages_end", "list/members/$pages_end"); ?>">&gt;&gt;</a>
<?php } ?>
			</div>
<?php } ?>	
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>
