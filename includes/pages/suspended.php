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
|   suspended.php - display message to a temporarily suspended member
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/suspended.template.php", "start");

$query3 = "select SUSPEND_DATE from {$db_prefix}members WHERE ID='$my_id'" ;
$result3 = mysql_query($query3) or die("suspended.php - Error in query: $query3") ;                                  
$suspend_date = mysql_result($result3, 0);

template_hook("pages/suspended.template.php", "1");

$offset= $time_offset;
$time = $suspend_date + ($offset * 60 * 60);

// $time = date('l, M jS, Y H:i', $time); 

$time = date('Y,n-1,d,H,i,s', $time);

?>
<SCRIPT TYPE="text/javascript" LANGUAGE="JavaScript">
<!-- //start

// format: dateFuture = new Date(year,month-1,day,hour,min,sec)
// example: dateFuture = new Date(2003,03,26,14,15,00) = April 26, 2003 - 2:15:00 pm

dateFuture = new Date(<?php echo "$time"; ?>);

// TESTING: comment out the line below to print out the "dateFuture" for testing purposes
//document.write(dateFuture +"<br />");


//###################################
//nothing beyond this point
function GetCount(){

	dateNow = new Date();									//grab current date
	amount = dateFuture.getTime() - dateNow.getTime();		//calc milliseconds between dates
	delete dateNow;

	// time is already past
	if(amount < 0){
		document.getElementById('countbox').innerHTML="<?php echo $lang['suspended_complete']; ?>";
	}
	// date is still good
	else{
		days=0;hours=0;mins=0;secs=0;out="";

		amount = Math.floor(amount/1000);//kill the "milliseconds" so just secs

		days=Math.floor(amount/86400);//days
		amount=amount%86400;

		hours=Math.floor(amount/3600);//hours
		amount=amount%3600;

		mins=Math.floor(amount/60);//minutes
		amount=amount%60;

		secs=Math.floor(amount);//seconds

		if(days != 0){out += days +" day"+((days!=1)?"s":"")+", ";}
		if(days != 0 || hours != 0){out += hours +" hour"+((hours!=1)?"s":"")+", ";}
		if(days != 0 || hours != 0 || mins != 0){out += mins +" minute"+((mins!=1)?"s":"")+", ";}
		out += secs +" seconds";
		document.getElementById('countbox').innerHTML=out;

		setTimeout("GetCount()", 1000);
	}
}

window.onload=function(){GetCount();}//call when everything has loaded

//-->
</script>
<?php

template_hook("pages/suspended.template.php", "2");

template_hook("pages/suspended.template.php", "end");

?>