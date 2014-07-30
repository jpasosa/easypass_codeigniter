<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Panel extends MY_Controller_Front
{




	public function __construct()
	{
		parent::__construct();
		$this->redirect_no_login();
		// //carga de modelos
		// $this->load->model('usuarios/usuarios_model');
		// $this->load->model('roles/roles_model');
		// $this->load->model('localizaciones/localizaciones_model');
		//Carga de clases
		$this->load->library('usuario');
	}




	public function index()
	{
		// if($this->user->is_logged()) {
		// 	redirect('usuarios/mi_cuenta');
		// } else {
		// 	redirect('login');
		// }
		// VISTA
		$data['form_action'] 	= base_url('panel');
		// $data['script_header'] 	= array('js/localizaciones.js');
		$data['usuario'] 		= $this->usuario;
		//$data['data'] = $this->usuario;
		// $data['data']['rol'] = $this->rol;

		$data['view_file'] = 'main_content';
		$this->load->view('template',$data);
	}







}

