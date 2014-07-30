<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Categorias extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
		$this->redirect_no_login();
		$this->load->model('categorias/categorias_model');
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

		$data['url_action']     	= base_url('categorias/agregar');
		$errores_validacion 	= array();

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$categoria 				= $this->_getDataPost();
			$validate_categoria    	= $this->categorias_model->validateCategoria($categoria);

			if ( empty($validate_categoria) ) { // Validado OKA
					$insert_categoria = $this->categorias_model->insert($categoria);
					if ($insert_categoria) {
							$this->session->set_flashdata('success','Los datos se han guardado con éxito.');
							redirect('categorias/listar');
					} else {
							$this->session->set_flashdata('error','Los datos no se pudieron guardar.');
							redirect('categorias/listar');
					}
			} else { // Falló la validación
					$errores_validacion = $validate_categoria;
			}

		} else { // GET
			$categoria = $this->_getDataPost();
		}

		$data['errores_validacion'] = $errores_validacion;

		$data['categoria']  = $categoria;
		$data['view_file'] = 'add_categoria';

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

		$data['form_action'] = base_url('categorias/listar');

		$filter = array();

		$categorias 		= $this->categorias_model->getCategorias();

		$data['categorias'] 	= $categorias;
		$data['view_file'] 		= 'listado_categorias';

		$this->load->view('template',$data);
	}


	public function editar($id_categoria = 0)
	{
		if(!$this->user->is_logged())		redirect('login');
		if($id_categoria == 0)				show_404();

		$data['url_action'] 	= base_url('categorias/editar/' . $id_categoria);
		$errores_validacion = array();

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$categoria 			= $this->_getDataPost();
			$validate_categoria = $this->categorias_model->validateCategoria($categoria);

			if ( empty($validate_categoria) )
			{ 	// Validado OKA
				$update_categoria = $this->categorias_model->update($categoria, $id_categoria);
				if ($update_categoria) {
					$this->session->unset_userdata('nombre_foto_subida');
					$this->session->set_flashdata('success','Los datos se pudieron actualizar con éxito.');
					redirect('categorias/listar');
				} else {
					$this->session->set_flashdata('error','Los datos no se pudieron actualizar.');
					redirect('categorias/listar');
				}
			} else { // Falló la validación
				$errores_validacion = $validate_categoria;
			}

		} else { // GET
			$categoria = $this->_getDataGet($id_categoria);
		}


		$data['editar'] = false;
		$data['errores_validacion'] = $errores_validacion;

		$data['categoria'] 	= $categoria;
		$data['view_file'] 	= 'edit_categoria';

		$this->load->view('template',$data);
	}



	public function sumPorcentajes()
	{
		$porc = $this->input->post('porcentaje');

		$sum_porcentajes = $this->categorias_model->sumPorcentajes($porc);

		if ($sum_porcentajes) {
			return true;
		} else {
			return false;
		}


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
		$id_categoria = $this->input->post('id_categoria');


		$erase_categoria = $this->categorias_model->eraseCategoria($id_categoria);

		if ($erase_categoria) {
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
		$categoria = array();

		$categoria['nombre']	= $this->input->post('nombre') ? $this->input->post('nombre') : '';

		return $categoria;

	}

	/**
	 * Agarra por get a la categoría
	 **/
	private function _getDataGet($id_categoria)
	{
		$categoria = $this->categorias_model->getCategoria($id_categoria);
		return $categoria;
	}

}

