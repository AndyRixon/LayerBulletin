<?php
ob_start("ob_gzhandler");
/*
+--------------------------------------------------------------------------
|  LayerBulletin
|  ========================================
|  By The LayerBulletin team
|  Released under the Artistic License 2.0
|  http://layerbulletin.com/
|  ========================================
|+--------------------------------------------------------------------------
|   uploader.php - script that does the uploading of files

*/

define("LB_RUN", 1);

// Best to include the config file..
include "../includes/config.php";

$my_address="http://".$_SERVER['HTTP_HOST']."".$_SERVER['PHP_SELF'];

$lb_domain 	= str_replace('/uploads/uploader.php', '', $my_address); 	// returns http://myforum.com/forum style address


global $db_prefix;

include "../scripts/php/functions.php";

$lb_name=$_COOKIE['lb_name'];
$lb_password=$_COOKIE['lb_password'];

$lb_name=escape_string($lb_name);
$lb_password=escape_string($lb_password);

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
else{

$query211 = "select THEME, ATTACH_IMG_SIZE, ATTACH_AVATAR_SIZE from {$db_prefix}settings" ;
$result211 = mysql_query($query211) or die("Query failed") ;                                  
while ($results211 = mysql_fetch_array($result211)){
$theme = $results211['THEME'];
$attach_img_size = $results211['ATTACH_IMG_SIZE'];
$attach_avatar_size = $results211['ATTACH_AVATAR_SIZE'];
}

echo "<html style='overflow: hidden; border: none;'>";
echo "<head>";
if ($theme!='layerbulletin_default'){
	echo "<link rel='stylesheet' href='$lb_domain/themes/layerbulletin_default/stylesheet.css' type='text/css'>";
}
echo "<link rel='stylesheet' href='$lb_domain/themes/$theme/stylesheet.css' type='text/css'>";

echo "</head>";
echo "<body style='overflow: hidden; margin-top: 0px;'>";
echo "<div class='upload'>";

// Right.. are they allowed to upload this file type?

// Give it some values for max size for files...
$attachtype = $_POST['attachtype'];
$attachtype = escape_string($attachtype);
if ($attachtype=='attachments'){
$size=$attach_img_size;
}
elseif($attachtype=='avatar'){
$size=$attach_avatar_size;
}
else{
echo "Sorry, wrong attachment area.";
exit();
}

$contenttype = $_FILES['uploadedfile']['type'];

$file=$_FILES['uploadedfile']['name'];

$parts = explode(".",$file);
$ext = $parts[count($parts)-1];
$contenttype = strtolower($ext);

if ($contenttype=='zip'){
if ($attachtype=='avatar'){
$allowed="0";
}
else{
$allowed="1";
}
$image="no";

$findme   = '.php.';
$pos = strpos($file, $findme);

if ($pos=== false){
$allowed="1";
}
else{
$allowed="0";
}

}
elseif ($contenttype=='rar'){
if ($attachtype=='avatar'){
$allowed="0";
}
else{
$allowed="1";
}
$image="no";

$findme   = '.php.';
$pos = strpos($file, $findme);

if ($pos=== false){
$allowed="1";
}
else{
$allowed="0";
}

}
elseif ($contenttype=='png'){
$findme   = '.php.';
$pos = strpos($file, $findme);

if ($pos=== false){
$allowed="1";
}
else{
$allowed="0";
}
$image="yes";
}
elseif ($contenttype=='jpg'){
$findme   = '.php.';
$pos = strpos($file, $findme);

if ($pos=== false){
$allowed="1";
}
else{
$allowed="0";
}
$image="yes";
}
elseif ($contenttype=='jpeg'){
$findme   = '.php.';
$pos = strpos($file, $findme);

if ($pos=== false){
$allowed="1";
}
else{
$allowed="0";
}
$image="yes";
}
elseif ($contenttype=='gif'){
$findme   = '.php.';
$pos = strpos($file, $findme);

if ($pos=== false){
$allowed="1";
}
else{
$allowed="0";
}
$image="yes";
}
else{
$allowed="0";
}
if ($allowed=='0'){

exit("<br /><br />You are not allowed to upload files with this extension. Please upload a file with a valid extension");
}
else{

// Where the file is going to be placed 
$target_path = "$attachtype/";
$thumb_target = $target_path;

// Y'know, we should rename the file so that it doesn't
// clash with a file that is already uploaded.

$file_name = $_FILES['uploadedfile']['name'];

$file_name = strtolower($file_name);

// remove apostrophe or Windows will take a fit
$file_name = str_replace("'", "", $file_name);

$memberid=$my_id;
$hash=$_POST['hash'];
$hash=escape_string($hash);
$file_time = time();

$new_file_name="$memberid-$file_time.$contenttype";

/* Add the original filename to our target path.  
Result is "uploads/filename.extension" */
$target_path = $target_path . basename( $new_file_name); 
$_FILES['uploadedfile']['tmp_name'];  

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {


if ($image=='yes'){

			/*
			 * let's start by identifying the image type. No doubt the more efficient way
			 * is to use string functions but who cares?
			 */

			$target_path=$thumb_target;
			 
			$parts	= explode('.', $new_file_name);
			$ext	= $parts[count($parts)-1];

			$thumb_name = array_slice($parts,0,count($parts)-1);
			
			$ext = strtolower($ext);

			switch($ext)
			{
				case "jpg";
					$src_img=ImageCreateFromJpeg("$target_path/$new_file_name");
					$thumb_name = join(".",$thumb_name) .  ".jpg";
					$thumb_name="t_$thumb_name";
					break;

				case "jpeg";
					$src_img=ImageCreateFromJpeg("$target_path/$new_file_name");
					$thumb_name = join(".",$thumb_name) .  ".jpeg";
					$thumb_name="t_$thumb_name";
					break;

				case "gif":
					$src_img=ImageCreateFromGif("$target_path/$new_file_name");
					$thumb_name = join(".",$thumb_name) .  ".gif";
					$thumb_name="t_$thumb_name";
					break;		
					
				case "png":
					$src_img=ImageCreateFromPng("$target_path/$new_file_name");
					imagesavealpha($src_img,true) ;
					$thumb_name = join(".",$thumb_name) .  ".png";
					$thumb_name="t_$thumb_name";
					break;
					
			}
			
			/* get it's height and width */
			$imgSx = imagesx($src_img);
			$imgSy = imagesy($src_img);

			if($imgSy != 0)
			{
				/* 
				* lets calculate the aspect ratio and the height
				* and width for the scaled image.
				*/

				$ratio = $imgSx/$imgSy;
				
				if (($imgSx - $size) <= '0'){

					$new_imgSx = $imgSx;
					$new_imgSy = $imgSy;
				
				}
				
				elseif($ratio > 1)
				{

					$new_imgSx = $size;
					$new_imgSy = $size/$ratio;
				}
				else
				{

					$new_imgSx = (float) $size * $ratio;
					$new_imgSy = $size;

				}


				$dst_img=imagecreatetruecolor($new_imgSx,$new_imgSy);
				imagealphablending($dst_img, false);

				/* create the scaled instance */

				ImageCopyResampled($dst_img,$src_img,0,0,0,0,$new_imgSx,$new_imgSy,$imgSx,$imgSy);
				imagesavealpha($dst_img, true);
				/* write the damned thing to disk */
				if($ext == "jpg" OR $ext=="jpeg")
				{
					imageJpeg($dst_img,"$target_path/$thumb_name");				
				}
				elseif($ext == "gif")
				{
					imagecolortransparent($dst_img, black);
					imageGif($dst_img,"$target_path/$thumb_name");				
				}
				else
				{

					imagePng($dst_img,"$target_path/$thumb_name");				
				}
				
			}

			imagedestroy($src_img);
			imagedestroy($dst_img);
}

// Sneakily tell them the name of the original file so they can't try
// and hotlink it...

if ($attachtype=='avatar'){

// delete previous avatar info in database
// and delete the avatar itself

$query2121 = "select FILENAME from {$db_prefix}attachments WHERE POSTID='0' AND MEMBER='$memberid'" ;
$result2121 = mysql_query($query2121) or die("uploader.php - Error in query: $query2121") ;                                  
while ($results2121 = mysql_fetch_array($result2121)){
$filename = $results2121['FILENAME'];

foreach (glob("avatar/$filename") as $filename_original) {
   unlink($filename_original);
}

foreach (glob("avatar/t_$filename") as $filename_thumb) {
   unlink($filename_thumb);
}

mysql_query("DELETE FROM {$db_prefix}attachments WHERE filename ='$filename'");

}

}

// Get the filesize...

$filesize=$_FILES['uploadedfile']['size'];

// And add the info to the database...
mysql_query("INSERT INTO {$db_prefix}attachments (filename, filesize, original_filename, hash, member) VALUES ('$new_file_name', '$filesize', '$file_name', '$hash', '$my_id')");

if ($attachtype=='avatar'){

        if (strpos($new_file_name, ".gif")!==false){
			$avatar="$new_file_name";
		}
		
		else{
			$avatar="t_$new_file_name";
		}
		
		
		
$avatar="uploads/avatar/$avatar";

mysql_query("UPDATE {$db_prefix}members SET avatar='$avatar', remote_avatar='0' WHERE id = '$memberid'");
}

// MESSAGE IN HERE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!


	header("HTTP/1.0 200 OK");
	header("Location: $lb_domain/uploads/upload.php?topicid=$topicid&attachtype=$attachtype&member=$my_id&hash=$hash");
	exit;


} else{
    echo "There was an error uploading the file, please try again!";
}
}

echo "</div>";
echo "</body>";
echo "</html>";
mysql_close();
ob_flush();
}
?>