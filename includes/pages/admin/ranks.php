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
|   ranks.php - member ranks admin page
 
*/

if (!defined('LB_RUN')){
	echo "<h1>ACCESS DENIED</h1>You cannot access this file directly.";
	exit();
}

template_hook("pages/admin/ranks.template.php", "start");

if($_GET['success']=="added"){
	template_hook("pages/admin/ranks.template.php", "successAdded");
}elseif($_GET['success']=="deleted"){
	template_hook("pages/admin/ranks.template.php", "successDeleted");
}

if ($can_change_forum_settings=='0'){

	lb_redirect("index.php?page=error&error=11","error/11");

}

else
{
	if ($_POST['ranks_delete'] == 1)
	{
		$id		= (int) $_POST['delete_id'];
		$hash	= $_POST['hash'];
		
		if (tokenCheck('ranks', $hash))
		{
			mysql_query("DELETE FROM {$db_prefix}ranks WHERE id ='$id'");
			
			template_hook("pages/admin/ranks.template.php", "form_1");
			
			lb_redirect("index.php?page=admin&act=ranks&success=deleted","admin/ranks/success/deleted");
		}
		else
		{
			lb_redirect('index.php?page=error&error=28', 'error/28');
		}
	}
	elseif ($_POST['ranks_add'] == $lang['button_submit'])
	{
		$hash = $_POST['hash'];
		
		if (tokenCheck('ranks', $hash))
		{
			$rank_title	= escape_string($_POST['rank_title']);
			$rank_posts	= escape_string($_POST['rank_posts']);
			$rank_pips	= (int) $_POST['rank_pips'];

			if ($rank_posts < '0' OR !isset($rank_posts)){
				$rank_posts="0";
			}
			if ($rank_pips < '0' OR !isset($rank_pips)){
				$rank_pips="0";
			}
			/* Check for extreme pip numbers, and reduce them */
			if( $rank_pips > 50 ){
				$rank_pips = 50;
			}

			mysql_query("INSERT INTO {$db_prefix}ranks (rank_title, rank_posts, rank_pips) VALUES ('$rank_title', '$rank_posts', '$rank_pips')");

			template_hook("pages/admin/ranks.template.php", "form_2");

			lb_redirect("index.php?page=admin&act=ranks&success=added","admin/ranks/success/added");
		}
		else
		{
			lb_redirect("index.php?page=error&error=28","error/28");
		}
	}

	else
	{
		$hash = md5(uniqid(mt_rand(), true));
		list($token_id, $token, $token_name) = tokenCreate('ranks', $hash);
		
		template_hook("pages/admin/ranks.template.php", "3");
		
		$query2 = "select ID, RANK_TITLE, RANK_POSTS, RANK_PIPS from {$db_prefix}ranks ORDER BY rank_posts asc" ;
		$result2 = mysql_query($query2) or die("ranks.php - Error in query: $query2") ;                                  
		while ($results2 = mysql_fetch_array($result2)){
		$rank_id = strip_slashes($results2['ID']);
		$rank_title = strip_slashes($results2['RANK_TITLE']);
		$rank_posts = strip_slashes($results2['RANK_POSTS']);
		$rank_pips_query = strip_slashes($results2['RANK_PIPS']);

		$rank_posts = number_format($rank_posts);
		$rank_pips = number_format($rank_pips_query);

		template_hook("pages/admin/ranks.template.php", "4");

		$start_pips = "0";

		while ($start_pips < $rank_pips_query){
		template_hook("pages/admin/ranks.template.php", "6");
		$start_pips = $start_pips + 1;
		}
		template_hook("pages/admin/ranks.template.php", "7");

		}

		template_hook("pages/admin/ranks.template.php", "5");

	}

}

template_hook("pages/admin/ranks.template.php", "end");
?>