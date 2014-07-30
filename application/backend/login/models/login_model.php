<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __contruct()
	{
		parent::__construct();
		echo 'agarro login model';
		die();

	}

	public function digoHola()
	{
		echo 'Hola';
		return true;
	}

	public function validate($usuario) {
		try
		{
			// $query = $this->db->query("SELECT u.id_usuario FROM usuarios u,roles r WHERE u.email = ".$this->db->escape($usuario['email'])." AND
			// u.clave = PASSWORD(". $this->db->escape($usuario['clave']) .") AND u.id_rol = r.id_rol AND u.estado_usuario = 1" );
			$query = $this->db->query("SELECT u.id_usuario FROM usuarios u WHERE u.email = ".$this->db->escape($usuario['email'])." AND
			u.clave = PASSWORD(". $this->db->escape($usuario['clave']) .") AND u.id_rol = 1 AND u.estado_usuario = 1" );

			if($query->num_rows() == 1)
			{
				$usuario = $query->row_array();
				return $usuario;
			}
			else {
				$usuario['id_usuario'] = 0 ;
				return $usuario;
			}

		} catch (Exception $e) {
			$usuario['id_usuario'] = 0 ;
			return $usuario;
		}
	}

	public function forgot($usuario){
		try {
			$this->load->library('email');
			$data['errores'] = false;
			if($this->email->valid_email($usuario['email'])){
				$query = $this->db->query("SELECT u.* FROM usuarios u WHERE u.estado_usuario ' AND email = " .$this->db->escape($usuario['email']));
				if($query->num_rows() == 1){
					$usuario = $query->row_array();
					$newData = $this->cambiarClave($usuario);
					$usuario['clave'] = $newData['clave'];
					$data['usuario'] = $usuario;
				}
				else {
					$data['errores'] = true;
					$data['noExiste'] = true;
				}
			}
			else{
				$data['errores'] = true;
				$data['email'] = true;
			}
			return $data;
		} catch (Exception $e) {
			$data['errores'] = true;
			return $data;
		}
	}

	protected function cambiarClave($usuario){
		try {
			$this->load->helper('string_helper');
			$clave = random_string();
			$data = array(
			'clave' => 'PASSWORD('.$this->db->escape($clave).')'
			);
			$this->db->set('clave','PASSWORD('.$this->db->escape($clave).')',false);
			$this->db->update('Usuarios',NULL,'idUsuarios = '.$usuario['idUsuarios']);
			$data['clave'] = $clave;
			return $data;

		} catch (Exception $e) {
		}
	}

	protected function notificar($usuario){
		try {



		} catch (Exception $e) {
		}
	}

}


?>