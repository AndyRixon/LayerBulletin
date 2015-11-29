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
|   suspended_members.php - banlist
 
*/

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
	# Members who need unbanning
	#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
	
		$comma	= '';
		$unban	= '';
		
		if (!empty($_POST['unban']))
		{
			foreach (array_keys($_POST['unban']) as $m)
			{
				$unban .= $comma . ((int) $m);
				
				$comma = ', ';
			}
			
			if ($unban != '')
			{
				mysql_query('UPDATE ' . $db_prefix . 'members SET banned = 0 WHERE id IN (' . $unban . ')');
			}
		}
	
	#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
	# Altering suspension dates
	#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
	
		foreach (($_POST['alter']) as $m => $v)
		{
			if ($v['orig'] != $v['new'])
			{
				$m = (int) $m;
				
					/*
					Convert the textual date to timestamp
				*/
				
					$parts	= explode('/', $v['new']);
					$date	= date('U', mktime(0, 0, 0, $parts[1], $parts[0], $parts[2]));
					
					/*
					Update the DB
				*/
				
					mysql_query('	UPDATE ' . $db_prefix . 'members
									SET suspend_date = ' . $date . '
									WHERE id = ' . $m
					);
			}
		}
	
	lb_redirect('index.php?page=admin&act=suspended_members', 'admin/suspended_members');
}
else
{
	# Set template location and run starting hook
	$template = 'pages/admin/suspended_members.template.php';
	template_hook($template, 'start');

	#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
	# Get the members who are banned or suspended
	#-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-

		$query	= mysql_query('

			SELECT m.id, m.name, m.banned, m.suspend_date, g.group_color
			
			FROM ' . $db_prefix . 'members m
			
				INNER JOIN ' . $db_prefix . 'groups g
				ON m.role = g.group_id
			
			WHERE (m.banned = 1 OR m.suspend_date > ' . time() . ') AND m.verified = 1
			
			ORDER BY m.name ASC
		
		') or die (mysql_error());
		
		$r = 0;

		if (mysql_num_rows($query) > 0)
		{
			while ($row = mysql_fetch_assoc($query))
			{
				if ($row['banned'] == 1)
				{
					$type	= $lang_sus['banned'];
					$ends	= $lang_sus['n/a'];
				}
				else
				{
					$type	= $lang_sus['suspended'];
					$ends	= date('d/m/Y', $row['suspend_date']);
				}
				
				template_hook($template, 1);
				
				$r = ($r == 1) ? 0 : 1;
			}
		}
		else
		{
			template_hook($template, 2);
		}

	# Ending template hook
	template_hook($template, 'end');
}
?>