<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Clase que reprecenta la localización de una Entidad.
 * @author AllyTech Cloud Hosting
 *
 */
class Localizacion
{
	protected $ci;
	protected $db;
	protected $id_localizacion;
	protected $id_localidad;
	protected $id_provincia;
	protected $id_pais;
	protected $localidad;
	protected $provincia;
	protected $calle;
	protected $numero;
	protected $departamento;
	protected $piso;
	protected $codigo_postal;

	public function __construct($vars = null)
	{
		if(isset($vars)){
			$this->init($vars,__CLASS__);
		}
		$this->ci = &get_instance();


	}

	public function init($vars, $class= __CLASS__)
	{
		$this->calle = '';
		$this->departamento = '';
		$this->piso = '';
		$this->numero = '';


		if(isset($vars)){

			$reflexion = new ReflectionClass($this);

			foreach($vars as $key => $value) {

				foreach($reflexion->getMethods() as $reflexion_method) {

					if($reflexion_method->name == 'set_'.$key) {
						$this->{"set_". $key}($value);
					}
				}

				if($key == 'id_localizacion') {

					$this->set_id($value);
				}

			}
			unset($reflexion);

			/*
			foreach ($vars as $key => $value){
				if(array_key_exists($key, get_class_vars($class))){
					if(method_exists($this, "set_" . $key)){
						$this->{"set_". $key}($value);
					}
				}
				if($key == 'id_localizacion') {
					$this->set_id($value);
				}
			}
			*/





		}

		gc_collect_cycles();
	}


	public function get_by_id($id_localizacion = null)
	{
		try {

			if(!isset($id_localizacion)) {
				$id_localizacion = $this->id();
			}

			$sql = "SELECT * FROM localizaciones l INNER JOIN localidades loc USING (id_localidad) INNER JOIN provincias p ON (l.id_provincia = p.id_provincia)  WHERE l.id_localizacion = ".(int)$id_localizacion;
			$query = $this->ci->db->query($sql);
			$this->init($query->row_array());

			if($this->id() > 0) {
				//return $this;
			} else {
				//return null;
			}

		} catch (Exception $e) {
			//return null;
		}
	}

	public function id()
	{
		return $this->id_localizacion;
	}

	public function id_localidad()
	{
		return $this->id_localidad;
	}

	public function id_provincia()
	{
		return $this->id_provincia;
	}

	public function id_pais()
	{
		return $this->id_pais;
	}

	public function localidad()
	{
		return $this->localidad;
	}

	public function provincia()
	{
		return $this->provincia;
	}

	public function pais()
	{
		return $this->pais;
	}

	public function calle()
	{
		return $this->calle;
	}

	public function numero()
	{
		return $this->numero;
	}

	public function departamento()
	{
		return $this->departamento;
	}

	public function piso()
	{
		return $this->piso;
	}

	public function codigo_postal()
	{
		return $this->codigo_postal;
	}

	/* Setters*/

	public function set_id($id)
	{
		$this->id_localizacion = (int)$id;
	}

	public function set_id_localidad($id_localidad)
	{
		$this->id_localidad = (int)$id_localidad;
	}

	public function set_id_provincia($id_provincia)
	{
		$this->id_provincia = (int)$id_provincia;
	}

	public function set_id_pais($id_pais)
	{
		$this->id_pais = (int)$id_pais;
	}

	public function set_localidad($localidad)
	{
		$this->localidad = $localidad;
	}

	public function set_provincia($provincia)
	{
		$this->provincia = $provincia;
	}

	public function set_calle($calle)
	{
		$this->calle = trim($calle);
	}

	public function set_numero($numero)
	{
		$this->numero = (int)$numero;
	}

	public function set_departamento($departamento)
	{
		$this->departamento = trim($departamento);
	}

	public function set_piso($piso)
	{
		$this->piso = trim($piso);
	}

	public function set_codigo_postal($codigo_postal)
	{
		$this->codigo_postal = trim($codigo_postal);
	}

	public function update()
	{
		try {

			$data_localizacion = array(
					'id_localidad' 	=> $this->id_localidad()
					,'id_provincia' 	=> $this->id_provincia()
					,'calle' 			=> $this->calle()
					,'numero' 		=> $this->numero()
					,'departamento' => $this->departamento()
					,'piso' 			=> $this->piso()
					,'codigo_postal' => $this->codigo_postal()
					);


			$this->ci->db->where('id_localizacion',$this->id());
			$this->ci->db->update('localizaciones',$data_localizacion);
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public function insert()
	{
		try {
			$data_localizacion = array(
					'id_pais' => $this->id_pais()
					,'id_localidad' => $this->id_localidad()
					,'id_provincia' => $this->id_provincia()
					,'calle' => $this->calle()
					,'numero' => $this->numero()
					,'departamento' => $this->departamento()
					,'piso' => $this->piso()
					,'codigo_postal' => $this->codigo_postal()
			);

			$this->ci->db->insert('localizaciones',$data_localizacion);
			return $this->ci->db->insert_id();
		} catch (Exception $e) {
			return false;
		}
	}


}


