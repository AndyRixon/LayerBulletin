<?php
/*
+--------------------------------------------------------------------------
|  LayerBulletin
|  ========================================
|  By The LayerBulletin team
|  Released under the Artistic License 2.0
|  http://layerbulletin.com/
|  ========================================
|  cache.php - Cache class to handle loading/saving of repeat data.
*/

if (!defined('LB_RUN'))
{
	exit('<h1>ACCESS DENIED</h1>You cannot access this file directly.');
}

class cache
{
	private
		$ROOT		= '',
		$db_prefix	= '',
		$cache		= array()
	;
	
	/*
	Constructor function
	
	@param	string	$root	: Path to LayerBulletin's root folder.
	@return	null
*/

	public function __construct($root, $db_prefix)
	{
		$this->ROOT			= $root;
		$this->db_prefix	= $db_prefix;
	}
	
	/*
	Deletes the specified cache file.
	
	@param	string	$file	: The name of the file to delete.
	@return	bool			: True/false depending on successful deletion.
*/
	
	public function delete($file)
	{
		if (file_exists($this->ROOT . 'cache/' . $file . '.php'))
		{
			unlink($this->ROOT . 'cache/' . $file . '.php');
			
			if (isset($this->cache[$file]))
			{
				unset($this->cache[$file]);
			}
			
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/*
	Loads the given cache file.
	
	@param	string	$file		: The file to load.
	@param	bool	$remember	: Whether to save the info to an array (for when a file is loaded more than once).
	@return	array				: The contents of the cache file.
*/

	public function load($file, $remember = false)
	{
		if (in_array($file, $this->cache))
		{
			return $this->cache[$file];
		}
		else
		{
			if (!file_exists($this->ROOT . 'cache/' . $file . '.php'))
			{
				return ($remember) ? $this->cache[$file] = $this->reCache($file) : $this->reCache($file);
			}
			else
			{
				include $this->ROOT . 'cache/' . $file . '.php';
				
				if (empty($cache))
				{
					return ($remember) ? $this->cache[$file] = $this->reCache($file) : $this->reCache($file);
				}
				
				return ($remember) ? $this->cache[$file] = $cache : $cache;
			}
		}
	}
	
	/*
	Saves the given array to a cache file.
	
	@param	string	$file		: The name to give the file.
	@param	array		$info	: The contents to add to the file.
	@return	bool				: True if file was created, false otherwise.
*/
	
	public function save($file, $info = '')
	{
		$file = $this->ROOT . 'cache/' . $file . '.php';
		
		if (is_writeable($this->ROOT . 'cache/'))
		{
			$content = '<?php' . "\n";
			
			if ($info != '')
			{
				$content .= '$cache = ' . var_export($info, true) . ';';
			}
			else
			{
				$content .= '$cache = array();';
			}
			
			$content .= "\n" . '?>';
			
			return (file_put_contents($file, $content)) ? true : false;
		}
		else
		{
			return false;
		}
	}
	
	/*
	Re-Caches the specified file.
	
	@param	string	$file	: The name of the file.
	@return	array			: Information retrieved from the DB.
*/
	
	private function reCache($file)
	{
		/*
		Recache for board settings
	*/
		
		if ($file == 'settings')
		{
			$query	= mysql_query('SELECT * FROM ' . $this->db_prefix . 'settings');
			$row	= mysql_fetch_assoc($query);
			
			$this->save('settings', $row);
			
			return $row;
		}
		
		/*
		Word censors in posts.
	*/
	
		elseif ($file == 'censor')
		{
			$censor	= array();
			$query	= mysql_query('SELECT * FROM ' . $this->db_prefix . 'censor');
			
			while ($row = mysql_fetch_assoc($query))
			{
				$censor[$row['row']] = $row;
			}
			
			$this->save('censor', $censor);
			return $censor;
		}
		
		/*
		User groups
	*/
	
		elseif ($file == 'groups')
		{
			$groups	= array();
			$query	= mysql_query('SELECT * FROM ' . $this->db_prefix . 'groups');
			
			while ($row	= mysql_fetch_assoc($query))
			{
				$groups[$row['group_id']] = $row;
			}
			
			$this->save($file, $groups);
			return $row;
		}
		
		/*
		Moderator permissions
	*/
	
		elseif ($file == 'moderators')
		{
			$moderators	= array();
			$query		= mysql_query('SELECT * FROM ' . $this->db_prefix . 'moderators');
			
			while ($row = mysql_fetch_assoc($query))
			{
				$moderators[$row['member_id']][$row['forum_id']] = $row;
			}
			
			$this->save('moderators', $moderators);
			return $moderators;
		}
		
		/*
		Hooks
	*/
	
		elseif ($file == 'hooks')
		{
			$hooks	= array();
			$query	= mysql_query('
				SELECT h.file, h.location, m.module_name
				FROM ' . $this->db_prefix . 'modules_hooks h
					INNER JOIN ' . $this->db_prefix . 'modules m
					ON h.module_id = m.id
				WHERE m.installed = 1
			');
			
			while ($row = mysql_fetch_assoc($query))
			{
				$hooks[$row['file']][$row['location']][] = $row;
			}
			
			$this->save('hooks', $hooks);
			return $hooks;
		}
		
		/*
		Emoticons/smilies (whatever you wanna call them).
	*/
	
		elseif (strpos($file, 'emoticons_') !== false)
		{
			$theme		= str_replace('emoticons_', '', $file);
			$smilies	= array();
			$query219	= mysql_query('
				SELECT row, code, link
				FROM ' . $this->db_prefix . 'smilies
				WHERE emoticon_on = 1 AND code != "" AND link != "" AND theme = "' . $theme . '"
				ORDER BY row DESC
			');
			
			while ($row = mysql_fetch_assoc($query219))
			{
				$smilies[$row['row']] = $row;
			}
			
			$this->save($file, $smilies);
			return $smilies;
		}
	}
}
?>