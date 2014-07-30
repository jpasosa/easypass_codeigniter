<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends MY_Controller_Front
{

	public function __construct()
	{
		parent::__construct();
		$this->redirect_no_login();
		//carga de modelos
		$this->load->model('usuarios/usuarios_model');
		$this->load->model('roles/roles_model');
		$this->load->model('localizaciones/localizaciones_model');
		//Carga de clases
		$this->load->library('usuario');
	}




	public function index()
	{
		if($this->user->is_logged()) {
			redirect('usuarios/mi_cuenta');
		} else {
			redirect('login');
		}
	}




	public function mi_cuenta()
	{

		if(!$this->user->is_logged())	redirect('admin/login');
		$this->usuario->get_from_http();
		$this->usuario->set_id($this->user->id());
		$this->usuario->set_id_localizacion($this->user->id_localizacion());

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$errors = $this->usuarios_model->validarPerfil($this->usuario);
			if(!$errors) {
				$update = $this->usuarios_model->updateMisDatos($this->usuario, 1);
				if ($update) {
					$data['success'] = 'Los datos fueron actualizados con éxito';
				} else {
					$data['error_update'] = 'Los datos no se pudieron actualizar.';
				}
			} else {
					$data['error'] 	= true;
					$data['errors'] 	= $errors;
				foreach($errors as $key => $value) {
					if(lang($value) != '') {
						$data['errores'] .= "-". lang($value) . "<br />";
					}
				}
			}
			//$data['data'] = $usuario;
		}
		else {	// POR GET
			$usuario['id_usuario'] = $this->session->userdata('id_usuario');
			$this->usuario = $this->usuarios_model->get($usuario);
		}

		// if($this->input->post('localizacion') or $this->usuario->localizacion->id_provincia())
		if( isset($_POST['localizacion']) && $_POST['localizacion']['id_provincia'] && $_POST['localizacion']['id_localidad'] != ''
				|| $this->usuario->localizacion->id_provincia() )
		{
			$id_provincia = $this->input->post('id_provincia') ? $this->input->post('id_provincia')  : $this->usuario->localizacion->id_provincia();
			$data['localidades'] = $this->localizaciones_model->get_localidades_by_provincia($id_provincia);
			unset($id_provincia);
		}

		// VISTA
		$data['form_action'] 	= base_url('usuarios/mi_cuenta');
		$data['script_header'] 	= array('js/localizaciones.js');
		$data['provincias'] 		= $this->localizaciones_model->get_all_provincias();
		$data['paises'] 			= $this->localizaciones_model->get_all_paises();
		$data['usuario'] = $this->usuario;
		//$data['data'] = $this->usuario;
		// $data['data']['rol'] = $this->rol;

		$data['view_file'] = 'mi_cuenta';
		$this->load->view('template_userbackend',$data);

	}



}

