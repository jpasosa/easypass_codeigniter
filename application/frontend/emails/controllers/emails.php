<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Emails extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
		$this->redirect_no_login();
		$this->load->model('emails/emails_model');
		//Carga de clases de Equipos
		//$this->load->library('categoria');
	}


	public function __destruct()
	{
		gc_collect_cycles();
	}


	public function index(){
		$this->listar();
	}



	public function agregar()
	{
		if(!$this->user->is_logged())       redirect('login');

		$data['url_action']     	= base_url('emails/agregar');
		$errores_validacion 	= array();

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$email 				= $this->_getDataPost();
			$validate_email    	= $this->emails_model->validateEmail($email);

			if ( empty($validate_email) ) { // Validado OKA
					$insert_email = $this->emails_model->insert($email);
					if ($insert_email) {
							$this->session->set_flashdata('success','Los datos se han guardado con éxito.');
							redirect('emails/listar');
					} else {
							$this->session->set_flashdata('error','Los datos no se pudieron guardar.');
							redirect('emails/listar');
					}
			} else { // Falló la validación
					$errores_validacion = $validate_email;
			}

		} else { // GET
			$email = $this->_getDataPost();
		}

		$data['errores_validacion'] = $errores_validacion;

		$data['email']  = $email;
		$data['view_file'] = 'add_email';

		$this->load->view('template',$data);



	}





	public function listar($pagina = 'pagina', $page = 0)
	{
		if(!$this->user->is_logged())	redirect('login');

		if ($this->session->flashdata("success")) {
			$data['msg'] 		= $this->session->flashdata("success");
		}
		if ($this->session->flashdata("error")) {
			$data['msg_error'] 	= $this->session->flashdata("error");
		}

		$data['form_action'] = base_url('emails/listar');

		$filter = array();

		$emails 		= $this->emails_model->getEmails();

		$data['emails'] 	= $emails;
		$data['view_file'] = 'listado_email';

		$this->load->view('template',$data);
	}


	public function editar($id_email = 0)
	{
		if(!$this->user->is_logged())		redirect('login');
		if($id_email == 0)				show_404();

		$data['url_action'] 	= base_url('emails/editar/' . $id_email);
		$errores_validacion = array();

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$email 			= $this->_getDataPost();
			$validate_email = $this->emails_model->validateEmail($email);

			if ( empty($validate_email) )
			{ 	// Validado OKA
				$update_email = $this->emails_model->update($email, $id_email);
				if ($update_email) {
					$this->session->set_flashdata('success','Los datos se pudieron actualizar con éxito.');
					redirect('emails/listar');
				} else {
					$this->session->set_flashdata('error','Los datos no se pudieron actualizar.');
					redirect('emails/listar');
				}
			} else { // Falló la validación
				$errores_validacion = $validate_email;
			}

		} else { // GET
			$email = $this->_getDataEmail($id_email);
		}


		$data['editar'] = false;
		$data['errores_validacion'] = $errores_validacion;

		$data['email'] 	= $email;
		$data['view_file'] 	= 'edit_email';

		$this->load->view('template',$data);
	}



	/**
	 * Va a eliminar un registro de table emails (por AJAX)
	 *
	 * @team 	Allytech
	 * @author 	Juan Pablo Sosa <juans@allytech.com>
	 * @date 	12 de marzo del 2014
	 **/
	public function erase_ajax()
	{
		$id_email = $this->input->post('id_email');

		$erase_email = $this->emails_model->eraseEmail($id_email);

		if ($erase_email) {
			$data['ok'] = true;
		} else {
			$data['ok'] = false;
		}

		echo json_encode($data);

	}



	/**
	 * Agarra por post los datos de la categoría
	 **/
	private function _getDataPost()
	{
		$email = array();

		$email['nombre_email']	= $this->input->post('nombre_email') ? $this->input->post('nombre_email') : '';

		return $email;

	}

	/**
	 * Agarra por get a la categoría
	 **/
	private function _getDataEmail($id_email)
	{
		$email = $this->emails_model->getemail($id_email);
		return $email;
	}

}

