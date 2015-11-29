<?php
/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By LayerBulletin Team
|   (c) 2014 LayerBulletin Team
|   http://layerbulletin.com/
|   ========================================
|   smilies.php - set emoticons to use in forum posts
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/admin/smilies.template.php", "start");

if($_GET['success']=="saved") {
	template_hook("pages/admin/smilies.template.php", "successSaved");
}

if ($can_change_forum_settings=='0'){

	lb_redirect("index.php?page=error&error=11","error/11");

}

else{

if ($_POST['form']!=''){

$location=escape_string($_POST['location']);

$location = str_replace(" ", "%20", $location);

$token_id = escape_string($_POST['token_id']);


$token_name = "token_smilies_$location$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

$location=str_replace("%20", " ",$location);

// First.. remove what was there already...

mysql_query("DELETE FROM {$db_prefix}smilies WHERE THEME='$location'");

// Now loop and add in the new details..

// How many images were in the directory?
$last = (int) $_POST['total_files'];

for ($counter = 1; $counter <= $last; ++$counter)
{
	$emoticon_on	= 'emoticon_on' . $counter;
	$emoticon		= 'emoticon' . $counter;
	$file			= 'file' . $counter;
	
	$emoticon_on	= (int) $_POST[$emoticon_on];
	$emoticon		= escape_string($_POST[$emoticon]);
	$file			= escape_string($_POST[$file]);
	
	mysql_query("INSERT INTO {$db_prefix}smilies (code, link, emoticon_on, theme) VALUES ('$emoticon', '$file', '$emoticon_on', '$location')");
}

#Delete current smilie cache to cause a re-cache
$Cache->delete('emoticons_' . $location);

template_hook("pages/admin/smilies.template.php", "form");
lb_redirect("index.php?page=admin&act=smilies&success=saved","admin/smilies/success/saved");

}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}

}
elseif (isset($_GET['location'])){


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$location=escape_string($_GET['location']);

$location = str_replace(" ", "%20", $location);

$token_name = "token_smilies_$location$token_id";

$_SESSION[$token_name] = $token;

template_hook("pages/admin/smilies.template.php", "2");

// Set smiley count to zero..

$smiley_count="0";

$location=str_replace("%20", " ",$location);

function list_emos($dir)
{
	global $theme, $lb_domain, $db_prefix, $emoticon_path, $location, $board_lang, $smiley_count;

	if(is_dir($dir))
	{
		if($handle = opendir($dir))
		{
			while(($emoticon_file = readdir($handle)) !== false)
			{
				if($emoticon_file != "Thumbs.db" && $emoticon_file != "index.html" /*pesky windows, images..*/)
				{
					$code="";
					$link="";
					$emoticon_on="0";

					if ($location=='default')
					{
						$query34 = "select CODE, LINK, EMOTICON_ON from {$db_prefix}smilies WHERE LINK='$emoticon_file' AND THEME='default'";
					}
					else
					{
						$query34 = "select CODE, LINK, EMOTICON_ON from {$db_prefix}smilies WHERE LINK='$emoticon_file' AND THEME='$location'";
					}
					
					$result34			= mysql_query($query34) or die("smilies.php - Error in query: $query34") ;
					$check_any_exist	= mysql_num_rows($result34);
					$results34			= mysql_fetch_assoc($result34);

					if ($check_any_exist=='1')
					{
						$emoticon_code = $results34['CODE'];
						$emoticon_link = $results34['LINK'];
						$emoticon_on = $results34['EMOTICON_ON'];

						if ($emoticon_link!='')
						{
							if ($emoticon_file!="." && $emoticon_file!="..")
							{
								global $emoticon_file, $emoticon_code, $emoticon_link, $emoticon_on;
								
								$smiley_count=$smiley_count+1;
								template_hook("pages/admin/smilies.template.php", "3");
							}
						}
					}
					else
					{
						if ($emoticon_file != '')
						{
							if ($emoticon_file!="." && $emoticon_file!="..")
							{
								global $emoticon_file, $emoticon_code, $emoticon_link, $emoticon_on;
								
								$smiley_count=$smiley_count+1;
								template_hook("pages/admin/smilies.template.php", "4");
							}
						}
					}
				}
			}

			global $file, $link, $emoticon_on, $code;	

			$smiley_count=$smiley_count+1;  
	  
			template_hook("pages/admin/smilies.template.php", "5");

			closedir($handle);
		}
	}
}
$theme=str_replace("%20"," ",$theme);

$location=escape_string($_GET['location']);
$location=str_replace("%20", " ", $location);
$emoticon_path = "themes/$location/images/forums/emoticons";

if ($location=='default'){
$emoticon_path="images/forums/emoticons";
}

list_emos("$emoticon_path");

template_hook("pages/admin/smilies.template.php", "6");

}

else{

// select theme here
function list_themes_emos($dir){

global $lb_domain, $board_lang, $db_prefix;

  if(is_dir($dir)){
    if($handle = opendir($dir)){
      while(($file = readdir($handle)) !== false){
        if($file != "." && $file != ".." && $file != "Thumbs.db" && $file!="index.html" /*pesky windows, images..*/){

		if (file_exists("themes/$file/images/forums/emoticons")){
		
	$query34 = "select DISPLAY_NAME from {$db_prefix}themes WHERE THEME_NAME='$file'";
	$result34 = mysql_query($query34) or die("smilies.php - Error in query: $query34") ;
	$display_name=strip_slashes(mysql_result($result34, 0));	
		
				echo "<option value='$file'>$display_name</option>";
			}

		}
	  }
	}
      closedir($handle);
  }
}

$location = str_replace(" ", "%20", $location);

template_hook("pages/admin/smilies.template.php", "7");

}

}

template_hook("pages/admin/smilies.template.php", "end");
?>