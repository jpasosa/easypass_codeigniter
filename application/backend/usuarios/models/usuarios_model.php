<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model{

	protected $usuario;
	public function __contruct(){
		parent::__construct();

		//Cargo modelos
		$this->load->model('localizaciones/localizaciones_model');
	}

	public function get($usuario) {
		//$this->load->model('permisos/permisos_model');
		$this->usuario = getInstance("Usuario");
		//
		try {
			$condicion = "";
			if(isset($usuario['id_usuario'])){
				$condicion = " u.id_usuario = ". (int)$usuario['id_usuario'];
			}
			elseif(isset($usuario['email'])){
				$condicion = " u.email = ". $this->db->escape($usuario['email']);
			}
			else {
				//return NULL;
			}
			$query = $this->db->query("SELECT u.*,r.key as 'rol_key',r.descripcion as 'rol_descripcion',r.id_rol FROM usuarios u INNER JOIN roles r USING (id_rol) WHERE ".$condicion);
			unset($usuario);
			$usuario = $query->row_array();

			$this->usuario->init($usuario);

			if(!isset($usuario)){
				return NULL;
			}
			return $this->usuario;

		} catch (Exception $e) {
			return null;
		}
	}

	public function update($usuario,$isAdmin = false){
		try {

			if($usuario->update()){
				return true;
			}	else {
				return false;
			}


		} catch (Exception $e) {
			return false;
		}
	}

	/**
	 * Actualizo el registro de un Usuario. NO utiliza el objeto Usuario.
	 **/
	public function updateUsuario( $usuario )
	{
		try {

			$this->db->where('id_usuario', $usuario['id_usuario']);
			$this->db->update('usuarios', $usuario);



			if ($this->db->affected_rows()) {
				return true;
			} else {
				return false;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}

	public function updateEditar($usuario,$isAdmin = false){
		try {

			if($usuario->updateEditar()){
				return true;
			}	else {
				return false;
			}


		} catch (Exception $e) {
			return false;
		}
	}

	public function updateMisDatos($usuario,$isAdmin = false){
		try {

			if($usuario->updateMisDatos()){
				return true;
			}	else {
				return false;
			}


		} catch (Exception $e) {
			return false;
		}
	}

	public function insert($usuario,$isAdmin = false){
		try {

			if($usuario->insert()){
				return true;
			} else {
				return false;
			}
		}
		catch (Exception $e) {
			return 0;
		}
	}

	public function delete($usuario){
		try {
			if((int)$usuario['idUsuarios'] == 1){
				return FALSE;
			}
			$this->db->delete('Usuarios',"idUsuarios = " .(int)$usuario['idUsuarios']);
			if($this->db->affected_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		} catch (Exception $e) {
			return false;
		}
	}

	//Si existe el usuario devuelve verdadero.
	public function existe($usuario)
	{
		try {
			$query = $this->db->query('SELECT u.id_usuario FROM usuarios u WHERE u.email = '. $this->db->escape($usuario->email()) );
			if($query->num_rows() <= 0){
				return false;
			}
			else{
				return true;
			}
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function validarEditar(Usuario $usuario)
	{
		$this->load->library('email');
		$errors = false;

		if(!$usuario->nombre()) {
			$errors['nombre']  = 'Ingrese el nombre';
		}

		if(!$usuario->apellido()) {
			$errors['apellido'] = 'Ingrese su apellido';
		}

		if($usuario->email() == ''){
			$errors['email'] = 'Ingrese una dirección de correo';
		}
		elseif(!$this->email->valid_email($usuario->email())){
			$errors['email_not_valid'] = 'La dirección de correo es incorrecta';
		}
		elseif($this->check_email($usuario)) {
			$errors['email_existe'] = 'La dirección de correo ya existe';
		}


		$errors['localizacion'] = $this->localizaciones_model->validar($usuario->localizacion);

		if(is_array($errors['localizacion'])) {
			foreach($errors['localizacion'] as $error_key => $error_text) {
				$errors[$error_key] = $error_text;
			}

		}



		unset($errors['localizacion']);

		return $errors;
	}



	public function validarNuevo($usuario)
	{
		$this->load->library('email');
		$errors = false;

		if(!$usuario->nombre()) {
			$errors['nombre']  = 'Ingrese el nombre';
		}

		if(!$usuario->apellido()) {
			$errors['apellido'] = 'Ingrese su apellido';
		}

		if($usuario->email() == ''){
			$errors['email'] = 'Ingrese una dirección de correo';
		}
		elseif(!$this->email->valid_email($usuario->email())){
			$errors['email_not_valid'] = 'La dirección de correo es incorrecta';
		}
		elseif($this->check_email($usuario)) {
			$errors['email_existe'] = 'La dirección de correo ya existe';
		}


		$errors['localizacion'] = $this->localizaciones_model->validar($usuario->localizacion);

		if(is_array($errors['localizacion'])) {
			foreach($errors['localizacion'] as $error_key => $error_text) {
				$errors[$error_key] = $error_text;
			}

		}



		unset($errors['localizacion']);

		return $errors;
	}

// 	public function listar($filter,$isAdmin = false){

// 		try {

// 			if(!isset($filter['where'])){
// 				$filter['where'] = "";
// 			}

// 			if(!$isAdmin){
// 				$this->db->where("u.estado_usuario", 1);
// 			} else {
// 				//$filter['where'] = " WHERE  u.estado_usuario >= 0 ";
// 				//Documento esta Linea para probar el funcionamiento de Session(problema)
//                                 //$this->db->where("u.estado_usuario >= ", 0);
// 			}


// 			if(isset($filter['id_usuario'])){
// 				$this->db->where('u.id_usuario',(int)$filter['id_usuario']);
// 			}
// 			elseif(isset($filter['email'])){
// 				$this->db->like('u.email',trim($filter['email']));
// 			}
// 			elseif(isset($filter['apellido'])){
// 				$this->db->like('u.apellido',trim($filter['apellido']));
// 			}

// 			if(!isset($filter['limit'])){
// 				$filter['limit'] = "";
// 			}

// 			$sql = "SELECT u.*,l.*,p.*, r.key as 'rol_key',r.descripcion as 'rol_descripcion'
// FROM usuarios u INNER JOIN roles r USING (id_rol)
// LEFT JOIN localizaciones l USING (id_localizacion)
// LEFT JOIN provincias p USING (id_provincia) LEFT JOIN localidades loc USING (id_localidad) ". $filter['where'] . " " . $filter['limit'];
// 			$query = $this->db->query($sql);
// 			if($query->num_rows() <= 0){
// 				return NULL;
// 			}
// 			else{
// 				return $query->result_array();
// 			}
// 		} catch (Exception $e) {
// 			//throw new Exception($e->getMessage());
// 			return array();
// 		}
// 	}


	// public function listar($filter = NULL){
	// 	try {

	// 		$filter = $this->stringFilter();

	// 		$sql = "SELECT * FROM usuarios U " . $filter;
	// 		$query = $this->db->query($sql);


	// 		//
	// 		// Debagueo un objeto / arreglo / variable
	// 		//
	// 		echo ' <br/> <div style="font-weight: bold; color: green;"> $query: </div> <pre>' ;
	// 		echo '<div style="color: #3741c6;">';
	// 		if(is_array($query)) {
	// 		    print_r($query);
	// 		}else {
	// 		var_dump($query);
	// 		}
	// 		echo '</div>';
	// 		echo '</pre>';
	// 		// die('--FIN--DEBUGEO----');


	// 		if($query->num_rows() <= 0){
	// 			return NULL;
	// 		}
	// 		else{
	// 			return $query->result_array();
	// 		}
	// 	} catch (Exception $e) {
	// 		//throw new Exception($e->getMessage());
	// 		return array();
	// 	}
	// }


	public function getUsuarios( $limit = " ")
	{
		try {

			$filter = $this->stringFilter();

			$sql = "SELECT * FROM usuarios U INNER JOIN roles R ON U.id_rol=R.id_rol " . $filter . $limit;
			$query = $this->db->query($sql);

			if($query->num_rows() <= 0){
				return array();
			}else{
				return $query->result_array();
			}

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}


	/**
	 * Nos devuelve la cantidad de registros total. Utilizando los filtros.
	 **/
	public function contar()
	{
		try {

			$filter = $this->stringFilter();

			$sql 	= "SELECT COUNT(U.id_usuario) AS cant FROM usuarios U " . $filter;
			$q 		= $this->db->query($sql);
			$cant 	= $q->row_array();

			if (isset($cant['cant'])) {
				return (int)$cant['cant'];
			} else {
				return array();
			}


		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}

	/**
	 * Nos devuelve la consulta mysql que debe utilizar con el uso de los filtros
	 **/
	private function stringFilter($filter = NULL)
	{
		try {

			$filtrado = FALSE;

			// TIPO DE FILTRO
			if(!$this->session->userdata('filtro_usuarios_tipo')) {
				$string_filter = " ";
			} else {
				$tipo = $this->session->userdata('filtro_usuarios_tipo');
			}
			// VALOR DEL FILTRO
			if(!$this->session->userdata('filtro_usuarios_valor')) {
				$string_filter = " ";
			} else {
				$valor = $this->session->userdata('filtro_usuarios_valor');
			}
			// FILTRO POR ROL
			if(!$this->session->userdata('filtro_usuarios_rol')) {
				$string_filter = " ";
			} else {
				$rol = $this->session->userdata('filtro_usuarios_rol');
			}


			// FORMA EL STRING DEL FILTRO
			if(isset($tipo) && isset($valor))
			{
				$filtrado = TRUE;
				if($tipo == 'id_usuario') {
					$string_filter = "WHERE U.id_usuario = $valor";
				} else if($tipo == 'email') {
					$string_filter = "WHERE U.email LIKE '%$valor%'";
				} else if($tipo == 'apellido') {
					$string_filter = "WHERE U.apellido LIKE '%$valor%'";
				} else {
					$string_filter = " ";
				}
			}

			if(isset($rol) && $filtrado) {
				$string_filter .= " AND U.id_rol=$rol";
			} else if(isset($rol) && !$filtrado) {
				$string_filter .= " WHERE U.id_rol=$rol";
			}

			return $string_filter;


		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}

	/**
	 * Selecciona el usuario por el id. No Utiliza el objeto $usuario
	 **/
	public function getUsuarioById( $id_usuario )
	{
		try {

			$query = $this->db->get_where('usuarios', array('id_usuario' => $id_usuario));

			$result 	= $query->row_array();

			if ( isset($result['id_usuario']) ) {
				return $result;
			} else {
				return array();
			}

		} catch (Exception $e) {
			echo $e->getMessage();
			exit(1);
		}
	}



	public function validarPerfil(Usuario $usuario)
	{
		$this->load->library('email');
		$errors = false;


		// if($usuario->dni() <= 0) {
		// 	$errors['dni'] = 'Ingrese un número de DNI';
		// }

		if(!$usuario->nombre()) {
			$errors['nombre']  = 'Ingrese el nombre';
		}

		if(!$usuario->apellido()) {
			$errors['apellido'] = 'Ingrese su apellido';
		}

		if($usuario->email() == ''){
			$errors['email'] = 'Ingrese una dirección de correo';
		}
		elseif(!$this->email->valid_email($usuario->email())){
			$errors['email_not_valid'] = 'La dirección de correo es incorrecta';
		}
		elseif($this->check_email($usuario)) {
			$errors['email_existe'] = 'La dirección de correo ya existe';
		}


		$errors['localizacion'] = $this->localizaciones_model->validar($usuario->localizacion);

		if(is_array($errors['localizacion'])) {
			foreach($errors['localizacion'] as $error_key => $error_text) {
				$errors[$error_key] = $error_text;
			}

		}



		unset($errors['localizacion']);

		return $errors;
	}

	// public function contar($filter = NULL){
	// 	try {
	// 	if(!isset($filter['where'])){
	// 			$filter['where'] = "";
	// 		}


	// 		if(isset($filter['id_usuario'])){
	// 			$this->db->where('u.id_usuario',(int)$filter['id_usuario']);
	// 		}
	// 		elseif(isset($filter['email'])){
	// 			$this->db->like('u.email',trim($filter['email']));
	// 		}
	// 		elseif(isset($filter['apellido'])){
	// 			$this->db->like('u.apellido',trim($filter['apellido']));
	// 		}


	// 		if(!$isAdmin){
	// 			$this->db->where("u.estado_usuario", 1);
	// 		} else {
	// 			//$filter['where'] = " WHERE  u.estado_usuario >= 0 ";
	// 			$this->db->where("u.estado_usuario >= ", 0);
	// 		}



	// 		$query = $this->db->query("SELECT COUNT(u.id_usuario) as 'max' FROM usuarios u INNER JOIN roles r USING (id_rol) ");
	// 		$rows = $query->row_array();
	// 		if($rows['max'] <= 0 ){
	// 			return 0;
	// 		}
	// 		else{
	// 			return $rows['max'];
	// 		}
	// 	} catch (Exception $e) {
	// 		throw new Exception($e->getMessage());
	// 	}
	// }


	public function check_email($usuario){
		try {
			$sql = 'SELECT u.id_usuario FROM usuarios u WHERE u.email = ' .$this->db->escape(trim($usuario->email())) . " AND u.id_usuario != " . (int)$usuario->id();
			$query = $this->db->query($sql);
			return $query->row_array();
		} catch (Exception $e) {
			return 0;
		}
	}

	public function get_all(){
		try {
			$sql = "SELECT * FROM usuario u WHERE u.estado_usuario = 1 ORDER BY u.nombre ASC,u.apellido ASC";
			$query = $this->db->query($sql);
			return $query->result_array();
		} catch (Exception $e) {
			return array();
		}
	}

}
?>