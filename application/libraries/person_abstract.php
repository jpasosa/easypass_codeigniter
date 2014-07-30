<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/localizacion.php');

/**
 * Clase abstracta para manejar objetos que reprecenten personas
 * @author AllyTech Cloud Hosting
 *
 */
abstract class Person {

	const Clase = __CLASS__;
	protected $id;
	protected $nombre;
	protected $apellido;
	protected $email;
	protected $celular;
	protected $telefono_celular;
	protected $telefono;
	protected $dni;
	protected $tipo_dni;
	protected $fecha_nacimiento;
	protected $cuit;
	protected $iibb;
	protected $razon_social;
	protected $atributos_vendedor;
	protected $errors;
	protected $id_localizacion;
	protected $id_rol;
	protected $rol_descripcion;
	public $localizacion;
	protected $estado_usuario;

	public function __construct($vars = null)
	{
		if(isset($vars)){
			$this->init($vars,__CLASS__);
		}

		$this->localizacion = getInstance('Localizacion');
	}


	//abstract function init($vars, $class= __CLASS__);
	public function init($vars, $class= __CLASS__)
	{
		if(isset($vars)){

			foreach ($vars as $key => $value){
				if(array_key_exists($key, get_class_vars($class))){
					if(method_exists($this, "set_" . $key)){
						$this->{"set_". $key}($value);
					}
				}
				//echo $key . "<br>";
				if($key == 'id_usuario') {
					$this->set_id($value);
				}
			}
			if(isset($vars['id_localizacion']) and $vars['id_localizacion'] > 0) {
				/*
				 $this->set_id_localizacion($vars['id_localizacion']);
				if(!is_object($this->localizacion)) {
				$this->localizacion = getInstance("Localizacion");
				}
				$this->localizacion->get_by_id($this->id_localizacion());
				*/

				$this->set_id_localizacion($vars['id_localizacion']);
				$this->localizacion->get_by_id($this->id_localizacion());


				$this->localizacion->init($vars);


			}
		}
		//$this->localizacion = new Localizacion();
	}


	public function id()
	{
		return $this->id;
	}

	public function id_localizacion()
	{
		return $this->id_localizacion;
	}

	public function id_rol()
	{
		return $this->id_rol;
	}

	public function nombre()
	{
		return $this->nombre;
	}

	public function apellido()
	{
		return $this->apellido;
	}

	public function email()
	{
		return $this->email;
	}

	public function telefono_celular()
	{
		return $this->telefono_celular;
	}

	public function telefono()
	{
		return $this->telefono;
	}

	public function dni()
	{
		return $this->dni;
	}

	public function tipo_dni()
	{
		return $this->tipo_dni;
	}

	public function cuit()
	{
		return $this->cuit;
	}

	public function iibb()
	{
		return $this->iibb;
	}

	public function razon_social()
	{
		return $this->razon_social;
	}

	public function fecha_nacimiento($format = 'd-m-Y')
	{
		return date($format,strtotime($this->fecha_nacimiento));
	}

	public function estado_usuario()
	{
		return $this->estado_usuario;
	}

	public function errors()
	{
		return $this->errors;
	}





	/* Setters */

	public function set_id($id)
	{
		$this->id = (int)$id;
	}

	public function set_id_rol($id_rol)
	{
		$this->id_rol = (int)$id_rol;
	}

	public function set_id_localizacion($id_localizacion)
	{
		$this->id_localizacion = (int)$id_localizacion;
		if(isset($this->localizacion) and is_object($this->localizacion)) {
			$this->localizacion->set_id((int)$id_localizacion);
		}
	}

	public function set_estado_usuario($estado_usuario)
	{
		$this->estado_usuario = (int)$estado_usuario;
	}

	public function set_nombre($nombre)
	{
		$this->nombre = trim($nombre);
	}

	public function set_apellido($apellido)
	{
		$this->apellido = trim($apellido);
	}

	public function set_email($email)
	{
		$this->email = trim($email);
	}

	public function set_telefono_celular($telefono_celular)
	{
		$this->telefono_celular = trim($telefono_celular);
	}

	public function set_telefono($telefono)
	{
		$this->telefono = trim($telefono);
	}


	public function set_dni($dni)
	{
		$dni = trim($dni);
		$dni = str_replace(".", "", $dni);
		$dni = str_replace(" ", "", $dni);
		$this->dni = (int)$dni;
	}

	public function set_tipo_dni($tipo_dni)
	{
		$this->tipo_dni = trim($tipo_dni);
	}



	public function set_cuit($cuit)
	{
		$this->cuit = trim($cuit);
	}

	public function set_iibb($iibb)
	{
		$this->iibb = trim($iibb);
	}

	public function set_razon_social($razon_social)
	{
		$this->razon_social = trim($razon_social);
	}

	public function set_fecha_nacimiento($fecha_nacimiento)
	{
		$this->fecha_nacimiento = trim($fecha_nacimiento);
	}

	public function toJson()
	{
		return get_object_vars($this);
	}
}


