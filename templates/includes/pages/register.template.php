<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif ($template_hook=='1'){ ?>

		<!-- registration form -->

		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang['register_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang['register_info']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom"><br /><br />
				<form name="register" action="<?php echo lb_link("index.php?page=register", "register"); ?>" onsubmit="return validate_info(); return check_passwords" method="post">
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang['register_username']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="name"
value="<?php if(isset($_SESSION['session_name']))
{
	echo $_SESSION['session_name'];
}else{
	echo $name;
}
?>" style="width: 50%;" maxlength="<?php echo $username_length; ?>" />

<?php if ($_GET['error']=='2'){ ?>
						<span class="register-warning"> <?php echo $lang['register_taken']; ?></span>
<?php }elseif ($_GET['error']=='1'){ ?>
						<span class="register-warning"> <?php echo $lang['register_required']; ?></span>
<?php } elseif ($_GET['error'] == 7){ ?>
						<span class="register-warning"> <?php echo $lang['register_length']; ?></span>
<?php } ?>
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang['register_password']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="password" id="pass" name="password" value="" style="width: 50%;" />
<?php if ($_GET['error']=='3'){ ?>
						<span style="color: red;"> <?php echo $lang['register_required']; ?></span>
<?php } ?>
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang['register_password_repeat']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="password" id="check_pass" name="check_password" value="" style="width: 50%;" />

						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang['register_email']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="email" name="email"
value="<?php if (isset($_SESSION['session_email']))
{
	echo $_SESSION['session_email'];
	unset ($_SESSION['session_email']);
}else{
	echo $email;
} ?>" style="width: 50%;" />

<?php if ($_GET['error']=='4'){ ?>
						<span style="color: red;"> <?php echo $lang['register_required']; ?></span>
<?php }elseif ($_GET['error']=='6'){ ?>
						<span style="color: red;"> <?php echo $lang['register_email_taken']; ?></span>
<?php } ?>
						<br /><br />
					</div>
<?php }elseif ($template_hook=='captcha'){ ?>
					<div style="width: 100%; float: left; text-align: center;">
						<strong><?php echo $lang['register_security']; ?></strong>
						<br />
						<img src="<?php echo "$lb_domain"; ?>/scripts/php/captcha/CaptchaSecurityImages.php?width=140&height=40&characters=8" alt="captcha" />
						<br />
						<input id="security_code" name="security_code" size="8" />
						<br />
<?php }elseif ($template_hook=='recaptcha'){ ?>
						<div style="width: 30%; float: left;" >&nbsp;</div>
						<div style="width: 70%; float: left;">
							<?php echo recaptcha_get_html($recaptcha_public, $error); ?>
						</div>
<?php }elseif ($template_hook=='5'){ ?>
<?php if ($_GET['error']=='5'){ ?>
						<span style="color: red;"> <?php echo $lang['register_security_wrong']; ?></span>
<?php } ?>
					</div>
					<input type="hidden" value="1" name="form" />
<?php if ($guest_register=='1'){ ?>
					<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
					<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
				</td></tr>
				<tr><td class="forum-index-stats-header" style="border-top: none; text-align: center;">
					<input type="submit" class="submit-button img-add-user" value="<?php echo $lang['button_register']; ?>" />
				</td></tr>
			</form>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='2'){ ?>
		<!-- confirm registration -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr>
				<td class="forum-topic-subject"> </td>
			</tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr>
				<td class="error-header" style="width:100%;">
					<?php echo $lang['register_thanks']; ?>
				</td>
			</tr>
			<tr>
				<td class="forum-jump-content" style="width:100%;">
					<?php echo $lang['register_email_verify']; ?>
				</td>
			</tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='3'){ ?>
		<!-- apostrophe error -->
		<?php echo $lang['register_apostrophe']; ?>
<?php }elseif ($template_hook=='4'){ ?>
		<!-- t's & c's -->
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang['register_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-stats-header" style="border-top: none;"><?php echo $lang['register_terms']; ?></td></tr>
			<tr><td class="forum-jump-content" style="border-top: none; border-bottom: none;">
				<form action="<?php echo lb_link("index.php?page=register", "register"); ?>" onsubmit="return check_agreement('<?php echo $lang['register_terms_conditions_warn'] ?>')" method="post">
					<textarea class="terms" style="width: 98%; padding: 5px;" readonly name="disabled" rows="10" cols="98"><?php echo $lang['terms_conditions']; ?></textarea>
					<br /><br />
					<input type="checkbox" class="checkbox" name="agree" id="user_agree">
						<label for="agree"><strong><?php echo $lang['register_agree']; ?></strong></label>
					</input>
<?php if ($guest_register=='1'){ ?>
					<input type="hidden" name="token_id" value="<?php echo "$token_id"; ?>" />
					<input type="hidden" name="<?php echo "$token_name"; ?>" value="<?php echo "$token"; ?>" />
<?php } ?>
				</td></tr>
				<tr><td class="forum-index-stats-header" style="border-top: none; text-align: center;">
					<input type="submit" class="submit-button img-submit" value="<?php echo $lang['button_submit']; ?>" />
				</td></tr>
			</form>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>