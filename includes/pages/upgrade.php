<?php
/*
+--------------------------------------------------------------------------
|  LayerBulletin
|  ========================================
|  By The LayerBulletin team
|  Released under the Artistic License 2.0
|  http://layerbulletin.com/
|  ========================================
|+--------------------------------------------------------------------------
|   upgrade.php - upgrade membership via Paypal subscription
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

$member_id = escape_string($_GET['member']);

template_hook("pages/upgrade.template.php", "start");

if ($my_id == '0'){

	lb_redirect("index.php?page=error&error=15","error/15");

}

if ($_GET['status']=='cancel'){

template_hook("pages/upgrade.template.php", "1");

}

elseif ($_GET['status']=='return'){

template_hook("pages/upgrade.template.php", "2");

}

elseif($_GET['status']=='paid'){



// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value) {
$value = urlencode(strip_slashes($value));
$req .= "&$key=$value";
}

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);

// assign posted variables to local variables
$item_name = $_POST['item_name'];
$business = $_POST['business'];
$item_number = $_POST['item_number'];
$payment_status = $_POST['payment_status'];
$mc_gross = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];
$receiver_email = $_POST['receiver_email'];
$receiver_id = $_POST['receiver_id'];
$quantity = $_POST['quantity'];
$num_cart_items = $_POST['num_cart_items'];
$payment_date = $_POST['payment_date'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$payment_type = $_POST['payment_type'];
$payment_status = $_POST['payment_status'];
$payment_gross = $_POST['payment_gross'];
$payment_fee = $_POST['payment_fee'];
$settle_amount = $_POST['settle_amount'];
$memo = $_POST['memo'];
$payer_email = $_POST['payer_email'];
$txn_type = $_POST['txn_type'];
$payer_status = $_POST['payer_status'];
$address_street = $_POST['address_street'];
$address_city = $_POST['address_city'];
$address_state = $_POST['address_state'];
$address_zip = $_POST['address_zip'];
$address_country = $_POST['address_country'];
$address_status = $_POST['address_status'];
$item_number = $_POST['item_number'];
$tax = $_POST['tax'];
$option_name1 = $_POST['option_name1'];
$option_selection1 = $_POST['option_selection1'];
$option_name2 = $_POST['option_name2'];
$option_selection2 = $_POST['option_selection2'];
$for_auction = $_POST['for_auction'];
$invoice = $_POST['invoice'];
$custom = $_POST['custom'];
$notify_version = $_POST['notify_version'];
$verify_sign = $_POST['verify_sign'];
$payer_business_name = $_POST['payer_business_name'];
$payer_id =$_POST['payer_id'];
$mc_currency = $_POST['mc_currency'];
$mc_fee = $_POST['mc_fee'];
$exchange_rate = $_POST['exchange_rate'];
$settle_currency  = $_POST['settle_currency'];
$parent_txn_id  = $_POST['parent_txn_id'];

// subscription specific vars

$subscr_id = $_POST['subscr_id'];
$subscr_date = $_POST['subscr_date'];
$subscr_effective  = $_POST['subscr_effective'];
$period1 = $_POST['period1'];
$period2 = $_POST['period2'];
$period3 = $_POST['period3'];
$amount1 = $_POST['amount1'];
$amount2 = $_POST['amount2'];
$amount3 = $_POST['amount3'];
$mc_amount1 = $_POST['mc_amount1'];
$mc_amount2 = $_POST['mc_amount2'];
$mc_amount3 = $_POST['mcamount3'];
$recurring = $_POST['recurring'];
$reattempt = $_POST['reattempt'];
$retry_at = $_POST['retry_at'];
$recur_times = $_POST['recur_times'];
$username = $_POST['username'];
$password = $_POST['password'];

//auction specific vars

$for_auction = $_POST['for_auction'];
$auction_closing_date  = $_POST['auction_closing_date'];
$auction_multi_item  = $_POST['auction_multi_item'];
$auction_buyer_id  = $_POST['auction_buyer_id'];


if (!$fp) {
// HTTP ERROR
} else {
fputs ($fp, $header . $req);
while (!feof($fp)) {
$res = fgets ($fp, 1024);
if (strcmp ($res, "VERIFIED") == 0) {
// check the payment_status is Completed
// check that txn_id has not been previously processed
// check that receiver_email is your Primary PayPal email
// check that payment_amount/payment_currency are correct
// process payment


// echo the response

if($txn_type=='subscr_failed'){
$query2 = "select UPGRADE_ID, UPGRADE_NAME, UPGRADE_FEATURES, UPGRADE_FROM, UPGRADE_TO, UPGRADE_COST, UPGRADE_CURRENCY, UPGRADE_PERIOD, UPGRADE_PERIOD_TWO, PAYPAL_EMAIL from {$db_prefix}group_upgrade WHERE UPGRADE_ID='$item_number'" ;
$result2 = mysql_query($query2) or die("upgrade.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$upgrade_id = strip_slashes($results2['UPGRADE_ID']);
$upgrade_name = strip_slashes($results2['UPGRADE_NAME']);
$upgrade_features = strip_slashes($results2['UPGRADE_FEATURES']);
$upgrade_from = strip_slashes($results2['UPGRADE_FROM']);
$upgrade_to = strip_slashes($results2['UPGRADE_TO']);
$upgrade_cost = strip_slashes($results2['UPGRADE_COST']);
$upgrade_currency = strip_slashes($results2['UPGRADE_CURRENCY']);
$upgrade_period = strip_slashes($results2['UPGRADE_PERIOD']);
$upgrade_period_two = strip_slashes($results2['UPGRADE_PERIOD_TWO']);
$paypal_email = strip_slashes($results2['PAYPAL_EMAIL']);
}

mysql_query("UPDATE {$db_prefix}members SET role = '$upgrade_from' WHERE role = '$upgrade_to' AND ID='$member_id'");

mysql_query("DELETE from {$db_prefix}group_upgrade_details WHERE member='$member_id' AND subscription='$upgrade_id'");

}

elseif ($txn_type=='subscr_cancel'){

$query2 = "select UPGRADE_ID, UPGRADE_NAME, UPGRADE_FEATURES, UPGRADE_FROM, UPGRADE_TO, UPGRADE_COST, UPGRADE_CURRENCY, UPGRADE_PERIOD, UPGRADE_PERIOD_TWO, PAYPAL_EMAIL from {$db_prefix}group_upgrade WHERE UPGRADE_ID='$item_number'" ;
$result2 = mysql_query($query2) or die("upgrade.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$upgrade_id = strip_slashes($results2['UPGRADE_ID']);
$upgrade_name = strip_slashes($results2['UPGRADE_NAME']);
$upgrade_features = strip_slashes($results2['UPGRADE_FEATURES']);
$upgrade_from = strip_slashes($results2['UPGRADE_FROM']);
$upgrade_to = strip_slashes($results2['UPGRADE_TO']);
$upgrade_cost = strip_slashes($results2['UPGRADE_COST']);
$upgrade_currency = strip_slashes($results2['UPGRADE_CURRENCY']);
$upgrade_period = strip_slashes($results2['UPGRADE_PERIOD']);
$upgrade_period_two = strip_slashes($results2['UPGRADE_PERIOD_TWO']);
$paypal_email = strip_slashes($results2['PAYPAL_EMAIL']);
}

// pre-0.8 check....
// if there is no entry in the upgrade table, downgrade right away
$query21 = "select MEMBER, SUBSCRIPTION, EXPIRES from {$db_prefix}group_upgrade WHERE MEMBER='$member_id' AND SUBSCRIPTION='$upgrade_id'" ;
$result21 = mysql_query($query21) or die("upgrade.php - Error in query: $query21");                                  
$num_results = mysql_num_rows($result21);

if ($num_results=='0'){
mysql_query("UPDATE {$db_prefix}members SET role = '$upgrade_from' WHERE role = '$upgrade_to' AND ID='$member_id'");
}

}

else{

$query2 = "select UPGRADE_ID, UPGRADE_NAME, UPGRADE_FEATURES, UPGRADE_FROM, UPGRADE_TO, UPGRADE_COST, UPGRADE_CURRENCY, UPGRADE_PERIOD, UPGRADE_PERIOD_TWO, PAYPAL_EMAIL from {$db_prefix}group_upgrade WHERE UPGRADE_ID='$item_number'" ;
$result2 = mysql_query($query2) or die("upgrade.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$upgrade_id = strip_slashes($results2['UPGRADE_ID']);
$upgrade_name = strip_slashes($results2['UPGRADE_NAME']);
$upgrade_features = strip_slashes($results2['UPGRADE_FEATURES']);
$upgrade_from = strip_slashes($results2['UPGRADE_FROM']);
$upgrade_to = strip_slashes($results2['UPGRADE_TO']);
$upgrade_cost = strip_slashes($results2['UPGRADE_COST']);
$upgrade_currency = strip_slashes($results2['UPGRADE_CURRENCY']);
$upgrade_period = strip_slashes($results2['UPGRADE_PERIOD']);
$upgrade_period_two = strip_slashes($results2['UPGRADE_PERIOD_TWO']);
$paypal_email = strip_slashes($results2['PAYPAL_EMAIL']);
}

if ($upgrade_period_two =='Y'){
$end_subscribe = ($upgrade_period_one * 365 * 24 * 60 * 60);
}
if ($upgrade_period_two =='M'){
$end_subscribe = ($upgrade_period_one * 30 * 24 * 60 * 60);
}
elseif ($upgrade_period_two =='W'){
$end_subscribe = ($upgrade_period_one * 7 * 24 * 60 * 60);
}

elseif ($upgrade_period_two =='D'){
$end_subscribe = ($upgrade_period_one * 1 * 24 * 60 * 60);
}

mysql_query("UPDATE {$db_prefix}members SET role = '$upgrade_to' WHERE role = '$upgrade_from' AND ID='$member_id'");

// if this is not an initial payment, we should just upgrade the time...
$query21 = "select MEMBER from {$db_prefix}group_upgrade_details WHERE SUBSCRIPTION='$upgrade_id' AND MEMBER='$member_id'" ;
$result21 = mysql_query($query21) or die("upgrade.php - Error in query: $query21") ;
$subscribe_update = mysql_num_rows($result21);                                  

if ($subscribe_update=='0'){
mysql_query("INSERT INTO {$db_prefix}group_upgrade_details (member, subscription, expires) VALUES ('$member_id', '$upgrade_id', '$end_subscribe')");
}
else{
mysql_query("UPDATE {$db_prefix}group_upgrade_details SET expires = '$end_subscribe' WHERE member='$member_id' AND subscription='$upgrade_id'");
}
}


}
elseif (strcmp ($res, "INVALID") == 0) {
// log for manual investigation

  }

}
fclose ($fp);
}


}
else{

template_hook("pages/upgrade.template.php", "3");

$query29 = "select UPGRADE_ID, UPGRADE_NAME, UPGRADE_FEATURES, UPGRADE_FROM, UPGRADE_TO, UPGRADE_COST, UPGRADE_CURRENCY, UPGRADE_PERIOD, UPGRADE_PERIOD_TWO, PAYPAL_EMAIL from {$db_prefix}group_upgrade WHERE UPGRADE_FROM='$role' ORDER BY UPGRADE_ID asc" ;
$result29 = mysql_query($query29) or die("upgrade.php - Error in query: $query29") ;                                  
while ($results29 = mysql_fetch_array($result29)){
$upgrade_id = strip_slashes($results29['UPGRADE_ID']);
$upgrade_name = strip_slashes($results29['UPGRADE_NAME']);
$upgrade_features = strip_slashes($results29['UPGRADE_FEATURES']);
$upgrade_from = strip_slashes($results29['UPGRADE_FROM']);
$upgrade_to = strip_slashes($results29['UPGRADE_TO']);
$upgrade_cost = strip_slashes($results29['UPGRADE_COST']);
$upgrade_currency = strip_slashes($results29['UPGRADE_CURRENCY']);
$upgrade_period = strip_slashes($results29['UPGRADE_PERIOD']);
$upgrade_period_two = strip_slashes($results29['UPGRADE_PERIOD_TWO']);
$paypal_email = strip_slashes($results29['PAYPAL_EMAIL']);

template_hook("pages/upgrade.template.php", "4");

}

template_hook("pages/upgrade.template.php", "5");

}

template_hook("pages/upgrade.template.php", "end");
?>