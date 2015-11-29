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
|   modules.php - install/remove forum modules
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

require_once "scripts/php/dUnzip2.inc.php";

template_hook("pages/admin/modules.template.php", "start");

if ($can_change_site_settings=='0'){

	lb_redirect("index.php?page=error&error=11","error/11");

}

else{

foreach (glob("modules/*.zip") as $file_name) {
unlink ($file_name);
}
if (isset($_POST['upload'])){

$contenttype = $_FILES['uploadedfile']['type'];

$file=$_FILES['uploadedfile']['name'];

$parts			= explode('.', $file);
$ext			= $parts[count($parts)-1];
$contenttype	= strtolower($ext);

if ($contenttype=='zip'){
$allowed="1";
}
else{
$allowed="0";
}

if ($allowed=='0'){
echo "contenttype = $contenttype<br /><br />";

exit("You are not allowed to upload files with this extension.");
}
else{

// Where the file is going to be placed 
$target_path = "modules/";

$file_name = $_FILES['uploadedfile']['name'];

$new_file_name = $file_name;

$target_path_complete = $target_path . basename( $new_file_name); 
$_FILES['uploadedfile']['tmp_name'];  

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path_complete)) {

if($contenttype == 'zip'){

$zip = new dUnzip2('modules/'.$file_name);
$zip->debug = true;
$zip->getList();
$zip->unzipAll('modules');

}

foreach (glob("modules/*.zip") as $filename) {
unlink ($filename);
}

	template_hook("pages/admin/modules.template.php", "form_1");

	lb_redirect("index.php?page=admin&act=modules","admin/modules");

}

}

}

elseif (isset($_GET['alter']) && ($_GET['alter']=='rss')){

$order = $_POST['order'];
$order = escape_string($order);

$limit = $_POST['limit'];
$limit = escape_string($limit);

$method = $_POST['method'];
$method = escape_string($method);

mysql_query("UPDATE {$db_prefix}settings SET module_order='$order', module_limit='$limit', module_method='$method'");

# Remove settings cache
$Cache->delete('settings');

	template_hook("pages/admin/modules.template.php", "form_2");

	lb_redirect("index.php?page=admin&act=modules","admin/modules");

}
elseif (isset($_GET['func']) && ($_GET['func']=='update2')){

$folders = array(); 
$index = array(); 
 
$basedir = 'modules/'; 
$dh = opendir( $basedir ); 
 
clearstatcache(); 
while ( FALSE !== ($entry = readdir( $dh )) ) 
if ( $entry != '.' && $entry != '..' ) 
{ 
$path = $basedir.$entry; 
if ( is_dir( $path ) ) 
{ 
$folders[] = $path; 
$index[] = filemtime( $path ); 
} 
} 
 
asort( $index ); 
foreach ( $index as $i => $t ) 
 
$array[] = $folders[$i]; 
 
$last_element = end($array);  

$last_element = str_replace("modules/", "", $last_element);

// tell database we exist and are installed

mysql_query("INSERT INTO {$db_prefix}modules (module_name, installed) VALUES ('$last_element', '1')");

// then run the update script...

if (file_exists("modules/$last_element/update.php")){
include "modules/$last_element/update.php";
}

	template_hook("pages/admin/modules.template.php", "form_3");

	lb_redirect("index.php?page=admin&act=modules","admin/modules");

}

