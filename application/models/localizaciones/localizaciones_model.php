<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Localizaciones_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('localizacion');
	}


	public function get_all_provincias()
	{
		$sql = "SELECT * FROM provincias p ORDER BY p.provincia ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_all_paises()
	{
		$sql = "SELECT * FROM paises p ORDER BY p.pais ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_localidades_by_provincia($id_provincia)
	{
		$sql = "SELECT * FROM localidades loc INNER JOIN provincias p USING (id_provincia) WHERE loc.localidad != '' AND  loc.id_provincia = " . (int)$id_provincia . " ORDER BY loc.localidad ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_localidad_by_id($id_localidad)
	{
		$sql = "SELECT * FROM localidades loc INNER JOIN provincias p USING (id_provincia) WHERE loc.id_localidad = " . (int)$id_localidad;
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function validar($localizacion)
	{
		$errors = false;

		if(!$localizacion->id_provincia()) {
			$errors['id_provincia'] = 'Debe seleccionar una provincia';
		}

		if(!$localizacion->id_localidad()) {
			$errors['id_localidad'] = 'Debe seleccionar una localidad';
		}

		if($localizacion->calle() == '') {
			$errors['calle'] = 'Ingrese la calle';
		}

		if(!$localizacion->numero()) {
			$errors['numero'] = 'Ingrese el número de la calle';
		}

		return $errors;
	}


}