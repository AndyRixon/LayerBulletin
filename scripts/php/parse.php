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
|   parse.php - This handles BB Code parsing
*/
if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}
if (isset($_POST['content'])){
	$content = $_POST['content'];
}
else{
	$content = $content;
}

$content = ' ' . $content;

$content = preg_replace('#((ht|f)tps?://|mailto:)#is', ' $1', $content);

// if original poster can use html, then display it parsed
// if not, show it raw...

if (isset($_POST['content'])){
	$query2 = "select ROLE from {$db_prefix}members WHERE NAME='$lb_name'" ;
	$result2 = mysql_query($query2) or die("topic.php - Error in query: $query2") ;                                  
	$html_role = mysql_result($result2, 0);
}
else{
	$query2 = "select ROLE from {$db_prefix}members WHERE ID='$member'" ;
	$result2 = mysql_query($query2) or die("topic.php - Error in query: $query2") ;                                  
	$html_role = mysql_result($result2, 0);
}
	$query2 = "select CAN_USE_HTML from {$db_prefix}groups WHERE GROUP_ID='$html_role'" ;
	$result2 = mysql_query($query2) or die("topic.php - Error in query: $query2") ;                                  
	$group_use_html = mysql_result($result2, 0);

if ($group_use_html=='1'){

// strip the HTML tag before parsing

	$html_tag = array(); $i = 9999;
	while ($html_str = stristr($content, '[html]')) {
		$html_str = substr($html_str, 0, strpos($html_str, '[/html]') + 7);
		$content = str_replace($html_str, "***html_string***$i", $content);
		$html_tag[$i] = $html_str;
		$i++; //
	}

}

// Easy way to stop bad people? Remove the < / > tags

	$content = str_replace("&lt;?php", "<?php", "$content");
	$content = str_replace("?&gt;", "?>", "$content");
	$content = str_replace("[size=0]", "[size=1]", "$content");


// First we need to seperate the good from the bad
// Or more specifically, the code from the content

	$code_tag = array(); $i = 9999;
	while ($code_str = stristr($content, '[code]')) {
		$code_str = substr($code_str, 0, strpos($code_str, '[/code]') + 7);
		$content = str_replace($code_str, "***code_string***$i", $content);
		$code_str = str_replace("<", "&lt;", "$code_str");		
		$code_tag[$i] = $code_str;
		$i++; //
	}

	$php_tag = array(); $i = 9999;
	while ($php_str = stristr($content, '[php]')) {
		$php_str = substr($php_str, 0, strpos($php_str, '[/php]') + 6);
		$content = str_replace($php_str, "***php_string***$i", $content);
		$php_str = str_replace("&lt;", "<", "$php_str");
		$php_str = str_replace("&gt;", ">", "$php_str");
		$php_tag[$i] = $php_str;
		$i++; //
	}	

	$content = strip_slashes($content);
	
// check for attachments...

