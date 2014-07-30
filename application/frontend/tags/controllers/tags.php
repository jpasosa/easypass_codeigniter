<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Tags extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
		$this->redirect_no_login();
		$this->load->model('tags/tags_model');
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

		$data['url_action']     	= base_url('tags/agregar');
		$errores_validacion 	= array();

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$tag 				= $this->_getDataPost();
			$validate_tag    	= $this->tags_model->validateTag($tag);

			if ( empty($validate_tag) ) { // Validado OKA
					$insert_tag = $this->tags_model->insert($tag);
					if ($insert_tag) {
							$this->session->set_flashdata('success','Los datos se han guardado con éxito.');
							redirect('tags/listar');
					} else {
							$this->session->set_flashdata('error','Los datos no se pudieron guardar.');
							redirect('tags/listar');
					}
			} else { // Falló la validación
					$errores_validacion = $validate_tag;
			}

		} else { // GET
			$tag = $this->_getDataPost();
		}

		$data['errores_validacion'] = $errores_validacion;

		$data['tag']  = $tag;
		$data['view_file'] = 'add_tag';

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

		$data['form_action'] = base_url('tags/listar');

		$filter = array();

		$tags 		= $this->tags_model->getTags();

		$data['tags'] 	= $tags;
		$data['view_file'] 		= 'listado_tags';

		$this->load->view('template',$data);
	}


	public function editar($id_tag = 0)
	{
		if(!$this->user->is_logged())		redirect('login');
		if($id_tag == 0)				show_404();

		$data['url_action'] 	= base_url('tags/editar/' . $id_tag);
		$errores_validacion = array();

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$tag 			= $this->_getDataPost();
			$validate_tag = $this->tags_model->validateTag($tag);

			if ( empty($validate_tag) )
			{ 	// Validado OKA
				$update_categoria = $this->tags_model->update($tag, $id_tag);
				if ($update_categoria) {
					$this->session->unset_userdata('nombre_foto_subida');
					$this->session->set_flashdata('success','Los datos se pudieron actualizar con éxito.');
					redirect('tags/listar');
				} else {
					$this->session->set_flashdata('error','Los datos no se pudieron actualizar.');
					redirect('tags/listar');
				}
			} else { // Falló la validación
				$errores_validacion = $validate_tag;
			}

		} else { // GET
			$tag = $this->_getDataGet($id_tag);
		}


		$data['editar'] = false;
		$data['errores_validacion'] = $errores_validacion;

		$data['tag'] 	= $tag;
		$data['view_file'] 	= 'edit_tag';

		$this->load->view('template',$data);
	}



	/**
	 * Va a eliminar un registro de una categoría (por AJAX)
	 *
	 * @team 	Allytech
	 * @author 	Juan Pablo Sosa <juans@allytech.com>
	 * @date 	12 de marzo del 2014
	 **/
	public function erase_ajax()
	{
		$id_tag = $this->input->post('id_tag');


		$erase_tag = $this->tags_model->eraseTag($id_tag);

		if ($erase_tag) {
			return true;
		} else {
			return false;
		}

	}



	/**
	 * Agarra por post los datos de la categoría
	 **/
	private function _getDataPost()
	{
		$tag = array();

		$tag['nombre_tag']	= $this->input->post('nombre_tag') ? $this->input->post('nombre_tag') : '';

		return $tag;

	}

	/**
	 * Agarra por get a la categoría
	 **/
	private function _getDataGet($id_tag)
	{
		$tag = $this->tags_model->getTag($id_tag);
		return $tag;
	}

}

