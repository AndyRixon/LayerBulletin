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
|   vote.php - vote in a poll in a topic
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

		// PERMISSIONS!!! Can they view this forum???

		$can_reply_topics="0";

		$topic = (int) $_GET['topic'];

		$query3 = "select FORUM_ID from {$db_prefix}posts WHERE TOPIC_ID='$topic'" ;
		$result3 = mysql_query($query3) or die("vote.php - Error in query: $query3") ;                                  
		$forum_id = mysql_result($result3, 0);

		$query3 = "select CAN_VIEW_FORUM, CAN_READ_TOPICS, CAN_ADD_TOPICS, CAN_REPLY_TOPICS from {$db_prefix}permissions WHERE GROUP_ID='$role' AND FORUM_ID='$forum_id'" ;
		$result3 = mysql_query($query3) or die("vote.php - Error in query: $query3") ;                                  
		$can_reply_topics = mysql_result($result3, 0);

		$poll_id = (int) $_POST['poll_id'];

		$query_voted = "select VOTE_ID from {$db_prefix}polls_votes WHERE USER_ID='$my_id' AND POLL_ID='$poll_id'" ;
		$result_voted = mysql_query($query_voted) or die("vote.php - Error in query: $query_voted");      

		$voted = mysql_num_rows($result_voted);

if ($can_reply_topics=='0'){

	lb_redirect("index.php?page=error&error=1","error/1");

}
elseif ($voted==1){

	lb_redirect("index.php?page=error&error=39","error/39");

}
else{

// Get info..

// Insert the values into the database (obviously)

// Get the type of poll...

$query21 = "select POLL_TYPE from {$db_prefix}polls WHERE ID='$poll_id'" ;
$result21 = mysql_query($query21) or die("vote.php - Error in query: $query21") ;                                  
$poll_type = mysql_result($result21, 0);

if ($poll_type=='0'){

$option = (int) $_POST['option'];

mysql_query("INSERT INTO {$db_prefix}polls_votes (poll_id, user_id, vote) VALUES ('$poll_id', '$my_id', '$option')");

}
else{

$option1 = (int) $_POST['option1'];

if ($option1!=''){
mysql_query("INSERT INTO {$db_prefix}polls_votes (poll_id, user_id, vote) VALUES ('$poll_id', '$my_id', '$option1')");
}

$option2 = (int) $_POST['option2'];

if ($option2!=''){
mysql_query("INSERT INTO {$db_prefix}polls_votes (poll_id, user_id, vote) VALUES ('$poll_id', '$my_id', '$option2')");
}

$option3 = (int) $_POST['option3'];

if ($option3!=''){
mysql_query("INSERT INTO {$db_prefix}polls_votes (poll_id, user_id, vote) VALUES ('$poll_id', '$my_id', '$option3')");
}

$option4 = (int) $_POST['option4'];

if ($option4!=''){
mysql_query("INSERT INTO {$db_prefix}polls_votes (poll_id, user_id, vote) VALUES ('$poll_id', '$my_id', '$option4')");
}

$option5 = (int) $_POST['option5'];

if ($option5!=''){
mysql_query("INSERT INTO {$db_prefix}polls_votes (poll_id, user_id, vote) VALUES ('$poll_id', '$my_id', '$option5')");
}

$option6 = (int) $_POST['option6'];

if ($option6!=''){
mysql_query("INSERT INTO {$db_prefix}polls_votes (poll_id, user_id, vote) VALUES ('$poll_id', '$my_id', '$option6')");
}

$option7 = (int) $_POST['option7'];

if ($option7!=''){
mysql_query("INSERT INTO {$db_prefix}polls_votes (poll_id, user_id, vote) VALUES ('$poll_id', '$my_id', '$option7')");
}

$option8 = (int) $_POST['option8'];

if ($option8!=''){
mysql_query("INSERT INTO {$db_prefix}polls_votes (poll_id, user_id, vote) VALUES ('$poll_id', '$my_id', '$option8')");
}

$option9 = (int) $_POST['option9'];

if ($option9!=''){
mysql_query("INSERT INTO {$db_prefix}polls_votes (poll_id, user_id, vote) VALUES ('$poll_id', '$my_id', '$option9')");
}

$option10 = (int) $_POST['option10'];

if ($option10!=''){
mysql_query("INSERT INTO {$db_prefix}polls_votes (poll_id, user_id, vote) VALUES ('$poll_id', '$my_id', '$option10')");
}

}
// And now return them back to whence they came!


$topic = (int) $_GET['topic'];

	template_hook("forums/vote.template.php", "form");

	$topic_title = topic_title($topic);	
	
	lb_redirect("index.php?topic=$topic","topic/$topic_title-$topic");

}
?>