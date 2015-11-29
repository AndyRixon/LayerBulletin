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
|   word_censor.php - censor words from filter list
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

// Get words...

$query2116 = "select WORD, NEW_WORD from {$db_prefix}censor" ;
$result2116 = mysql_query($query2116) or die("word_censor.php - Error in query: $query2116") ;                                  
while ($results2116 = mysql_fetch_array($result2116)){
$word = $results2116['WORD'];
$new_word = $results2116['NEW_WORD'];



$content=str_replace($word, $new_word, $content);
}
?>
