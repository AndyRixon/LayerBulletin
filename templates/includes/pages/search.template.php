<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>
		<!-- topics started by member -->
		<div id="top" class="search-headline">
			<?php echo $lang['search_topics_started']; ?> <?php echo "$search_name"; ?>
			<br /><br />
		</div>
<?php }elseif ($template_hook=='4'){ ?>
<?php if ($pages <= '1'){}else{ ?>
		<!-- show page numbers -->
		<div style="padding-top: 5px; padding-bottom: 5px;">
		<?php echo $lang['board_page']; ?>
<?php $pages=(ceil($number_of_posts/$list_posts)); if (!isset($_GET['limit'])){$_GET['limit']="1";} $start="1"; for($i = "1"; $i <= $pages; $i++) { $i_limit=$i; if ($i > 1){ $start=($start+1); } if ($_GET['limit']==$start){ ?>
		<a class="page-active" href="<?php echo "$lb_domain"; ?>/index.php?page=search&area=topics&search=<?php echo "$member_id"; ?>&limit=<?php echo "$i_limit"; ?>"><?php echo "$i"; ?></a><?php } else{ ?><?php if ($_GET['limit'] >="3" && $i_limit < $_GET['limit'] - "2" OR $_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] <= "2" && $i_limit > "4" ){}else{  ?><?php if ($_GET['limit'] > "2" && $i_limit < $_GET['limit'] - "1"){ ?>
		<a class="page" href="<?php echo "$lb_domain"; ?>/index.php?page=search&area=topics&search=<?php echo "$member_id"; ?>&limit=1">&lt;&lt;</a><?php } ?>
		<a class="page" href="<?php echo "$lb_domain"; ?>/index.php?page=search&area=topics&search=<?php echo "$member_id"; ?>&limit=<?php echo "$i_limit"; ?>"><?php echo "$i"; ?></a><?php }}} ?>
<?php if ($pages - $_GET['limit'] >= "3"){ ?>
		<a class="page" href="<?php echo "$lb_domain"; ?>/index.php?page=search&area=topics&search=<?php echo "$member_id"; ?>&limit=<?php echo "$pages_end"; ?>">&gt;&gt;</a><?php } ?>
		</div>
		<div class="spacer">&nbsp;</div>
<?php } ?>
<?php }elseif ($template_hook=='5'){ ?>
		<!-- show results -->
		<div class="search-contents">
			<a class="search-title" href="<?php echo lb_link("index.php?page=findpost&post=$post_id","findpost/$post_id"); ?>"><?php echo "$title"; ?></a>
			<br />
			<div class="search-content"><span class="search-date"><?php echo "$time"; ?> - </span><?php echo "$content"; ?></div>
			<span class="search-link"><?php echo lb_link("index.php?page=findpost&post=$post_id","findpost/$post_id"); ?></span>
		</div>

<?php }elseif ($template_hook=='10'){ ?>
		<!-- posts by member -->
		<div id="top" class="search-headline">
			<?php echo $lang['search_posts_by']; ?> <?php echo "$search_name"; ?><br /><br />
		</div>
<?php }elseif ($template_hook=='11'){ ?>
<?php if ($pages <= '1'){}else{ ?>
			<!-- show page numbers -->
			<div style="padding-top: 5px; padding-bottom: 5px;">
			<?php echo $lang['board_page']; ?>
<?php $pages=(ceil($number_of_posts/$list_posts)); if (!isset($_GET['limit'])){$_GET['limit']="1";} $start="1"; for($i = "1"; $i <= $pages; $i++) { $i_limit=$i; if ($i > 1){ $start=($start+1); } if ($_GET['limit']==$start){ ?>
			<a class="page-active" href="<?php echo "$lb_domain"; ?>/index.php?page=search&area=posts&search=<?php echo "$member_id"; ?>&limit=<?php echo "$i_limit"; ?>"><?php echo "$i"; ?></a><?php } else{ ?><?php if ($_GET['limit'] >="3" && $i_limit < $_GET['limit'] - "2" OR $_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] <= "2" && $i_limit > "4" ){}else{  ?><?php if ($_GET['limit'] > "2" && $i_limit < $_GET['limit'] - "1"){ ?>
		<a class="page" href="<?php echo "$lb_domain"; ?>/index.php?page=search&area=posts&search=<?php echo "$member_id"; ?>&limit=0">&lt;&lt;</a><?php } ?>
		<a class="page" href="<?php echo "$lb_domain"; ?>/index.php?page=search&area=posts&search=<?php echo "$member_id"; ?>&limit=<?php echo "$i_limit"; ?>"><?php echo "$i"; ?></a><?php }}} ?>
<?php if ($pages - $_GET['limit'] >= "3"){ ?>
		<a class="page" href="<?php echo "$lb_domain"; ?>/index.php?page=search&area=posts&search=<?php echo "$member_id"; ?>&limit=<?php echo "$pages_end"; ?>">&gt;&gt;</a><?php } ?>
		</div>
<?php } ?>
<?php }elseif ($template_hook=='12'){ ?><?php if ($_GET['pf']!=''){ ?>
		<!-- hide the form -->
		<div id="top"></div>
		<table style="width: 100%;" cellpadding="0" cellspacing="0"><tr>
			<td style="padding:10px 0;">
				<a class="submit-button-large img-preview" href="javascript: showhide('searchform');"><?php echo $lang['button_search_form']; ?></a>
			</td>
		</tr></table>
		<div class="spacer"></div>
<?php } ?>
		<!-- search form -->

<?php if ($_GET['pf']=='1'){ ?>	
		
		<div id="searchform" style="display: none;"><br />
<?php }else{ ?>
		<div id="searchform"><br />
<?php } ?>
			<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
				<tr><td class="forum-topic-subject"><?php echo $lang['search_title']; ?></td></tr>
				<tr><td class="forum-index-stats-sub"> </td></tr>
			</table>
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"> </td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<?php echo $lang['search_desc']; ?><br /><br />
					<form method="get" action="<?php echo "$lb_domain"; ?>/index.php?">
						<input type="hidden" name="page" value="search" />
						<div style="width: 30%;float:left;clear:both;">
							<strong><?php echo $lang['search_search']; ?></strong><br /><?php echo $lang['search_search_query']; ?><br /><br />
						</div>
						<div style="width: 70%;float:left;">
							<input type="text" name="search" value="<?php echo "$search"; ?>" /><br /><br />
						</div>
						<div style="width: 30%;float:left;clear:both;">
							<strong><?php echo $lang['search_author']; ?></strong><br /><?php echo $lang['search_author_desc']; ?><br /><br />
						</div>
						<div style="width: 70%;float:left;">
							<input type="hidden" id="author_id" name="author_id" value="<?php echo "$author_id"; ?>" />
							<input type="text" name="author" id="author" value="<?php echo "$author"; ?>" /><br /><br />
						</div>
						<div style="width: 30%;float:left;clear:both;">
							<strong><?php echo $lang['search_date']; ?></strong><br /><?php echo $lang['search_date_desc']; ?><br /><br />
						</div>
						<div style="width: 70%;float:left;">
							<input type="text" name="startdate" maxlength="10" value="<?php echo "$startdate"; ?>" /> -> <input type="text" name="enddate" size="18" maxlength="10" value="<?php echo "$enddate"; ?>" /><br /><br />
						</div>
						<div style="width: 30%;float:left; clear:both;">
							<strong><?php echo $lang['search_forums']; ?></strong><br /><?php echo $lang['search_forums_desc']; ?><br /><br />
						</div>
						<div style="width: 70%;float:left;">
							<select id="forums" style="height:150px;" multiple="multiple" name="forums[]" id="forums[]">
<?php }elseif ($template_hook=='15'){ ?>
								<option disabled="disabled" value="<?php echo "$parent_id"; ?>"><?php echo "$parent_name"; ?></option>
<?php }elseif ($template_hook=='16'){ ?>
								<option value="<?php echo "$forum_id"; ?>">|--<?php echo "$forum_name"; ?></option>
<?php }elseif ($template_hook=='17'){ ?>
								<option value="<?php echo "$forum_sub_id"; ?>">|---- <?php echo "$forum_sub_name"; ?></option>
<?php }elseif ($template_hook=='18'){ ?>
							</select>
							<br /><br />
						</div>
						<input type="hidden" value="1" name="pf" />
						<input type="hidden" value="<?php echo $_GET['topic']; ?>" name="topic" id="topic" />
					</td></tr>
					<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
						<input type="submit" class="submit-button img-preview" value="<?php echo $lang['button_search']; ?>" />
					</td></tr>
				</form>
			</table>
			<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-forum-footer-contents"> </td></tr>
			</table>
			<br />
		</div>
<?php if ($_GET['pf']!=''){ ?>
		<div id="top"></div>

<?php } ?>
<?php }elseif ($template_hook=='14'){ ?>
<?php if ($pages <= '1'){}else{ ?>
		<!-- show page numbers -->
		<div style="padding-top: 5px; padding-bottom: 5px;">
		<?php echo $lang['board_page']; ?>
<?php $pages=(ceil($number_of_posts/$list_posts)); if (!isset($_GET['limit'])){$_GET['limit']="1";} $start="1"; for($i = "1"; $i <= $pages; $i++) { $i_limit=$i; if ($i > 1){ $start=($start+1); } if ($_GET['limit']==$start){ ?>
		<a class="page-active" href="<?php echo "$lb_domain"; ?>/index.php?page=search&author=<?php echo "$author"; ?>&author_id=<?php echo "$author_id"; ?>&startdate=<?php echo "$page_start"; ?>&enddate=<?php echo "$enddate_form"; ?>&forums[]=<?php echo "$forum_form"; ?>&search=<?php echo "$words"; ?>&pf=1&limit=<?php echo "$i_limit"; ?>"><?php echo "$i"; ?></a><?php } else{ ?><?php if ($_GET['limit'] >="3" && $i_limit < $_GET['limit'] - "2" OR $_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] <= "2" && $i_limit > "4" ){}else{  ?><?php if ($_GET['limit'] > "2" && $i_limit < $_GET['limit'] - "1"){ ?>
		<a class="page" href="<?php echo "$lb_domain"; ?>/index.php?page=search&author=<?php echo "$author"; ?>&author_id=<?php echo "$author_id"; ?>&startdate=<?php echo "$page_start"; ?>&enddate=<?php echo "$enddate_form"; ?>&forums[]=<?php echo "$forum_form"; ?>&search=<?php echo "$words"; ?>&pf=1&limit=1">&lt;&lt;</a><?php } ?>
		<a class="page" href="<?php echo "$lb_domain"; ?>/index.php?page=search&author=<?php echo "$author"; ?>&author_id=<?php echo "$author_id"; ?>&startdate=<?php echo "$page_start"; ?>&enddate=<?php echo "$enddate_form"; ?>&forums[]=<?php echo "$forum_form"; ?>&search=<?php echo "$words"; ?>&pf=1&limit=<?php echo "$i_limit"; ?>"><?php echo "$i"; ?></a><?php }}} ?>
<?php if ($pages - $_GET['limit'] >= "3"){ ?>
		<a class="page" href="<?php echo "$lb_domain"; ?>/index.php?page=search&author=<?php echo "$author"; ?>&author_id=<?php echo "$author_id"; ?>&startdate=<?php echo "$page_start"; ?>&enddate=<?php echo "$enddate_form"; ?>&forums[]=<?php echo "$forum_form"; ?>&search=<?php echo "$words"; ?>&pf=1&limit=<?php echo "$pages_end"; ?>">&gt;&gt;</a><?php } ?>
		</div>
<?php } ?>
<?php }elseif ($template_hook=='19'){ ?>
<?php if ($pages <= '1'){}else{ ?>
		<!-- show page numbers -->
		<div style="padding-top: 5px; padding-bottom: 5px;">
		<?php echo $lang['board_page']; ?>
<?php $pages=(ceil($number_of_posts/$list_posts)); if (!isset($_GET['limit'])){$_GET['limit']="1";} $start="1"; for($i = "1"; $i <= $pages; $i++) { $i_limit=$i; if ($i > 1){ $start=($start+1); } if ($_GET['limit']==$start){ ?>
		<a class="page-active" href="<?php echo lb_link("index.php?page=search&area=newposts&limit=$i_limit", "newposts/$i_limit"); ?>"><?php echo "$i"; ?></a><?php } else{ ?><?php if ($_GET['limit'] >="3" && $i_limit < $_GET['limit'] - "2" OR $_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] >="3" && $i_limit > $_GET['limit'] + "2"){}elseif($_GET['limit'] <= "2" && $i_limit > "4" ){}else{  ?><?php if ($_GET['limit'] > "2" && $i_limit < $_GET['limit'] - "1"){ ?>
		<a class="page" href="<?php echo lb_link("index.php?page=search&area=newposts&limit=1", "newposts/1"); ?>">&lt;&lt;</a><?php } ?>
		<a class="page" href="<?php echo lb_link("index.php?page=search&area=newposts&limit=$i_limit", "newposts/$i_limit"); ?>"><?php echo "$i"; ?></a><?php }}} ?>
<?php if ($pages - $_GET['limit'] >= "3"){ ?>
		<a class="page" href="<?php echo lb_link("index.php?page=search&area=newposts&limit=$pages_end", "newposts/$pages_end"); ?>">&gt;&gt;</a><?php } ?>
		</div>
<?php } ?>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>
		<script type="text/javascript">
			var options = {
			script:"<?php echo "$lb_domain"; ?>/scripts/php/autosuggest.php?json=true&limit=6&",
			varname:"input",
			json:true,
			shownoresults:true,
			maxresults:1000,
			cache: false,
			callback: function (obj) { document.getElementById('author_id').value = obj.id; }
			};
			var as_json = new bsn.AutoSuggest('author', options);
			var options_xml = {
			script: function (input) { return "<?php echo "$lb_domain"; ?>/scripts/php/autosuggest.php?input="+input+"&member_to="+document.getElementById('author_id').value; },
			varname:"input"
			};
			var as_xml = new bsn.AutoSuggest('testinput_xml', options_xml);
		</script>