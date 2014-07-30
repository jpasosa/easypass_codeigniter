<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

	protected $error;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('login_model');
		$this->load->config('emails');
	}

	public function index()
	{
		if($this->user->is_logged()){
			redirect('admin/usuarios');
		} else {
			$data = array();
			if($this->input->server('REQUEST_METHOD') == 'POST')
			{
				$this->validate();
			}

			$data['form_action'] = base_url('admin/login');

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
				$this->load->model('usuarios/usuarios_model');
				$usuario = $this->usuarios_model->get($usuario);


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

				redirect('admin/usuarios/mi_cuenta');
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
	 * Cierro la sesion
	 **/
	public function close()
	{
		if($this->user->is_logged()){
			$this->session->sess_destroy();
			redirect('admin/login');
		} else {
			redirect('admin/login');
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
