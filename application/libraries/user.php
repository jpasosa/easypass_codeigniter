<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/usuario.php');

/**
 * Clase que permite conocer los datos del usuario que tiene sesion en el sistema
 * Puede ser un empleado/usuario con perfil o un hospital
 * @author AllyTech Cloud Hosting
 *
 */
class User extends Usuario
{

	public function __construct($vars = null)
	{
		parent::__construct($vars);
	}


	public function check_rol($rol = '')
	{
		if(ROL_KEY == $this->ci->session->userdata('rol_key')) {
			return true;
		}
		elseif( !empty($rol) and $rol == $this->ci->session->userdata('rol_key') ) {
			return true;
		}
		else {
			return false;
		}
	}

	public function is_logged()
	{
		if(isset($this->ci->session) and $this->ci->session->userdata('id_usuario')){
			return true;
		}
		else {
			return false;
		}
	}

	public function get()
	{
		return $this->get_by_id($this->id());
	}

}
