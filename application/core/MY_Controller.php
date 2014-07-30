<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* The MX_Controller class is autoloaded as required */

require_once(APPPATH . 'libraries/user.php');


class MY_Controller extends MX_Controller
{

	public $user;

	public function __construct()
	{
		parent::__construct();
		$this->user = new User();

		if($this->session->userdata('id_rol') and $this->session->userdata('id_usuario'))
		{
			$this->user->set_id($this->session->userdata('id_usuario'));
			$this->user->set_id_rol($this->session->userdata('id_rol'));
			$this->user->set_rol_key($this->session->userdata('rol_key'));
			$this->user->set_identificacion($this->session->userdata('identificacion'));
			$this->user->set_id_localizacion($this->session->userdata('id_localizacion'));
			$this->user->set_email($this->session->userdata('email'));
		}

		$this->rol = $this->session->userdata('rol_key');




		// Resetear los filtros de otras clases.
		$clases_con_filtros	= array('usuarios', 'ctactes');
		$clase_actual 		= $this->router->fetch_class();
		foreach ($clases_con_filtros AS $cl)
		{
			if ($cl != $clase_actual)
			{
				$nombre_filtro_tipo = 'filtro_' . $cl . '_tipo';
				$nombre_filtro_valor = 'filtro_' . $cl . '_valor';
				$this->session->unset_userdata($nombre_filtro_tipo);
				$this->session->unset_userdata($nombre_filtro_valor);
			}
		}
		// Fin de Resetear los filtros

	}


	public function __destruct()
	{
		gc_collect_cycles();
	}


/**
* Redirige al usuario en caso de que no haya iniciado sesión o esta haya expirado.
*/
protected function redirect_no_login()
{
	if(!$this->user->is_logged()) {
		redirect('admin/login');
	}
}

}




class MY_Controller_Front extends MX_Controller
{

	public $user;

	public function __construct()
	{

		// $this->config->config['modules_locations'] = array(APPPATH.'modulos/' => '../modulos/');
		// Modules::$locations = array(APPPATH.'modulos/' => '../modulos/');
		// parent::__construct();
		// Modules::$locations = array(APPPATH.'modulos/' => '../modulos/');
		// $this->load->modules_location(array(APPPATH.'modulos/' => '../modulos/'));

		$this->user = new User();
		if($this->session->userdata('id_rol') and $this->session->userdata('id_usuario')) {
			$this->user->set_id($this->session->userdata('id_usuario'));
			$this->user->set_id_rol($this->session->userdata('id_rol'));
			$this->user->set_rol_key($this->session->userdata('rol_key'));
			$this->user->set_identificacion($this->session->userdata('identificacion'));
			$this->user->set_id_localizacion($this->session->userdata('id_localizacion'));
			$this->user->set_email($this->session->userdata('email'));

		}

		$this->rol = $this->session->userdata('rol_key');



	}


	public function __destruct()
	{
		gc_collect_cycles();
	}


/**
* Redirige al usuario en caso de que no haya iniciado sesión o esta haya expirado.
*/
protected function redirect_no_login()
{
	if(!$this->user->is_logged()) {
		redirect('login');
	}
}

}