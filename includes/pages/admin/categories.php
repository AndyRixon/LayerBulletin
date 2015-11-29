<?php

/*
+--------------------------------------------------------------------------
|   LayerBulletin
|   ========================================
|   By LayerBulletin Team
|   (c) 2014 LayerBulletin Team
|   http://layerbulletin.com/
|   ========================================
|   categories.php - create/edit/delete forums
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/admin/categories.template.php", "start");

switch ($_GET['success']) {
	case 'updated':
		template_hook("pages/admin/categories.template.php", "successUpdated");
		break;
	
	case 'deleted':
		template_hook("pages/admin/categories.template.php", "successDeleted");
		break;

	case 'updated_permission':
		template_hook("pages/admin/categories.template.php", "successUpdatedPerm");
		break;

	case 'added':
		template_hook("pages/admin/categories.template.php", "successAdded");
		break;
}

if ($can_change_forum_settings=='0'){

	lb_redirect("index.php?page=error&error=11","error/11");

}

elseif ($_GET['func']=='delete')
{
	if ($_POST['agree']!='1')
	{
		list($token_id, $token, $token_name) = tokenCreate('categories_delete', (int) $_GET['id']);
		
		template_hook("pages/admin/categories.template.php", "warn");
	}
	else
	{
		$category_post_id = (int) $_GET['id'];
		
		if (tokenCheck('categories_delete', $category_post_id))
		{
			$query212 = "select ID from {$db_prefix}posts WHERE FORUM_ID='$category_post_id'" ;
			$result212 = mysql_query($query212) or die("delete.php - Error in query: $query212") ;                                  
			while ($results212 = mysql_fetch_array($result212))
			{
				$remove_id = $results212['ID'];

				// first, delete attachments associated with these posts...

				$query2121 = "select FILENAME from {$db_prefix}attachments WHERE POSTID='$remove_id'" ;
				$result2121 = mysql_query($query2121) or die("delete.php - Error in query: $query2121") ;                                  
				while ($results2121 = mysql_fetch_array($result2121))
				{
					$filename = strip_slashes($results2121['FILENAME']);

					foreach (glob("uploads/attachments/$filename") as $filename)
					{
					   unlink($filename);
					}

					foreach (glob("uploads/attachments/t_$filename") as $filename)
					{
					   unlink($filename);
					}

					mysql_query("DELETE FROM {$db_prefix}attachments WHERE postid ='$remove_id'");
				}
			}

			mysql_query('
					DELETE p.*, pl.*, plv.*
					FROM ' . $db_prefix . 'posts p
					LEFT JOIN ' . $db_prefix . 'polls pl
							ON p.topic_id = pl.topic_id
							LEFT JOIN ' . $db_prefix . 'polls_votes plv
									ON pl.id = plv.poll_id
					WHERE forum_id = ' . $category_post_id
			);
			mysql_query("DELETE FROM {$db_prefix}categories WHERE id ='$category_post_id'");
			mysql_query("DELETE FROM {$db_prefix}permissions WHERE forum_id ='$category_post_id'");
			mysql_query('DELETE FROM ' . $db_prefix . 'moderators WHERE forum_id = ' . $category_post_id);

			$query3 = "select PARENT, ID from {$db_prefix}categories WHERE PARENT='$category_post_id' ORDER BY ID desc" ;
			$result3 = mysql_query($query3) or die("categories.php - Error in query: $query3") ; 
			while ($results3 = mysql_fetch_array($result3))
			{
				$parent = $results3['PARENT'];
				$id = $results3['ID'];

				$query212 = "select ID from {$db_prefix}posts WHERE FORUM_ID='$id'" ;
				$result212 = mysql_query($query212) or die("delete.php - Error in query: $query212") ;                                  
				while ($results212 = mysql_fetch_array($result212))
				{
					$remove_id = $results212['ID'];

					// first, delete attachments associated with these posts...

					$query2121 = "select FILENAME from {$db_prefix}attachments WHERE POSTID='$remove_id'" ;
					$result2121 = mysql_query($query2121) or die("delete.php - Error in query: $query2121") ;                                  
					while ($results2121 = mysql_fetch_array($result2121))
					{
						$filename = strip_slashes($results2121['FILENAME']);

						foreach (glob("uploads/attachments/$filename") as $filename)
						{
						   unlink($filename);
						}

						foreach (glob("uploads/attachments/t_$filename") as $filename)
						{
						   unlink($filename);
						}

						mysql_query("DELETE FROM {$db_prefix}attachments WHERE postid ='$remove_id'");
					}
				}

				mysql_query('
						DELETE p.*, pl.*, plv.*
						FROM ' . $db_prefix . 'posts p
						LEFT JOIN ' . $db_prefix . 'polls pl
								ON p.topic_id = pl.topic_id
								LEFT JOIN ' . $db_prefix . 'polls_votes plv
										ON pl.id = plv.poll_id
						WHERE forum_id = ' . $id
				);
				mysql_query("DELETE FROM {$db_prefix}categories WHERE id ='$id'");
				mysql_query("DELETE FROM {$db_prefix}permissions WHERE forum_id ='$id'");
				mysql_query('DELETE FROM ' . $db_prefix . 'moderators WHERE forum_id = ' . $id);

				$query31 = "select PARENT, ID from {$db_prefix}categories WHERE PARENT='$id' ORDER BY ID desc" ;
				$result31 = mysql_query($query31) or die("categories.php - Error in query: $query31") ; 
				while ($results31 = mysql_fetch_array($result31))
				{
					$sub_parent = $results31['PARENT'];
					$sub_id = $results31['ID'];

					$query212 = "select ID from {$db_prefix}posts WHERE FORUM_ID='$sub_id'" ;
					$result212 = mysql_query($query212) or die("delete.php - Error in query: $query212") ;                                  
					while ($results212 = mysql_fetch_array($result212))
					{
						$remove_id = $results212['ID'];

						// first, delete attachments associated with these posts...

						$query2121 = "select FILENAME from {$db_prefix}attachments WHERE POSTID='$remove_id'" ;
						$result2121 = mysql_query($query2121) or die("delete.php - Error in query: $query2121") ;                                  
						while ($results2121 = mysql_fetch_array($result2121))
						{
							$filename = strip_slashes($results2121['FILENAME']);

							foreach (glob("uploads/attachments/$filename") as $filename)
							{
							   unlink($filename);
							}

							foreach (glob("uploads/attachments/t_$filename") as $filename)
							{
							   unlink($filename);
							}

							mysql_query("DELETE FROM {$db_prefix}attachments WHERE postid ='$remove_id'");
						}
					}

                                        mysql_query('
                                                DELETE p.*, pl.*, plv.*
                                                FROM ' . $db_prefix . 'posts p
                                                LEFT JOIN ' . $db_prefix . 'polls pl
                                                        ON p.topic_id = pl.topic_id
                                                        LEFT JOIN ' . $db_prefix . 'polls_votes plv
                                                                ON pl.id = plv.poll_id
                                                WHERE forum_id = ' . $sub_id
                                        );
					mysql_query("DELETE FROM {$db_prefix}categories WHERE id ='$sub_id'");
					mysql_query("DELETE FROM {$db_prefix}permissions WHERE forum_id ='$sub_id'");
					mysql_query('DELETE FROM ' . $db_prefix . 'moderators WHERE forum_id = ' . $sub_id);
				}
			}
			
			// perform auto-cache
			include "scripts/php/auto_cache.php";
			
			# Re-cache moderators
			$Cache->delete('moderators');
			
			template_hook("pages/admin/categories.template.php", "form_1");
			
			lb_redirect("index.php?page=admin&act=categories&success=deleted","admin/categories/success/deleted");
		}
		else
		{
			lb_redirect('index.php?page=error&error=28', 'error/28');
		}
	}
}
elseif ($_POST['post_form']!=''){

$token_id = escape_string($_POST['token_id']);

$token_name = "token_categories_reorder_$token_id";

 if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name]){

$query3 = "select ID from {$db_prefix}categories ORDER BY ID desc LIMIT 1" ;
$result3 = mysql_query($query3) or die("categories.php - Error in query: $query3") ; 
$last = mysql_result($result3, 0);

$counted="1";

for ( $counter = $counted; $counter <= $last; $counter += 1) {

$forum_order="forum_order"."$counter";
$forum_id="forum_id"."$counter";

$forum_id=escape_string($_POST[$forum_id]);
$forum_order=escape_string($_POST[$forum_order]);


mysql_query("UPDATE {$db_prefix}categories SET forum_order='$forum_order' WHERE id='$forum_id'");
}

	template_hook("pages/admin/categories.template.php", "form_2");

	lb_redirect("index.php?page=admin&act=categories","admin/categories");

}
else{

	lb_redirect("index.php?page=error&error=28","error/28");

}
}

elseif ($_POST['new_forum_form'] != '')
{
	$token_id = escape_string($_POST['token_id']);

	$token_name = "token_categories_new_$token_id";

	if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name])
	{
		$forum_name = escape_string($_POST['name']);
		$forum_description = escape_string($_POST['description']);
		$forum_rules = escape_string($_POST['forum_rules']);
		$forum_parent = escape_string($_POST['parent']);
		$forum_read_only = escape_string($_POST['read_only']);
		$forum_post_count = escape_string($_POST['post_count']);
		$forum_theme = escape_string($_POST['forum_theme']);

                if ( ($_POST['redirect_url'] != '') && (!stristr($_POST['redirect_url'], "http://")) && (!stristr($_POST['redirect_url'], "ftp://")) && (!stristr($_POST['redirect_url'], "https://")) )
                {
                	$redirect_url = "http://" . escape_string($_POST['redirect_url']);
                }
                else
                {
			$redirect_url = escape_string($_POST['redirect_url']);
                }

		mysql_query("INSERT INTO {$db_prefix}categories (name, description, forum_rules, parent, forum_order, read_only, post_count, theme, redirect_url) VALUES ('$forum_name', '$forum_description', '$forum_rules', '$forum_parent', '0', '$forum_read_only', '$forum_post_count', '$forum_theme', '$redirect_url')");

		// now go to the permissions page...
		$query3 = "select ID from {$db_prefix}categories ORDER BY ID desc LIMIT 1" ;
		$result3 = mysql_query($query3) or die("categories.php - Error in query: $query3") ; 
		$last = mysql_result($result3, 0);

		// perform auto-cache
		include "scripts/php/auto_cache.php";	

		template_hook("pages/admin/categories.template.php", "form_3");

		lb_redirect("index.php?page=admin&act=permissions&id=$last&success=new","admin/permissions/$last/success/new");

	}
	else
	{
		lb_redirect("index.php?page=error&error=28","error/28");

	}
}
elseif($_POST['post_edit_form'] != '')
{
        $id = escape_string($_POST['id']);

        $token_id = escape_string($_POST['token_id']);

        $token_name = "token_categories_edit_$id$token_id";

        if (isset($_POST[$token_name]) && isset($_SESSION[$token_name]) && $_SESSION[$token_name] == $_POST[$token_name])
        {
                $forum_name=escape_string($_POST['name']);
                $forum_description=escape_string($_POST['description']);
                $forum_rules=escape_string($_POST['forum_rules']);
                $forum_parent=escape_string($_POST['parent']);
                $forum_read_only=escape_string($_POST['read_only']);
                $forum_post_count=escape_string($_POST['post_count']);
                $forum_theme=escape_string($_POST['forum_theme']);

                if ( ($_POST['redirect_url'] != '') && (!stristr($_POST['redirect_url'], "http://")) && (!stristr($_POST['redirect_url'], "ftp://")) && (!stristr($_POST['redirect_url'], "https://")) )
                {
                	$redirect_url = "http://" . escape_string($_POST['redirect_url']);
                }
                else
                {
			$redirect_url = escape_string($_POST['redirect_url']);
                }

                mysql_query("UPDATE {$db_prefix}categories SET name='$forum_name', description='$forum_description', forum_rules='$forum_rules', parent='$forum_parent', read_only='$forum_read_only', post_count='$forum_post_count', theme='$forum_theme', redirect_url='$redirect_url' WHERE id = '$id' ");

	        template_hook("pages/admin/categories.template.php", "form_4");

	        lb_redirect("index.php?page=admin&act=categories&success=updated","admin/categories/success/updated");

        }
        else
        {
        	lb_redirect("index.php?page=error&error=28","error/28");

        }
}

elseif($_GET['func'] == 'edit')
{
        $token_id = md5(microtime());
        $token = md5(uniqid(rand(),true));

        $category_edit_id = (int) $_GET['id'];

        $token_name = "token_categories_edit_$category_edit_id$token_id";

        $_SESSION[$token_name] = $token;

        $query3 = "select ID, NAME, DESCRIPTION, FORUM_RULES, PARENT, READ_ONLY, POST_COUNT, THEME, REDIRECT_URL from {$db_prefix}categories WHERE ID='$category_edit_id'" ;
        $result3 = mysql_query($query3) or die("attachments.php - Error in query: $query3") ;

        while ($results3 = mysql_fetch_array($result3))
        {
                $id = $results3['ID'];
                $name = strip_slashes($results3['NAME']);
                $description = strip_slashes($results3['DESCRIPTION']);
                $forum_rules = strip_slashes($results3['FORUM_RULES']);
                $parent = $results3['PARENT'];
                $read_only = $results3['READ_ONLY'];
                $post_count = $results3['POST_COUNT'];
                $forum_theme = strip_slashes($results3['FORUM_THEME']);
                $redirect_url = strip_slashes($results3['REDIRECT_URL']);

                $forum_rules = str_replace("<br />", "", $forum_rules);

                $query31 = "select NAME from {$db_prefix}categories WHERE ID='$parent'" ;
                $result31 = mysql_query($query31) or die("attachments.php - Error in query: $query31") ; 
                $parent_name = strip_slashes(mysql_result($result31, 0));

                template_hook("pages/admin/categories.template.php", "5");

                $query34 = "select ID, NAME, PARENT from {$db_prefix}categories WHERE PARENT='0' AND ID!='$id'";
                $result34 = mysql_query($query34) or die("attachments.php - Error in query: $query34") ;

                while ($results34 = mysql_fetch_array($result34))
                {
                        $id = $results34['ID'];
                        $name = strip_slashes($results34['NAME']);
                        $parent = $results34['PARENT'];

                        template_hook("pages/admin/categories.template.php", "6");

                        $query4 = "select ID, NAME from {$db_prefix}categories WHERE PARENT='$id' AND ID!='$category_edit_id'";
                        $result4 = mysql_query($query4) or die("categories.php - Error in query: $query4") ;

                        while ($results4 = mysql_fetch_array($result4))
                        {
                                $id = $results4['ID'];
                                $name = strip_slashes($results4['NAME']);

                                template_hook("pages/admin/categories.template.php", "7");

                        }

                }

                template_hook("pages/admin/categories.template.php", "8");

                list_themes("themes/");

                template_hook("pages/admin/categories.template.php", "27");
        }
}
elseif ($_GET['func'] == 'new')
{
        $token_id = md5(microtime());
        $token = md5(uniqid(rand(),true));

        $token_name = "token_categories_new_$token_id";

        $_SESSION[$token_name] = $token;

        template_hook("pages/admin/categories.template.php", "10");

        if ($_GET['id'] != '')
        {
                $id = escape_string($_GET['id']);

                $query3 = "select ID, NAME, PARENT from {$db_prefix}categories WHERE ID='$id'";
        }
        else
        {
                $query3 = "select ID, NAME, PARENT from {$db_prefix}categories WHERE PARENT='0'";
                echo "<option value='0'>".$lang_admin['categories_edit_parent_no']."</option>";
        }

        $result3 = mysql_query($query3) or die("categories.php - Error in query: $query3") ; 

        while ($results3 = mysql_fetch_array($result3))
        {
                $id = $results3['ID'];
                $name = strip_slashes($results3['NAME']);
                $parent = $results3['PARENT'];

                template_hook("pages/admin/categories.template.php", "11");

                if ($_GET['id'] != '')
                {
                        $query4 = "select ID, NAME from {$db_prefix}categories WHERE PARENT='$id'";
                        $result4 = mysql_query($query4) or die("categories.php - Error in query: $query4") ;

                        while ($results4 = mysql_fetch_array($result4))
                        {
                                $id = $results4['ID'];
                                $name = strip_slashes($results4['NAME']);

                                template_hook("pages/admin/categories.template.php", "12");

                        }
                }
        }

        template_hook("pages/admin/categories.template.php", "13");

        list_themes("themes/");

        template_hook("pages/admin/categories.template.php", "26");

}
else
{


$token_id = md5(microtime());
$token = md5(uniqid(rand(),true));

$token_name = "token_categories_reorder_$token_id";

$_SESSION[$token_name] = $token;

template_hook("pages/admin/categories.template.php", "14");

$query3 = "select ID, NAME, DESCRIPTION, FORUM_ORDER from {$db_prefix}categories WHERE PARENT='0' ORDER BY FORUM_ORDER, ID asc" ;
$result3 = mysql_query($query3) or die("categories.php - Error in query: $query3") ; 
$number_of_forums=mysql_num_rows($result3);
while ($results3 = mysql_fetch_array($result3)){
$id = $results3['ID'];
$parent_id = $results3['ID'];
$name = strip_slashes($results3['NAME']);
$description = strip_slashes($results3['DESCRIPTION']);
$forum_order = $results3['FORUM_ORDER'];

template_hook("pages/admin/categories.template.php", "15");

$root_counter="1";

for ( $root_counter = $counted; $root_counter <= $number_of_forums; $root_counter += 1) {

template_hook("pages/admin/categories.template.php", "16");

}

template_hook("pages/admin/categories.template.php", "17");

$query4 = "select ID, NAME, DESCRIPTION, FORUM_ORDER, READ_ONLY from {$db_prefix}categories WHERE PARENT='$id' ORDER BY FORUM_ORDER, ID asc" ;
$result4 = mysql_query($query4) or die("categories.php - Error in query: $query4") ; 
$number_of_sub_forums=mysql_num_rows($result4);
while ($results4 = mysql_fetch_array($result4)){
$id = $results4['ID'];
$name = strip_slashes($results4['NAME']);
$read_only = $results4['READ_ONLY'];
$description = strip_slashes($results4['DESCRIPTION']);
$forum_order = $results4['FORUM_ORDER'];

$sub_counter="1";

template_hook("pages/admin/categories.template.php", "18");

for ( $sub_counter = $counted; $sub_counter <= $number_of_sub_forums; $sub_counter += 1) {

template_hook("pages/admin/categories.template.php", "19");

}

template_hook("pages/admin/categories.template.php", "20");

// sub-forums...
$sub_counter_two="0";
$query_sub = "select ID, NAME, DESCRIPTION, FORUM_ORDER, READ_ONLY from {$db_prefix}categories WHERE PARENT='$id' ORDER BY FORUM_ORDER, ID asc" ;
$result_sub = mysql_query($query_sub) or die("categories.php - Error in query: $query_sub") ; 
$number_of_sub_forums_two=mysql_num_rows($result_sub);
while ($results_sub = mysql_fetch_array($result_sub)){
$id = $results_sub['ID'];
$name = strip_slashes($results_sub['NAME']);
$read_only = $results_sub['READ_ONLY'];
$description = strip_slashes($results_sub['DESCRIPTION']);
$forum_order_two = $results_sub['FORUM_ORDER'];

$sub_counter_two="1";

template_hook("pages/admin/categories.template.php", "21");

for ( $sub_counter_two = $counted_two; $sub_counter_two <= $number_of_sub_forums_two; $sub_counter_two += 1) {

template_hook("pages/admin/categories.template.php", "22");

}

template_hook("pages/admin/categories.template.php", "23");

}

}

template_hook("pages/admin/categories.template.php", "24");

}

template_hook("pages/admin/categories.template.php", "25");

}

template_hook("pages/admin/categories.template.php", "end");
?>
