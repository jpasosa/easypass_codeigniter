<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/person_abstract.php');

/**
 *
 * @author AllyTech Cloud Hosting
 *
 */
class Usuario extends Person
{

	protected 	$rol_key;
	protected 	$identificacion;
	protected 	$clave;
	protected 	$clave_nueva;
	protected 	$ci;
	private 		$segment_id = '/id_usuario:/';

	public function __construct($vars = null)
	{
		$this->ci = &get_instance();

		parent::__construct($vars);
		$this->init($vars);

	}

	public function get_from_http()
	{

		$usuario = array();


		if($this->ci->input->post('nombre')) {
			$usuario['nombre'] = trim($this->ci->input->post('nombre'));
		}
		if($this->ci->input->post('apellido')) {
			$usuario['apellido'] = trim($this->ci->input->post('apellido'));
		}


		if($this->ci->input->post('email')) {
			$usuario['email'] = $this->ci->input->post('email');
		}

		if($this->ci->input->post('dni')) {
			$usuario['dni'] = $this->ci->input->post('dni');
		}

		if($this->ci->input->post('cuit')) {
			$usuario['cuit'] = $this->ci->input->post('cuit');
		}

		if($this->ci->input->post('iibb')) {
			$usuario['iibb'] = $this->ci->input->post('iibb');
		}

		if($this->ci->input->post('razon_social')) {
			$usuario['razon_social'] = $this->ci->input->post('razon_social');
		}

		if($this->ci->input->post('clave')) {
			$usuario['clave'] = trim($this->ci->input->post('clave'));
		}

		if($this->ci->input->post('estado_usuario'))
		{
			if ($this->ci->input->post('estado_usuario') == "SI") {
				$usuario['estado_usuario'] = 1;
			} else {
				$usuario['estado_usuario'] = 0;
			}
		}
		// else {
		// 	$usuario['estado_usuario'] = 0;
		// }

		// if($this->ci->input->post('estado_usuario')) {
		// 	echo 'esta seteado' , $this->ci->input->post('estado_usuario');
		// 	// $usuario['estado_usuario'] = $this->ci->input->post('estado_usuario');
		// 	// if ($usuario['estado_usuario'] == 'SI')	$usuario['estado_usuario'] = 1;
		// 	// if ($usuario['estado_usuario'] == 'NO')	$usuario['estado_usuario'] = 0;
		// }
  //               else{
		// 	echo 'NO esta seteado';

		// 	// $usuario['estado_usuario'] = 0;
		// }

		if($this->ci->input->post('codigo_area')) {
			$usuario['codigo_area'] = trim($this->ci->input->post('codigo_area'));
		}
		else{
			$usuario['codigo_area'] = "";
		}

		if($this->ci->input->post('telefono')) {
			$usuario['telefono'] = trim($this->ci->input->post('telefono'));
		}
		else{
			$usuario['telefono'] = "";
		}

		if($this->ci->input->post('telefono_celular')) {
			$usuario['telefono_celular'] = trim($this->ci->input->post('telefono_celular'));
		}
		else{
			$usuario['telefono_celular'] = "";
		}


		if($this->ci->input->get_post('id_usuario')) {
			$usuario['id_usuario'] = $this->ci->input->get_post('id_usuario');
		}
		elseif(get_explode_id($this->segment_id,$this->ci->uri->segment_array())){
			$usuario['id_usuario'] = (int)get_explode_id($this->segment_id,$this->ci->uri->segment_array());
		} elseif($this->ci->uri->segment(4)) {
			$usuario['id_usuario'] = $this->ci->uri->segment(4);
		} elseif($this->ci->session->userdata('id_usuario')) {			// Lo agarra por session
			$usuario['id_usuario'] = (int)$this->ci->session->userdata('id_usuario');
		}

		if($this->ci->input->post('fecha_nacimiento')) {
			$usuario['fecha_nacimiento'] = $this->ci->input->post('fecha_nacimiento');
		}

		if($this->ci->input->post('id_rol')) {
			$usuario['id_rol'] = $this->ci->input->post('id_rol');
		}

		//Localizacion
		if($this->ci->input->post('localizacion') and sizeof($this->ci->input->post('localizacion')) > 0 ) {
			$usuario['localizacion'] = $this->ci->input->post('localizacion');
		}


		$this->init($usuario);


	}

	public function init($vars, $class= __CLASS__)
	{
		if(isset($vars)){

			$reflexion = new ReflectionClass($this);

			foreach($vars as $key => $value)
			{
				foreach($reflexion->getMethods() as $reflexion_method) {
					if($reflexion_method->name == 'set_'.$key) {
						$this->{"set_". $key}($value);
					}
				}
				if($key == 'id_usuario') {

					$this->set_id($value);
				}
			}
			unset($reflexion);

			if($this->id_localizacion() > 0) {
				$this->localizacion->get_by_id($this->id_localizacion());

			}
			if(isset($vars['localizacion']) and sizeof($vars['localizacion']) > 0) {
				$this->localizacion->init($vars['localizacion']);
			}


			if($this->nombre() != '' and $this->apellido() != '') {
				$this->set_identificacion($this->nombre() . " " . $this->apellido() );
			}
		}
		gc_collect_cycles();

	}

	public function rol_key()
	{
		return $this->rol_key;
	}

	public function set_rol_key($rol_key)
	{
		$this->rol_key = $rol_key;
	}

	public function identificacion()
	{
		return $this->identificacion;
	}

	public function set_identificacion($identificacion)
	{
		$this->identificacion = $identificacion;
	}

	public function set_clave($clave)
	{
		$this->clave = trim($clave);
	}

	public function clave()
	{
		return $this->clave;
	}

