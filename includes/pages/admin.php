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
|   admin.php - Display admin page
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/admin.template.php", "start");

	// PERMISSIONS!! Can they view this area?

		if ($can_change_forum_settings=='0' && $can_change_site_settings=='0'){

			lb_redirect("index.php?page=error&error=11","error/11");
		
		}

		else{

			$act = escape_string($_GET['act']);

			template_hook("pages/admin.template.php", "1");

			$query291 = "select CONFIG_PAGE from {$db_prefix}modules WHERE CONFIG_PAGE!=''";
			$result291 = mysql_query($query291) or die("modules.php - Error in query: $query291") ;  
			$config_modules = mysql_num_rows($result291);

			if ($config_modules!='0'){

				template_hook("pages/admin.template.php", "2");

				// if a module is needing a config page
				// list it here...

				$query291 = "select DISPLAY_NAME, MODULE_NAME, CONFIG_PAGE from {$db_prefix}modules WHERE CONFIG_PAGE!=''";
				$result291 = mysql_query($query291) or die("modules.php - Error in query: $query291") ;  
											  
				while ($results291 = mysql_fetch_array($result291)){
					$display_name = $results291['DISPLAY_NAME'];
					$module_name = $results291['MODULE_NAME'];
					$config_page = $results291['CONFIG_PAGE'];

					if ($config_page == $act){
						$curModule = $module_name;
					}

					// got its name, now get the page
					// to configure...

					template_hook("pages/admin.template.php", "3");

				}

				template_hook("pages/admin.template.php", "4");
			}


			template_hook("pages/admin.template.php", "5");

			if (strstr($act, '..') || strstr($act, '/'))
			{
				header("HTTP/1.0 200 OK");
				header('Location: index.php?page=error&error=29');
				exit;
			}

			if (file_exists("modules/$curModule/includes/pages/admin/$act.php")){
				include "modules/$curModule/includes/pages/admin/$act.php";
			}
			elseif ($_GET['act']==''){

					if (file_exists("themes/$theme/includes/pages/admin/home.php")){
						include "themes/$theme/includes/pages/admin/home.php";
					}
					elseif (@include("includes/pages/admin/home.php")){
					}
					else{
						header("HTTP/1.0 200 OK");
						header('Location: index.php?page=error&error=29');
						exit;
					}
			}
			else{

				if (file_exists("themes/$theme/includes/pages/admin/$act.php")){
					include "themes/$theme/includes/pages/admin/$act.php";
				}
				elseif (@include("includes/pages/admin/$act.php")){
				}
				else{
					header("HTTP/1.0 200 OK");
					header('Location: index.php?page=error&error=29');
					exit;
				}
			}

			template_hook("pages/admin.template.php", "6");

		}

		template_hook("pages/admin.template.php", "end");

?>
