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
|  autosuggest.php - This handles autosuggest areas
 
*/

define('LB_RUN', 1);

# Any errors being reported will break the script
error_reporting(0);

# We don't want magic quotes adding slashes into our DB info
if (version_compare(PHP_VERSION, '6.0.0', '<'))
{
	ini_set('magic_quotes_runtime', 0);
}

	/*
	Required files
*/

	# DB info
	require_once '../../includes/config.php';
	
	# Functions
	require_once '../../scripts/php/functions.php';

$limit	= (int) $_GET['limit'];
$input	= escape_string($_GET['input']);
$where	= '';

if (isset($_GET['member']))
{
	$member	= (int) $_GET['member'];
	$where	= 'AND m.id != ' . $member;
}

	/*
	If we're not in the admin cp, then we don't want to
	show banned, unverfied or users who can't pm...
*/

	if (!isset($_GET['admin']))
	{
		$where .= ' AND m.verified = 1 AND m.banned = 0 AND g.can_pm = 1';
	}

# Empty array to hold the info from the DB
$results = array();

$queryautomember = mysql_query('
	SELECT
		m.id, m.name, m.email, g.group_name
	FROM
		' . $db_prefix . 'members m
		
		INNER JOIN
			' . $db_prefix . 'groups g
			ON m.role = g.group_id
		
	WHERE
		name REGEXP "^' . $input . '"
		' . $where  . '
	
	ORDER BY m.name ASC
	
	LIMIT ' . $limit

) or die ('Autosuggest.php - Error in query1');

while ($row = mysql_fetch_array($queryautomember))
{
	$id			= $row['id'];	
	$name		= $row['name'];
	$email		= $row['email'];
	$group_name	= $row['group_name'];
	
	# Remember for laters
	$results[$id] = array(
		'id'	=> $id,
		'name'	=> $name,
		'email'	=> $email,
		'group'	=> $group_name
	);
}

	/*
	Start Display
*/

	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header ("Pragma: no-cache"); // HTTP/1.0
	header("Content-Type: application/json");

		/*
		Create the JSON output
	*/

		echo '{"results": [';
		
		$display = array();
		foreach ($results as $member)
		{
			$value		= (isset($_GET['email'])) ? $member['email'] : $member['name'];
			$display[]	= '{"id": "' . $member['id'] . '", "value": "' . $value . '", "info": "' . $member['group'] . '"}';
		}
		
		echo implode(',', $display);
		echo ']}';
?>