<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Debug_module {


	public function __construct(){
	}

	public function debug(){

		$ci = &get_instance();
		if($ci->config->item('debug_profiler')) {
			$sections = array(
					'config'  => TRUE,
					'queries' => TRUE
			);

			$ci->output->set_profiler_sections($sections);

			$ci->output->enable_profiler(TRUE);
		}
	}
}
