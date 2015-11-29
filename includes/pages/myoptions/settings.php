<?php

/*
+--------------------------------------------------------------------------
|  LayerBulletin
|  ========================================
|  By The LayerBulletin team
|  Released under the Artistic License 2.0
|  http://layerbulletin.com/
|  ========================================
|   settings.php - forum general settings page
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/myoptions/settings.template.php", "start");

if($_GET['success']=='saved') {
        template_hook("pages/myoptions/settings.template.php", "successSaved");
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

        $query211 = "select ALLOW_ADMIN_EMAIL, SHOW_FAST_REPLY from {$db_prefix}members WHERE NAME='$name'" ;
        $result211 = mysql_query($query211) or die("information.php - Error in query: $query211") ;                                  

        while ($results211 = mysql_fetch_array($result211))
        {
                $allow_admin_email = $results211['ALLOW_ADMIN_EMAIL'];
                $show_fast_reply = $results211['SHOW_FAST_REPLY'];
        }

        template_hook("pages/myoptions/settings.template.php", "1");
        template_hook("pages/myoptions/settings.template.php", "2");
        template_hook("pages/myoptions/settings.template.php", "3");
}
else
{
        $token_id = $_POST['token_id'];
        $token_id = escape_string($token_id);
        $token_name = "token_information_$token_id";

        if ( (isset($_POST[$token_name])) && (isset($_SESSION[$token_name])) && ($_SESSION[$token_name] == $_POST[$token_name]) )
        {
	        $allow_admin_email = $_POST['allow_admin_email'];
	        $allow_admin_email = escape_string($allow_admin_email);
	        $show_fast_reply = $_POST['show_fast_reply'];
	        $show_fast_reply = escape_string($show_fast_reply);

	        mysql_query("UPDATE {$db_prefix}members SET allow_admin_email='$allow_admin_email', show_fast_reply='$show_fast_reply' WHERE id = '$my_id'");

	        template_hook("pages/myoptions/settings.template.php", "form");

	        lb_redirect("index.php?page=myoptions&act=settings&success=saved","myoptions/settings/success/saved");
        }
        else
        {
	        lb_redirect("index.php?page=error&error=28","error/28");
        }
}

template_hook("pages/myoptions/settings.template.php", "end");

?>
