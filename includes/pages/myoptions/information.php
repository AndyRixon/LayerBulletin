<?php

/*
+--------------------------------------------------------------------------
|  LayerBulletin
|  ========================================
|  By The LayerBulletin team
|  Released under the Artistic License 2.0
|  http://layerbulletin.com/
|  ========================================
|   information.php - member information page
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/myoptions/information.template.php", "start");

if($_GET['success']=='saved'){
        template_hook("pages/myoptions/information.template.php", "successSaved");
}

if ($_POST['form_submit'] == '')
{
        $token_id = md5(microtime());
        $token = md5(uniqid(rand(),true));

        $token_name = "token_information_{$token_id}";

        $_SESSION[$token_name] = $token;

        // Grab member info...
        $name = $_COOKIE['lb_name'];
        $name = escape_string($name);

        $query211 = "select NATIONALITY, LOCATION, MSN, AOL, YAHOO, SKYPE, XBOX, WII, PS3 from {$db_prefix}members WHERE NAME='$name'" ;
        $result211 = mysql_query($query211) or die("information.php - Error in query: $query211") ;                                  

        while ($results211 = mysql_fetch_array($result211))
        {
                $nationality = $results211['NATIONALITY'];
                $location = $results211['LOCATION'];
                $msn = $results211['MSN'];
                $aol = $results211['AOL'];
                $yahoo = $results211['YAHOO'];
                $skype = $results211['SKYPE'];
                $xbox = $results211['XBOX'];
                $wii = $results211['WII'];
                $ps3 = $results211['PS3'];
        }

        $location = strip_slashes($location);
        $msn = strip_slashes($msn);
        $aol = strip_slashes($aol);
        $yahoo = strip_slashes($yahoo);
        $skype = strip_slashes($skype);
        $xbox = strip_slashes($xbox);
        $wii = strip_slashes($wii);
        $ps3 = strip_slashes($ps3);

        template_hook("pages/myoptions/information.template.php", "1");

        $query21 = "select NATION_NAME, NATION_SHORT from {$db_prefix}nations ORDER BY NATION_NAME asc" ;
        $result21 = mysql_query($query21) or die("information.php - Error in query: $query21") ;
                                  
        while ($results21 = mysql_fetch_array($result21))
        {
                $nationname = $results21['NATION_NAME'];
                $nationshort = $results21['NATION_SHORT'];

                template_hook("pages/myoptions/information.template.php", "2");
        }

        template_hook("pages/myoptions/information.template.php", "3");

        $query432 = "select ID, NAME, DESCRIPTION, ORDER_FIELD from {$db_prefix}custom_fields ORDER BY ID desc";
        $result432 = mysql_query($query432) or die("custom.php - Error in query: $query432") ;
        $custom_fields_count = mysql_num_rows($result432);

        if ($custom_fields_count != '0')
        {
                template_hook("pages/myoptions/information.template.php", "custom");
        }

        while ($results432 = mysql_fetch_array($result432))
        {
                $field_id = $results432['ID'];
                $field_name = strip_slashes($results432['NAME']);
                $field_description = strip_slashes($results432['DESCRIPTION']);
                $order_field = $results432['ORDER_FIELD'];

                $query433 = "select CONTENT from {$db_prefix}custom_members WHERE MEMBER_ID='$my_id' AND FIELD_ID='$field_id'";
                $result433 = mysql_query($query433) or die("custom.php - Error in query: $query433") ;
                if ($custom_fields_count != '0')
                {
                        while ($results433 = mysql_fetch_array($result433))
                        {
                                $field_content = strip_slashes($results433['CONTENT']);
                        }

                        template_hook("pages/myoptions/information.template.php", "4");

                }
        }

        template_hook("pages/myoptions/information.template.php", "5");
}
else
{

        $token_id = $_POST['token_id'];
        $token_id = escape_string($token_id);
        $token_name = "token_information_$token_id";

        if ( (isset($_POST[$token_name])) && (isset($_SESSION[$token_name])) && ($_SESSION[$token_name] == $_POST[$token_name]) )
        {
				
				$nationality_check = escape_string($_POST['nationality']);
				
				//fix so they can't enter a value that shouldn't be in nationality. gcode issue 142
				$get_nation = mysql_query("SELECT `nation_short` FROM `{$db_prefix}nations` WHERE `nation_short` = '{$nationality_check}' LIMIT 1");
				
				if(mysql_num_rows($get_nation) != 1) {
				
					$_POST['nationality'] = '';
				
				}
		
                $location = $_POST['location'];
                $location = escape_string($location);
                $nationality = $_POST['nationality'];
                $nationality = escape_string($nationality);
                $msn = $_POST['msn'];
                $msn = escape_string($msn);
                $aol = $_POST['aol'];
                $aol = escape_string($aol);
                $yim = $_POST['yim'];
                $yim = escape_string($yim);
                $skype = $_POST['skype'];
                $skype = escape_string($skype);
                $xbox = $_POST['xbox'];
                $xbox = escape_string($xbox);
                $wii = $_POST['wii'];
                $wii = escape_string($wii);
                $ps3 = $_POST['ps3'];
                $ps3 = escape_string($ps3);
				
                if ($show_gamer_tags == '1')
                {
                        mysql_query("UPDATE {$db_prefix}members SET location='$location', nationality='$nationality', msn='$msn', aol='$aol', yahoo='$yim', skype='$skype', xbox='$xbox', wii='$wii', ps3='$ps3' WHERE id = '$my_id'");
                }
                else
                {
                        mysql_query("UPDATE {$db_prefix}members SET location='$location', nationality='$nationality', msn='$msn', aol='$aol', yahoo='$yim', skype='$skype' WHERE id = '$my_id'");
                }

                // custom field update
                $query4321 = "select ID from {$db_prefix}custom_fields ORDER BY ID desc";
                $result4321 = mysql_query($query4321) or die("custom.php - Error in query: $query4321") ;

                while ($results4321 = mysql_fetch_array($result4321))
                {
                        $field_id_field = $results4321['ID'];

                        $query432 = "select FIELD_ID from {$db_prefix}custom_members WHERE MEMBER_ID='$my_id' AND FIELD_ID='$field_id_field'";
                        $result432 = mysql_query($query432) or die("information.php - Error in query: $query432") ;

                        $number_of_fields = mysql_num_rows($result432);

                        $field_content_id = "custom"."$field_id_field";
                        $field_content = escape_string($_POST[$field_content_id]);

                        if ($number_of_fields == '0' && $field_content != '')
                        {
                                mysql_query("INSERT INTO {$db_prefix}custom_members (field_id, content, member_id) VALUES ('$field_id_field', '$field_content', '$my_id')");
                        }
                        elseif ($number_of_fields != '0' && $field_content == '')
                        {
                                mysql_query("DELETE FROM {$db_prefix}custom_members WHERE MEMBER_ID='$my_id' AND FIELD_ID='$field_id_field'");
                        }
                        elseif ($number_of_fields != '0' && $field_content != '')
                        {
                                while ($results432 = mysql_fetch_array($result432))
                                {
                                        $field_id = $results432['FIELD_ID'];

                                        mysql_query("UPDATE {$db_prefix}custom_members SET content='$field_content' WHERE MEMBER_ID='$my_id' AND FIELD_ID='$field_id_field'");
                                }

                        }
                }

	        template_hook("pages/myoptions/information.template.php", "form");

	        lb_redirect("index.php?page=myoptions&act=information&success=saved","myoptions/information/success/saved");

        }
        else
        {
	        lb_redirect("index.php?page=error&error=28","error/28");
        }
}

template_hook("pages/myoptions/information.template.php", "end");

?>
