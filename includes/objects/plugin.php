<?php
/*
+--------------------------------------------------------------------------
|  LayerBulletin
|  ========================================
|  By The LayerBulletin team
|  Released under the Artistic License 2.0
|  http://layerbulletin.com/
|  ========================================
|  plugin.php - Plugin class to allow hooks throughout the code.
*/

if (!defined('LB_RUN'))
{
	exit('<h1>ACCESS DENIED</h1>You cannot access this file directly.');
}

class plugin
{
	private
		$ROOT	= '',
		$hooks	= array()
	;
	
	public function __construct($lb_root, $Cache)
	{
		$this->ROOT		= $lb_root;
		$this->hooks	= $Cache->load('hooks');
	}
	
	public function hook($file, $location)
	{
		$return = '';
		
		if (is_array($this->hooks[$file][$location]))
		{
			foreach ($this->hooks[$file][$location] as $code)
			{
				$contents = trim(file_get_contents($this->ROOT . 'modules/' . $code['module_name'] . '/hooks/' . $file . '_' .  $location . '.php'));
				
				# PHP tags at the start are not allowed
				if (substr($contents, 0, 5) == '<?php')
				{
					$contents = substr_replace($contents, '', 0, 5);
				}
				
				# Same for the end of the file
				if (substr($contents, -2) == '?>')
				{
					$contents = substr_replace($contents, '', -2);
				}
				
				$return .= $contents;
			}
		}
		
		return $return;
	}
}
?>