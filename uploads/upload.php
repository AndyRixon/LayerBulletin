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
|   upload.php - Shows avatar & attachment upload forms.

*/

define("LB_RUN", 1);

error_reporting(0);

// Best to include the config file..
include "../includes/config.php";
include "../scripts/php/functions.php";

$my_address="http://".$_SERVER['HTTP_HOST']."".$_SERVER['PHP_SELF'];

$lb_domain 	= str_replace('/uploads/upload.php', '', $my_address); 	// returns http://myforum.com/forum style address


global $db_prefix;

if (isset($_COOKIE['lb_name'])){

	$lb_name = escape_string($_COOKIE['lb_name']);
	$lb_name = str_replace("'", "", $lb_name);

	if (!preg_match('|^[a-zA-Z0-9!@#$%^&*();:_.\\\\ /\t-]+$|', $lb_name) ) {
	
		setcookie("lb_name", $name, time() -1);
		setcookie("lb_password", $password, time() -1);

		lb_redirect("index.php?page=error&error=32","error/32");

	}
	
$lb_password=$_COOKIE['lb_password'];
$lb_password=escape_string($lb_password);	

}

// if the user is logged in, let's get their ID, and if that doesn't work, return an error....
$query211 = "select ID, BANNED from {$db_prefix}members WHERE name='$lb_name' AND password='$lb_password'" ;
$result211 = mysql_query($query211) or die("Query failed"); 
$id_count = mysql_num_rows($result211);                                 
while ($results211 = mysql_fetch_array($result211)){
$my_id = $results211['ID'];
$banned = $results211['BANNED'];
}

if ($my_id < '1' OR $banned=='1' OR !isset($lb_name) OR $id_count!='1'){

echo "You can't upload files without being logged in.";
exit();
}

$query_theme = "select THEME, BOARD_LANG, ATTACH_AVATAR_SIZE from {$db_prefix}settings" ;
$result_theme = mysql_query($query_theme) or die("Query failed") ;                                  
while ($results_theme = mysql_fetch_array($result_theme)){
$theme = $results_theme['THEME'];
$board_lang = $results_theme['BOARD_LANG'];
$attach_avatar_size = $results_theme['ATTACH_AVATAR_SIZE'];
}

if (isset($_COOKIE['lb_theme'])){
$member_selected_theme=escape_string($_COOKIE['lb_theme']);
}

$query_theme = "select THEME from {$db_prefix}members WHERE NAME='$lb_name'" ;
$result_theme = mysql_query($query_theme) or die("structure.php - Error in query: $query_theme") ;                                  
$member_selected_theme = mysql_result($result_theme, 0);

// check theme is available to use,,,,

$query_theme = "select THEME_NAME from {$db_prefix}themes WHERE THEME_NAME='$member_selected_theme'" ;
$result_theme = mysql_query($query_theme) or die("structure.php - Error in query: $query_theme") ;                                  
$check_theme = mysql_num_rows($result_theme);

if ($check_theme!='0' && $member_selected_theme!=''){
	$theme = $member_selected_theme;
}

$topicid = escape_string($_GET['topicid']);
$attachtype=escape_string($_GET['attachtype']);
$hash=escape_string($_GET['hash']);

// and the images
include "../scripts/php/image_check.php";

$get_id=escape_string($_GET['member']);

$query_member_stuff = "select BOARD_LANG from {$db_prefix}members WHERE ID ='$get_id'" ;
$result_member_stuff = mysql_query($query_member_stuff) or die("header.php - Error in query: $query_member_stuff") ;
$secure = mysql_num_rows ($result_member_stuff); 

if ($secure!='0'){
                                 
$member_lang = mysql_result($result_member_stuff, 0);

}

echo "<html style='overflow: hidden; border: none;'>";
echo "<head>";

if (!isset($board_lang)){
	$board_lang="english_en";
}
else{
	$board_lang="english_en";
}

if (isset($member_lang) && $member_lang!=''){
	$board_lang="$member_lang";
}

// Do you speekee english?
	if (isset($_COOKIE['lb_lang']) && (!isset($_COOKIE['lb_name']))){
		$board_lang = escape_string($_COOKIE['lb_lang']);
		
		if (!file_exists("../lang/$board_lang/lang_forum.php")){
			$board_lang = "english_en";
		}
		
	}

// include the language...	
include "../lang/$board_lang/lang_forum.php";

?>

<!-- Set Javascript function to make animation appear onsubmit -->	
<script type="text/javascript">
function form_submit() {
	var load = document.getElementById('loadbg');
	//document.form1.submit();
	load.style.display = 'block';
	load.src = '<?php echo $working_img; ?>';
	}