if ($can_download_attachment=='1' && $_GET['page']!='search'){

$query2 = "select ROW, ORIGINAL_FILENAME, FILENAME, FILESIZE, DOWNLOADS, HASH from {$db_prefix}attachments WHERE POSTID='$post_id'" ;
$result2 = mysql_query($query2) or die("topic.php - Error in query: $query2") ;                                  
while ($results2 = mysql_fetch_array($result2)){
$row = $results2['ROW'];
$original_filename = $results2['ORIGINAL_FILENAME'];
$filename = $results2['FILENAME'];
$filesize = $results2['FILESIZE'];
$hash = $results2['HASH'];
$downloads = $results2['DOWNLOADS'];
$downloads=number_format($downloads);

unset($attachment);

// now check if we have an attach tag with that in there...

$attach_item="[attachment=$row]";

$pos = strpos($content, $attach_item);
if ($pos === false){}else{

$attach_done[$row]= "1";

if ($filesize=='0' OR $filesize==''){
$filesize = "Unkown size";
}
elseif ($filesize < 1024){
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

// Check if it's an image...
			$parts = explode(".",$filename);
			$ext = $parts[count($parts)-1];			
			$ext = strtolower($ext);

if ($ext=='jpeg'){

			$imgSx = imagesx($lb_domain.'/uploads/attachments/'.$filename);
			$imgSy = imagesy($lb_domain.'/uploads/attachments/'.$filename);


$filename="t_$filename";

$attachment .= "<div class=\"attachment\">";

if ($filesize!='0'){

$attachment .= "".$lang['topic_img']." ($filesize)<br />";

} else{

$attachment .= "".$lang['topic_img']."<br />";

}

$attachment .= "<a href=\"".lb_link("download.php?attach=$row&filename=$original_filename", "download/$row/$original_filename")."\"><img src=\"$lb_domain/uploads/attachments/$filename\" alt=\"".$lang['topic_img']."\" /></a>";
$attachment .= "<br /><strong>$downloads</strong> ".$lang['topic_downloads']."";
$attachment .= "</div>";
$attachment .= "<div class=\"spacer\">&nbsp;</div>";

}
elseif ($ext=='jpg'){

			$imgSx = imagesx($lb_domain.'/uploads/attachments/'.$filename);
			$imgSy = imagesy($lb_domain.'/uploads/attachments/'.$filename);


$filename="t_$filename";

$attachment .= "<div class=\"attachment\">";

if ($filesize!='0'){

$attachment .= "".$lang['topic_img']." ($filesize)<br />";

} else{

$attachment .= "".$lang['topic_img']."<br />";

}

$attachment .= "<a href=\"".lb_link("download.php?attach=$row&filename=$original_filename", "download/$row/$original_filename")."\"><img src=\"$lb_domain/uploads/attachments/$filename\" alt=\"".$lang['topic_img']."\" /></a>";
$attachment .= "<br /><strong>$downloads</strong> ".$lang['topic_downloads']."";
$attachment .= "</div>";
$attachment .= "<div class=\"spacer\"></div>";
}
elseif ($ext=='gif'){

			$imgSx = imagesx($lb_domain.'/uploads/attachments/'.$filename);
			$imgSy = imagesy($lb_domain.'/uploads/attachments/'.$filename);


$filename="t_$filename";

$attachment .= "<div class=\"attachment\">";

if ($filesize!='0'){

$attachment .= "".$lang['topic_img']." ($filesize)<br />";

} else{

$attachment .= "".$lang['topic_img']."<br />";

}

$attachment .= "<a href=\"".lb_link("download.php?attach=$row&filename=$original_filename", "download/$row/$original_filename")."\"><img src=\"$lb_domain/uploads/attachments/$filename\" alt=\"".$lang['topic_img']."\" /></a>";
$attachment .= "<br /><strong>$downloads</strong> ".$lang['topic_downloads']."";
$attachment .= "</div>";
$attachment .= "<div class=\"spacer\"></div>";
}
elseif ($ext=='png'){

			$imgSx = imagesx($lb_domain.'/uploads/attachments/'.$filename);
			$imgSy = imagesy($lb_domain.'/uploads/attachments/'.$filename);



$filename="t_$filename";
$attachment .= "<div class=\"attachment\">";

if ($filesize!='0'){

$attachment .= "".$lang['topic_img']." ($filesize)<br />";

} else{

$attachment .= "".$lang['topic_img']."<br />";

}

$attachment .= "<a href=\"".lb_link("download.php?attach=$row&filename=$original_filename", "download/$row/$original_filename")."\"><img src=\"$lb_domain/uploads/attachments/$filename\" alt=\"".$lang['topic_img']."\" /></a>";
$attachment .= "<br /><strong>$downloads</strong> ".$lang['topic_downloads']."";
$attachment .= "</div>";
$attachment .= "<div class=\"spacer\"></div>";

}
else{

$attachment .= "<div class=\"spacer\"></div>";
$attachment .= "<img src=\"$zip_icon_img\" alt=\"file\" /> <a class=\"post\" href=\"".lb_link("download.php?attach=$row&filename=$original_filename", "download/$row/$original_filename")."\">$original_filename</a><br />";
$attachment .= "<span class=\"keyword-tags\">";

if ($filesize!='0'){

$attachment .= "$filesize";

}

$attachment .= " - $downloads ".$lang['topic_downloads']."</span>";
$attachment .= "<div class=\"spacer\"></div>";


}
}

// now replace it into post...

	$content = preg_replace("#\[attachment=$row\]#is", $attachment, $content);
	
}
}

// make sure people can't exploit bbcodes to hook into the tag

	$content = str_replace("'", "&#39;", $content);

// Non-parsed attachments? Hide them...

	$content = preg_replace("#\[attachment=(.*?)\]#is", "[attachment=]", $content);
	$content = str_replace("[attachment=]", "", $content);
	
// Bold beats Daz every time...

	$content = preg_replace("#\[b\](.*?)\[/b\]#is", "<strong>$1</strong>", $content);

// You utter TUBE!

	$content = preg_replace("#\[youtube\](.*?)\[/youtube\]#is", "<object width='425' height='350'><param name='movie' value='http://www.youtube.com/v/$1'></param><param name='wmode' value='transparent'></param><embed src='http://www.youtube.com/v/$1' type='application/x-shockwave-flash' wmode='transparent' width='425' height='350'></embed></object>", $content);

// Strike it lucky

	$content = preg_replace("#\[s\](.*?)\[/s\]#is", "<strike>$1</strike>", $content);

// To me...

	$content = preg_replace("#\[left\](.*?)\[/left\]#is", "<div style='text-align:left;'>$1</div>", $content);

// To you...

	$content = preg_replace("#\[justify\](.*?)\[/justify\]#is", "<div style='text-align:justify;'>$1</div>", $content);

// To me again...

	$content = preg_replace("#\[right\](.*?)\[/right\]#is", "<div style='text-align:right;'>$1</div>", $content);

// Chucklevision!

	$content = preg_replace("#\[center\](.*?)\[/center\]#is", "<div style='text-align:center;'>$1</div>", $content);

// Underline, italic and image...

	$content = preg_replace("#\[u\](.*?)\[/u\]#is", "<u>$1</u>", $content);
	$content = preg_replace("#\[i\](.*?)\[/i\]#is", "<i>$1</i>", $content);

// My name is URL...

	$content = str_replace("[url]www", "[url]http://www", $content);
	$content = str_replace("[url=www", "[url=http://www", $content);

	$url_tag = array(); $i = 9999;
	while ($url_str = stristr($content, '[url')) {
		$url_str = substr($url_str, 0, strpos($url_str, '[/url]') + 6);
		$content = str_replace($url_str, "***url_string***$i", $content);
		$url_tag[$i] = $url_str;
		$i++; //
	}	

 	$hc = count($url_tag) + 9998;
 	for ($i=9999;$i <= $hc;$i++) {	
		$tmp_url_str = strip_slashes($url_tag[$i]);
		$tmp_url_str = stri_replace(array('onabort=', 'onblur=', 'onchange=', 'onclick=', 'ondblclick=', 'onerror=', 'onfocus=', 'onkeydown=', 'onkeypress=', 'onkeyup=', 'onload=', 'onmousedown=', 'onmousemove=', 'onmouseout=', 'onmouseover=', 'onmouseup=', 'onreset=', 'onresize=', 'onselect=', 'onsubmit=', 'onunload='),'',$tmp_url_str);
 		$content = str_replace("***url_string***$i", $tmp_url_str, $content);		
 		}
	
// prepare the img tags...

	$img_tag = array(); $i = 9999;
	while ($img_str = stristr($content, '[img]')) {
		$img_str = substr($img_str, 0, stripos($img_str, '[/img]') + 6);
		$content = str_replace($img_str, "***img_string***$i", $content);
		$img_tag[$i] = $img_str;
		$i++; //
	}	

 	$hc = count($img_tag) + 9998;
 	for ($i=9999;$i <= $hc;$i++) {	
		$tmp_img_str = strip_slashes(substr($img_tag[$i], 5, -6));
		$tmp_img_str = stri_replace(array('onabort=', 'onblur=', 'onchange=', 'onclick=', 'ondblclick=', 'onerror=', 'onfocus=', 'onkeydown=', 'onkeypress=', 'onkeyup=', 'onload=', 'onmousedown=', 'onmousemove=', 'onmouseout=', 'onmouseover=', 'onmouseup=', 'onreset=', 'onresize=', 'onselect=', 'onsubmit=', 'onunload=', ' '),'',$tmp_img_str);
 		$content = str_replace("***img_string***$i", "<img src=\"$tmp_img_str\" style=\"max-width: 600px; if(this.width >= 600) { cursor: pointer; }\" onclick=\"if(this.width >= 600) { window.open('$tmp_img_str', '_blank'); }\" alt=\"\" title=\"\" />", $content);
 		}	

// Do the lists...

	$content = str_replace("[list]", "<ul>", "$content");
	$content = str_replace("[order]", "<ol>", "$content");
	$content = str_replace("[*]", "<li>", "$content");
	$content = str_replace("[/list]", "</ul>", "$content");
	$content = str_replace("[/order]", "</ol>", "$content");

	$content = str_replace("[define]", "<dl>", "$content");
	$content = str_replace("[title]", "<dt>", "$content");
	$content = str_replace("[description]", "<dd>", "$content");
	$content = str_replace("[/define]", "</dl>", "$content");

// Anchor tag

if ($post_id==''){
	$post_id="0";
}

	$content = preg_replace("#\[anchor=(?:&quot;|\"|')?([\A-Za-z\d]+?)(?:&quot;|\"|')?\]#is", "<a name='post_".$post_id."_$1'></a>", $content);
	$content = preg_replace("#\[jump=(?:&quot;|\"|')?([\A-Za-z\d]+?)(?:&quot;|\"|')?\](.*?)\[/jump\]#is", "<a href='#post_".$post_id."_$1'>$2</a>", $content);
	
// Color (and colour for those of us that can spell)

	$content = preg_replace(
		"%\[colou?r=(?:&quot;|\"|')?(\#[0-9A-F]{3,6}|[a-z]+)(?:&quot;|\"|')?\](.*?)\[/colou?r\]%is",
		'<span style="color:$1">$2</span>',
		$content
	);

// Supersize me...

	$content = preg_replace("#\[size=(?:&quot;|\"|')?([\d]+?)(?:&quot;|\"|')?\](.*?)\[/size\]#is", "<span style='font-size: $1px;'>$2</span>", $content);
	
	$urlRegex = '((?:(?:ht|f)tps?://|mailto:).*?)';
	
	$content = preg_replace("#\[url\] " . $urlRegex . "\[/url\]#is", "<a href='$1' class='post'>$1</a>", $content);
	$content = preg_replace("#\[url=(?:&quot;|\"|')? " . $urlRegex . "(?:&quot;|\"|')?\](.*?)\[/url\]#is", "<a href='$1' class='post'>$2</a>", $content);

	$content = preg_replace("#([\n ])([a-z]+?)://([^\[<,!, \n\r]+)#i", "<a href='\\2://\\3' class='post'>\\2://\\3</a>", $content);
	$content = preg_replace("#([\n ])www\.([a-z0-9\-]+)\.([a-z0-9\-.\~]+)((?:/[^<,!, \n\r]*)?)#i", "\\1<a href='http://www.\\2.\\3\\4' class='post'>www.\\2.\\3\\4</a>", $content);
	
	$content = str_replace('.\' class=\'post\'', '\' class=\'post\'', $content);
	$content = str_replace('.</a>', '</a>.', $content);

// Now give URL a quick back and sides...

	short_url($content);

	/*
	Email tags
*/
	
	# Thanks to Geert De Deckere from the Kohana project for this very long email regex
	$email_expr = '([-_a-z0-9\'+*$^&%=~!?{}]++(?:\.[-_a-z0-9\'+*$^&%=~!?{}]+)*+@(?:(?![-.])';
	$email_expr .= '[-a-z0-9.]+(?<![-.])\.[a-z]{2,6}|\d{1,3}(?:\.\d{1,3}){3})(?::\d++)?)';
	
	$content = preg_replace('#\[email\](?:mailto:)?' . $email_expr . '\[/email\]#is', '<a href="mailto:$1" class="post">$1</a>', $content);
	$content = preg_replace('#\[email=(?:&quot;|"|\')?(?:mailto:)?' . $email_expr . '(?:&quot;|"|\')?\](.+?)\[/email\]#is', '<a href="mailto:$1" class="post">$2</a>', $content);
	
	$content = preg_replace('#([\n ])mailto:' . $email_expr . '#is', '$1<a href="mailto:$2" class="post">$2</a>', $content);

// Warn about Admin CP links	
	
	$content = str_replace("href=\"$lb_domain/admin", "onclick=\"javascript: return confirm('".$lang['parse_url_warn']."')\" href=\"$lb_domain/admin", $content);	
	$content = str_replace("href=\"$lb_domain/index.php?page=admin", "onclick=\"javascript: return confirm('".$lang['parse_url_warn']."')\" href=\"$lb_domain/index.php?page=admin", $content);
	
	// Don't misquote people...

	$exprStart	= '#\[quote name=(?:&quot;|"|\')?([a-zA-Z0-9!@\#$%^&*();:_.\\\\ /\t-]+?)(?:&quot;|"|\')?';
	$exprExtra	= ' trackback=(?:&quot;|"|\')?([0-9]+?)(?:&quot;|"|\')?';
	$exprEnd	= '\]#is';
	$expr		= $exprStart . $exprExtra . $exprEnd;

	if ($sef_urls=='1'){
		$content = preg_replace($expr, "<blockquote><div class='quote-name'>$1 <a href='$lb_domain/findpost/$2'><img src='$trackback_img' alt='Trackback URL' title='Trackback URL' /></a></div><div style='padding:2px;'>", $content);
	}
	else{
		$content = preg_replace($expr, "<blockquote><div class='quote-name'>$1 <a href='$lb_domain/index.php?page=findpost&post=$2'><img src='$trackback_img' alt='Trackback URL' title='Trackback URL' /></a></div><div style='padding:2px;'>", $content);
	}

	$content = preg_replace($exprStart . $exprEnd, "<blockquote><div class='quote-name'>$1</div><div style='padding:2px;'>", $content);

	$content = preg_replace("#\[quote\]#is", "<blockquote><div class='quote-name'>".$lang['topic_quote_title']."</div><div style='padding:2px;'>", $content);

	$content = preg_replace("#\[/quote\]#is", "</div></blockquote>", $content);

// Is the post hidden from you?

	$topic_id=$_GET['topic'];
	$topic_id=escape_string($topic_id);

	$query2 = "select MEMBER from {$db_prefix}posts WHERE TOPIC_ID='$topic_id' AND ID >= '$post_id' AND MEMBER='$my_id'" ;
	$result2 = mysql_query($query2) or die("parse.php - Error in query: $sql") ;
	$have_i_replied = mysql_num_rows($result2);

	if ($my_id=='$member'){
		$have_i_replied="1";
	}
	if ($have_i_replied!='0'){

		$content = preg_replace( "#\[hide\](.+?)\[/hide\]#is", "<div class='hide-tag'><div style='float: none; clear: both;'>$1</div></div>", $content );
	}
	else{

		$content = preg_replace( "#\[hide\](.+?)\[/hide\]#is", "<div class='hide-tag-hide'><div class='hidden-post-container'><div class='hidden-post-top'>Reply to view post</div><div class='hidden-post-left'>KEY!</div><div class='hidden-post-right'>CONTENT<br />HIDDEN</div></div></div>", $content );

	}

// Introduce smilies...

	if (file_exists($lb_root . 'themes/' . $theme . '/images/forums/emoticons'))
	{
		$filename		= $theme;
		$smiley_path	= $lb_domain . '/themes/' . $theme . '/images/forums/emoticons';
	}
	else
	{
		$theme			= $filename = 'default';
		$smiley_path	= $lb_domain . '/images/forums/emoticons';
	}
	
	# Load smilies from cache
	$smilies = $Cache->load('emoticons_' . $filename, true);
	
	# Loop through them and parse
	foreach ($smilies as $smilie)
	{
		$code		= $smilie['code'];
		$link		= $smilie['link'];
		$content	= str_replace($code, '<img src="' . $smiley_path . '/' . $link . '" alt="" />', $content);
	}

// SPOILER ALERT!

// while we are here, we need to make sure
// spoiler tags don't die on us when we add more than
// one spoiler (otherwise they break out of the tags!!)

	$spoiler_tag = array(); $i = 9999;
	while ($spoiler_str = stristr($content, '[spoiler]')) {
		$spoiler_str = substr($spoiler_str, 0, strpos($spoiler_str, '[/spoiler]') + 10);
		$content = str_replace($spoiler_str, "***spoiler_string***$i", $content);
		$spoiler_tag[$i] = $spoiler_str;
		$i++; //
	}

// Also, spoilers in the edit history need parsed
// seperately or they won't work correctly. Thus...	

	$spoiler_edit_tag = array(); $i = 9999;
	while ($spoiler_edit_str = stristr($content, '[spoiler_edit]')) {
		$spoiler_edit_str = substr($spoiler_edit_str, 0, strpos($spoiler_edit_str, '[/spoiler_edit]') + 15);
		$content = str_replace($spoiler_edit_str, "***spoiler_edit_string***$i", $content);
		$spoiler_edit_tag[$i] = $spoiler_edit_str;
		$i++; //
	}	

// Do word censor...

	/*
	If this isn't the first post, then the censors
	will have already been loaded.
*/
	
	if (!isset($censors))
	{
		$censors = $Cache->load('censor');
	}
	
	/*
	Now loop through and replace any bad words
*/

	foreach ($censors as $censor)
	{
		$content = str_replace($censor['word'], $censor['new_word'], $content);
	}
	
// Prepare the death ray!
// And fire the code back into the content! MWAHAHAHA!

 	$sc = count($spoiler_tag) + 9998;
 	for ($i=9999;$i <= $sc;$i++) {
		$tmp_spoiler_str = substr($spoiler_tag[$i], 9, -10);
 		$content = str_replace("***spoiler_string***$i", "<a class=\"spoiler-container img-error\" href=\"javascript: showhide('spoiler$post_id$i');\"> <span class=\"spoiler-alert\">".$lang['topic_spoiler']."</span> ".$lang['topic_spoiler_click']."</a><div id='spoiler$post_id$i' style='display: none;'>$tmp_spoiler_str</div>", $content );
 		}


	$sec = count($spoiler_edit_tag) + 9998;
 	for ($i=9999;$i <= $sec;$i++) {
		$tmp_spoiler_edit_str = substr($spoiler_edit_tag[$i], 14, -15);
 		$content = str_replace("***spoiler_edit_string***$i", "<a class=\"spoiler-container img-error\" href=\"javascript: showhide('spoiler_edit_$post_id$i')\"> <span class=\"spoiler-alert\">".$lang['topic_spoiler']."</span> ".$lang['topic_spoiler_click']."</a><div id='spoiler_edit_$post_id$i' style='display: none;'>$tmp_spoiler_edit_str</div>", $content );
 		}

 	$cc = count($code_tag) + 9998;
 	for ($i=9999;$i <= $cc;$i++) {
		$tmp_code_str = strip_slashes(substr($code_tag[$i], 6, -7));
		$tmp_code_str = str_replace("<br />","", $tmp_code_str);
		$tmp_str = str_replace('&quot;', '"', $tmp_str);		
 		$content = str_replace("***code_string***$i", "<blockquote class=\"code\"><div class=\"code-top\">Raw Code Snippet</div><code class=\"php\">$tmp_code_str</code></blockquote>", $content);
 		}

 	$pc = count($php_tag) + 9998;
	for ($i=9999;$i <= $pc;$i++) {
		
			$tmp_str = strip_slashes(substr($php_tag[$i], 5, -6));		
			$tmp_str = str_replace('&quot;', '"', $tmp_str);
			$tmp_str = str_replace("&#039;", "'", $tmp_str);			
			$tmp_str = str_replace("<br />", "", $tmp_str);
			$tmp_str = str_replace("\n", "", $tmp_str);
			
			#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
			# Maybe we don't want PHP tags displaying?
			#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
			
				$addedTags = false;
				
				if (strpos($tmp_str, '<?php') === false && strpos($tmp_str, '?>') === false)
				{
					# Append PHP tags to start & end
					$tmp_str	= '<?php' . "\n" . $tmp_str;
					$tmp_str	.= "\n" . '?>';
					
					# So we know to remove them later
					$addedTags	= true;
				}
			
			$tmp_str = highlight_string($tmp_str, true);
			
			#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
			# Remove the added tags
			#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
			
				if ($addedTags == true)
				{
					$tmp_str = str_replace('&lt;?php<br />', '', $tmp_str);
					$tmp_str = preg_replace('#<br />(.*?)\?&gt;#s', '$1', $tmp_str);
				}
			
			$tmp_str = str_replace('font color="', 'span style="color:', $tmp_str);
			$tmp_str = str_replace('<font', '<span', $tmp_str); // erm.					
			$content = str_replace("***php_string***$i", '<blockquote class="php-code"><div class="php-code-top">PHP Code Snippet</div><code class="php">'.$tmp_str.'</code></blockquote>', $content);	
			}				
		
if ($group_use_html=='1'){

// Stick in the HTML again...

 	$hc = count($html_tag) + 9998;
 	for ($i=9999;$i <= $hc;$i++)
	{	
		$find		= array('&quot;', '&lt;', '&gt;');
		$replace	= array('"', '<', '>');
		
		$tmp_html_str = strip_slashes(substr($html_tag[$i], 6, -7));
		$tmp_html_str = str_replace($find, $replace, $tmp_html_str);
		
 		$content = str_replace("***html_string***$i", "$tmp_html_str", $content);
 	}

}

	$content = str_replace("<?php", "&lt;?php", "$content");
	$content = str_replace("?>", "?&gt;", "$content");

	$content = str_replace(" http://", "http://", $content);
	$content = str_replace("\r\n", "<br />", $content);
	$content = trim($content);

?>
