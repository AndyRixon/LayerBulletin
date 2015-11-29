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
|   move.php - move topic to another forum
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("forums/move.template.php", "start");

if ($can_move_topics == 0)
        lb_redirect("index.php?page=error&error=8","error/8");


if ($_POST['forum'] != '')
{
        $topic = $_POST['topic'];
        $topic = escape_string($topic);

        $token_id = $_POST['token_id'];
        $token_id = escape_string($token_id);

        $token_name = "token_move_$topic$token_id";

        if ( isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name])
        {
                $forum = $_POST['forum'];
                $forum = escape_string($forum);

                // create shadow topic
                if ($_POST['shadow_topic'])
                {
                        $query_topic_id = "SELECT `topic_id` FROM `{$db_prefix}posts` WHERE `title` != '' ORDER BY `topic_id` DESC LIMIT 1";
                        $result_topic_id = mysql_query($query_topic_id) or die("move.php - Error in query: {$query_topic_id}");
                        $count_topics = mysql_num_rows($result_topic_id);                                  
                        $topic_id = mysql_result($result_topic_id, 0);

                        $topic_id += 1;

                        $topic_info_query = "SELECT title, description, forum_id FROM `{$db_prefix}posts` WHERE `topic_id` = '{$topic}' LIMIT 1";
                        $topic_info_result = mysql_query($topic_info_query) or die("move.php - Error in query: {$topic_info_query}");
                        $topic_info = mysql_fetch_assoc($topic_info_result);

                        $forum_name_query = "SELECT `name` FROM `{$db_prefix}categories` WHERE `id` = '{$forum}' LIMIT 1";
                        $forum_name_result = mysql_query($forum_name_query) or die("move.php - Error in query: {$forum_name_query}");
                        $forum_name = mysql_result($forum_name_result, 0);

                        $subject		= '[moved] ' . $topic_info['title'];
                        $time			= time();
                        $description	= $topic_info['description'];
                        $content		= 'Topic has moved to [url='. lb_link('index.php?topic=' . $topic, 'topic/' . $topic_title-$topic) .']'. $forum_name.'[/url]';
                        $shadow_forum	= $topic_info['forum_id'];
                        $sticky			= 0;
                        $locked			= 1;
                        $announce		= 0;
						$ip				= $_SERVER['REMOTE_ADDR'];

                        $query_shadow = "INSERT INTO `{$db_prefix}posts`
                                         (`member`, `address`, `title`, `description`, `content`, `topic_id`, `forum_id`, `sticky`, `announce`, `locked`, `last_post_time`, `time`)
                                         VALUES
                                         ('{$my_id}', '{$ip}', '{$subject}', '{$description}', '{$content}', '{$topic_id}', '{$shadow_forum}', '{$sticky}', '{$announce}', '{$locked}', '{$time}', '{$time}')";

                        mysql_query($query_shadow) or die();
                }

                mysql_query("UPDATE `{$db_prefix}posts` SET `forum_id`='{$forum}' WHERE `topic_id` = '{$topic}'");

                // perform auto-cache
                include "scripts/php/auto_cache.php";	

	        template_hook("forums/move.template.php", "form");

	        $topic_title = topic_title($topic);	
	
	        lb_redirect("index.php?topic=$topic","topic/$topic_title-$topic");

        }
        else
        {
	        lb_redirect("index.php?page=error&error=28","error/28");
        }
}
else
{

        $token_id = md5(microtime());
        $token = md5(uniqid(rand(),true));

        $topic = $_GET['topic'];
        $topic = escape_string($topic);

        $token_name = "token_move_$topic$token_id";

        $_SESSION[$token_name] = $token;

        template_hook("forums/move.template.php", "2");

        $query211 = "select ID, NAME from {$db_prefix}categories WHERE PARENT='0' AND REDIRECT_URL = '' ORDER BY FORUM_ORDER asc, ID desc" ;
        $result211 = mysql_query($query211) or die("move.php - Error in query: $query211") ;

        while ($results211 = mysql_fetch_array($result211))
        {
                $id = $results211['ID'];
                $name = $results211['NAME'];

                $name = strip_slashes($name);

                template_hook("forums/move.template.php", "3");

                $query2 = "select ID, NAME from {$db_prefix}categories WHERE PARENT='{$id}' AND REDIRECT_URL = '' ORDER BY FORUM_ORDER asc, ID desc" ;
                $result2 = mysql_query($query2) or die("move.php - Error in query: $query2") ;

                while ($results2 = mysql_fetch_array($result2))
                {
                        $forum_id = $results2['ID'];
                        $forum_name = $results2['NAME'];

                        $forum_name = strip_slashes($forum_name);

                        template_hook("forums/move.template.php", "4");

                        $query_sub = "select ID, NAME from {$db_prefix}categories WHERE PARENT='{$forum_id}' AND REDIRECT_URL = '' AND ID <> '{$current_forum}' ORDER BY FORUM_ORDER asc, ID desc" ;
                        $result_sub = mysql_query($query_sub) or die("move.php - Error in query: $query2") ;

                        while ($results_sub = mysql_fetch_array($result_sub))
                        {
                                $forum_id = $results_sub['ID'];
                                $forum_name = $results_sub['NAME'];

                                $forum_name = strip_slashes($forum_name);

                                template_hook("forums/move.template.php", "5");
                        }
                }

                template_hook("forums/move.template.php", "6");
        }

        template_hook("forums/move.template.php", "7");
}

template_hook("forums/move.template.php", "end");

?>