elseif (isset($_GET['func']) && ($_GET['func']=='update')){

// first... delete the original modules folder 
// (so we don't clash you see)

$original_module = escape_string($_GET['module']);

// tell the database it's not installed before removing...

mysql_query("DELETE FROM {$db_prefix}modules WHERE module_name ='$original_module'");

lb_remove("modules/$original_module");

// then extract the update...

$module_file = escape_string($_GET['update_url']);

lb_remote($module_file, "modules/");

$filename = basename($module_file);

// Where the file is going to be placed 
$target_path = "modules/";

$zip = new dUnzip2('modules/'.$filename);
$zip->debug = true;
$zip->getList();
$zip->unzipAll('modules');

foreach (glob("modules/*.zip") as $file_name) {
unlink ($file_name);
}

	header("HTTP/1.0 200 OK");
	header('Location: index.php?page=admin&act=modules&func=update2');
	exit;
	
}
elseif (isset($_GET['func']) && ($_GET['func']=='remote')){

// first warn the admin about what he/she is about to do
// because this feature could be maliciously abused by
// crafty people wanting you to install nasty things
// onto the server...

if ($_POST['agree']!='1'){

$file = escape_string($_GET['file']);
$modulename = escape_string($_GET['module']);
$func = escape_string($_GET['func']);

template_hook("pages/admin/modules.template.php", "warn");

}
else{

$module_file = escape_string($_GET['file']);

if(strpos($module_file, "http://plugins.layerbulletin.com") === false){

	lb_redirect("index.php?page=error","error");
	
}
else{

lb_remote(" http://plugins.layerbulletin.com/files/".$module_file, "modules/");
$filename = basename(" http://plugins.layerbulletin.com/files/".$module_file); 

// Where the file is going to be placed 
$target_path = "modules/";

$zip = new dUnzip2('modules/'.$filename);
$zip->debug = true;
$zip->getList();
$zip->unzipAll('modules');

foreach (glob("modules/*.zip") as $file_name) {
unlink ($file_name);
}

	template_hook("pages/admin/modules.template.php", "form_4");

	lb_redirect("index.php?page=admin&act=modules","admin/modules");
}
}
}
elseif (isset($_GET['func']) && ($_GET['func']=='install')){

// first warn the admin about what he/she is about to do
// because this feature could be maliciously abused by
// crafty people wanting you to install nasty things
// onto the server...

if ($_POST['agree']!='1'){

$file = escape_string($_GET['file']);
$modulename = escape_string($_GET['module']);
$func = escape_string($_GET['func']);

template_hook("pages/admin/modules.template.php", "warn");

}
else{

$module_name = escape_string($_GET['module']);

mysql_query("DELETE FROM {$db_prefix}modules WHERE module_name ='$module_name'");

mysql_query("INSERT INTO {$db_prefix}modules (module_name, installed) VALUES ('$module_name', '1')");

if (file_exists("modules/$module_name/install.php")){
include "modules/$module_name/install.php";
}

	template_hook("pages/admin/modules.template.php", "form_5");

	lb_redirect("index.php?page=admin&act=modules","admin/modules");

}
}
elseif (isset($_GET['func']) && ($_GET['func']=='remove'))
{
	// first warn the admin about what he/she is about to do
	// because this feature could be maliciously abused by
	// crafty people wanting you to install nasty things
	// onto the server...

	if ($_POST['agree']!='1')
	{
		$file		= escape_string($_GET['file']);
		$modulename	= escape_string($_GET['module']);
		$func		= escape_string($_GET['func']);
		
		list($token_id, $token, $token_name) = tokenCreate('modules_remove', $modulename);
		
		template_hook("pages/admin/modules.template.php", "warn");
	}
	else
	{
		$module_name = escape_string($_GET['module']);
		
		if (tokenCheck('modules_remove', $module_name))
		{
			mysql_query("DELETE FROM {$db_prefix}modules WHERE module_name ='$module_name'");
			
			if (file_exists("modules/$module_name/uninstall.php"))
			{
				include "modules/$module_name/uninstall.php";
			}
			
			template_hook("pages/admin/modules.template.php", "form_6");
			lb_redirect("index.php?page=admin&act=modules","admin/modules");
		}
		else
		{
			lb_redirect('index.php?page=error&error=28', 'error/28');
		}
	}
}
elseif (isset($_GET['func']) && ($_GET['func']=='delete'))
{
	// first warn the admin about what he/she is about to do
	// because this feature could be maliciously abused by
	// crafty people wanting you to install nasty things
	// onto the server...

	if ($_POST['agree']!='1')
	{
		$file		= escape_string($_GET['file']);
		$modulename	= escape_string($_GET['module']);
		$func		= escape_string($_GET['func']);
		
		list($token_id, $token, $token_name) = tokenCreate('modules_delete', $modulename);
		
		template_hook("pages/admin/modules.template.php", "warn");
	}
	else
	{
		$module_name = escape_string($_GET['module']);
		
		if (tokenCheck('modules_delete', $module_name))
		{
			lb_remove("modules/$module_name");
			
			template_hook("pages/admin/modules.template.php", "form_7");
			lb_redirect("index.php?page=admin&act=modules","admin/modules");
		}
		else
		{
			lb_redirect('index.php?page=error&error=28', 'error/28');
		}
	}
}
else{

// if we've just updated then we should remove the update and the folder...

$query2 = "select MODULE_NAME from {$db_prefix}modules WHERE MODULE_NAME='lb_update'" ;
$result2 = mysql_query($query2) or die("header.php - Error in query: $query2") ;                                  
$update_installed = mysql_num_rows($result2);

if ($update_installed=='1'){
lb_remove("modules/lb_update");
mysql_query("DELETE FROM {$db_prefix}modules WHERE module_name ='lb_update'");
}

template_hook("pages/admin/modules.template.php", "1");

list_modules("modules/", "details");

template_hook("pages/admin/modules.template.php", "3");
#template_hook("pages/admin/modules.template.php", "4");
template_hook('pages/admin/modules.template.php', 'remote_replacement');

/*template_hook("pages/admin/modules.template.php", "4");

class RSSParser	{

    var $title			= "";
	var $version 		= "";
	var $date 			= "";
	var $downloads		= "";
    var $link 			= "";
    var $description 	= "";
	var $author			= "";
	var $site			= "";
	var $image			= "";
    var $inside_item 	= false;


	function startElement( $parser, $name, $attrs='' ){
		global $current_tag;

		$current_tag = $name;

		if( $current_tag == "ITEM" )
			$this->inside_item = true;

	} // endfunc startElement

	function endElement( $parser, $tagName, $attrs='' ){
		global $current_tag;

    	if ( $tagName == "ITEM" ) {

		$title = $this->title;		
		$version = $this->version;
		$date = $this->date;
		$downloads = $this->downloads;	
		$link = $this->link;
		$link = str_replace(" http://plugins.layerbulletin.com/files/", "", $link); 
		$description = $this->description;
		$author = $this->author;
		$site = $this->site;
		$image = $this->image;
	
		
		template_hook("pages/admin/modules.template.php", "5");
			echo "$image";
		template_hook("pages/admin/modules.template.php", "14");
			echo "$title";			
		template_hook("pages/admin/modules.template.php", "6");
			echo "$version";
		template_hook("pages/admin/modules.template.php", "7");
			echo "$author";
		template_hook("pages/admin/modules.template.php", "8");
			echo "$site";		
		template_hook("pages/admin/modules.template.php", "9");
			echo "$site";			
		template_hook("pages/admin/modules.template.php", "10");	
			echo "$description";
		template_hook("pages/admin/modules.template.php", "11");	
			echo "$link";
		template_hook("pages/admin/modules.template.php", "12");	
		
    		$this->title = "";
			$this->version = "";
    		$this->date = "";
    		$this->downloads = "";			
    		$this->link = "";
    		$this->description = "";
    		$this->author = "";	
    		$this->site = "";
    		$this->image = "";			
    		$this->inside_item = false;

    	}

	} // endfunc endElement

	function characterData( $parser, $data ){
		global $current_tag;

		if( $this->inside_item ){
			switch($current_tag){

				case "TITLE":
					$this->title .= $data;
					break;
				case "VERSION":
					$this->version .= $data;
					break;	
				case "DATE":
					$this->date .= $data;
					break;
				case "DOWNLOADS":
					$this->downloads .= $data;
					break;					
				case "LINK":
					$this->link .= $data;
					break;
				case "DESCRIPTION":
					$this->description .= $data;
					break;
				case "AUTHOR":
					$this->author .= $data;
					break;
				case "SITE":
					$this->site .= $data;
					break;					
				case "IMAGE":
					$this->image .= $data;
					break;	
				default:
					break;		
		
			} // endswitch

		} // end if
		
	} // endfunc characterData

	function parse_results( $xml_parser, $rss_parser, $file )	{

		xml_set_object( $xml_parser, &$rss_parser );
		xml_set_element_handler( $xml_parser, "startElement", "endElement" );
		xml_set_character_data_handler( $xml_parser, "characterData" );

		$fp = fopen("$file","r") or die( "Error reading XML file, $file" );

		while ($data = fread($fp, 4096))	{

			// parse the data
			xml_parse( $xml_parser, $data, feof($fp) ) or die( sprintf( "XML error: %s at line %d", xml_error_string( xml_get_error_code($xml_parser) ), xml_get_current_line_number( $xml_parser ) ) );

		} // endwhile

		fclose($fp);

		xml_parser_free( $xml_parser );

	} // endfunc parse_results

} // endclass RSSParser

global $rss_url;

$xml_parser = xml_parser_create();
$rss_parser = new RSSParser();

$parse_lb_version = str_replace(" ", "_", $lb_version);

$rss_parser->parse_results( $xml_parser, $rss_parser, "http://plugins.layerbulletin.com/$parse_lb_version/$module_order/$module_limit/$module_method/files.php" );

template_hook("pages/admin/modules.template.php", "3");

template_hook("pages/admin/modules.template.php", "13");*/


}
}

template_hook("pages/admin/modules.template.php", "end");

?>