</script>


<?php
if ($theme!='layerbulletin_default'){
echo "<link rel='stylesheet' href='$lb_domain/themes/layerbulletin_default/stylesheet.css' type='text/css'>";
}
echo "<link rel='stylesheet' href='$lb_domain/themes/$theme/stylesheet.css' type='text/css'>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />"; 
echo "</head>";
echo "<body style='overflow: hidden; margin: 0px;'>";
echo "<div class='upload'>";

$attachtype=escape_string($_GET['attachtype']);

if (isset($_GET['id'])){
// Delete the attachment, then return form back to start..

$lb_name=$_COOKIE['lb_name'];
$lb_password=$_COOKIE['lb_password'];

$lb_name=escape_string($lb_name);
$lb_password=escape_string($lb_password);

// if the user is logged in, let's get their ID, and if that doesn't work, return an error....
$query211 = "select ID from {$db_prefix}members WHERE name='$lb_name' AND password='$lb_password'" ;
$result211 = mysql_query($query211) or die("Query failed") ;                                  
$member = mysql_result($result211, 0);

$id=$_GET['id'];
$id=escape_string($id);

$query2121 = "select FILENAME from {$db_prefix}attachments WHERE ROW='$id'" ;
$result2121 = mysql_query($query2121) or die("upload.php - Error in query: $query2121") ;                                  
while ($results2121 = mysql_fetch_array($result2121)){
$filename = $results2121['FILENAME'];

foreach (glob("attachments/$filename") as $filename_original) {
   unlink($filename_original);
}

foreach (glob("attachments/t_$filename") as $filename_thumb) {
   unlink($filename_thumb);
}
}

mysql_query("DELETE FROM {$db_prefix}attachments WHERE row ='$id'");

echo "<meta http-equiv=\"refresh\" content=\"0;url=$lb_domain/uploads/upload.php?topicid=$topicid&attachtype=$attachtype&hash=$hash\" />";
echo "</div>";


}
else{

	/*
	Get user's id
*/

	$query = mysql_query('SELECT id FROM ' . $db_prefix . 'members WHERE name = "' . $lb_name . '" AND password = "' . $lb_password . '"');
	$result = mysql_fetch_assoc($query);
	
		$member = $result['id'];

// if they uploaded, they'll have been redirected back here,
// so obviously they uploaded already!

// Let's show their file info here...

echo "<form method='post' name='form1' action='upload.php'>";

// if this is an avatar, show avatar :)

if ($_GET['attachtype']=='avatar'){
// Grab member info...
$query211 = "select AVATAR, REMOTE_AVATAR from {$db_prefix}members WHERE ID='$member'" ;
$result211 = mysql_query($query211) or die("Query failed"); 
$avatar_check = mysql_num_rows($result211);
if ($avatar_check!='0'){                                 
while ($results211 = mysql_fetch_array($result211)){
	$avatar	= $results211['AVATAR'];
	$remote_avatar	= $results211['REMOTE_AVATAR'];	
	
	if ($remote_avatar =='0'){
		$avatar = $lb_domain."/".$avatar;
	}
	
}
}
else{
$avatar="";
}

if ($avatar=='' OR $avatar==$lb_domain){
$avatar = $default_avatar;
}

echo "<div class='center'><img style='max-width: $attach_avatar_size;' src='$avatar' alt='' /><br /><br /></div>";
}

if ($_GET['attachtype']=='avatar'){
}
else{
?>
<div style="width: 50%; float: left; text-align: left;">
<select name="fileselect" onchange="form_submit(); location.href='<?php echo "$lb_domain"; ?>/uploads/upload.php?&downloadselect=1&topicid=<?php echo "$topicid"; ?>&attachtype=<?php echo "$attachtype"; ?>&member=<?php echo "$member"; ?>&hash=<?php echo "$hash"; ?>&id='+escape(this.options[this.selectedIndex].value)">
<?php


echo "<option value=''>".$lang['upload_option']."</option>";

$query211 = "select ORIGINAL_FILENAME, FILESIZE, ROW from {$db_prefix}attachments WHERE hash='$hash' ORDER BY ORIGINAL_FILENAME desc" ;
$result211 = mysql_query($query211) or die("Query failed2") ;
while ($results211 = mysql_fetch_array($result211)){
$original_filename = $results211['ORIGINAL_FILENAME'];
$row = $results211['ROW'];
$filesize = $results211['FILESIZE'];

if ($filesize < 1024){
$filesize = "$filesize bytes";
}
elseif ($filesize < 1048576){
$filesize = $filesize/1024;
$filesize = round($filesize,2);
$filesize = $filesize."kb";
}
else{
$filesize = $filesize/1048576;
$filesize = round($filesize,2);
$filesize = $filesize."mb";
}

if ($filesize!='0'){

echo "<option value='$row'>".$lang['upload_remove']." $original_filename ($filesize)</option>";

}
else{
echo "<option value='$row'>".$lang['upload_remove']." $original_filename</option>";
}
}
echo "</select>";
?>
</div>
<div style="width: 50%; float: left; text-align: right;">

<script type="text/javascript">
function type_select() {

val = document.form1.fileadd.options[document.form1.fileadd.selectedIndex].value; 
textbox = parent.document.postcontent.content; 
	
	//IE support
	if (document.selection) {
		textbox.focus();
		sel = document.selection.createRange();
		sel.text = val;
		textbox.focus();
	}
	//MOZILLA/NETSCAPE support
	else if (textbox.selectionStart || textbox.selectionStart == '0') {
		var startPos = textbox.selectionStart;
		var endPos = textbox.selectionEnd;
		var scrollTop = textbox.scrollTop;
		textbox.value = textbox.value.substring(0, startPos)
		              + val 
                      + textbox.value.substring(endPos, textbox.value.length);
		textbox.focus();
		textbox.selectionStart = startPos + val.length;
		textbox.selectionEnd = startPos + val.length;
		textbox.scrollTop = scrollTop;
	} else {
		textbox.value += val;
		textbox.focus();
	}
		
}
</script>


<select name="fileadd" onchange="type_select()">

<?php

echo "<option value=''>".$lang['upload_add']."</option>";

$query211 = "select ORIGINAL_FILENAME, FILESIZE, ROW from {$db_prefix}attachments WHERE hash='$hash' ORDER BY ORIGINAL_FILENAME desc" ;
$result211 = mysql_query($query211) or die("Query failed2") ;
while ($results211 = mysql_fetch_array($result211)){
$original_filename = $results211['ORIGINAL_FILENAME'];
$row = $results211['ROW'];

echo "<option value='[attachment=$row]'>".$lang['upload_insert']." $original_filename [$row]</option>";

}
?>
</select>
</div>
<?php
}

echo "</form>";

if($_GET['attachtype']=='avatar'){
echo "<table style='width: 100%;'>";
echo "<tr>";
echo "<td style='font-size: 12px; vertical-align: bottom; width: 80%;'>";
echo "<form enctype='multipart/form-data' method='post' action='uploader.php'>";
echo "<input type='hidden' name='MAX_FILE_SIZE' value='100000000000' />";
echo "<input type='hidden' name='topicid' value='$topicid' />";
echo "<input type='hidden' name='member' value='$get_id' />";
echo "<input type='hidden' name='attachtype' value='$attachtype' />";
echo "<input type='hidden' name='hash' value='$hash' />";
echo "<div class='center'>";

echo "<input type='file' style='width: auto;' name='uploadedfile'>";

echo "&nbsp;<input type='submit' class='submit-button img-upload' onClick=\"form_submit();\" value='$lang[button_upload]' /></div>";


echo "</td>";
echo "<td style='width: 20%;'> </td></tr>";
echo "</form>";
echo "</table>";
}else{

echo "<div class='spacer'>&nbsp;</div>";

echo "<table style='width: 100%; height: 22px;' cellspacing='0' cellpadding='0'>";
echo "<tr>";
echo "<td style='font-size: 12px;'>Attach:</td>";
echo "<td style='font-size: 12px;'>";
echo "<form enctype='multipart/form-data' method='post' action='uploader.php'>";
echo "<input type='hidden' name='MAX_FILE_SIZE' value='100000000000' />";
echo "<input type='hidden' name='topicid' value='$topicid' />";
echo "<input type='hidden' name='member' value='$get_id' />";
echo "<input type='hidden' name='attachtype' value='$attachtype' />";
echo "<input type='hidden' name='hash' value='$hash' />";

echo "<input type='file' style='width: auto;' name='uploadedfile'>";

echo "&nbsp;<input type='submit' class='submit-button img-upload' onClick=\"form_submit();\" value='$lang[button_upload]' /></div>";


echo "</td></tr>";
echo "</form>";
echo "</table>";
}

}


echo "</div>";

?>

<div id="loadbg">
<div id="loadbox"><div class="upload-box"><br /><br /><?php echo $lang['upload_box']; ?></div></div>

<?php

echo "</body>";
echo "</html>";

?>