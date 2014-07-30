<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuarios extends MY_Controller
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
			redirect('admin/usuarios/mi_cuenta');
		} else {
			redirect('admin/login');
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
		$data['form_action'] 	= base_url('admin/usuarios/mi_cuenta');
		$data['script_header'] 	= array('js/localizaciones.js');
		$data['provincias'] 		= $this->localizaciones_model->get_all_provincias();
		$data['paises'] 			= $this->localizaciones_model->get_all_paises();
		$data['usuario'] = $this->usuario;
		//$data['data'] = $this->usuario;
		// $data['data']['rol'] = $this->rol;
		$data['view_file'] = 'mi_cuenta';
		$this->load->view('template',$data);
	}


	/**
	 * Listado de los Usuarios
	 **/
	public function listar( $page = 0 )
	{
		if(!$this->user->is_logged())		redirect('admin/login');


		$filter = array();

		// Selecciono tipo, valor y puede ser Rol o NO.
		if($this->input->post('tipo_filtro') && $this->input->post('valor') != '')
		{
			$tipo_filtro 		= $this->input->post('tipo_filtro');
			$valor 			= $this->input->post('valor');
			$data['tipo_filtro']	= $tipo_filtro;
			$data['valor_filtro'] 	= $valor;
			$id_rol 			= $this->input->post('id_rol');
			$data['id_rol']	= $id_rol;
			$data_session 	= array(
									'filtro_usuarios_tipo'	=> $tipo_filtro,
									'filtro_usuarios_valor'	=> $valor,
									'filtro_usuarios_rol'		=> $id_rol,
									);
			$this->session->set_userdata($data_session);
		// Solamente selecciono el ROL
		}else if ($this->input->post('valor') == '' && $this->input->post('id_rol')) { // POR GET
			echo 'seleccionaste rol';
			$this->session->unset_userdata('filtro_usuarios_tipo');
			$this->session->unset_userdata('filtro_usuarios_valor');
			$id_rol 			= $this->input->post('id_rol');
			$data['id_rol']	= $id_rol;
			$this->session->set_userdata('filtro_usuarios_rol',$id_rol);
		} else {
			$this->session->unset_userdata('filtro_usuarios_rol');
		}


		$per_page = $this->config->item('pag_admin_publicaciones');
		if($page == 0) {
			$limit = ' LIMIT 0, ' . $per_page;
		} else {
			$page = $this->uri->segment(4);
			$limit = ' LIMIT ' . $page . ', ' . $per_page;
		}
		$usuarios = $this->usuarios_model->getUsuarios($limit);

		// Paginador
		$this->load->library('pagination');
		$config['base_url'] 		= base_url('admin/usuarios/listar');
		$config['total_rows'] 	= $this->usuarios_model->contar();
		$config['per_page'] 	= $per_page;
		$config['uri_segment'] 	= 4;
		$config['use_page_numbers'] = FALSE;
		$this->pagination->initialize($config);
		$data['paginas'] 		= $this->pagination->create_links();
		// Fin Paginador

		// VISTA
		$data['form_action'] 	= base_url('admin/usuarios/listar');
		$data['roles'] 			= $this->roles_model->get_all();
		$data['usuarios']		= $usuarios;
		$data['view_file'] = 'listado_usuarios';
		$this->load->view('template',$data);
	}




	/**
	 * Edición de un usuario
	 **/
	public function editar( $id_usuario = 0)
	{
		if(!$this->user->is_logged())	redirect('admin/login');
		if($id_usuario == 0)			show_404();

		//
		// $this->usuario->set_id($id_usuario);
		// $this->usuario->set_id_localizacion($this->user->id_localizacion());

		$usuario['id_usuario'] = $id_usuario;
		$this->usuario = $this->usuarios_model->get($usuario);

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$this->usuario->get_from_http();
			$this->usuario->set_id($id_usuario);

			$errors = $this->usuarios_model->validarEditar($this->usuario);
			if(!$errors) {
				$update = $this->usuarios_model->updateEditar($this->usuario, 1);
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

		} else {	// POR GET
			$usuario['id_usuario'] = $id_usuario;
			$this->usuario = $this->usuarios_model->get($usuario);
		}


		if( isset($_POST['localizacion']) && $_POST['localizacion']['id_provincia'] && $_POST['localizacion']['id_localidad'] != ''
				|| $this->usuario->localizacion->id_provincia() )
		{
			$id_provincia = $this->input->post('id_provincia') ? $this->input->post('id_provincia')  : $this->usuario->localizacion->id_provincia();
			$data['localidades'] = $this->localizaciones_model->get_localidades_by_provincia($id_provincia);
			unset($id_provincia);
		}

		$data['editar'] 			= true;
		$data['form_action'] 	= base_url('admin/usuarios/editar') . $id_usuario . '.html';
		$data['script_header'] 	= array('js/localizaciones.js');
		$data['provincias'] 		= $this->localizaciones_model->get_all_provincias();
		$data['paises'] 			= $this->localizaciones_model->get_all_paises();
		$data['usuario'] 		= $this->usuario;
		$data['roles'] 			= $this->roles_model->get_all();
		$data['view_file'] 		= 'add_edit_usuario';
		$this->load->view('template',$data);
	}






	/**
	 * Alta de un Usuario por el Administrador
	 **/
	public function alta()
	{
		if(!$this->user->is_logged())	redirect('login');


		$this->usuario->get_from_http();

		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			$errors = $this->usuarios_model->validarNuevo($this->usuario);
			if(!$errors) {
				$this->usuarios_model->insert($this->usuario);
				$this->session->set_flashdata('success','El usuario se ha creado con éxito');
				redirect('admin/usuarios/listar');
			} else {
				$data['errors'] = $errors;
			}

		} else {	// POR GET //
			//$this->usuario->get_by_id($this->usuario->id());
		}


		if($this->input->post('id_provincia') or $this->usuario->localizacion->id_provincia()) {
			$id_provincia = $this->input->post('id_provincia') ? $this->input->post('id_provincia')  : $this->usuario->localizacion->id_provincia();
			$data['localidades'] = $this->localizaciones_model->get_localidades_by_provincia($id_provincia);
			unset($id_provincia);
		}

		// Vista
		$data['usuario'] 		= $this->usuario;
		$data['script_header'] 	= array('js/localizaciones.js');
		$data['paises'] 			= $this->localizaciones_model->get_all_paises();
		$data['provincias'] 		= $this->localizaciones_model->get_all_provincias();
		$data['roles'] 			= $this->roles_model->get_all();
		$data['view_file'] 		= 'add_edit_usuario';
		$this->load->view('template',$data);
	}



	/**
	 * Reseteo los filtros por ajax
	 **/
	public function resetFilters()
	{

		$data = array("mensaje" => "nada");
		echo json_encode($data);

		$this->session->unset_userdata('filtro_usuarios_tipo');
		$this->session->unset_userdata('filtro_usuarios_valor');
		$this->session->unset_userdata('filtro_usuarios_rol');
	}


}