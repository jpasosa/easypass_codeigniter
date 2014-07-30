<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function fillSession($data,$session)
{
// 	if($data instanceof Hospital ){

// 	}
	//$identificacion = (isset($data['nombre_hospital'])) ? $data['nombre_hospital'] : $data['nombre'] . $data['apellido'];
	$identificacion = $data->nombre() . " " . $data->apellido();
	$my_data = array(
		'id_usuario' => $data->id()
		,'email' => $data->email()
		,'rol_key' => $data->rol_key()
		,'id_rol' => $data->id_rol()
		,'identificacion' => $identificacion
		,'this_user' => $data
		//,'permisos' => $data['permisos']
	);

	$session->set_userdata($my_data);
	unset($data);
	unset($my_data);
}

function checkRol($rol,$session){
	if(ROL_KEY == $session->userdata('rol_key')){
		return true;
	}
	elseif ($rol == $session->userdata('rol_key')) {
		return true;
	}
	else {
		return false;
	}
}

function getPerm($permiso,$session) {
	$permiso = strtolower($permiso);
	$data = $session->userdata('permisos');
	foreach($data['permisos'] as $miPermiso) {
		if($permiso == strtolower($miPermiso['permKey']) ) {
			return $miPermiso['permValue'];
		}
	}
	return false;
}

function isLogged($session){
	if($session->userdata('id_usuario')){
		return true;
	}
	else {
		return false;
	}
}
