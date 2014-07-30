<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller_Front {

	protected $error;
	//protected $login_model;

	public function __construct()
	{
		parent::__construct();
		// $this->load->library('session');
		$this->load->model('login_model');
		$this->load->config('emails');
	}






	/**
	 * Login de un usuario vendedor, para administrar sus cosas.
	 **/
	public function index()
	{
		if($this->user->is_logged())
		{
			redirect('claves/buscar');
		}
		else
		{
			$data = array();
			if($this->input->server('REQUEST_METHOD') == 'POST')
			{
				$this->validate();
			}
			$data['form_action'] = base_url('login');
			// $data['view_file'] = 'login';

			$this->load->view('login_user_backend',$data);
		}

	}


	public function login()
	{
		if($this->user->is_logged()){
			redirect('userbackend');
		} else {
			$data = array();

			if($this->input->server('REQUEST_METHOD') == 'POST') {

				$this->validate();


			}

			$data['form_action'] = base_url('login.html');

			$this->load->view('login',$data);
		}

	}



	protected function validate()
	{
		$usuario 	= array();
		$data 		= array();

		if($this->input->post('email') && $this->input->post('clave'))
		{
			$dataUsuario['email'] = $this->input->post('email');
			$dataUsuario['clave'] = $this->input->post('clave');

			$usuario = $this->login_model->validate($dataUsuario);

			if(isset($usuario,$usuario['id_usuario']) && $usuario['id_usuario'] > 0)
			{

				$usuario = $this->login_model->getUser($usuario);

				$identificacion = $usuario->nombre() . " " . $usuario->apellido();
				$usuario->set_identificacion($identificacion);
				$my_data = array(
						'id_usuario'		=> $usuario->id()
						,'email'			=> $usuario->email()
						,'rol_key'		=> $usuario->rol_key()
						,'id_rol'			=> $usuario->id_rol()
						,'identificacion'	=> $identificacion
						,'id_localizacion'	=> $usuario->id_localizacion()
				);

				$this->user->init($my_data);

				$this->session->set_userdata($my_data);
				redirect('claves/buscar');
			}
			else {
				$this->error['error_login'] = true;
			}

		}
		else{
			$this->error['no_data'] = true;
		}
	}

	public function forgot(){
		$data = array();


		$usuario['email'] = trim($this->input->post('email'));
		$data = $this->login_model->forgot($usuario);

		if(!$data['errores']){
			$this->notificar($data['usuario']);
			$data['success'] = lang('text_login_forgot_success');
			echo json_encode($data);
		}
		else {
			if(isset($data['email'])){
				$data['error'] = lang('text_login_forgot_invalid');
			}
			elseif (isset($data['noExiste'])){
				$data['error'] = lang('text_login_forgot_error');
			}
			echo json_encode($data);
		}

	}

	/**
	 * Cierro la sesion del usuario vendedor.
	 **/
	public function close()
	{
		if($this->user->is_logged())
		{
			$this->session->sess_destroy();
			redirect('login');
		} else {
			redirect('login');
		}
	}

	protected function notificar($usuario){
		$config['protocol'] = 'mail';
		$config['charset'] = 'iso-8859-1';
		$config['mailtype'] = 'html';

		$this->load->library('email');
		$this->email->initialize($config);

		$this->email->subject(lang('text_login_forgot_mail_subject'));
		$this->email->from($this->config->item('email_from'));
		$this->email->to($usuario['email']);

		$data['usuario'] = $usuario;

		$this->email->message($this->load->view('template_email_forgot',$data,true));

		$this->email->send();
	}


}
