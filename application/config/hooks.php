<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['pre_controller'][] = array(
		'class'    => 'Config_db',
		'function' => 'loadValues',
		'filename' => 'config_db.php',
		'filepath' => 'hooks',
		'params'   => array()
);

$hook['post_controller'][] = array(
		'class'    => 'Debug_module',
		'function' => 'debug',
		'filename' => 'debug_module.php',
		'filepath' => 'hooks',
		'params'   => array()
);


/* End of file hooks.php */
/* Location: ./application/config/hooks.php */