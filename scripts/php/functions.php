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
|   functions.php - This holds PHP functions for LayerBulletin
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

// if this file exists in a theme folder, then use it, otherwise run the below code...
if (!isset($theme)){
	$theme = "layerbulletin_default";
}
if (file_exists("themes/$theme/scripts/php/functions.php")){
	include "themes/$theme/scripts/php/functions.php";
}
else{

	///////////////////////////////////////////////////

	// Latin character SEO

	function clean_url_seo ($makeFriendly){
			$charCheck		=	array(
									chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
									chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
									chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
									chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
									chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
									chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
									chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
									chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
									chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
									chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
									chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
									chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
									chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
									chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
									chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
									chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
									chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
									chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
									chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
									chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
									chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
									chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
									chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
									chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
									chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
									chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
									chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
									chr(195).chr(191) => 'y',
									chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
									chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
									chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
									chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
									chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
									chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
									chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
									chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
									chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
									chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
									chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
									chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
									chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
									chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
									chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
									chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
									chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
									chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
									chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
									chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
									chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
									chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
									chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
									chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
									chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
									chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
									chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
									chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
									chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
									chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
									chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
									chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
									chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
									chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
									chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
									chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
									chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
									chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
									chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
									chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
									chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
									chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
									chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
									chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
									chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
									chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
									chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
									chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
									chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
									chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
									chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
									chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
									chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
									chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
									chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
									chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
									chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
									chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
									chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
									chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
									chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
									chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
									chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
									chr(197).chr(190) => 'z', chr(197).chr(191) => 's',
									chr(226).chr(130).chr(172) => 'E',
									chr(194).chr(163) => ''
			);

			$makeFriendly	=	strtr($makeFriendly, $charCheck);
				
			$makeFriendly	=	strtolower ($makeFriendly);
			$makeFriendly	=	preg_replace ('#&.+?;#', '', $makeFriendly);
			$makeFriendly	=	preg_replace ('#[^%a-z0-9 _-]#', '', $makeFriendly);
			$makeFriendly	=	str_replace ( array( ' ', '+', '.', '?' ), '-', $makeFriendly);
			$makeFriendly	=	preg_replace ("#-{2,}#", '-', $makeFriendly);
			$makeFriendly	=	trim ($makeFriendly, '-');
			
			return $makeFriendly;
	}

	///////////////////////////////////////////////////

	// Copy files from one server to another

	function lb_remote($url,$dirname){
		$file = basename($url);
		if ($dirname =='modules/'){
			$url ="http://plugins.layerbulletin.com/uploads/$file";
		}
		else{
			$url ="http://themes.layerbulletin.com/uploads/$file";
		}

	        $filename = basename($url);
	        $fc = fopen($dirname."$filename", "wb") or die("CREATE NEW");

			$contents = file_get_contents($url) or die("CONTENTS");
			fwrite($fc,$contents) or die("LOCAL WRITE");
			fclose($fc);
			
	        return true;
	    }


	///////////////////////////////////////////////////

	// Copy files from one place to another

	function lb_copy($source, $target) 
	    { 
	        if ( is_dir( $source ) ) 
	        { 
	            chmod ($source, 0777); // chmod the directory to make sure the file copies... 
	             
	            @mkdir( $target ); 
	            
	            $d = dir( $source ); 
	            
	            while ( FALSE !== ( $entry = $d->read() ) ) 
	            { 
	                if ( $entry == '.' || $entry == '..' ) 
	                { 
	                    continue; 
	                } 
	                
	                $Entry = $source . '/' . $entry;            
	                if ( is_dir( $Entry ) ) 
	                { 
	                    lb_copy( $Entry, $target . '/' . $entry ); 
	                    continue; 
	                } 
	                copy( $Entry, $target . '/' . $entry ); 
	            } 
	            
	            $d->close(); 
	             
	            chmod ($source, 0755); // chmod the directory to make it safe again... 
	        }else 
	        { 
	            copy( $source, $target ); 
	        } 
	    }  

	///////////////////////////////////////////////////

	// Remove directories and files

	function lb_remove($dirname)
	{
	// Sanity check
	if (!file_exists($dirname)) {
	}

	// Simple delete for a file
	if (is_file($dirname)) {
	return unlink($dirname);
	}

	// Loop through the folder
	$dir = dir($dirname);
	while (false !== $entry = $dir->read()) {
	// Skip pointers
	if ($entry == '.' || $entry == '..') {
	continue;
	}

	// Recurse
	lb_remove("$dirname/$entry");
	}// end while looping

	// Clean up
	$dir->close();
	return rmdir($dirname);

	}


	///////////////////////////////////////////////////

	// Search engine friendly URL's

	 	function lb_link($link_off, $link_on){
	 		global $lb_domain, $sef_urls;

	        if($sef_urls=='1'){
	            $link="$lb_domain/$link_on"; 		
			}
	         
	        else{
	            $link="$lb_domain/$link_off"; 
	        } 

	 		return $link;
	 	}

	///////////////////////////////////////////////////

	// Redirect function

	function lb_redirect($link, $sef){
	session_write_close();
	header('HTTP/1.0 200 OK'); 
	header('Location: ' . lb_link($link, $sef)); 
	exit;
	} 

	///////////////////////////////////////////////////

	// Create short url's in post entries
	// Example: http://www.domain.com/index.php?pa...6452332

		function short_url(&$addy){
	   		$links = explode('<a', $addy);
	   		$countlinks = count($links);
	   		for ($i = 0; $i < $countlinks; $i++){
	      		$link = $links[$i];
	      
	      		$link = (preg_match('#(.*)(href=")#is', $link)) ? '<a' . $link : $link;

	      		$begin = strpos($link, '>') + 1;
	      		$end = @strpos($link, '<', $begin);
	      		$length = $end - $begin;
	      		$urlname = substr($link, $begin, $length);
	      
	      		$shorturlname = (strlen($urlname) > 50 && preg_match('#^(http://|ftp://|www\.)#is', $urlname)) ? substr_replace($urlname, '...', 30, -10) : $urlname;
	      		$addy = str_replace('>' . $urlname . '<', '>' . $shorturlname . '<', $addy);
	   		}
		}


	///////////////////////////////////////////////////

	// List all themes in themes folder and put into a select form

		function list_themes(){

			global $db_prefix;
			
	$query29 = "select DISPLAY_NAME, THEME_NAME from {$db_prefix}themes WHERE INSTALLED='1'";	
	$result29 = mysql_query($query29) or die("modules.php - Error in query: $query29") ;                               
	while ($results29 = mysql_fetch_array($result29)){
	$display_name = $results29['DISPLAY_NAME'];
	$theme_name = $results29['THEME_NAME'];

	echo "<option value=\"$theme_name\">$display_name</option>";

	}

			
		}


	///////////////////////////////////////////////////

	// List all languages in lang folder and put into a select form

		function list_lang($dir){

			global $db_prefix, $flag_path, $lb_domain;

	  		if(is_dir($dir)){
	    			if($handle = opendir($dir)){
	      			while(($file = readdir($handle)) !== false){
	        				if($file != "." && $file != ".." && $file != "Thumbs.db" && $file!="index.html"){

							// explode into 2 parts {lang}_{flag} then put into options for selections

								$lang_option = explode("_", $file);
								
								$lang_option[1] = mysql_real_escape_string($lang_option[1]);
								
								// check if this language exists, if it dosen't then we don't want to give the user the option to use it
								$check_language = mysql_query("SELECT `nation_short` FROM `{$db_prefix}nations` WHERE `nation_short` = '{$lang_option[1]}' LIMIT 1");
																
								if(mysql_num_rows($check_language) === 1) {
								
								// Capital letters please...

								$lang_option[0] = ucfirst($lang_option[0]);
								
								echo "<option value='$file' style='background: url($lb_domain/$flag_path/$lang_option[1].png) no-repeat;'>&nbsp;$lang_option[0]</option>";
						
								}
						}
					}
				}
	      	closedir($handle);
			}
		}
		
	///////////////////////////////////////////////////

	// Escape string

		function escape_string($string) {

			$string = addslashes($string);
			
			$string = htmlspecialchars($string);
	   		return $string;
		}
		
	///////////////////////////////////////////////////

	// Unescape string

		function strip_slashes($string) {
		
			if (get_magic_quotes_gpc()){
		
				$string = stripslashes($string);
			
			}
				
			$string = str_replace("&amp;", "&", $string);

	   		return $string;
		}	

	///////////////////////////////////////////////////

	// random password generator

		function createRandomPassword() {

	  	  $chars = "abcdefghijkmnopqrstuvwxyz023456789";
	   	 srand((double)microtime()*1000000);
	   	 $i = 0;
	   	 $pass = '' ;

	   	 while ($i <= 7) {
	    	    $num = rand() % 33;
	    	    $tmp = substr($chars, $num, 1);
	    	    $pass = $pass . $tmp;
	   	     $i++;
	  	  }

	   	 return $pass;

		}

	///////////////////////////////////////////////////

	// format date to show today/yesterday
	// and convert to language member has selected

		function format_date($var, $format = null) {

			global $time_offset, $board_lang, $format_time, $date_today, $date_yesterday, $date_minute, $date_minutes, $date_hour, $date_hours;

				// set locale based on board lang
					$board_locale = explode("_",$board_lang);
					$board_locale[1] = $board_locale[1]."_".(strtoupper($board_locale[1]));

				// check PHP version

	   				if(version_compare(phpversion(),"4.3.0")=="-1") {
						setlocale(LC_TIME, $board_locale[0]);
					}else{
						setlocale(LC_TIME, $board_locale[0].'.UTF-8', $board_locale[1].'.UTF-8', $board_locale[0].'.UTF8', $board_locale[1].'.UTF8');
					}

				$time = $var + ($time_offset * 60 * 60);
				$today=time() + ($time_offset * 60 * 60);
				$yesterday=time() + (($time_offset * 60 * 60)-86400);
				$today=date('l, M jS', $today);
				$yesterday=date('l, M jS', $yesterday);

				$current_day=date('l, M jS', $time);

				if (isset($format)){
					$time = strftime($format, $time);
					$time = ucwords($time);
				}

				elseif ($current_day==$today){
				
				// check if it was posted less than an hour ago...
		
				if ((time() - $var) < '3600'){
				$minutes = round((time() - $var)/60);

	if ($minutes =='1'){
				$time = "$minutes $date_minute";
	}
	else{
				$time = "$minutes $date_minutes";
	}
				}
				elseif ((time() - $var) < '43200'){
				$hours = round((time() - $var)/60/60);
	if ($hours =='1'){
				$time = "$hours $date_hour";
	}
	else{
				$time = "$hours $date_hours";
	}
				}
				else{
					$day=$date_today;
					$time = date(', H:i', $time);
					$time="$day$time";
					}
				}
				elseif($current_day==$yesterday){
					$day=$date_yesterday;
					$time = date(', H:i', $time);
					$time="$day$time";
				}
				else{
					$time = strftime($format_time, $time);
					$time = ucwords($time);
				}

			// Return locale to default
				setlocale(LC_ALL, null);

			return $time;
		}

	///////////////////////////////////////////////////

	// check image exists, and decide if it is theme/default
	// that shows up

		function image_check($var){

			global $lb_domain, $theme, $board_lang;	

	                $theme=str_replace("%20", " ", $theme);

				if (file_exists("../themes/$theme/images/$var")){
					$path = "$lb_domain/themes/$theme/images/$var";
				}
				elseif (file_exists("themes/$theme/images/$var")){
					$path = "$lb_domain/themes/$theme/images/$var";
				}
				else{
					$path = "$lb_domain/images/$var";
				}

			return $path;

		}

	///////////////////////////////////////////////////

	// check folder exists, and decide if it is theme/default
	// that shows up

		function folder_check($var){

			global $lb_domain, $theme;

				if (file_exists("themes/$theme/images/$var")){
					$path = "themes/$theme/images/$var";
				}
				else{
					$path = "images/$var";
				}

			return $path;

		}
		
	///////////////////////////////////////////////////

	// Template and plug-in function
		
	function template_hook($page_location, $template_hook) 
	{ 
	    extract($GLOBALS, EXTR_SKIP);
		
	    // for modules, drop the .template.php 
	     
	    $template_folder = str_replace(".template.php", "", $page_location);

		/*
		Hooks before this template?
	*/
	
			/*
			Directory separators aren't allowed in filenames,
			change them to hypens (-)
		*/
		
			$file = str_replace('/', '-', $template_folder);
		
			/*
			Now check for any modules and run the code if found.
		*/
		
			if ($code = $Plugin->hook('template_hook', $file . '_' . $template_hook . '_before'))
			{
				eval($code);
			}
		
		/*
			---------------------------------------------------------
			CODE BELOW IS DEPRECATED DUE TO THE NEW HOOKS SYSTEM.
			WILL BE REMOVED IN 1.3
			---------------------------------------------------------
		*/
	     
	    // check modules folder for any other folders... 
	     
	    $dir = "modules/"; 
	     
	    $modules_installed="0";
		
		# Load cached modules
		include $lb_root . '/cache/modules.php';
		$modules_installed = count($cache);
	     
	    // if there are no installed modules, skip this part... 
	     
	    $installed = 0; 
	    $runDefault = true; 
	    $runDefaultFile = ''; 
	    $runDefaultFileLocation = ''; 
	 
	    if ($modules_installed != 0) 
	    { 
	        // is it in the database? 
			foreach ($cache as $mod)
	        { 
	            $module = $mod['module_name'];
				
				if (file_exists($lb_root . 'modules/'.$module.'/templates/includes/'.$template_folder.'/replace/'.$template_hook.'.php')) 
	            { 
					$runDefaultFile = $module; 
	                $runDefaultFileLocation = 'replace'; 
	                continue; 
	            } 
	             
	            elseif (file_exists($lb_root . 'modules/'.$module.'/templates/includes/'.$template_folder.'/before/'.$template_hook.'.php')) 
	            { 
	                $runDefaultFile = $module; 
	                $runDefaultFileLocation = 'before'; 
	                continue; 
	            } 
	             
				elseif (file_exists($lb_root . 'modules/'.$module.'/templates/includes/'.$template_folder.'/after/'.$template_hook.'.php') && $runDefaultFileLocation != 'after')             { 
	                $runDefaultFile = $module; 
	                $runDefaultFileLocation = 'after'; 
	                continue; 
	            } 
	            else 
	            { 
	                if ($runDefaultFile == '') 
	                { 
	                    $runDefaultFile = $module; 
	                    $runDefaultFileLocation = ''; 
	                    continue; 
	                } 
	            } 
	        }
	         
	        foreach ($cache as $mod)
	        { 
	            $module = $mod['module_name'];
				
				if (file_exists("modules/$module/templates/includes/$template_folder/before/$template_hook.php")) 
	            { 
	                if (file_exists("themes/$theme/modules/$module/templates/includes/$template_folder/before/$template_hook.php")) 
	                { 
	                    include $lb_root . "themes/$theme/modules/$module/templates/includes/$template_folder/before/$template_hook.php"; 
	                } 
	                else 
	                {             
	                    include $lb_root . "modules/$module/templates/includes/$template_folder/before/$template_hook.php"; 
	                } 
	                     
	                if ($runDefaultFile == $module && $runDefaultFileLocation == 'before') 
	                { 
	                    if (file_exists("themes/$theme/templates/includes/$page_location")) 
	                    { 
	                        include $lb_root . "themes/$theme/templates/includes/$page_location"; 
	                    } 
	                    else 
	                    { 
	                        include $lb_root . "templates/includes/$page_location"; 
	                    } 
	                     
	                    $runDefault = false; 
	                } 
	            } 
	             
	            if (file_exists("modules/$module/templates/includes/$template_folder/replace/$template_hook.php")) 
	            { 
	               if ($runDefaultFile == $module && $runDefaultFileLocation == 'replace') 
	                { 
	                    if (file_exists("themes/$theme/modules/$module/templates/includes/$template_folder/replace/$template_hook.php")) 
	                    {  
	                        include $lb_root . "themes/$theme/modules/$module/templates/includes/$template_folder/replace/$template_hook.php";  
	                    } 
	                    else 
	                    {              
	                        include $lb_root . "modules/$module/templates/includes/$template_folder/replace/$template_hook.php";  
	                    } 
	                     
	                    $runDefault = false; 
	                } 
	            } 
	             
	            if (file_exists("modules/$module/templates/includes/$template_folder/after/$template_hook.php")) 
	            { 
	                if ($runDefaultFile == $module && $runDefaultFileLocation == 'after') 
	                { 
	                    if (file_exists("themes/$theme/templates/includes/$page_location")) 
	                    { 
	                        include $lb_root . "themes/$theme/templates/includes/$page_location"; 
	                    } 
	                    else 
	                    { 
	                        include $lb_root . "templates/includes/$page_location"; 
	                    } 
	                     
	                    $runDefault = false; 
	                } 
	                if (file_exists("themes/$theme/modules/$module/templates/includes/$template_folder/after/$template_hook.php")) 
	                { 
	                    include $lb_root . "themes/$theme/modules/$module/templates/includes/$template_folder/after/$template_hook.php"; 
	                } 
	                else 
	                {                 
	                    include $lb_root . "modules/$module/templates/includes/$template_folder/after/$template_hook.php"; 
	                }                                         
	            } 
	             
	            if ($runDefault == true) 
	            { 
	                if ($runDefaultFile == $module) 
	                { 
	                    if (file_exists("themes/$theme/templates/includes/$page_location")){ 
	                        include $lb_root . "themes/$theme/templates/includes/$page_location"; 
	                    } 
	                    else{ 
	                        include $lb_root . "templates/includes/$page_location"; 
	                    } 
	                     
	                    $runDefault = false; 
	                } 
	            } 
	        } 
	    } 
	    else 
	    { 
	        if ($runDefault == true) 
	        { 
	            if (file_exists("themes/$theme/templates/includes/$page_location")){ 
	                include $lb_root . "themes/$theme/templates/includes/$page_location"; 
	            } 
	            else{ 
	                include $lb_root . "templates/includes/$page_location"; 
	            } 
	        } 
	    }
		
		/*
			---------------------------------------------------------
			END DEPRECATED CODE
			---------------------------------------------------------
		*/
		
		/*
		Hooks afterwards...
	*/
	
		if ($code = $Plugin->hook('template_hook', $file . '_' . $template_hook . '_after'))
		{
			eval($code);
		}
	}		

	///////////////////////////////////////////////////
		
	// List all modules

		function list_modules($dir){

	 		extract($GLOBALS, EXTR_SKIP);

	$dir="modules/";


	  		if(is_dir($dir)){
	    			if($handle = opendir($dir)){
	      			while(($file = readdir($handle)) !== false){
	        				if($file != "." && $file != ".." && $file != "Thumbs.db" && $file!="index.html"){

	$pos = strpos($file, ".zip");

	if ($pos === FALSE){

	// is it in the database?

	$file_str = str_replace("%20", " ", $file);

	$installed="0";

	$query29 = "select INSTALLED from {$db_prefix}modules WHERE MODULE_NAME='$file_str'";
	$result29 = mysql_query($query29) or die("modules.php - Error in query: $query29") ;  
	$installed = mysql_result($result29, 0);

	if ($installed=='0' OR $installed==''){
			echo "<table class=\"forum-jump module-not-installed\" cellpadding=\"0\" cellspacing=\"0\">";
	}
	else{
			echo "<table class=\"forum-jump module-installed\" cellpadding=\"0\" cellspacing=\"0\">";
	}

	$xml_file = "modules/$file/information.xml";

	$xml_handle = fopen($xml_file, "r");
	$xml_data = fread($xml_handle, filesize($xml_file));
	fclose($xml_handle);

	echo "<tr><td class=\"forum-jump-content\">";

	preg_match('/<version>(.*)<\/version>/s',$xml_data,$installed_version);
	preg_match('/<update>(.*)<\/update>/s',$xml_data,$update_url_check);

	$xml_data = htmlspecialchars($xml_data);

	$installed_version = $installed_version[1];
	$update_url_check = $update_url_check[1];

	$xml_data = str_replace("&lt;", "<", $xml_data);
	$xml_data = str_replace("&gt;", ">", $xml_data);

	$xml_data = preg_replace("#\<module\>(.*?)\</module\>(.*?)#is", "<strong>$1</strong>$2", $xml_data);

	$xml_data = preg_replace("#(.*?)\<version\>(.*?)\</version\>(.*?)#is", "$1 ($2)$3", $xml_data);
	$xml_data = preg_replace("#(.*?)\<author\>(.*?)\</author\>(.*?)#is", "$1<br /><i>By $2</i>$3", $xml_data);
	$xml_data = preg_replace("#(.*?)\<site\>(.*?)\</site\>(.*?)#is", "$1 - <a href=\"$2\"><i>$2</i></a><br /><br />$3", $xml_data);


	$xml_data = preg_replace("#(.*?)\<description\>(.*?)\</description\>(.*?)#is", "$1$2", $xml_data);

	$xml_data = preg_replace("#(.*?)\<update\>(.*?)\</update\>(.*?)#is", "$1", $xml_data);

	echo "<table cellpadding=\"0\" cellspacing=\"0\"><tr>";
	echo "<td style=\"vertical-align: top;\">";
	echo "<img src=\"$lb_domain/modules/$file/screenshot.jpg\" alt=\"screenshot\" />";
	echo "</td>";

	echo "<td style=\"padding-left: 5px; vertical-align: top;\">";

	echo "$xml_data";

	echo "<br /><br />";

	echo "<span style='text-align: right;'>";

	if ($installed=='0' OR $installed==''){

	echo "<a class='submit-button img-plugin-add' href='$lb_domain/index.php?page=admin&act=modules&func=install&module=$file'>$lang[button_install]</a>";
	echo " <a class='submit-button button-remove img-plugin-del' href='$lb_domain/index.php?page=admin&act=modules&func=delete&module=$file'>$lang[button_remove]</a>";
	}
	else{

	// check if an update is available, if so, provide a link...

	$filename = $update_url_check;

	$data = file_get_contents($filename);
			
	preg_match('/<version>(.*)<\/version>/s',$data,$current_version);
	preg_match('/<update>(.*)<\/update>/s',$data,$update_url);

	$current_version = $current_version[1];
	$update_url = $update_url[1];

	if ($current_version!=$installed_version && $update_url!=''){
	echo "<a class='submit-button button-update img-error' href='$lb_domain/index.php?page=admin&act=modules&func=update&module=$file&update_url=$update_url'>$lang[button_update]</a>&nbsp;";
	}
	echo "<a class='submit-button img-plugin-uninstall' href='$lb_domain/index.php?page=admin&act=modules&func=remove&module=$file'>$lang[button_uninstall]</a>";

	}

	echo "</span>";
	echo "</td></tr></table>";
	echo "</td></tr></table>";

			echo "<div class=\"spacer\">&nbsp;</div>";

	}
	}
					}
				}
	      	closedir($handle);
			}
			
		}
		
	///////////////////////////////////////////////////
		
	// List all themes

		function list_themes_admin($dir){

	 		extract($GLOBALS, EXTR_SKIP);

	$dir="themes/";


	  		if(is_dir($dir)){
	    			if($handle = opendir($dir)){
	      			while(($file = readdir($handle)) !== false){
	        				if($file != "." && $file != ".." && $file != "Thumbs.db" && $file!="index.html"){

	$pos = strpos($file, ".zip");

	if ($pos === FALSE){

	// is it in the database?

	$installed = "0";

	$file_str = str_replace("%20", " ", $file);

	$query29 = "select INSTALLED from {$db_prefix}themes WHERE THEME_NAME='$file_str'";
	$result29 = mysql_query($query29) or die("themes.php - Error in query: $query29") ;  
	$installed = mysql_result($result29, 0);

	if ($installed=='0' OR $installed==''){
			echo "<table class=\"forum-jump\" cellpadding=\"0\" cellspacing=\"0\" class=\"module-not-installed\">";
	}
	else{
			echo "<table class=\"forum-jump\" cellpadding=\"0\" cellspacing=\"0\" class=\"module-installed\">";
	}

	$xml_file = "themes/$file/information.xml";

	$xml_handle = fopen($xml_file, "r");
	$xml_data = fread($xml_handle, filesize($xml_file));
	fclose($xml_handle);

	echo "<tr><td class=\"forum-jump-content\">";

	$xml_data = htmlspecialchars($xml_data);

	$xml_data = str_replace("&lt;", "<", $xml_data);
	$xml_data = str_replace("&gt;", ">", $xml_data);

	$xml_data = preg_replace("#\<theme\>(.*?)\</theme\>(.*?)#is", "<strong>$1</strong>$2", $xml_data);

	$xml_data = preg_replace("#(.*?)\<version\>(.*?)\</version\>(.*?)#is", "$1 ($2)$3", $xml_data);
	$xml_data = preg_replace("#(.*?)\<author\>(.*?)\</author\>(.*?)#is", "$1<br /><i>By $2</i>$3", $xml_data);
	$xml_data = preg_replace("#(.*?)\<site\>(.*?)\</site\>(.*?)#is", "$1 - <a href=\"$2\"><i>$2</i></a><br /><br />$3", $xml_data);


	$xml_data = preg_replace("#(.*?)\<description\>(.*?)\</description\>(.*?)#is", "$1$2", $xml_data);

	echo "<table cellpadding=\"0\" cellspacing=\"0\"><tr>";
	echo "<td style=\"vertical-align: top;\">";
	echo "<img src=\"$lb_domain/themes/$file/screenshot.jpg\" alt=\"screenshot\" />";
	echo "</td>";

	echo "<td style=\"padding-left: 5px; vertical-align: top;\">";

	echo "$xml_data";

	echo "<br /><br />";

	echo "<span style='text-align: right;'>";

	if ($installed=='0' OR $installed==''){
	echo "<a class='submit-button img-plugin-add' href='$lb_domain/index.php?page=admin&act=themes&func=install&theme=$file'>$lang[button_install]</a>";

	if ($file!='layerbulletin_default'){
	echo " <a class='submit-button button-remove img-plugin-del' href='$lb_domain/index.php?page=admin&act=themes&func=delete&theme=$file'>$lang[button_remove]</a>";
	}
	}
	else{
	echo "<a class='submit-button img-plugin-uninstall' href='$lb_domain/index.php?page=admin&act=themes&func=remove&theme=$file'>$lang[button_uninstall]</a>";
	}
	echo "</span>";
	echo "</td></tr></table>";
	echo "</td></tr></table>";

			echo "<div class=\"spacer\">&nbsp;</div>";

	}
	}
					}
				}
	      	closedir($handle);
			}
			
		}
		
	///////////////////////////////////////////////////

	// Member name construct function

	function member_link($memberid, $flag=1, $color=1, $time=null)
	{
		global $Plugin, $db_prefix, $lb_domain, $flag_path;
		
		#unset($member_html);
		
		if (isset($memberid) && $memberid!='0' OR $memberid!='')
		{
			$field	= ($time == 1) ? ', s.time' : '';
			$extra	= ($time == 1) ? 'LEFT JOIN ' . $db_prefix . 'sessions s ON m.id = s.id' : '';
			
			# Get name, flag, group, group colour & online time (if needed)
			$query = mysql_query('
				SELECT m.name, m.nationality, m.role, g.group_color ' . $field . '
				
				FROM ' . $db_prefix . 'members m
				
					INNER JOIN ' . $db_prefix . 'groups g
					ON m.role = g.group_id
					
					' . $extra . '
				
				WHERE m.id = ' . $memberid
			);
			$row = mysql_fetch_assoc($query);
			
				$member_name	= strip_slashes($row['name']);
				$member_flag	= $row['nationality'];
				$member_role	= $row['role'];
				$member_color	= $row['group_color'];
				$time            = ( $time == 1 ) ? format_date( $row['time'] ) : '';
				
			// construct the html...
			
				$member_html = "<span style=\"white-space: nowrap;\">";
			
				if ($flag == 1)
				{
					if ($member_flag=='')
					{
						$member_html .= "<img src=\"$lb_domain/$flag_path/0.png\" alt=\"\" />";

					}
					else
					{
						$member_html .= "<img src=\"$lb_domain/$flag_path/$member_flag.png\" alt=\"\" />";
					}
				}
				
				$title = clean_url_seo($member_name); 
				
				$member_html .= " <a class=\"forum-index-link-to-topic\" href=\"".lb_link("index.php?page=members&id=$memberid","members/$title-$memberid")."\" title=\"$time\">";
				
				if ($color == 1)
				{
					$member_html .= "<span style=\"color: $member_color;\"><strong>$member_name</strong></span>";
				}
				else
				{
					$member_html .= "<strong>$member_name</strong>";
				} 
				
				$member_html .= "</a>";
				
					/*
					Allow modules to display something after the name
				*/
				
					if ($code = $Plugin->hook('member_link', 'after'))
					{
						eval($code);
					}
					
				$member_html .= "</span>";
		}
		else
		{
			$member_html = ' ';
		}
		
		return $member_html;
}
		
	///////////////////////////////////////////////////

	// .htaccess creator

		function htaccess_create($sef_urls = 1){

			global $db_prefix, $lb_domain;

			if ($sef_urls=='1'){
			
	$write="Options +FollowSymLinks
	RewriteEngine On

	";

	$query21 = "select SEO_OFF, SEO_ON from {$db_prefix}seo ORDER BY SEO_ON desc" ;
	$result21 = mysql_query($query21) or die("settings.php - Error in query: $query21") ;                                  
	while ($results21 = mysql_fetch_array($result21)){
	$seo_off = $results21['SEO_OFF'];
	$seo_on = $results21['SEO_ON'];

	$write.="RewriteRule ^$seo_on $seo_off\n";

	}

	// add support for hooks...

			template_hook("functions.template.php", "htaccess");

			$handling = fopen(".htaccess", "w");
			fwrite($handling, $write);
			fclose($handling);	
			
		}
		}

	///////////////////////////////////////////////////
	// Check Spam

	function checkspam($username, $email, $address){

		// prepare the checks...
			$username	=	strtolower($username);
			$email		=	strtolower($email);	
			$address	=	strtolower($address);		

		// first, check the email address....
				$spam_response = file_get_contents("http://www.stopforumspam.com/api?email=".$email."");
				$spam_check = strpos($spam_response, "yes");	
				
				if($spam_check !== false){
					$spammer = "true";
				}
		// now check the ip address
				else{
					$spam_response = file_get_contents("http://www.stopforumspam.com/api?ip=".$address."");
					$spam_check = strpos($spam_response, "yes");	
					
					if($spam_check !== false){
						if($address != "127.0.0.1"){
							$spammer = "true";
						}
						else{
							$spammer = "false";
						}
					}
					else{
						$spammer = "false";
					}
				}			
		
	return $spammer;

	}	
		
	///////////////////////////////////////////////////

	// "CASPIAN" Trigger Envoke

		function caspian_trigger($id){

			global $db_prefix, $lb_domain, $my_id, $avoid_caspian, $akismet_key;

	// Your WordPress API key
	$GLOBALS["akismet_key"]		= $akismet_key;

	// The name of the blog you're protecting
	$GLOBALS["akismet_home"]	= $lb_domain;

	// Your User-Agent string
	$GLOBALS["akismet_ua"]		= "LayerBulletin/1.0";

	/**
	 * Advanced settings below, only change these if you know what you're doing
	 */

	// The Akismet hostname
	$GLOBALS["akismet_host"]	= "rest.akismet.com";

	// Base URL to append to host and prepend to all queries
	$GLOBALS["akismet_url"]		= "1.1";

			
			include "scripts/php/akismet.php";
		
			$never_spam="0"; // reset spam check

			if ($akismet_key!=''){
			
			//  first, if the member is not a spammer, then
			// we can skip the rest...
			
				if ($avoid_caspian=='1'){ // can their group bypass caspian?
					$never_spam="1"; // if so, tell it.
				}
				
				if ($never_spam=='0'){
				
					if ($my_id > '0'){
				
						$query = "select NEVER_SPAM from {$db_prefix}members WHERE ID ='$my_id'" ;
						$result = mysql_query($query) or die("functions.php - Error in query: $query") ;
						$never_spam = mysql_result($result, 0);	
					
					}
					else{
					
						$never_spam="0"; // we're not sure, so it's a potential spammer
						
					}
				
				}

				if ($never_spam=='0'){ // potential spammer
				
					// calculate the messages spam level...

						$query = "select CONTENT from {$db_prefix}posts WHERE ID ='$id'" ;
						$result = mysql_query($query) or die("functions.php - Error in query: $query") ;
						$comment = mysql_result($result, 0);
						
						$query = "select NAME from {$db_prefix}members WHERE ID ='$my_id'" ;
						$result = mysql_query($query) or die("functions.php - Error in query: $query") ;
						$name = mysql_result($result, 0);	

						$query = "select EMAIL from {$db_prefix}members WHERE ID ='$my_id'" ;
						$result = mysql_query($query) or die("functions.php - Error in query: $query") ;
						$email = mysql_result($result, 0);					

	   // The array of data we need
	   $vars    = array();

	   // Add the contents of the $_SERVER array, to help Akismet out
	   foreach ( $_SERVER as $key => $val ) { $vars[ $key ] = $val; }

	   // Mandatory fields of information
	   $vars["user_ip"]              = $_SERVER["REMOTE_ADDR"];
	   $vars["user_agent"]           = $_SERVER["HTTP_USER_AGENT"];

	   // The body of the message to check, the name of the person who
	   // posted it, and their email address
	   $vars["comment_content"]      = $comment;
	   $vars["comment_author"]       = $name;
	   $vars["comment_author_email"] = $email;

	   // ... Add more fields if you want

	   // Check if it's spam
	   if ( akismet_check( $vars ) ) {

							mysql_query("UPDATE {$db_prefix}posts SET approved='0' WHERE id='$id'"); // mod-queue the post
							mysql_query("UPDATE {$db_prefix}members SET moderate='1' WHERE id='$my_id'"); // mod-queue the member to prevent future posts
						
							$time=time();
						
							mysql_query("INSERT INTO {$db_prefix}moderate (postid, title, member_id, member_name, time) VALUES ('$id', 'Potential SPAM', '$my_id', 'CASPIAN', '$time')");


	}						
							
	}
	}	
	}		
		
	///////////////////////////////////////////////////

	// Topic Titles SEO

	function topic_title($topicid){

		global $db_prefix;

					$query219 = "select TITLE from {$db_prefix}posts WHERE TOPIC_ID='$topicid' AND TITLE!=''"; 
	                $result219 = mysql_query($query219) or die("topic.php - Error in query: $query219") ; 
	                while ($results219 = mysql_fetch_array($result219)){ 
	                    $title = $results219['TITLE']; 
	                } 
	                 
	                // now fix the title 
	                 
	                $title = clean_url_seo($title);
					
					return $title;

	}

	///////////////////////////////////////////////////

	// Category Names SEO

	function forum_title($forumid){

		global $db_prefix;

					$query219 = "select NAME AS TITLE from {$db_prefix}categories WHERE ID='$forumid'"; 
	                $result219 = mysql_query($query219) or die("topic.php - Error in query: $query219") ; 
	                while ($results219 = mysql_fetch_array($result219)){ 
	                    $title = $results219['TITLE']; 
	                } 
	                 
	                // now fix the title 
	                 
	                $title = clean_url_seo($title);
					
					return $title;

	}

	// check if number is odd or even

	function checkNum($num){
	  return ($num%2) ? TRUE : FALSE;
	}
	
	/*
	Adds/removes given language strings to the specified language file.
	
	@param	string	$file		: The filename to add the strings to. e.g. 'lang_help'
	@param	array		$vars	: An array of the language strings to add/delete
	@param	bool		$delete	: Whether to add or remove the strings.
	@return	null
*/
	
	function rebuild_lang($file, $vars, $delete = false)
	{
		global $lb_root;
		
		# The directory to search through
		$d = dir($lb_root . 'lang/');
		
		/*
		Loop through each entry found in this directory
	*/
	
		while (($entry = $d->read()) !== false)
		{
			if ($entry != '.' && $entry != '..')
			{
				if (is_dir($lb_root . 'lang/' . $entry))
				{
					$langFile = $lb_root . 'lang/' . $entry . '/' . $file . '.php';
					
					/*
					Does the file we're looking for even exist?
				*/
				
					if (file_exists($langFile))
					{
						require $langFile;
						
						if ($file == 'lang_forum')
						{
							$contents = $lang;
						}
						elseif ($file == 'lang_myoptions')
						{
							$contents = $lang_user;
						}
						else
						{
							$contents = $$file;
						}
						
						/*
						If deleting, remove the strings
					*/
						
						if ($delete)
						{
							foreach ($vars as $key)
							{
								if (array_key_exists($key, $contents))
								{
									unset($contents[$key]);
								}
							}
						}
						
						/*
						Otherwise, add them...
					*/
					
						else
						{
							foreach ($vars as $key => $value)
							{
								$contents[$key] = $value;
							}
						}
						
						/*
						Build the file contents
					*/
					
						$save = '<?php' . "\n";
						
						/*
						Some files have different array names
					*/
					
						if ($file == 'lang_forum')
						{
							$array_name = 'lang';
						}
						elseif ($file == 'lang_myoptions')
						{
							$array_name = 'lang_user';
						}
						else
						{
							$array_name = $file;
						}
						
						if (!empty($contents))
						{
							$save .= '$' . $array_name . ' = ' . var_export($contents, true) . ';';
						}
						else
						{
							$save .= '$' . $array_name . ' = array();';
						}
						
						$save .= "\n" . '?>';
						
						/*
						Save the contents
					*/
						
						file_put_contents($langFile, $save);
					}
				}
			}
		}
	}

}

	// str_ireplace for PHP4
	function stri_replace($find,$replace,$string)
	{
		if(!is_array($find))
			$find = array($find);
			
		if(!is_array($replace))
		{
			if(!is_array($find))
				$replace = array($replace);
			else
			{
				// this will duplicate the string into an array the size of $find
				$c = count($find);
				$rString = $replace;
				unset($replace);
				for ($i = 0; $i < $c; $i++)
				{
					$replace[$i] = $rString;
				}
			}
		}
		foreach($find as $fKey => $fItem)
		{
			$between = explode(strtolower($fItem),strtolower($string));
			$pos = 0;
			foreach($between as $bKey => $bItem)
			{
				   $between[$bKey] = substr($string,$pos,strlen($bItem));
				   $pos += strlen($bItem) + strlen($fItem);
			}
			$string = implode($replace[$fKey],$between);
		}
		return($string);
	}
	
	function tokenCheck($name, $values = '')
	{
		$token_id	= $_POST['token_id'];
		$values		= (is_array($values)) ? implode('', $values) : $values;
		$token_name	= 'token_' . $name . '_' . $values . $token_id;
		
		if(isset($_POST[$token_name], $_SESSION[$token_name]) && $_POST[$token_name] == $_SESSION[$token_name])
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function tokenCreate($name, $values = '')
	{
		$token_id	= md5(microtime());
		$token		= md5(uniqid(mt_rand(), true));
		$values		= (is_array($values)) ? implode('', $values) : $values;
		$token_name	= 'token_' . $name . '_' . $values . $token_id;
		
		$_SESSION[$token_name] = $token;
		
		return array($token_id, $token, $token_name);
	}
	
	/*
	Function: buildQuery
	Takes parameters and formats then for use in an SQL query
	
	@param	array	$fields	: An array of field names.
	@param	array	$tables	: An array of table names.
	@param	array	$where	: An array of conditions for the query.
	@param	array	$order	: Sorting options.
	@param	array	$limit	: The number of records to limit.
	@return	array			: Array of the formatted variables.
*/
	
	function buildQuery($fields, $tables, $where = array(), $order = array(), $limit = array(), $selectQuery = true)
	{
		$fields = implode(',', $fields);
		$tables	= buildTables($tables);
		
		if (!empty($where))
		{
			$returnWhere = 'WHERE ';
			$returnWhere .= implode(' AND ', $where);
		}
		
		$order = (empty($order)) ? '' : 'ORDER BY ' . implode(',', $order);
		
		if (!empty($limit))
		{
			$limit = 'LIMIT ';
			
			if ($limit['start'] != '')
			{
				$limit .= $limit['start'] . ',';
			}
			
			$limit .= $limit['num']; 
		}
		else
		{
			$limit = '';
		}
		
		if ($selectQuery)
		{
			return 'SELECT ' . $fields . ' FROM ' . $tables . ' ' .  $returnWhere . ' ' . $order . ' ' . $limit;
		}
		else
		{
			return array($fields, $tables, $returnWhere, $order, $limit);
		}
	}
	
	/*
	Function: buildTables
	Takes an array of table data and formats them into an sql format.
	
	@param	array	$tables	: Table data.
	@return	string			: SQL format.
*/
	
	function buildTables(&$tables)
	{
		global $db_prefix;
		
		$return = '';
		
		foreach ($tables as $key => $info)
		{
			if ($info['added'] != true)
			{
				$tables[$key]['added'] = true;
				
				foreach ($info as $key2 => $info2)
				{
					if ($key2 !== 'added')
					{
						/*
						Build the sql
					*/
						
						$return .= $info2['join_type'] . ' ' . $db_prefix . $info2['name'] . ' ' . $info2['short'] . ' ';
						
						if ($info2['on'] != '')
						{
							$return .= 'ON ' . $info2['on'] . ' ';
						}
						
						/*
						Any tables wanting to join onto this table?
					*/
						
						if (isset($tables[$info2['name']]))
						{
							$return .= buildTables($tables, $info2['name']);
						}
					}
				}
			}
		}
		
		return $return;
	}

?>