	public function set_clave_nueva($clave_nueva)
	{
		$this->clave_nueva = trim($clave_nueva);
	}

	public function clave_nueva()
	{
		return $this->clave_nueva;
	}


	public function get_by_id($id_usuario)
	{
		$sql = "SELECT u.*,u.estado_usuario as 'estado',r.key as 'rol_key',r.descripcion as 'rol_descripcion',r.id_rol FROM usuarios u INNER JOIN roles r USING (id_rol) WHERE u.id_usuario = ".(int)$id_usuario;
		$query = $this->ci->db->query($sql);
		$user_vars = $query->row_array();
		if(isset($user_vars)) {
			$this->init($user_vars);
		} else {
			return $this;
		}
	}

	public function clear()
	{
		foreach(get_class_vars(__CLASS__) as $varname => $value){
			if(method_exists($this, "set_$varname")) {
				$this->{"set_{$varname}"}(null);
			}
		}
	}

	public function update()
	{
		try {
			$this->ci->db->trans_begin();

			$data_save = array(
					'email'				=> $this->email()
					,'id_rol'				=> $this->id_rol()
					,'nombre'			=> $this->nombre()
					,'apellido'			=> $this->apellido()
					,'telefono'			=> $this->telefono()
					,'estado_usuario'	=> $this->estado()


				);

			$this->localizacion->update();

			if($this->clave_nueva() != '') {
				$this->ci->db->set('clave',"PASSWORD(".$this->ci->db->escape($this->clave_nueva()). ")",false);
			}

			$this->ci->db->where('id_usuario',$this->id());
			$this->ci->db->update('usuarios',$data_save);

			if($this->ci->db->trans_status()) {
				$this->ci->db->trans_commit();
				return true;
			} else {
				$this->ci->db->trans_rollback();
				return false;
			}


		} catch (Exception $e) {
			$this->ci->db->trans_rollback();
			return false;
		}
	}

	/**
	 * Actualiza los datos del usuario, modificación de Mi Cuenta
	 **/
	public function updateMisDatos()
	{
		try {

			$this->ci->db->trans_begin();
			$data_save = array(
					'email'		=> $this->email()
					,'nombre'	=> $this->nombre()
					,'apellido'	=> $this->apellido()
					// ,'clave'				=> $this->clave()
					,'telefono'	=> $this->telefono()
					//,'id_localizacion'	=> $this->id_localizacion()
					,'cuit'		=> $this->cuit()
					,'iibb'		=> $this->iibb()
					,'razon_social'	=> $this->razon_social()
				);

			// calle, numero, piso, departamento, codigo_postal


			$this->localizacion->update();

			if($this->clave() != '') {
				$this->ci->db->set('clave',"PASSWORD(".$this->ci->db->escape($this->clave()). ")",false);
			}

			$this->ci->db->where('id_usuario',$this->id());
			$this->ci->db->update('usuarios',$data_save);

			if($this->ci->db->trans_status()) {
				$this->ci->db->trans_commit();
				return true;
			} else {
				$this->ci->db->trans_rollback();
				return false;
			}


		} catch (Exception $e) {
			$this->ci->db->trans_rollback();
			return false;
		}
	}

	/**
	 * Actualiza los datos del usuario, cuando el administrador lo edita al usuario
	 **/
	public function updateEditar()
	{
		try {

			$this->ci->db->trans_begin();
			$data_save = array(
					'email'		=> $this->email()
					,'nombre'	=> $this->nombre()
					,'apellido'	=> $this->apellido()
					// ,'clave'				=> $this->clave()
					,'telefono'	=> $this->telefono()
					//,'id_localizacion'	=> $this->id_localizacion()
					,'cuit'		=> $this->cuit()
					,'iibb'		=> $this->iibb()
					,'razon_social'	=> $this->razon_social()
					,'estado_usuario'	=> $this->estado_usuario()
					,'id_rol'	=> $this->id_rol()
				);

			// calle, numero, piso, departamento, codigo_postal

			$this->localizacion->update();

			if($this->clave() != '') {
				$this->ci->db->set('clave',"PASSWORD(".$this->ci->db->escape($this->clave()). ")",false);
			}

			$this->ci->db->where('id_usuario',$this->id());
			$this->ci->db->update('usuarios',$data_save);

			if($this->ci->db->trans_status()) {
				$this->ci->db->trans_commit();
				return true;
			} else {
				$this->ci->db->trans_rollback();
				return false;
			}


		} catch (Exception $e) {
			$this->ci->db->trans_rollback();
			return false;
		}
	}

	public function insert()
	{
		try {

			$this->ci->db->trans_begin();

			$this->set_id_localizacion($this->localizacion->insert());

			$data_save = array(
					'email'			=> $this->email()
					,'id_rol'			=> $this->id_rol()
					,'nombre'		=> $this->nombre()
					,'apellido'		=> $this->apellido()
					,'telefono'		=> $this->telefono()
					,'cuit'			=> $this->cuit()
					,'iibb'			=> $this->iibb()
					,'razon_social'	=> $this->razon_social()
					,'id_localizacion'	=> $this->id_localizacion()
					,'estado_usuario'=> $this->estado_usuario()
			);


			if($this->clave() != '') {
				$this->ci->db->set('clave',"PASSWORD(".$this->ci->db->escape($this->clave()). ")",false);
			}

			$this->ci->db->insert('usuarios',$data_save);
			if($this->ci->db->trans_status())
			{
				$this->ci->db->trans_commit();
				return true;
			} else {
				$this->ci->db->trans_rollback();
				return false;
			}
			return true;

		} catch (Exception $e) {
			return false;
		}
	}

}