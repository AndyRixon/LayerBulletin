<?php

/*
+--------------------------------------------------------------------------
|  LayerBulletin
|  ========================================
|  By The LayerBulletin team
|  Released under the Artistic License 2.0
|  http://layerbulletin.com/
|  ========================================
|  breadcrumbs.php - sorts out the breadcrumbs path
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("breadcrumbs.template.php", "start");
template_hook("breadcrumbs.template.php", "1");

if (!isset($_GET['page']) && isset($_GET['forum']) && is_numeric($_GET['forum']))
{
	$forum_id = (int) $_GET['forum'];

		/*
		The query to get category breadcrumbs
	*/
	
		$query = '	SELECT
						c1.name AS name1,	c1.id AS id1,
						c2.name AS name2,	c2.id AS id2,
						c3.name AS name3,	c3.id AS id3
						
					FROM
						' . $db_prefix . 'categories c1
						
						LEFT JOIN
							' . $db_prefix . 'categories c2
							ON c2.id = c1.parent
							
							LEFT JOIN
								' . $db_prefix . 'categories c3
								ON c3.id = c2.parent
					
					WHERE
						c1.id = ' . $forum_id
		;
	
		/*
		So we know which query to run
	*/
	
		$doQuery = 'forum';
}
elseif (!isset($_GET['page']) && isset($_GET['topic']) && is_numeric($_GET['topic']))
{
	// get forum title that the topic is in
	
		$topic_id = (int) $_GET['topic'];
	
		/*
		The query to get topic & category breadcrumbs
	*/
	
		$query = '	SELECT
						p.title,			p.forum_id,
						c1.name AS name1,	c1.id AS id1,
						c2.name AS name2,	c2.id AS id2,
						c3.name AS name3,	c3.id AS id3
					
					FROM
						' . $db_prefix . 'posts p
						
						LEFT JOIN
							' . $db_prefix . 'categories c1
							ON c1.id = p.forum_id
							
							LEFT JOIN
								' . $db_prefix . 'categories c2
								ON c2.id = c1.parent
								
								LEFT JOIN
									' . $db_prefix . 'categories c3
									ON c3.id = c2.parent
					
					WHERE
						p.topic_id = ' . $topic_id . '
					AND
						p.title != ""
		';
		
		/*
		So we know which query to run
	*/
	
		$doQuery = 'topic';
}
else
{
	$doQuery = false;
}

if ($doQuery !== false)
{
	
		/*
		Run the query
	*/
	
		$result = mysql_fetch_object(mysql_query($query));
	
		/*
		Change to match template variables
	*/
	
		if ($doQuery == 'topic')
		{
			$title						= strip_slashes($result->title);
			$forum_id					= $result->forum_id;
			$topic_title				= clean_url_seo($title);
		}
		
		$name						= strip_slashes($result->name1);
		$forum_title				= clean_url_seo($name);
		
		$parent_name				= strip_slashes($result->name2);
		$parent_id					= $result->id2;
		$forum_title_parent			= clean_url_seo($parent_name);
		
		$parent_name_last			= strip_slashes($result->name3);
		$parent_id_last				= $result->id3;
		$forum_title_parent_last	= clean_url_seo($parent_name_last);
		
		/*
		Extra (add reply, new topic, etc)
	*/
	
		$extra = '';
	
		if ($_GET['func'] == 'newpost')
		{
			$extra = ' > ' . $lang['button_new_topic'];
		}
		elseif ($_GET['func'] == 'addreply')
		{
			$extra = ' > ' . $lang['button_add_reply'];
		}

		/*
		Display...
	*/
	
		template_hook("breadcrumbs.template.php", "2");
		
		if ($doQuery == 'topic')
		{
			template_hook("breadcrumbs.template.php", "3");
		}
		
		if ($extra != '')
		{
			template_hook('breadcrumbs.template.php', 6);
		}
}

else
{

	// this is a page, not a forum or topic, so get it's title...
	
		$location_name = location_page("breadcrumbs");

		if ($location_name!=''){

			template_hook("breadcrumbs.template.php", "4");

		}

}

template_hook("breadcrumbs.template.php", "5");
template_hook("breadcrumbs.template.php", "end");

?>