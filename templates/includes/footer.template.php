<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='11'){ ?>
<?php }elseif ($template_hook=='10'){ ?>
				<div class="spacer">&nbsp;</div>
					<table class="forum-jump" style="width: 100%;" cellspacing="0" cellpadding="0"><tr><td class="forum-jump-content-left">
<?php }elseif ($template_hook=='1'){ ?>
						<!-- theme picker -->
						<form method="post" action="index.php?">
							<select name="switch" onchange="location.href='<?php echo "$lb_domain"; ?>/index.php?page=switcher&theme='+(this.options[this.selectedIndex].value)">
								<option><?php echo $lang['footer_theme_title']; ?></option>
								<optgroup label="<?php echo $lang['footer_theme']; ?>">
<?php }elseif ($template_hook=='2'){ ?>
									<?php list_themes("themes/"); ?>
								</optgroup>
							</select>
						</form>
<?php }elseif ($template_hook=='9'){ ?>
						<!-- language picker -->
						<form method="post" action="index.php?">
							<select name="language" onchange="location.href='<?php echo "$lb_domain"; ?>/index.php?page=lang_change&language='+(this.options[this.selectedIndex].value)">
								<option><?php echo $lang['footer_language_title']; ?></option>
								<optgroup label="<?php echo $lang['footer_language']; ?>">
									<?php list_lang("lang/"); ?>
								</optgroup>
							</select>
						</form>
					</td>
					<td class="forum-jump-content-right" style="text-align: right;">
					<!-- quick nav -->
                    <form method="post" action="index.php?">
<?php if ($sef_urls=='1'){ ?>
						<select name="forum" onchange="location.href='<?php echo "$lb_domain"; ?>'+escape(this.options[this.selectedIndex].value)">
<?php }else{ ?>
						<select name="forum" onchange="location.href='<?php echo "$lb_domain"; ?>/index.php?'+(this.options[this.selectedIndex].value)">
<?php } ?>
<?php if ($sef_urls=='1'){ ?>
							<option value="">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang['footer_nav']; ?></option>
							<optgroup label="<?php echo $lang['footer_nav_areas']; ?>">
								<option value=""><?php echo $lang['footer_nav_forum']; ?></option>
<?php if ($can_change_site_settings=='1'){ ?>
								<option value="/admin"><?php echo $lang['footer_nav_admin']; ?></option>
<?php } elseif ($can_change_forum_settings=='1'){ ?>
								<option value="/admin"><?php echo $lang['footer_nav_mod']; ?></option>
<?php } ?>
<?php if (isset($_COOKIE['lb_name'])){ ?>
								<option value="/myoptions"><?php echo $lang['footer_nav_user']; ?></option>
								<option value="/messages"><?php echo $lang['footer_nav_messages']; ?></option>
<?php } ?>
								<option value="/search"><?php echo $lang['footer_nav_search']; ?></option>
							</optgroup>
							<optgroup label="<?php echo $lang['footer_nav_forum_cats']; ?>">
<?php } else{ ?>
							<option value=""><?php echo $lang['footer_nav']; ?></option>
							<optgroup label="<?php echo $lang['footer_nav_areas']; ?>">
								<option value=""><?php echo $lang['footer_nav_forum']; ?></option>
<?php if ($can_change_site_settings=='1'){ ?>
								<option value="page=admin"><?php echo $lang['footer_nav_admin']; ?></option>
<?php } elseif ($can_change_forum_settings=='1'){ ?>
								<option value="page=admin"><?php echo $lang['footer_nav_mod']; ?></option>
<?php } ?>
<?php if (isset($_COOKIE['lb_name'])){ ?>
								<option value="page=myoptions"><?php echo $lang['footer_nav_user']; ?></option>
								<option value="page=messages&act=inbox"><?php echo $lang['footer_nav_messages']; ?></option>
<?php } ?>
								<option value="page=search"><?php echo $lang['footer_nav_search']; ?></option>
							</optgroup>
							<optgroup label="<?php echo $lang['footer_nav_forum_cats']; ?>">
<?php } ?>
<?php }elseif ($template_hook=='3'){ ?>
<?php if ($sef_urls=='1'){ ?>
								<option style="font-weight: bold;" value="/forum/<?php echo "$forum_title-$parent_id"; ?>"><?php echo "$parent_name"; ?></option>
<?php } else{ ?>
								<option style="font-weight: bold;" value="forum=<?php echo "$parent_id"; ?>"><?php echo "$parent_name"; ?></option>
<?php } ?>
<?php }elseif ($template_hook=='4'){ ?>
<?php if ($sef_urls=='1'){ ?>
									<option value="/forum/<?php echo "$forum_title-$forum_id"; ?>">|--<?php echo "$forum_name"; ?></option>
<?php } else{ ?>
									<option value="forum=<?php echo "$forum_id"; ?>">|--<?php echo "$forum_name"; ?></option>
<?php } ?>
<?php }elseif ($template_hook=='5'){ ?>
<?php if ($sef_urls=='1'){ ?>
									<option value="/forum/<?php echo "$forum_title_sub-$forum_sub_id"; ?>">|---- <?php echo "$forum_sub_name"; ?></option>
<?php } else{ ?>
									<option value="forum=<?php echo "$forum_sub_id"; ?>">|---- <?php echo "$forum_sub_name"; ?></option>
<?php } ?>
<?php }elseif ($template_hook=='6'){ ?>
<?php }elseif ($template_hook=='7'){ ?>
								</optgroup>
							</select>
						</form>
					</td></tr></table>
<?php } elseif ($template_hook=='8'){ ?>
					<div class="spacer">&nbsp;</div>			
					<!-- Copyright - Do NOT Remove -->
					<table class="forum-jump" cellspacing="0" cellpadding="0"><tr><td class="forum-jump-content" style="vertical-align: middle;">
						<span style="width: 100%; text-align: center; float: left;">
							<?php echo $lang['footer_copyright']; ?>
							<br />
							<?php echo $lang['footer_board']; ?>
						</span>
					</td></tr></table>
				</div>		
<?php } elseif ($template_hook=='end'){ ?>
<?php } ?>