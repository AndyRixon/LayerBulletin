<?php if (!defined('LB_RUN')){echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";exit();} ?>
<?php if ($template_hook=='start'){ ?>
<?php }elseif($template_hook=="3"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['subscriptions_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="submit" id="submit" method="post" action="<?php echo lb_link("index.php?page=admin&act=subscriptions","admin/subscriptions"); ?>">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['subscriptions_create_new']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['subscriptions_name']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="subscription_name" />
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['subscriptions_features']; ?></strong>
					</div>
					<div style="float: left; width: 70%;">
						<textarea name="subscription_features" id="subscription_features" class="post" style="width: 94%;"><?php echo "$upgrade_features"; ?></textarea>
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['subscriptions_groups']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<select name="upgrade_from">
<?php }elseif($template_hook=="4"){ ?>
							<option value="<?php echo "$group_id"; ?>"><?php echo "$group_name"; ?></option>
<?php }elseif($template_hook=="5"){ ?>
						</select>
						 -> 
						<select name="upgrade_to">
<?php }elseif($template_hook=="6"){ ?>
						</select>
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['subscriptions_cost']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="cost" size="10" /><br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['subscriptions_currency']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<select name="currency">
							<option value="GBP"><?php echo $lang_admin['subscriptions_gbp']; ?></option>
							<option value="AUD"><?php echo $lang_admin['subscriptions_aud']; ?></option>
							<option value="CAD"><?php echo $lang_admin['subscriptions_cad']; ?></option>
							<option value="CZK"><?php echo $lang_admin['subscriptions_czk']; ?></option>
							<option value="DKK"><?php echo $lang_admin['subscriptions_dkk']; ?></option>
							<option value="EUR"><?php echo $lang_admin['subscriptions_eur']; ?></option>
							<option value="HKD"><?php echo $lang_admin['subscriptions_hkd']; ?></option>
							<option value="HUF"><?php echo $lang_admin['subscriptions_huf']; ?></option>
							<option value="JPY"><?php echo $lang_admin['subscriptions_jpy']; ?></option>
							<option value="NZD"><?php echo $lang_admin['subscriptions_nzd']; ?></option>
							<option value="NOK"><?php echo $lang_admin['subscriptions_nok']; ?></option>
							<option value="PLN"><?php echo $lang_admin['subscriptions_pln']; ?></option>
							<option value="SGD"><?php echo $lang_admin['subscriptions_sgd']; ?></option>
							<option value="SEK"><?php echo $lang_admin['subscriptions_sek']; ?></option>
							<option value="CHF"><?php echo $lang_admin['subscriptions_chf']; ?></option>
							<option value="USD"><?php echo $lang_admin['subscriptions_usd']; ?></option>
						</select>
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['subscriptions_frequency']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<select name="frequency_one">
							<option value="--">--</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
							<option value="24">24</option>
							<option value="25">25</option>
							<option value="26">26</option>
							<option value="27">27</option>
							<option value="28">28</option>
							<option value="29">29</option>
							<option value="30">30</option>
						</select>
						&nbsp;
						<select name="frequency_two">
							<option value="Once">----------</option>
							<option value="D"><?php echo $lang_admin['subscriptions_days']; ?></option>
							<option value="W"><?php echo $lang_admin['subscriptions_weeks']; ?></option>
							<option value="M"><?php echo $lang_admin['subscriptions_months']; ?></option>
							<option value="Y"><?php echo $lang_admin['subscriptions_years']; ?></option>
						</select>
						<br /><br />
						<strong><?php echo $lang_admin['subscriptions_once']; ?></strong>
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['subscriptions_email']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="paypal_email" />
						<br /><br />
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
<?php if($can_change_site_settings=='1'){ ?>
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
<?php }elseif($template_hook=="8"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['subscriptions_title']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<form name="submit" id="submit" method="post" action="<?php echo lb_link("index.php?page=admin&act=subscriptions&func=edit","admin/subscriptions/edit"); ?>">
			<table class="forum-index" cellpadding="0" cellspacing="0">
				<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['subscriptions_edit']; ?></td></tr>
				<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['subscriptions_name']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="subscription_name" value="<?php echo "$upgrade_name"; ?>" /><br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['subscriptions_features']; ?></strong>
					</div>
					<div style="float: left; width: 70%;">
						<textarea name="subscription_features" id="subscription_features" class="post" style="width: 94%;"><?php echo "$upgrade_features"; ?></textarea>
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['subscriptions_groups']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<select name="upgrade_from">
<?php }elseif($template_hook=="9"){ ?>
<?php if ($group_id==$upgrade_from){ ?>
							<option selected value="<?php echo "$group_id"; ?>"><?php echo "$group_name"; ?></option>
<?php }else{ ?>
							<option value="<?php echo "$group_id"; ?>"><?php echo "$group_name"; ?></option>
<?php } ?>
<?php }elseif($template_hook=="10"){ ?>
						</select>
						 -> 
						<select name="upgrade_to">
<?php }elseif($template_hook=="11"){ ?>
<?php if ($group_id==$upgrade_to){ ?>
							<option selected value="<?php echo "$group_id"; ?>"><?php echo "$group_name"; ?></option>
<?php }else{ ?>
							<option value="<?php echo "$group_id"; ?>"><?php echo "$group_name"; ?></option>
<?php } ?>
<?php }elseif($template_hook=="12"){ ?>
						</select>
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['subscriptions_cost']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="cost" value="<?php echo "$upgrade_cost"; ?>" size="10" /><br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['subscriptions_currency']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<select name="currency">
							<option value="<?php echo "$upgrade_currency"; ?>" selected><?php echo "$upgrade_currency"; ?></option>
							<option value="GBP"><?php echo $lang_admin['subscriptions_gbp']; ?></option>
							<option value="AUD"><?php echo $lang_admin['subscriptions_aud']; ?></option>
							<option value="CAD"><?php echo $lang_admin['subscriptions_cad']; ?></option>
							<option value="CZK"><?php echo $lang_admin['subscriptions_czk']; ?></option>
							<option value="DKK"><?php echo $lang_admin['subscriptions_dkk']; ?></option>
							<option value="EUR"><?php echo $lang_admin['subscriptions_eur']; ?></option>
							<option value="HKD"><?php echo $lang_admin['subscriptions_hkd']; ?></option>
							<option value="HUF"><?php echo $lang_admin['subscriptions_huf']; ?></option>
							<option value="JPY"><?php echo $lang_admin['subscriptions_jpy']; ?></option>
							<option value="NZD"><?php echo $lang_admin['subscriptions_nzd']; ?></option>
							<option value="NOK"><?php echo $lang_admin['subscriptions_nok']; ?></option>
							<option value="PLN"><?php echo $lang_admin['subscriptions_pln']; ?></option>
							<option value="SGD"><?php echo $lang_admin['subscriptions_sgd']; ?></option>
							<option value="SEK"><?php echo $lang_admin['subscriptions_sek']; ?></option>
							<option value="CHF"><?php echo $lang_admin['subscriptions_chf']; ?></option>
							<option value="USD"><?php echo $lang_admin['subscriptions_usd']; ?></option>
						</select>
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['subscriptions_frequency']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<select name="frequency_one">
<?php if ($upgrade_period!="0"){ ?>
							<option value="<?php echo "$upgrade_period"; ?>" selected><?php echo "$upgrade_period"; ?></option>
							<option value="--">--</option>
<?php }else{ ?>
							<option value="--" selected>--</option>
<?php } ?>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
							<option value="24">24</option>
							<option value="25">25</option>
							<option value="26">26</option>
							<option value="27">27</option>
							<option value="28">28</option>
							<option value="29">29</option>
							<option value="30">30</option>
						</select>
						&nbsp;
						<select name="frequency_two">
<?php if ($upgrade_period_two!="Once"){ ?>
<?php if ($upgrade_period_two=='D'){ ?>
							<option value="<?php echo "$upgrade_period_two"; ?>"><?php echo $lang_admin['subscriptions_days']; ?></option>
							<option value="--">--</option>
<?php }elseif($upgrade_period_two=='W'){ ?>
							<option value="<?php echo "$upgrade_period_two"; ?>"><?php echo $lang_admin['subscriptions_weeks']; ?></option>
							<option value="--">--</option>
<?php }elseif($upgrade_period_two=='M'){ ?>
							<option value="<?php echo "$upgrade_period_two"; ?>"><?php echo $lang_admin['subscriptions_months']; ?></option>
							<option value="--">--</option>
<?php }elseif($upgrade_period_two=='Y'){ ?>
							<option value="<?php echo "$upgrade_period_two"; ?>"><?php echo $lang_admin['subscriptions_years']; ?></option>
							<option value="--">--</option>
<?php }}else{ ?>
							<option value="Once">----------</option>
<?php } ?>
							<option value="D"><?php echo $lang_admin['subscriptions_days']; ?></option>
							<option value="W"><?php echo $lang_admin['subscriptions_weeks']; ?></option>
							<option value="M"><?php echo $lang_admin['subscriptions_months']; ?></option>
							<option value="Y"><?php echo $lang_admin['subscriptions_years']; ?></option>
						</select>
						<br /><br />
						<strong><?php echo $lang_admin['subscriptions_once']; ?></strong>
						<br /><br />
					</div>
					<div style="width: 30%; float: left;">
						<strong><?php echo $lang_admin['subscriptions_email']; ?></strong>
					</div>
					<div style="width: 70%; float: left;">
						<input type="text" name="paypal_email" value="<?php echo "$paypal_email"; ?>" /><br /><br />
					</div>
				</td></tr>
				<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
					<input type="hidden" name="upgrade_id" value="<?php echo "".$_GET['id'].""; ?>" />
<?php if($can_change_site_settings=='1'){ ?>
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
<?php }elseif($template_hook=="13"){ ?>
		<table class="forum-board-forum-head" cellpadding="0" cellspacing="0">
			<tr><td class="forum-topic-subject"><?php echo $lang_admin['subscriptions_active']; ?></td></tr>
			<tr><td class="forum-index-stats-sub"> </td></tr>
		</table>
		<table class="forum-index" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-stats-header forum-index-top"><?php echo $lang_admin['subscriptions_options']; ?></td></tr>
			<tr><td class="forum-jump-content forum-index-top forum-index-bottom">
				<?php echo $lang_admin['subscriptions_options_desc']; ?><br /><br />
<?php }elseif($template_hook=="14"){ ?>
				<div style="width: 70%; float: left;">
					<strong><?php echo "$upgrade_name"; ?></strong>
				</div>
				<div style="width: 30%; float: left;">
				
					<a href="<?php echo lb_link("index.php?page=admin&act=subscriptions&func=edit&id=$upgrade_id","admin/subscriptions/edit/$upgrade_id"); ?>">
						<img  src="<?php echo "$edit_icon_img"; ?>" alt="<?php echo $lang_admin['custom_edit']; ?>" />
					</a>
					
					<form method="post" action="<?php echo $lb_domain; ?>/index.php?page=admin&act=subscriptions">
					
						<input type="hidden" name="subscription_id" value="<?php echo $upgrade_id; ?>" />
						<input type="hidden" name="token_id" value="<?php echo $token_id; ?>" />
						<input type="hidden" name="<?php echo $token_name; ?>" value="<?php echo $token; ?>" />
						<input
							type="image"
							name="subscriptions_delete"
							value="1"
							style="border: none; margin: 0; width: auto; padding: 0;"
							src="<?php echo $delete_icon_img; ?>"
							alt="<?php echo $lang_admin['custom_delete']; ?>"
							onclick="javascript:return confirm('<?php echo $lang['topic_remove']; ?> (<?php echo $upgrade_name; ?>)')"
						/>
					
					</form>
				
				</div>
<?php }elseif($template_hook=="15"){ ?>
			</td></tr>
			<tr><td class="forum-index-stats-header forum-index-top" style="text-align: center;">
				<a class="submit-button img-money-add" href="<?php echo lb_link("index.php?page=admin&act=subscriptions&func=new","admin/subscriptions/new"); ?>"><?php echo $lang['button_add_subscription']; ?></a>
			</td></tr>
		</table>
		<table class="forum-index-forum-footer" cellpadding="0" cellspacing="0">
			<tr><td class="forum-index-forum-footer-contents"> </td></tr>
		</table>
<?php }elseif ($template_hook=='successCreated'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['subscriptions_created']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successUpdated'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['subscriptions_updated']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='successDeleted'){ ?>
		<div style="border:1px solid green;margin-bottom:20px;">	
			<div style="border:gray;background:#EFF1F3;color:green;padding:7px;font-size:14px">
				<img style="vertical-align: middle;"src="<?php echo $plus_img; ?>" alt="" />
				<?php echo $lang_admin['subscriptions_deleted']; ?>
			</div>
		</div>
<?php }elseif ($template_hook=='end'){ ?>
<?php } ?>